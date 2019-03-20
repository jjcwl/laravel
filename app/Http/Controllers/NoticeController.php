<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Route;
use Illuminate\Support\Facades\Storage;

class NoticeController extends Controller{	



	public function login(){
		return redirect('login');
	}
	/* 
	/* 通知显示
	*/
	public function index(Request $request){

		$u_id=session('u_id');
		if(!$u_id){
			echo '<script>alert("用户名已失效请重新登陆");window.location.href="login";</script>';
		}
		$list=DB::table('user_role')->where('uid',$u_id)->first();
		if(!$list){
			echo "<script>alert('您没有权限访问');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";
		}
		$rid=$list->rid;
		//根据角色id判断权限id
		$data=DB::table('role_permissions')->where('rid',$rid)->first();
		$pid=$data->pid;
		//根据权限id取出权限的url
		$url=DB::select('select * from permissions where p_id in ('.$pid.')');
		foreach ($url as $value) {
			$url=$value->p_url;
			$urll=explode(',', $url);
			//获取路由
			$b=$request->path();
			//检测当前访问的路由是否在权限当中
			if(in_array($b, $urll)){
				$list = DB::table('notice')->orderBy('create_time','desc')->paginate(10);
				$list->setPath('index');
				return view('notice/index',['list'=>$list]);
			}
		}
		return "<script>alert('您没有权限访问');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";	
	}

	/* 
	/* 通知添加
	*/
	public function add(Request $request){

		$u_id=session('u_id');
		if(!$u_id){
			echo '<script>alert("用户名已失效请重新登陆");window.location.href="login";</script>';
		}
		$list=DB::table('user_role')->where('uid',$u_id)->first();
		if(!$list){
			echo "<script>alert('您没有权限访问');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";
		}
		$rid=$list->rid;
		//根据角色id判断权限id
		$data=DB::table('role_permissions')->where('rid',$rid)->first();
		$pid=$data->pid;
		//根据权限id取出权限的url
		$url=DB::select('select * from permissions where p_id in ('.$pid.')');
		foreach ($url as $value) {
			$url=$value->p_url;
			$urll=explode(',', $url);
			//获取路由
			$b=$request->path();
			//检测当前访问的路由是否在权限当中
			if(in_array($b, $urll)){
				if($request->input('sub')){
					$id=uniqid();
					$create_uid=session('u_id');
					$create_time=time();
					$content=$request->input('content');
					$title=$request->input('title');
					$data=DB::table('notice')->insert([
						'id'=>$id,'content'=>$content,'title'=>$title,
						'create_uid'=>$create_uid,
						'update_uid'=>$create_uid,'create_time'=>$create_time,
						'update_time'=>$create_time
					]);
					if($data){
						echo '<script>alert("添加成功");window.location.href="index";</script>';

					}else{
						echo '<script>alert("添加失败");window.location.href="add";</script>'; 

					}
				}
				else{
					return view('notice/add');
				}
			}
		}
		return "<script>alert('您没有权限访问');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";	
	}

	/* 
	/* 通知修改
	*/
	public function mod(Request $request){

		$u_id=session('u_id');
		if(!$u_id){
			echo '<script>alert("用户名已失效请重新登陆");window.location.href="login";</script>';
		}
		$list=DB::table('user_role')->where('uid',$u_id)->first();
		if(!$list){
			echo "<script>alert('您没有权限访问');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";
		}
		$rid=$list->rid;
		//根据角色id判断权限id
		$data=DB::table('role_permissions')->where('rid',$rid)->first();
		$pid=$data->pid;
		//根据权限id取出权限的url
		$url=DB::select('select * from permissions where p_id in ('.$pid.')');
		foreach ($url as $value) {
			$url=$value->p_url;
			$urll=explode(',', $url);
			//获取路由
			$b=$request->path();
			//检测当前访问的路由是否在权限当中
			if(in_array($b, $urll)){
				if($request->input('sub')){
					$hid=$request->input('hid');
					$create_uid=session('u_id');
					$create_time=time();
					$content=$request->input('content');
					$title=$request->input('title');
					$data=DB::table('notice')->where('id',$hid)->update([
					'content'=>$content,'title'=>$title,
					'update_uid'=>$create_uid,'update_time'=>$create_time
					]);	
					if($data){
						echo '<script>alert("修改成功");window.location.href="index";</script>';

					}else{
						echo '<script>alert("修改失败");window.location.href="mod";</script>'; 

					}
				}
				else{
					$id=$request->input('id');
					$list=DB::table('notice')->where('id',$id)->first();
					return view('notice/mod',['list'=>$list]);
				}
			}
		}
		return "<script>alert('您没有权限访问');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";	
	}

	/* 
	/* 通知删除
	*/
	public function del(Request $request){

		$u_id=session('u_id');
		if(!$u_id){
			echo '<script>alert("用户名已失效请重新登陆");window.location.href="login";</script>';
		}
		$list=DB::table('user_role')->where('uid',$u_id)->first();
		if(!$list){
			echo "<script>alert('您没有权限访问');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";
		}
		$rid=$list->rid;
		//根据角色id判断权限id
		$data=DB::table('role_permissions')->where('rid',$rid)->first();
		$pid=$data->pid;
		//根据权限id取出权限的url
		$url=DB::select('select * from permissions where p_id in ('.$pid.')');
		foreach ($url as $value) {
			$url=$value->p_url;
			$urll=explode(',', $url);
			//获取路由
			$b=$request->path();
			//检测当前访问的路由是否在权限当中
			if(in_array($b, $urll)){
				$id=$request->input('id');
				$data=DB::table('notice')->where('id',$id)->delete();
				if($data){
					echo '<script>alert("删除成功");window.location.href="index";</script>';
				}else{
					echo '<script>alert("删除失败");window.location.href="index";</script>'; 

				}
			}
		}
		return "<script>alert('您没有权限访问');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";	
	}
}