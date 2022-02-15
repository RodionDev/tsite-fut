<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreateTeamTable extends Migration
{
    public function up()
    {
        Schema::create('team', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('logo')            ->nullable();
            $table->integer('leader_id')      ->unsigned();
            $table->foreign('leader_id')      ->references('id')->on('user');
        });
    }
    public function down()
    {
        Schema::dropIfExists('team');
    }
}
