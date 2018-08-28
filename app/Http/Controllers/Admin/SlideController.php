<?php

namespace App\Http\Controllers\Admin;

use Validator;
use DB;
use Illuminate\Http\Request;
use App\Http\Models\Slide;
use App\Http\Controllers\Controller;

class SlideController extends Controller
{
    //列表
    public function list(){
        $ret = Slide::orderBy('slide_sort','desc')->orderBy('slide_id','desc')->paginate(15);
        $shu = count($ret);
        return view('admin.slide.list')->with(['shu'=>$shu,'ret'=>$ret]);
    }

    //添加
    public function add(Request $input){
        if ($input->isMethod('POST')){
            $val = $input->except('_token','file_upload');
            $Slide = new Slide();
            $check = $Slide->check($val);
            //判断返回信息是否为空
            if (!empty($check)){
                return redirect("admin/sAdd")->with('error',$check[0]);
            }
            $ret = Slide::create($val);
            if ($ret){
                return redirect('admin/sList')->with('success','添加轮播图成功');
            }else{
                return redirect('admin/sAdd')->with('error','添加轮播图失败');
            }
        }else{
            return view('admin.slide.add');
        }
    }
    //排序
    public function changeSort(Request $input){
        $val = $input->except('_token');
        $ret = Slide::find($val['slide_id']);
        $ret->slide_sort = $val['slide_sort'];
        $update = $ret->save();
        if ($update){
            $data = [
                'status'=>0,
                'mes'=>'轮播图排序成功'
            ];
        }else{
            $data = [
                'status'=>1,
                'mes'=>'轮播图排序失败'
            ];
        }
        return $data;
    }
    //单个删除
    public function del($slide_id){
        $val = Slide::destroy($slide_id);
        if ($val){
            return redirect('admin/sList')->with('success','删除轮播图成功！');
        }else{
            return redirect('admin/sList')->with('error','删除轮播图失败！');
        }
    }
    //批量删除
    public function delete(Request $input){
        //获取请求中除了_token和slide_sort的所有数据
        $val = $input->except('_token','slide_sort');
        $data = '';
        foreach ($val as $v){
            $data = $v;
        }
        $del = Slide::destroy($data);
        if ($del){
            return redirect('admin/sList')->with('success','轮播图批量删除成功！');
        }else{
            return redirect('admin/sList')->with('error','轮播图批量删除失败！');
        }
    }
    //编辑
    public function edit(Request $input , $slide_id){
        if ($input->isMethod('POST')){
            $post = $input->except('_token','file_upload');
            $Slide= new Slide();
            $check = $Slide->check($post);
            //判断返回信息是否为空
            if (!empty($check)){
                return redirect("admin/sEdit/$slide_id")->with('error',$check[0]);
            }
            //更新数据
            $ret = Slide::where('slide_id',$slide_id)->update($post);
            if ($ret){
                return redirect('admin/sList')->with('success','修改轮播图成功！');
            }else{
                return redirect("admin/sEdit/$slide_id")->with('error','修改轮播图失败！');
            }
        }else{
            $fen = Slide::find($slide_id);
            return view('admin.slide.edit',['fen'=>$fen]);
        }

    }
}
