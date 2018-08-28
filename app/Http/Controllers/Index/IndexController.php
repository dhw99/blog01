<?php

namespace App\Http\Controllers\Index;

use App\Http\Models\Article;
use App\Http\Models\Category;
use App\Http\Models\Link;
use App\Http\Models\Person;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\Nav;
use Illuminate\Support\Facades\View;

class IndexController extends Controller
{
    //使用构造函数分配导航
    public function __construct()
    {
        $val = Nav::get();
        //共享视图数据
        View::share('val',$val);
    }

    //首页
    public function index(){
        //文章列表，
        $wen = Article::orderBy('art_id','desc')->paginate(6);
        //点击排行
        $pai = Article::orderBy('art_count','desc')->take(3)->get();
        //站长推荐4篇
        $tui = Article::orderBy('art_id','desc')->take(4)->get();
        //友情链接
        $link = Link::take(3)->get();
        return view('index.index',['wen'=>$wen,'pai'=>$pai,'tui'=>$tui,'link'=>$link]);
    }

    //展示文章
    public function list($art_id){
        $list = Article::find($art_id);//获取文章的信息
        //自增
        Article::where('art_id',$art_id)->increment('art_count');
        //标题小导航
        $cate = Category::find($list->cate_id);
        if ($cate->cate_pid != 0){
            $name = Category::find($cate->cate_pid);
            $cate->name = $name['cate_name'];
        }
        $list->art_content = htmlspecialchars_decode($list->art_content);
        //上一篇
        $pre = Article::where('art_id','<',$art_id)->orderBy('art_id','desc')->first();
        //下一篇
        $next = Article::where('art_id','>',$art_id)->orderBy('art_id','asc')->first();
        //相关文章
        $related = Article::where('cate_id',$list->cate_id)->take(10)->get();
        //栏目导航
        $data = Category::get();
        $data = $this->getTree($data);
        //站长推荐
        $tui = Article::orderBy('art_id','desc')->take(4)->get();
        return view('index.list',['cate'=>$cate,'list'=>$list,'pre'=>$pre,'next'=>$next,
            'xg'=>$related,'data'=>$data,'tui'=>$tui]);
    }

    //重组数组
    public function getTree($data){
        $arr =  [];
        foreach ($data as $k=>$v){
            if ($v->cate_pid == 0){
                $data[$k]['cate_name']=$data[$k]['cate_name'];
                $arr[] = $data[$k];
                foreach ($data as $k1=>$v1){
                    if ($v1->cate_pid == $v->cate_id){
                        $data[$k1]['cate_name']=str_repeat('-',8).$data[$k1]['cate_name'];
                        $arr[]=$data[$k1];
                    }
                }
            }
        }
        return $arr;
    }
    //文章分类
    public function info($cate_id){
        //栏目导航
        $data = Category::get();
        $data = $this->getTree($data);
        //站长推荐
        $tui = Article::orderBy('art_id','desc')->take(4)->get();
        //标题小导航
        $cate = Category::find($cate_id);
        //点击排行
        $pai = Article::orderBy('art_count','desc')->take(4)->get();
        //文章列表分页
        $wen = Article::where('cate_id',$cate_id)->orderBy('art_id','desc')->paginate(6);
        return view('index.info',['data'=>$data,'tui'=>$tui,
            'cate'=>$cate,'pai'=>$pai,'wen'=>$wen]);
    }
    //关于我
    public function about($id){
        $value = Person::find($id);
        $about = 'about/'.$id;
        $about = Nav::where('nav_url',$about)->get();
        return view('index.about',['value'=>$value,'about'=>$about]);
    }
    //搜索
    public function search(Request $post){
        //文章列表
        $str = "%".$post->search."%";//只允许text字段输入;
        $wen = Article::where('art_title','like',$str)
                    ->orwhere('art_author','like',$str)
                    ->orwhere('art_content','like',$str)->paginate(6);
        //判断结果集是否为空
        if ($wen->isEmpty()){
            $wen = '你要搜索的文章不存在！';
        }
        //点击排行
        $dian = Article::orderBy('art_count','desc')->take(6)->get();
        return view('index.search')->with(compact('dian','wen'));
    }
}
