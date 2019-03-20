<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RoleController extends Controller{

	public function index(Request $request){

		//根据用户id取出角色id
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
				
				$list = DB::table('role')->orderBy('create_time','desc')->paginate(10);
				$list->setPath('index');
				return view('role/index',['list'=>$list]);
			}
		}
		return "<script>alert('您没有权限访问');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";
		
	}

	//权限添加
	public function permissions(Request $request){

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
					$pid=$request->input('p_type');
					$pid=implode(',', $pid);
					$ro_id=uniqid();
					$create_uid=session('u_id');
					$create_time=time();
					$data=DB::table('role_permissions')->where('rid',$id)->first();
					if($data){
						$list=DB::table('role_permissions')->where('rid',$id)->update([
							'pid'=>$pid,'update_uid'=>$create_uid,'update_time'=>$create_time
							]);
						if($list){
							echo '<script>alert("添加成功");window.location.href="index";</script>';

						}else{
							echo '<script>alert("添加失败");window.location.href="add";</script>'; 

						}
					}
					else{
						$list=DB::table('role_permissions')->insert([
							'ro_id'=>$ro_id,'rid'=>$id,'pid'=>$pid,'create_uid'=>$create_uid,
							'update_uid'=>$create_uid,'create_time'=>$create_time,
							'update_time'=>$create_time
							]);
						if($list){
							echo '<script>alert("添加成功");window.location.href="index";</script>';

						}else{
							echo '<script>alert("添加失败");window.location.href="add";</script>'; 

						}
					}	
				}
				else{
					//查询权限表
					$list = DB::table('permissions')->get();
					$id=$request->input('id');
					//查询角色权限表
					$data=DB::table('role_permissions')->where('rid',$id)->first();
					if($data){
						$pid=$data->pid;
						$pid=explode(',',$pid);
						return view('role/permissions',['list'=>$list,'id'=>$id,'pid'=>$pid,'data'=>$data]);
					}
					return view('role/permissions',['list'=>$list,'id'=>$id,'data'=>$data]);
				}
			}
		}
		return "<script>alert('您没有权限访问');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";
		
	}

	//角色添加
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
					$r_name=$request->input('r_name');
					$data=DB::table('role')->where('r_name',$r_name)->first();
					if($data){
						return redirect('role/add');
					}
					$r_id=uniqid();
					$create_uid=session('u_id');
					$create_time=time();
					$list=DB::table('role')->insert([
						'r_id'=>$r_id,'r_name'=>$r_name,'create_uid'=>$create_uid,
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
					return view('role/add');
				}
			}
		}
		return "<script>alert('您没有权限访问');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";
	}

	//角色信息修改
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
					$r_name=$request->input('r_name');
					$p_type=$request->input('p_type');
					$create_uid=session('u_id');
					$create_time=time();
					$p_type=implode(',',$p_type);
					if($p_type){
						$per=DB::table('role_permissions')->where('rid',$hid)->update([
							'pid'=>$p_type,'update_uid'=>$create_uid,'update_time'=>$create_time
							]);
					}
					$role=DB::table('role')->where('r_id',$hid)->update([
						'r_name'=>$r_name,'update_uid'=>$create_uid,'update_time'=>$create_time
						]);
					if($role){
						echo '<script>alert("修改成功");window.location.href="index";</script>';

					}else{
						echo '<script>alert("修改失败");window.location.href="mod";</script>'; 

					}
				}
				else{
					$id=$request->input('id');
					$list=DB::table('role')->where('r_id',$id)->first();
					$permissions = DB::table('permissions')->get();
					$data=DB::table('role_permissions')->where('rid',$id)->first();
					if($data){
						$pid=$data->pid;
						$pid=explode(',',$pid);
						return view('role/mod',['list'=>$list,'pid'=>$pid,'data'=>$data,'permissions'=>$permissions]);
					}
					return view('role/mod',['list'=>$list,'data'=>$data,'permissions'=>$permissions]);
				}
			}
		}
		return "<script>alert('您没有权限访问');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";
	}

	//角色删除
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
				$data=DB::table('role')->where('r_id',$id)->delete();
				if($data){
					echo '<script>alert("删除成功");window.location.href="index";</script>';

				}else{
					echo '<script>alert("删除失败");window.location.href="index";</script>'; 

				}
			}
		}
		return "<script>alert('您没有权限访问');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";
	}
	public function login(){
		return redirect('login');
	}
}