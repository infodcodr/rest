<?php

namespace App\Http\Controllers\Api;

use App\Cart;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Items as AppItems;

class CartController extends Controller
{
       /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($table_id)
    {
        try{

            $cart = Cart::with('items')->where('table_id',$table_id)->where('qty','>','0')->get();
            $data['data'] = $cart;
            $data['message'] = 'block';
            return  $this->apiResponse($data,200);
        }catch(\Exception $e){
            $data['message'] = $e->getMessage();
            return  $this->apiResponse($data,404);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
            $cart = Cart::where('table_id',$request->table_id)->where('item_id',$request->item_id)->first();
            $item = AppItems::find($request->item_id);
            if($item){
            $request->merge(['amount'=>$item->amount*$request->qty]);
            }
            if($cart){
                $cart->qty = $request->qty;
                $cart->save();
                if($request->qty == '0'){
                    $cart->delete();
                }
            }else{
            $cart = Cart::create($request->except('_token'));
            }
            $data['data'] = $cart;
            $data['message'] = 'created';
            return  $this->apiResponse($data,200);
        }catch(\Exception $e){
            $data['message'] = $e->getMessage();
            return  $this->apiResponse($data,404);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        try{
            $cart = Cart::find($id);
            $cart->update($request->except(['_token','id','created_at','updated_at']));
            $data['data'] = $cart;
            $data['message'] = 'update';
            return  $this->apiResponse($data,200);
        }catch(\Exception $e){
            $data['message'] = $e->getMessage();
            return  $this->apiResponse($data,404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cart $cart)
    {
        //
    }
}
