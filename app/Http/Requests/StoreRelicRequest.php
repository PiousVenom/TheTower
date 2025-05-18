<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRelicRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // add policies/gates if needed
    }

    /**
     * Custom error messages for required fields.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required'          => 'A relic name is required.',
            'tier_id.required'       => 'Please select a tier for the relic.',
            'bonus_type_id.required' => 'Please choose a bonus type for the relic.',
            'value.required'         => 'A bonus value (numeric) is required.',
        ];
    }

    /**
     * Validation rules for creating a relic.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name'             => ['required', 'string', 'max:191', 'unique:relics,name'],
            'tier_id'          => ['required', 'exists:tiers,id'],
            'bonus_type_id'    => ['required', 'exists:bonus_types,id'],
            'value'            => ['required', 'numeric', 'between:0,9999.9999'],
            'unlock_condition' => ['nullable', 'string'],
        ];
    }
}
