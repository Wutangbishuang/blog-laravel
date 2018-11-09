<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Category;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CategoryController extends CommonController
{
    //get。admin/category  全部分类列表
    public function index()
    {
        $categorys = (new Category)->tree();

        return view('admin.category.index')->with('data',$categorys);
    }

    /*public function getTree($data,$field_name,$field_id='id',$field_pid='pid',$pid='0')
    {
        $arr = array();
        foreach ($data as $k=>$v){
            if($v->$field_pid==$pid){
                $data[$k]["_".$field_name] = '' . $data[$k][$field_name];
                $arr[] = $data[$k];
                foreach ($data as $m=>$n){
                    if($n->$field_pid == $v->$field_id){
                        $data[$m]['_cate_name'] = '--' . $data[$m]['cate_name'];
                        $arr[] = $data[$m];
                    }
                }
            }
        }
        return $arr;*/

        /*$arr = array();
        foreach ($data as $k=>$v){
            if($v->cate_pid==0){
                $data[$k]["_cate_name"] = '' . $data[$k]['cate_name'];
                $arr[] = $data[$k];
                foreach ($data as $m=>$n){
                    if($n->cate_pid == $v->cate_id){
                        $data[$m]['_cate_name'] = '--' . $data[$m]['cate_name'];
                        $arr[] = $data[$m];
                    }
                }
            }
        }
        return $arr;*/
    //}

    //get。admin/category
    public function store()
    {

    }

    //get。admin/category/create  添加分类
    public function create()
    {

    }

    //get.admin/category/{category}  显示单个分类信息
    public function show()
    {

    }

    //delete.admin/category/{category}  删除单个分类
    public function destrop()
    {

    }

    //put.admin/category  更新分类
    public function update()
    {

    }

    //get.admin/category/{category}/edit  编辑分类
    public function edit()
    {

    }
}
