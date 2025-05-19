<?php

declare(strict_types=1);

namespace App\Http\Requests\Api\V1;

use App\Models\ProfileBanner;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * @OA\Schema(
 *     schema="UpdateProfileBannerRequest",
 *     description="Payload for updating an existing ProfileBanner. All fields optional.",
 *
 *     @OA\Property(
 *         property="name",
 *         type="string",
 *         maxLength=191,
 *         example="Epic Battle Theme Remix"
 *     ),
 *     @OA\Property(
 *         property="value",
 *         type="number",
 *         format="float",
 *         example=0.007
 *     )
 * )
 */
class UpdateProfileBannerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /** @return array<string,string> */
    public function messages(): array
    {
        return [
            'name.unique'   => 'That profile banner name is already taken.',
            'value.numeric' => 'The value must be a number.',
        ];
    }

    /** @return array<string,mixed> */
    public function rules(): array
    {
        /** @var ProfileBanner|null $profileBanner */
        $profileBanner   = $this->route('profileBanner');
        $profileBannerId = $profileBanner?->id;

        return [
            'name'  => [
                'sometimes',
                'string',
                'max:191',
                Rule::unique('profileBanners', 'name')->ignore($profileBannerId),
            ],
            'value' => ['sometimes', 'numeric', 'between:0,9999.9999'],
        ];
    }
}
