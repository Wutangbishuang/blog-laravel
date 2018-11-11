<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ArtController extends CommonController
{
    //get.admin/article 全部文章列表
    public function index()
    {
        echo '999';
    }

    //get.admin/article/create add文章
    public function create()
    {
        $data=[];
        return view('admin.article.add',compact('data'));
    }
}
