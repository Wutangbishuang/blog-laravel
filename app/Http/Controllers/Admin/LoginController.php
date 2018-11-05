<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;

class LoginController extends CommonContriller
{
    public function login()
    {
        return view('admin.login');
    }
}
