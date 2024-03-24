<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class VehiculeFormRequest extends FormRequest
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
            'matricule' => ['required', 'string', 'max:255',
                Rule::unique('vehicules', 'matricule')->ignore($this->vehicule)
            ],
            'image' => ['nullable', 'image', 'mimes:jpeg,jpg,png,gif', 'max:2048'],
            'date_achat' => ['required', 'string'],
            'km_defaut' => ['required', 'integer', 'min:0'],
            'km_actuel' => ['nullable', 'integer', 'min:0'],
            'category_id' => ['required', 'integer', Rule::exists('categories', 'id')],
            'user_id' => ['nullable', 'integer',
                Rule::exists('users', 'id')->where('role_id', 3)
            ],
            'status' => ['nullable', 'string'],
        ];
    }
}
