<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Navs;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class NavsController extends Controller
{
    //get.admin/navs 全部友情列表
    public function index()
    {
        $data = Navs::orderBy('nav_order','asc')->get();
        return view('admin.navs.index',compact('data'));
    }

    public function changeOrder()
    {
        $input = Input::all();
        $nav = Navs::find($input['nav_id']);
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

    //get.admin/navs/create 添加自定义导航
    public function create()
    {
        return view('admin/navs/add');
    }

    //post.admin/navs 添加自定义导航提交
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
            if(Navs::create($input)){
                return redirect('admin/navs');
            }else{
                return back()->with('errors','自定义导航提交异常');
            }

        } else {
            return back()->withErrors($validator);
        }
    }

    //get.admin/navs/{nav}/edit  编辑自定义导航
    public function edit($nav_id)
    {
        $filed = Navs::find($nav_id);
        return view('admin.navs.edit',compact('filed'));
    }

    //put.admin/navs  更新分类
    public function update($nav_id)
    {
        $input = Input::except('_token','_method');
        $rs = Navs::where('nav_id',$nav_id)->update($input);
        if($rs){
            return redirect('admin/navs');
        }else{
            return back()->with('errors','自定义导航更新异常，暂时无法修改');
        }
    }

    //delete.admin/navs/{navs}  删除自定义导航
    public function destroy($nav_id)
    {

        $re = Navs::where('nav_id',$nav_id)->delete();
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
