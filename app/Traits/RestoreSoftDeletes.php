<?php

declare(strict_types=1);

namespace App\Traits;

trait RestoreSoftDeletes
{
    /* ---------------------------------------------------------------------
     |  Restore  –  PATCH /api/v1/{model}s/{model}/restore
     |---------------------------------------------------------------------*/
    public function restore($id)
    {
        $model = $this->model::withTrashed()->findOrFail($id);

        if (!$model->trashed()) {
            return response()->json(
                ['message' => class_basename($this->model).' is not deleted.'],
                409
            );
        }

        $model->restore();

        return new ($this->resource)($model);
    }
}
