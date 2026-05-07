<?php

namespace App\Models\Edocs;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class EdocDetail extends Model
{
    use HasFactory;

    protected $hidden = ['created_at', 'updated_at'];

    public function edoc(): BelongsTo
    {
        return $this->belongsTo(Edoc::class, 'edoc_id', 'id');
    }

    public function file(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ? asset(Storage::url($value)) : asset(url('images/no_content.jpg')),
        );
    }
}
