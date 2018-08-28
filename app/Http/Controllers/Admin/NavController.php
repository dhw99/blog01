<?php

namespace App\Http\Controllers\Admin;

use Validator;
use DB;
use Illuminate\Http\Request;
use App\Http\Models\Nav;
use App\Http\Controllers\Controller;

class NavController extends Controller
{
    //列表
    public function list(){
        $ret = Nav::orderBy('nav_sort','desc')->orderBy('nav_id','desc')->paginate(15);
        $shu = count($ret);
        return view('admin.nav.list')->with(['shu'=>$shu,'ret'=>$ret]);
    }

    //添加
    public function add(Request $input){
        if ($input->isMethod('POST')){
            $val = $input->except('_token');
            $Nav = new Nav();
            $check = $Nav->check($val);
            //判断返回信息是否为空
            if (!empty($check)){
                return redirect("admin/nAdd")->with('error',$check[0]);
            }
            $ret = Nav::create($val);
            if ($ret){
                return redirect('admin/nList')->with('success','添加导航成功');
            }else{
                return redirect('admin/nAdd')->with('error','添加导航失败');
            }
        }else{
            return view('admin.nav.add');
        }
    }
    //排序
    public function changeSort(Request $input){
        $val = $input->except('_token');
        $ret = Nav::find($val['nav_id']);
        $ret->nav_sort = $val['nav_sort'];
        $update = $ret->save();
        if ($update){
            $data = [
                'status'=>0,
                'mes'=>'导航排序成功'
            ];
        }else{
            $data = [
                'status'=>1,
                'mes'=>'导航排序失败'
            ];
        }
        return $data;
    }
    //单个删除
    public function del($nav_id){
        $val = Nav::destroy($nav_id);
        if ($val){
            return redirect('admin/nList')->with('success','删除导航成功！');
        }else{
            return redirect('admin/nList')->with('error','删除导航失败！');
        }
    }
    //批量删除
    public function delete(Request $input){
        //获取请求中除了_token和nav_sort的所有数据
        $val = $input->except('_token','nav_sort');
        $data = '';
        foreach ($val as $v){
            $data = $v;
        }
        $del = Nav::destroy($data);
        if ($del){
            return redirect('admin/nList')->with('success','导航批量删除成功！');
        }else{
            return redirect('admin/nList')->with('error','导航批量删除失败！');
        }
    }
    //编辑
    public function edit(Request $input , $nav_id){
        if ($input->isMethod('POST')){
            $post = $input->except('_token');
            $nav= new Nav();
            $check = $nav->check($post);
            //判断返回信息是否为空
            if (!empty($check)){
                return redirect("admin/nEdit/$nav_id")->with('error',$check[0]);
            }
            //更新数据
            $ret = Nav::where('nav_id',$nav_id)->update($post);
            if ($ret){
                return redirect('admin/nList')->with('success','修改导航成功！');
            }else{
                return redirect("admin/nEdit/$nav_id")->with('error','修改导航失败！');
            }
        }else{
            $fen = Nav::find($nav_id);
            return view('admin.nav.edit',['fen'=>$fen]);
        }

    }
}
