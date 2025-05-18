<?php

declare(strict_types=1);

namespace App\Http\Requests\Api\V1;

use App\Models\BackgroundSkin;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * @OA\Schema(
 *     schema="UpdateBackgroundSkinRequest",
 *     description="Payload for updating an existing BackgroundSkin. All fields optional.",
 *
 *     @OA\Property(
 *         property="name",
 *         type="string",
 *         maxLength=191,
 *         example="Interstellar"
 *     ),
 *     @OA\Property(
 *         property="value",
 *         type="number",
 *         format="float",
 *         example=0.7500
 *     ),
 *     @OA\Property(
 *         property="eventName",
 *         type="string",
 *         maxLength=191,
 *         example="Interstellar"
 *     )
 * )
 */
class UpdateBackgroundSkinRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /** @return array<string,string> */
    public function messages(): array
    {
        return [
            'name.unique'   => 'That background skin name is already taken.',
            'value.numeric' => 'The value must be a number.',
        ];
    }

    /** @return array<string,mixed> */
    public function rules(): array
    {
        /** @var BackgroundSkin|null $skin */
        $skin   = $this->route('background_skin');
        $skinId = $skin?->id;

        return [
            'name'  => [
                'sometimes',
                'string',
                'max:191',
                Rule::unique('background_skins', 'name')->ignore($skinId),
            ],
            'value' => ['sometimes', 'numeric', 'between:0,9999.9999'],
        ];
    }
}
