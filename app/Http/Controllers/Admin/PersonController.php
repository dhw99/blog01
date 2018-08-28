<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Models\Person;

class PersonController extends CommonController
{
    //列表
    public function list(){
        $ret = Person::all();
        return view('admin.person.list',['ret'=>$ret]);
    }
    //添加介绍
    public function add(Request $post){
        if ($post->isMethod('POST')){
            $post = $post->except('_token');
            //验证数据
            $check = new Person();
            $ret =$check->validate($post);
            if (!empty($ret)){
                return redirect("admin/aboutAdd")->with('error',$ret[0]);
            }
            $val = Person::create($post);
            if ($val){
                return redirect("admin/aboutList")->with('success','添加个人信息成功');
            }else{
                return redirect("admin/aboutAdd")->with('error','添加个人信息失败');
            }
        }else{
            return view('admin.person.add');
        }

    }
    //编辑介绍
    public function edit(Request $post,$id){
        if ($post->isMethod('POST')){
            $post = $post->except('_token');
            //验证数据
            $check = new Person();
            $ret =$check->validate($post);
            if (!empty($ret)){
                return redirect("admin/aboutEdit/$id")->with('error',$ret[0]);
            }
            $result= Person::where('about_id',$id)->update($post);
            if ($result){
                return redirect("admin/aboutList")->with('success','修改个人信息成功');
            }else{
                return redirect("admin/aboutEdit/$id")->with('error','修改失败！');
            }
        }else{
            $val = Person::find($id);
            return view('admin.person.edit',['val'=>$val]);
        }
    }
    //删除介绍
    public function del($id){
        $val = Person::destroy($id);
        if ($val){
            return redirect('admin/aboutList')->with('success','删除介绍成功！');
        }else{
            return redirect('admin/aboutList')->with('error','删除介绍失败！');
        }
    }
}
