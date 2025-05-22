<?php

namespace App\Services;

use OpenAI;
use Illuminate\Support\Facades\Auth;
use App\Models\medicalDiagnosis;
use Illuminate\Support\Facades\Http;

class AIDiagnosisService
{

    /**
     * Generate a medical diagnosis using OpenAI LLM based on user input.
     *
     * @param array $data The validated request data from the AIDiagnosisRequest
     * @return array The structured AI-generated response (JSON-decoded)
     */
    public function generateDiagnosis(array $data)
    {
        $prompt = $this->buildPrompt($data);
        $response = $this->getDeepSeekDiagnosis($prompt);
        $responseFromLLM = $response->choices[0]->message->content;
        $cleanJson = trim($responseFromLLM);
        $cleanJson = preg_replace('/^json\s*/', '', $cleanJson); // remove starting json
        $cleanJson = preg_replace('/\s*$/', '', $cleanJson); // remove ending
        return $cleanJson;
    }


    private function getGPTDiagnosis($prompt, $data)
    {

        $client = OpenAI::client(env('OPEN_AI_TOKEN'));

        $result = $client->chat()->create([
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                ['role' => 'user', 'content' => $prompt], // ✅ must start with user
            ],
        ]);
        $response = $result->choices[0]->message->content;
        $this->storeDiagnosis($data, $response);
        return $response;
    }


    private function getDeepSeekDiagnosis($prompt)
    {
        $result = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . env('OPENROUTER_API_KEY'),
        ])->post('https://openrouter.ai/api/v1/chat/completions', [
            'model' => 'deepseek/deepseek-prover-v2:free',
            'messages' => [
                [
                    'role' => 'user',
                    'content' => $prompt,
                ],
            ],
        ]);
        return json_decode($result);
    }

    private function buildPrompt(array $data): string
    {
        $prompt = "
            يقوم مساعد التشخيص الطبي بمساعدة الأطباء المختصين في تحديد الأمراض المحتملة للمرضى. 
            بناءً على المعلومات التالية:

            - الجنس: {$data['gender']}
            - الأعراض: {$data['symptoms']}
            - التاريخ الطبي: {$data['history']}
            - العوامل المؤثرة المحتملة: {$data['affectFactors']}
            - النتائج السابقة للفحوص الطبية: {$data['oldResults']}

            يُطلب منك كتابة الرد بالتنسيق التالي باستخدام صيغة JSON:

            [array] : 'الأمراض المتوقعة'
            [string] : 'المرض المرجح'
            [string] : 'التشخيص'
            [array] : 'الفحوصات المطلوبة'
            [array]:'الأدوية المقترحة'
            [string] : 'النصيحة الطبية'

            يُفضل أن تتضمن أسماء الأدوية أسماء تجارية باللغة الإنجليزية وكتابتها باللغة الانجليزية مع الجرعات اللازمة.
            يُرجى التأكد من تقديم الرد بالتنسيق المطلوب و توضيح كل نقطة بشكل دقيق ووافٍ.
            يُرجى التأكد من تقديم تشخيص علمي عالي الدقة.

            please provide the response with json format not string
        ";

        if (!empty($data['AdvancedReponse'])) {
            $prompt .= 'يُرجى التأكد من تقديم اجابة عالية من الدقة. 
            يُرجى التأكد من تقديم اعلى درجات الدقة في الاجابة. 
            يرجى ارسال مصادر و مراجع علمية تؤكد التشخيص.';
        }

        return $prompt;
    }

    private function storeDiagnosis(array $data, string $response): void
    {
        medicalDiagnosis::create([
            'InitialGiagnosis' => json_encode($response),
            'user_id' => Auth::id(),
            'symptoms' => json_encode([
                'oldResults' => $data['oldResults'],
                'affectFactors' => $data['affectFactors'],
                'history' => $data['history'],
                'symptoms' => $data['symptoms'],
                'gender' => $data['gender'],
            ], JSON_UNESCAPED_UNICODE),
        ]);
    }
}
