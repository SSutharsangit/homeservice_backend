<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProviderService extends Model
{
    use HasFactory;
    protected $table = 'provider_services';

    // public $timestamps = false;

    protected $fillable = [
        "provider_id",
        "service_id",
        "amount_per_hour"
    ];
    public function provider()
    {
        return $this->belongsTo(Provider::class, 'provider_id');
    }
    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }
}
