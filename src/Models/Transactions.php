<?php

namespace Yab\Hadron\Models;

use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{

    public $table = "transactions";

    public $primaryKey = "id";

    public $timestamps = true;

    public $fillable = [
        "uuid",
        "provider",
        "state",
        "subtotal",
        "tax",
        "total",
        "shipping",
        "refund_date",
        "provider_id",
        "provider_date",
        "provider_dispute",
        "customer_id",
        "notes",
        "cart",
        "response"
    ];

    public static $rules = [

    ];

}