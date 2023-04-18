<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class AddTournamentIdToMatchTable extends Migration
{
    public function up()
    {
        Schema::table('match', function (Blueprint $table) 
        {
            $table->integer('tournament_id')  ->nullable()->unsigned();
            $table->foreign('tournament_id')  ->references('id')->on('tournament')
            ->onDelete('cascade');
        });
    }
    public function down()
    {
    }
}
