<?php

namespace App\Http\Requests;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\Rule;

class BatchRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'resi' => $this->isMethod('POST') ? 'nullable|unique:batches,resi' : ['nullable'],
            'label' => 'required',
            'description' => 'nullable',
            'status_id' => 'required|exists:dict_batch_statuses,id',
            'details' => 'required|array',
            'details.*' => 'required|exists:edocs,id'
        ];
    }

    protected function prepareForValidation()
    {

        $details = $this->input('details');

        if (is_string($details)) {
            $this->merge([
                'details' => json_decode($details)
            ]);
        } else {
            $this->merge([
                'details' => $details
            ]);
        }
    }

    /**
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function failedValidation(Validator $validator): JsonResponse
    {
        throw new HttpResponseException(response()->json([
            "status" => false,
            "message" => $validator->errors(),
        ], 400));
    }
}
