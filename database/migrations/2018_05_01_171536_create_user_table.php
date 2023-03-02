<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreateUserTable extends Migration
{
    public function up()
    {
        Schema::create('user', function (Blueprint $table)
        {
            $table->increments('id');
            $table->integer('role_id')          ->unsigned();
            $table->foreign('role_id')          ->references('id')->on('role');
            $table->string('email')             ->unique();
            $table->string('first_name')        ->nullable();
            $table->string('sur_name')          ->nullable();
            $table->string('password')          ->nullable();
            $table->dateTime('last_seen')       ->nullable();
            $table->string('avatar')            ->nullable();
            $table->string('register_token')    ->nullable();
            $table->rememberToken();
        });
    }
    public function down()
    {
        Schema::dropIfExists('user');
    }
}
