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
class ExtendXbController extends Controller{	
	public function projectLibrary(Request $request) {
		$res=DB::table('projectTable')->orderBy('pro_id','desc')->paginate(20);;
		$banner=DB::table('banner')->get();
		
		//$invtmt = DB::table('investment')->select(DB::raw('id, pis'))->groupBy('pid')->get()->toArray();
		//$invtmt =  DB::select('select pid,GROUP_CONCAT(create_time) as time,GROUP_CONCAT(id) as id from investment group by pid');
		//$invtmt = DB::select('select a.pid,GROUP_CONCAT(a.id) from investment a left join investment b on a.pid=b.pid group by a.pid');
		//return $invtmt;
		return view('findex/projectLibrary',['projectLibrary'=>$res,'banner'=>$banner]);
	}
}