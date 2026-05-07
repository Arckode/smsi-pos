<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuSubmodule extends Model
{
    use HasFactory;

    protected $table = 'menu_submodules';
    
    protected $primaryKey = 'sub_module_id'; // Specify the primary key

    protected $fillable = ['module_id', 'sub_module_name', 'url'];

    // Relationships
    public function module()
    {
        return $this->belongsTo(MenuModule::class, 'module_id');
    }

    public function permissions()
    {
        return $this->hasMany(MenuUserSubmodulePermission::class, 'sub_module_id', 'sub_module_id');
    }
}
