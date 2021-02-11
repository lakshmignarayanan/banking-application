<?php

namespace App;
use App\Core\TransactionProcessor;

class Transaction {

    private $transactionProcessor;
    private $whitelistedFields = ["dr_cr", "beneficiary_account_id", "beneficiary_account_number", 
        "transaction_mode_id", "transaction_mode", "beneficiary_provider_id", "beneficiary_provider_name",
        "notes", "categories", "value_in_base_currency", "value_in_usd", "exchange_rate", 
        "transaction_date", "value_date", "status_id", "status_name"];
    private $wildcardSearchableFields = ["beneficiary_account_number", "transaction_mode", "beneficiary_provider_name",
        "notes", "categories"]; //subset of $whitelistedFields
    private $where = array();

    public function __construct(TransactionProcessor $transaction_processor) {
        $this->transactionProcessor = $transaction_processor;
    }

    public function setFilters($filters = []) {
        foreach($filters as $key => $value) {
            if(!in_array($key, $this->whitelistedFields)) {
                continue;
            }
            if(in_array($key, $this->wildcardSearchableFields)) {
                $this->where[$key] = '%'.$value.'%';
            } else {
                $this->where[$key] = $value;
            }
        }
    }

    public function get($account_id) {
        return $this->transactionProcessor->get($account_id, $this->where);
    }

}