<?php

namespace App\Models\Edocs;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EdocStatus extends Model
{
    use HasFactory;

    public function dictEdocStatus(): BelongsTo
    {
        return $this->belongsTo(DictEdocStatus::class, 'status_id', 'id');
    }

    public function edoc(): BelongsTo
    {
        return $this->belongsTo(Edoc::class, 'edoc_id', 'id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
