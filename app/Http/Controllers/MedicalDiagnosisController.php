<?php

namespace App\Http\Controllers;

use App\Models\medicalDiagnosis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use OpenAI;

class MedicalDiagnosisController extends Controller
{
 

    public function getAIDiagnosis(Request $request)
    {
         $prompt = " $request->symptoms كمساعد في تشخيص الامراض الطبية لطبيب مختص  وكان قد جاءت حالة مرضية تعاني من  
        : اكتب رد  بحيث يكون كالتالي
                     1 - json  ان تكون الاستجابة  بصيغة
                    2-  ان يكون الرد بنفس هذه الترتيب
                    الامراض المتوقعة :  [array]
                    المرض المرجح :[string]
                        التشخيص : [string] 
                    الفحوصات المطلوبة: [array]
                     الادوية المقترحة :  [array]
                     النصيحة الطبية :   [string]
      
                3- يحب ان يكون اسماء الادوية اسماء تجارية باللغة الانجليزية مع الجرعات اللزمة
               
           ";
          
        $client = OpenAI::client( getenv('OPEN_AI_TOKEN'));
        $result = $client->chat()->create([
                    'model' => 'gpt-3.5-turbo',
                    'messages' => [ ['role' => 'system', 'content' => $prompt], ],
                ]);

        $response=$result->choices[0]->message->content; 
        return response($response);
    }

   
}
