<?php

namespace App\Http\Controllers\Api\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use App\Branch;
use App\Restaurant;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
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
            $role = Role::get();
            $User = User::with('roles')->paginate($per_page);
            $branch = Branch::select(DB::raw('branch_name as name'),'id')->get();
            $restaurant = Restaurant::select('name','id')->get();
            $data['data'] = $User;
            $data['dataex'] = auth()->user()->hasRole('Super Admin');
            $data['xdata']['role'] = $role;
            $data['xdata']['branch'] = $branch;
            $data['xdata']['restaurant'] = $restaurant;
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
            $User = User::create($request->except('_token'));
            $data['data'] = $User;
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
     * @param  \App\User  $User
     * @return \Illuminate\Http\Response
     */
    public function show(User $User)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $User
     * @return \Illuminate\Http\Response
     */
    public function edit(User $User)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $User
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        try{
            $User = User::find($id);
            $User->update($request->except(['_token','id','created_at','updated_at','role']));
            $User->password= bcrypt($request->password);
            $User->syncRoles(json_decode($request->roles,true));
            $User->save();
            $data['data'] = $User;
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
     * @param  \App\User  $User
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $User)
    {
        //
    }

    public function search(Request $request)
    {
        try{
            $all = $request->all();
            $User = new User();
            foreach($all as $k=>$a){
                $User = $User->where($k,'like','%'.$a. '%');
            }
            $User =$User->paginate(8);
            $data['data'] =  $User;
            $data['message'] = 'block';
            return  $this->apiResponse($data,200);
        }catch(\Exception $e){
            $data['message'] = $e->getMessage();
            return  $this->apiResponse($data,404);
        }
    }
}
