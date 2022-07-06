<?php
use Illuminate\Database\Seeder;
use App\Models\Role;
class RoleTableSeeder extends Seeder
{
    public function run()
    {
        $role_player = new Role();
        $role_player->timestamps = false;
        $role_player->name = 'Speler';
        $role_player->description = 'Een speler.';
        $role_player->permission = 10;
        $role_player->save();
        $role_referee = new Role();
        $role_referee->timestamps = false;
        $role_referee->name = 'Scheidsrechter';
        $role_referee->description = 'Kan scores aanpassen.';
        $role_referee->permission = 20;
        $role_referee->save();
        $role_manager = new Role();
        $role_manager->timestamps = false;
        $role_manager->name = 'Team Manager';
        $role_manager->description = 'Kan spelers uitnodigen.';
        $role_manager->permission = 30;
        $role_manager->save();
        $role_organiser = new Role();
        $role_organiser->timestamps = false;
        $role_organiser->name = 'Organisator';
        $role_organiser->description = 'Kan team managers uitnodigen en toernooien organiseren.';
        $role_organiser->permission = 50;
        $role_organiser->save();
        $role_administrator = new Role();
        $role_administrator->timestamps = false;
        $role_administrator->name = 'Administrator';
        $role_administrator->description = 'Kan bij het gehele beheer.';
        $role_administrator->permission = 99;
        $role_administrator->save();
    }
}
