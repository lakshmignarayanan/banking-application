<?php

namespace App\Core;

interface TransactionProcessor {
    public function get($where_condition);
}