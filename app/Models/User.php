<?php
namespace App\Models;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\MailResetPasswordToken;
class User extends Authenticatable
{
    use Notifiable;
    public $table = 'user';
    public $timestamps = false;
    protected $fillable = [
        'first_name', 'sur_name', 'email', 'password', 'role_id', 'avatar', 'register_token'
    ];
    protected $hidden = [
        'password', 'remember_token', 'register_token', 
    ];
    public function role()
    {
        return $this->belongsTo('App\Models\Role', 'role_id');
    }
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new MailResetPasswordToken($token));
    }
}
