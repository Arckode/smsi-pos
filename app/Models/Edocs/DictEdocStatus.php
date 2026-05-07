<?php

namespace App\Models\Edocs;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DictEdocStatus extends Model
{
    use HasFactory;

    public function statuses(): HasMany
    {
        return $this->hasMany(EdocStatus::class, 'status_id', 'id');
    }
}
