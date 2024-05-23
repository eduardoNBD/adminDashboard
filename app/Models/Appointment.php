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

    public static function getStatus(){
        return self::$status;
    }
}
