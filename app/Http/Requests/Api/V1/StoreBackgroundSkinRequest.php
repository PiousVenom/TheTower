<?php

declare(strict_types=1);

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     schema="StoreBackgroundSkinRequest",
 *     required={"name", "value"},
 *     description="Payload sent when creating a new BackgroundSkin",
 *
 *     @OA\Property(
 *         property="name",
 *         type="string",
 *         maxLength=191,
 *         example="Sunset"
 *     ),
 *     @OA\Property(
 *         property="value",
 *         type="number",
 *         format="float",
 *         example=0.5000
 *     )
 * )
 */
class StoreBackgroundSkinRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /** @return array<string,string> */
    public function messages(): array
    {
        return [
            'name.required'  => 'A name is required.',
            'name.unique'    => 'That background skin name is already taken.',
            'value.required' => 'A numeric value is required.',
            'value.numeric'  => 'The value must be a number.',
        ];
    }

    /** @return array<string,mixed> */
    public function rules(): array
    {
        return [
            'name'  => ['required', 'string', 'max:191', 'unique:background_skins,name'],
            'value' => ['required', 'numeric', 'between:0,9999.9999'],
        ];
    }
}
