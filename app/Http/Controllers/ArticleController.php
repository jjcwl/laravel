<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Route;

class ArticleController extends Controller{

	/**
	* 文章显示
	*/
	public function index(Request $request){
		
		$list = DB::table('article')->paginate(10);
		$list->setPath('index');
		return view('article/index',['list'=>$list]);
	}
	/**
	*文章添加
	*/
	public function add(Request $request){
		if($request->input('sub')){
			$id=uniqid();
			$create_uid=session('u_id');
			$create_time=time();
			$title=$request->input('title');
			$author=$request->input('author');
			$describe=$request->input('describe');
			$content=$request->input('content');
			$list=DB::table('article')->insert([
				'id'=>$id,'title'=>$title,'content'=>$content,'author'=>$author,
				'describe'=>$describe,'create_uid'=>$create_uid,'update_uid'=>$create_uid,
				'create_time'=>$create_time,'update_time'=>$create_time
			]);
			if($list){
			return redirect('article/index');
			}
			else{
				return redirect('article/index');
			}
		}
		else{
			return view('article/add');
		}
	}

	/**
	*文章修改
	*/
	public function mod(Request $request){
		if($request->input('sub')){
			$create_uid=session('u_id');
			$create_time=time();
			$hid=$request->input('hid');
			$title=$request->input('title');
			$content=$request->input('content');
			$author=$request->input('author');
			$describe=$request->input('describe');
			$url=$request->input('url');
			$list=DB::table('article')->where('id',$hid)->update([
				'title'=>$title,'content'=>$content,'author'=>$author,
				'describe'=>$describe,'update_uid'=>$create_uid,
				'update_time'=>$create_time
			]);
			if($list){
			return redirect('article/index');
			}
			else{
				return redirect('article/index');
			}
		}
		else{
			$id=$request->input('id');
			$list=DB::table('article')->where('id',$id)->first();
			return view('article/mod',['list'=>$list]);
		}

	}
	public function del(Request $request){
		$id=$request->input('id');
		$data=DB::table('article')->where('id',$id)->delete();
		if($data){
			return redirect('article/index');
		}
		else{
			return redirect('article/index');
		}
	}
}