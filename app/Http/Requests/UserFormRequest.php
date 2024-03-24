<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    const MAX = "max:255";

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'nom' => ['required', 'string', self::MAX],
            'prenom' => ['required', 'string', self::MAX],
            'email' => ['required', 'string', 'email', self::MAX, Rule::unique('users')->ignore($this->user)],
            'password' => ['nullable', 'string', 'min:8'],
            'confirm_password' => ['nullable', 'string', 'min:8', 'same:password'],
            'role_id' => ['nullable', 'integer', Rule::exists('roles', 'id')],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'telephone' => ['required', 'string', self::MAX],
            'adresse' => ['required', 'string', self::MAX],
        ];
    }
}
