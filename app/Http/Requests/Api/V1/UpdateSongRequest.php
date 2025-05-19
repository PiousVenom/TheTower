<?php

declare(strict_types=1);

namespace App\Http\Requests\Api\V1;

use App\Models\Song;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * @OA\Schema(
 *     schema="UpdateSongRequest",
 *     description="Payload for updating an existing Song. All fields optional.",
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
class UpdateSongRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /** @return array<string,string> */
    public function messages(): array
    {
        return [
            'name.unique'   => 'That song name is already taken.',
            'value.numeric' => 'The value must be a number.',
        ];
    }

    /** @return array<string,mixed> */
    public function rules(): array
    {
        /** @var Song|null $song */
        $song   = $this->route('song');
        $songId = $song?->id;

        return [
            'name'  => [
                'sometimes',
                'string',
                'max:191',
                Rule::unique('songs', 'name')->ignore($songId),
            ],
            'value' => ['sometimes', 'numeric', 'between:0,9999.9999'],
        ];
    }
}
