<?php

namespace App\Models\Batch;

use App\Models\Edocs\Edoc;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BatchDetail extends Model
{
    use HasFactory;

    protected $hidden = ['created_at', 'updated_at'];

    public function batch(): BelongsTo
    {
        return $this->belongsTo(Batch::class, 'batch_id', 'id');
    }

    public function edoc(): BelongsTo
    {
        return $this->belongsTo(Edoc::class, 'edoc_id', 'id');
    }
}
