<?php

declare(strict_types=1);

namespace App\Http\Requests\Api\V1;

use App\Models\Relic;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
