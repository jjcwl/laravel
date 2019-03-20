<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model {
	
	public $table='project';//这样寻找的就是没s的表
	public $timestamps = false;//使用save多出两个字段，取消掉
}