<?php

namespace App\Core;
use App\Core\TransactionProcessor;

class MongoTransactionProcessor implements TransactionProcessor {

    private $transactionModel;

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
            if(!empty($where_condition)) 
            {
                $query = $this->transactionModel->where($where_condition);
            }
            $transactions = $query->get()->toArray();
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