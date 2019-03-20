<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Enterprise extends Model {
	
	public $table='enterprise';//这样寻找的就是没s的表
	public $timestamps = false;//使用save多出两个字段，取消掉
	
}