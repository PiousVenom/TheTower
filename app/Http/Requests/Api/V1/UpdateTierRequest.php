<?php

declare(strict_types=1);

namespace App\Http\Requests\Api\V1;

use App\Models\Tier;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * @OA\Schema(
 *     schema="UpdateTierRequest",
 *     description="Any subset of fields may be supplied to update the tier.",
 *
 *     @OA\Property(
 *         property="name",
 *         type="string",
 *         maxLength=191,
 *         example="Epic"
 *     )
 * )
 */
class UpdateTierRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /** @return array<string,string> */
    public function messages(): array
    {
        return [
            'name.unique' => 'This tier name is already in use.',
        ];
    }

    /** @return array<string,mixed> */
    public function rules(): array
    {
        /** @var Tier|null $tier */
        $tier   = $this->route('tier');
        $tierId = $tier?->id;

        return [
            'name' => [
                'sometimes',
                'string',
                'max:191',
                Rule::unique('tiers', 'name')->ignore($tierId),
            ],
        ];
    }
}
