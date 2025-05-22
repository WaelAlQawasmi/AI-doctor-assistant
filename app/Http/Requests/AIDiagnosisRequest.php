<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AIDiagnosisRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return auth()->check(); // Or apply policy
    }

    public function rules()
    {
        return [
            'gender' => 'required|string',
            'symptoms' => 'required|string',
            'history' => 'nullable|string',
            'affectFactors' => 'nullable|string',
            'oldResults' => 'nullable|string',
            'AdvancedReponse' => 'nullable|boolean'
        ];
    }
}
