<?php

namespace App\Models\MySQL;

use Illuminate\Database\Eloquent\Model;

class AccountModel extends Model {
    protected $table = 'account';
    public $timestamps = true;
    const CREATED_AT = "created_at";
    const UPDATED_AT = "updated_at";
}