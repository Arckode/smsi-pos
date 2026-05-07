<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuModule extends Model
{
    use HasFactory;

    protected $table = 'menu_modules';

    protected $primaryKey = 'module_id'; // Specify the primary key

    protected $fillable = ['name', 'url', 'icon'];

    // Relationships
    public function subModules()
    {
        return $this->hasMany(MenuSubmodule::class, 'module_id');
    }

    public function userAccesses()
    {
        return $this->hasMany(MenuUserAccess::class, 'module_id');
    }
}
