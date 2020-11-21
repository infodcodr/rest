<?php

namespace App\Http\Controllers\Api\Admin;

use App\User;
use App\Branch;
use App\Restaurant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try{
            $per_page = 8;
            if($request->per_page){
                $per_page=$request->per_page;
            }
            $Restaurant = Restaurant::paginate($per_page);

            $data['data'] = $Restaurant;
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
            if(!isset($request->restaurant_id)){
             $Restaurant = Restaurant::create($request->except('_token'));
             $request->merge(['restaurant_id'=>$Restaurant->id]);
            }
            $request->merge(['branch_name'=>$request->name]);
            $Branch = Branch::create($request->except(['_token','name']));
            $user = New User();
            $user->name = $request->contact_name;
            $user->password = bcrypt($request->contact_no);
            $user->mobile = $request->contact_no;
            $user->email = $request->contact_email;
            $user->save();
            $this->images($request,$Restaurant);
            $data['data'] = $Restaurant;
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
     * @param  \App\Restaurant  $Restaurant
     * @return \Illuminate\Http\Response
     */
    public function show(Restaurant $Restaurant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Restaurant  $Restaurant
     * @return \Illuminate\Http\Response
     */
    public function edit(Restaurant $Restaurant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Restaurant  $Restaurant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        try{
            $Restaurant = Restaurant::find($id);
            $Restaurant->update($request->except(['_token','id','created_at','updated_at']));
            $this->images($request,$Restaurant);
            $data['data'] = $Restaurant;
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
     * @param  \App\Restaurant  $Restaurant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Restaurant $Restaurant)
    {
        //
    }

    public function search(Request $request)
    {
        try{
            $all = $request->all();
            $Restaurant = new Restaurant();
            foreach($all as $k=>$a){
                $Restaurant = $Restaurant->where($k,'like','%'.$a. '%');
            }
            $Restaurant =$Restaurant->paginate(8);
            $data['data'] =  $Restaurant;
            $data['message'] = 'block';
            return  $this->apiResponse($data,200);
        }catch(\Exception $e){
            $data['message'] = $e->getMessage();
            return  $this->apiResponse($data,404);
        }
    }
}
