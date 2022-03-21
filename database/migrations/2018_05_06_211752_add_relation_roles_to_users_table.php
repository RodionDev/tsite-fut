<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class AddRelationRolesToUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
        });
    }
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->foreign('role_id')  ->references('id')->on('roles');
        });
    }
}
