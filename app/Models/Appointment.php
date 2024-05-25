<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;
    use HasUuids;

    protected $table = 'appointments';
    public $keyType  = 'string';
    public $incrementing = false;

    public static $status = [
        "Eliminada",
        "Pendiente",
        "Completada",
    ];

    public static $colors = [
        "#991b1b",
        "#ca8a04", 
        "#059669"
    ];

    public static $colorsClass = [
        "bg-red-800",
        "bg-yellow-600", 
        "bg-emerald-600"
    ];

    public static function getStatus(){
        return self::$status;
    }

    public static function getColorsClass(){
        return self::$colorsClass;
    }

    public static function getColors(){
        return self::$colors;
    }
}
