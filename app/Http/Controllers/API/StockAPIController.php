<?php

namespace App\Http\Controllers\API;

use App\Models\Stock;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Stock\UpdateRequest;
use App\Http\Resources\stock\StockCollection;

class StockAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stocks=Stock::latest()->get();
        return new StockCollection($stocks);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $stock_data = $request->except('_token','_method','files');
        try {
            $stock=Stock::firstOrCreate(
                [
                    'product_id' =>  request('product_id'),
                    'weight' =>  request('weight'),
                    'tasteType' =>  request('tasteType')
                ],$stock_data);
            if($stock->wasRecentlyCreated){
                return response()->json(['status'=>201,'data'=>$stock]);
            }
            return response()->json(['message'=>'Already exits']);
        } catch (\Throwable $th) {
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
    public function update(UpdateRequest $request,Stock $stock)
    {
        $stock_data = $request->except('_token','_method','files','weight','tasteType');
        try {
            $newStock=$stock->update($stock_data);
            return response()->json(['status'=>200,'message'=>"Stock updated"]);
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
