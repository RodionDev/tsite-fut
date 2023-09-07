<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class TournamentIdSetOnDeleteMatchTable extends Migration
{
    public function up()
    {
        Schema::table('match', function (Blueprint $table)
        {
            $table->dropForeign(['tournament_id']);
            $table->foreign('tournament_id')  ->references('id')->on('tournament')
            ->onDelete('cascade');
        });
    }
    public function down()
    {
    }
}
