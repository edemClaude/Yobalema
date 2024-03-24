<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LocationFormRequest extends FormRequest
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
            'heure_depart' => ['required', 'string'],
            'lieu_depart' => ['required', 'string', 'max:255'],
            'lieu_arrivee' => ['required', 'string', 'max:255'],
            'date' => ['required', 'string'],
            'type_voiture' => ['required', 'integer'],
        ];
    }
}
