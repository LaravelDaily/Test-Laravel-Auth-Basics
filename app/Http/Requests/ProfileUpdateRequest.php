<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class ProfileUpdateRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'string', 'max:255', Rule::unique('users')->ignore(Auth::user())],
            'password' => ['sometimes', 'required_with:old_password', 'string', 'confirmed', 'min:8'],
        ];
    }

    public function authorize()
    {
        return true;
    }

    protected function prepareForValidation()
    {
        if ($this->password == null) {
            $this->request->remove('password');
        }
    }

    protected function passedValidation()
    {
        if ($this->has('password')) {
            $this->merge(['password' => Hash::make($this->password)]);
        }
    }

    public function validated(): array
    {
        if ($this->has('password')) {
            return array_merge(parent::validated(), ['password' => $this->input('password')]);
        }
        return parent::validated();
    }
}
