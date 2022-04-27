<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class AddSquadNumberToTeamUserTable extends Migration
{
    public function up()
    {
        Schema::table('team_user', function (Blueprint $table)
        {
            $table->integer('squad_number') ->nullable();
        });
    }
}