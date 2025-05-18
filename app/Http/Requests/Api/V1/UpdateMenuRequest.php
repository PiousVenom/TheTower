<?php

declare(strict_types=1);

namespace App\Http\Requests\Api\V1;

use App\Models\Menu;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * @OA\Schema(
 *     schema="UpdateMenuRequest",
 *     description="Payload for updating an existing Menu. All fields optional.",
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
class UpdateMenuRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /** @return array<string,string> */
    public function messages(): array
    {
        return [
            'name.unique'   => 'That menu name is already taken.',
            'value.numeric' => 'The value must be a number.',
        ];
    }

    /** @return array<string,mixed> */
    public function rules(): array
    {
        /** @var Menu|null $menu */
        $menu   = $this->route('menu');
        $menuId = $menu?->id;

        return [
            'name'  => [
                'sometimes',
                'string',
                'max:191',
                Rule::unique('menus', 'name')->ignore($menuId),
            ],
            'value' => ['sometimes', 'numeric', 'between:0,9999.9999'],
        ];
    }
}
