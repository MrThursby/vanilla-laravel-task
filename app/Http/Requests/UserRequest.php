<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $unique = Rule::unique('users');

        if($this->method === 'patch' || $this->isMethod('put'))
            $unique = $unique->ignore($this->route('user'));

        return [
            'name' => 'required|string|min:3|max:255',
            'car_id' => ['numeric', 'exists:cars,id', $unique, 'nullable'],
        ];
    }
}
