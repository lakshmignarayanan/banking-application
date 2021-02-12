# banking-application
NoSQL DB transactions collection schema
Collection pattern: transaction_{account_id}_{year}

Example: transaction_19002839477_2021

//transaction_type => dr|cr

//transaction_mode => upi|neft|imps

//beneficiary_provider_name => HDFC|PaytmPaymentsBank

//notes => "user notes"

//categories => groceries|shopping

//ref_transaction => refund_against_1290003422

//status_name => complete|failed|pending

//status_reason => ""|network_error

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