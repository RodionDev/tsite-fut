<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreatePoolTeamTable extends Migration
{
    public function up()
    {
        Schema::create('pool_team', function (Blueprint $table)
        {
            $table->integer('pool_id')->unsigned();
            $table->foreign('pool_id')->references('id')->on('pool')
                ->onDelete('cascade');
            $table->integer('team_id')->unsigned();
            $table->foreign('team_id')->references('id')->on('team')
                ->onDelete('cascade');
            $table->unique(['pool_id', 'team_id']);
        });
    }
    public function down()
    {
        Schema::dropIfExists('pool_team');
    }
}
