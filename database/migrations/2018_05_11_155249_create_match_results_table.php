<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreateMatchResultsTable extends Migration
{
    public function up()
    {
        Schema::create('match_results', function (Blueprint $table)
        {
            $table->increments('id');
            $table->integer('result1_id')    ->unsigned();
            $table->foreign('result1_id')    ->references('id')->on('result');
            $table->integer('result2_id')    ->unsigned();
            $table->foreign('result2_id')    ->references('id')->on('result');
        });
    }
    public function down()
    {
        Schema::dropIfExists('match_results');
    }
}
