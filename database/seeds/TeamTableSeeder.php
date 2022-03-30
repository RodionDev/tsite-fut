<?php
use Illuminate\Database\Seeder;
use App\Models\Team;
use App\Models\User;
class TeamTableSeeder extends Seeder
{
    public function run()
    {
        $amount = 10;
        $json = json_decode(file_get_contents("https:
        for($i=0; $i<$amount; $i++)
        {
            $team = new Team();
            $team->name = $json[$i]["surname"];
            $team->leader_id = User::inRandomOrder()->first()->id;
            $team->timestamps = false;
            $team->save();
        }
    }
}
