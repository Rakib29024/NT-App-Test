<?php
namespace App\Repositories\OfferOrder;


Interface OfferOrderRepositoryInterface{
    public function all();
    public function createPreOrder($userId);
    public function preOrderTokenCheck($token='NA');
    public function offerDiscount($productQty,$totalProductAmount);
}
