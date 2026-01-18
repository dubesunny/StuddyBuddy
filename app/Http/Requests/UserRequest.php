<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
        $rules = [
            'name'   => 'required|string|max:255',

            'role'   => 'required',

            'gender' => 'required',

            'status' => 'required',

            'image'  => 'nullable|image|mimes:jpg,png|max:2048',
        ];

        if ($this->isMethod('post')) {
            $rules['password'] = [
                'required',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&#]).{8,}$/',
            ];
            $rules['email'] = 'required|email|unique:users,email';
            $rules['phone']  = 'required|regex:/^[6-9]\d{9}$/|unique:users,phone';
        }

        if ($this->isMethod('put')) {
            $rules['password'] = [
                'nullable',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&#]).{8,}$/',
            ];
            $rules['email'] =  'required|email|unique:users,email,' .$this->user->id;
            $rules['phone'] = 'required|regex:/^[6-9]\d{9}$/|unique:users,phone,' .$this->user->id;
        }

        return $rules;
    }
}
