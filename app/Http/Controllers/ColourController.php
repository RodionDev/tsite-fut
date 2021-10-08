<?php
namespace App\Http\Controllers;
use App\User;
use App\Http\Controllers\Controller;
class ColourController extends Controller
{
    public function primaryColour()
    {
        return "#d32f2f";
    }
    public function secondaryColour()
    {
    }
    public static function instance()
    {
        return new ColourController();
    }
}
