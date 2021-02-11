<?php

namespace App\Models\MySQL;

use Illuminate\Database\Eloquent\Model;

class PayementProviderModel extends Model {
    protected $table = 'payement_providers';
    public $timestamps = true;
    const CREATED_AT = "created_at";
    const UPDATED_AT = "updated_at";
}