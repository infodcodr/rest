<?php

namespace App\Http\Controllers\Api;

use App\Cart;
use App\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\OrderItem;

class OrderController extends Controller
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
    public function store(Request $request)
    {
        try{
            $order = New Order();
            $order->restaurant_id = $request->restaurant_id;
            $order->branch_id = $request->branch_id;
            $order->table_id = $request->table_id;
            $order->order_time = Carbon::now();
            $order->is_completed = '1';
            $order->save();
            $cart = Cart::with('items')->where('table_id',$request->table_id)->where('qty','>','0')->get();
            foreach($cart as $c){
                $orderItem = New OrderItem();
                $orderItem->order_id = $order->id;
                $orderItem->item_id = $c->item_id;
                $orderItem->qty = $c->qty;
                $orderItem->amount = $c->amount;
                $orderItem->save();
            }

            $data['data'] = $order;
            $data['message'] = 'update';
            return  $this->apiResponse($data,200);
        }catch(\Exception $e){
            $data['message'] = $e->getMessage();
            return  $this->apiResponse($data,404);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
