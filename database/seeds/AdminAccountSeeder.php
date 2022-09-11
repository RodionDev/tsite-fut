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
        $user->email = "futsal@jaspervanveenhuizen.nl";  
        $user->first_name = "Admin";
        $user->sur_name = "van Site";
        $user->password = Hash::make(str_shuffle(bin2hex(openssl_random_pseudo_bytes(4))));   
        $user->last_seen = new \DateTime(); 
        $user->timestamps = false;
        $user->save();
    }
}
