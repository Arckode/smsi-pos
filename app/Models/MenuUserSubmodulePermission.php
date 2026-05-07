<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuUserSubmodulePermission extends Model
{
    use HasFactory;

    protected $table = 'menu_user_submodule_permissions';

    protected $fillable = [
        'user_id',
        'sub_module_id',
        'can_create',
        'can_read',
        'can_update',
        'can_delete',
    ];

    protected $casts = [
        'can_create' => 'boolean',
        'can_read' => 'boolean',
        'can_update' => 'boolean',
        'can_delete' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function subModule()
    {
        return $this->belongsTo(MenuSubmodule::class, 'sub_module_id', 'sub_module_id');
    }

    public function getActionsAttribute(): array
    {
        $actions = [];

        if ($this->can_read) {
            $actions[] = 'read';
        }
        if ($this->can_create) {
            $actions[] = 'create';
        }
        if ($this->can_update) {
            $actions[] = 'update';
        }
        if ($this->can_delete) {
            $actions[] = 'delete';
        }

        return $actions;
    }

    public function hasAction(string $action): bool
    {
        return in_array($action, $this->actions, true);
    }
}
