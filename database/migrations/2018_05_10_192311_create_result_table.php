<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreateResultTable extends Migration
{
    public function up()
    {
        Schema::create('result', function (Blueprint $table)
        {
            $table->increments('id');
            $table->integer('score')    ->nullable();
            $table->integer('team_id')  ->unsigned();
            $table->foreign('team_id')  ->references('id')->on('team');
            $table->integer('motm')     ->nullable()->unsigned();
            $table->foreign('motm')     ->references('id')->on('user');
        });
    }
    public function down()
    {
        Schema::dropIfExists('result');
    }
}
