<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function __construct()
    { 
        require getcwd()."/../config/menu.php";
        $user = Auth::user();
         
        view()->share('menu', [
            'menu' => $menu,
            'menuWorker' => $menuWorker,
            'route' => $routes,
            'url' => "/".Request::path(),
            'baseURL' => URL::to('/')
        ]);
    }

    public function convertImage($source, $dir, $quality = 100,)
    { 
        $name = pathinfo($source, PATHINFO_FILENAME);
        $dest = $dir.$name.'.webp';
        $info = getimagesize($source);
        $isAlpha = false;

        if ($info['mime'] == 'image/jpeg')
            $image = imagecreatefromjpeg($source);
        elseif ($isAlpha = $info['mime'] == 'image/gif') {
            $image = imagecreatefromgif($source);
        } elseif ($isAlpha = $info['mime'] == 'image/png') {
            $image = imagecreatefrompng($source);
        } else {
            return $source;
        }

        if ($isAlpha) {
            imagepalettetotruecolor($image);
            imagealphablending($image, true);
            imagesavealpha($image, true);
        } 

        imagewebp($image, dirname(__FILE__)."/../../..".$dest, $quality);

        return $dest;
    }
    
    public static function parseDate($date, $format = "d/m/y H:i"){
        $now = time(); 
        $currDate = strtotime($date);
        $datediff = round(($currDate - $now )/ (60 * 60 * 24));

        if(abs($datediff) < 2){
            $finalString = match (true) {
                $datediff == -1 => "Ayer", 
                $datediff == 0 => "Hoy", 
                $datediff == 1 => "Mañana", 
            };

            $finalString.= " ".date("H:i",$currDate);
        }
        else{
            $finalString = date($format, strtotime($date));
        }

        echo $finalString;
    }

    public static function timeAgo($date){
        $finalString = "";

        $now = new \DateTime;
        $ago = new \DateTime($date);
        $diff = $now->diff($ago); 

        if($diff->y != 0){
            $finalString = "Hace ".$diff->y.($diff->y == 1 ? " año" : " años");
        }
        elseif($diff->m != 0){
            $finalString = "Hace ".$diff->m.($diff->m == 1 ? " mes" : " meses");
        }
        elseif($diff->d != 0){
            $finalString = "Hace ".$diff->d.($diff->d == 1 ? " día" : " días");
        }
        elseif($diff->h != 0){
            $finalString = "Hace ".$diff->h.($diff->h == 1 ? " hora" : " horas");
        }
        elseif($diff->i != 0){
            $finalString = "Hace ".$diff->i.($diff->i == 1 ? " minuto" : " minutos");
        }
        else{
            $finalString = "Hace poco";
        }

        return $finalString; 
    }

    public static function differenceInHours($hour){
        $starttimestamp = strtotime(date("Y-m-d H:s"));
        $endtimestamp   = strtotime($hour);
        $difference     = ($endtimestamp - $starttimestamp)/3600;

        return $difference;
    }
}
