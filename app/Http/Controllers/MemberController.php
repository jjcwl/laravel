<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Route;
use Illuminate\Support\Facades\Storage;

class MemberController extends Controller{	

	public function upload($file){
		$filePath =[];  // 定义空数组用来存放图片路径
		foreach ($file as $key => $value) {
	  	// 判断图片上传中是否出错
		   if (!$value->isValid()) {
		      exit("上传图片出错，请重试！");
		   }
			$allowed_extensions = ["png", "jpg", "gif"];
			if ($value->getClientOriginalExtension() && !in_array($value->getClientOriginalExtension(), $allowed_extensions)) {
			    exit('您只能上传PNG、JPG或GIF格式的图片！');
			}
			$destinationPath = '/uploads/'; 
			// public文件夹下面uploads/xxxx-xx-xx 建文件夹
			$extension = $value->getClientOriginalExtension();   // 上传文件后缀
			$fileName = date('YmdHis').mt_rand(100,999).'.'.$extension; // 重命名
			$value->move(public_path().$destinationPath, $fileName); // 保存图片
			$filePath[] = $fileName; 

		}
		// 返回上传图片路径，用于保存到数据库中
		return $filePath;

	}

	public function login(){
		return redirect('login');
	}

	/* 
	/* 会员显示
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
				$list = DB::table('member')
						->join('industry','member.industry','=','industry.iid')
						->orderBy('create_time','desc')
						->paginate(10);
				$list->setPath('index');
				return view('member/index',['list'=>$list]);
			}
		}
		return "<script>alert('您没有权限访问');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";	
	}

	/* 
	/* 会员添加
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
					$name=$request->input('name');
					$username=$request->input('username');
					$password=$request->input('password');
					$phone=$request->input('phone');
					$industry=$request->input('industry');
					$field=$request->input('field');
					//图片上传	
					$file = $request->file('id_photo');
					if(empty($file[0])){
						$filename='';
					}
					else{
						$upload=$this->upload($file);
						$filename=implode(',', $upload);
					}
					$files = $request->file('id_photos');
					if(empty($files[0])){
						$filenames='';
					}
					else{
						$upload=$this->upload($files);
						$filenames=implode(',', $upload);
					}
					$data=DB::table('member')->insert([
						'id'=>$id,'name'=>$name,'username'=>$username,
						'password'=>$password,'phone'=>$phone,
						'industry'=>$industry,'field'=>$field,
						'id_photo'=>$filename,'id_photos'=>$filenames,
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
					$list=DB::table('industry')->get();
					return view('member/add',['list'=>$list]);
				}
			}
		}
		return "<script>alert('您没有权限访问');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";	
	}

	/* 
	/* 会员修改
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
					$name=$request->input('name');
					$username=$request->input('username');
					$password=$request->input('password');
					$phone=$request->input('phone');
					$industry=$request->input('industry');
					$field=$request->input('field');
					$file = $request->file('id_photo');
					$files = $request->file('id_photos');
					if($file['0']==""){ 
						$data=DB::table('member')->where('id',$hid)->update([
						'name'=>$name,'username'=>$username,
						'password'=>$password,'phone'=>$phone,
						'industry'=>$industry,'field'=>$field,
						'update_uid'=>$create_uid,'update_time'=>$create_time
						]);	
					}
					else{
						
						//删除图片
						$list=DB::table('member')->where('id',$hid)->first();
						$photo=$list->id_photo;
						if($photo){
							$photo=explode(',',$photo);
							foreach ($photo as  $value) {
							$path=public_path().'/'.'uploads'.'/'."$value";
							unlink($path);
							}
						}
						$upload=$this->upload($file);
						$filename=implode(',', $upload);
						$photos=$list->id_photos;
						if($photo){
							$photos=explode(',',$photos);
							foreach ($photos as  $value) {
							$path=public_path().'/'.'uploads'.'/'."$value";
							unlink($path);
							}
						}
						
						$uploads=$this->upload($files);
						$filenames=implode(',', $uploads);
						$data=DB::table('member')->where('id',$hid)->update([
						'name'=>$name,'username'=>$username,
						'password'=>$password,'phone'=>$phone,
						'industry'=>$industry,'field'=>$field,
						'id_photo'=>$filename,'id_photos'=>$filenames,
						'update_uid'=>$create_uid,'update_time'=>$create_time
						]);	
					}
					if($data){
						echo '<script>alert("修改成功");window.location.href="index";</script>';

					}else{
						echo '<script>alert("修改失败");window.location.href="mod";</script>'; 

					}
				}
				else{
					$id=$request->input('id');
					$list=DB::table('member')->where('id',$id)->first();
					$data=DB::table('industry')->get();
					$photo=$list->id_photo;
					$photo=explode(',',$photo);
					$photos=$list->id_photos;
					$photos=explode(',',$photos);
					return view('member/mod',['list'=>$list,'data'=>$data,
						'photos'=>$photos,'photo'=>$photo]);
				}
			}
		}
		return "<script>alert('您没有权限访问');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";	
	}

	/* 
	/* 会员删除
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
				$list=DB::table('member')->where('id',$id)->first();
				$photo=$list->id_photo;
				$photos=$list->id_photos;
				if($photo){
					$photo=explode(',',$photo);
					foreach ($photo as  $value) {
					$path=public_path().'/'.'uploads'.'/'."$value";
					unlink($path);
					}		
				}
				if($photos){
					$photos=explode(',',$photos);
					foreach ($photos as  $value) {
					$path=public_path().'/'.'uploads'.'/'."$value";
					unlink($path);
					}
				}
				$data=DB::table('member')->where('id',$id)->delete();
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