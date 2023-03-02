<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreatePoolTable extends Migration
{
    public function up()
    {
        Schema::create('pool', function (Blueprint $table)
        {
            $table->increments('id');
            $table->integer('number');  
            $table->boolean('finished');    
            $table->integer('tournament_id')  ->unsigned();
            $table->foreign('tournament_id')  ->references('id')->on('tournament')->onDelete('cascade');
        });
    }
    public function down()
    {
        Schema::dropIfExists('pool');
    }
}
