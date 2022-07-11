<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Role extends Model
{
    public $table = 'role';
    public $timestamps = false;
    protected $fillable = [
        'name', 'description', 'permission'
    ];
    public function users()
    {
        return $this->hasMany('App\Models\User');
    }
}
