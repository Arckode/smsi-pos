<?php

namespace App\Http\Traits;

use Exception;
use Illuminate\Database\Eloquent\Model;

trait LogTrait
{
    public function storeLog(Model $model, array $data): void
    {
        try {
            $model::create($data);

            return;
        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
