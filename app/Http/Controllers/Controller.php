<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\URL;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function __construct()
    { 
        require getcwd()."/../config/menu.php";
        
        view()->share('menu', [
            'menu' => $menu,
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
}
