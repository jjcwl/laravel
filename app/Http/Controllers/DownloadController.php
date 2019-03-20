<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Route;
use Illuminate\Support\Facades\Storage;


class DownloadController extends Controller{	

	//数据显示
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
				$list = DB::table('download')
				->join('downtype','downtype.pid','=','download.pid')
				->orderBy('id','desc')
				->paginate(10);
				$list->setPath('index');
				return view('download/index',['list'=>$list]);
			}
		}
		return "<script>alert('您没有权限访问');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";
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
					//接受form传值进行数据添加
					$create_uid=session('u_id');
					$create_time=time();
					$title=$request->input('title');
					$pid=$request->input('pid');
					$file=$request->file('file');
					if(empty($file)){
						$filename='';
					}
					else{
						// 获取文件相关信息
		                $originalName = $file->getClientOriginalName(); // 文件原名
		                $ext = $file->getClientOriginalExtension();     // 扩展名
		                $realPath = $file->getRealPath();   //临时文件的绝对路径
		                $type = $file->getClientMimeType();     // image/jpeg

		                // 上传文件
		                $filename = date('YmdHis') . '.' . $ext;
		                 //这里的uploads是配置文件的名称
               			$bool = Storage::disk('uploads')->put($filename, file_get_contents($realPath));
					}
					$data=DB::table('download')->insert([
						'title'=>$title,'pid'=>$pid,'file'=>$filename,
						'create_uid'=>$create_uid,'update_uid'=>$create_uid,
						'create_time'=>$create_time,'update_time'=>$create_time
						]);
					if($data){
						echo '<script>alert("添加成功");window.location.href="index";</script>';

					}else{
						echo '<script>alert("添加失败");window.location.href="add";</script>'; 

					}
				}
				else{
					$data=DB::table('downtype')
						->get();
					return view('download/add',['data'=>$data]);
				}
			}
		}
		return "<script>alert('您没有权限访问');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";
		
	}


	//资料修改
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
					$title=$request->input('title');
					$pid=$request->input('pid');
					$file=$request->file('file');
					if(empty($file)){
						$list=DB::table('download')->where('id',$hid)->update([
						'title'=>$title,'pid'=>$pid,'update_uid'=>$update_uid,
						'update_time'=>$update_time]);
						if($list){
							echo '<script>alert("修改成功");window.location.href="index";</script>';

						}else{
							echo '<script>alert("修改失败");window.location.href="index";</script>'; 
						}
					}
					else{
						$list=DB::table('download')->where('id',$hid)->first();
						$files=$list->file;
						if($files){
							$path=public_path().'/'.'uploads'.'/'."$files";
							unlink($path);
						}
						
						//获取文件相关信息
		                $originalName = $file->getClientOriginalName(); // 文件原名
		                $ext = $file->getClientOriginalExtension();     // 扩展名
		                $realPath = $file->getRealPath();   //临时文件的绝对路径
		                $type = $file->getClientMimeType();     // image/jpeg

		                // 上传文件
		                $filename = date('YmdHis') . '.' . $ext;
		                //这里的uploads是配置文件的名称
	               		$bool = Storage::disk('uploads')->put($filename, file_get_contents($realPath));
	               		$list=DB::table('download')->where('id',$hid)->update([
						'title'=>$title,'pid'=>$pid,'file'=>$filename,
						'update_uid'=>$update_uid,'update_time'=>$update_time]);
						if($list){
							echo '<script>alert("修改成功");window.location.href="index";</script>';

						}else{
							echo '<script>alert("修改失败");window.location.href="index";</script>'; 

						}
						}
						
					}

				else{
					$id=$request->input('id');
					$list=DB::table('download')->where('id',$id)->first();
					$data=DB::table('downtype')
					->get();
					return view('download/mod',['list'=>$list,'data'=>$data]);

			
					
				}
			}
		}
		return "<script>alert('您没有权限访问');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";
	}

	//资料删除
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
				$data=DB::table('download')->where('id',$id)->first();
				$filen=$data->file;
				if($filen){
					$path=public_path().'/'.'uploads'.'/'."$filen";
					unlink($path);
				}
				$data=DB::table('download')->where('id',$id)->delete();
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