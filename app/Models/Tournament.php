<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Tournament extends Model
{
    public function mott()
    {
        return $this->belongsTo('App\Models\User', 'mott_id');
    }
}
