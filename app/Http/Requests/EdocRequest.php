<?php

namespace App\Http\Requests;

use App\Enums\EdocCategory;
use App\Rules\UpdateFileRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\Rule;
use Illuminate\Contracts\Validation\Validator;

class EdocRequest extends FormRequest
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
        $categoryValues = array_map(fn($case) => $case->value, EdocCategory::cases());

        return [
            'number' => $this->isMethod('POST') ? 'required|unique:edocs,number' : 'nullable',
            'label' => $this->isMethod('POST') ? 'required|unique:edocs,label' :  ['required', Rule::unique('edocs', 'label')->ignore($this->route('edoc'))],
            'description' => 'nullable',
            'category_id' => ['required', Rule::in($categoryValues)],
            'status_id' => 'required|exists:dict_edoc_statuses,id',
            'details' => 'required|array',
            'details.*.id' => 'nullable',
            'details.*.label' => 'required',
            'details.*.description' => 'nullable',
            'details.*.nominal' => 'nullable',
            'details.*.checked' => $this->isMethod('POST') ? 'nullable' : 'required',
            'details.*.file' => $this->isMethod('POST') ? 'nullable|mimes:jpeg,png,jpg,pdf' : ['nullable', new UpdateFileRule],
        ];
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
