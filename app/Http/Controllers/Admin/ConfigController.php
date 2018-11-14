<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Config;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class ConfigController extends Controller
{
    //get.admin/config 全部友情列表
    public function index()
    {
        $data = Config::orderBy('conf_order','asc')->get();
        foreach($data as $k=>$v){
            switch ($v->field_type){
                case 'input';
                $data[$k]->_html ='<input type="text" name="conf_content" value="'.$v->conf_content.'">';

                break;
                case 'textarea';
                $data[$k]->_html ='<textarea type="text" name="conf_content">.{$v->conf_content.</textarea>';
                break;
                case 'radio';
                $arr = explode(',',$v->field_value);
                $str = '';
                foreach($arr as $m=>$n){
                    $r = explode('|',$n);
                    $c =$v->conf_content==$r[0]?' checked ':'';
                    $str .='<input type="radio" name="conf_content[]" value="'.$r[0].'"'.$c.'>'.$r[1];
                }
                $data[$k]->_html = $str;
                break;
            }
        }
        return view('admin.config.index',compact('data'));
    }

    public function changeOrder()
    {
        $input = Input::all();
        $nav = Config::find($input['conf_id']);
        $nav->conf_order = $input['conf_order'];
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

    //get.admin/config/create 添加配置项
    public function create()
    {
        return view('admin/config/add');
    }

    //post.admin/config 添加配置项提交
    public function store()
    {

        $input = Input::except('_token');
        $rules = [
            'conf_name'=>'required',
            'conf_title'=>'required',
        ];
        $message = [
            'conf_name.required'=>'配置项名称不能为空',
            'conf_title.required'=>'配置项标题不能为空',
        ];
        $validator = Validator::make($input,$rules,$message);
        if($validator->passes()){
            if(Config::create($input)){
                return redirect('admin/config');
            }else{
                return back()->with('errors','配置项提交异常');
            }

        } else {
            return back()->withErrors($validator);
        }
    }

    //get.admin/config/{nav}/edit  编辑配置项
    public function edit($conf_id)
    {
        $field = Config::find($conf_id);
        return view('admin.config.edit',compact('field'));
    }

    //put.admin/config  更新分类
    public function update($conf_id)
    {
        $input = Input::except('_token','_method');
        $rs = Config::where('conf_id',$conf_id)->update($input);
        if($rs){
            return redirect('admin/config');
        }else{
            return back()->with('errors','配置项更新异常，暂时无法修改');
        }
    }

    //delete.admin/config/{config}  删除配置项
    public function destroy($conf_id)
    {

        $re = Config::where('conf_id',$conf_id)->delete();
        if($re){
            $data = [
                'status'=>'0',
                'msg'=>'配置项删除成功',
            ];
        }else{
            $data = [
                'status'=>'1',
                'msg'=>'配置项删除失败',
            ];
        }
        return $data;
    }

    public function show()
    {
        
    }

    public function changeContent()
    {
        $input = Input::all();
        foreach($input['conf_id'] as $k=>$v){
            Config::where('conf_id',$v)->update(['conf_content'=>$input['conf_content'][$k]]);
        }
        return back();
    }

    public function putFile()
    {
        echo 789;
    }
}
