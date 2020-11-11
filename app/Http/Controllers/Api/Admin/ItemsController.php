<?php

namespace App\Http\Controllers\Api\Admin;

use App\Items;
use DB;
use App\Branch;
use App\Menu;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ItemsController extends Controller
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
            if(auth()->user()->hasRole('2')){
                $items = Items::paginate($per_page);
                $branch = Branch::select(DB::raw('branch_name as name'),'id')->get();
                $menu = Menu::select(DB::raw('name as name'),'id')->get();
            }else{
                $items = Items::where('branch_id',auth()->user()->branch_id)->paginate($per_page);
                $branch = Branch::select(DB::raw('branch_name as name'),'id')->where('restaurant_id',auth()->user()->restaurant_id)->get();
                $menu = Menu::select(DB::raw('name as name'),'id')->where('branch_id',auth()->user()->branch_id)->get();

            }

            $data['data'] = $items;
             $data['xdata']['branch'] = $branch;
             $data['xdata']['menu'] = $menu;
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
            $items = Items::create($request->except('_token'));
            $this->images($request,$items);
            $data['data'] = $items;
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
     * @param  \App\Items  $items
     * @return \Illuminate\Http\Response
     */
    public function show(Items $items)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Items  $items
     * @return \Illuminate\Http\Response
     */
    public function edit(Items $items)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Items  $items
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        try{
            $items = Items::find($id);
            $items->update($request->except(['_token','id','created_at','updated_at']));
            $this->images($request,$items);
            $data['data'] = $items;
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
     * @param  \App\Items  $items
     * @return \Illuminate\Http\Response
     */
    public function destroy(Items $items)
    {
        //
    }

    public function search(Request $request)
    {
        try{
            $all = $request->all();
            $items = new Items();
            foreach($all as $k=>$a){
                $items = $items->where($k,'like','%'.$a. '%');
            }
            $items =$items->paginate(8);
            $data['data'] =  $items;
            $data['message'] = 'block';
            return  $this->apiResponse($data,200);
        }catch(\Exception $e){
            $data['message'] = $e->getMessage();
            return  $this->apiResponse($data,404);
        }
    }
}
