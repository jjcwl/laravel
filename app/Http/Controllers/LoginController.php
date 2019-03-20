<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller{

	/*
	//登录模块
	//
	 */
	public function login(Request $request){

		if($request->input('sub')){
			$u_name=$request->input('u_name');
			$u_pwd=$request->input('u_pwd');
			$list=DB::table('user')->where('u_name',$u_name)->where('u_pwd',$u_pwd)->first();
			if($list){
				$u_id=$list->u_id;
				//根据用户id查询用户角色表中的角色id
				$data=DB::table('user_role')->where('uid',$u_id)->first();
				if(!$data){
					$u_id=$request->session()->put('u_id',$u_id);
					$u_name=$request->session()->put('u_name',$u_name);
					echo '<script>alert("登录成功");window.location.href="user/index";</script>';
				}
				$rid=$data->rid;
				//根据角色id查询出角色名称
				$roles=DB::table('role')->where('r_id',$rid)->first();
				$r_name=$roles->r_name;
				//给角色名称，用户名称，用户id赋值session
				$r_name=$request->session()->put('r_name',$r_name);
				$u_id=$request->session()->put('u_id',$u_id);
				$u_name=$request->session()->put('u_name',$u_name);
				echo '<script>alert("登录成功");window.location.href="user/index";</script>';

			}
			else{
				echo '<script>alert("登录失败");window.location.href="login";</script>'; 
			}
			
		}
		else{
			return view('login/login');
		}
		
	}
	public function index(){
		return view('login/index');
	}

}