<?php

namespace App\Http\Controllers\Admin;

use App\Http\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;

class CateController extends Controller
{
    //列表
    public function list(){
        $ret = Category::orderBy('cate_sort','desc')->orderBy('cate_id','desc')->paginate(15);
        $shu = count($ret);
        $cate = new Category();
        $val = $cate->getTree($ret);
        return view('admin.cate.list')->with(['val'=>$val,'shu'=>$shu,'ret'=>$ret]);
    }

    //添加
    public function add(Request $input){
        if ($input->isMethod('POST')){
            $val = $input->except('_token');
            $rules = [
                'cate_name'=>'required|max:25',
                'cate_title'=>'required|max:50',
            ];
            $msg = [
                'cate_name.required'=>'分类名称不能为空',
                'cate_name.max'=>'分类名称长度不能超过25',
                'cate_title.required'=>'分类名称不能为空',
                'cate_title.max'=>'分类名称长度不能超过25',
            ];
            $yan = Validator::make($val,$rules,$msg);
            if ($yan->fails()){
                return redirect('admin/cAdd')->withErrors($yan)
                    ->withInput();
            }
            $ret = Category::create($val);
            if ($ret){
                return redirect('admin/cList')->with('success','添加分类成功');
            }else{
                return redirect('admin/cAdd')->with('error','添加分类失败');
            }
        }else{
            $val = Category::get();
            $cate = new Category();
            $val = $cate->getTree($val);
            return view('admin.cate.add',['val'=>$val]);
        }

    }
    //排序
    public function changeSort(Request $input){
        $val = $input->except('_token');
        $ret = Category::find($val['cate_id']);
        $ret->cate_sort = $val['cate_sort'];
        $update = $ret->save();
        if ($update){
            $data = [
                'status'=>0,
                'mes'=>'分类排序成功'
            ];
        }else{
            $data = [
                'status'=>1,
                'mes'=>'分类排序失败'
            ];
        }
        return $data;
    }
    //单个删除
    public function del($cate_id){
       $val = Category::destroy($cate_id);
       if ($val){
           return redirect('admin/cList')->with('success','删除成功！');
       }else{
           return redirect('admin/cList')->with('error','删除失败！');
       }
    }
    //批量删除
    public function delete(Request $input){
        //获取请求中除了_token和cate_sort的所有数据
        $val = $input->except('_token','cate_sort');
        $data = '';
        foreach ($val as $v){
            $data = $v;
        }
        $del = Category::destroy($data);
        if ($del){
            return redirect('admin/cList')->with('success','批量删除成功！');
        }else{
            return redirect('admin/cList')->with('error','批量删除失败！');
        }
    }
    //编辑
    public function edit(Request $input , $cate_id){
        if ($input->isMethod('POST')){
            $post = $input->except('_token');
            $cate = new Category();
            $check = $cate->check($post);
            //判断返回信息是否为空
            if (!empty($check)){
                return redirect("admin/cEdit/$cate_id")->with('error',$check[0]);
            }
            $find = Category::find($cate_id);
            if ($find->cate_id == $post['cate_pid']){
                return redirect("admin/cEdit/$cate_id")->with('error','分类栏目不能相同');
            }
            //更新数据
            $ret = Category::where('cate_id',$cate_id)->update($post);
            if ($ret){
                return redirect('admin/cList')->with('success','修改分类成功！');
            }else{
                return redirect("admin/cEdit/$cate_id")->with('error','修改失败');
            }
        }else{
            $val = Category::get();
            $cate = new Category();
            $val = $cate->getTree($val);
            $fen = Category::find($cate_id);
            return view('admin.cate.edit',['val'=>$val,'fen'=>$fen]);
        }

    }
}
