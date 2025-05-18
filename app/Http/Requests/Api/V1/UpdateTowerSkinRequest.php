<?php

declare(strict_types=1);

namespace App\Http\Requests\Api\V1;

use App\Models\TowerSkin;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * @OA\Schema(
 *     schema="UpdateTowerSkinRequest",
 *     description="Payload for updating an existing TowerSkin. All fields optional.",
 *
 *     @OA\Property(
 *         property="name",
 *         type="string",
 *         maxLength=191,
 *         example="Celestial Tower Deluxe"
 *     ),
 *     @OA\Property(
 *         property="value",
 *         type="number",
 *         format="float",
 *         example=0.8500
 *     ),
 *     @OA\Property(
 *         property="eventName",
 *         type="string",
 *         nullable=true,
 *         example="Guild Season Finale"
 *     )
 * )
 */
class UpdateTowerSkinRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /** @return array<string,string> */
    public function messages(): array
    {
        return [
            'name.unique'   => 'That tower-skin name is already taken.',
            'value.numeric' => 'The value must be a number.',
        ];
    }

    /** @return array<string,mixed> */
    public function rules(): array
    {
        /** @var TowerSkin|null $skin */
        $skin   = $this->route('tower_skin');
        $skinId = $skin?->id;

        return [
            'name'      => [
                'sometimes',
                'string',
                'max:191',
                Rule::unique('tower_skins', 'name')->ignore($skinId),
            ],
            'value'     => ['sometimes', 'numeric', 'between:0,9999.9999'],
            'eventName' => ['sometimes', 'string', 'max:255'],
        ];
    }
}
