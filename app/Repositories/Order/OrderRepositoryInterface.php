<?php
namespace App\Repositories\Order;


Interface OrderRepositoryInterface{
    public function create($request);
    public function pendingOrders();
    public function all();
}
