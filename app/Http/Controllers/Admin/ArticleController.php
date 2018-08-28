<?php

namespace App\Http\Controllers\Admin;

use App\Http\Models\Article;
use App\Http\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use DB;

class ArticleController extends Controller
{
    //文章列表
    public function list(){
        $ret = Article::orderBy('art_sort','desc')->orderBy('art_id','desc')->paginate(15);
        $shu = count($ret);
        return view('admin.article.list')->with(['shu'=>$shu,'ret'=>$ret]);
    }

    //添加文章
    public function add(Request $input){
        if ($input->isMethod('POST')){
            $val = $input->except('_token','file_upload','file_upload1');
            $art = new Article();
            $check = $art->check($val);
            //判断返回信息是否为空
            if (!empty($check)){
                return redirect("admin/cAdd")->with('error',$check[0]);
            }
            $val['art_content'] =htmlspecialchars($val['art_content']);
            $ret = Article::create($val);
            if ($ret){
                return redirect('admin/aList')->with('success','添加文章成功');
            }else{
                return redirect('admin/aAdd')->with('error','添加文章失败');
            }
        }else{
            $val = DB::table('category')->orderBy('cate_id','asc')->get();
            return view('admin.article.add',['val'=>$val]);
        }

    }
    //排序
    public function changeSort(Request $input){
        $val = $input->except('_token');
        $ret = Article::find($val['art_id']);
        $ret->art_sort = $val['art_sort'];
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
    public function del($art_id){
       $val = Article::destroy($art_id);
       if ($val){
           return redirect('admin/aList')->with('success','删除成功！');
       }else{
           return redirect('admin/aList')->with('error','删除失败！');
       }
    }
    //批量删除
    public function delete(Request $input){
        //获取请求中除了_token和cate_sort的所有数据
        $val = $input->except('_token','art_sort');
        $data = '';
        foreach ($val as $v){
            $data = $v;
        }
        $del = Article::destroy($data);
        if ($del){
            return redirect('admin/aList')->with('success','文章批量删除成功！');
        }else{
            return redirect('admin/aList')->with('error','文章批量删除失败！');
        }
    }
    //编辑
    public function edit(Request $input , $art_id){
        if ($input->isMethod('POST')){
            $post = $input->except('_token','file_upload','file_upload1');
            $art = new Article();
            $check = $art->check($post);
            //判断返回信息是否为空
            if (!empty($check)){
                return redirect("admin/aEdit/$art_id")->with('error',$check[0]);
            }
            //更新数据
            $ret = Article::where('art_id',$art_id)->update($post);
            if ($ret){
                return redirect('admin/aList')->with('success','修改文章成功！');
            }else{
                return redirect("admin/aEdit/$art_id")->with('error','修改文章失败');
            }
        }else{
            $val = DB::table('category')->orderBy('cate_id','asc')->get();
            $ret = Article::find($art_id);
            $ret->art_content = html_entity_decode ($ret->art_content);
            $cate = Category::where('cate_id',$ret->cate_id)->get();
            return view('admin.article.edit',['val'=>$val,'ret'=>$ret,'cate'=>$cate]);
        }

    }
}
