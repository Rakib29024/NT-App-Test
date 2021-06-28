<?php
namespace App\Repositories\Order;

use App\Models\Order;
use App\Models\Stock;
use App\Models\OrderProduct;
use App\Repositories\Order\OrderRepositoryInterface;

Class OrderRepository implements OrderRepositoryInterface
{
    public $OrderRepository;

    public function __construct(Order $Order) {
        //parent::__construct($Order);
        $this->Order = $Order;
    }

    public function create($request)
    {
        $order_data = $request->except('_token','_method','files','order_id','quantity','stock_id');
        $order_data['orderID']=rand(111111,9999999).date('ymdhmi');
        $order=$this->Order->Create($order_data);
        $deliveryCost=preg_match("/(D|d)haka/",$request->address)?60:100;
        $invoice['orderInfo']=$order;
        $productInfo=[];
        for ($i=0;$i<count($request->stock_id);$i++) {
            $stock=Stock::findOrFail($request->stock_id[$i]);
            $data['productName']=$stock->product_name->name;
            if($stock->boxQuantity<$request->stock_id[$i]){
                continue;
            }
            $data['order_id']=$order->id;
            $data['stock_id']=$request->stock_id[$i];
            $data['quantity']=$request->quantity[$i];
            $data['totalProductPrice']=($request->quantity[$i])*($stock->pricePerBox);
            $data['deliveryCost']=$deliveryCost;
            $productInfo[]=$data;
            $order_product=OrderProduct::Create($data);
        }
        $invoice['orderProducts']=$productInfo;
        return $invoice;
    }
    public function all()
    {
        return 0;
    }


}
