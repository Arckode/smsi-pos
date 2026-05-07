<?php

namespace App\Http\Requests;

use App\Rules\UpdateFileRule;
use Illuminate\Validation\Rule;
use Illuminate\Http\JsonResponse;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class UserRequest extends FormRequest
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
        $rule = [
            'unit_id' => 'required|exists:units,id',
            'name' => 'required',
            'email' => $this->isMethod('POST') ? 'required|unique:users,email' :  ['required', Rule::unique('users', 'email')->ignore($this->route('user'))],
            'picture' => $this->isMethod('POST') ? 'nullable|mimes:jpeg,png,jpg' : ['nullable', new UpdateFileRule],
            'erp' => $this->isMethod('POST') ? 'required' : 'nullable',
        ];

        if ($this->isMethod('POST')) {
            $rule['password'] = 'required|confirmed|min:8';
        }

        return $rule;
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
