<?php
namespace App\Models;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\MailResetPasswordToken;
use Illuminate\Support\Facades\DB;
use App\Models\Tournament;
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
    public function getFullName()
    {
        return "{$this->first_name} {$this->sur_name}";
    }
    public function getRandomUserId($role=null)
    {
        return User::inRandomOrder()->first()->id;
    }
    public function getUserWithToken($token)
    {
        return DB::table('user')->where('register_token', $token)->first();
    }
    public function tournaments($get=false)
    {
        $id = $this->id;
        $tournaments = Tournament::whereHas('pools.teams.players', function($query) use($id)
        {
           $query->where('id', '=', $id);
        });
        return ($get) ? $tournaments->get() : $tournaments;
    }
    public function scopeSearchName($query, $name, $role_id=null)
    {
        $names = explode(" ", $name);
        return User::select('role_id','first_name', 'sur_name', 'id')
            ->where(function($query) use($names, $role_id)
        {
            for ($i=0; $i<count($names); $i++)
            {
                if($role_id)
                {
                    $query->where('role_id', $role_id);
                }
                $query->where('first_name', 'like', '%'.$names[$i].'%')
                    ->orWhere('sur_name', 'like', '%'.$names[$i].'%');
            }
        });
    }
    public function role()
    {
        return $this->belongsTo('App\Models\Role', 'role_id');
    }
    public function motts()
    {
        return $this->hasMany('App\Models\Tournament');
    }
    public function motms()
    {
        return $this->hasMany('App\Models\Result');
    }
    public function leadingTeams()
    {
        return $this->hasMany('App\Models\User');
    }
    public function teams()
    {
        return $this->belongsToMany('App\Models\Team');
    }
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new MailResetPasswordToken($token));
    }
    public function __toString()
    {
        return $this->getFullName();
    }
}
