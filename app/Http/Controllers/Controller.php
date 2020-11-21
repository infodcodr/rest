<?php

namespace App\Http\Controllers;

use App\Images;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

	public function apiResponse ($data , $status)
	{
        $data['status']=0;
        if($status == 200){
            $data['status']=1;
        }
        $json = json_encode($data);
        $decode = json_decode($json,true);
        array_walk_recursive($decode,function(&$item){$item=strval($item);});

		return response()->json($decode,$status);
    }

    public function images($request,$model){
        if ($request->has('rmvimg')) {
            $images = Images::whereIn('id',explode(",",$request->get('rmvimg')))->delete();
        }
        if ($request->has('files')) {
            foreach($request->file('files') as $file){
                $filenameWithExt = $file->getClientOriginalName();


                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                // Get just ext
                $extension = $file->getClientOriginalExtension();
                // Filename to store
                $fileNameToStore = $filename . '_' . time() . '.' . $extension;
                // Upload Image
                $file->storeAs('public/files', $fileNameToStore);


                $image = New Images();
                $image->name = $fileNameToStore;
                $image->image_type = get_class($model);
                $image->image_id = $model->id;
                $image->save();
                //$model->images()->save($image);
            }
        }
    }
}
