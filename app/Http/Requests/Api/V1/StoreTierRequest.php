<?php

declare(strict_types=1);

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     schema="StoreTierRequest",
 *     required={"name"},
 *
 *     @OA\Property(
 *         property="name",
 *         type="string",
 *         maxLength=191,
 *         example="Rare"
 *     )
 * )
 */
class StoreTierRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Add policies/gates here if needed
    }

    /** @return array<string,string> */
    public function messages(): array
    {
        return [
            'name.required' => 'A tier name is required.',
            'name.unique'   => 'This tier name already exists.',
        ];
    }

    /** @return array<string,mixed> */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:191', 'unique:tiers,name'],
        ];
    }
}
