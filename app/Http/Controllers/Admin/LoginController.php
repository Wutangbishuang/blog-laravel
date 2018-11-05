<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;

require_once 'resources/org/code/Code.class.php';

class LoginController extends CommonContriller
{
    public function login()
    {
        if($input = Input::all()){
            $code = new \Code;
            $getcode = $code->get();
            if(strtoupper($input['code'])!=$getcode){
                return back()->with('msg','验证码错误');
            }else{
                echo 'OK';
            }
        }else{
            return view('admin.login');
        }
    }

    public function code()
    {
        $code = new \Code;
        $code->make();
    }

}
