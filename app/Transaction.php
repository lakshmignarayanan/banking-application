<?php

namespace App;
use App\Core\TransactionProcessor;
use App\Constants\HTTPConstant;

class Transaction {

    private $transactionProcessor;
    private $whitelistedFields = ["transaction_type", "to_account_id", "to_account_number", "to_account_name",
        "transaction_mode_id", "transaction_mode", "beneficiary_provider_id", "beneficiary_provider_name",
        "notes", "categories", "value_in_base_currency", "value_in_usd", "exchange_rate", "ref_transaction",
        "value_date", "status_id", "status_name", "status_reason",
        "from_date", "to_date", "value_min", "value_max"];
    private $wildcardSearchableFields = ["to_account_number", "to_account_name",
        "notes", "categories", "ref_transaction"]; //subset of $whitelistedFields
    private $where = array();
    private $result = [
        "code" => HTTPConstant::APPLICATION_ERROR,
        "data" => [],
        "error" => []
    ];

    public function __construct(TransactionProcessor $transaction_processor) {
        $this->transactionProcessor = $transaction_processor;
    }

    public function setFilters($filters = []) {
        foreach($filters as $key => $value) {
            if(!in_array($key, $this->whitelistedFields)) {
                continue;
            }
            if(in_array($key, $this->wildcardSearchableFields)) {
                $value = "%".$value."%";
            }
            $this->where[$key] = $value;
        }
    }

    public function get($account_id) {
        $transaction_data = $this->transactionProcessor->get($account_id, $this->where);
        if(isset($transaction_data["error"])) {
            $this->result["error"] = $transaction_data["error"];
            return $this->result;
        }
        $this->result["code"] = HTTPConstant::OK;
        $this->result["data"] = ["transactions" => $transaction_data];
        return $this->result;
    }

}