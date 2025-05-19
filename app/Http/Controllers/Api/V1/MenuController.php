<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StoreMenuRequest;
use App\Http\Requests\Api\V1\UpdateMenuRequest;
use App\Http\Resources\Api\V1\MenuCollection;
use App\Http\Resources\Api\V1\MenuResource;
use App\Models\Menu;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * @OA\Tag(
 *     name="Menus"
 * )
 */
class MenuController extends Controller
{
    public function destroy(Menu $menu): Response
    {
        $menu->delete();

        return response()->noContent();
    }

    /**
     * List menus (paginated).
     *
     * @OA\Get(
     *     path="/menus",
     *     summary="List menus",
     *     tags={"Menus"},
     *
     *     @OA\Response(
     *         response=200,
     *         description="Paginated list of menus",
     *
     *         @OA\JsonContent(ref="#/components/schemas/MenuCollection")
     *     )
     * )
     */
    public function index(): MenuCollection
    {
        return new MenuCollection(Menu::paginate(50));
    }

    public function restore(int|string $id): JsonResponse
    {
        $menu = Menu::withTrashed()->findOrFail($id);

        if (!$menu->trashed()) {
            return response()->json(
                ['message' => 'Menu is not deleted.'],
                Response::HTTP_CONFLICT
            );
        }

        $menu->restore();

        return response()->json(
            new MenuResource($menu)
        );
    }

    /**
     * Retrieve a single menu.
     *
     * @OA\Get(
     *     path="/menus/{id}",
     *     summary="Get a menu",
     *     tags={"Menus"},
     *
     *     @OA\Parameter(
     *         name="id", in="path", required=true,
     *
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Menu detail",
     *
     *         @OA\JsonContent(ref="#/components/schemas/MenuResource")
     *     ),
     *
     *     @OA\Response(response=404, description="Not found")
     * )
     */
    public function show(Menu $menu): MenuResource
    {
        return new MenuResource($menu);
    }

    public function store(StoreMenuRequest $request): JsonResponse
    {
        $menu = Menu::create($request->validated());

        return response()->json(
            new MenuResource($menu),
            Response::HTTP_CREATED
        );
    }

    public function update(UpdateMenuRequest $request, Menu $menu): JsonResponse
    {
        $menu->update($request->validated());

        return response()->json(
            new MenuResource($menu->refresh())
        );
    }
}
