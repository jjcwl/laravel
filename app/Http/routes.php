<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::get('user/index', 'UserController@index');
Route::get('user/add', 'UserController@add');
Route::get('user/del', 'UserController@del');
Route::any('user/mod', 'UserController@mod');
Route::any('user/role', 'UserController@role');
Route::get('user/login', 'UserController@login');

Route::get('role/index', 'RoleController@index');
Route::get('role/add', 'RoleController@add');
Route::any('role/mod', 'RoleController@mod');
Route::get('role/del', 'RoleController@del');
Route::get('role/login', 'RoleController@login');
Route::any('role/permissions', 'RoleController@permissions');

Route::get('permissions/index', 'PermissionsController@index');
Route::get('login', 'LoginController@login');
Route::get('permissions/add', 'PermissionsController@add');
Route::get('permissions/mod', 'PermissionsController@mod');
Route::get('permissions/del', 'PermissionsController@del');
Route::get('permissions/login', 'PermissionsController@login');


Route::get('project/index', 'ProjectController@index');
Route::any('project/add', 'ProjectController@add');
Route::get('project/del', 'ProjectController@del');
Route::any('project/mod', 'ProjectController@mod');
Route::any('project/export', 'ProjectController@export');
Route::any('project/uploads', 'ProjectController@uploads');
Route::any('project/unpack', 'ProjectController@unpack');
Route::get('project/login', 'ProjectController@login');

Route::get('requirement/index', 'RequirementController@index');
Route::any('requirement/add', 'RequirementController@add');
Route::get('requirement/del', 'RequirementController@del');
Route::any('requirement/mod', 'RequirementController@mod');
Route::any('requirement/export', 'RequirementController@export');
Route::any('requirement/uploads', 'RequirementController@uploads');
Route::get('requirement/login', 'RequirementController@login');

Route::get('enterprise/index', 'EnterpriseController@index');
Route::any('enterprise/add', 'EnterpriseController@add');
Route::get('enterprise/del', 'EnterpriseController@del');
Route::any('enterprise/mod', 'EnterpriseController@mod');
Route::get('enterprise/login', 'EnterpriseController@login');

Route::get('introduce/index', 'IntroduceController@index');
Route::any('introduce/add', 'IntroduceController@add');
Route::get('introduce/del', 'IntroduceController@del');
Route::any('introduce/mod', 'IntroduceController@mod');
Route::get('introduce/login', 'IntroduceController@login');

Route::get('banner/index', 'BannerController@index');
Route::any('banner/add', 'BannerController@add');
Route::get('banner/del', 'BannerController@del');
Route::any('banner/mod', 'BannerController@mod');
Route::get('banner/login', 'BannerController@login');

Route::get('notice/index', 'NoticeController@index');
Route::get('notice/add', 'NoticeController@add');
Route::get('notice/del', 'NoticeController@del');
Route::get('notice/mod', 'NoticeController@mod');
Route::get('notice/login', 'NoticeController@login');

Route::get('member/index', 'MemberController@index');
Route::any('member/add', 'MemberController@add');
Route::get('member/del', 'MemberController@del');
Route::any('member/mod', 'MemberController@mod');
Route::get('member/login', 'MemberController@login');

Route::get('regienterprise/index', 'RegienterpriseController@index');
Route::any('regienterprise/add', 'RegienterpriseController@add');
Route::get('regienterprise/del', 'RegienterpriseController@del');
Route::any('regienterprise/mod', 'RegienterpriseController@mod');
Route::get('regienterprise/login', 'RegienterpriseController@login');

Route::get('industry/index', 'IndustryController@index');
Route::get('industry/add', 'IndustryController@add');
Route::get('industry/del', 'IndustryController@del');
Route::get('industry/mod', 'IndustryController@mod');
Route::get('industry/login', 'IndustryController@login');

Route::get('hot/index', 'HotController@index');
Route::get('hot/add', 'HotController@add');
Route::get('hot/del', 'HotController@del');
Route::get('hot/mod', 'HotController@mod');
Route::get('hot/login', 'HotController@login');

Route::get('agency/index', 'AgencyController@index');
Route::any('agency/add', 'AgencyController@add');
Route::get('agency/del', 'AgencyController@del');
Route::any('agency/mod', 'AgencyController@mod');
Route::get('agency/login', 'AgencyController@login');

Route::get('investment/index', 'InvestmentController@index');
Route::any('investment/add', 'InvestmentController@add');
Route::get('investment/del', 'InvestmentController@del');
Route::any('investment/mod', 'InvestmentController@mod');
Route::get('investment/login', 'InvestmentController@login');

Route::get('investments/index', 'InvestmentsController@index');
Route::get('investments/add', 'InvestmentsController@add');
Route::get('investments/del', 'InvestmentsController@del');
Route::get('investments/mod', 'InvestmentsController@mod');
Route::get('investments/login', 'InvestmentsController@login');

Route::get('download/index', 'DownloadController@index');
Route::any('download/add', 'DownloadController@add');
Route::get('download/del', 'DownloadController@del');
Route::any('download/mod', 'DownloadController@mod');
Route::get('download/login', 'DownloadController@login');

Route::get('downtype/index', 'DowntypeController@index');
Route::any('downtype/add', 'DowntypeController@add');
Route::get('downtype/del', 'DowntypeController@del');
Route::any('downtype/mod', 'DowntypeController@mod');
Route::get('downtype/login', 'DowntypeController@login');

Route::get('cooperation/index', 'CooperationController@index');
Route::get('cooperation/add', 'CooperationController@add');
Route::get('cooperation/del', 'CooperationController@del');
Route::get('cooperation/mod', 'CooperationController@mod');
Route::get('cooperation/login', 'CooperationController@login');

Route::get('mature/index', 'MatureController@index');
Route::get('mature/add', 'MatureController@add');
Route::get('mature/del', 'MatureController@del');
Route::get('mature/mod', 'MatureController@mod');
Route::get('mature/login', 'MatureController@login');

Route::get('source/index', 'SourceController@index');
Route::get('source/add', 'SourceController@add');
Route::get('source/del', 'SourceController@del');
Route::get('source/mod', 'SourceController@mod');
Route::get('source/login', 'SourceController@login');


Route::get('/', 'FindexController@index');
Route::get('findex/base', 'FindexController@base');
Route::any('findex/project', 'FindexController@project');
Route::get('findex/requirement', 'FindexController@requirement');
Route::get('findex/patent', 'FindexController@patent');
Route::get('findex/enterprise', 'FindexController@enterprise');
Route::get('findex/investment', 'FindexController@investment');
Route::get('findex/download', 'FindexController@download');
Route::any('findex/pro_details', 'FindexController@pro_details');
Route::any('findex/requ_details', 'FindexController@requ_details');
Route::any('findex/info_details', 'FindexController@info_details');
Route::any('findex/ente_details', 'FindexController@ente_details');
Route::get('findex/login', 'FindexController@login');
Route::any('findex/registration', 'FindexController@registration');
Route::get('findex/collection', 'FindexController@collection');
Route::get('findex/update', 'FindexController@update');
Route::any('findex/praise', 'FindexController@praise');
Route::get('findex/cancellation', 'FindexController@cancellation');
Route::get('findex/contact', 'FindexController@contact');
Route::get('findex/information', 'FindexController@information');
Route::any('findex/ente_requirement', 'FindexController@ente_requirement');
Route::get('findex/chat', 'FindexController@chat');
Route::get('findex/notice', 'FindexController@notice');
Route::any('findex/data', 'FindexController@data');
Route::any('findex/projectLibrary', 'ExtendXbController@projectLibrary');

Route::get('message/index', 'MessageController@index');
Route::any('message/mod', 'MessageController@mod');
Route::get('message/del', 'MessageController@del');
Route::get('message/login', 'MessageController@login');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);


