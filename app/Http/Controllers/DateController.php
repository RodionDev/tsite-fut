<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class DateController extends Controller
{
    public function dutchDate($date, $year=true)
    {
        $days = array(
            "Monday"    =>  "Maandag",
            "Tuesday"   =>  "Dinsdag",
            "Wednesday" =>  "Woensdag",
            "Thursday"  =>  "Donderdag",
            "Friday"    =>  "Vrijdag",
            "Saturday"  =>  "Zaterdag",
            "Sunday"    =>  "Zondag"
        );
        $months = array();
        $months[]="Januari";
        $months[]="Februari";
        $months[]="Maart";
        $months[]="April";
        $months[]="Mei";
        $months[]="Juni";
        $months[]="Juli";
        $months[]="Augustus";
        $months[]="September";
        $months[]="Oktober";
        $months[]="November";
        $months[]="December";
        $english_date = explode(
            '-',
            date( 'l-d-m-Y', strtotime($date) )
        );
        $dutch_date =    $days[$english_date[0]]
                        . " " .
                        (int)$english_date[1]
                        . " " .
                        $months[(int)$english_date[2]];
        if($year) $dutch_date =     $dutch_date
                                    . " " .
                                    $english_date[3];
        return (string)$dutch_date;
    }
}
