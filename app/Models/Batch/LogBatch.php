<?php

namespace App\Models\Batch;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LogBatch extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'date', 'action', 'old_payload', 'new_payload', 'ref_id', 'request', 'status_code', 'response'];

    public $timestamps = false;

    public function batch(): BelongsTo
    {
        return $this->belongsTo(Batch::class, 'ref_id', 'id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
