<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Links;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class LinksController extends Controller
{
    //get.admin/links 全部友情列表
    public function index()
    {
        $data = Links::orderBy('link_order','asc')->get();
        return view('admin.links.index',compact('data'));
    }

    public function changeOrder()
    {
        $input = Input::all();
        $link = Links::find($input['link_id']);
        $link->link_order = $input['link_order'];
        $re = $link->update();
        if($re){
            $data = [
                'status'=>0,
                'msg'=>'链接排序更新成功',

            ];
        }else{
            $data = [
                'status'=>1,
                'msg'=>'链接排序更新失败',

            ];
        }
        return $data;
    }

    //get.admin/links/create 添加友情链接
    public function create()
    {
        return view('admin/links/add');
    }

    //post.admin/links 添加友情链接提交
    public function store()
    {
        $input = Input::except('_token');
        $rules = [
            'link_name'=>'required',
            'link_url'=>'required',
        ];
        $message = [
            'link_name.required'=>'友情链接名称不能为空',
            'link_url.required'=>'友情链接地址不能为空',
        ];
        $validator = Validator::make($input,$rules,$message);
        if($validator->passes()){
            if(Links::create($input)){
                return redirect('admin/links');
            }else{
                return back()->with('errors','友情链接提交异常');
            }

        } else {
            return back()->withErrors($validator);
        }
    }

    //get.admin/links/{link}/edit  编辑友情链接
    public function edit($link_id)
    {
        $filed = Links::find($link_id);
        return view('admin.links.edit',compact('filed'));
    }

    //put.admin/links  更新分类
    public function update($link_id)
    {
        $input = Input::except('_token','_method');
        $rs = Links::where('link_id',$link_id)->update($input);
        if($rs){
            return redirect('admin/links');
        }else{
            return back()->with('errors','友情链接更新异常，暂时无法修改');
        }
    }

    //delete.admin/links/{links}  删除友情链接
    public function destroy($link_id)
    {
        $re = Links::where('link_id',$link_id)->delete();
        if($re){
            $data = [
                'status'=>'0',
                'msg'=>'友情链接删除成功',
            ];
        }else{
            $data = [
                'status'=>'1',
                'msg'=>'友情链接删除失败',
            ];
        }
        return $data;
    }
}
