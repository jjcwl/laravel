<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Route;

class InvestmentController extends Controller{	


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
				$list = DB::table('investment')
				->join('hot','hot.pid','=','investment.pid')
				->orderBy('investment.id','desc')
				->paginate(10);
				$list->setPath('index');
				return view('investment/index',['list'=>$list]);
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
					$introduction=$request->input('introduction');
					$content=$request->input('content');
					$source=$request->input('source');
					$look=$request->input('look');
					$pid=$request->input('pid');
					$keywords=$request->input('keywords');
					//图片上传	
					$file = $request->file('photo');
					if(empty($file[0])){
						$filename=null;
					}
					else{
						$upload=$this->upload($file);
						$filename=implode(',', $upload);
					}
					$data=DB::table('investment')->insert([
						'title'=>$title,
						'introduction'=>$introduction,'content'=>$content,
						'source'=>$source,'look'=>$look,
						'pid'=>$pid,'keywords'=>$keywords,'photo'=>$filename,
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
					$data=DB::table('hot')
						->get();
					return view('investment/add',['data'=>$data]);
				}
			}
		}
		return "<script>alert('您没有权限访问');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";
		
	}


	//资讯热点修改
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
					$introduction=$request->input('introduction');
					$content=$request->input('content');
					$source=$request->input('source');
					$look=$request->input('look');
					$pid=$request->input('pid');
					$keywords=$request->input('keywords');
					$file = $request->file('photo');
					if($file['0']==""){ 
						$list=DB::table('investment')->where('id',$hid)->update([
						'title'=>$title,'introduction'=>$introduction,
						'content'=>$content,'source'=>$source,'look'=>$look,
						'pid'=>$pid,
						'keywords'=>$keywords,
						'update_uid'=>$update_uid,'update_time'=>$update_time
						]);
						if($list){
							echo '<script>alert("修改成功");window.location.href="index";</script>';

						}else{
							echo '<script>alert("修改失败");window.location.href="mod";</script>'; 

						}
					}
					else{
						//删除图片
						$list=DB::table('investment')->where('id',$hid)->first();
						$photo=$list->photo;
						if($photo){
							$photo=explode(',',$photo);
							foreach ($photo as  $value) {
							$path=public_path().'/'.'uploads'.'/'."$value";
							unlink($path);
							}
						}
						$upload=$this->upload($file);
						$filename=implode(',', $upload);
						$list=DB::table('investment')->where('id',$hid)->update([
						'title'=>$title,'introduction'=>$introduction,
						'content'=>$content,'source'=>$source,'look'=>$look,
						'pid'=>$pid,'photo'=>$filename,
						'keywords'=>$keywords,
						'update_uid'=>$update_uid,'update_time'=>$update_time
						]);
						if($list){
							echo '<script>alert("修改成功");window.location.href="index";</script>';

						}else{
							echo '<script>alert("修改失败");window.location.href="mod";</script>'; 

						}
					}
						
					
				}
				else{
					$id=$request->input('id');
					$list=DB::table('investment')->where('id',$id)->first();
					$data=DB::table('hot')
					->get();
					$photo=$list->photo;
					$photos=explode(',',$photo);

					return view('investment/mod',['list'=>$list,'data'=>$data,'photos'=>$photos]);
					
				}
			}
		}
		return "<script>alert('您没有权限访问');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";
	}

	//资讯热点删除
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
				$list=DB::table('investment')->where('id',$id)->first();
				$photo=$list->photo;
				if($photo){
					$photos=explode(',',$photo);
					foreach ($photos as  $value) {
					$path=public_path().'/'.'uploads'.'/'."$value";
					unlink($path);
					}	
				}
				$data=DB::table('investment')->where('id',$id)->delete();
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