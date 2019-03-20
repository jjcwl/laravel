<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Route;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use App\Project;
use App\Requirement;
use App\Enterprise;
class FindexController extends Controller{	


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

	//首页
	public function index(Request $request){
		$sel=$request->input('sel');
		if($sel){
			if($sel==1){
				$aname=$request->input('aname');
				$proindustry=$request->input('proindustry');
				$procooperation=$request->input('procooperation');
				$promature=$request->input('promature');
				$procoop_money=$request->input('procoop_money');
				if($aname){
					$project=Project::select()
					        ->where('name','like',"%$aname%")
					        ->orderBy('create_time','desc')
					        ->get()
					        ->toArray();
					foreach ($project as $key => $value) {
		            $photo=$value['photo'];
		            $photo=explode(',', $photo);
		            foreach($photo as $k => $v){
		                $project[$key]['img'.$k] = $v;

		            }
		        	}
		        	$perPage = 5;		
		        	if ($request->has('apage')) {				
			        	$current_page = $request->input('apage');				
			        	$current_page = $current_page <= 0 ? 1 :$current_page;		
		        	} 
		        	else {				
		        	$current_page = 1;		
		        	} 		
		        	$item = array_slice($project, ($current_page-1)*$perPage, $perPage); 
		        	//按分页取数据		
		        	$total = count($project);	
		        	$project =new LengthAwarePaginator($item, $total, $perPage,
		        	$current_page, [					
		        			'pageName' => 'apage']);
			        $project = $project->setPath('findex/project');
					//人气
					$project1=Project::select()
					        ->where('name','like',"%$aname%")
					        ->orderBy('look','desc')
					        ->get()
					        ->toArray();
					foreach ($project1 as $key => $value) {
		            $photo=$value['photo'];
		            $photo=explode(',', $photo);
		            foreach($photo as $k => $v){
		                $project1[$key]['img'.$k] = $v;

		            }
		        	}
		        	$perPage = 5;		
		        	if ($request->has('apage')) {				
			        	$current_page = $request->input('apage');				
			        	$current_page = $current_page <= 0 ? 1 :$current_page;		
		        	} 
		        	else {				
		        	$current_page = 1;		
		        	} 		
		        	$item = array_slice($project1, ($current_page-1)*$perPage, $perPage); 
		        	//按分页取数据		
		        	$total = count($project1);	
		        	$project1 =new LengthAwarePaginator($item, $total, $perPage,
		        	$current_page, [					
		        			'pageName' => 'apage']);
			        $project1 = $project1->setPath('findex/project');
					//收藏
					$project2=Project::select()
					        ->where('name','like',"%$aname%")
					        ->orderBy('collection','desc')
					        ->get()
					        ->toArray();
					foreach ($project2 as $key => $value) {
		            $photo=$value['photo'];
		            $photo=explode(',', $photo);
		            foreach($photo as $k => $v){
		                $project2[$key]['img'.$k] = $v;

		            }
		        	}
		        	$perPage = 5;		
		        	if ($request->has('apage')) {				
			        	$current_page = $request->input('apage');				
			        	$current_page = $current_page <= 0 ? 1 :$current_page;		
		        	} 
		        	else {				
		        	$current_page = 1;		
		        	} 		
		        	$item = array_slice($project2, ($current_page-1)*$perPage, $perPage); 
		        	//按分页取数据		
		        	$total = count($project2);	
		        	$project2 =new LengthAwarePaginator($item, $total, $perPage,
		        	$current_page, [					
		        			'pageName' => 'apage']);
			        $project2 = $project2->setPath('findex/project');

					$industry=DB::table('industry')
							->get();
					$cooperation=DB::table('cooperation')->get();
					$mature=DB::table('mature')->get();
					$requirement=DB::table('requirement')
							->orderBy('create_time','desc')
							->paginate(9);
					//banner
					$banner=DB::table('banner')
							->get();
				   
					return view('findex/project',['project'=>$project,'project1'=>$project1,
						'project2'=>$project2,'industry'=>$industry,'banner'=>$banner,
						'requirement'=>$requirement,'proindustry'=>$proindustry,
						'procooperation'=>$procooperation,'promature'=>$promature,
						'procoop_money'=>$procoop_money,'name'=>$aname,'cooperation'=>$cooperation,
						'mature'=>$mature]);
				}
				return redirect('findex/project');
			}
			elseif ($sel==2) {
				$aname=$request->input('aname');
				$proindustry=$request->input('proindustry');
				$procooperation=$request->input('procooperation');
				$procoop_money=$request->input('procoop_money');
				if($aname){
					$industry=DB::table('industry')
							->get();
					$cooperation=DB::table('cooperation')->get();
					$requirement=DB::table('requirement')
							->join('industry','industry.iid','=','requirement.industry')
							->where('name','like',"%$aname%")
							->orderBy('create_time','desc')
							->paginate($perPage = 4, $columns = ['*'], $pageName = 'cpage');
					$requirement->setPath('requirement');
					$requirement1=DB::table('requirement')
							->join('industry','industry.iid','=','requirement.industry')
							->where('name','like',"%$aname%")
							->orderBy('look','desc')
							->paginate($perPage = 4, $columns = ['*'], $pageName = 'cpage');
				
					$requirement2=DB::table('requirement')
							->join('industry','industry.iid','=','requirement.industry')
							->where('name','like',"%$aname%")
							->orderBy('collection','desc')
							->paginate($perPage = 4, $columns = ['*'], $pageName = 'cpage');
					$project=Project::select()
								->join('industry','industry.iid','=','project.industry')
						        ->orderBy('create_time','desc')
						        ->get()
						        ->toArray();
							foreach ($project as $key => $value) {
				            $photo=$value['photo'];
				            $photo=explode(',', $photo);
				            foreach($photo as $k => $v){
				                $project[$key]['img'.$k] = $v;

				            }
				        	}
				        	$perPage =4;		
				        	if ($request->has('pagess')) {				
					        	$current_page = $request->input('pagess');				
					        	$current_page = $current_page <= 0 ? 1 :$current_page;		
				        	} 
				        	else {				
				        	$current_page = 1;		
				        	} 		
				        	$item = array_slice($project, ($current_page-1)*$perPage, $perPage); 
				        	//按分页取数据		
				        	$total = count($project);	
				        	$project =new LengthAwarePaginator($item, $total, $perPage,
				        	$current_page, [					
				        			'pageName' => 'pagess']);
					        $project = $project->setPath('/laravel/public/findex/project');
					        //banner
							$banner=DB::table('banner')
									->get();
							$requirements=DB::table('requirement')
								->orderBy('look','desc')
								->paginate($perPage = 4, $columns = ['*'], $pageName = 'apages');
							return view('findex/requirement',['industry'=>$industry,
							'requirement'=>$requirement,'project'=>$project,
							'requirement1'=>$requirement1,'requirement2'=>$requirement2,
							'name'=>$aname,'proindustry'=>$proindustry,
							'procooperation'=>$procooperation,'procoop_money'=>$procoop_money,
							'banner'=>$banner,'requirements'=>$requirements,
							'cooperation'=>$cooperation]);
				}
				return redirect('findex/requirement');
			}
			elseif ($sel==3) {
				$name=$request->input('aname');
				$proindustry=$request->input('proindustry');
				$procooperation=$request->input('procooperation');
				$procoop_money=$request->input('procoop_money');
				if($name){
					$industry=DB::table('industry')
							->get();
					$cooperation=DB::table('cooperation')->get();
					$enterprise=DB::table('enterprise')
							->join('industry','industry.iid','=','enterprise.industry')
							->where('name','like',"%$name%")
							->orderBy('create_time','desc')
							->paginate($perPage = 5, $columns = ['*'], $pageName = 'pages');
					$enterprise1=DB::table('enterprise')
							->join('industry','industry.iid','=','enterprise.industry')
							->where('name','like',"%$name%")
							->orderBy('look','desc')
							->paginate($perPage = 5, $columns = ['*'], $pageName = 'pages');
					$enterprise2=DB::table('enterprise')
							->join('industry','industry.iid','=','enterprise.industry')
							->where('name','like',"%$name%")
							->orderBy('collection','desc')
							->paginate($perPage = 5, $columns = ['*'], $pageName = 'pages');		
					$enterprise->setPath('enterprise');
					//banner
					$banner=DB::table('banner')
							->get();
					return view('findex/enterprise',['industry'=>$industry,
					'enterprise'=>$enterprise,'enterprise1'=>$enterprise1,
					'enterprise2'=>$enterprise2,'name'=>$name,
					'proindustry'=>$proindustry,'procooperation'=>$procooperation,
					'procoop_money'=>$procoop_money,'banner'=>$banner,'cooperation'=>$cooperation]);
				}
				return redirect('findex/enterprise');
			}
		}
		else{
			//公告
			$notice=DB::table('notice')->orderBy('create_time','desc')->get();
			//项目
			// $project=DB::table('project')
			// 		->join('industry','project.industry','=','industry.iid')
			// 		->orderBy('create_time','desc')
			// 		->paginate(6);
			$project=Project::select()
			        ->join('industry','industry.iid','=','project.industry')
			        ->orderBy('create_time','desc')
			        ->get()
			        ->toArray();
			foreach ($project as $key => $value) {
            $photo=$value['photo'];
            $photo=explode(',', $photo);
            foreach($photo as $k => $v){
                $project[$key]['img'.$k] = $v;


            }
        	}

        	//获取当前的分页数，就是第6这样的
	        $currentPage = LengthAwarePaginator::resolveCurrentPage();

	        //实例化collect方法
	        $collection = new Collection($project);

	        //定义一下每页显示多少个数据
	        $perPage = 6;

	        //获取当前需要显示的数据列表
	        $currentPageSearchResults = $collection->slice($currentPage * $perPage, $perPage)->all();

	        //创建一个新的分页方法
	        $project= new LengthAwarePaginator($currentPageSearchResults, count($collection), $perPage);
	        
			// $project2=DB::table('project')
			// 		->join('industry','project.industry','=','industry.iid')
			// 		->orderBy('look','desc')
			// 		->paginate(6);
			$project2=Project::select()
			        ->join('industry','industry.iid','=','project.industry')
			        ->orderBy('look','desc')
			        ->get()
			        ->toArray();
			foreach ($project2 as $key => $value) {
            $photo=$value['photo'];
            $photo=explode(',', $photo);
            foreach($photo as $k => $v){
                $project2[$key]['img'.$k] = $v;

            }
        	}

        	//获取当前的分页数，就是第6这样的
	        $currentPage = LengthAwarePaginator::resolveCurrentPage();

	        //实例化collect方法
	        $collection = new Collection($project2);

	        //定义一下每页显示多少个数据
	        $perPage = 6;

	        //获取当前需要显示的数据列表
	        $currentPageSearchResults = $collection->slice($currentPage * $perPage, $perPage)->all();

	        //创建一个新的分页方法
	        $project2= new LengthAwarePaginator($currentPageSearchResults, count($collection), $perPage);
			//需求
			$requirement=DB::table('requirement')
					->join('industry','requirement.industry','=','industry.iid')
					->orderBy('create_time','desc')
					->paginate(7);
			$requirement2=DB::table('requirement')
					->join('industry','requirement.industry','=','industry.iid')
					->orderBy('look','desc')
					->paginate(7);
			//资讯热点
			$investment1=DB::table('investment')
					->where('pid',1)
					->orderBy('create_time','desc')
					->paginate(11);
			$investment2=DB::table('investment')
					->where('pid',2)
					->orderBy('create_time','desc')
					->paginate(11);
			$investment3=DB::table('investment')
					->where('pid',3)
					->orderBy('create_time','desc')
					->paginate(11);
			$investment4=DB::table('investment')
					->where('pid',4)
					->orderBy('create_time','desc')
					->paginate(11);
			$type=DB::table('hot')
				->orderBy('pid','asc')
				->paginate(4);
			$photos=DB::table('investment')
					->where('photo','!=','null')
					->orderBy('create_time','desc')
					->paginate(4);
			
			//企业名录
			$enterprise=DB::table('enterprise')
					->orderBy('create_time','desc')
					->get();	
			//合作机构
			$agency=DB::table('agency')
					->orderBy('create_time','desc')
					->get();
			//下载专区
			$download1=DB::table('download')
					->where('pid',1)
					->orderBy('create_time','desc')
					->paginate(6);
			$download2=DB::table('download')
					->where('pid',2)
					->orderBy('create_time','desc')
					->paginate(6);
			$download3=DB::table('download')
					->where('pid',3)
					->orderBy('create_time','desc')
					->paginate(6);
			$download4=DB::table('download')
					->where('pid',4)
					->orderBy('create_time','desc')
					->paginate(6);
			$types=DB::table('downtype')
				->orderBy('pid','asc')
				->paginate(4);
			//banner
			$banner=DB::table('banner')
					->get();
			//项目表
			$projectTable = DB::table('projectTable')->orderBy(\DB::raw('RAND()'))->take(10)->get();		
			//在线留言
			if($request->input('sub')){
				$contact=$request->input('contact');
				$phone=$request->input('phone');
				$requirements=$request->input('requirements');
				$uname=session('name');
				$time=time();
				$message=DB::table('message')->insert([
					'uname'=>$uname,'contact'=>$contact,
					'phone'=>$phone,'requirements'=>$requirements,'create_time'=>$time
					]);
				if($message){
						echo '<script>alert("留言成功");window.location.href="/";</script>';

					}else{
						echo '<script>alert("留言失败");window.location.href="/";</script>'; 

					}
			}	
			return view('findex/index',
				['notice'=>$notice,'project'=>$project,'project2'=>$project2,
				'requirement'=>$requirement,'requirement2'=>$requirement2,
				'investment1'=>$investment1,'investment2'=>$investment2,
				'investment3'=>$investment3,'investment4'=>$investment4,
				'type'=>$type,'enterprise'=>$enterprise,'agency'=>$agency,
				'types'=>$types,'download1'=>$download1,'photos'=>$photos,
				'download2'=>$download2,'banner'=>$banner,'projectTable'=>$projectTable,
				'download3'=>$download3,'download4'=>$download4,

				]);
		}
		

	}

	//基地介绍
	public function base(Request $request){
		$sel=$request->input('sel');
		if($sel){
			if($sel==1){
				$aname=$request->input('aname');
				$proindustry=$request->input('proindustry');
				$procooperation=$request->input('procooperation');
				$promature=$request->input('promature');
				$procoop_money=$request->input('procoop_money');
				if($aname){
					$project=Project::select()
					        ->where('name','like',"%$aname%")
					        ->orderBy('create_time','desc')
					        ->get()
					        ->toArray();
					foreach ($project as $key => $value) {
		            $photo=$value['photo'];
		            $photo=explode(',', $photo);
		            foreach($photo as $k => $v){
		                $project[$key]['img'.$k] = $v;

		            }
		        	}
		        	$perPage = 5;		
		        	if ($request->has('apage')) {				
			        	$current_page = $request->input('apage');				
			        	$current_page = $current_page <= 0 ? 1 :$current_page;		
		        	} 
		        	else {				
		        	$current_page = 1;		
		        	} 		
		        	$item = array_slice($project, ($current_page-1)*$perPage, $perPage); 
		        	//按分页取数据		
		        	$total = count($project);	
		        	$project =new LengthAwarePaginator($item, $total, $perPage,
		        	$current_page, [					
		        			'pageName' => 'apage']);
			        $project = $project->setPath('findex/project');
					//人气
					$project1=Project::select()
					        ->where('name','like',"%$aname%")
					        ->orderBy('look','desc')
					        ->get()
					        ->toArray();
					foreach ($project1 as $key => $value) {
		            $photo=$value['photo'];
		            $photo=explode(',', $photo);
		            foreach($photo as $k => $v){
		                $project1[$key]['img'.$k] = $v;

		            }
		        	}
		        	$perPage = 5;		
		        	if ($request->has('apage')) {				
			        	$current_page = $request->input('apage');				
			        	$current_page = $current_page <= 0 ? 1 :$current_page;		
		        	} 
		        	else {				
		        	$current_page = 1;		
		        	} 		
		        	$item = array_slice($project1, ($current_page-1)*$perPage, $perPage); 
		        	//按分页取数据		
		        	$total = count($project1);	
		        	$project1 =new LengthAwarePaginator($item, $total, $perPage,
		        	$current_page, [					
		        			'pageName' => 'apage']);
			        $project1 = $project1->setPath('findex/project');
					//收藏
					$project2=Project::select()
					        ->where('name','like',"%$aname%")
					        ->orderBy('collection','desc')
					        ->get()
					        ->toArray();
					foreach ($project2 as $key => $value) {
		            $photo=$value['photo'];
		            $photo=explode(',', $photo);
		            foreach($photo as $k => $v){
		                $project2[$key]['img'.$k] = $v;

		            }
		        	}
		        	$perPage = 5;		
		        	if ($request->has('apage')) {				
			        	$current_page = $request->input('apage');				
			        	$current_page = $current_page <= 0 ? 1 :$current_page;		
		        	} 
		        	else {				
		        	$current_page = 1;		
		        	} 		
		        	$item = array_slice($project2, ($current_page-1)*$perPage, $perPage); 
		        	//按分页取数据		
		        	$total = count($project2);	
		        	$project2 =new LengthAwarePaginator($item, $total, $perPage,
		        	$current_page, [					
		        			'pageName' => 'apage']);
			        $project2 = $project2->setPath('findex/project');

					$industry=DB::table('industry')
							->get();
					$cooperation=DB::table('cooperation')->get();
					$mature=DB::table('mature')->get();
					$requirement=DB::table('requirement')
							->orderBy('create_time','desc')
							->paginate(9);
					//banner
					$banner=DB::table('banner')
							->get();
					return view('findex/project',['project'=>$project,'project1'=>$project1,
						'project2'=>$project2,'industry'=>$industry,'banner'=>$banner,
						'requirement'=>$requirement,'proindustry'=>$proindustry,
						'procooperation'=>$procooperation,'promature'=>$promature,
						'procoop_money'=>$procoop_money,'name'=>$aname,'cooperation'=>$cooperation,
						'mature'=>$mature]);
				}
				return redirect('findex/project');
			}
			elseif ($sel==2) {
				$aname=$request->input('aname');
				$proindustry=$request->input('proindustry');
				$procooperation=$request->input('procooperation');
				$procoop_money=$request->input('procoop_money');
				if($aname){
					$industry=DB::table('industry')
							->get();
					$cooperation=DB::table('cooperation')->get();
					$requirement=DB::table('requirement')
							->join('industry','industry.iid','=','requirement.industry')
							->where('name','like',"%$aname%")
							->orderBy('create_time','desc')
							->paginate($perPage = 4, $columns = ['*'], $pageName = 'cpage');
					$requirement->setPath('requirement');
					$requirement1=DB::table('requirement')
							->join('industry','industry.iid','=','requirement.industry')
							->where('name','like',"%$aname%")
							->orderBy('look','desc')
							->paginate($perPage = 4, $columns = ['*'], $pageName = 'cpage');
				
					$requirement2=DB::table('requirement')
							->join('industry','industry.iid','=','requirement.industry')
							->where('name','like',"%$aname%")
							->orderBy('collection','desc')
							->paginate($perPage = 4, $columns = ['*'], $pageName = 'cpage');
					$project=Project::select()
								->join('industry','industry.iid','=','project.industry')
						        ->orderBy('create_time','desc')
						        ->get()
						        ->toArray();
							foreach ($project as $key => $value) {
				            $photo=$value['photo'];
				            $photo=explode(',', $photo);
				            foreach($photo as $k => $v){
				                $project[$key]['img'.$k] = $v;

				            }
				        	}
				        	$perPage =4;		
				        	if ($request->has('pagess')) {				
					        	$current_page = $request->input('pagess');				
					        	$current_page = $current_page <= 0 ? 1 :$current_page;		
				        	} 
				        	else {				
				        	$current_page = 1;		
				        	} 		
				        	$item = array_slice($project, ($current_page-1)*$perPage, $perPage); 
				        	//按分页取数据		
				        	$total = count($project);	
				        	$project =new LengthAwarePaginator($item, $total, $perPage,
				        	$current_page, [					
				        			'pageName' => 'pagess']);
					        $project = $project->setPath('/laravel/public/findex/project');
					        //banner
							$banner=DB::table('banner')
									->get();
							$requirements=DB::table('requirement')
								->orderBy('look','desc')
								->paginate($perPage = 4, $columns = ['*'], $pageName = 'apages');
							return view('findex/requirement',['industry'=>$industry,
							'requirement'=>$requirement,'project'=>$project,
							'requirement1'=>$requirement1,'requirement2'=>$requirement2,
							'name'=>$aname,'proindustry'=>$proindustry,
							'procooperation'=>$procooperation,'procoop_money'=>$procoop_money,
							'banner'=>$banner,'requirements'=>$requirements,
							'cooperation'=>$cooperation]);
				}
				return redirect('findex/requirement');
			}
			elseif ($sel==3) {
				$name=$request->input('aname');
				$proindustry=$request->input('proindustry');
				$procooperation=$request->input('procooperation');
				$procoop_money=$request->input('procoop_money');
				if($name){
					$industry=DB::table('industry')
							->get();
					$cooperation=DB::table('cooperation')->get();
					$enterprise=DB::table('enterprise')
							->join('industry','industry.iid','=','enterprise.industry')
							->where('name','like',"%$name%")
							->orderBy('create_time','desc')
							->paginate($perPage = 5, $columns = ['*'], $pageName = 'pages');
					$enterprise1=DB::table('enterprise')
							->join('industry','industry.iid','=','enterprise.industry')
							->where('name','like',"%$name%")
							->orderBy('look','desc')
							->paginate($perPage = 5, $columns = ['*'], $pageName = 'pages');
					$enterprise2=DB::table('enterprise')
							->join('industry','industry.iid','=','enterprise.industry')
							->where('name','like',"%$name%")
							->orderBy('collection','desc')
							->paginate($perPage = 5, $columns = ['*'], $pageName = 'pages');		
					$enterprise->setPath('enterprise');
					//banner
					$banner=DB::table('banner')
							->get();
					return view('findex/enterprise',['industry'=>$industry,
					'enterprise'=>$enterprise,'enterprise1'=>$enterprise1,
					'enterprise2'=>$enterprise2,'name'=>$name,
					'proindustry'=>$proindustry,'procooperation'=>$procooperation,
					'procoop_money'=>$procoop_money,'banner'=>$banner,'cooperation'=>$cooperation]);
				}
				return redirect('findex/enterprise');
			}
		}
		$base=DB::table('introduce')
				->orderBy('create_time','desc')
				->first();
		//banner
		$banner=DB::table('banner')
				->get();
		return view('findex/base',['base'=>$base,'banner'=>$banner]);
	}

	//项目库
	public function project(Request $request){
		$sel=$request->input('sel');
		if($sel){
			if($sel==1){
				$aname=$request->input('aname');
				$proindustry=$request->input('proindustry');
				$procooperation=$request->input('procooperation');
				$promature=$request->input('promature');
				$procoop_money=$request->input('procoop_money');
				if($aname){
					$project=Project::select()
					        ->where('name','like',"%$aname%")
					        ->orderBy('create_time','desc')
					        ->get()
					        ->toArray();
					foreach ($project as $key => $value) {
		            $photo=$value['photo'];
		            $photo=explode(',', $photo);
		            foreach($photo as $k => $v){
		                $project[$key]['img'.$k] = $v;

		            }
		        	}
		        	$perPage = 5;		
		        	if ($request->has('apage')) {				
			        	$current_page = $request->input('apage');				
			        	$current_page = $current_page <= 0 ? 1 :$current_page;		
		        	} 
		        	else {				
		        	$current_page = 1;		
		        	} 		
		        	$item = array_slice($project, ($current_page-1)*$perPage, $perPage); 
		        	//按分页取数据		
		        	$total = count($project);	
		        	$project =new LengthAwarePaginator($item, $total, $perPage,
		        	$current_page, [					
		        			'pageName' => 'apage']);
			        $project = $project->setPath('findex/project');
					//人气
					$project1=Project::select()
					        ->where('name','like',"%$aname%")
					        ->orderBy('look','desc')
					        ->get()
					        ->toArray();
					foreach ($project1 as $key => $value) {
		            $photo=$value['photo'];
		            $photo=explode(',', $photo);
		            foreach($photo as $k => $v){
		                $project1[$key]['img'.$k] = $v;

		            }
		        	}
		        	$perPage = 5;		
		        	if ($request->has('apage')) {				
			        	$current_page = $request->input('apage');				
			        	$current_page = $current_page <= 0 ? 1 :$current_page;		
		        	} 
		        	else {				
		        	$current_page = 1;		
		        	} 		
		        	$item = array_slice($project1, ($current_page-1)*$perPage, $perPage); 
		        	//按分页取数据		
		        	$total = count($project1);	
		        	$project1 =new LengthAwarePaginator($item, $total, $perPage,
		        	$current_page, [					
		        			'pageName' => 'apage']);
			        $project1 = $project1->setPath('findex/project');
					//收藏
					$project2=Project::select()
					        ->where('name','like',"%$aname%")
					        ->orderBy('collection','desc')
					        ->get()
					        ->toArray();
					foreach ($project2 as $key => $value) {
		            $photo=$value['photo'];
		            $photo=explode(',', $photo);
		            foreach($photo as $k => $v){
		                $project2[$key]['img'.$k] = $v;

		            }
		        	}
		        	$perPage = 5;		
		        	if ($request->has('apage')) {				
			        	$current_page = $request->input('apage');				
			        	$current_page = $current_page <= 0 ? 1 :$current_page;		
		        	} 
		        	else {				
		        	$current_page = 1;		
		        	} 		
		        	$item = array_slice($project2, ($current_page-1)*$perPage, $perPage); 
		        	//按分页取数据		
		        	$total = count($project2);	
		        	$project2 =new LengthAwarePaginator($item, $total, $perPage,
		        	$current_page, [					
		        			'pageName' => 'apage']);
			        $project2 = $project2->setPath('findex/project');

					$industry=DB::table('industry')
							->get();
					$cooperation=DB::table('cooperation')->get();
					$mature=DB::table('mature')->get();
					$requirement=DB::table('requirement')
							->orderBy('create_time','desc')
							->paginate(9);
					//banner
					$banner=DB::table('banner')
							->get();
					return view('findex/project',['project'=>$project,'project1'=>$project1,
						'project2'=>$project2,'industry'=>$industry,'banner'=>$banner,
						'requirement'=>$requirement,'proindustry'=>$proindustry,
						'procooperation'=>$procooperation,'promature'=>$promature,
						'procoop_money'=>$procoop_money,'name'=>$aname,'cooperation'=>$cooperation,
						'mature'=>$mature]);
				}
				return redirect('findex/project');
			}
			elseif ($sel==2) {
				$aname=$request->input('aname');
				$proindustry=$request->input('proindustry');
				$procooperation=$request->input('procooperation');
				$procoop_money=$request->input('procoop_money');
				if($aname){
					$industry=DB::table('industry')
							->get();
					$cooperation=DB::table('cooperation')->get();
					$requirement=DB::table('requirement')
							->join('industry','industry.iid','=','requirement.industry')
							->where('name','like',"%$aname%")
							->orderBy('create_time','desc')
							->paginate($perPage = 4, $columns = ['*'], $pageName = 'cpage');
					$requirement->setPath('requirement');
					$requirement1=DB::table('requirement')
							->join('industry','industry.iid','=','requirement.industry')
							->where('name','like',"%$aname%")
							->orderBy('look','desc')
							->paginate($perPage = 4, $columns = ['*'], $pageName = 'cpage');
				
					$requirement2=DB::table('requirement')
							->join('industry','industry.iid','=','requirement.industry')
							->where('name','like',"%$aname%")
							->orderBy('collection','desc')
							->paginate($perPage = 4, $columns = ['*'], $pageName = 'cpage');
					$project=Project::select()
								->join('industry','industry.iid','=','project.industry')
						        ->orderBy('create_time','desc')
						        ->get()
						        ->toArray();
							foreach ($project as $key => $value) {
				            $photo=$value['photo'];
				            $photo=explode(',', $photo);
				            foreach($photo as $k => $v){
				                $project[$key]['img'.$k] = $v;

				            }
				        	}
				        	$perPage =4;		
				        	if ($request->has('pagess')) {				
					        	$current_page = $request->input('pagess');				
					        	$current_page = $current_page <= 0 ? 1 :$current_page;		
				        	} 
				        	else {				
				        	$current_page = 1;		
				        	} 		
				        	$item = array_slice($project, ($current_page-1)*$perPage, $perPage); 
				        	//按分页取数据		
				        	$total = count($project);	
				        	$project =new LengthAwarePaginator($item, $total, $perPage,
				        	$current_page, [					
				        			'pageName' => 'pagess']);
					        $project = $project->setPath('/laravel/public/findex/project');
					        //banner
							$banner=DB::table('banner')
									->get();
							$requirements=DB::table('requirement')
								->orderBy('look','desc')
								->paginate($perPage = 4, $columns = ['*'], $pageName = 'apages');
							return view('findex/requirement',['industry'=>$industry,
							'requirement'=>$requirement,'project'=>$project,
							'requirement1'=>$requirement1,'requirement2'=>$requirement2,
							'name'=>$aname,'proindustry'=>$proindustry,
							'procooperation'=>$procooperation,'procoop_money'=>$procoop_money,
							'banner'=>$banner,'requirements'=>$requirements,
							'cooperation'=>$cooperation]);
				}
				return redirect('findex/requirement');
			}
			elseif ($sel==3) {
				$name=$request->input('aname');
				$proindustry=$request->input('proindustry');
				$procooperation=$request->input('procooperation');
				$procoop_money=$request->input('procoop_money');
				if($name){
					$industry=DB::table('industry')
							->get();
					$cooperation=DB::table('cooperation')->get();
					$enterprise=DB::table('enterprise')
							->join('industry','industry.iid','=','enterprise.industry')
							->where('name','like',"%$name%")
							->orderBy('create_time','desc')
							->paginate($perPage = 5, $columns = ['*'], $pageName = 'pages');
					$enterprise1=DB::table('enterprise')
							->join('industry','industry.iid','=','enterprise.industry')
							->where('name','like',"%$name%")
							->orderBy('look','desc')
							->paginate($perPage = 5, $columns = ['*'], $pageName = 'pages');
					$enterprise2=DB::table('enterprise')
							->join('industry','industry.iid','=','enterprise.industry')
							->where('name','like',"%$name%")
							->orderBy('collection','desc')
							->paginate($perPage = 5, $columns = ['*'], $pageName = 'pages');		
					$enterprise->setPath('enterprise');
					//banner
					$banner=DB::table('banner')
							->get();
					return view('findex/enterprise',['industry'=>$industry,
					'enterprise'=>$enterprise,'enterprise1'=>$enterprise1,
					'enterprise2'=>$enterprise2,'name'=>$name,
					'proindustry'=>$proindustry,'procooperation'=>$procooperation,
					'procoop_money'=>$procoop_money,'banner'=>$banner,'cooperation'=>$cooperation]);
				}
				return redirect('findex/enterprise');
			}
		}
		$name=$request->input('name');
		$selname=$request->session()->put('selname',$name);
		$entesel=$request->input('entesel');
		$proindustry=$request->input('proindustry');
		$procooperation=$request->input('procooperation');
		$promature=$request->input('promature');
		$procoop_money=$request->input('procoop_money');
		if($entesel){
			if(!$name){
				//时间
				$project=Project::select()
				        ->where('name','like',"%$name%")
				        ->orderBy('create_time','desc')
				        ->get()
				        ->toArray();
				foreach ($project as $key => $value) {
	            $photo=$value['photo'];
	            $photo=explode(',', $photo);
	            foreach($photo as $k => $v){
	                $project[$key]['img'.$k] = $v;

	            }
	        	}
	        	$perPage = 5;		
	        	if ($request->has('apage')) {				
		        	$current_page = $request->input('apage');				
		        	$current_page = $current_page <= 0 ? 1 :$current_page;		
	        	} 
	        	else {				
	        	$current_page = 1;		
	        	} 		
	        	$item = array_slice($project, ($current_page-1)*$perPage, $perPage); 
	        	//按分页取数据		
	        	$total = count($project);	
	        	$project =new LengthAwarePaginator($item, $total, $perPage,
	        	$current_page, [					
	        			'pageName' => 'apage']);
		        $project = $project->setPath('project');
				//人气
				$project1=Project::select()
				        ->where('name','like',"%$name%")
				        ->orderBy('look','desc')
				        ->get()
				        ->toArray();
				foreach ($project1 as $key => $value) {
	            $photo=$value['photo'];
	            $photo=explode(',', $photo);
	            foreach($photo as $k => $v){
	                $project1[$key]['img'.$k] = $v;

	            }
	        	}
	        	$perPage = 5;		
	        	if ($request->has('apage')) {				
		        	$current_page = $request->input('apage');				
		        	$current_page = $current_page <= 0 ? 1 :$current_page;		
	        	} 
	        	else {				
	        	$current_page = 1;		
	        	} 		
	        	$item = array_slice($project1, ($current_page-1)*$perPage, $perPage); 
	        	//按分页取数据		
	        	$total = count($project1);	
	        	$project1 =new LengthAwarePaginator($item, $total, $perPage,
	        	$current_page, [					
	        			'pageName' => 'apage']);
		        $project1 = $project1->setPath('project');
				//收藏
				$project2=Project::select()
				        ->where('name','like',"%$name%")
				        ->orderBy('collection','desc')
				        ->get()
				        ->toArray();
				foreach ($project2 as $key => $value) {
	            $photo=$value['photo'];
	            $photo=explode(',', $photo);
	            foreach($photo as $k => $v){
	                $project2[$key]['img'.$k] = $v;

	            }
	        	}
	        	$perPage = 5;		
	        	if ($request->has('apage')) {				
		        	$current_page = $request->input('apage');				
		        	$current_page = $current_page <= 0 ? 1 :$current_page;		
	        	} 
	        	else {				
	        	$current_page = 1;		
	        	} 		
	        	$item = array_slice($project2, ($current_page-1)*$perPage, $perPage); 
	        	//按分页取数据		
	        	$total = count($project2);	
	        	$project2 =new LengthAwarePaginator($item, $total, $perPage,
	        	$current_page, [					
	        			'pageName' => 'apage']);
		        $project2 = $project2->setPath('project');

			}
			if($entesel==1){
				//时间
				$project=Project::select()
				        ->where('name','like',"%$name%")
				        ->orderBy('create_time','desc')
				        ->get()
				        ->toArray();
				foreach ($project as $key => $value) {
	            $photo=$value['photo'];
	            $photo=explode(',', $photo);
	            foreach($photo as $k => $v){
	                $project[$key]['img'.$k] = $v;

	            }
	        	}
	        	$perPage = 5;		
	        	if ($request->has('apage')) {				
		        	$current_page = $request->input('apage');				
		        	$current_page = $current_page <= 0 ? 1 :$current_page;		
	        	} 
	        	else {				
	        	$current_page = 1;		
	        	} 		
	        	$item = array_slice($project, ($current_page-1)*$perPage, $perPage); 
	        	//按分页取数据		
	        	$total = count($project);	
	        	$project =new LengthAwarePaginator($item, $total, $perPage,
	        	$current_page, [					
	        			'pageName' => 'apage']);
		        $project = $project->setPath('project');
				//人气
				$project1=Project::select()
				        ->where('name','like',"%$name%")
				        ->orderBy('look','desc')
				        ->get()
				        ->toArray();
				foreach ($project1 as $key => $value) {
	            $photo=$value['photo'];
	            $photo=explode(',', $photo);
	            foreach($photo as $k => $v){
	                $project1[$key]['img'.$k] = $v;

	            }
	        	}
	        	$perPage = 5;		
	        	if ($request->has('apage')) {				
		        	$current_page = $request->input('apage');				
		        	$current_page = $current_page <= 0 ? 1 :$current_page;		
	        	} 
	        	else {				
	        	$current_page = 1;		
	        	} 		
	        	$item = array_slice($project1, ($current_page-1)*$perPage, $perPage); 
	        	//按分页取数据		
	        	$total = count($project1);	
	        	$project1 =new LengthAwarePaginator($item, $total, $perPage,
	        	$current_page, [					
	        			'pageName' => 'apage']);
		        $project1 = $project1->setPath('project');
				//收藏
				$project2=Project::select()
				        ->where('name','like',"%$name%")
				        ->orderBy('collection','desc')
				        ->get()
				        ->toArray();
				foreach ($project2 as $key => $value) {
	            $photo=$value['photo'];
	            $photo=explode(',', $photo);
	            foreach($photo as $k => $v){
	                $project2[$key]['img'.$k] = $v;

	            }
	        	}
	        	$perPage = 5;		
	        	if ($request->has('apage')) {				
		        	$current_page = $request->input('apage');				
		        	$current_page = $current_page <= 0 ? 1 :$current_page;		
	        	} 
	        	else {				
	        	$current_page = 1;		
	        	} 		
	        	$item = array_slice($project2, ($current_page-1)*$perPage, $perPage); 
	        	//按分页取数据		
	        	$total = count($project2);	
	        	$project2 =new LengthAwarePaginator($item, $total, $perPage,
	        	$current_page, [					
	        			'pageName' => 'apage']);
		        $project2 = $project2->setPath('project');

			}
			if($entesel==2){
				//时间
				$project=Project::select()
				        ->where('niche','like',"%$name%")
				        ->orderBy('create_time','desc')
				        ->get()
				        ->toArray();
				foreach ($project as $key => $value) {
	            $photo=$value['photo'];
	            $photo=explode(',', $photo);
	            foreach($photo as $k => $v){
	                $project[$key]['img'.$k] = $v;

	            }
	        	}
	        	$perPage = 5;		
	        	if ($request->has('apage')) {				
		        	$current_page = $request->input('apage');				
		        	$current_page = $current_page <= 0 ? 1 :$current_page;		
	        	} 
	        	else {				
	        	$current_page = 1;		
	        	} 		
	        	$item = array_slice($project, ($current_page-1)*$perPage, $perPage); 
	        	//按分页取数据		
	        	$total = count($project);	
	        	$project =new LengthAwarePaginator($item, $total, $perPage,
	        	$current_page, [					
	        			'pageName' => 'apage']);
		        $project = $project->setPath('project');
				//人气
				$project1=Project::select()
				        ->where('niche','like',"%$name%")
				        ->orderBy('look','desc')
				        ->get()
				        ->toArray();
				foreach ($project1 as $key => $value) {
	            $photo=$value['photo'];
	            $photo=explode(',', $photo);
	            foreach($photo as $k => $v){
	                $project1[$key]['img'.$k] = $v;

	            }
	        	}
	        	$perPage = 5;		
	        	if ($request->has('apage')) {				
		        	$current_page = $request->input('apage');				
		        	$current_page = $current_page <= 0 ? 1 :$current_page;		
	        	} 
	        	else {				
	        	$current_page = 1;		
	        	} 		
	        	$item = array_slice($project1, ($current_page-1)*$perPage, $perPage); 
	        	//按分页取数据		
	        	$total = count($project1);	
	        	$project1 =new LengthAwarePaginator($item, $total, $perPage,
	        	$current_page, [					
	        			'pageName' => 'apage']);
		        $project1 = $project1->setPath('project');
				//收藏
				$project2=Project::select()
				        ->where('niche','like',"%$name%")
				        ->orderBy('collection','desc')
				        ->get()
				        ->toArray();
				foreach ($project2 as $key => $value) {
	            $photo=$value['photo'];
	            $photo=explode(',', $photo);
	            foreach($photo as $k => $v){
	                $project2[$key]['img'.$k] = $v;

	            }
	        	}
	        	$perPage = 5;		
	        	if ($request->has('apage')) {				
		        	$current_page = $request->input('apage');				
		        	$current_page = $current_page <= 0 ? 1 :$current_page;		
	        	} 
	        	else {				
	        	$current_page = 1;		
	        	} 		
	        	$item = array_slice($project2, ($current_page-1)*$perPage, $perPage); 
	        	//按分页取数据		
	        	$total = count($project2);	
	        	$project2 =new LengthAwarePaginator($item, $total, $perPage,
	        	$current_page, [					
	        			'pageName' => 'apage']);
		        $project2 = $project2->setPath('project');

			}

			
			$industry=DB::table('industry')
					->get();
			$cooperation=DB::table('cooperation')->get();
			$mature=DB::table('mature')->get();

			$requirement=DB::table('requirement')
					->orderBy('create_time','desc')
					->paginate(9);
			//banner
			$banner=DB::table('banner')
					->get();
		}
		else{
				if($proindustry||$procooperation||$promature||$procoop_money){
					if($proindustry=="不限"){
						$proindustry='';
					}
					if($procooperation=="不限"){
						$procooperation='';
					}
					if($promature=="不限"){
						$promature='';
					}
					if($procoop_money=="不限"){
						$procoop_money='';
					}
					if($proindustry=="新一代信息技术及智慧产业"){
						$proindustrys='1';
					}
					if($proindustry=="高端装备与先进制造"){
						$proindustrys='2';
					}
					if($proindustry=="新材料"){
						$proindustrys='3';
					}
					if($proindustry=="科技服务"){
						$proindustrys='4';
					}
					if($proindustry=="其它"){
						$proindustrys='5';
					}
					if($procooperation=="股权投资"){
						$procooperation='1';
					}
					if($procooperation=="技术转让"){
						$procooperation='2';
					}
					if($procooperation=="许可使用"){
						$procooperation='3';
					}
					if($procooperation=="合作开发"){
						$procooperation='4';
					}
					if($procooperation=="合作兴办企业"){
						$procooperation='5';
					}
					if($procooperation=="其它"){
						$procooperation='6';
					}
					if($promature=="研制"){
						$promature='1';
					}
					if($promature=="试生产"){
						$promature='2';
					}
					if($promature=="小批量生产"){
						$promature='3';
					}
					if($promature=="大批量生产"){
						$promature='4';
					}
					$where="1=1";
					if (!empty($proindustry)) {
						$where.=" and industry=".$proindustrys;
					}
					if (!empty($procooperation)) {
						$where.=" and cooperation='".$procooperation."'";
					}
					if (!empty($promature)) {
						$where.=" and mature='".$promature."'";
					}
					if (!empty($procoop_money)) {
						if($procoop_money=='一万以下'){
							$procoop_money=10000;
							$where.=" and coop_money < ".$procoop_money;
						}
						if($procoop_money=='一万到三万'){
							$procoop_money=10000;
							$procoop_moneys=30000;
							$where.=" and coop_money > ".$procoop_money." and coop_money <".
							$procoop_moneys;
						}
						if($procoop_money=='三万以上'){
							$procoop_money=30000;
							$where.=" and coop_money >".$procoop_money;
						}
						
					}
					$project=Project::select()
						->join('industry','industry.iid','=','project.industry')
						->whereRaw($where)					
				        ->orderBy('create_time','desc')
				        ->get()
				        ->toArray();

					foreach ($project as $key => $value) {
		            $photo=$value['photo'];
		            $photo=explode(',', $photo);
		            foreach($photo as $k => $v){
		                $project[$key]['img'.$k] = $v;
		            }
		        	}
		        	$perPage = 5;		
		        	if ($request->has('pagess')) {				
			        	$current_page = $request->input('pagess');				
			        	$current_page = $current_page <= 0 ? 1 :$current_page;		
		        	} 
		        	else {				
		        	$current_page = 1;		
		        	} 		
		        	$item = array_slice($project, ($current_page-1)*$perPage, $perPage); 
		        	//按分页取数据		
		        	$total = count($project);	
		        	$project =new LengthAwarePaginator($item, $total, $perPage,
		        	$current_page, [					
		        			'pageName' => 'pagess']);
			        $project = $project->setPath('project');
			        //人气
			        $project1=Project::select()
						->join('industry','industry.iid','=','project.industry')
						->whereRaw($where)					
				        ->orderBy('look','desc')
				        ->get()
				        ->toArray();
					foreach ($project1 as $key => $value) {
		            $photo=$value['photo'];
		            $photo=explode(',', $photo);
		            foreach($photo as $k => $v){
		                $project1[$key]['img'.$k] = $v;

		            }
		        	}
		        	$perPage = 5;		
		        	if ($request->has('pagess')) {				
			        	$current_page = $request->input('pagess');				
			        	$current_page = $current_page <= 0 ? 1 :$current_page;		
		        	} 
		        	else {				
		        	$current_page = 1;		
		        	} 		
		        	$item = array_slice($project1, ($current_page-1)*$perPage, $perPage); 
		        	//按分页取数据		
		        	$total = count($project1);	
		        	$project1 =new LengthAwarePaginator($item, $total, $perPage,
		        	$current_page, [					
		        			'pageName' => 'pagess']);
			        $project1 = $project1->setPath('project');
			        //收藏
			        $project2=Project::select()
						->join('industry','industry.iid','=','project.industry')
						->whereRaw($where)					
				        ->orderBy('collection','desc')
				        ->get()
				        ->toArray();
					foreach ($project2 as $key => $value) {
		            $photo=$value['photo'];
		            $photo=explode(',', $photo);
		            foreach($photo as $k => $v){
		                $project2[$key]['img'.$k] = $v;

		            }
		        	}
		        	$perPage = 5;		
		        	if ($request->has('pagess')) {				
			        	$current_page = $request->input('pagess');				
			        	$current_page = $current_page <= 0 ? 1 :$current_page;		
		        	} 
		        	else {				
		        	$current_page = 1;		
		        	} 		
		        	$item = array_slice($project2, ($current_page-1)*$perPage, $perPage); 
		        	//按分页取数据		
		        	$total = count($project2);	
		        	$project2 =new LengthAwarePaginator($item, $total, $perPage,
		        	$current_page, [					
		        			'pageName' => 'pagess']);
			        $project2 = $project2->setPath('project');
			        $industry=DB::table('industry')
							->get();
					$cooperation=DB::table('cooperation')->get();
					$mature=DB::table('mature')->get();

					$requirement=DB::table('requirement')
							->orderBy('create_time','desc')
							->paginate(9);
					//banner
					$banner=DB::table('banner')
							->get();
					return view('findex/project',['project'=>$project,'project1'=>$project1,
						'project2'=>$project2,'industry'=>$industry,'banner'=>$banner,
						'requirement'=>$requirement,'proindustry'=>$proindustry,
						'procooperation'=>$procooperation,'promature'=>$promature,
						'procoop_money'=>$procoop_money,'name'=>$name,'cooperation'=>$cooperation,
						'mature'=>$mature,]);
				}
				else{
					//时间
					$project=Project::select()
				        ->orderBy('create_time','desc')
				        ->get()
				        ->toArray();
					foreach ($project as $key => $value) {
		            $photo=$value['photo'];
		            $photo=explode(',', $photo);
		            foreach($photo as $k => $v){
		                $project[$key]['img'.$k] = $v;

		            }
		        	}
		        	$perPage = 5;		
		        	if ($request->has('pages')) {				
			        	$current_page = $request->input('pages');				
			        	$current_page = $current_page <= 0 ? 1 :$current_page;		
		        	} 
		        	else {				
		        	$current_page = 1;		
		        	} 		
		        	$item = array_slice($project, ($current_page-1)*$perPage, $perPage); 
		        	//按分页取数据		
		        	$total = count($project);	
		        	$project =new LengthAwarePaginator($item, $total, $perPage,
		        	$current_page, [					
		        			'pageName' => 'pages']); 		

			        $project = $project->setPath('project');

					//人气
					$project1=Project::select()
				        ->orderBy('look','desc')
				        ->get()
				        ->toArray();
					foreach ($project1 as $key => $value) {
		            $photo=$value['photo'];
		            $photo=explode(',', $photo);
		            foreach($photo as $k => $v){
		                $project1[$key]['img'.$k] = $v;

		            }
		        	}
		        	$perPage = 5;		
		        	if ($request->has('pages')) {				
			        	$current_page = $request->input('pages');				
			        	$current_page = $current_page <= 0 ? 1 :$current_page;		
		        	} 
		        	else {				
		        	$current_page = 1;		
		        	} 		
		        	$item = array_slice($project1, ($current_page-1)*$perPage, $perPage); 
		        	//按分页取数据		
		        	$total = count($project1);	
		        	$project1 =new LengthAwarePaginator($item, $total, $perPage,
		        	$current_page, [					
		        			'pageName' => 'pages']);
		        	$project1 = $project1->setPath('project');
					//收藏
					$project2=Project::select()
				        ->orderBy('collection','desc')
				        ->get()
				        ->toArray();
					foreach ($project2 as $key => $value) {
		            $photo=$value['photo'];
		            $photo=explode(',', $photo);
		            foreach($photo as $k => $v){
		                $project2[$key]['img'.$k] = $v;

		            }
		        	}
		        	$perPage = 5;		
		        	if ($request->has('pages')) {				
			        	$current_page = $request->input('pages');				
			        	$current_page = $current_page <= 0 ? 1 :$current_page;		
		        	} 
		        	else {				
		        	$current_page = 1;		
		        	} 		
		        	$item = array_slice($project2, ($current_page-1)*$perPage, $perPage); 
		        	//按分页取数据		
		        	$total = count($project2);	
		        	$project2 =new LengthAwarePaginator($item, $total, $perPage,
		        	$current_page, [					
		        			'pageName' => 'pages']);
			        $project2 = $project2->setPath('project');

					$industry=DB::table('industry')
							->get();
					$cooperation=DB::table('cooperation')->get();
					$mature=DB::table('mature')->get();
					$requirement=DB::table('requirement')
							->orderBy('create_time','desc')
							->paginate(9);
					//banner
					$banner=DB::table('banner')
							->get();
					}

			}
		return view('findex/project',['project'=>$project,
			'industry'=>$industry,'requirement'=>$requirement,
			'project1'=>$project1,'project2'=>$project2,'name'=>$name,
			'proindustry'=>$proindustry,'procooperation'=>$procooperation,
			'promature'=>$promature,'procoop_money'=>$procoop_money,'banner'=>$banner,
			'cooperation'=>$cooperation,'mature'=>$mature,]);
	}
	//需求信息
	public function requirement(Request $request){
		$sel=$request->input('sel');
		if($sel){
			if($sel==1){
				$aname=$request->input('aname');
				$proindustry=$request->input('proindustry');
				$procooperation=$request->input('procooperation');
				$promature=$request->input('promature');
				$procoop_money=$request->input('procoop_money');
				if($aname){
					$project=Project::select()
					        ->where('name','like',"%$aname%")
					        ->orderBy('create_time','desc')
					        ->get()
					        ->toArray();
					foreach ($project as $key => $value) {
		            $photo=$value['photo'];
		            $photo=explode(',', $photo);
		            foreach($photo as $k => $v){
		                $project[$key]['img'.$k] = $v;

		            }
		        	}
		        	$perPage = 5;		
		        	if ($request->has('apage')) {				
			        	$current_page = $request->input('apage');				
			        	$current_page = $current_page <= 0 ? 1 :$current_page;		
		        	} 
		        	else {				
		        	$current_page = 1;		
		        	} 		
		        	$item = array_slice($project, ($current_page-1)*$perPage, $perPage); 
		        	//按分页取数据		
		        	$total = count($project);	
		        	$project =new LengthAwarePaginator($item, $total, $perPage,
		        	$current_page, [					
		        			'pageName' => 'apage']);
			        $project = $project->setPath('findex/project');
					//人气
					$project1=Project::select()
					        ->where('name','like',"%$aname%")
					        ->orderBy('look','desc')
					        ->get()
					        ->toArray();
					foreach ($project1 as $key => $value) {
		            $photo=$value['photo'];
		            $photo=explode(',', $photo);
		            foreach($photo as $k => $v){
		                $project1[$key]['img'.$k] = $v;

		            }
		        	}
		        	$perPage = 5;		
		        	if ($request->has('apage')) {				
			        	$current_page = $request->input('apage');				
			        	$current_page = $current_page <= 0 ? 1 :$current_page;		
		        	} 
		        	else {				
		        	$current_page = 1;		
		        	} 		
		        	$item = array_slice($project1, ($current_page-1)*$perPage, $perPage); 
		        	//按分页取数据		
		        	$total = count($project1);	
		        	$project1 =new LengthAwarePaginator($item, $total, $perPage,
		        	$current_page, [					
		        			'pageName' => 'apage']);
			        $project1 = $project1->setPath('findex/project');
					//收藏
					$project2=Project::select()
					        ->where('name','like',"%$aname%")
					        ->orderBy('collection','desc')
					        ->get()
					        ->toArray();
					foreach ($project2 as $key => $value) {
		            $photo=$value['photo'];
		            $photo=explode(',', $photo);
		            foreach($photo as $k => $v){
		                $project2[$key]['img'.$k] = $v;

		            }
		        	}
		        	$perPage = 5;		
		        	if ($request->has('apage')) {				
			        	$current_page = $request->input('apage');				
			        	$current_page = $current_page <= 0 ? 1 :$current_page;		
		        	} 
		        	else {				
		        	$current_page = 1;		
		        	} 		
		        	$item = array_slice($project2, ($current_page-1)*$perPage, $perPage); 
		        	//按分页取数据		
		        	$total = count($project2);	
		        	$project2 =new LengthAwarePaginator($item, $total, $perPage,
		        	$current_page, [					
		        			'pageName' => 'apage']);
			        $project2 = $project2->setPath('findex/project');

					$industry=DB::table('industry')
							->get();
					$cooperation=DB::table('cooperation')->get();
					$mature=DB::table('mature')->get();
					$requirement=DB::table('requirement')
							->orderBy('create_time','desc')
							->paginate(9);
					//banner
					$banner=DB::table('banner')
							->get();
					return view('findex/project',['project'=>$project,'project1'=>$project1,
						'project2'=>$project2,'industry'=>$industry,'banner'=>$banner,
						'requirement'=>$requirement,'proindustry'=>$proindustry,
						'procooperation'=>$procooperation,'promature'=>$promature,
						'procoop_money'=>$procoop_money,'name'=>$aname,'cooperation'=>$cooperation,
						'mature'=>$mature]);
				}
				return redirect('findex/project');
			}
			elseif ($sel==2) {
				$aname=$request->input('aname');
				$proindustry=$request->input('proindustry');
				$procooperation=$request->input('procooperation');
				$procoop_money=$request->input('procoop_money');
				if($aname){
					$industry=DB::table('industry')
							->get();
					$cooperation=DB::table('cooperation')->get();
					$requirement=DB::table('requirement')
							->join('industry','industry.iid','=','requirement.industry')
							->where('name','like',"%$aname%")
							->orderBy('create_time','desc')
							->paginate($perPage = 4, $columns = ['*'], $pageName = 'cpage');
					$requirement->setPath('requirement');
					$requirement1=DB::table('requirement')
							->join('industry','industry.iid','=','requirement.industry')
							->where('name','like',"%$aname%")
							->orderBy('look','desc')
							->paginate($perPage = 4, $columns = ['*'], $pageName = 'cpage');
				
					$requirement2=DB::table('requirement')
							->join('industry','industry.iid','=','requirement.industry')
							->where('name','like',"%$aname%")
							->orderBy('collection','desc')
							->paginate($perPage = 4, $columns = ['*'], $pageName = 'cpage');
					$project=Project::select()
								->join('industry','industry.iid','=','project.industry')
						        ->orderBy('create_time','desc')
						        ->get()
						        ->toArray();
							foreach ($project as $key => $value) {
				            $photo=$value['photo'];
				            $photo=explode(',', $photo);
				            foreach($photo as $k => $v){
				                $project[$key]['img'.$k] = $v;

				            }
				        	}
				        	$perPage =4;		
				        	if ($request->has('pagess')) {				
					        	$current_page = $request->input('pagess');				
					        	$current_page = $current_page <= 0 ? 1 :$current_page;		
				        	} 
				        	else {				
				        	$current_page = 1;		
				        	} 		
				        	$item = array_slice($project, ($current_page-1)*$perPage, $perPage); 
				        	//按分页取数据		
				        	$total = count($project);	
				        	$project =new LengthAwarePaginator($item, $total, $perPage,
				        	$current_page, [					
				        			'pageName' => 'pagess']);
					        $project = $project->setPath('/laravel/public/findex/project');
					        //banner
							$banner=DB::table('banner')
									->get();
							$requirements=DB::table('requirement')
								->orderBy('look','desc')
								->paginate($perPage = 4, $columns = ['*'], $pageName = 'apages');
							return view('findex/requirement',['industry'=>$industry,
							'requirement'=>$requirement,'project'=>$project,
							'requirement1'=>$requirement1,'requirement2'=>$requirement2,
							'name'=>$aname,'proindustry'=>$proindustry,
							'procooperation'=>$procooperation,'procoop_money'=>$procoop_money,
							'banner'=>$banner,'requirements'=>$requirements,
							'cooperation'=>$cooperation]);
				}
				return redirect('findex/requirement');
			}
			elseif ($sel==3) {
				$name=$request->input('aname');
				$proindustry=$request->input('proindustry');
				$procooperation=$request->input('procooperation');
				$procoop_money=$request->input('procoop_money');
				if($name){
					$industry=DB::table('industry')
							->get();
					$cooperation=DB::table('cooperation')->get();
					$enterprise=DB::table('enterprise')
							->join('industry','industry.iid','=','enterprise.industry')
							->where('name','like',"%$name%")
							->orderBy('create_time','desc')
							->paginate($perPage = 5, $columns = ['*'], $pageName = 'pages');
					$enterprise1=DB::table('enterprise')
							->join('industry','industry.iid','=','enterprise.industry')
							->where('name','like',"%$name%")
							->orderBy('look','desc')
							->paginate($perPage = 5, $columns = ['*'], $pageName = 'pages');
					$enterprise2=DB::table('enterprise')
							->join('industry','industry.iid','=','enterprise.industry')
							->where('name','like',"%$name%")
							->orderBy('collection','desc')
							->paginate($perPage = 5, $columns = ['*'], $pageName = 'pages');		
					$enterprise->setPath('enterprise');
					//banner
					$banner=DB::table('banner')
							->get();
					return view('findex/enterprise',['industry'=>$industry,
					'enterprise'=>$enterprise,'enterprise1'=>$enterprise1,
					'enterprise2'=>$enterprise2,'name'=>$name,
					'proindustry'=>$proindustry,'procooperation'=>$procooperation,
					'procoop_money'=>$procoop_money,'banner'=>$banner,'cooperation'=>$cooperation]);
				}
				return redirect('findex/enterprise');
			}
		}
		$name=$request->input('name');
		$selname=$request->session()->put('selname',$name);
		$entesel=$request->input('entesel');
		$proindustry=$request->input('proindustry');
		$procooperation=$request->input('procooperation');
		$procoop_money=$request->input('procoop_money');
		if($entesel){
			if(!$name){
				$requirement=DB::table('requirement')
						->join('industry','industry.iid','=','requirement.industry')
						->orderBy('create_time','desc')
						->paginate($perPage = 4, $columns = ['*'], $pageName = 'cpage');
				$requirement->setPath('requirement');
				$requirement1=DB::table('requirement')
						->join('industry','industry.iid','=','requirement.industry')
						->orderBy('look','desc')
						->paginate($perPage = 4, $columns = ['*'], $pageName = 'cpage');
			
				$requirement2=DB::table('requirement')
						->join('industry','industry.iid','=','requirement.industry')
						->orderBy('collection','desc')
						->paginate($perPage = 4, $columns = ['*'], $pageName = 'cpage');
			}
			if($entesel==1){
				$requirement=DB::table('requirement')
						->join('industry','industry.iid','=','requirement.industry')
						->where('name','like',"%$name%")
						->orderBy('create_time','desc')
						->paginate($perPage = 4, $columns = ['*'], $pageName = 'cpage');
				$requirement->setPath('requirement');
				$requirement1=DB::table('requirement')
						->join('industry','industry.iid','=','requirement.industry')
						->where('name','like',"%$name%")
						->orderBy('look','desc')
						->paginate($perPage = 4, $columns = ['*'], $pageName = 'cpage');
			
				$requirement2=DB::table('requirement')
						->join('industry','industry.iid','=','requirement.industry')
						->where('name','like',"%$name%")
						->orderBy('collection','desc')
						->paginate($perPage = 4, $columns = ['*'], $pageName = 'cpage');
			}
			if($entesel==2){
				$requirement=DB::table('requirement')
						->join('industry','industry.iid','=','requirement.industry')
						->where('fields','like',"%$name%")
						->orderBy('create_time','desc')
						->paginate($perPage = 4, $columns = ['*'], $pageName = 'cpage');
				$requirement->setPath('requirement');
				$requirement1=DB::table('requirement')
						->join('industry','industry.iid','=','requirement.industry')
						->where('fields','like',"%$name%")
						->orderBy('look','desc')
						->paginate($perPage = 4, $columns = ['*'], $pageName = 'cpage');
			
				$requirement2=DB::table('requirement')
						->join('industry','industry.iid','=','requirement.industry')
						->where('fields','like',"%$name%")
						->orderBy('collection','desc')
						->paginate($perPage = 4, $columns = ['*'], $pageName = 'cpage');
			}
			$industry=DB::table('industry')
					->get();
			$cooperation=DB::table('cooperation')->get();		
			$project=Project::select()
						->join('industry','industry.iid','=','project.industry')
				        ->orderBy('create_time','desc')
				        ->get()
				        ->toArray();
					foreach ($project as $key => $value) {
		            $photo=$value['photo'];
		            $photo=explode(',', $photo);
		            foreach($photo as $k => $v){
		                $project[$key]['img'.$k] = $v;

		            }
		        	}
		        	$perPage =4;		
		        	if ($request->has('pagess')) {				
			        	$current_page = $request->input('pagess');				
			        	$current_page = $current_page <= 0 ? 1 :$current_page;		
		        	} 
		        	else {				
		        	$current_page = 1;		
		        	} 		
		        	$item = array_slice($project, ($current_page-1)*$perPage, $perPage); 
		        	//按分页取数据		
		        	$total = count($project);	
		        	$project =new LengthAwarePaginator($item, $total, $perPage,
		        	$current_page, [					
		        			'pageName' => 'pagess']);
			        $project = $project->setPath('/laravel/public/findex/project');
			        //banner
					$banner=DB::table('banner')
							->get();
					$requirements=DB::table('requirement')
						->orderBy('look','desc')
						->paginate($perPage = 4, $columns = ['*'], $pageName = 'apages');
		}
		else{
			if($proindustry||$procooperation||$procoop_money){
				if($proindustry=="不限"){
					$proindustry='';
				}
				if($procooperation=="不限"){
					$procooperation='';
				}
				if($procoop_money=="不限"){
					$procoop_money='';
				}
				if($proindustry=="新一代信息技术及智慧产业"){
					$proindustrys='1';
				}
				if($proindustry=="高端装备与先进制造"){
					$proindustrys='2';
				}
				if($proindustry=="新材料"){
					$proindustrys='3';
				}
				if($proindustry=="科技服务"){
					$proindustrys='4';
				}
				if($proindustry=="其它"){
					$proindustrys='5';
				}
				if($procooperation=="股权投资"){
					$procooperation='1';
				}
				if($procooperation=="技术转让"){
					$procooperation='2';
				}
				if($procooperation=="许可使用"){
					$procooperation='3';
				}
				if($procooperation=="合作开发"){
					$procooperation='4';
				}
				if($procooperation=="合作兴办企业"){
					$procooperation='5';
				}
				if($procooperation=="其它"){
					$procooperation='6';
				}
				$where="1=1";
				if (!empty($proindustry)) {
					$where.=" and industry=".$proindustrys;
				}
				if (!empty($procooperation)) {
					$where.=" and cooperation='".$procooperation."'";
				}
				if (!empty($procoop_money)) {
					if($procoop_money=='一万以下'){
						$procoop_money=10000;
						$where.=" and money < ".$procoop_money;
					}
					if($procoop_money=='一万到三万'){
						$procoop_money=10000;
						$procoop_moneys=30000;
						$where.=" and money > ".$procoop_money." and money <".
						$procoop_moneys;
					}
					if($procoop_money=='三万以上'){
						$procoop_money=30000;
						$where.=" and money >".$procoop_money;
					}
				}
				$industry=DB::table('industry')
					->get();
				$cooperation=DB::table('cooperation')->get();
				$requirement=DB::table('requirement')
						->join('industry','industry.iid','=','requirement.industry')
						->whereRaw($where)	
						->orderBy('create_time','desc')
						->paginate($perPage = 4, $columns = ['*'], $pageName = 'bpage');
				$requirement->setPath('requirement');
				$requirement1=DB::table('requirement')
						->join('industry','industry.iid','=','requirement.industry')
						->whereRaw($where)	
						->orderBy('look','desc')
						->paginate($perPage = 4, $columns = ['*'], $pageName = 'bpage');
				$requirement2=DB::table('requirement')
						->join('industry','industry.iid','=','requirement.industry')
						->whereRaw($where)	
						->orderBy('collection','desc')
						->paginate($perPage = 4, $columns = ['*'], $pageName = 'bpage');
				$project=Project::select()
						->join('industry','industry.iid','=','project.industry')
				        ->orderBy('create_time','desc')
				        ->get()
				        ->toArray();
					foreach ($project as $key => $value) {
		            $photo=$value['photo'];
		            $photo=explode(',', $photo);
		            foreach($photo as $k => $v){
		                $project[$key]['img'.$k] = $v;

		            }
		        	}
		        	$perPage = 4;		
		        	if ($request->has('pagess')) {				
			        	$current_page = $request->input('pagess');				
			        	$current_page = $current_page <= 0 ? 1 :$current_page;		
		        	} 
		        	else {				
		        	$current_page = 1;		
		        	} 		
		        	$item = array_slice($project, ($current_page-1)*$perPage, $perPage); 
		        	//按分页取数据		
		        	$total = count($project);	
		        	$project =new LengthAwarePaginator($item, $total, $perPage,
		        	$current_page, [					
		        			'pageName' => 'pagess']);
			        $project = $project->setPath('/laravel/public/findex/project');
			        //banner
					$banner=DB::table('banner')
							->get();
					$requirements=DB::table('requirement')
						->orderBy('look','desc')
						->paginate($perPage = 4, $columns = ['*'], $pageName = 'apages');
			        return view('findex/requirement',['industry'=>$industry,
					'requirement'=>$requirement,
					'project'=>$project,'requirement1'=>$requirement1,
					'requirement2'=>$requirement2,'name'=>$name,
					'proindustry'=>$proindustry,
						'procooperation'=>$procooperation,
						'procoop_money'=>$procoop_money,'banner'=>$banner,'requirements'=>$requirements,
					'cooperation'=>$cooperation	]);

			}
			else{
				$industry=DB::table('industry')
					->get();
				$cooperation=DB::table('cooperation')->get();
				$requirement=DB::table('requirement')
						->join('industry','industry.iid','=','requirement.industry')
						->orderBy('create_time','desc')
						->paginate($perPage = 4, $columns = ['*'], $pageName = 'pages');
				$requirements=DB::table('requirement')
						->orderBy('look','desc')
						->paginate($perPage = 4, $columns = ['*'], $pageName = 'apages');
				$requirement->setPath('requirement');
				$requirement1=DB::table('requirement')
						->join('industry','industry.iid','=','requirement.industry')
						->orderBy('look','desc')
						->paginate($perPage = 4, $columns = ['*'], $pageName = 'pages');
			
				$requirement2=DB::table('requirement')
						->join('industry','industry.iid','=','requirement.industry')
						->orderBy('collection','desc')
						->paginate($perPage = 4, $columns = ['*'], $pageName = 'pages');
				$project=Project::select()
						->join('industry','industry.iid','=','project.industry')
				        ->orderBy('create_time','desc')
				        ->get()
				        ->toArray();
					foreach ($project as $key => $value) {
		            $photo=$value['photo'];
		            $photo=explode(',', $photo);
		            foreach($photo as $k => $v){
		                $project[$key]['img'.$k] = $v;

		            }
		        	}
		        	$perPage = 4;		
		        	if ($request->has('pagess')) {				
			        	$current_page = $request->input('pagess');				
			        	$current_page = $current_page <= 0 ? 1 :$current_page;		
		        	} 
		        	else {				
		        	$current_page = 1;		
		        	} 		
		        	$item = array_slice($project, ($current_page-1)*$perPage, $perPage); 
		        	//按分页取数据		
		        	$total = count($project);	
		        	$project =new LengthAwarePaginator($item, $total, $perPage,
		        	$current_page, [					
		        			'pageName' => 'pagess']);
			        $project = $project->setPath('/laravel/public/findex/project');
			        //banner
					$banner=DB::table('banner')
							->get();
			}
			
			
		}
		
		return view('findex/requirement',['industry'=>$industry,
		'requirement'=>$requirement,
		'project'=>$project,'requirement1'=>$requirement1,
		'requirement2'=>$requirement2,'name'=>$name,
		'proindustry'=>$proindustry,'procooperation'=>$procooperation,
		'procoop_money'=>$procoop_money,'banner'=>$banner,
		'requirements'=>$requirements,'cooperation'=>$cooperation]);
	}

	//专利大数据
	public function patent(){
		return view('findex/patent');
	}

	//投融资服务
	public function investment(Request $request){
		$sel=$request->input('sel');
		if($sel){
			if($sel==1){
				$aname=$request->input('aname');
				$proindustry=$request->input('proindustry');
				$procooperation=$request->input('procooperation');
				$promature=$request->input('promature');
				$procoop_money=$request->input('procoop_money');
				if($aname){
					$project=Project::select()
					        ->where('name','like',"%$aname%")
					        ->orderBy('create_time','desc')
					        ->get()
					        ->toArray();
					foreach ($project as $key => $value) {
		            $photo=$value['photo'];
		            $photo=explode(',', $photo);
		            foreach($photo as $k => $v){
		                $project[$key]['img'.$k] = $v;

		            }
		        	}
		        	$perPage = 5;		
		        	if ($request->has('apage')) {				
			        	$current_page = $request->input('apage');				
			        	$current_page = $current_page <= 0 ? 1 :$current_page;		
		        	} 
		        	else {				
		        	$current_page = 1;		
		        	} 		
		        	$item = array_slice($project, ($current_page-1)*$perPage, $perPage); 
		        	//按分页取数据		
		        	$total = count($project);	
		        	$project =new LengthAwarePaginator($item, $total, $perPage,
		        	$current_page, [					
		        			'pageName' => 'apage']);
			        $project = $project->setPath('findex/project');
					//人气
					$project1=Project::select()
					        ->where('name','like',"%$aname%")
					        ->orderBy('look','desc')
					        ->get()
					        ->toArray();
					foreach ($project1 as $key => $value) {
		            $photo=$value['photo'];
		            $photo=explode(',', $photo);
		            foreach($photo as $k => $v){
		                $project1[$key]['img'.$k] = $v;

		            }
		        	}
		        	$perPage = 5;		
		        	if ($request->has('apage')) {				
			        	$current_page = $request->input('apage');				
			        	$current_page = $current_page <= 0 ? 1 :$current_page;		
		        	} 
		        	else {				
		        	$current_page = 1;		
		        	} 		
		        	$item = array_slice($project1, ($current_page-1)*$perPage, $perPage); 
		        	//按分页取数据		
		        	$total = count($project1);	
		        	$project1 =new LengthAwarePaginator($item, $total, $perPage,
		        	$current_page, [					
		        			'pageName' => 'apage']);
			        $project1 = $project1->setPath('findex/project');
					//收藏
					$project2=Project::select()
					        ->where('name','like',"%$aname%")
					        ->orderBy('collection','desc')
					        ->get()
					        ->toArray();
					foreach ($project2 as $key => $value) {
		            $photo=$value['photo'];
		            $photo=explode(',', $photo);
		            foreach($photo as $k => $v){
		                $project2[$key]['img'.$k] = $v;

		            }
		        	}
		        	$perPage = 5;		
		        	if ($request->has('apage')) {				
			        	$current_page = $request->input('apage');				
			        	$current_page = $current_page <= 0 ? 1 :$current_page;		
		        	} 
		        	else {				
		        	$current_page = 1;		
		        	} 		
		        	$item = array_slice($project2, ($current_page-1)*$perPage, $perPage); 
		        	//按分页取数据		
		        	$total = count($project2);	
		        	$project2 =new LengthAwarePaginator($item, $total, $perPage,
		        	$current_page, [					
		        			'pageName' => 'apage']);
			        $project2 = $project2->setPath('findex/project');

					$industry=DB::table('industry')
							->get();
					$cooperation=DB::table('cooperation')->get();
					$mature=DB::table('mature')->get();
					$requirement=DB::table('requirement')
							->orderBy('create_time','desc')
							->paginate(9);
					//banner
					$banner=DB::table('banner')
							->get();
					return view('findex/project',['project'=>$project,'project1'=>$project1,
						'project2'=>$project2,'industry'=>$industry,'banner'=>$banner,
						'requirement'=>$requirement,'proindustry'=>$proindustry,
						'procooperation'=>$procooperation,'promature'=>$promature,
						'procoop_money'=>$procoop_money,'name'=>$aname,'cooperation'=>$cooperation,
						'mature'=>$mature]);
				}
				return redirect('findex/project');
			}
			elseif ($sel==2) {
				$aname=$request->input('aname');
				$proindustry=$request->input('proindustry');
				$procooperation=$request->input('procooperation');
				$procoop_money=$request->input('procoop_money');
				if($aname){
					$industry=DB::table('industry')
							->get();
					$cooperation=DB::table('cooperation')->get();
					$requirement=DB::table('requirement')
							->join('industry','industry.iid','=','requirement.industry')
							->where('name','like',"%$aname%")
							->orderBy('create_time','desc')
							->paginate($perPage = 4, $columns = ['*'], $pageName = 'cpage');
					$requirement->setPath('requirement');
					$requirement1=DB::table('requirement')
							->join('industry','industry.iid','=','requirement.industry')
							->where('name','like',"%$aname%")
							->orderBy('look','desc')
							->paginate($perPage = 4, $columns = ['*'], $pageName = 'cpage');
				
					$requirement2=DB::table('requirement')
							->join('industry','industry.iid','=','requirement.industry')
							->where('name','like',"%$aname%")
							->orderBy('collection','desc')
							->paginate($perPage = 4, $columns = ['*'], $pageName = 'cpage');
					$project=Project::select()
								->join('industry','industry.iid','=','project.industry')
						        ->orderBy('create_time','desc')
						        ->get()
						        ->toArray();
							foreach ($project as $key => $value) {
				            $photo=$value['photo'];
				            $photo=explode(',', $photo);
				            foreach($photo as $k => $v){
				                $project[$key]['img'.$k] = $v;

				            }
				        	}
				        	$perPage =4;		
				        	if ($request->has('pagess')) {				
					        	$current_page = $request->input('pagess');				
					        	$current_page = $current_page <= 0 ? 1 :$current_page;		
				        	} 
				        	else {				
				        	$current_page = 1;		
				        	} 		
				        	$item = array_slice($project, ($current_page-1)*$perPage, $perPage); 
				        	//按分页取数据		
				        	$total = count($project);	
				        	$project =new LengthAwarePaginator($item, $total, $perPage,
				        	$current_page, [					
				        			'pageName' => 'pagess']);
					        $project = $project->setPath('/laravel/public/findex/project');
					        //banner
							$banner=DB::table('banner')
									->get();
							$requirements=DB::table('requirement')
								->orderBy('look','desc')
								->paginate($perPage = 4, $columns = ['*'], $pageName = 'apages');
							return view('findex/requirement',['industry'=>$industry,
							'requirement'=>$requirement,'project'=>$project,
							'requirement1'=>$requirement1,'requirement2'=>$requirement2,
							'name'=>$aname,'proindustry'=>$proindustry,
							'procooperation'=>$procooperation,'procoop_money'=>$procoop_money,
							'banner'=>$banner,'requirements'=>$requirements,
							'cooperation'=>$cooperation]);
				}
				return redirect('findex/requirement');
			}
			elseif ($sel==3) {
				$name=$request->input('aname');
				$proindustry=$request->input('proindustry');
				$procooperation=$request->input('procooperation');
				$procoop_money=$request->input('procoop_money');
				if($name){
					$industry=DB::table('industry')
							->get();
					$cooperation=DB::table('cooperation')->get();
					$enterprise=DB::table('enterprise')
							->join('industry','industry.iid','=','enterprise.industry')
							->where('name','like',"%$name%")
							->orderBy('create_time','desc')
							->paginate($perPage = 5, $columns = ['*'], $pageName = 'pages');
					$enterprise1=DB::table('enterprise')
							->join('industry','industry.iid','=','enterprise.industry')
							->where('name','like',"%$name%")
							->orderBy('look','desc')
							->paginate($perPage = 5, $columns = ['*'], $pageName = 'pages');
					$enterprise2=DB::table('enterprise')
							->join('industry','industry.iid','=','enterprise.industry')
							->where('name','like',"%$name%")
							->orderBy('collection','desc')
							->paginate($perPage = 5, $columns = ['*'], $pageName = 'pages');		
					$enterprise->setPath('enterprise');
					//banner
					$banner=DB::table('banner')
							->get();
					return view('findex/enterprise',['industry'=>$industry,
					'enterprise'=>$enterprise,'enterprise1'=>$enterprise1,
					'enterprise2'=>$enterprise2,'name'=>$name,
					'proindustry'=>$proindustry,'procooperation'=>$procooperation,
					'procoop_money'=>$procoop_money,'banner'=>$banner,'cooperation'=>$cooperation]);
				}
				return redirect('findex/enterprise');
			}
		}
		$investment=DB::table('investments')
				->paginate(10);
		//banner
		$banner=DB::table('banner')
				->get();
		return view('findex/investment',['investment'=>$investment,'banner'=>$banner]);
	}

	//企业名录
	public function enterprise(Request $request){
		$sel=$request->input('sel');
		if($sel){
			if($sel==1){
				$aname=$request->input('aname');
				$proindustry=$request->input('proindustry');
				$procooperation=$request->input('procooperation');
				$promature=$request->input('promature');
				$procoop_money=$request->input('procoop_money');
				if($aname){
					$project=Project::select()
					        ->where('name','like',"%$aname%")
					        ->orderBy('create_time','desc')
					        ->get()
					        ->toArray();
					foreach ($project as $key => $value) {
		            $photo=$value['photo'];
		            $photo=explode(',', $photo);
		            foreach($photo as $k => $v){
		                $project[$key]['img'.$k] = $v;

		            }
		        	}
		        	$perPage = 5;		
		        	if ($request->has('apage')) {				
			        	$current_page = $request->input('apage');				
			        	$current_page = $current_page <= 0 ? 1 :$current_page;		
		        	} 
		        	else {				
		        	$current_page = 1;		
		        	} 		
		        	$item = array_slice($project, ($current_page-1)*$perPage, $perPage); 
		        	//按分页取数据		
		        	$total = count($project);	
		        	$project =new LengthAwarePaginator($item, $total, $perPage,
		        	$current_page, [					
		        			'pageName' => 'apage']);
			        $project = $project->setPath('findex/project');
					//人气
					$project1=Project::select()
					        ->where('name','like',"%$aname%")
					        ->orderBy('look','desc')
					        ->get()
					        ->toArray();
					foreach ($project1 as $key => $value) {
		            $photo=$value['photo'];
		            $photo=explode(',', $photo);
		            foreach($photo as $k => $v){
		                $project1[$key]['img'.$k] = $v;

		            }
		        	}
		        	$perPage = 5;		
		        	if ($request->has('apage')) {				
			        	$current_page = $request->input('apage');				
			        	$current_page = $current_page <= 0 ? 1 :$current_page;		
		        	} 
		        	else {				
		        	$current_page = 1;		
		        	} 		
		        	$item = array_slice($project1, ($current_page-1)*$perPage, $perPage); 
		        	//按分页取数据		
		        	$total = count($project1);	
		        	$project1 =new LengthAwarePaginator($item, $total, $perPage,
		        	$current_page, [					
		        			'pageName' => 'apage']);
			        $project1 = $project1->setPath('findex/project');
					//收藏
					$project2=Project::select()
					        ->where('name','like',"%$aname%")
					        ->orderBy('collection','desc')
					        ->get()
					        ->toArray();
					foreach ($project2 as $key => $value) {
		            $photo=$value['photo'];
		            $photo=explode(',', $photo);
		            foreach($photo as $k => $v){
		                $project2[$key]['img'.$k] = $v;

		            }
		        	}
		        	$perPage = 5;		
		        	if ($request->has('apage')) {				
			        	$current_page = $request->input('apage');				
			        	$current_page = $current_page <= 0 ? 1 :$current_page;		
		        	} 
		        	else {				
		        	$current_page = 1;		
		        	} 		
		        	$item = array_slice($project2, ($current_page-1)*$perPage, $perPage); 
		        	//按分页取数据		
		        	$total = count($project2);	
		        	$project2 =new LengthAwarePaginator($item, $total, $perPage,
		        	$current_page, [					
		        			'pageName' => 'apage']);
			        $project2 = $project2->setPath('findex/project');

					$industry=DB::table('industry')
							->get();
					$cooperation=DB::table('cooperation')->get();
					$mature=DB::table('mature')->get();
					$requirement=DB::table('requirement')
							->orderBy('create_time','desc')
							->paginate(9);
					//banner
					$banner=DB::table('banner')
							->get();
					return view('findex/project',['project'=>$project,'project1'=>$project1,
						'project2'=>$project2,'industry'=>$industry,'banner'=>$banner,
						'requirement'=>$requirement,'proindustry'=>$proindustry,
						'procooperation'=>$procooperation,'promature'=>$promature,
						'procoop_money'=>$procoop_money,'name'=>$aname,'cooperation'=>$cooperation,
						'mature'=>$mature]);
				}
				return redirect('findex/project');
			}
			elseif ($sel==2) {
				$aname=$request->input('aname');
				$proindustry=$request->input('proindustry');
				$procooperation=$request->input('procooperation');
				$procoop_money=$request->input('procoop_money');
				if($aname){
					$industry=DB::table('industry')
							->get();
					$cooperation=DB::table('cooperation')->get();
					$requirement=DB::table('requirement')
							->join('industry','industry.iid','=','requirement.industry')
							->where('name','like',"%$aname%")
							->orderBy('create_time','desc')
							->paginate($perPage = 4, $columns = ['*'], $pageName = 'cpage');
					$requirement->setPath('requirement');
					$requirement1=DB::table('requirement')
							->join('industry','industry.iid','=','requirement.industry')
							->where('name','like',"%$aname%")
							->orderBy('look','desc')
							->paginate($perPage = 4, $columns = ['*'], $pageName = 'cpage');
				
					$requirement2=DB::table('requirement')
							->join('industry','industry.iid','=','requirement.industry')
							->where('name','like',"%$aname%")
							->orderBy('collection','desc')
							->paginate($perPage = 4, $columns = ['*'], $pageName = 'cpage');
					$project=Project::select()
								->join('industry','industry.iid','=','project.industry')
						        ->orderBy('create_time','desc')
						        ->get()
						        ->toArray();
							foreach ($project as $key => $value) {
				            $photo=$value['photo'];
				            $photo=explode(',', $photo);
				            foreach($photo as $k => $v){
				                $project[$key]['img'.$k] = $v;

				            }
				        	}
				        	$perPage =4;		
				        	if ($request->has('pagess')) {				
					        	$current_page = $request->input('pagess');				
					        	$current_page = $current_page <= 0 ? 1 :$current_page;		
				        	} 
				        	else {				
				        	$current_page = 1;		
				        	} 		
				        	$item = array_slice($project, ($current_page-1)*$perPage, $perPage); 
				        	//按分页取数据		
				        	$total = count($project);	
				        	$project =new LengthAwarePaginator($item, $total, $perPage,
				        	$current_page, [					
				        			'pageName' => 'pagess']);
					        $project = $project->setPath('/laravel/public/findex/project');
					        //banner
							$banner=DB::table('banner')
									->get();
							$requirements=DB::table('requirement')
								->orderBy('look','desc')
								->paginate($perPage = 4, $columns = ['*'], $pageName = 'apages');
							return view('findex/requirement',['industry'=>$industry,
							'requirement'=>$requirement,'project'=>$project,
							'requirement1'=>$requirement1,'requirement2'=>$requirement2,
							'name'=>$aname,'proindustry'=>$proindustry,
							'procooperation'=>$procooperation,'procoop_money'=>$procoop_money,
							'banner'=>$banner,'requirements'=>$requirements,
							'cooperation'=>$cooperation]);
				}
				return redirect('findex/requirement');
			}
			elseif ($sel==3) {
				$name=$request->input('aname');
				$proindustry=$request->input('proindustry');
				$procooperation=$request->input('procooperation');
				$procoop_money=$request->input('procoop_money');
				if($name){
					$industry=DB::table('industry')
							->get();
					$cooperation=DB::table('cooperation')->get();
					$enterprise=DB::table('enterprise')
							->join('industry','industry.iid','=','enterprise.industry')
							->where('name','like',"%$name%")
							->orderBy('create_time','desc')
							->paginate($perPage = 5, $columns = ['*'], $pageName = 'pages');
					$enterprise1=DB::table('enterprise')
							->join('industry','industry.iid','=','enterprise.industry')
							->where('name','like',"%$name%")
							->orderBy('look','desc')
							->paginate($perPage = 5, $columns = ['*'], $pageName = 'pages');
					$enterprise2=DB::table('enterprise')
							->join('industry','industry.iid','=','enterprise.industry')
							->where('name','like',"%$name%")
							->orderBy('collection','desc')
							->paginate($perPage = 5, $columns = ['*'], $pageName = 'pages');		
					$enterprise->setPath('enterprise');
					//banner
					$banner=DB::table('banner')
							->get();
					return view('findex/enterprise',['industry'=>$industry,
					'enterprise'=>$enterprise,'enterprise1'=>$enterprise1,
					'enterprise2'=>$enterprise2,'name'=>$name,
					'proindustry'=>$proindustry,'procooperation'=>$procooperation,
					'procoop_money'=>$procoop_money,'banner'=>$banner,'cooperation'=>$cooperation]);
				}
				return redirect('findex/enterprise');
			}
		}
		$name=$request->input('name');
		$selname=$request->session()->put('selname',$name);
		$entesel=$request->input('entesel');
		$proindustry=$request->input('proindustry');
		$procooperation=$request->input('procooperation');
		$procoop_money=$request->input('procoop_money');
		if($entesel){
			if(!$name){
				$enterprise=DB::table('enterprise')
						->join('industry','industry.iid','=','enterprise.industry')
						->orderBy('create_time','desc')
						->paginate($perPage = 5, $columns = ['*'], $pageName = 'pagess');
				$enterprise1=DB::table('enterprise')
						->join('industry','industry.iid','=','enterprise.industry')
						->orderBy('look','desc')
						->paginate($perPage = 5, $columns = ['*'], $pageName = 'pagess');
				$enterprise2=DB::table('enterprise')
						->join('industry','industry.iid','=','enterprise.industry')
						->orderBy('collection','desc')
						->paginate($perPage = 5, $columns = ['*'], $pageName = 'pagess');
				$enterprise->setPath('enterprise');
			}
			if($entesel==1){
				$enterprise=DB::table('enterprise')
						->join('industry','industry.iid','=','enterprise.industry')
						->where('name','like',"%$name%")
						->orderBy('create_time','desc')
						->paginate($perPage = 5, $columns = ['*'], $pageName = 'pages');
				$enterprise1=DB::table('enterprise')
						->join('industry','industry.iid','=','enterprise.industry')
						->where('name','like',"%$name%")
						->orderBy('look','desc')
						->paginate($perPage = 5, $columns = ['*'], $pageName = 'pages');
				$enterprise2=DB::table('enterprise')
						->join('industry','industry.iid','=','enterprise.industry')
						->where('name','like',"%$name%")
						->orderBy('collection','desc')
						->paginate($perPage = 5, $columns = ['*'], $pageName = 'pages');		
				$enterprise->setPath('enterprise');
			}
			if($entesel==2){
				$enterprise=DB::table('enterprise')
						->join('industry','industry.iid','=','enterprise.industry')
						->where('field','like',"%$name%")
						->orderBy('create_time','desc')
						->paginate($perPage = 5, $columns = ['*'], $pageName = 'pages');
				$enterprise1=DB::table('enterprise')
						->join('industry','industry.iid','=','enterprise.industry')
						->where('field','like',"%$name%")
						->orderBy('look','desc')
						->paginate($perPage = 5, $columns = ['*'], $pageName = 'pages');
				$enterprise2=DB::table('enterprise')
						->join('industry','industry.iid','=','enterprise.industry')
						->where('field','like',"%$name%")
						->orderBy('collection','desc')
						->paginate($perPage = 5, $columns = ['*'], $pageName = 'pages');		
				$enterprise->setPath('enterprise');
			}
			
			//banner
			$banner=DB::table('banner')
					->get();
			$industry=DB::table('industry')
					->get();
			$cooperation=DB::table('cooperation')->get();
		}
		else{
			if($proindustry||$procooperation||$procoop_money){
				if($proindustry=="不限"){
					$proindustry='';
				}
				if($procooperation=="不限"){
					$procooperation='';
				}
				if($procoop_money=="不限"){
					$procoop_money='';
				}
				if($proindustry=="新一代信息技术及智慧产业"){
					$proindustrys='1';
				}
				if($proindustry=="高端装备与先进制造"){
					$proindustrys='2';
				}
				if($proindustry=="新材料"){
					$proindustrys='3';
				}
				if($proindustry=="科技服务"){
					$proindustrys='4';
				}
				if($proindustry=="其它"){
					$proindustrys='5';
				}
				
				$where="1=1";
				if (!empty($proindustry)) {
					$where.=" and industry=".$proindustrys;
				}
				if (!empty($procooperation)) {
					$where.=" and area='".$procooperation."'";
				}
				$industry=DB::table('industry')
						->get();
				$cooperation=DB::table('cooperation')->get();
				$enterprise=DB::table('enterprise')
						->join('industry','industry.iid','=','enterprise.industry')
						->whereRaw($where)	
						->orderBy('create_time','desc')
						->paginate($perPage = 5, $columns = ['*'], $pageName = 'apage');
				$enterprise1=DB::table('enterprise')
						->join('industry','industry.iid','=','enterprise.industry')
						->whereRaw($where)	
						->orderBy('look','desc')
						->paginate($perPage = 5, $columns = ['*'], $pageName = 'apage');
				$enterprise2=DB::table('enterprise')
						->join('industry','industry.iid','=','enterprise.industry')
						->whereRaw($where)	
						->orderBy('collection','desc')
						->paginate($perPage = 5, $columns = ['*'], $pageName = 'apage');		
				$enterprise->setPath('enterprise');
				//banner
				$banner=DB::table('banner')
						->get();
				return view('findex/enterprise',['industry'=>$industry,
				'enterprise'=>$enterprise,'enterprise1'=>$enterprise1,
				'enterprise2'=>$enterprise2,'name'=>$name,
				'proindustry'=>$proindustry,'procooperation'=>$procooperation,
				'procoop_money'=>$procoop_money,'banner'=>$banner,'cooperation'=>$cooperation]);
			}
			else{
				$industry=DB::table('industry')
						->get();
				$cooperation=DB::table('cooperation')->get();
				$enterprise=DB::table('enterprise')
						->join('industry','industry.iid','=','enterprise.industry')
						->orderBy('create_time','desc')
						->paginate($perPage = 5, $columns = ['*'], $pageName = 'pagess');
				$enterprise1=DB::table('enterprise')
						->join('industry','industry.iid','=','enterprise.industry')
						->orderBy('look','desc')
						->paginate($perPage = 5, $columns = ['*'], $pageName = 'pagess');
				$enterprise2=DB::table('enterprise')
						->join('industry','industry.iid','=','enterprise.industry')
						->orderBy('collection','desc')
						->paginate($perPage = 5, $columns = ['*'], $pageName = 'pagess');
				$enterprise->setPath('enterprise');
				//banner
				$banner=DB::table('banner')
						->get();
			}
			
		}
		
		return view('findex/enterprise',['industry'=>$industry,
			'enterprise'=>$enterprise,'enterprise1'=>$enterprise1,
			'enterprise2'=>$enterprise2,'name'=>$name,
			'proindustry'=>$proindustry,'procooperation'=>$procooperation,
			'procoop_money'=>$procoop_money,'banner'=>$banner,'cooperation'=>$cooperation]);
	}

	//资料下载
	public function download(Request $request){
		$sel=$request->input('sel');
		if($sel){
			if($sel==1){
				$aname=$request->input('aname');
				$proindustry=$request->input('proindustry');
				$procooperation=$request->input('procooperation');
				$promature=$request->input('promature');
				$procoop_money=$request->input('procoop_money');
				if($aname){
					$project=Project::select()
					        ->where('name','like',"%$aname%")
					        ->orderBy('create_time','desc')
					        ->get()
					        ->toArray();
					foreach ($project as $key => $value) {
		            $photo=$value['photo'];
		            $photo=explode(',', $photo);
		            foreach($photo as $k => $v){
		                $project[$key]['img'.$k] = $v;

		            }
		        	}
		        	$perPage = 5;		
		        	if ($request->has('apage')) {				
			        	$current_page = $request->input('apage');				
			        	$current_page = $current_page <= 0 ? 1 :$current_page;		
		        	} 
		        	else {				
		        	$current_page = 1;		
		        	} 		
		        	$item = array_slice($project, ($current_page-1)*$perPage, $perPage); 
		        	//按分页取数据		
		        	$total = count($project);	
		        	$project =new LengthAwarePaginator($item, $total, $perPage,
		        	$current_page, [					
		        			'pageName' => 'apage']);
			        $project = $project->setPath('findex/project');
					//人气
					$project1=Project::select()
					        ->where('name','like',"%$aname%")
					        ->orderBy('look','desc')
					        ->get()
					        ->toArray();
					foreach ($project1 as $key => $value) {
		            $photo=$value['photo'];
		            $photo=explode(',', $photo);
		            foreach($photo as $k => $v){
		                $project1[$key]['img'.$k] = $v;

		            }
		        	}
		        	$perPage = 5;		
		        	if ($request->has('apage')) {				
			        	$current_page = $request->input('apage');				
			        	$current_page = $current_page <= 0 ? 1 :$current_page;		
		        	} 
		        	else {				
		        	$current_page = 1;		
		        	} 		
		        	$item = array_slice($project1, ($current_page-1)*$perPage, $perPage); 
		        	//按分页取数据		
		        	$total = count($project1);	
		        	$project1 =new LengthAwarePaginator($item, $total, $perPage,
		        	$current_page, [					
		        			'pageName' => 'apage']);
			        $project1 = $project1->setPath('findex/project');
					//收藏
					$project2=Project::select()
					        ->where('name','like',"%$aname%")
					        ->orderBy('collection','desc')
					        ->get()
					        ->toArray();
					foreach ($project2 as $key => $value) {
		            $photo=$value['photo'];
		            $photo=explode(',', $photo);
		            foreach($photo as $k => $v){
		                $project2[$key]['img'.$k] = $v;

		            }
		        	}
		        	$perPage = 5;		
		        	if ($request->has('apage')) {				
			        	$current_page = $request->input('apage');				
			        	$current_page = $current_page <= 0 ? 1 :$current_page;		
		        	} 
		        	else {				
		        	$current_page = 1;		
		        	} 		
		        	$item = array_slice($project2, ($current_page-1)*$perPage, $perPage); 
		        	//按分页取数据		
		        	$total = count($project2);	
		        	$project2 =new LengthAwarePaginator($item, $total, $perPage,
		        	$current_page, [					
		        			'pageName' => 'apage']);
			        $project2 = $project2->setPath('findex/project');

					$industry=DB::table('industry')
							->get();
					$cooperation=DB::table('cooperation')->get();
					$mature=DB::table('mature')->get();
					$requirement=DB::table('requirement')
							->orderBy('create_time','desc')
							->paginate(9);
					//banner
					$banner=DB::table('banner')
							->get();
					return view('findex/project',['project'=>$project,'project1'=>$project1,
						'project2'=>$project2,'industry'=>$industry,'banner'=>$banner,
						'requirement'=>$requirement,'proindustry'=>$proindustry,
						'procooperation'=>$procooperation,'promature'=>$promature,
						'procoop_money'=>$procoop_money,'name'=>$aname,'cooperation'=>$cooperation,
						'mature'=>$mature]);
				}
				return redirect('findex/project');
			}
			elseif ($sel==2) {
				$aname=$request->input('aname');
				$proindustry=$request->input('proindustry');
				$procooperation=$request->input('procooperation');
				$procoop_money=$request->input('procoop_money');
				if($aname){
					$industry=DB::table('industry')
							->get();
					$cooperation=DB::table('cooperation')->get();
					$requirement=DB::table('requirement')
							->join('industry','industry.iid','=','requirement.industry')
							->where('name','like',"%$aname%")
							->orderBy('create_time','desc')
							->paginate($perPage = 4, $columns = ['*'], $pageName = 'cpage');
					$requirement->setPath('requirement');
					$requirement1=DB::table('requirement')
							->join('industry','industry.iid','=','requirement.industry')
							->where('name','like',"%$aname%")
							->orderBy('look','desc')
							->paginate($perPage = 4, $columns = ['*'], $pageName = 'cpage');
				
					$requirement2=DB::table('requirement')
							->join('industry','industry.iid','=','requirement.industry')
							->where('name','like',"%$aname%")
							->orderBy('collection','desc')
							->paginate($perPage = 4, $columns = ['*'], $pageName = 'cpage');
					$project=Project::select()
								->join('industry','industry.iid','=','project.industry')
						        ->orderBy('create_time','desc')
						        ->get()
						        ->toArray();
							foreach ($project as $key => $value) {
				            $photo=$value['photo'];
				            $photo=explode(',', $photo);
				            foreach($photo as $k => $v){
				                $project[$key]['img'.$k] = $v;

				            }
				        	}
				        	$perPage =4;		
				        	if ($request->has('pagess')) {				
					        	$current_page = $request->input('pagess');				
					        	$current_page = $current_page <= 0 ? 1 :$current_page;		
				        	} 
				        	else {				
				        	$current_page = 1;		
				        	} 		
				        	$item = array_slice($project, ($current_page-1)*$perPage, $perPage); 
				        	//按分页取数据		
				        	$total = count($project);	
				        	$project =new LengthAwarePaginator($item, $total, $perPage,
				        	$current_page, [					
				        			'pageName' => 'pagess']);
					        $project = $project->setPath('/laravel/public/findex/project');
					        //banner
							$banner=DB::table('banner')
									->get();
							$requirements=DB::table('requirement')
								->orderBy('look','desc')
								->paginate($perPage = 4, $columns = ['*'], $pageName = 'apages');
							return view('findex/requirement',['industry'=>$industry,
							'requirement'=>$requirement,'project'=>$project,
							'requirement1'=>$requirement1,'requirement2'=>$requirement2,
							'name'=>$aname,'proindustry'=>$proindustry,
							'procooperation'=>$procooperation,'procoop_money'=>$procoop_money,
							'banner'=>$banner,'requirements'=>$requirements,
							'cooperation'=>$cooperation]);
				}
				return redirect('findex/requirement');
			}
			elseif ($sel==3) {
				$name=$request->input('aname');
				$proindustry=$request->input('proindustry');
				$procooperation=$request->input('procooperation');
				$procoop_money=$request->input('procoop_money');
				if($name){
					$industry=DB::table('industry')
							->get();
					$cooperation=DB::table('cooperation')->get();
					$enterprise=DB::table('enterprise')
							->join('industry','industry.iid','=','enterprise.industry')
							->where('name','like',"%$name%")
							->orderBy('create_time','desc')
							->paginate($perPage = 5, $columns = ['*'], $pageName = 'pages');
					$enterprise1=DB::table('enterprise')
							->join('industry','industry.iid','=','enterprise.industry')
							->where('name','like',"%$name%")
							->orderBy('look','desc')
							->paginate($perPage = 5, $columns = ['*'], $pageName = 'pages');
					$enterprise2=DB::table('enterprise')
							->join('industry','industry.iid','=','enterprise.industry')
							->where('name','like',"%$name%")
							->orderBy('collection','desc')
							->paginate($perPage = 5, $columns = ['*'], $pageName = 'pages');		
					$enterprise->setPath('enterprise');
					//banner
					$banner=DB::table('banner')
							->get();
					return view('findex/enterprise',['industry'=>$industry,
					'enterprise'=>$enterprise,'enterprise1'=>$enterprise1,
					'enterprise2'=>$enterprise2,'name'=>$name,
					'proindustry'=>$proindustry,'procooperation'=>$procooperation,
					'procoop_money'=>$procoop_money,'banner'=>$banner,'cooperation'=>$cooperation]);
				}
				return redirect('findex/enterprise');
			}
		}
		$title=$request->input('title');
		if($title){
			$download=DB::table('download')
				->where('pid',1)
				->where('title','like',"%$title%")
				->orderBy('create_time','desc')
				->paginate(12);
			$download->setPath('download');
			$download2=DB::table('download')
					->where('pid',2)
					->where('title','like',"%$title%")
					->orderBy('create_time','desc')
					->paginate(12);
			$download3=DB::table('download')
					->where('pid',3)
					->where('title','like',"%$title%")
					->orderBy('create_time','desc')
					->paginate(12);
			$download3->setPath('download');
			$download4=DB::table('download')
					->where('pid',4)
					->where('title','like',"%$title%")
					->orderBy('create_time','desc')
					->paginate(12);
			$download5=DB::table('download')
					->where('pid',6)
					->where('title','like',"%$title%")
					->orderBy('create_time','desc')
					->paginate(12);
			$download6=DB::table('download')
					->where('pid',7)
					->where('title','like',"%$title%")
					->orderBy('create_time','desc')
					->paginate(12);
			$types=DB::table('downtype')
				->orderBy('pid','asc')
				->get();
			//banner
			$banner=DB::table('banner')
					->get();
		}
		else{
			$download=DB::table('download')
				->where('pid',1)
				->orderBy('create_time','desc')
				->paginate(12);
			$download->setPath('download');
			$download2=DB::table('download')
					->where('pid',2)
					->orderBy('create_time','desc')
					->paginate(12);
			$download3=DB::table('download')
					->where('pid',3)
					->orderBy('create_time','desc')
					->paginate(12);
			$download3->setPath('download');
			$download4=DB::table('download')
					->where('pid',4)
					->orderBy('create_time','desc')
					->paginate(12);
			$download5=DB::table('download')
					->where('pid',6)
					->orderBy('create_time','desc')
					->paginate(12);
			$download6=DB::table('download')
					->where('pid',7)
					->orderBy('create_time','desc')
					->paginate(12);		
			$types=DB::table('downtype')
				->orderBy('pid','asc')
				->get();
			//banner
			$banner=DB::table('banner')
					->get();
		}
		
		return view('findex/download',['types'=>$types,
			'download'=>$download,'download2'=>$download2,
			'download3'=>$download3,'download4'=>$download4,'download5'=>$download5,
			'download6'=>$download6,'title'=>$title,
			'banner'=>$banner]);
	}

	//资讯列表

	public function information(Request $request){
		$sel=$request->input('sel');
		if($sel){
			if($sel==1){
				$aname=$request->input('aname');
				$proindustry=$request->input('proindustry');
				$procooperation=$request->input('procooperation');
				$promature=$request->input('promature');
				$procoop_money=$request->input('procoop_money');
				if($aname){
					$project=Project::select()
					        ->where('name','like',"%$aname%")
					        ->orderBy('create_time','desc')
					        ->get()
					        ->toArray();
					foreach ($project as $key => $value) {
		            $photo=$value['photo'];
		            $photo=explode(',', $photo);
		            foreach($photo as $k => $v){
		                $project[$key]['img'.$k] = $v;

		            }
		        	}
		        	$perPage = 5;		
		        	if ($request->has('apage')) {				
			        	$current_page = $request->input('apage');				
			        	$current_page = $current_page <= 0 ? 1 :$current_page;		
		        	} 
		        	else {				
		        	$current_page = 1;		
		        	} 		
		        	$item = array_slice($project, ($current_page-1)*$perPage, $perPage); 
		        	//按分页取数据		
		        	$total = count($project);	
		        	$project =new LengthAwarePaginator($item, $total, $perPage,
		        	$current_page, [					
		        			'pageName' => 'apage']);
			        $project = $project->setPath('findex/project');
					//人气
					$project1=Project::select()
					        ->where('name','like',"%$aname%")
					        ->orderBy('look','desc')
					        ->get()
					        ->toArray();
					foreach ($project1 as $key => $value) {
		            $photo=$value['photo'];
		            $photo=explode(',', $photo);
		            foreach($photo as $k => $v){
		                $project1[$key]['img'.$k] = $v;

		            }
		        	}
		        	$perPage = 5;		
		        	if ($request->has('apage')) {				
			        	$current_page = $request->input('apage');				
			        	$current_page = $current_page <= 0 ? 1 :$current_page;		
		        	} 
		        	else {				
		        	$current_page = 1;		
		        	} 		
		        	$item = array_slice($project1, ($current_page-1)*$perPage, $perPage); 
		        	//按分页取数据		
		        	$total = count($project1);	
		        	$project1 =new LengthAwarePaginator($item, $total, $perPage,
		        	$current_page, [					
		        			'pageName' => 'apage']);
			        $project1 = $project1->setPath('findex/project');
					//收藏
					$project2=Project::select()
					        ->where('name','like',"%$aname%")
					        ->orderBy('collection','desc')
					        ->get()
					        ->toArray();
					foreach ($project2 as $key => $value) {
		            $photo=$value['photo'];
		            $photo=explode(',', $photo);
		            foreach($photo as $k => $v){
		                $project2[$key]['img'.$k] = $v;

		            }
		        	}
		        	$perPage = 5;		
		        	if ($request->has('apage')) {				
			        	$current_page = $request->input('apage');				
			        	$current_page = $current_page <= 0 ? 1 :$current_page;		
		        	} 
		        	else {				
		        	$current_page = 1;		
		        	} 		
		        	$item = array_slice($project2, ($current_page-1)*$perPage, $perPage); 
		        	//按分页取数据		
		        	$total = count($project2);	
		        	$project2 =new LengthAwarePaginator($item, $total, $perPage,
		        	$current_page, [					
		        			'pageName' => 'apage']);
			        $project2 = $project2->setPath('findex/project');

					$industry=DB::table('industry')
							->get();
					$cooperation=DB::table('cooperation')->get();
					$mature=DB::table('mature')->get();
					$requirement=DB::table('requirement')
							->orderBy('create_time','desc')
							->paginate(9);
					//banner
					$banner=DB::table('banner')
							->get();
					return view('findex/project',['project'=>$project,'project1'=>$project1,
						'project2'=>$project2,'industry'=>$industry,'banner'=>$banner,
						'requirement'=>$requirement,'proindustry'=>$proindustry,
						'procooperation'=>$procooperation,'promature'=>$promature,
						'procoop_money'=>$procoop_money,'name'=>$aname,'cooperation'=>$cooperation,
						'mature'=>$mature]);
				}
				return redirect('findex/project');
			}
			elseif ($sel==2) {
				$aname=$request->input('aname');
				$proindustry=$request->input('proindustry');
				$procooperation=$request->input('procooperation');
				$procoop_money=$request->input('procoop_money');
				if($aname){
					$industry=DB::table('industry')
							->get();
					$cooperation=DB::table('cooperation')->get();
					$requirement=DB::table('requirement')
							->join('industry','industry.iid','=','requirement.industry')
							->where('name','like',"%$aname%")
							->orderBy('create_time','desc')
							->paginate($perPage = 4, $columns = ['*'], $pageName = 'cpage');
					$requirement->setPath('requirement');
					$requirement1=DB::table('requirement')
							->join('industry','industry.iid','=','requirement.industry')
							->where('name','like',"%$aname%")
							->orderBy('look','desc')
							->paginate($perPage = 4, $columns = ['*'], $pageName = 'cpage');
				
					$requirement2=DB::table('requirement')
							->join('industry','industry.iid','=','requirement.industry')
							->where('name','like',"%$aname%")
							->orderBy('collection','desc')
							->paginate($perPage = 4, $columns = ['*'], $pageName = 'cpage');
					$project=Project::select()
								->join('industry','industry.iid','=','project.industry')
						        ->orderBy('create_time','desc')
						        ->get()
						        ->toArray();
							foreach ($project as $key => $value) {
				            $photo=$value['photo'];
				            $photo=explode(',', $photo);
				            foreach($photo as $k => $v){
				                $project[$key]['img'.$k] = $v;

				            }
				        	}
				        	$perPage =4;		
				        	if ($request->has('pagess')) {				
					        	$current_page = $request->input('pagess');				
					        	$current_page = $current_page <= 0 ? 1 :$current_page;		
				        	} 
				        	else {				
				        	$current_page = 1;		
				        	} 		
				        	$item = array_slice($project, ($current_page-1)*$perPage, $perPage); 
				        	//按分页取数据		
				        	$total = count($project);	
				        	$project =new LengthAwarePaginator($item, $total, $perPage,
				        	$current_page, [					
				        			'pageName' => 'pagess']);
					        $project = $project->setPath('/laravel/public/findex/project');
					        //banner
							$banner=DB::table('banner')
									->get();
							$requirements=DB::table('requirement')
								->orderBy('look','desc')
								->paginate($perPage = 4, $columns = ['*'], $pageName = 'apages');
							return view('findex/requirement',['industry'=>$industry,
							'requirement'=>$requirement,'project'=>$project,
							'requirement1'=>$requirement1,'requirement2'=>$requirement2,
							'name'=>$aname,'proindustry'=>$proindustry,
							'procooperation'=>$procooperation,'procoop_money'=>$procoop_money,
							'banner'=>$banner,'requirements'=>$requirements,
							'cooperation'=>$cooperation]);
				}
				return redirect('findex/requirement');
			}
			elseif ($sel==3) {
				$name=$request->input('aname');
				$proindustry=$request->input('proindustry');
				$procooperation=$request->input('procooperation');
				$procoop_money=$request->input('procoop_money');
				if($name){
					$industry=DB::table('industry')
							->get();
					$cooperation=DB::table('cooperation')->get();
					$enterprise=DB::table('enterprise')
							->join('industry','industry.iid','=','enterprise.industry')
							->where('name','like',"%$name%")
							->orderBy('create_time','desc')
							->paginate($perPage = 5, $columns = ['*'], $pageName = 'pages');
					$enterprise1=DB::table('enterprise')
							->join('industry','industry.iid','=','enterprise.industry')
							->where('name','like',"%$name%")
							->orderBy('look','desc')
							->paginate($perPage = 5, $columns = ['*'], $pageName = 'pages');
					$enterprise2=DB::table('enterprise')
							->join('industry','industry.iid','=','enterprise.industry')
							->where('name','like',"%$name%")
							->orderBy('collection','desc')
							->paginate($perPage = 5, $columns = ['*'], $pageName = 'pages');		
					$enterprise->setPath('enterprise');
					//banner
					$banner=DB::table('banner')
							->get();
					return view('findex/enterprise',['industry'=>$industry,
					'enterprise'=>$enterprise,'enterprise1'=>$enterprise1,
					'enterprise2'=>$enterprise2,'name'=>$name,
					'proindustry'=>$proindustry,'procooperation'=>$procooperation,
					'procoop_money'=>$procoop_money,'banner'=>$banner,'cooperation'=>$cooperation]);
				}
				return redirect('findex/enterprise');
			}
		}
		$information=DB::table('investment')
				->where('pid',1)
				->orderBy('create_time','desc')
				->paginate(12);
		$information->setPath('information');
		$information2=DB::table('investment')
				->where('pid',2)
				->orderBy('create_time','desc')
				->paginate(12);
		$information3=DB::table('investment')
				->where('pid',3)
				->orderBy('create_time','desc')
				->paginate(12);
		$information3->setPath('information');
		$information4=DB::table('investment')
				->where('pid',4)
				->orderBy('create_time','desc')
				->paginate(12);
		$types=DB::table('hot')
			->orderBy('pid','asc')
			->get();
		//banner
		$banner=DB::table('banner')
				->get();
		return view('findex/information',['types'=>$types,
			'information'=>$information,'information2'=>$information2,
			'information3'=>$information3,'information4'=>$information4,
			'banner'=>$banner]);

	}

	//项目详情
	public function pro_details(Request $request){
		$sel=$request->input('sel');
		if($sel){
			if($sel==1){
				$aname=$request->input('aname');
				$proindustry=$request->input('proindustry');
				$procooperation=$request->input('procooperation');
				$promature=$request->input('promature');
				$procoop_money=$request->input('procoop_money');
				if($aname){
					$project=Project::select()
					        ->where('name','like',"%$aname%")
					        ->orderBy('create_time','desc')
					        ->get()
					        ->toArray();
					foreach ($project as $key => $value) {
		            $photo=$value['photo'];
		            $photo=explode(',', $photo);
		            foreach($photo as $k => $v){
		                $project[$key]['img'.$k] = $v;

		            }
		        	}
		        	$perPage = 5;		
		        	if ($request->has('apage')) {				
			        	$current_page = $request->input('apage');				
			        	$current_page = $current_page <= 0 ? 1 :$current_page;		
		        	} 
		        	else {				
		        	$current_page = 1;		
		        	} 		
		        	$item = array_slice($project, ($current_page-1)*$perPage, $perPage); 
		        	//按分页取数据		
		        	$total = count($project);	
		        	$project =new LengthAwarePaginator($item, $total, $perPage,
		        	$current_page, [					
		        			'pageName' => 'apage']);
			        $project = $project->setPath('findex/project');
					//人气
					$project1=Project::select()
					        ->where('name','like',"%$aname%")
					        ->orderBy('look','desc')
					        ->get()
					        ->toArray();
					foreach ($project1 as $key => $value) {
		            $photo=$value['photo'];
		            $photo=explode(',', $photo);
		            foreach($photo as $k => $v){
		                $project1[$key]['img'.$k] = $v;

		            }
		        	}
		        	$perPage = 5;		
		        	if ($request->has('apage')) {				
			        	$current_page = $request->input('apage');				
			        	$current_page = $current_page <= 0 ? 1 :$current_page;		
		        	} 
		        	else {				
		        	$current_page = 1;		
		        	} 		
		        	$item = array_slice($project1, ($current_page-1)*$perPage, $perPage); 
		        	//按分页取数据		
		        	$total = count($project1);	
		        	$project1 =new LengthAwarePaginator($item, $total, $perPage,
		        	$current_page, [					
		        			'pageName' => 'apage']);
			        $project1 = $project1->setPath('findex/project');
					//收藏
					$project2=Project::select()
					        ->where('name','like',"%$aname%")
					        ->orderBy('collection','desc')
					        ->get()
					        ->toArray();
					foreach ($project2 as $key => $value) {
		            $photo=$value['photo'];
		            $photo=explode(',', $photo);
		            foreach($photo as $k => $v){
		                $project2[$key]['img'.$k] = $v;

		            }
		        	}
		        	$perPage = 5;		
		        	if ($request->has('apage')) {				
			        	$current_page = $request->input('apage');				
			        	$current_page = $current_page <= 0 ? 1 :$current_page;		
		        	} 
		        	else {				
		        	$current_page = 1;		
		        	} 		
		        	$item = array_slice($project2, ($current_page-1)*$perPage, $perPage); 
		        	//按分页取数据		
		        	$total = count($project2);	
		        	$project2 =new LengthAwarePaginator($item, $total, $perPage,
		        	$current_page, [					
		        			'pageName' => 'apage']);
			        $project2 = $project2->setPath('findex/project');

					$industry=DB::table('industry')
							->get();
					$cooperation=DB::table('cooperation')->get();
					$mature=DB::table('mature')->get();
					$requirement=DB::table('requirement')
							->orderBy('create_time','desc')
							->paginate(9);
					//banner
					$banner=DB::table('banner')
							->get();
					return view('findex/project',['project'=>$project,'project1'=>$project1,
						'project2'=>$project2,'industry'=>$industry,'banner'=>$banner,
						'requirement'=>$requirement,'proindustry'=>$proindustry,
						'procooperation'=>$procooperation,'promature'=>$promature,
						'procoop_money'=>$procoop_money,'name'=>$aname,'cooperation'=>$cooperation,
						'mature'=>$mature]);
				}
				return redirect('findex/project');
			}
			elseif ($sel==2) {
				$aname=$request->input('aname');
				$proindustry=$request->input('proindustry');
				$procooperation=$request->input('procooperation');
				$procoop_money=$request->input('procoop_money');
				if($aname){
					$industry=DB::table('industry')
							->get();
					$cooperation=DB::table('cooperation')->get();
					$requirement=DB::table('requirement')
							->join('industry','industry.iid','=','requirement.industry')
							->where('name','like',"%$aname%")
							->orderBy('create_time','desc')
							->paginate($perPage = 4, $columns = ['*'], $pageName = 'cpage');
					$requirement->setPath('requirement');
					$requirement1=DB::table('requirement')
							->join('industry','industry.iid','=','requirement.industry')
							->where('name','like',"%$aname%")
							->orderBy('look','desc')
							->paginate($perPage = 4, $columns = ['*'], $pageName = 'cpage');
				
					$requirement2=DB::table('requirement')
							->join('industry','industry.iid','=','requirement.industry')
							->where('name','like',"%$aname%")
							->orderBy('collection','desc')
							->paginate($perPage = 4, $columns = ['*'], $pageName = 'cpage');
					$project=Project::select()
								->join('industry','industry.iid','=','project.industry')
						        ->orderBy('create_time','desc')
						        ->get()
						        ->toArray();
							foreach ($project as $key => $value) {
				            $photo=$value['photo'];
				            $photo=explode(',', $photo);
				            foreach($photo as $k => $v){
				                $project[$key]['img'.$k] = $v;

				            }
				        	}
				        	$perPage =4;		
				        	if ($request->has('pagess')) {				
					        	$current_page = $request->input('pagess');				
					        	$current_page = $current_page <= 0 ? 1 :$current_page;		
				        	} 
				        	else {				
				        	$current_page = 1;		
				        	} 		
				        	$item = array_slice($project, ($current_page-1)*$perPage, $perPage); 
				        	//按分页取数据		
				        	$total = count($project);	
				        	$project =new LengthAwarePaginator($item, $total, $perPage,
				        	$current_page, [					
				        			'pageName' => 'pagess']);
					        $project = $project->setPath('/laravel/public/findex/project');
					        //banner
							$banner=DB::table('banner')
									->get();
							$requirements=DB::table('requirement')
								->orderBy('look','desc')
								->paginate($perPage = 4, $columns = ['*'], $pageName = 'apages');
							return view('findex/requirement',['industry'=>$industry,
							'requirement'=>$requirement,'project'=>$project,
							'requirement1'=>$requirement1,'requirement2'=>$requirement2,
							'name'=>$aname,'proindustry'=>$proindustry,
							'procooperation'=>$procooperation,'procoop_money'=>$procoop_money,
							'banner'=>$banner,'requirements'=>$requirements,
							'cooperation'=>$cooperation]);
				}
				return redirect('findex/requirement');
			}
			elseif ($sel==3) {
				$name=$request->input('aname');
				$proindustry=$request->input('proindustry');
				$procooperation=$request->input('procooperation');
				$procoop_money=$request->input('procoop_money');
				if($name){
					$industry=DB::table('industry')
							->get();
					$cooperation=DB::table('cooperation')->get();
					$enterprise=DB::table('enterprise')
							->join('industry','industry.iid','=','enterprise.industry')
							->where('name','like',"%$name%")
							->orderBy('create_time','desc')
							->paginate($perPage = 5, $columns = ['*'], $pageName = 'pages');
					$enterprise1=DB::table('enterprise')
							->join('industry','industry.iid','=','enterprise.industry')
							->where('name','like',"%$name%")
							->orderBy('look','desc')
							->paginate($perPage = 5, $columns = ['*'], $pageName = 'pages');
					$enterprise2=DB::table('enterprise')
							->join('industry','industry.iid','=','enterprise.industry')
							->where('name','like',"%$name%")
							->orderBy('collection','desc')
							->paginate($perPage = 5, $columns = ['*'], $pageName = 'pages');		
					$enterprise->setPath('enterprise');
					//banner
					$banner=DB::table('banner')
							->get();
					return view('findex/enterprise',['industry'=>$industry,
					'enterprise'=>$enterprise,'enterprise1'=>$enterprise1,
					'enterprise2'=>$enterprise2,'name'=>$name,
					'proindustry'=>$proindustry,'procooperation'=>$procooperation,
					'procoop_money'=>$procoop_money,'banner'=>$banner,'cooperation'=>$cooperation]);
				}
				return redirect('findex/enterprise');
			}
		}
		$id=$request->input('id');
		$pro_details=DB::table('project')
					->join('industry','industry.iid','=','project.industry')
					->join('cooperation','cooperation.cid','=','project.cooperation')
					->join('mature','mature.mid','=','project.mature')
					->join('source','source.sid','=','project.source')
					->where('id',$id)
					->first();
		$photos=$pro_details->photo;
		$photos=explode(',', $photos);
		$niche=$pro_details->niche;
		$niche=explode(';', $niche);
		$look=$pro_details->look;
		$look=$look+1;
		$pro=DB::table('project')->where('id',$id)->update(['look'=>$look]);
		$praise=$request->input('praise');
		$collection=$request->input('collection');
		if($praise=='0'){
			$praise=$pro_details->praise;
			$praisepeo=$pro_details->praisepeo;
			$praise=$praise-1;
			$praisepeo=substr($praisepeo,strpos($praisepeo,',')+1);
			$pro_de=DB::table('project')->where('id',$id)->update(['praise'=>$praise,
			'praisepeo'=>$praisepeo]);
		}
		if($praise=='1'){
			$praise=$pro_details->praise;
			$praisepeo=$pro_details->praisepeo;
			$praise=$praise+1;
			$praisepeo=$request->session()->get('name').','.$praisepeo;
			$pro_de=DB::table('project')->where('id',$id)->update(['praise'=>$praise,
			'praisepeo'=>$praisepeo]);
		}
		if($collection=='0'){
			$collection=$pro_details->collection;
			$collectionpeo=$pro_details->collectionpeo;
			$collection=$collection-1;
			$collectionpeo=substr($collectionpeo,strpos($collectionpeo,',')+1);
			$pro_de=DB::table('project')->where('id',$id)->update(['collection'=>$collection,
			'collectionpeo'=>$collectionpeo]);
		}
		if($collection=='1'){
			$collection=$pro_details->collection;
			$collectionpeo=$pro_details->collectionpeo;
			$collection=$collection+1;
			$collectionpeo=$request->session()->get('name').','.$collectionpeo;
			$pro_de=DB::table('project')->where('id',$id)->update(['collection'=>$collection,
			'collectionpeo'=>$collectionpeo]);
		}
		$iname=$pro_details->iname;
		$project=Project::select()
				->join('industry','industry.iid','=','project.industry')
				->join('cooperation','cooperation.cid','=','project.cooperation')
				->join('mature','mature.mid','=','project.mature')
				->join('source','source.sid','=','project.source')
				->where('iname',$iname)
		        ->orderBy('look','desc')
		        ->get()
		        ->toArray();
			foreach ($project as $key => $value) {
            $photo=$value['photo'];
            $photo=explode(',', $photo);
            foreach($photo as $k => $v){
                $project[$key]['img'.$k] = $v;
            }
        	}
        	$perPage = 3;		
        	if ($request->has('pagess')) {				
	        	$current_page = $request->input('pagess');				
	        	$current_page = $current_page <= 0 ? 1 :$current_page;		
        	} 
        	else {				
        	$current_page = 1;		
        	} 		
        	$item = array_slice($project, ($current_page-1)*$perPage, $perPage); 
        	//按分页取数据		
        	$total = count($project);	
        	$project =new LengthAwarePaginator($item, $total, $perPage,
        	$current_page, [					
        			'pageName' => 'page']);
	        $project = $project->setPath('/laravel/public/findex/pro_details');
	        $a=DB::table('project')
					->join('industry','industry.iid','=','project.industry')
					->join('cooperation','cooperation.cid','=','project.cooperation')
					->join('mature','mature.mid','=','project.mature')
					->join('source','source.sid','=','project.source')
					->where('id',$id)
					->first();
			$c=$a->praisepeo;
			$d=$request->session()->get('name');
			$c=explode(',', $c);
			if(in_array($d,$c)){
				$b=1;
			}
			else{
				$b=2;
			}
			$coll=$a->collectionpeo;
			$name=$request->session()->get('name');
			$coll=explode(',', $coll);
			if(in_array($name,$coll)){
				$bcoll=1;
			}
			else{
				$bcoll=2;
			}
			
		return view('findex/pro_details',['pro_details'=>$pro_details,
			'project'=>$project,'photos'=>$photos,'b'=>$b,'bcoll'=>$bcoll,'niche'=>$niche]);
	}

	//需求详情
	public function requ_details(Request $request){
		$sel=$request->input('sel');
		if($sel){
			if($sel==1){
				$aname=$request->input('aname');
				$proindustry=$request->input('proindustry');
				$procooperation=$request->input('procooperation');
				$promature=$request->input('promature');
				$procoop_money=$request->input('procoop_money');
				if($aname){
					$project=Project::select()
					        ->where('name','like',"%$aname%")
					        ->orderBy('create_time','desc')
					        ->get()
					        ->toArray();
					foreach ($project as $key => $value) {
		            $photo=$value['photo'];
		            $photo=explode(',', $photo);
		            foreach($photo as $k => $v){
		                $project[$key]['img'.$k] = $v;

		            }
		        	}
		        	$perPage = 5;		
		        	if ($request->has('apage')) {				
			        	$current_page = $request->input('apage');				
			        	$current_page = $current_page <= 0 ? 1 :$current_page;		
		        	} 
		        	else {				
		        	$current_page = 1;		
		        	} 		
		        	$item = array_slice($project, ($current_page-1)*$perPage, $perPage); 
		        	//按分页取数据		
		        	$total = count($project);	
		        	$project =new LengthAwarePaginator($item, $total, $perPage,
		        	$current_page, [					
		        			'pageName' => 'apage']);
			        $project = $project->setPath('findex/project');
					//人气
					$project1=Project::select()
					        ->where('name','like',"%$aname%")
					        ->orderBy('look','desc')
					        ->get()
					        ->toArray();
					foreach ($project1 as $key => $value) {
		            $photo=$value['photo'];
		            $photo=explode(',', $photo);
		            foreach($photo as $k => $v){
		                $project1[$key]['img'.$k] = $v;

		            }
		        	}
		        	$perPage = 5;		
		        	if ($request->has('apage')) {				
			        	$current_page = $request->input('apage');				
			        	$current_page = $current_page <= 0 ? 1 :$current_page;		
		        	} 
		        	else {				
		        	$current_page = 1;		
		        	} 		
		        	$item = array_slice($project1, ($current_page-1)*$perPage, $perPage); 
		        	//按分页取数据		
		        	$total = count($project1);	
		        	$project1 =new LengthAwarePaginator($item, $total, $perPage,
		        	$current_page, [					
		        			'pageName' => 'apage']);
			        $project1 = $project1->setPath('findex/project');
					//收藏
					$project2=Project::select()
					        ->where('name','like',"%$aname%")
					        ->orderBy('collection','desc')
					        ->get()
					        ->toArray();
					foreach ($project2 as $key => $value) {
		            $photo=$value['photo'];
		            $photo=explode(',', $photo);
		            foreach($photo as $k => $v){
		                $project2[$key]['img'.$k] = $v;

		            }
		        	}
		        	$perPage = 5;		
		        	if ($request->has('apage')) {				
			        	$current_page = $request->input('apage');				
			        	$current_page = $current_page <= 0 ? 1 :$current_page;		
		        	} 
		        	else {				
		        	$current_page = 1;		
		        	} 		
		        	$item = array_slice($project2, ($current_page-1)*$perPage, $perPage); 
		        	//按分页取数据		
		        	$total = count($project2);	
		        	$project2 =new LengthAwarePaginator($item, $total, $perPage,
		        	$current_page, [					
		        			'pageName' => 'apage']);
			        $project2 = $project2->setPath('findex/project');

					$industry=DB::table('industry')
							->get();
					$cooperation=DB::table('cooperation')->get();
					$mature=DB::table('mature')->get();
					$requirement=DB::table('requirement')
							->orderBy('create_time','desc')
							->paginate(9);
					//banner
					$banner=DB::table('banner')
							->get();
					return view('findex/project',['project'=>$project,'project1'=>$project1,
						'project2'=>$project2,'industry'=>$industry,'banner'=>$banner,
						'requirement'=>$requirement,'proindustry'=>$proindustry,
						'procooperation'=>$procooperation,'promature'=>$promature,
						'procoop_money'=>$procoop_money,'name'=>$aname,'cooperation'=>$cooperation,
						'mature'=>$mature]);
				}
				return redirect('findex/project');
			}
			elseif ($sel==2) {
				$aname=$request->input('aname');
				$proindustry=$request->input('proindustry');
				$procooperation=$request->input('procooperation');
				$procoop_money=$request->input('procoop_money');
				if($aname){
					$industry=DB::table('industry')
							->get();
					$cooperation=DB::table('cooperation')->get();
					$requirement=DB::table('requirement')
							->join('industry','industry.iid','=','requirement.industry')
							->where('name','like',"%$aname%")
							->orderBy('create_time','desc')
							->paginate($perPage = 4, $columns = ['*'], $pageName = 'cpage');
					$requirement->setPath('requirement');
					$requirement1=DB::table('requirement')
							->join('industry','industry.iid','=','requirement.industry')
							->where('name','like',"%$aname%")
							->orderBy('look','desc')
							->paginate($perPage = 4, $columns = ['*'], $pageName = 'cpage');
				
					$requirement2=DB::table('requirement')
							->join('industry','industry.iid','=','requirement.industry')
							->where('name','like',"%$aname%")
							->orderBy('collection','desc')
							->paginate($perPage = 4, $columns = ['*'], $pageName = 'cpage');
					$project=Project::select()
								->join('industry','industry.iid','=','project.industry')
						        ->orderBy('create_time','desc')
						        ->get()
						        ->toArray();
							foreach ($project as $key => $value) {
				            $photo=$value['photo'];
				            $photo=explode(',', $photo);
				            foreach($photo as $k => $v){
				                $project[$key]['img'.$k] = $v;

				            }
				        	}
				        	$perPage =4;		
				        	if ($request->has('pagess')) {				
					        	$current_page = $request->input('pagess');				
					        	$current_page = $current_page <= 0 ? 1 :$current_page;		
				        	} 
				        	else {				
				        	$current_page = 1;		
				        	} 		
				        	$item = array_slice($project, ($current_page-1)*$perPage, $perPage); 
				        	//按分页取数据		
				        	$total = count($project);	
				        	$project =new LengthAwarePaginator($item, $total, $perPage,
				        	$current_page, [					
				        			'pageName' => 'pagess']);
					        $project = $project->setPath('/laravel/public/findex/project');
					        //banner
							$banner=DB::table('banner')
									->get();
							$requirements=DB::table('requirement')
								->orderBy('look','desc')
								->paginate($perPage = 4, $columns = ['*'], $pageName = 'apages');
							return view('findex/requirement',['industry'=>$industry,
							'requirement'=>$requirement,'project'=>$project,
							'requirement1'=>$requirement1,'requirement2'=>$requirement2,
							'name'=>$aname,'proindustry'=>$proindustry,
							'procooperation'=>$procooperation,'procoop_money'=>$procoop_money,
							'banner'=>$banner,'requirements'=>$requirements,
							'cooperation'=>$cooperation]);
				}
				return redirect('findex/requirement');
			}
			elseif ($sel==3) {
				$name=$request->input('aname');
				$proindustry=$request->input('proindustry');
				$procooperation=$request->input('procooperation');
				$procoop_money=$request->input('procoop_money');
				if($name){
					$industry=DB::table('industry')
							->get();
					$cooperation=DB::table('cooperation')->get();
					$enterprise=DB::table('enterprise')
							->join('industry','industry.iid','=','enterprise.industry')
							->where('name','like',"%$name%")
							->orderBy('create_time','desc')
							->paginate($perPage = 5, $columns = ['*'], $pageName = 'pages');
					$enterprise1=DB::table('enterprise')
							->join('industry','industry.iid','=','enterprise.industry')
							->where('name','like',"%$name%")
							->orderBy('look','desc')
							->paginate($perPage = 5, $columns = ['*'], $pageName = 'pages');
					$enterprise2=DB::table('enterprise')
							->join('industry','industry.iid','=','enterprise.industry')
							->where('name','like',"%$name%")
							->orderBy('collection','desc')
							->paginate($perPage = 5, $columns = ['*'], $pageName = 'pages');		
					$enterprise->setPath('enterprise');
					//banner
					$banner=DB::table('banner')
							->get();
					return view('findex/enterprise',['industry'=>$industry,
					'enterprise'=>$enterprise,'enterprise1'=>$enterprise1,
					'enterprise2'=>$enterprise2,'name'=>$name,
					'proindustry'=>$proindustry,'procooperation'=>$procooperation,
					'procoop_money'=>$procoop_money,'banner'=>$banner,'cooperation'=>$cooperation]);
				}
				return redirect('findex/enterprise');
			}
		}
		$id=$request->input('id');
		$requ_details=DB::table('requirement')
					->join('industry','industry.iid','=','requirement.industry')
					->join('cooperation','cooperation.cid','=','requirement.cooperation')
					->where('id',$id)
					->first();
		$fields=$requ_details->fields;
		$fields=explode(';', $fields);
		$look=$requ_details->look;
		$look=$look+1;
		$pro=DB::table('requirement')->where('id',$id)
		->update(['look'=>$look]);
		$praise=$request->input('praise');
		$collection=$request->input('collection');
		if($praise=='0'){
			$praise=$requ_details->praise;
			$praisepeo=$requ_details->praisepeo;
			$praise=$praise-1;
			$praisepeo=substr($praisepeo,strpos($praisepeo,',')+1);
			$pro_de=DB::table('requirement')->where('id',$id)->update(['praise'=>$praise,
			'praisepeo'=>$praisepeo]);
		}
		if($praise=='1'){
			$praise=$requ_details->praise;
			$praisepeo=$requ_details->praisepeo;
			$praise=$praise+1;
			$praisepeo=$request->session()->get('name').','.$praisepeo;
			$pro_de=DB::table('requirement')->where('id',$id)->update(['praise'=>$praise,
			'praisepeo'=>$praisepeo]);
		}
		if($collection=='0'){
			$collection=$requ_details->collection;
			$collectionpeo=$requ_details->collectionpeo;
			$collection=$collection-1;
			$collectionpeo=substr($collectionpeo,strpos($collectionpeo,',')+1);
			$pro_de=DB::table('requirement')->where('id',$id)->update([
			'collection'=>$collection,'collectionpeo'=>$collectionpeo]);
		}
		if($collection=='1'){
			$collection=$requ_details->collection;
			$collectionpeo=$requ_details->collectionpeo;
			$collection=$collection+1;
			$collectionpeo=$request->session()->get('name').','.$collectionpeo;
			$pro_de=DB::table('requirement')->where('id',$id)->update([
			'collection'=>$collection,'collectionpeo'=>$collectionpeo]);
		}
		$requirement=DB::table('requirement')
				->orderBy('create_time','desc')
				->paginate(8);
		$a=DB::table('requirement')
				->where('id',$id)
				->first();
		$c=$a->praisepeo;
		$d=$request->session()->get('name');
		$c=explode(',', $c);
		if(in_array($d,$c)){
			$b=1;
		}
		else{
			$b=2;
		}
		$coll=$a->collectionpeo;
		$name=$request->session()->get('name');
		$coll=explode(',', $coll);
		if(in_array($name,$coll)){
			$bcoll=1;
		}
		else{
			$bcoll=2;
		}
		return view('findex/requ_details',['requ_details'=>$requ_details,
			'requirement'=>$requirement,'b'=>$b,'bcoll'=>$bcoll,'fields'=>$fields]);
	}

	//资讯详情
	public function info_details(Request $request){
		$sel=$request->input('sel');
		if($sel){
			if($sel==1){
				$aname=$request->input('aname');
				$proindustry=$request->input('proindustry');
				$procooperation=$request->input('procooperation');
				$promature=$request->input('promature');
				$procoop_money=$request->input('procoop_money');
				if($aname){
					$project=Project::select()
					        ->where('name','like',"%$aname%")
					        ->orderBy('create_time','desc')
					        ->get()
					        ->toArray();
					foreach ($project as $key => $value) {
		            $photo=$value['photo'];
		            $photo=explode(',', $photo);
		            foreach($photo as $k => $v){
		                $project[$key]['img'.$k] = $v;

		            }
		        	}
		        	$perPage = 5;		
		        	if ($request->has('apage')) {				
			        	$current_page = $request->input('apage');				
			        	$current_page = $current_page <= 0 ? 1 :$current_page;		
		        	} 
		        	else {				
		        	$current_page = 1;		
		        	} 		
		        	$item = array_slice($project, ($current_page-1)*$perPage, $perPage); 
		        	//按分页取数据		
		        	$total = count($project);	
		        	$project =new LengthAwarePaginator($item, $total, $perPage,
		        	$current_page, [					
		        			'pageName' => 'apage']);
			        $project = $project->setPath('findex/project');
					//人气
					$project1=Project::select()
					        ->where('name','like',"%$aname%")
					        ->orderBy('look','desc')
					        ->get()
					        ->toArray();
					foreach ($project1 as $key => $value) {
		            $photo=$value['photo'];
		            $photo=explode(',', $photo);
		            foreach($photo as $k => $v){
		                $project1[$key]['img'.$k] = $v;

		            }
		        	}
		        	$perPage = 5;		
		        	if ($request->has('apage')) {				
			        	$current_page = $request->input('apage');				
			        	$current_page = $current_page <= 0 ? 1 :$current_page;		
		        	} 
		        	else {				
		        	$current_page = 1;		
		        	} 		
		        	$item = array_slice($project1, ($current_page-1)*$perPage, $perPage); 
		        	//按分页取数据		
		        	$total = count($project1);	
		        	$project1 =new LengthAwarePaginator($item, $total, $perPage,
		        	$current_page, [					
		        			'pageName' => 'apage']);
			        $project1 = $project1->setPath('findex/project');
					//收藏
					$project2=Project::select()
					        ->where('name','like',"%$aname%")
					        ->orderBy('collection','desc')
					        ->get()
					        ->toArray();
					foreach ($project2 as $key => $value) {
		            $photo=$value['photo'];
		            $photo=explode(',', $photo);
		            foreach($photo as $k => $v){
		                $project2[$key]['img'.$k] = $v;

		            }
		        	}
		        	$perPage = 5;		
		        	if ($request->has('apage')) {				
			        	$current_page = $request->input('apage');				
			        	$current_page = $current_page <= 0 ? 1 :$current_page;		
		        	} 
		        	else {				
		        	$current_page = 1;		
		        	} 		
		        	$item = array_slice($project2, ($current_page-1)*$perPage, $perPage); 
		        	//按分页取数据		
		        	$total = count($project2);	
		        	$project2 =new LengthAwarePaginator($item, $total, $perPage,
		        	$current_page, [					
		        			'pageName' => 'apage']);
			        $project2 = $project2->setPath('findex/project');

					$industry=DB::table('industry')
							->get();
					$cooperation=DB::table('cooperation')->get();
					$mature=DB::table('mature')->get();
					$requirement=DB::table('requirement')
							->orderBy('create_time','desc')
							->paginate(9);
					//banner
					$banner=DB::table('banner')
							->get();
					return view('findex/project',['project'=>$project,'project1'=>$project1,
						'project2'=>$project2,'industry'=>$industry,'banner'=>$banner,
						'requirement'=>$requirement,'proindustry'=>$proindustry,
						'procooperation'=>$procooperation,'promature'=>$promature,
						'procoop_money'=>$procoop_money,'name'=>$aname,'cooperation'=>$cooperation,
						'mature'=>$mature]);
				}
				return redirect('findex/project');
			}
			elseif ($sel==2) {
				$aname=$request->input('aname');
				$proindustry=$request->input('proindustry');
				$procooperation=$request->input('procooperation');
				$procoop_money=$request->input('procoop_money');
				if($aname){
					$industry=DB::table('industry')
							->get();
					$cooperation=DB::table('cooperation')->get();
					$requirement=DB::table('requirement')
							->join('industry','industry.iid','=','requirement.industry')
							->where('name','like',"%$aname%")
							->orderBy('create_time','desc')
							->paginate($perPage = 4, $columns = ['*'], $pageName = 'cpage');
					$requirement->setPath('requirement');
					$requirement1=DB::table('requirement')
							->join('industry','industry.iid','=','requirement.industry')
							->where('name','like',"%$aname%")
							->orderBy('look','desc')
							->paginate($perPage = 4, $columns = ['*'], $pageName = 'cpage');
				
					$requirement2=DB::table('requirement')
							->join('industry','industry.iid','=','requirement.industry')
							->where('name','like',"%$aname%")
							->orderBy('collection','desc')
							->paginate($perPage = 4, $columns = ['*'], $pageName = 'cpage');
					$project=Project::select()
								->join('industry','industry.iid','=','project.industry')
						        ->orderBy('create_time','desc')
						        ->get()
						        ->toArray();
							foreach ($project as $key => $value) {
				            $photo=$value['photo'];
				            $photo=explode(',', $photo);
				            foreach($photo as $k => $v){
				                $project[$key]['img'.$k] = $v;

				            }
				        	}
				        	$perPage =4;		
				        	if ($request->has('pagess')) {				
					        	$current_page = $request->input('pagess');				
					        	$current_page = $current_page <= 0 ? 1 :$current_page;		
				        	} 
				        	else {				
				        	$current_page = 1;		
				        	} 		
				        	$item = array_slice($project, ($current_page-1)*$perPage, $perPage); 
				        	//按分页取数据		
				        	$total = count($project);	
				        	$project =new LengthAwarePaginator($item, $total, $perPage,
				        	$current_page, [					
				        			'pageName' => 'pagess']);
					        $project = $project->setPath('/laravel/public/findex/project');
					        //banner
							$banner=DB::table('banner')
									->get();
							$requirements=DB::table('requirement')
								->orderBy('look','desc')
								->paginate($perPage = 4, $columns = ['*'], $pageName = 'apages');
							return view('findex/requirement',['industry'=>$industry,
							'requirement'=>$requirement,'project'=>$project,
							'requirement1'=>$requirement1,'requirement2'=>$requirement2,
							'name'=>$aname,'proindustry'=>$proindustry,
							'procooperation'=>$procooperation,'procoop_money'=>$procoop_money,
							'banner'=>$banner,'requirements'=>$requirements,
							'cooperation'=>$cooperation]);
				}
				return redirect('findex/requirement');
			}
			elseif ($sel==3) {
				$name=$request->input('aname');
				$proindustry=$request->input('proindustry');
				$procooperation=$request->input('procooperation');
				$procoop_money=$request->input('procoop_money');
				if($name){
					$industry=DB::table('industry')
							->get();
					$cooperation=DB::table('cooperation')->get();
					$enterprise=DB::table('enterprise')
							->join('industry','industry.iid','=','enterprise.industry')
							->where('name','like',"%$name%")
							->orderBy('create_time','desc')
							->paginate($perPage = 5, $columns = ['*'], $pageName = 'pages');
					$enterprise1=DB::table('enterprise')
							->join('industry','industry.iid','=','enterprise.industry')
							->where('name','like',"%$name%")
							->orderBy('look','desc')
							->paginate($perPage = 5, $columns = ['*'], $pageName = 'pages');
					$enterprise2=DB::table('enterprise')
							->join('industry','industry.iid','=','enterprise.industry')
							->where('name','like',"%$name%")
							->orderBy('collection','desc')
							->paginate($perPage = 5, $columns = ['*'], $pageName = 'pages');		
					$enterprise->setPath('enterprise');
					//banner
					$banner=DB::table('banner')
							->get();
					return view('findex/enterprise',['industry'=>$industry,
					'enterprise'=>$enterprise,'enterprise1'=>$enterprise1,
					'enterprise2'=>$enterprise2,'name'=>$name,
					'proindustry'=>$proindustry,'procooperation'=>$procooperation,
					'procoop_money'=>$procoop_money,'banner'=>$banner,'cooperation'=>$cooperation]);
				}
				return redirect('findex/enterprise');
			}
		}
		$id=$request->input('id');
		$info_details=DB::table('investment')
					->where('id',$id)
					->first();
		$look=$info_details->look;
		$look=$look+1;
		$pro=DB::table('investment')->where('id',$id)
		->update(['look'=>$look]);
		$investment=DB::table('investment')
				->orderBy('create_time','desc')
				->paginate(9);
		$download=DB::table('download')
				->orderBy('create_time','desc')
				->paginate(4);
		return view('findex/info_details',['info_details'=>$info_details,
			'investment'=>$investment,'download'=>$download]);
	}

	//企业详情
	public function ente_details(Request $request){
		$sel=$request->input('sel');
		if($sel){
			if($sel==1){
				$aname=$request->input('aname');
				$proindustry=$request->input('proindustry');
				$procooperation=$request->input('procooperation');
				$promature=$request->input('promature');
				$procoop_money=$request->input('procoop_money');
				if($aname){
					$project=Project::select()
					        ->where('name','like',"%$aname%")
					        ->orderBy('create_time','desc')
					        ->get()
					        ->toArray();
					foreach ($project as $key => $value) {
		            $photo=$value['photo'];
		            $photo=explode(',', $photo);
		            foreach($photo as $k => $v){
		                $project[$key]['img'.$k] = $v;

		            }
		        	}
		        	$perPage = 5;		
		        	if ($request->has('apage')) {				
			        	$current_page = $request->input('apage');				
			        	$current_page = $current_page <= 0 ? 1 :$current_page;		
		        	} 
		        	else {				
		        	$current_page = 1;		
		        	} 		
		        	$item = array_slice($project, ($current_page-1)*$perPage, $perPage); 
		        	//按分页取数据		
		        	$total = count($project);	
		        	$project =new LengthAwarePaginator($item, $total, $perPage,
		        	$current_page, [					
		        			'pageName' => 'apage']);
			        $project = $project->setPath('findex/project');
					//人气
					$project1=Project::select()
					        ->where('name','like',"%$aname%")
					        ->orderBy('look','desc')
					        ->get()
					        ->toArray();
					foreach ($project1 as $key => $value) {
		            $photo=$value['photo'];
		            $photo=explode(',', $photo);
		            foreach($photo as $k => $v){
		                $project1[$key]['img'.$k] = $v;

		            }
		        	}
		        	$perPage = 5;		
		        	if ($request->has('apage')) {				
			        	$current_page = $request->input('apage');				
			        	$current_page = $current_page <= 0 ? 1 :$current_page;		
		        	} 
		        	else {				
		        	$current_page = 1;		
		        	} 		
		        	$item = array_slice($project1, ($current_page-1)*$perPage, $perPage); 
		        	//按分页取数据		
		        	$total = count($project1);	
		        	$project1 =new LengthAwarePaginator($item, $total, $perPage,
		        	$current_page, [					
		        			'pageName' => 'apage']);
			        $project1 = $project1->setPath('findex/project');
					//收藏
					$project2=Project::select()
					        ->where('name','like',"%$aname%")
					        ->orderBy('collection','desc')
					        ->get()
					        ->toArray();
					foreach ($project2 as $key => $value) {
		            $photo=$value['photo'];
		            $photo=explode(',', $photo);
		            foreach($photo as $k => $v){
		                $project2[$key]['img'.$k] = $v;

		            }
		        	}
		        	$perPage = 5;		
		        	if ($request->has('apage')) {				
			        	$current_page = $request->input('apage');				
			        	$current_page = $current_page <= 0 ? 1 :$current_page;		
		        	} 
		        	else {				
		        	$current_page = 1;		
		        	} 		
		        	$item = array_slice($project2, ($current_page-1)*$perPage, $perPage); 
		        	//按分页取数据		
		        	$total = count($project2);	
		        	$project2 =new LengthAwarePaginator($item, $total, $perPage,
		        	$current_page, [					
		        			'pageName' => 'apage']);
			        $project2 = $project2->setPath('findex/project');

					$industry=DB::table('industry')
							->get();
					$cooperation=DB::table('cooperation')->get();
					$mature=DB::table('mature')->get();
					$requirement=DB::table('requirement')
							->orderBy('create_time','desc')
							->paginate(9);
					//banner
					$banner=DB::table('banner')
							->get();
					return view('findex/project',['project'=>$project,'project1'=>$project1,
						'project2'=>$project2,'industry'=>$industry,'banner'=>$banner,
						'requirement'=>$requirement,'proindustry'=>$proindustry,
						'procooperation'=>$procooperation,'promature'=>$promature,
						'procoop_money'=>$procoop_money,'name'=>$aname,'cooperation'=>$cooperation,
						'mature'=>$mature]);
				}
				return redirect('findex/project');
			}
			elseif ($sel==2) {
				$aname=$request->input('aname');
				$proindustry=$request->input('proindustry');
				$procooperation=$request->input('procooperation');
				$procoop_money=$request->input('procoop_money');
				if($aname){
					$industry=DB::table('industry')
							->get();
					$cooperation=DB::table('cooperation')->get();
					$requirement=DB::table('requirement')
							->join('industry','industry.iid','=','requirement.industry')
							->where('name','like',"%$aname%")
							->orderBy('create_time','desc')
							->paginate($perPage = 4, $columns = ['*'], $pageName = 'cpage');
					$requirement->setPath('requirement');
					$requirement1=DB::table('requirement')
							->join('industry','industry.iid','=','requirement.industry')
							->where('name','like',"%$aname%")
							->orderBy('look','desc')
							->paginate($perPage = 4, $columns = ['*'], $pageName = 'cpage');
				
					$requirement2=DB::table('requirement')
							->join('industry','industry.iid','=','requirement.industry')
							->where('name','like',"%$aname%")
							->orderBy('collection','desc')
							->paginate($perPage = 4, $columns = ['*'], $pageName = 'cpage');
					$project=Project::select()
								->join('industry','industry.iid','=','project.industry')
						        ->orderBy('create_time','desc')
						        ->get()
						        ->toArray();
							foreach ($project as $key => $value) {
				            $photo=$value['photo'];
				            $photo=explode(',', $photo);
				            foreach($photo as $k => $v){
				                $project[$key]['img'.$k] = $v;

				            }
				        	}
				        	$perPage =4;		
				        	if ($request->has('pagess')) {				
					        	$current_page = $request->input('pagess');				
					        	$current_page = $current_page <= 0 ? 1 :$current_page;		
				        	} 
				        	else {				
				        	$current_page = 1;		
				        	} 		
				        	$item = array_slice($project, ($current_page-1)*$perPage, $perPage); 
				        	//按分页取数据		
				        	$total = count($project);	
				        	$project =new LengthAwarePaginator($item, $total, $perPage,
				        	$current_page, [					
				        			'pageName' => 'pagess']);
					        $project = $project->setPath('/laravel/public/findex/project');
					        //banner
							$banner=DB::table('banner')
									->get();
							$requirements=DB::table('requirement')
								->orderBy('look','desc')
								->paginate($perPage = 4, $columns = ['*'], $pageName = 'apages');
							return view('findex/requirement',['industry'=>$industry,
							'requirement'=>$requirement,'project'=>$project,
							'requirement1'=>$requirement1,'requirement2'=>$requirement2,
							'name'=>$aname,'proindustry'=>$proindustry,
							'procooperation'=>$procooperation,'procoop_money'=>$procoop_money,
							'banner'=>$banner,'requirements'=>$requirements,
							'cooperation'=>$cooperation]);
				}
				return redirect('findex/requirement');
			}
			elseif ($sel==3) {
				$name=$request->input('aname');
				$proindustry=$request->input('proindustry');
				$procooperation=$request->input('procooperation');
				$procoop_money=$request->input('procoop_money');
				if($name){
					$industry=DB::table('industry')
							->get();
					$cooperation=DB::table('cooperation')->get();
					$enterprise=DB::table('enterprise')
							->join('industry','industry.iid','=','enterprise.industry')
							->where('name','like',"%$name%")
							->orderBy('create_time','desc')
							->paginate($perPage = 5, $columns = ['*'], $pageName = 'pages');
					$enterprise1=DB::table('enterprise')
							->join('industry','industry.iid','=','enterprise.industry')
							->where('name','like',"%$name%")
							->orderBy('look','desc')
							->paginate($perPage = 5, $columns = ['*'], $pageName = 'pages');
					$enterprise2=DB::table('enterprise')
							->join('industry','industry.iid','=','enterprise.industry')
							->where('name','like',"%$name%")
							->orderBy('collection','desc')
							->paginate($perPage = 5, $columns = ['*'], $pageName = 'pages');		
					$enterprise->setPath('enterprise');
					//banner
					$banner=DB::table('banner')
							->get();
					return view('findex/enterprise',['industry'=>$industry,
					'enterprise'=>$enterprise,'enterprise1'=>$enterprise1,
					'enterprise2'=>$enterprise2,'name'=>$name,
					'proindustry'=>$proindustry,'procooperation'=>$procooperation,
					'procoop_money'=>$procoop_money,'banner'=>$banner,'cooperation'=>$cooperation]);
				}
				return redirect('findex/enterprise');
			}
		}
		$id=$request->input('id');
		$ente_details=DB::table('enterprise')
					->join('industry','industry.iid','=','enterprise.industry')
					->where('id',$id)
					->first();
		$field=$ente_details->field;
		$field=explode(';', $field);
		$look=$ente_details->look;
		$look=$look+1;
		$pro=DB::table('enterprise')->where('id',$id)
		->update(['look'=>$look]);
		$praise=$request->input('praise');
		$collection=$request->input('collection');
		if($praise=='0'){
			$praise=$ente_details->praise;
			$praisepeo=$ente_details->praisepeo;
			$praise=$praise-1;
			$praisepeo=substr($praisepeo,strpos($praisepeo,',')+1);
			$pro_de=DB::table('enterprise')->where('id',$id)->update(['praise'=>$praise,
			'praisepeo'=>$praisepeo]);
		}
		if($praise=='1'){
			$praise=$ente_details->praise;
			$praisepeo=$ente_details->praisepeo;
			$praise=$praise+1;
			$praisepeo=$request->session()->get('name').','.$praisepeo;
			$pro_de=DB::table('enterprise')->where('id',$id)->update(['praise'=>$praise,
			'praisepeo'=>$praisepeo]);
		}
		if($collection=='0'){
			$collection=$ente_details->collection;
			$collectionpeo=$ente_details->collectionpeo;
			$collection=$collection-1;
			$collectionpeo=substr($collectionpeo,strpos($collectionpeo,',')+1);
			$pro_de=DB::table('enterprise')->where('id',$id)->update([
			'collection'=>$collection,'collectionpeo'=>$collectionpeo]);
		}
		if($collection=='1'){
			$collection=$ente_details->collection;
			$collectionpeo=$ente_details
			->collectionpeo;
			$collection=$collection+1;
			$collectionpeo=$request->session()->get('name').','.$collectionpeo;
			$pro_de=DB::table('enterprise')->where('id',$id)->update([
			'collection'=>$collection,'collectionpeo'=>$collectionpeo]);
		}
		$a=DB::table('enterprise')
				->join('industry','industry.iid','=','enterprise.industry')
				->where('id',$id)
				->first();
		$c=$a->praisepeo;
		$d=$request->session()->get('name');
		$c=explode(',', $c);
		if(in_array($d,$c)){
			$b=1;
		}
		else{
			$b=2;
		}
		$coll=$a->collectionpeo;
		$name=$request->session()->get('name');
		$coll=explode(',', $coll);
		if(in_array($name,$coll)){
			$bcoll=1;
		}
		else{
			$bcoll=2;
		}
		return view('findex/ente_details',['ente_details'=>$ente_details,'b'=>$b,
		'bcoll'=>$bcoll,'field'=>$field]);
	}

	//登陆
	public function login(Request $request){
		if($request->input('sub')){
			$name=$request->input('name');
			$password=$request->input('password');
			$list=DB::table('member')->where('name',$name)->where('password',
				$password)->first();

			if($list){
				$id=$list->id;
				$id=$request->session()->put('id',$id);
				$name=$request->session()->put('name',$name);
				echo '<script>alert("登陆成功");window.location.href="/";</script>';
						
			}
			$data=DB::table('regienterprise')->where('name',$name)->where('password',$password)->first();
			if($data){
				$id=$data->id;
				$id=$request->session()->put('id',$id);
				$name=$request->session()->put('name',$name);
				echo '<script>alert("登录成功");window.location.href="/";</script>';
			}
			else{
				echo '<script>alert("登录失败");window.location.href="login";</script>'; 
			}
		}
		return view('findex/login');
	}

	//注册
	public function registration(Request $request){

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
				$uploads=$this->upload($files);
				$filenames=implode(',', $uploads);
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
				echo '<script>alert("个人注册成功");window.location.href="login";</script>';

			}else{
				echo '<script>alert("个人注册失败");window.location.href="regienterprise";</script>'; 

			}
		}
		if($request->input('subs')){
			$id=uniqid();
			$create_uid=session('u_id');
			$create_time=time();
			$name=$request->input('name');
			$enter_name=$request->input('enter_name');
			$password=$request->input('password');
			$phone=$request->input('phone');
			$industry=$request->input('industry');
			$field=$request->input('field');	
			// $requirement=$request->input('requirement');
			//图片上传	
			$file = $request->file('business');
			if(empty($file[0])){
				$filename='';
			}
			else{
				$upload=$this->upload($file);
				$filename=implode(',', $upload);
			}
			$data=DB::table('regienterprise')->insert([
				'id'=>$id,'name'=>$name,'enter_name'=>$enter_name,
				'password'=>$password,'phone'=>$phone,
				'industry'=>$industry,'field'=>$field,
				'business'=>$filename,
				'create_uid'=>$create_uid,'update_uid'=>$create_uid,
				'create_time'=>$create_time,'update_time'=>$create_time
			]);
			if($data){
				echo '<script>alert("企业注册成功");window.location.href="login";</script>';

			}else{
				echo '<script>alert("企业注册失败");window.location.href="regienterprise";</script>'; 

			}
		}
		else{
			$industry=DB::table('industry')
				->get();
		return view('findex/registration',['industry'=>$industry]);
		}
		
	}

	//个人中心
	public function collection(Request $request){
		$name=$request->session()->get('name');
			$list=DB::table('member')
				->join('industry','industry.iid','=','member.industry')
				->where('name',$name)
				->first();
			$data=DB::table('regienterprise')
				->join('industry','industry.iid','=','regienterprise.industry')
				->where('name',$name)
				->first();
			$name=$request->session()->get('name');
			$projectpra=Project::select()->get()->toArray();
			if($projectpra){
				foreach ($projectpra  as $key=>$value) {
				$praisepeo=$value['praisepeo'];
				$praisepeo=explode(',', $praisepeo);
				foreach($praisepeo as $k => $v){
	                $projectpra[$key]['pra']['parpeo'.$k] = $v;
	            }		
				}
			}
			else{
				$projectpra=$projectpra;
			}
			
			$requirementpra=Requirement::select()->get()->toArray();
			if($requirementpra){
				foreach ($requirementpra  as $key=>$value) {
				$praisepeo=$value['praisepeo'];
				$praisepeo=explode(',', $praisepeo);
				foreach($praisepeo as $k => $v){
	                $requirementpra[$key]['pra']['parpeo'.$k] = $v;
	            }		
				}
			}
			else{
				$requirementpra=$requirementpra;
			}
			$enterprisepra=Enterprise::select()->get()->toArray();
			if($enterprisepra){
				foreach ($enterprisepra  as $key=>$value) {
				$praisepeo=$value['praisepeo'];
				$praisepeo=explode(',', $praisepeo);
				foreach($praisepeo as $k => $v){
	                $enterprisepra[$key]['pra']['parpeo'.$k] = $v;
	            }		
				}
			}
			else{
				$enterprisepra=$enterprisepra;
			}

			$projectcoll=Project::select()->get()->toArray();
			if($projectcoll){
				foreach ($projectcoll  as $key=>$value) {
				$collectionpeo=$value['collectionpeo'];
				$collectionpeo=explode(',', $collectionpeo);
				foreach($collectionpeo as $k => $v){
	                $projectcoll[$key]['coll']['collpeo'.$k] = $v;
	            }		
				}
			}
			else{
				$projectcoll=$projectcoll;
			}

			
			$requirementcoll=Requirement::select()->get()->toArray();
			if($requirementcoll){
				foreach ($requirementcoll  as $key=>$value) {
				$collectionpeo=$value['collectionpeo'];
				$collectionpeo=explode(',', $collectionpeo);
				foreach($collectionpeo as $k => $v){
	                $requirementcoll[$key]['coll']['collpeo'.$k] = $v;
	            }		
				}	
			}
			else{
				$requirementcoll=$requirementcoll;
			}
			
			$enterprisecoll=Enterprise::select()->get()->toArray();
			if($enterprisecoll){
				foreach ($enterprisecoll  as $key=>$value) {
				$collectionpeo=$value['collectionpeo'];
				$collectionpeo=explode(',', $collectionpeo);
				foreach($collectionpeo as $k => $v){
	                $enterprisecoll[$key]['coll']['collpeo'.$k] = $v;
	            }		
				}
			}
			else{
				$enterprisecoll=$enterprisecoll;
			}
			
			if(!empty($list)){
				return view('findex/collection',['list'=>$list,'name'=>$name,
				'projectpra'=>$projectpra,'requirementpra'=>$requirementpra,
				'enterprisepra'=>$enterprisepra,'projectcoll'=>$projectcoll,
				'requirementcoll'=>$requirementcoll,'enterprisecoll'=>$enterprisecoll]);
			}
			else{
				$list='';
				return view('findex/collection',['data'=>$data,'list'=>$list,'name'=>$name,
				'projectpra'=>$projectpra,'requirementpra'=>$requirementpra,
				'enterprisepra'=>$enterprisepra,'projectcoll'=>$projectcoll,
				'requirementcoll'=>$requirementcoll,'enterprisecoll'=>$enterprisecoll]);
			}
	}
	public function update(Request $request){

		if($request->input('sub')){
			$id=$request->input('id');
			$name=$request->session()->get('name');
			$password=$request->input('password');
			$list=DB::table('member')
				->where('name',$name)
				->update(['password'=>$password]);
			$data=DB::table('regienterprise')
				->where('name',$name)
				->update(['password'=>$password]);
			if($list){
				return view('findex/update');
			}
			else{
				return view('findex/update');
			}

		}
		else{
			return view('findex/update');
		}
		
	}
	public function cancellation(Request $request){
		
    	$request->session()->forget('name');
		return redirect('findex/login');
	}
	public function contact(){
		//banner
		$banner=DB::table('banner')
				->get();
		return view('findex/contact',['banner'=>$banner

			]);
	}

	//公司资料添加

	public function data(Request $request){
		if($request->input('sub')){
			$id=uniqid();
			$create_uid=session('u_id');
			$create_time=time();
			$name=$request->input('name');
			$introduction=$request->input('introduction');
			$field=$request->input('field');
			$industry=$request->input('industry');
			if($industry==''){
				$industry=5;
			}
			$contact=$request->input('contact');
			$phone=$request->input('phone');
			$area=$request->input('area');
			$cooperation=$request->input('cooperation');
			if($cooperation==''){
				$cooperation=6;
			}
			$money=$request->input('money');
			if($money==''){
				$money='面议';
			}
			$en_project=$request->input('en_project');
			//图片上传	
			$file = $request->file('logo');
			if(empty($file[0])){
				$filename='';
			}
			else{
				$upload=$this->upload($file);
				$filename=implode(',', $upload);
			}
			$data=DB::table('enterprise')->insert([
				'id'=>$id,'name'=>$name,'introduction'=>$introduction,
				'field'=>$field,'industry'=>$industry,
				'logo'=>$filename,'contact'=>$contact,
				'cooperation'=>$cooperation,'money'=>$money,
				'phone'=>$phone,'en_project'=>$en_project,'area'=>$area,
				'create_uid'=>$create_uid,'update_uid'=>$create_uid,
				'create_time'=>$create_time,'update_time'=>$create_time
			]);
			if($data){
				echo '<script>alert("添加成功");window.location.href="collection";</script>';

			}else{
				echo '<script>alert("添加失败");window.location.href="data";</script>'; 

			}
		}
		else{
			$list=DB::table('industry')->get();
			$cooperation=DB::table('cooperation')->get();
			return view('findex/data',['list'=>$list,'cooperation'=>$cooperation]);
		}
	}
	//企业需求添加
	public function ente_requirement(Request $request){

		if($request->input('sub')){
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
				echo '<script>alert("添加成功");window.location.href="collection";</script>';

			}else{
				echo '<script>alert("添加失败");window.location.href="ente_requirement";</script>'; 

			}
		}
		else{
			$list=DB::table('industry')->get();
			$cooperation=DB::table('cooperation')->get();
			return view('findex/ente_requirement',['list'=>$list,'cooperation'=>$cooperation]);
		}
	}
	//通知公告
	public function notice(Request $request){
		$id=$request->input('id');
		$list=DB::table('notice')
				->where('id',$id)
				->first();
		return view('findex/notice',['list'=>$list]);
	}
}