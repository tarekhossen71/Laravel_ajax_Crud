<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    // file upload
    protected function file_upload($file, $folder){
            $product_image = $file;
            $imageExt = $product_image->getClientOriginalExtension();
            $imageUniqueName = md5(time().rand()).'.'.$imageExt;
            $product_image->move($folder, $imageUniqueName);

            return $imageUniqueName;
    }
    // file update 
    protected function file_update($file, $folder, $old_file){
            if($old_file != null){
                file_exists($folder.$old_file) ? unlink($folder.$old_file) : false;
            }
            $imageExt = $file->getClientOriginalExtension();
            $imageUniqueName = md5(time().rand()).'.'.$imageExt;
            $file->move($folder, $imageUniqueName);

            return $imageUniqueName;
    }

    // file remove 
    protected function file_remove($folder, $old_file){
        file_exists($folder.$old_file) ? unlink($folder.$old_file) : false;
    }

}
