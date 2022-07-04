<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Role extends Model
{
    public $table = 'roles';
    protected $fillable = [
        'name', 'description', 'permission'
    ];
    public function users()
     {
         return $this->hasMany('App\Models\User');
  }
}
