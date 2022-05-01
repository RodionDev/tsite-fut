<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Tournament extends Model
{
    public function pools()
    {
        return $this->hasMany('App\Models\Pool');
    }
}
