<?php

namespace App\Models\MongoDB;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

use Moloquent;

class TransactionModel extends Eloquent {
    protected $connection = "mongodb";
    protected $collection = null;
    public $timestamps = true;
    const CREATED_AT = "created_at";
    const UPDATED_AT = "updated_at";

    public function __construct()
    {
        $this->collection = "transaction_".date('Y');
    }

    public function getTable()
    {
        return parent::getTable();
    }

    public function setTable($accountId)
    {
        $this->collection = "transaction_" . $accountId . "_" . date('Y');
    }

}