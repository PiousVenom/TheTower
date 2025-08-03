<?php

declare(strict_types=1);

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;

class StoreBonusCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /** @return array<string,string> */
    public function messages(): array
    {
        return [
            'name.required' => 'A bonus category name is required.',
            'name.unique'   => 'That bonus category name is already taken.',
        ];
    }

    /** @return array<string,mixed> */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:191', 'unique:bonus_categories,name'],
        ];
    }
}
