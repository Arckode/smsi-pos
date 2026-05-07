<?php

namespace App\Models\Batch;

use App\Models\Edocs\EdocStatus;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Batch extends Model
{
    use HasFactory;

    protected $hidden = ['created_at', 'updated_at'];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($model) {
            if ($model->details) {
                foreach ($model->details as $detail) {
                    EdocStatus::where('edoc_id', $detail->edoc_id)->orderBy('created_at', 'DESC')->first()->delete();
                }
            }

            $model->details()->delete();
            $model->statuses()->delete();
        });
    }

    public function details(): HasMany
    {
        return $this->hasMany(BatchDetail::class, 'batch_id', 'id');
    }

    public function statuses(): HasMany
    {
        return $this->hasMany(BatchStatus::class, 'batch_id', 'id');
    }

    public function status(): HasOne
    {
        return $this->hasOne(BatchStatus::class, 'batch_id', 'id')->latest('created_at');
    }

    public function logs(): HasMany
    {
        return $this->hasMany(LogBatch::class, 'ref_id', 'id');
    }
}
