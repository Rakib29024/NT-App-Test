<?php

namespace App\Providers;

use App\Repositories\CommonRepository;
use Illuminate\Support\ServiceProvider;
use App\Repositories\Order\OrderRepository;
use App\Repositories\Stock\StockRepository;
use App\Repositories\CommonRepositoryInterface;
use App\Repositories\Product\ProductRepository;
use App\Repositories\PreOrder\PreOrderRepository;
use App\Repositories\Order\OrderRepositoryInterface;
use App\Repositories\Stock\StockRepositoryInterface;
use App\Repositories\OfferOrder\OfferOrderRepository;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Repositories\PreOrder\PreOrderRepositoryInterface;
use App\Repositories\OfferOrder\OfferOrderRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(CommonRepositoryInterface::class,CommonRepository::class);
        $this->app->bind(OrderRepositoryInterface::class,OrderRepository::class);
        $this->app->bind(OfferOrderRepositoryInterface::class,OfferOrderRepository::class);
        $this->app->bind(PreOrderRepositoryInterface::class,PreOrderRepository::class);
        $this->app->bind(StockRepositoryInterface::class,StockRepository::class);
        $this->app->bind(ProductRepositoryInterface::class,ProductRepository::class);
    }
}
