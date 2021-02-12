<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaction;
use App\Constants\HTTPConstant;
use App\Helpers\ResponseHelper;

class TransactionController extends Controller {

    private $request, $transaction;

    public function __construct(Request $request, Transaction $transaction)
    {
        $this->request = $request;
        $this->transaction = $transaction;
    }

    public function get()
    {
        $requestData = $this->request->all();
        $limit = $requestData['limit']??Config('transaction.history.limit');
        $offset = $requestData['offset']??0;
        $account_id = $requestData['account_id']; //since we have already validated, this key will be set

        $this->transaction->setFilters($requestData);
        $transactionData = $this->transaction->get($account_id);
        return ResponseHelper::format($transactionData);
    }

    public function post() {}

}