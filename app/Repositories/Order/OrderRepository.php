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
    public function pendingOrders(){
        return $this->Order->where('status','pending')->select($this->Order->dataFormat())->get();
    }

    public function create($request)
    {
        $order_data = $request->except('_token','_method','files','order_id','quantity','stock_id');
        $order_data['orderID']=rand(111111,9999999).date('ymdhmi');
        $order=Order::Create($order_data);
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
            $this->stockInventoryUpdate($order_product->stock_id,$order_product->quantity,false);
        }
        $invoice['orderProducts']=$productInfo;
        return $invoice;
    }
    public function orderInventoryUpdate($orderId,$status=false){
        $products=OrderProduct::where('order_id',$orderId)->get();
        foreach($products as $product){
            $this->stockInventoryUpdate($product->stock_id,$product->quantity,$status);
        }
    }
    public function stockInventoryUpdate($stockId,$qty,$status){
        $stock=Stock::where('id',$stockId)->first();
        if($stock){
            try {
                // true=addition, false=subtract
                $data['boxQuantity']=$status?($stock->boxQuantity+$qty):($stock->boxQuantity-$qty);
                $stock->update($data);
                return true;
            } catch (\Throwable $th) {
                return false;
            }
        }
        return false;
    }

    public function all()
    {
        return 0;
    }


}
