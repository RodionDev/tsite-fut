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
            $table->integer('match_results_id')    ->unsigned();
            $table->foreign('match_results_id')    ->references('id')->on('match_results');
            $table->integer('tournament_id')    ->unsigned();
            $table->foreign('tournament_id')    ->references('id')->on('tournament');
        });
    }
    public function down()
    {
        Schema::dropIfExists('match');
    }
}
