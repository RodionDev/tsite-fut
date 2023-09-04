<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreateMatchTable extends Migration
{
    public function up()
    {
        Schema::create('match', function (Blueprint $table)
        {
            $table->increments('id');
            $table->boolean('has_ended');   
            $table->dateTime('start')       ->nullable();  
            $table->integer('field')        ->nullable();   
            $table->integer('tournament_id')    ->unsigned();
            $table->foreign('tournament_id')    ->references('id')->on('tournament');
            $table->integer('result1_id')    ->unsigned();
            $table->foreign('result1_id')    ->references('id')->on('result');
            $table->integer('result2_id')    ->unsigned();
            $table->foreign('result2_id')    ->references('id')->on('result');
        });
    }
    public function down()
    {
        Schema::dropIfExists('match');
    }
}
