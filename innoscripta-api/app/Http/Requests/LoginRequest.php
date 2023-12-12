<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'email' => 'required|string|email|exists:users,email',
            'password' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'email.required'=>'please enter email',
            'email.string'=>'email should be string',
            'email.email'=>'email format is wrong',
            'email.exists'=>'email not found',
            'email.unique'=>'email is duplicate',
            'password.required'=>'please enter password',
            'password.string'=>'password must be string',
        ];
    }
}
