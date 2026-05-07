<?php

namespace App\Models\Edocs;

use App\Models\Batch\BatchDetail;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Storage;

class Edoc extends Model
{
    use HasFactory;

    protected $hidden = ['created_at', 'updated_at'];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($model) {
            foreach ($model->details as $detail) {
                if (Storage::exists($detail->getRawOriginal('file'))) {
                    Storage::delete($detail->getRawOriginal('file'));
                }
                $detail->delete();
            }
            $model->statuses()->delete();
        });
    }

    public function details(): HasMany
    {
        return $this->hasMany(EdocDetail::class, 'edoc_id', 'id');
    }

    public function statuses(): HasMany
    {
        return $this->hasMany(EdocStatus::class, 'edoc_id', 'id');
    }

    public function status(): HasOne
    {
        return $this->hasOne(EdocStatus::class, 'edoc_id', 'id')->orderBy('created_at', 'desc')->orderBy('id', 'desc');
    }

    public function logs(): HasMany
    {
        return $this->hasMany(LogEdocs::class, 'ref_id', 'id');
    }

    public function batchDetails(): HasMany
    {
        return $this->hasMany(BatchDetail::class, 'edoc_id', 'id');
    }

    public function unit(): BelongsTo
    {
        return $this->belongsTo(Unit::class, 'unit_id', 'id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
