<?php

declare(strict_types=1);

namespace App\Http\Requests\Api\V1;

use App\Models\BonusType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * @OA\Schema(
 *     schema="UpdateBonusTypeRequest",
 *     description="Any subset of fields may be supplied to update the bonus type.",
 *
 *     @OA\Property(property="name",  type="string",  maxLength=191, example="Defense Absolute Plus"),
 *     @OA\Property(
 *         property="unit",
 *         type="string",
 *         enum={"percentage", "flat", "seconds"},
 *         example="flat"
 *     ),
 *     @OA\Property(
 *         property="bonus_category_id",
 *         type="integer",
 *         example=2
 *     )
 * )
 */
class UpdateBonusTypeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /** @return array<string,string> */
    public function messages(): array
    {
        return [
            'name.unique'              => 'This bonus-type name is already taken.',
            'unit.in'                  => 'Unit must be percentage, flat, or seconds.',
            'bonus_category_id.exists' => 'The specified category does not exist.',
        ];
    }

    /** @return array<string,mixed> */
    public function rules(): array
    {
        /** @var BonusType|null $bonusType */
        $bonusType   = $this->route('bonus_type');
        $bonusTypeId = $bonusType?->id;

        return [
            'name'  => [
                'sometimes',
                'string',
                'max:191',
                Rule::unique('bonus_types', 'name')->ignore($bonusTypeId),
            ],
            'unit'              => ['sometimes', 'in:percentage,flat,seconds'],
            'bonus_category_id' => ['sometimes', 'exists:bonus_categories,id'],
        ];
    }
}
