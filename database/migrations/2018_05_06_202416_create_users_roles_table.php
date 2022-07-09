<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreateUsersRolesTable extends Migration
{
    public function up()
    {
        Schema::create('users_roles', function (Blueprint $table) {
            $table->integer('user_id');
            $table->integer('role_id');
        });
    }
    public function down()
    {
        Schema::dropIfExists('users_roles');
    }
}
