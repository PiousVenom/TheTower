<?php

declare(strict_types=1);

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateLabRequest extends FormRequest
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
            'lab_category_id' => ['sometimes', 'exists:lab_categories,id'],
            'name' => ['sometimes', 'string', 'max:191', Rule::unique('labs', 'name')->ignore($this->lab->id)],
            'description' => ['nullable', 'string'],
        ];
    }
}
