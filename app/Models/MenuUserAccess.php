<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuUserAccess extends Model
{
    use HasFactory;

    protected $table = 'menu_user_access';

    protected $fillable = ['user_id', 'module_id', 'sub_module_ids'];

    protected $casts = [
        'sub_module_ids' => 'array',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class); // Assuming you have a User model
    }

    public function module()
    {
        return $this->belongsTo(MenuModule::class, 'module_id');
    }

    public function subModules()
    {
        return MenuSubmodule::whereIn('sub_module_id', $this->sub_module_ids)->get();
    }

    public function getModulesAttribute()
    {
        return MenuModule::find($this->module_id);
    }

    public function getSubModulesAttribute()
    {
        $subModuleIds = $this->sub_module_ids;
        return MenuSubmodule::whereIn('sub_module_id', $subModuleIds)->get();
    }
}
