<?php
use Illuminate\Database\Seeder;
use App\Models\Tournament;
use App\Http\Controllers\UserController;
class TournamentTableSeeder extends Seeder
{
    public function run()
    {
        $amount = 15;
        $user_controller = new UserController;
        $names = $user_controller->generateNames($amount);
        $date = new DateTime('now');
        $date->sub(new DateInterval('P' . $amount*4 . 'D'));
        for($i=0; $i<$amount; $i++)
        {
            $tournament = new Tournament();
            $tournament->name = $names[$i]["surname"] . "-Toernooi";
            $tournament->timestamps = false;
            $days = rand(3,20);
            $date->add(new DateInterval('P' . $days . 'D'));
            $tournament->start_date = $date;    
            if(rand(0,2) !== 0)
            {
                $days = rand(3,5);
                $date->add(new DateInterval('P' . $days . 'D'));
                $tournament->end_date = $date;
            }
            if(rand(0,1))   $tournament->mott_id = $user_controller->getRandomUserId();
            $tournament->save();
        }
    }
}
