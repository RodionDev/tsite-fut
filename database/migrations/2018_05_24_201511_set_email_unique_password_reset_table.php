<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class SetEmailUniquePasswordResetTable extends Migration
{
    public function up()
    {
        Schema::table('password_reset', function (Blueprint $table)
        {
            $table->unique('email');
        });
    }
}
