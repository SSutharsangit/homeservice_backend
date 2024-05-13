<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceType extends Model
{
    use HasFactory;
   // public $timestamps = false;
    protected $table = 'service_types';
    protected $fillable=[
        "name",
        "description"
    ];
}
