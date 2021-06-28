<?php
namespace App\Repositories\PreOrder;

use App\Models\PreOrder;
use App\Repositories\PreOrder\PreOrderRepositoryInterface;

Class PreOrderRepository implements PreOrderRepositoryInterface
{
    public $PreOrder;

    public function __construct(PreOrder $PreOrder) {
        //parent::__construct($PreOrder);
        $this->PreOrder = $PreOrder;
    }

    public function createPreOrder(){
        $data['user_id']=auth()->id();
        $data['preOrderCode']='TOKEN-'.date('ymdi').rand(111,9999);
        $data['expiry_date']=strtotime(date('y-m-d'). ' + 7 days');
        $preOrder=$this->PreOrder->create($data);
        return $preOrder;
    }

    public function preOrderTokenCheck($token='NA'){
        $preOreder=PreOrder::where('user_id',auth()->id())->where('preOrderCode',$token)->where('status','active')->where('expiry_date','>=',date('y-m-d'))->first();
        if($preOrder){
            $preOreder->update([
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
