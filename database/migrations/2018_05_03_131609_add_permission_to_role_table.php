<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class AddPermissionToRoleTable extends Migration
{
    public function up()
    {
        Schema::table('role', function (Blueprint $table) {
            $table->integer('permission');
        });
    }
}
