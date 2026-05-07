<?php

namespace App\Models\Edocs;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LogEdocs extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'date', 'action', 'old_payload', 'new_payload', 'ref_id', 'request', 'status_code', 'response'];

    public $timestamps = false;

    public function edoc(): BelongsTo
    {
        return $this->belongsTo(Edoc::class, 'ref_id', 'id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
