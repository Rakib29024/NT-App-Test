<?php

namespace App\Http\Controllers\API;

use App\Models\Order;
use App\Models\Stock;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Order\InsertRequest;
use App\Http\Requests\Order\UpdateRequest;
use App\Repositories\Order\OrderRepositoryInterface;

class OrderAPIController extends Controller
{
    private $Repository;
    public function __construct(OrderRepositoryInterface $OrderRepositoryInterface) {
        $this->Repository = $OrderRepositoryInterface;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pendingOrders=$this->Repository->pendingOrders();
        return response()->json(['pendingOrders'=>$pendingOrders]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InsertRequest $request)
    {

        DB::beginTransaction();
        try {
            $invoice=$this->Repository->create($request);
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
    public function update(UpdateRequest $request, Order $order)
    {
        $order_data['status'] = $request->status;
        $order_data['mobile'] = $request->mobile;
        $order_data['address'] = $request->address;
        try {
            $newOrder=$order->update($order_data);
            return response()->json(['status'=>200,'message'=>"Order updated"]);
        } catch (\Throwable $th) {
            return response()->json(['status'=>500,'message'=>'Something went wrong']);
        }
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
