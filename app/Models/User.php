<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Models\Edocs\EdocStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'unit_id',
        'name',
        'role_id',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function unit(): BelongsTo
    {
        return $this->belongsTo(Unit::class, 'unit_id', 'id');
    }

    public function picture(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $value ? asset(Storage::url($value)) : asset(url('profile_pictures/default.jpg')),
        );
    }

    public function role()
    {
        return $this->belongsTo(UserRoles::class, 'role_id', 'id');
    }

    public function menuUserAccess()
    {
        return $this->hasMany(MenuUserAccess::class)
            ->with([
                'module' => function ($query) {
                    $query->with('subModules');
                }
            ]);
    }

    public function submodulePermissions()
    {
        return $this->hasMany(MenuUserSubmodulePermission::class, 'user_id');
    }

    public function canSubmoduleAction(int $subModuleId, string $action): bool
    {
        return $this->submodulePermissions
            ->where('sub_module_id', $subModuleId)
            ->first()?->hasAction($action) ?? false;
    }
}
