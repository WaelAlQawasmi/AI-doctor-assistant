<?php

namespace App\Http\Controllers;

use App\Models\medicalDiagnosis;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use OpenAI;

class MedicalDiagnosisController extends Controller
{
    /**
     * action to get   medical Diagnosis based on user input from openAI LLM.
    */
    public function getBasicAIDiagnosis(Request $request)
    {
        // check if the user  is authenticated or not by check if has points
        $this->authorize('BasicAIDiagnosis',[ User::class, $request->AdvancedReponse]);
        // AI LLM prompt
        $prompt = "   
            يقوم مساعد التشخيص الطبي بمساعدة الأطباء المختصين في تحديد الأمراض المحتملة للمرضى. 
            بناءً على المعلومات التالية:
            
            - الجنس: $request->gender
            - الأعراض: $request->symptoms
            - التاريخ الطبي: $request->history
            - العوامل المؤثرة المحتملة: $request->affectFactors
            - النتائج السابقة للفحوص الطبية: $request->oldResults
            
            يُطلب منك كتابة الرد بالتنسيق التالي باستخدام صيغة 
            JSON:
            
           [array] : 'الأمراض المتوقعة'
            [string] : 'المرض المرجح'
            [string] : 'التشخيص'
            [array] : 'الفحوصات المطلوبة'
            [array]:'الأدوية المقترحة'
            [string] : 'النصيحة الطبية'
            
            يُفضل أن تتضمن أسماء الأدوية أسماء تجارية باللغة الإنجليزية وكتابتها باللغة الانجليزية مع الجرعات اللازمة.
            يُرجى التأكد من تقديم الرد بالتنسيق المطلوب و توضيح كل نقطة بشكل دقيق ووافٍ.
            يُرجى التأكد من تقديم تشخيص علمي عالي الدقة.
        ";

        if($request->AdvancedReponse){
            $prompt .='يُرجى التأكد من تقديم اجابة عالية من الدقة. 
            يُرجى التأكد من تقديم اعلى درجات الدقة في الاجابة. 
             يرجى ارسال مصادر  و مراجع عليمة تؤكد التشخيص . ';
        }
        $client = OpenAI::client( getenv('OPEN_AI_TOKEN'));
        $result = $client->chat()->create([
                    'model' => 'gpt-3.5-turbo',
                    'messages' => [ ['role' => 'assistant', 'content' => $prompt], ],
                ]);

        $response=$result->choices[0]->message->content; 
        medicalDiagnosis::create([
            'InitialGiagnosis' => json_encode( $response),
            'user_id'=>Auth::id(),
            'symptoms'=>json_encode([
               'oldResults'=> $request->oldResults,
               'affectFactors'=> $request->affectFactors,
               'history'=>$request->history,
               'symptoms'=>$request->symptoms,
               'gender'=>$request->gender,
                ], JSON_UNESCAPED_UNICODE)
            ]);
        return response($response);
    }
}
