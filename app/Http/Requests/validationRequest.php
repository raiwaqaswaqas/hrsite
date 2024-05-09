<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class validationRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:companies',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
           
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Company name is required.',
            'email.required' => 'Company email is required.',
            'email.email' => 'Please enter a valid email address.',
           
        ];
    }
}
