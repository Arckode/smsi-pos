<?php

namespace App\Models\Batch;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DictBatchStatus extends Model
{
    use HasFactory;

    public function statuses(): HasMany
    {
        return $this->hasMany(Batch::class, 'status_id', 'id');
    }
}
