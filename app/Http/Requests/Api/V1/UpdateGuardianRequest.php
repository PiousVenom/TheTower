<?php

declare(strict_types=1);

namespace App\Http\Requests\Api\V1;

use App\Models\Guardian;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * @OA\Schema(
 *     schema="UpdateGuardianRequest",
 *     description="Payload for updating an existing Guardian. All fields optional.",
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
class UpdateGuardianRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /** @return array<string,string> */
    public function messages(): array
    {
        return [
            'name.unique'   => 'That guardian name is already taken.',
            'value.numeric' => 'The value must be a number.',
        ];
    }

    /** @return array<string,mixed> */
    public function rules(): array
    {
        /** @var Guardian|null $guardian */
        $guardian   = $this->route('guardian');
        $guardianId = $guardian?->id;

        return [
            'name'  => [
                'sometimes',
                'string',
                'max:191',
                Rule::unique('guardians', 'name')->ignore($guardianId),
            ],
            'value' => ['sometimes', 'numeric', 'between:0,9999.9999'],
        ];
    }
}
