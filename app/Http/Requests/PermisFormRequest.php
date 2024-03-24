<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PermisFormRequest extends FormRequest
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
            'user_id' => 'required|exists:users,id',
            'category_id' => 'required|exists:categories,id',
            'num_permis' => 'required|string|max:255',
            'delivrance' => 'required|string',
            'expiration' => 'required|string',
            'annee_experience' => 'required|integer|min:0',
        ];
    }
}
