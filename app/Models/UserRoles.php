<?php

namespace App\Models;

use App\Models\Edocs\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UserRoles extends Model
{
    use HasFactory;

    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'role_id', 'id');
    }

    // public function edocs(): HasMany
    // {
    //     return $this->hasMany(Edoc::class, 'unit_id', 'id');
    // }
}
