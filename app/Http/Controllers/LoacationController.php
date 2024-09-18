<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stevebauman\Location\Facades\Location;
use Carbon\Carbon;

class LoacationController extends Controller
{
    public function getLocation(Request $request)
    {
        //get mac and nic details
        $macAddr = exec('getmac');
        echo ' MAC address and NIC: ' . $macAddr;
        
        echo '<br>';

        // Get the IP address from the request
        $ipAddress = $request->ip();

        if ($position = Location::get(' 192.168.51.22')) {
            echo 'IP Address: ' . $position->ip . '<br>';
            echo 'City: ' . $position->cityName . '<br>';
            echo 'Country: ' . $position->countryName . '<br>';
        } else {
            echo 'Failed retrieving ip, cityName, countryName .';
        }

        echo "<br>";
        
        //get current time and date
        $now = Carbon::now();

        $date = $now->toDateString(); 
        $time = $now->toTimeString(); 

        echo "Date: $date"; 
        echo "<br>";
        echo "Time: $time"; 

    }
}
