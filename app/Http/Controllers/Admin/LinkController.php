<?php

namespace App\Http\Controllers\Admin;

use Validator;
use DB;
use Illuminate\Http\Request;
use App\Http\Models\Link;
use App\Http\Controllers\Controller;

class LinkController extends Controller
{
    //列表
    public function list(){
        $ret = Link::orderBy('link_sort','desc')->orderBy('link_id','desc')->paginate(15);
        $shu = count($ret);
        return view('admin.link.list')->with(['shu'=>$shu,'ret'=>$ret]);
    }

    //添加
    public function add(Request $input){
        if ($input->isMethod('POST')){
            $val = $input->except('_token');
            $link = new Link();
            $check = $link->check($val);
            //判断返回信息是否为空
            if (!empty($check)){
                return redirect("admin/lAdd")->with('error',$check[0]);
            }
            $ret = Link::create($val);
            if ($ret){
                return redirect('admin/lList')->with('success','添加友情链接成功');
            }else{
                return redirect('admin/lAdd')->with('error','添加友情链接失败');
            }
        }else{
            return view('admin.link.add');
        }
    }
    //排序
    public function changeSort(Request $input){
        $val = $input->except('_token');
        $ret = Link::find($val['link_id']);
        $ret->link_sort = $val['link_sort'];
        $update = $ret->save();
        if ($update){
            $data = [
                'status'=>0,
                'mes'=>'链接排序成功'
            ];
        }else{
            $data = [
                'status'=>1,
                'mes'=>'链接排序失败'
            ];
        }
        return $data;
    }
    //单个删除
    public function del($link_id){
        $val = Link::destroy($link_id);
        if ($val){
            return redirect('admin/lList')->with('success','删除链接成功！');
        }else{
            return redirect('admin/lList')->with('error','删除链接失败！');
        }
    }
    //批量删除
    public function delete(Request $input){
        //获取请求中除了_token和link_sort的所有数据
        $val = $input->except('_token','link_sort');
        $data = '';
        foreach ($val as $v){
            $data = $v;
        }
        $del = Link::destroy($data);
        if ($del){
            return redirect('admin/lList')->with('success','批量删除成功！');
        }else{
            return redirect('admin/lList')->with('error','批量删除失败！');
        }
    }
    //编辑
    public function edit(Request $input , $link_id){
        if ($input->isMethod('POST')){
            $post = $input->except('_token');
            $link= new Link();
            $check = $link->check($post);
            //判断返回信息是否为空
            if (!empty($check)){
                return redirect("admin/lEdit/$link_id")->with('error',$check[0]);
            }
            //更新数据
            $ret = Link::where('link_id',$link_id)->update($post);
            if ($ret){
                return redirect('admin/lList')->with('success','修改链接成功！');
            }else{
                return redirect("admin/lEdit/$link_id")->with('error','修改链接失败！');
            }
        }else{
            $fen = Link::find($link_id);
            return view('admin.link.edit',['fen'=>$fen]);
        }

    }
}
