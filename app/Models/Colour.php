<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Colour extends Model
{ 
    public function store(Request $request)
    {
        $colour = new Colour();
        $colour->name = $request->name;
        $colour->hex = $request->hex;
    }
    protected $primaryKey = "name";
    public $incrementing = false;
}
