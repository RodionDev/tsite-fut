<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreatePasswordResetTable extends Migration
{
    public function up()
    {
        Schema::create('password_reset', function (Blueprint $table) {
            $table->string('email')->index();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });
    }
    public function down()
    {
        Schema::dropIfExists('password_reset');
    }
}
