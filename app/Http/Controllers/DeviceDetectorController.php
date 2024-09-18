<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DeviceDetector\DeviceDetector;

class DeviceDetectorController extends Controller
{
    public function getDeviceDeatails(Request $request)
    {
        $userAgent = $request->header('User-Agent');
        
        // Initialize DeviceDetector with the User-Agent string
        $dd = new DeviceDetector($userAgent);
        $dd->parse();
        
        if ($dd->isBot()) {
            // Handle bots
            echo 'Bot detected';
        } else {

            $os = $dd->getOs();
            $deviceType = $dd->getDeviceName();
            $brand = $dd->getBrandName();
            $browser = $dd->getClient();
            
            echo 'Operating system: ' . ($os['name'] ?? 'Unknown');
            echo '<br>';

            echo 'Browser: ' . ($browser['name'] ?? 'Unknown');
            echo '<br>';
            
            echo 'Browser version: ' . ($browser['version'] ?? 'Unknown');
            echo '<br>';
            
            echo 'Device type: ' . ($deviceType ?? 'Unknown');
            echo '<br>';

            echo 'Brand: ' . ($brand ? $brand : 'Brand not detected');
        }
    }
}
