<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $table = 'services';

   // public $timestamps = false;

    protected $fillable=[
        "service_type_id",
        "name",
        "img",
        "description"
    ];
    public function serviceType()
{
    return $this->belongsTo(ServiceType::class, 'service_type_id');
}
}
