<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreateTournamentTable extends Migration
{
    public function up()
    {
        Schema::create('tournament', function (Blueprint $table)
        {
            $table->increments('id');
            $table-string('name');
            $table->date('start_date')  ->nullable();
            $table->date('end_date')    ->nullable();
            $table->integer('mott_id')  ->nullable()->unsigned();
            $table->foreign('mott_id')  ->references('id')->on('user');
        });
    }
    public function down()
    {
        Schema::dropIfExists('tournament');
    }
}
