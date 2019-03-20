<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Route;
use Illuminate\Support\Facades\Storage;
use Excel;
use App\Project;
class ProjectController extends Controller{	

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
	/* 项目显示
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
				if($request->input('sub')){
					$name=$request->input('sname');
					$sname=$request->session()->put('sname',$name);
					$list = DB::table('project')
							->join('industry','project.industry','=','industry.iid')
							->where('name','like',"%$name%") 
							->orderBy('id','desc')
							->paginate(10);
					$list->setPath('index');
					return view('project/index',['list'=>$list]);
				}
				else{
					$list = DB::table('project')
							->join('industry','project.industry','=','industry.iid')
							->orderBy('id','desc')
							->paginate(10);
					$list->setPath('index');
					return view('project/index',['list'=>$list]);
				}
				
			}
		}
		return "<script>alert('您没有权限访问');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";	
	}

	/* 
	/* 项目添加
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
					$create_uid=session('u_id');
					$create_time=time();
					$name=$request->input('name');
					$cooperation=$request->input('cooperation');
					if($cooperation==''){
						$cooperation=6;
					}
					$coop_money=$request->input('coop_money');
					if($coop_money==''){
						$coop_money='面议';
					}
					$industry=$request->input('industry');
					if($industry==''){
						$industry=5;
					}
					$contact=$request->input('contact');
					$phone=$request->input('phone');
					$niche=$request->input('niche');
					$tec_introduction=$request->input('tec_introduction');
					$patent=$request->input('patent');
					$advantage=$request->input('advantage');
					$mature=$request->input('mature');
					if($mature==''){
						$mature=1;
					}
					$area=$request->input('area');
					$abstract=$request->input('abstract');
					$level=$request->input('level');
					$winning=$request->input('winning');
					$scope=$request->input('scope');
					$source=$request->input('source');
					if($source==''){
						$source=4;
					}
					$asdate=$request->input('asdate');
					//图片上传	
					$file = $request->file('photo');
					if(empty($file[0])){
						$filename='';
					}
					else{
						$upload=$this->upload($file);
						$filename=implode(',', $upload);
					}
					$data=DB::table('project')->insert([
						'name'=>$name,
						'cooperation'=>$cooperation,'coop_money'=>$coop_money,
						'industry'=>$industry,'photo'=>$filename,
						'contact'=>$contact,'phone'=>$phone,'niche'=>$niche,
						'tec_introduction'=>$tec_introduction,'patent'=>$patent,
						'advantage'=>$advantage,'mature'=>$mature,'area'=>$area,
						'abstract'=>$abstract,'level'=>$level,
						'winning'=>$winning,'scope'=>$scope,'source'=>$source,
						'asdate'=>$asdate,
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
					$industry=DB::table('industry')->get();
					$cooperation=DB::table('cooperation')->get();
					$mature=DB::table('mature')->get();
					$source=DB::table('source')->get();
					return view('project/add',['industry'=>$industry,'cooperation'=>$cooperation,
					'mature'=>$mature,'source'=>$source]);
				}
			}
		}
		return "<script>alert('您没有权限访问');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";	
	}

	/* 
	/* 项目修改
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
					$cooperation=$request->input('cooperation');
					$coop_money=$request->input('coop_money');
					$industry=$request->input('industry');
					$contact=$request->input('contact');
					$phone=$request->input('phone');
					$niche=$request->input('niche');
					$tec_introduction=$request->input('tec_introduction');
					$patent=$request->input('patent');
					$advantage=$request->input('advantage');
					$mature=$request->input('mature');
					$area=$request->input('area');
					$abstract=$request->input('abstract');
					$level=$request->input('level');
					$winning=$request->input('winning');
					$scope=$request->input('scope');
					$source=$request->input('source');
					$asdate=$request->input('asdate');
					$file = $request->file('photo');
					if($file['0']==""){ 
						$data=DB::table('project')->where('id',$hid)->update([
						'name'=>$name,
						'cooperation'=>$cooperation,'coop_money'=>$coop_money,
						'industry'=>$industry,'contact'=>$contact,
						'phone'=>$phone,'niche'=>$niche,
						'tec_introduction'=>$tec_introduction,'patent'=>$patent,
						'mature'=>$mature,'area'=>$area,
						'abstract'=>$abstract,'level'=>$level,'asdate'=>$asdate,
						'winning'=>$winning,'scope'=>$scope,'source'=>$source,
						'advantage'=>$advantage,'update_uid'=>$create_uid,
						'update_time'=>$create_time
						]);	
					}
					else{
						
						//删除图片
						$list=DB::table('project')->where('id',$hid)->first();
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
						$data=DB::table('project')->where('id',$hid)->update([
						'name'=>$name,
						'cooperation'=>$cooperation,'coop_money'=>$coop_money,
						'industry'=>$industry,'photo'=>$filename,
						'contact'=>$contact,'phone'=>$phone,'niche'=>$niche,
						'tec_introduction'=>$tec_introduction,'patent'=>$patent,
						'advantage'=>$advantage,'mature'=>$mature,'area'=>$area,
						'abstract'=>$abstract,'level'=>$level,'asdate'=>$asdate,
						'winning'=>$winning,'scope'=>$scope,'source'=>$source,
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
					$list=DB::table('project')->where('id',$id)->first();
					$industry=DB::table('industry')->get();
					$cooperation=DB::table('cooperation')->get();
					$mature=DB::table('mature')->get();
					$source=DB::table('source')->get();
					$photo=$list->photo;
					$photos=explode(',',$photo);
					return view('project/mod',['list'=>$list,'industry'=>$industry,
						'photos'=>$photos,'cooperation'=>$cooperation,'mature'=>$mature,
						'source'=>$source]);
				}
			}
		}
		return "<script>alert('您没有权限访问');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";	
	}

	/* 
	/* 项目删除
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
				$list=DB::table('project')->where('id',$id)->first();
				$photo=$list->photo;
				if($photo){
					$photos=explode(',',$photo);
					foreach ($photos as  $value) {
					$path=public_path().'/'.'uploads'.'/'."$value";
					unlink($path);
					}	
				}
				$data=DB::table('project')->where('id',$id)->delete();
				if($data){
					echo '<script>alert("删除成功");window.location.href="index";</script>';

				}else{
					echo '<script>alert("删除失败");window.location.href="index";</script>'; 

				}
			}
		}
		return "<script>alert('您没有权限访问');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";	
	}

	//数据导出Excel
	public function export(Request $request){
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
				ini_set('memory_limit','500M');
		        set_time_limit(0);//设置超时限制为0分钟
		        $supplier = Project::select('name','sname','cname',
		        			'coop_money','mname','iname','niche','area','abstract',
		        			'tec_introduction','patent','level','winning','advantage',
		        			'scope','contact','phone')
					        ->join('industry','industry.iid','=','project.industry')
					        ->join('cooperation','cooperation.cid','=','project.cooperation')
					        ->join('mature','mature.mid','=','project.mature')
					        ->join('source','source.sid','=','project.source')
					        ->get()
					        ->toArray();
		        $suppliers = array('0'=>array('0'=>'名称',
		        	'1'=>'技术来源','2'=>'合作方式','3'=>'合作金额','4'=>'成熟度',
		        	'5'=>'所属行业','6'=>'细分领域','7'=>'区域','8'=>'技术摘要',
		        	'9'=>'技术简介','10'=>'知识产权','11'=>'技术水平','12'=>'获奖情况',
		        	'13'=>'技术优势','14'=>'应用范围','15'=>'联系人','16'=>'联系方式'));
		        for($i=0;$i<count($supplier);$i++){
		            $supplier[$i] = array_values($supplier[$i]);
		            $supplier[$i][0] = str_replace('=',' '.'=',$supplier[$i][0]);
		        }
		        $supplier1=array_merge($suppliers,$supplier);
		        $export=Excel::create('技术成果',function($excel) use ($supplier1){
		            $excel->sheet('score', function($sheet) use ($supplier1){
		                $sheet->rows($supplier1);
		            });
		        })->export('xls');
		        if($export){
					echo '<script>alert("导出成功");window.location.href="index";</script>';

				}else{
					echo '<script>alert("导出失败");window.location.href="index";</script>'; 

				}
			}
		}
		return "<script>alert('您没有权限访问');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";	
	}

	//Excel表导入
	public function uploads(Request $request){
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
					if(!$request->file('file')){
		            	return redirect('project/uploads');
		        	}
					$file = $request->file('file');
					// 获取文件相关信息
		            $originalName = $file->getClientOriginalName(); // 文件原名
		            $ext = $file->getClientOriginalExtension();     // 扩展名
		            $realPath = $file->getRealPath();   //临时文件的绝对路径
		            $type = $file->getClientMimeType();     // image/jpeg
		            // 上传文件
		            $filename = date('YmdHis') .  '.' . $ext;
					// 使用我们新建的uploads本地存储空间（目录）
		            //这里的uploads是配置文件的名称
		            $bool = Storage::disk('uploads')->put($filename, file_get_contents($realPath));
		            $filePath = 'public/uploads/'.$filename;
		            $res = [];  
		        	Excel::load($filePath, function($reader) use( &$res ) {  
		            $reader = $reader->getSheet(0);  
		            $res = $reader->toArray();  
		        	});
		        	if(count($res)){
		        		redirect('project/index');
		        	}
		        	for($i = 1;$i<count($res);$i++){
		        		//如果名称、需求描述重复，则结束本次循环
		            	$check = Project::where('name',$res[$i][0])
					        	->count();
		            if($check){
		            	
		            	echo $res[$i][0]."重复";
		                continue;
		            }
		            $name=$res[$i][0];
		            $sources=DB::table('source')->where('sname',$res[$i][1])
		            		   ->first();
		            $source=$sources->sid;
		            
		            $cooperations=DB::table('cooperation')->where('cname',$res[$i][2])
		            		   ->first();
		            $cooperation=$cooperations->cid;
		            if(empty($res[$i][3])){
						$coop_money="面议";
		            }
		        	else{
		        		$coop_money=$res[$i][3];
		        	}
		           
		            $matures=DB::table('mature')->where('mname',$res[$i][4])
		            		   ->first();
		            $mature=$matures->mid;
		            $industrys=DB::table('industry')->where('iname',$res[$i][5])
		            		   ->first();
		            $industry=$industrys->iid;
		            $niche=$res[$i][6];
		            $area=$res[$i][7];
		            $abstract=$res[$i][8];
		            $tec_introduction=$res[$i][9];
		            $patent=$res[$i][10];
		            $level=$res[$i][11];
		            $winning=$res[$i][12];
		            $advantage=$res[$i][13];
		            $scope=$res[$i][14];
		            $contact=$res[$i][15];
		            $phone=$res[$i][16];


		            //将excel表数据导入数据库
		            $stu = new Project;
		            $stu->name = $name;
		            $stu->source = $source;
		            $stu->cooperation = $cooperation;
		            $stu->coop_money = $coop_money;
		            $stu->mature = $mature;
		            $stu->industry = $industry;
		            $stu->niche = $niche;
		            $stu->area = $area;
		            $stu->abstract = $abstract;
		            $stu->tec_introduction = $tec_introduction;
		            $stu->patent = $patent;
		            $stu->level = $level;
		            $stu->winning = $winning;
		            $stu->advantage = $advantage;
		            $stu->scope = $scope;
		            $stu->contact = $contact;
		            $stu->phone = $phone;
		            $stu->create_time=time();
		            $list=$stu->save();

		        }
		        	if($list){
						echo '<script>alert("导入成功");window.location.href="index";</script>';

					}else{
						echo '<script>alert("导入出失败");window.location.href="index";</script>'; 

					}
				}
				else{
					$excel="项目信息to绵阳.xlsx";
					return view('project/uploads',['excel'=>$excel]);
				} 
			}
		}
		return "<script>alert('您没有权限访问');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";	  
    }





    public function unpack(Request $request){
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
					if(!$request->file('file')){
		            	return redirect('project/unpack');
		        	}
					$file = $request->file('file');
					// 获取文件相关信息
		            $originalName = $file->getClientOriginalName(); // 文件原名
		            $ext = $file->getClientOriginalExtension();     // 扩展名
		            $realPath = $file->getRealPath();   //临时文件的绝对路径
		            $type = $file->getClientMimeType();     // image/jpeg
		            // 上传文件
		            $filename = date('YmdHis').mt_rand(100,999).'.'.$ext;
					// 使用我们新建的uploads本地存储空间（目录）
		            //这里的uploads是配置文件的名称
			        $bool = Storage::disk('uploads')->put($filename, file_get_contents($realPath));
				    $zip = new \ZipArchive;//新建一个ZipArchive的对象
					/*
					通过ZipArchive的对象处理zip文件
					$zip->open这个方法的参数表示处理的zip文件名。
					如果对zip文件对象操作成功，$zip->open这个方法会返回TRUE
					*/
					// $path="/PHPTutorial/www/laravel/public/uploads/"."$filename";
					// $paths='/phpstudy/PHPTutorial/www/laravel/public/uploads';
					$path=asset('uploads/'.$filename);
					
					$paths='http://www.htjmrh.cn/public/uploads';
					$open=$zip->open($path,\ZipArchive::CREATE);

					if ($open === TRUE)
					{	
						$zip->extractTo($paths);
						$num=$zip->numFiles;
						echo $num; die();
						//解压缩到在当前路径下某个子文件夹
						for ($i=0; $i < $zip->numFiles ; $i++) {
							$photos=$zip->getNameIndex($i);
							$arr[$i] = $photos;


							// $photoss=substr($photos,0,strpos($photos,'.'));
							// $arr=explode(',', $photos);
							// $arr1[$i]=explode(',', $photos);
							// print_r($arr);
							// print_r($arr1);
							// $a=DB::table('project')->where('id',$photoss)
							// ->update(['photo'=>$photos]);

						}
						foreach($arr as $key => $val){
							$arr2[$key] = explode('-',$val);

						}
						$a = [];
						foreach($arr2 as $v){
							$str = $v[0].'-'.$v[1];
							if(in_array($v[0],$a)){
							}else{
								foreach($arr as $keys => $vals){
									$ar = explode('-',$vals);
									if($ar[0] == $v[0] && !strstr($str,$vals)){
										// unset($arr[$keys]);
										$str.=','.$vals;
										// $a[] = $keys;
										$a[] = $v[0];
									}
								}
								$list=DB::table('project')->where('id',$v[0])
								->update(['photo'=>$str]);
							}
						}
						// print_r($ar);
						$zip->close();//关闭处理的zip文件
						if($list){
							echo '<script>alert("导入成功");window.location.href="index";</script>';

						}else{
							echo '<script>alert("导入失败");window.location.href="index";</script>'; 

						}
					}
					else{
						echo '<script>alert("文件没有找到");window.location.href="index";</script>';
					}
				}
				else{
					return view('project/unpack');
				}
			}
		}
		return "<script>alert('您没有权限访问');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";

    }

}