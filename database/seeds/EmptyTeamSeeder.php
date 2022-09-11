<?php
use Illuminate\Database\Seeder;
use App\Models\Team;
class EmptyTeamSeeder extends Seeder
{
    public function run()
    {    
        $team = new Team();
        $team->name = "bye";
        $team->leader_id = 1;
        $team->timestamps = false;
        $team->save();
    }
}
