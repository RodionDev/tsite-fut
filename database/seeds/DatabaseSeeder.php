<?php
use Illuminate\Database\Seeder;
class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            RoleTableSeeder::class,
            AdminAccountSeeder::class,
        ]);
        if( App::Environment() === 'production' )
        {
        }
        if( App::Environment() === 'local' )
        {
            $this->call([
                UserTableSeeder::class,
                RandomTeamTableSeeder::class,
            ]);
        }
    }
}
