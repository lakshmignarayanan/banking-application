<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\MongoDB\TransactionModel;
use App\Core\MongoTransactionProcessor;

class TransactionServiceProvider extends ServiceProvider {

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Core\MongoTransactionProcessor', function ($app) {
            return new MongoTransactionProcessor(
                new TransactionModel
            );
        });

        $this->app->bind('App\Core\TransactionProcessor', 'App\Core\MongoTransactionProcessor');
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}