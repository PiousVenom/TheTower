<?php

declare(strict_types=1);

namespace App\Http\Requests\Api\V1;

use App\Models\Relic;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * @OA\Schema(
 *     schema="UpdateRelicRequest",
 *     description="Any subset of fields may be supplied to update the relic.",
 *
 *     @OA\Property(property="name",           type="string",  maxLength=191, example="No Spoon Mk II"),
 *     @OA\Property(property="tier_id",        type="integer", minimum=1,     example=3),
 *     @OA\Property(property="bonus_type_id",  type="integer", minimum=1,     example=12),
 *     @OA\Property(property="value",          type="number",  format="float", example=0.05),
 *     @OA\Property(property="unlock_condition", type="string", nullable=true,
 *     example="Earn 700 medals Matrix event")
 * )
 */
class UpdateRelicRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Validation rules for creating a relic.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        /** @var Relic|null $relic */
        $relic   = $this->route('relic');   // tell PHPStan it’s a Relic (or null)
        $relicId = $relic?->id;             // null-safe; OK for create tests too

        return [
            'name'             => ['sometimes', 'string', 'max:191', Rule::unique('relics', 'name')->ignore($relicId)],
            'tier_id'          => ['sometimes', 'exists:tiers,id'],
            'bonus_type_id'    => ['sometimes', 'exists:bonus_types,id'],
            'value'            => ['sometimes', 'numeric', 'between:0,9999.9999'],
            'unlock_condition' => ['nullable', 'string'],
        ];
    }
}
