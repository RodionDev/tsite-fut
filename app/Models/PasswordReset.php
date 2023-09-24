<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class PasswordReset extends Model
{
    protected $primaryKey = 'email'; 
    public $incrementing = false;
    public $table = 'password_reset';
    protected $fillable = [
        'email', 'token', 'created_at'
    ];
}
