<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Route;
use Excel;
use App\Requirement;
use Illuminate\Support\Facades\Storage;


class RequirementController extends Controller{	

	public function login(){
		return redirect('login');
	}

	/* 
	/* 需求显示
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
				$list = DB::table('requirement')
						->join('industry','requirement.industry','=','industry.iid')
						->orderBy('id','desc')
						->paginate(10);
				$list->setPath('index');
				return view('requirement/index',['list'=>$list]);
			}
		}
		return "<script>alert('您没有权限访问');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";
	}

	/* 
	/* 需求添加
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
					$describes=$request->input('describes');
					$target=$request->input('target');
					$cooperation=$request->input('cooperation');
					if($cooperation==''){
						$cooperation=6;
					}
					$industry=$request->input('industry');
					if($industry==''){
						$industry=5;
					}
					$money =$request->input('money');
					if($money==''){
						$money='面议';
					}
					$contact=$request->input('contact');
					$phone=$request->input('phone');
					$fields=$request->input('fields');
					$name=$request->input('name');
					$asdate=$request->input('asdate');
					$area=$request->input('area');
					$data=DB::table('requirement')->insert([
						'describes'=>$describes,
						'target'=>$target,'cooperation'=>$cooperation,
						'industry'=>$industry,'money'=>$money,
						'contact'=>$contact,'phone'=>$phone,'fields'=>$fields,
						'name'=>$name,'asdate'=>$asdate,'area'=>$area,
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
					$cooperation=DB::table('cooperation')->get();
					return view('requirement/add',['list'=>$list,'cooperation'=>$cooperation]);
				}
			}
		}
		return "<script>alert('您没有权限访问');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";	
	}

	/* 
	/* 需求修改
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
					$describes=$request->input('describes');
					$target=$request->input('target');
					$cooperation=$request->input('cooperation');
					$industry=$request->input('industry');
					$money =$request->input('money');
					$contact=$request->input('contact');
					$phone=$request->input('phone');
					$fields=$request->input('fields');
					$name=$request->input('name');
					$asdate=$request->input('asdate');
					$area=$request->input('area');
					$data=DB::table('requirement')->where('id',$hid)->update([
					'describes'=>$describes,'target'=>$target,
					'cooperation'=>$cooperation,'name'=>$name,'asdate'=>$asdate,
					'industry'=>$industry,'money'=>$money,'contact'=>$contact,
					'phone'=>$phone,'fields'=>$fields,'area'=>$area,
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
					$list=DB::table('requirement')->where('id',$id)->first();
					$data=DB::table('industry')->get();
					$cooperation=DB::table('cooperation')->get();
					return view('requirement/mod',['list'=>$list,'data'=>$data,
					'cooperation'=>$cooperation,]);
				}
			}
		}
		return "<script>alert('您没有权限访问');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";	
	}

	/* 
	/* 需求删除
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
				$data=DB::table('requirement')->where('id',$id)->delete();		
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
		        $supplier = Requirement::select('type','name','iname','fields',
		        			'cooperation','money','describes','target','asdate',
		        			'lookphone','c_unit','contact','phone')
					        ->join('industry','industry.iid','=','requirement.industry')
					        ->join('cooperation','cooperation.cid','=','requirement.cooperation')
					        ->get()
					        ->toArray();
		        $suppliers = array('0'=>array('0'=>'需求类型','1'=>'名称',
		        	'2'=>'所属行业','3'=>'细分领域','4'=>'合作方式','5'=>'合作金额',
		        	'6'=>'需求描述','7'=>'预期目标','8'=>'截止日期',
		        	'9'=>'是否展示联系方式','10'=>'联系单位','11'=>'联系人',
		        	'12'=>'联系方式'));
		        for($i=0;$i<count($supplier);$i++){
		            $supplier[$i] = array_values($supplier[$i]);
		            $supplier[$i][0] = str_replace('=',' '.'=',$supplier[$i][0]);
		        }
		        $supplier1=array_merge($suppliers,$supplier);
		        $export=Excel::create('技术需求',function($excel) use ($supplier1){
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
		            	return redirect('requirement/uploads');
		        	}
					$file = $request->file('file');
					// 获取文件相关信息
		            $originalName = $file->getClientOriginalName(); // 文件原名
		            $ext = $file->getClientOriginalExtension();     // 扩展名
		            $realPath = $file->getRealPath();   //临时文件的绝对路径
		            $type = $file->getClientMimeType();     // image/jpeg
		            // 上传文件
		            $filename = date('Ymd His') .  '.' . $ext;
					// 使用我们新建的uploads本地存储空间（目录）
		            //这里的uploads是配置文件的名称
		            $bool = Storage::disk('uploads')->put($filename, file_get_contents($realPath));
		            $filePath = 'public/uploads/'.$filename;
		            $res = [];  
		        	Excel::load($filePath, function($reader) use( &$res ) {  
		            $reader = $reader->getSheet(0);  
		            $res = $reader->toArray();  
		        	});
		        	// print_r($res);die();
		        	if(count($res)){
		        		redirect('requirement/index');
		        	}
		        	for($i = 2;$i<count($res);$i++){
		        		//如果名称、需求描述重复，则结束本次循环
		            	$check = Requirement::where('name',$res[$i][1])
					        	->count();
		            if($check){
		            	echo $res[$i][1]."重复";
		                continue;
		            }
		            $type=$res[$i][0];
		            $name=$res[$i][1];
		            $industrys=DB::table('industry')->where('iname',$res[$i][2])
		            		   ->first();
		            $industry=$industrys->iid;
		            $fields=$res[$i][3];
		            $cooperations=DB::table('cooperation')->where('cname',$res[$i][4])
		            		   ->first();
		            $cooperation=$cooperations->cid;
		            if(empty($res[$i][5])){
						$money="面议";
		            }
		        	else{
		        		$money=$res[$i][5];
		        	}
		            

		            $describes=$res[$i][6];
		            $target=$res[$i][7];
		            $asdate=$res[$i][8];
		            $lookphone=$res[$i][9];
		            $c_unit=$res[$i][10];
		            $contact=$res[$i][11];
		            $phone=$res[$i][12];


		            //将excel表数据导入数据库
		            $stu = new Requirement;
		            $stu->type = $type;
		            $stu->name = $name;
		            $stu->industry = $industry;
		            $stu->fields = $fields;
		            $stu->cooperation = $cooperation;
		            $stu->money = $money;
		            $stu->describes = $describes;
		            $stu->target = $target;
		            $stu->asdate = $asdate;
		            $stu->lookphone = $lookphone;
		            $stu->c_unit = $c_unit;
		            $stu->contact = $contact;
		            $stu->phone = $phone;
		            $stu->create_time=time();
		            $list=$stu->save();

		        }
		        	if($list){
						echo '<script>alert("导入成功");window.location.href="index";</script>';

					}else{
						echo '<script>alert("导入失败");window.location.href="index";</script>'; 

					}
				}
				else{
					$excel="技术需求导入模版1.xlsx";
					return view('requirement/uploads',['excel'=>$excel]);
				}   
		    }
		}
		return "<script>alert('您没有权限访问');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";	
	}
}