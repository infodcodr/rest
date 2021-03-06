<?php

namespace App\Http\Controllers\Api\Admin;

use App\Menu;
use DB;
use App\Branch;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MenuController extends Controller
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
                $menu = Menu::with('images','category')->paginate($per_page);
                $branch = Branch::select(DB::raw('branch_name as name'),'id')->get();
                $category = Category::select('name','id')->get();
            }else{
                $menu = Menu::with('images','category')->where('branch_id',auth()->user()->branch_id)->paginate($per_page);
                $branch = Branch::select(DB::raw('branch_name as name'),'id')->where('restaurant_id',auth()->user()->restaurant_id)->get();
                $category = Category::select('name','id')->where('branch_id',auth()->user()->branch_id)->get();
            }
            $data['data'] = $menu;
            $data['xdata']['branch'] = $branch;
            $data['xdata']['category'] = $category;
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
            $menu = Menu::create($request->except('_token'));
            $this->images($request,$menu);
            $menu->category()->sync(json_decode($request->category,true));
            $data['data'] = $menu;
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
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function show(Menu $menu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        try{
            $menu = Menu::find($id);
            $menu->update($request->except(['_token','id','created_at','updated_at']));
            $this->images($request,$menu);
            $menu->category()->sync(json_decode($request->category,true));
            $data['data'] = $request->category;
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
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu)
    {
        //
    }

    public function search(Request $request)
    {
        try{
            $all = $request->all();
            $menu = new Menu();
            foreach($all as $k=>$a){
                $menu = $menu->where($k,'like','%'.$a. '%');
            }
            $menu =$menu->paginate(8);
             $branch = Branch::select(DB::raw('branch_name as name'),'id')->get();
            $data['data'] = $menu;
            $data['xdata']['branch'] = $branch;
            $data['message'] = 'block';
            return  $this->apiResponse($data,200);
        }catch(\Exception $e){
            $data['message'] = $e->getMessage();
            return  $this->apiResponse($data,404);
        }
    }
}
