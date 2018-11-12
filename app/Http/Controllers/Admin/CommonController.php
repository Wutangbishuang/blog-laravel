<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class CommonController extends Controller
{
    //缩略图失败
    /*public function upload()
    {
        $file = Input::file('Filedata');
        if($file->isValid()){
            $realPath = $file->getRealRath();//临时文件绝对路径

            $entension = $file->getClientOriginalExtension();//上传文件后缀
            $newName = data('YmdHis').mt_rant(100,999).'.'.$entension;

            $path = $file->move(base_path().'/uploads',$newName);
            $filepath = 'uploads/'.$newName;
            return $filepath;
        }
    }*/
}
