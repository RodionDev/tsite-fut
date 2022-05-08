<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreateResultsTable extends Migration
{
    public function up()
    {
        Schema::create('results', function (Blueprint $table)
        {
            $table->increments('id');
            $table->int('score')        ->nullable();
            $table->integer('team_id')  ->unsigned();
            $table->foreign('team_id')  ->references('id')->on('team');
            $table->integer('motm')     ->nullable()->unsigned();
            $table->foreign('motm')     ->references('id')->on('user');
        });
    }
    public function down()
    {
        Schema::dropIfExists('results');
    }
}
