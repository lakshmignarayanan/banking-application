# banking-application
Available apis
1. GET /transaction-history

# App Structure
1. app\Constants\AppConstant.php
2. app\Constants\HTTPConstant.php
3. app\Core\MongoTransactionProcessor.php
4. app\Core\TransactionProcessor.php
5. app\Helpers\ResponseHelper.php
6. app\Http\Controllers\Controller.php
7. app\Http\Controllers\TransactionController.php
8. app\Http\Middleware\ValidationMiddleware.php
9. app\Models\MongoDB\TransactionModel.php
10. app\Models\MySQL\AccountModel.php
11. app\Models\MySQL\PayementProviderModel.php
12. app\Providers\TransactionServiceProvider.php
13. app\Validators\Orchestrator;
14. app\Validators\TransactionValidator;
15. app\Account.php;
16. app\Transaction;

# Databases:
1. NoSQL DB - Mongo

Collections pattern - transaction_{account_id}_{year} `transaction_129003844_2021`

Schema:

transaction_type(dr,cr) | transaction_mode(upi,neft,imps) | beneficiary_provider_name(HDFC) | notes(user notes) | categories(groceries) | ref_transaction | status_name | status_reason


SQL DB tables structure:

1. account table

    id | type_id | created_at | updated_at | status

2. payment_mode table

    id | name | status | created_at | updated_at

3. payment_provider table

    id | name | logo_url | status | created_at | updated_at


# Request payload

```
curl --location --request GET 'http://127.0.0.1:8000/api/transaction-history?account_id=my_acc_id&value_min=200&value_max=1000&to_date=2021-12-12&transaction_type=dr&transaction_mode=upi&to_account_number=167720900&from_date=2021-12-01'
```


# Response payload

```
{
   "code":200,
   "message":"Request processed",
   "data":{
      "transactions":[
         {
            "transaction_type":"dr",
            "to_account_number":"167720900",
            "to_account_name":"Pratheeba Condiments",
            "transaction_date":"2021-01-02",
            "transaction_mode":"upi",
            "beneficiary_provider_name":"HDFC",
            "notes":"",
            "categories":"groceries",
            "value_in_base_currency":230.00,
            "ref_transaction":"",
            "status_name":"ok",
            "status_reason":""
         },
         {
            "transaction_type":"cr",
            "to_account_number":"9029934",
            "to_account_name":"Lakshmi Narayanan",
            "transaction_date":"2021-01-05",
            "transaction_mode":"neft",
            "beneficiary_provider_name":"HDFC",
            "notes":"Salary",
            "categories":"",
            "value_in_base_currency":15000.00,
            "ref_transaction":"",
            "status_name":"ok",
            "status_reason":""
         }
      ]
   },
   "error":{
      
   },
   "total":2,
   "limit":25,
   "offset":0
}
```