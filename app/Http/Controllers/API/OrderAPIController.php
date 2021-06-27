<?php

namespace App\Http\Controllers\API;

use App\Models\Order;
use App\Models\Stock;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Order\InsertRequest;

class OrderAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InsertRequest $request)
    {
        $order_data = $request->except('_token','_method','files','order_id','quantity','stock_id');
        DB::beginTransaction();
        try {
            $order=Order::Create($order_data);
            $deliveryCost=(strpos($request->address, '^(D|d)+haka'))?60:100;
            $invoice['orderInfo']=$order;
            $productInfo=[];
            for ($i=0;0<count($request->order_id);$i++) {
                $stock=Stock::findOrFail($request->stock_id[$i]);
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

            return response()->json(['message'=>'Thanks for ordering','invoice'=>$invoice]);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json(['status'=>500,'message'=>'Something went wrong']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
