<?php

declare(strict_types=1);

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     schema="StoreBonusTypeRequest",
 *     required={"name", "unit", "bonus_category_id"},
 *
 *     @OA\Property(
 *         property="name",
 *         type="string",
 *         maxLength=191,
 *         example="Defense Absolute"
 *     ),
 *     @OA\Property(
 *         property="unit",
 *         type="string",
 *         description="How the value is interpreted",
 *         enum={"percentage", "flat", "seconds"},
 *         example="percentage"
 *     ),
 *     @OA\Property(
 *         property="bonus_category_id",
 *         type="integer",
 *         description="Category this bonus belongs to",
 *         example=1
 *     )
 * )
 */
class StoreBonusTypeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // add policies if needed later
    }

    /** @return array<string,string> */
    public function messages(): array
    {
        return [
            'name.required'             => 'A bonus-type name is required.',
            'unit.required'             => 'Please specify the unit (percentage, flat, seconds).',
            'bonus_category_id.required'=> 'A category is required.',
        ];
    }

    /** @return array<string,mixed> */
    public function rules(): array
    {
        return [
            'name'              => ['required', 'string', 'max:191', 'unique:bonus_types,name'],
            'unit'              => ['required', 'in:percentage,flat,seconds'],
            'bonus_category_id' => ['required', 'exists:bonus_categories,id'],
        ];
    }
}
