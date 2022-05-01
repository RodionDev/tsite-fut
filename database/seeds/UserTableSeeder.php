<?php
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Mail;
use App\Mail\Invite;
class UserTableSeeder extends Seeder
{
    public function run()
    {
        $roles = Role::all();   
        $user_controller = new UserController;
        $users = $user_controller->generateNames(Role::count()*2, "Netherlands");   
        $counter = 0;   
        for($i=0; $i<2; $i++)
        {
            foreach($roles as $role)
            {
                $user = new User();
                $user->role_id = $role->id;
                $user->email = "futsal" . (string)($counter+1) . "@mailinator.com";  
                if($i == 0)
                {
                    $user->register_token = "token" . (string)($counter+1);
                    Mail::to($user->email)->send(new Invite(route('register', ['token' => $user->register_token])));
                }
                if($i == 1)
                {
                    $user->first_name = $users[$counter]["name"];
                    $user->sur_name = $users[$counter]["surname"];
                    $user->password = Hash::make("Password123");   
                    $user->last_seen = new \DateTime(); 
                }
                $user->timestamps = false;
                $user->save();
                $counter++;
            }
        }
        Log::info("End");
    }
}
