<?php
use Illuminate\Database\Seeder;
use App\Models\Team;
use App\Http\Controllers\UserController;
class TeamTableSeeder extends Seeder
{
    public function run()
    {
        Log::info("TEAMTABLE");
        $amount = 10;
        $user_controller = new UserController;
        $names = $user_controller->generateNames($amount);
        for($i=0; $i<$amount; $i++)
        {
            $team = new Team();
            $team->name = $names[$i]["surname"];
            $team->leader_id = $user_controller->getRandomUserId();
            $team->timestamps = false;
            $team->save();
        }
    }
}
