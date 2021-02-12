<?php

namespace App\Core;
use App\Core\TransactionProcessor;

class MongoTransactionProcessor implements TransactionProcessor {

    private $transactionModel;
    private $fieldOperatorMappings = [
        'from_date' => [
            'operator' => 'where',
            'condition' => '>=',
            'column' => 'transaction_date'
        ],
        'to_date' => [
            'operator' => 'where',
            'condition' => '<',
            'column' => 'transaction_date'
        ],
        'value_min' => [
            'operator' => 'where',
            'condition' => '>=',
            'column' => 'value_in_base_currency'
        ],
        'value_max' => [
            'operator' => 'where',
            'condition' => '<',
            'column' => 'value_in_base_currency'
        ],
    ];
    private $select_fields = ["transaction_type", "to_account_number", "to_account_name", "transaction_date",
        "transaction_mode", "beneficiary_provider_name",
        "notes", "categories", "value_in_base_currency", "ref_transaction",
        "status_name", "status_reason",
    ];

    public function __construct($transaction_model)
    {
        $this->transactionModel = $transaction_model;
    }

    public function get($user_account_id, $where_condition = [])
    {
        try
        {
            $this->transactionModel->setTable($user_account_id);
            $query = $this->transactionModel;
            foreach($where_condition as $key => $value) {
                if(isset($this->fieldOperatorMappings[$key], $this->fieldOperatorMappings[$key]['operator'], 
                    $this->fieldOperatorMappings[$key]['condition'], $this->fieldOperatorMappings[$key]['column'])) {
                    //add where clause
                    $query = $query->{$this->fieldOperatorMappings[$key]['operator']}($this->fieldOperatorMappings[$key]['column'], 
                        $this->fieldOperatorMappings[$key]['condition'], $value);
                } else {
                    $query = $query->where($key, $value);
                }
            }
            $transactions = $query->select($this->select_fields)->get()->toArray();
            return json_decode(json_encode($transactions), true);
        }
        catch(\Illuminate\Database\QueryException $exception)
        {            
            return [
                'error' => $exception->getMessage()
            ];
        }
        catch(\Exception $e)
		{		
            return [
                'error' => $e->getMessage()
            ];
		}
    }
}