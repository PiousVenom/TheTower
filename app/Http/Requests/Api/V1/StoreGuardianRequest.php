<?php

declare(strict_types=1);

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     schema="StoreGuardianRequest",
 *     required={"name", "value"},
 *     description="Payload sent when creating a new Guardian",
 *
 *     @OA\Property(
 *         property="name",
 *         type="string",
 *         maxLength=191,
 *         example="Epic Battle Theme"
 *     ),
 *     @OA\Property(
 *         property="value",
 *         type="number",
 *         format="float",
 *         example=0.006
 *     )
 * )
 */
class StoreGuardianRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /** @return array<string,string> */
    public function messages(): array
    {
        return [
            'name.required'  => 'A guardian name is required.',
            'name.unique'    => 'That guardian name is already taken.',
            'value.required' => 'A numeric value is required.',
            'value.numeric'  => 'The value must be a number.',
        ];
    }

    /** @return array<string,mixed> */
    public function rules(): array
    {
        return [
            'name'  => ['required', 'string', 'max:191', 'unique:guardians,name'],
            'value' => ['required', 'numeric', 'between:0,9999.9999'],
        ];
    }
}
