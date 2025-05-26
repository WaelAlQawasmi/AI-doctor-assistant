<?php


namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AIDiagnosisRequest;
use App\Models\User;
use App\Services\AIDiagnosisService;
use Exception;

class MedicalDiagnosisController extends Controller
{

    public function __construct(private AIDiagnosisService $service)
    {
        $this->service = $service;
    }

    /**
     * action to get   medical Diagnosis based on user input from openAI LLM.
     */

    public function getBasicAIDiagnosis(AIDiagnosisRequest $request)
    {
        try {
            $this->authorize('BasicAIDiagnosis', [User::class, $request->AdvancedReponse]);

            $result = $this->service->generateDiagnosis($request->validated());

            return  response()->json( $result  );
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'تشخيص الذكاء الاصطناعي فشل.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
