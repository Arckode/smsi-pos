<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('menu_user_submodule_permissions', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('sub_module_id');
            $table->boolean('can_create')->default(false);
            $table->boolean('can_read')->default(false);
            $table->boolean('can_update')->default(false);
            $table->boolean('can_delete')->default(false);
            $table->timestamps();

            $table->unique(['user_id', 'sub_module_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('menu_user_submodule_permissions');
    }
};
