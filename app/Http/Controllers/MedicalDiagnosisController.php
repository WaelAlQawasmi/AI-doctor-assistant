<?php

namespace App\Http\Controllers;

use App\Models\medicalDiagnosis;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use OpenAI;

class MedicalDiagnosisController extends Controller
{
 

    public function getBasicAIDiagnosis(Request $request)
    {
      //  $this->authorize('BasicAIDiagnosis', User::class);

        //  $prompt = "   
        //   كمساعد في تشخيص الامراض الطبية لطبيب مختص  وكان قد جاءت حالة مرضية 
         
        //   $request->gender ل
        //   تعاني من 
        //   $request->symptoms 
        //  $request->history والتاريخ الطبي للمريض هو  
        //  $request->affectFactors علماً ان العوامل المؤثرة المحتملة 
        //  $request->oldResults و كانت نتائج فحوص طبية سابقة هو 

        // : اكتب رد  بحيث يكون كالتالي
        //              1 - json  ان تكون الاستجابة  بصيغة
        //             2-  ان يكون الرد بنفس هذه الترتيب
        //             الامراض المتوقعة :  [array]
        //             المرض المرجح :[string]
        //                 التشخيص : [string] 
        //             الفحوصات المطلوبة: [array]
        //              الادوية المقترحة :  [array]
        //              النصيحة الطبية :   [string]
      
        //         3- يحب ان يكون اسماء الادوية اسماء تجارية باللغة الانجليزية مع الجرعات اللزمة
               
        //    ";

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
            
            يُفضل أن تتضمن أسماء الأدوية أسماء تجارية باللغة الإنجليزية وكتابتها بالغغة الانجليزية مع الجرعات اللازمة.
            يُرجى التأكد من تقديم الرد بالتنسيق المطلوب و توضيح كل نقطة بشكل دقيق ووافٍ.
        ";
          return $prompt;
        $client = OpenAI::client( getenv('OPEN_AI_TOKEN'));
        $result = $client->chat()->create([
                    'model' => 'gpt-3.5-turbo',
                    'messages' => [ ['role' => 'assistant', 'content' => $prompt], ],
                ]);

        $response=$result->choices[0]->message->content; 
        medicalDiagnosis::create([
            'InitialGiagnosis' => $response,
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
