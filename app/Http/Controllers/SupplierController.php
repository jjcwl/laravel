<?php 
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Excel;
use App\Supplier;
use Illuminate\Support\Facades\Storage;
class SupplierController extends Controller{

	/** 
     * 供应商模块
     * 数据显示
     */
	public function index(){

		$supplier = DB::table('sx_supplier')->get();
        return view('supplier/index',['supplier'=>$supplier]);
	}

	//数据添加
	public function add(Request $request){

		if($request->input('sub')){
			$s_site=$request->input('s_site');
			$s_seed=$request->input('s_seed');
			$s_volume=$request->input('s_volume');
			if($s_site==''||$s_seed==''||$s_volume==''){
				return redirect('supplier/add');
			}
			$data=DB::table('sx_supplier')->insert([
				's_site'=>$s_site,
				's_seed'=>$s_seed,
				's_volume'=>$s_volume
			]);
			if($data){
				return redirect('supplier/index');
			}
			else{
				return redirect('supplier/add');
			}
		}
		else{
			return view('supplier/add');
		}	
	}

	//数据删除
	public function del(Request $request){

		$id=$request->input('id');
		$data=DB::table('sx_supplier')->where('s_id',$id)->delete();
		if($data){
			return redirect('supplier/index');
		}
		else{
			return redirect('supplier/index');
		}
	}

	//数据修改
	public function mod(Request $request){

		if($request->input('sub')){
			$hid=$request->input('hid');
			$s_site=$request->input('s_site');
			$s_seed=$request->input('s_seed');
			$s_volume=$request->input('s_volume');
			$list=DB::table('sx_supplier')->where('s_id',$hid)->update(['s_site'=>$s_site,
				's_seed'=>$s_seed,'s_volume'=>$s_volume,]);
			if($list=1){
				return redirect('supplier/index');
			}
			else{
				return redirect('supplie/index');
			}
		}
		else{
			$id=$request->input('id');
			$data=DB::table('sx_supplier')->where('s_id',$id)->first();
			return view('supplier/mod',['data'=>$data]);
		}
	}

	//数据导出Excel
	public function export(){

		ini_set('memory_limit','500M');
        set_time_limit(0);//设置超时限制为0分钟
        $supplier = Supplier::select()->get()->toArray();
        $suppliers = array('0'=>array('0'=>'编号','1'=>'发运站点','3'=>'煤种','4'=>'年发运量'));
        for($i=0;$i<count($supplier);$i++){
            $supplier[$i] = array_values($supplier[$i]);
            $supplier[$i][0] = str_replace('=',' '.'=',$supplier[$i][0]);
        }
        $supplier1=array_merge($suppliers,$supplier);
        Excel::create('供应商基本信息',function($excel) use ($supplier1){
            $excel->sheet('score', function($sheet) use ($supplier1){
                $sheet->rows($supplier1);
            });
        })->export('xls');
        die;
	}

	//Excel表导入
	public function uploads(Request $request){

		if($request->input('sub')){
			if(!$request->file('file')){
            	return redirect('supplier/uploads');
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
        	if(count($res)){
        		redirect('supplier/index');
        	}
        	for($i = 1;$i<count($res);$i++){
        		//如果编号重复，则结束本次循环
            	$check = Supplier::where('s_id',$res[$i][0])->count();
            if($check){
                continue;
            }
            //将excel表数据导入数据库
            $stu = new Supplier;
            $stu->s_id = $res[$i][0];
            $stu->s_site = $res[$i][1];
            $stu->s_seed = $res[$i][2];
            $stu->s_volume = $res[$i][3];
            $list=$stu->save();
        }
        	return redirect('supplier/index');
		}
		else{
			return view('supplier/uploads');
		}   
    }

    public function test()
    {
    	

    }
}