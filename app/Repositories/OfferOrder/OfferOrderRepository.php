<?php
namespace App\Repositories\OfferOrder;

use App\Models\PreOrder;
use App\Models\OfferOrder;
use App\Repositories\PreOrder\PreOrderRepositoryInterface;
use App\Repositories\OfferOrder\OfferOrderRepositoryInterface;

Class OfferOrderRepository implements OfferOrderRepositoryInterface
{
    public $OfferOrderRepository,$PreOrderRepositoryInterface;

    public function __construct(OfferOrder $OfferOrder,PreOrderRepositoryInterface $PreOrderRepositoryInterface) {
        //parent::__construct($OfferOrder);
        $this->OfferOrder = $OfferOrder;
        $this->PreOrderRepositoryInterface = $PreOrderRepositoryInterface;
    }

    public function offerDiscount($productQty,$totalProductAmount){
        $offerOrder=$this->OfferOrder->where('product_qty_min','<=',$productQty)
                                ->where('total_product_price_min','<=',$totalProductAmount)
                                ->where('expiry_date','>=',date('y-m-d'))
                                ->first();
        return $offerOrder?$offerOrder->discount:false;
    }
    public function createPreOrder($userId){
        $data['user_id']=$userId;//for authenticated user  =>  auth()->id();
        $data['preOrderCode']='TOKEN-'.date('ymdi').rand(111,9999);
        $date=date_create("2013-03-15");
        $date=date_add($date,date_interval_create_from_date_string("7 days"));
        $data['expiry_date']=date_format($date,"Y-m-d");
        $preOrder=PreOrder::create($data);
        return $preOrder;
    }
    public function preOrderTokenCheck($token='NA'){
        $preOrder=PreOrder::where('user_id',auth()->id())->where('preOrderCode',$token)->where('status','active')->where('expiry_date','>=',date('y-m-d'))->first();
        if($preOrder){
            $preOrder->update([
                'status'=>'inactive'
            ]);
            return true;
        }
        return false;
    }
    public function all()
    {
        return 0;
    }


}
