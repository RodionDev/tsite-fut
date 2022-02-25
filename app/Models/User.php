<?php
namespace App\Models;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;
class User extends Authenticatable
{
    use Notifiable;
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password',  
    ];
    protected $hidden = [
        'password', 'remember_token',
    ];
}
