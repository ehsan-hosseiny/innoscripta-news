<?php

namespace App\Http\Requests;

use App\Http\Rule\PreferenceValidation;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AddPreferenceRequest extends FormRequest
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
        $request = $this->request->all();
        $rule["type"] = ['required',Rule::in(['category', 'author', 'source'])];
        $rule["preference"] = ['required',new PreferenceValidation($request['type'])];

        return $rule;
    }

    public function messages()
    {
        return[
            'type.required'=>'please enter type',
            'preference.required'=>'please enter preference',
            'type.in'=>'The selected type is invalid.',
        ];

    }
}
