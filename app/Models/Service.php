<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    use HasUuids;

    protected $table = 'services';
    public $keyType  = 'string';
    public $incrementing = false; 
}
