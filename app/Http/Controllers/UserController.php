<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Route;

class UserController extends Controller{	

	

	//数据显示
	public function index(Request $request){
		
				$uname=$request->input('uname');
				if($uname){
					$list = DB::table('user')->where('u_name','like','%'.$uname.'%')->orderBy('create_time','desc')->paginate(10);
					$list->setPath('index');
					// $data=DB::table('user_role')
					// 	  ->join('user','user_role.uid','=','user.u_id')
					// 	  ->join('role','user_role.rid','=','role.r_id')
					// 	  ->get();
				}
				else{
					$list = DB::table('user')->orderBy('create_time','desc')->paginate(10);
					$list->setPath('index');
					// $data=DB::table('user_role')
					// 	  ->join('user','user_role.uid','=','user.u_id')
					// 	  ->join('role','user_role.rid','=','role.r_id')
					// 	  ->get();

				}
				return view('user/index',['list'=>$list,'uname'=>$uname]);

	}

	public function login(){
		return redirect('login');
	}

	//数据添加
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
					//判断用户名是否重复
					$list = DB::table('user')->get();
					foreach ($list as $value) {
						$u_name=$value->u_name;
						$uname=$request->input('u_name');
						if($u_name==$uname){
							echo '<script>alert("用户已存在");window.location.href="add";</script>';
						}
					}
					//接受form传值进行数据添加
					$u_id=uniqid();
					$create_uid=session('u_id');
					$create_time=time();
					$u_name=$request->input('u_name');
					$u_pwd=$request->input('u_pwd');
					$data=DB::table('user')->insert([
						'u_id'=>$u_id,'u_name'=>$u_name,'u_pwd'=>$u_pwd,'create_uid'=>$create_uid,
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
					return view('user/add');
				}
			}
			
		}
		return "<script>alert('您没有权限访问');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";
		
	}

	//角色添加
	public function role(Request $request){

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
					$id=$request->input('hid');
					$us_id=uniqid();
					$create_uid=session('u_id');
					$create_time=time();
					$rid=$request->input('r_name');
					$list=DB::table('user_role')->insert([
						'us_id'=>$us_id,'uid'=>$id,'rid'=>$rid,'create_uid'=>$create_uid,
						'update_uid'=>$create_uid,'create_time'=>$create_time,
						'update_time'=>$create_time
						]);
					if($list){
						echo '<script>alert("添加成功");window.location.href="index";</script>';

					}else{
						echo '<script>alert("添加失败");window.location.href="add";</script>'; 

					}
				}
				else{
					$list = DB::table('role')->get();
					$id=$request->input('id');
					$data=DB::table('user_role')->where('uid',$id)->first();
					return view('user/role',['list'=>$list,'id'=>$id,'data'=>$data]);
				}
			}
			
		}	
		return "<script>alert('您没有权限访问');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";

	}

	//用户信息修改
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
					$update_uid=session('u_id');
					$update_time=time();
					$hid=$request->input('hid');
					$u_name=$request->input('u_name');
					$u_pwd=$request->input('u_pwd');
					$r_name=$request->input('r_name');
					//判断有没有选择角色
					if($r_name){
						$data=DB::table('user_role')->get();
						//与数据库信息比对然后进行修改或添加
						foreach ($data as $value) {
							$uid=$value->uid;
							if($uid==$hid){
								$list=DB::table('user_role')->where('uid',$uid)->update([
									'rid'=>$r_name,'update_uid'=>$update_uid,
									'update_time'=>$update_time
									]);
							}
						}
					}
					$list=DB::table('user')->where('u_id',$hid)->update([
						'u_name'=>$u_name,'u_pwd'=>$u_pwd,'update_uid'=>$update_uid,
						'update_time'=>$update_time
						]);
					if($list){
						echo '<script>alert("修改成功");window.location.href="index";</script>';

					}else{
						echo '<script>alert("修改失败");window.location.href="mod";</script>'; 

					}
				}
				else{
					$id=$request->input('id');
					$list=DB::table('user')->where('u_id',$id)->first();
					$data=DB::table('user_role')->where('uid',$id)->first();
					$role=DB::table('role')->get();
					return view('user/mod',['list'=>$list,'role'=>$role,'data'=>$data]);
				}
			}
		}
		return "<script>alert('您没有权限访问');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";
	}

	//用户删除
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
				$data=DB::table('user')->where('u_id',$id)->delete();
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