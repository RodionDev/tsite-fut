<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreateTeamUserTable extends Migration
{
    public function up()
    {
        Schema::create('team_user', function (Blueprint $table)
        {
            $table->integer('team_id')->unsigned();
            $table->foreign('team_id')->references('id')->on('team')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('user')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->unique(['team_id', 'user_id']);
        });
    }
    public function down()
    {
        Schema::dropIfExists('team_user');
    }
}
