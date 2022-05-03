<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Tournament extends Model
{
    public $table = 'tournament';
    protected $fillable = [
        'name', 'start_date', 'end_date', 'mott_id'
    ];
    public function pools()
    {
        return $this->hasMany('App\Models\Pool');
    }
}
