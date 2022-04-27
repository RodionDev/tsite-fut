<?php
use Illuminate\Database\Seeder;
class DatabaseSeeder extends Seeder
{
    public function run()
    {
        if (App::Environment() === 'production')
        {
            $this->call(
            );
        }
        if (App::Environment() === 'local')
        {
            $this->call(
                TeamTableSeeder::class,
                TournamentTableSeeder::class,
            );
        }
        $this->call(
            RoleTableSeeder::class
        );
    }
}
