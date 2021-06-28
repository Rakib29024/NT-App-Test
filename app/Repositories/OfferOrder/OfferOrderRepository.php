<?php
namespace App\Repositories\OfferOrder;

use App\Models\OfferOrder;
use App\Repositories\PreOrder\PreOrderRepositoryInterface;
use App\Repositories\OfferOrder\OfferOrderRepositoryInterface;

Class OfferOrderRepository implements OfferOrderRepositoryInterface
{
    public $OfferOrderRepository,$PreOrderRepositoryInterface;

    public function __construct(OfferOrderRepository $OfferOrderRepository,PreOrderRepositoryInterface $PreOrderRepositoryInterface) {
        //parent::__construct($OfferOrderRepository);
        $this->OfferOrderRepository = $OfferOrderRepository;
        $this->PreOrderRepositoryInterface = $PreOrderRepositoryInterface;
    }

    public function offerDiscount($productQty,$totalProductAmount){
        $offerOrder=OfferOrder::where('product_qty_min','<=',$productQty)
                                ->where('total_product_price_min','<=',$totalProductAmount)
                                ->where('expiry_date','>=',date('y-m-d'))
                                ->first();
        return $offerOrder?$offerOrder->discount:false;
    }

    public function all()
    {
        return 0;
    }


}
