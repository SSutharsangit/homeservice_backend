<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SRequest extends Model
{
    use HasFactory;
    protected $table = 's_requests';

    //public $timestamps = false;

    protected $fillable = [
        "customer_id",
        "service_provider_id",
        "from_date_time",
        "to_date_time",
        "amount",
        "location",
        "status"
    ];
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function gig()
    {
        return $this->belongsTo(ProviderService::class, 'service_provider_id');
    }

}
