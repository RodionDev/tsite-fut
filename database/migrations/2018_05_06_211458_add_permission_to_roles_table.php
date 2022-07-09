<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class AddPermissionToRolesTable extends Migration
{
    public function up()
    {
        Schema::table('roles', function (Blueprint $table) {
        });
    }
    public function down()
    {
        Schema::table('roles', function (Blueprint $table) {
            $table->integer('permission');
        });
    }
}
