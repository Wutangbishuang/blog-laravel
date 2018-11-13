<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class NavsController extends Controller
{
    //get.admin/nsvs 全部友情列表
    public function index()
    {
        $data = nsvs::orderBy('nav_order','asc')->get();
        return view('admin.nsvs.index',compact('data'));
    }

    public function changeOrder()
    {
        $input = Input::all();
        $nav = nsvs::find($input['nav_id']);
        $nav->nav_order = $input['nav_order'];
        $re = $nav->update();
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

    //get.admin/nsvs/create 添加自定义导航
    public function create()
    {
        return view('admin/nsvs/add');
    }

    //post.admin/nsvs 添加自定义导航提交
    public function store()
    {
        $input = Input::except('_token');
        $rules = [
            'nav_name'=>'required',
            'nav_url'=>'required',
        ];
        $message = [
            'nav_name.required'=>'自定义导航名称不能为空',
            'nav_url.required'=>'自定义导航地址不能为空',
        ];
        $validator = Validator::make($input,$rules,$message);
        if($validator->passes()){
            if(nsvs::create($input)){
                return redirect('admin/nsvs');
            }else{
                return back()->with('errors','自定义导航提交异常');
            }

        } else {
            return back()->withErrors($validator);
        }
    }

    //get.admin/nsvs/{nav}/edit  编辑自定义导航
    public function edit($nav_id)
    {
        $filed = nsvs::find($nav_id);
        return view('admin.nsvs.edit',compact('filed'));
    }

    //put.admin/nsvs  更新分类
    public function update($nav_id)
    {
        $input = Input::except('_token','_method');
        $rs = nsvs::where('nav_id',$nav_id)->update($input);
        if($rs){
            return redirect('admin/nsvs');
        }else{
            return back()->with('errors','自定义导航更新异常，暂时无法修改');
        }
    }

    //delete.admin/nsvs/{nsvs}  删除自定义导航
    public function destroy($nav_id)
    {
        $re = nsvs::where('nav_id',$nav_id)->delete();
        if($re){
            $data = [
                'status'=>'0',
                'msg'=>'自定义导航删除成功',
            ];
        }else{
            $data = [
                'status'=>'1',
                'msg'=>'自定义导航删除失败',
            ];
        }
        return $data;
    }
}
