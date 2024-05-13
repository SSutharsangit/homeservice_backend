<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;
    protected $table = 'ratings';

   // public $timestamps = false;

    protected $fillable=[
        "service_provider_id",
        "rating",
        "feedback",

    ];
    public function gig()
{
    return $this->belongsTo(ProviderService::class, 'service_provider_id');
}
}
