<?php
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
class AdminAccountSeeder extends Seeder
{
    public function run()
    {
        $user = new User();
        $user->role_id = 5; 
        $user->email = env('ADMIN_EMAIL', 'futsal@jaspervanveenhuizen.nl');
        $user->first_name = "Admin";
        $user->sur_name = "van Site";
        $user->password = Hash::make(env('ADMIN_PASSWORD', 'Password123'));
        $user->last_seen = new \DateTime(); 
        $user->timestamps = false;
        $user->save();
    }
}
