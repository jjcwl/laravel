<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('admin/images/favicon.ico') }}" type="image/ico" />

    <title>绵阳航天军民融合服务平台后台管理</title>

    <!-- Bootstrap -->
    <link href="{{ asset('admin/vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ asset('admin/vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{ asset('admin/vendors/nprogress/nprogress.css') }}" rel="styleheet">
    <!-- iCheck -->
    <link href="{{ asset('admin/vendors/iCheck/skins/flat/green.css') }}" rel="stylesheet">
    
    <!-- bootstrap-progressbar -->
    <link href="{{ asset('admin/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css') }}" rel="stylesheet">
    <!-- JQVMap -->
    <link href="{{ asset('admin/vendors/jqvmap/dist/jqvmap.min.css') }}" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="{{ asset('admin/vendors/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="{{ asset('admin/build/css/custom.min.css') }}" rel="stylesheet">
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="index.html" class="site_title"> <span>绵阳航天军民融合</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="{{ asset('admin/images/img.jpg') }}" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2>{{ Session::get('u_name') }}</h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>{{ Session::get('r_name') }}</h3>
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-users"></i> 用户管理 <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{url('user/index')}}">用户列表</a></li>
                      <li><a href="{{url('user/add')}}">用户添加</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-user"></i> 角色管理 <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{url('role/index')}}">角色列表</a></li>
                      <li><a href="{{url('role/add')}}">角色添加</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-desktop"></i> 权限管理 <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{url('permissions/index')}}">权限列表</a></li>
                      <li><a href="{{url('permissions/add')}}">权限添加</a></li>
                    </ul>
                  </li>
<!--                   <li><a><i class="fa fa-sitemap"></i> 内容管理 <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="{{url('article/index')}}">文章管理</a></li>
                        <li><a href="{{url('hot/index')}}">热点管理</a></li>
                        <li><a href="#level1_2">附件管理</a></li>
                    </ul>
                  </li>  -->
                  <li><a><i class="fa fa-bar-chart-o"></i> 项目库管理 <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{url('project/index')}}">项目库列表</a></li>
                      <li><a href="{{url('project/add')}}">项目添加</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-clone"></i>需求管理 <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{url('requirement/index')}}">需求列表</a></li>
                      <li><a href="{{url('requirement/add')}}">需求添加</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-clone"></i>企业名录 <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{url('enterprise/index')}}">企业列表</a></li>
                      <li><a href="{{url('enterprise/add')}}">企业添加</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-clone"></i>基地介绍<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{url('introduce/index')}}">基地介绍</a></li>
                      <li><a href="{{url('introduce/add')}}">内容添加</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-clone"></i>banner<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{url('banner/index')}}">banner展示</a></li>
                      <li><a href="{{url('banner/add')}}">banner添加</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-clone"></i>通知公告<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{url('notice/index')}}">通知公告</a></li>
                      <li><a href="{{url('notice/add')}}">通知添加</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-clone"></i>会员管理<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{url('member/index')}}">会员显示</a></li>
                      <li><a href="{{url('member/add')}}">会员添加</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-clone"></i>企业会员管理<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{url('regienterprise/index')}}">企业会员显示</a></li>
                      <li><a href="{{url('regienterprise/add')}}">企业会员添加</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-clone"></i>行业管理<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{url('industry/index')}}">行业显示</a></li>
                      <li><a href="{{url('industry/add')}}">行业添加</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-clone"></i>合作机构<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{url('agency/index')}}">合作机构显示</a></li>
                      <li><a href="{{url('agency/add')}}">合作机构添加</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-clone"></i>资讯热点<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{url('investment/index')}}">资讯热点显示</a></li>
                      <li><a href="{{url('investment/add')}}">资讯热点添加</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-clone"></i>资讯热点类型<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{url('hot/index')}}">资讯热点类型显示</a></li>
                      <li><a href="{{url('hot/add')}}">资讯热点类型添加</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-clone"></i>投融资服务<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{url('investments/index')}}">投融资显示</a></li>
                      <li><a href="{{url('investments/add')}}">投融资添加</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-clone"></i>资料下载<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{url('download/index')}}">资料显示</a></li>
                      <li><a href="{{url('download/add')}}">资料添加</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-clone"></i>资料下载类型<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{url('downtype/index')}}">资料类型显示</a></li>
                      <li><a href="{{url('downtype/add')}}">资料类型添加</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-clone"></i>合作方式类型<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{url('cooperation/index')}}">合作方式类型显示</a></li>
                      <li><a href="{{url('cooperation/add')}}">合作方式类型添加</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-clone"></i>技术来源类型<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{url('source/index')}}">技术来源显示</a></li>
                      <li><a href="{{url('source/add')}}">技术来源添加</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-clone"></i>成熟度类型<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{url('mature/index')}}">成熟度显示</a></li>
                      <li><a href="{{url('mature/add')}}">成熟度添加</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-clone"></i>用户留言<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{url('message/index')}}">留言显示</a></li>
                    </ul>
                  </li>
                </ul>
              </div>

            </div>
            <!-- /sidebar menu -->

          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="{{ asset('admin/images/img.jpg') }}" alt="">{{ Session::get('u_name') }}
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="javascript:;"> Profile</a></li>
                    <li>
                      <a href="javascript:;">
                        <span class="badge bg-red pull-right">50%</span>
                        <span>Settings</span>
                      </a>
                    </li>
                    <li><a href="javascript:;">Help</a></li>
                    <li><a href="login.html"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>

                <li role="presentation" class="dropdoqwn">

                 
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main" style="padding-top:60px;box-sizing: content-box;">
         
            @yield('content')

          <div style="clear:both"></div>
        </div>
        <!-- /page content -->

      </div>
    </div>

    <!-- jQuery -->
    <script src="{{ asset('admin/vendors/jquery/dist/jquery.min.js') }}"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('admin/vendors/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <!-- FastClick -->
    <script src="{{ asset('admin/vendors/fastclick/lib/fastclick.js') }}"></script>
    <!-- NProgress -->
    <script src="{{ asset('admin/vendors/nprogress/nprogress.js') }}"></script>
    <!-- Chart.js -->
    <script src="{{ asset('admin/vendors/Chart.js/dist/Chart.min.js') }}"></script>
    <!-- gauge.js -->
    <script src="{{ asset('admin/vendors/gauge.js/dist/gauge.min.js') }}"></script>
    <!-- bootstrap-progressbar -->
    <script src="{{ asset('admin/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js') }}"></script>
    <!-- iCheck -->
    <script src="{{ asset('admin/vendors/iCheck/icheck.min.js') }}"></script>
    <!-- Skycons -->
    <script src="{{ asset('admin/vendors/skycons/skycons.js') }}"></script>
    <!-- Flot -->
    <script src="{{ asset('admin/vendors/Flot/jquery.flot.js') }}"></script>
    <script src="{{ asset('admin/vendors/Flot/jquery.flot.pie.js') }}"></script>
    <script src="{{ asset('admin/vendors/Flot/jquery.flot.time.js') }}"></script>
    <script src="{{ asset('admin/vendors/Flot/jquery.flot.stack.js') }}"></script>
    <script src="{{ asset('admin/vendors/Flot/jquery.flot.resize.js') }}"></script>
    <!-- Flot plugins -->
    <script src="{{ asset('admin/vendors/flot.orderbars/js/jquery.flot.orderBars.js') }}"></script>
    <script src="{{ asset('admin/vendors/flot-spline/js/jquery.flot.spline.min.js') }}"></script>
    <script src="{{ asset('admin/vendors/flot.curvedlines/curvedLines.js') }}"></script>
    <!-- DateJS -->
    <script src="{{ asset('admin/vendors/DateJS/build/date.js') }}"></script>
    <!-- JQVMap -->
    <script src="{{ asset('admin/vendors/jqvmap/dist/jquery.vmap.js') }}"></script>
    <script src="{{ asset('admin/vendors/jqvmap/dist/maps/jquery.vmap.world.js') }}"></script>
    <script src="{{ asset('admin/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js') }}"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="{{ asset('admin/vendors/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('admin/vendors/bootstrap-daterangepicker/daterangepicker.js') }}"></script>

    <!-- Custom Theme Scripts -->
    <script src="{{ asset('admin/build/js/custom.min.js') }}"></script>
    <!-- ueditor-mz 配置文件 -->
    <script type="text/javascript" src="{{asset('admin/ueditor-mz/ueditor.config.js')}}"></script>
    <!-- 编辑器源码文件 -->
    <script type="text/javascript" src="{{asset('admin/ueditor-mz/ueditor.all.js')}}"></script>
    <!-- 实例化编辑器 -->
    <script type="text/javascript">
    var ue = UE.getEditor('ue-container');
    ue.ready(function(){
        ue.execCommand('serverparam', '_token', '{{ csrf_token() }}');
    });
    </script>
    
    <script type="text/javascript">
     function del(e){
          let ev = e || window.event;
          let src = ev.srcElement || ev.target;
          let del = confirm('是否删除');
          if(del == true){
              console.log(src)
              window.location.href=src.getAttribute("alt");
          }
      }
    </script>
  </body>
</html>
