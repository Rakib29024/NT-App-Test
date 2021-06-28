<?php
namespace App\Repositories\Order;


Interface OrderRepositoryInterface{
    public function create($request,$OfferOrder);
    public function pendingOrders();
    public function orderInventoryUpdate($orderId,$status=false);
    public function stockInventoryUpdate($stockId,$qty,$status);
    public function all();
}
