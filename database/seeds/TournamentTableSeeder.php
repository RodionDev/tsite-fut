<?php
use Illuminate\Database\Seeder;
use App\Models\Tournament;
use App\Http\Controllers\UserController;
class TournamentTableSeeder extends Seeder
{
    public function run()
    {
        $amount = 3;
        $user_controller = new UserController;
        $names = $user_controller->generateNames($amount);
        for($i=0; $i<$amount; $i++)
        {
            $tournament = new Team();
            $tournament->name = $names[$i]["surname"];
            $tournament->timestamps = false;
            if(rand(0,1))   $tournament->tott_id = $user_controller->getRandomUserId();
            if(rand(0,1))   $table->date('start_date')  ->nullable();
            if(rand(0,1))  $table->date('end_date')    ->nullable();
            $tournament->save();
        }
    }
}
