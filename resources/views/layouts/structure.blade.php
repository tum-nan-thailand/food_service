<!DOCTYPE html>
<html lang="en">
        @php
        $User = Session::get('auth');
        // print_r($User);
        if(!$User) {
            header("Location: auth/login");
            exit(0); 
        }
        @endphp
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title> @yield('title')</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.6 -->
        <link rel="stylesheet" href="{{asset('/public/bootstrap/css/bootstrap.min.css')}}">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
        <!-- DataTables -->
        <link rel="stylesheet" href="{{asset('/public/plugins/datatables/dataTables.bootstrap.css')}}">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{asset('/public/dist/css/AdminLTE.min.css')}}">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
            folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="{{asset('/public/dist/css/skins/_all-skins.min.css')}}">
        <link rel="stylesheet" href="{{asset('/public/dist/css/sweetalert.css')}}">
        <link rel="stylesheet" href="{{asset('/public/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">

         <!-- Loading -->
         <link rel="stylesheet" href="{{asset('/public/dist/css/loader-master/css-loader.css')}}">
        <!-- jQuery 2.2.3 -->
        <script src="{{asset('/public/plugins/jQuery/jquery-2.2.3.min.js')}}"></script>
        <!-- Bootstrap 3.3.6 -->
        <script src="{{asset('/public/bootstrap/js/bootstrap.min.js')}}"></script>
        <!-- DataTables -->
        <script src="{{asset('/public/plugins/datatables/jquery.dataTables.min.js')}}"></script>
        <script src="{{asset('/public/plugins/datatables/dataTables.bootstrap.min.js')}}"></script>
        <script src="{{asset('/public/dist/js/sweetalert.js')}}"></script>
        <script src="{{asset('/public/dist/js/sweetalert.min.js')}}"></script>

        <link href="{{asset('/public/dist/css/select2.css')}}" rel="stylesheet"/>
        <script src="{{asset('/public/dist/js/select2.js')}}"></script>
        <script src="{{asset('/public/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>



<style>

.button_scale:hover {
     -webkit-transform: scale(1.1);
     -moz-transform: scale(1.1);
     -o-transform: scale(1.1);
 }
 .button_scale {
     -webkit-transform: scale(0.8);
     -moz-transform: scale(0.8);
     -o-transform: scale(0.8);
     -webkit-transition-duration: 0.5s;
     -moz-transition-duration: 0.5s;
     -o-transition-duration: 0.5s;
 }
.img_show{
    transition: transform .5s; /* Animation */
}
.img_show:hover {
  transform: scale(1.2); /* (150% zoom - Note: if the zoom is too large, it will go outside of the viewport) */
}
</style>
        @yield('script_header')
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <div id="modal_loading"><div>
             <div class="wrapper">

            <header class="main-header">

                    <!-- Logo -->
                 <a href="{{url('main')}}" class="logo">
                      <!-- mini logo for sidebar mini 50x50 pixels -->
                      <span class="logo-mini"><b>F</b>S</span>
                      <!-- logo for regular state and mobile devices -->
                      <span class="logo-lg"><b>ระบบ</b>สูตรอาหาร</span>
                    </a>

                    <!-- Header Navbar: style can be found in header.less -->
                    <nav class="navbar navbar-static-top">
                      <!-- Sidebar toggle button-->
                      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                        <span class="sr-only">Toggle navigation</span>
                      </a>

                      <!-- Navbar Right Menu -->
                      <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">

                          <!-- User Account: style can be found in dropdown.less -->
                          <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                              <img src="{{asset('public/dist/img/user.png')}}" class="user-image" alt="User Image">
                              <span class="hidden-xs">
                              @isset($User)
                                {{($User['User_name'])}}
                              @endisset</span>
                            </a>
                            <ul class="dropdown-menu">
                              <!-- User image -->
                              <li class="user-header">
                                <img src="{{asset('public/dist/img/user.png')}}" class="img-circle" alt="User Image">

                                <p>
                                  {{$User['User_firstname']}} - {{$User['User_surname']}} <br>
                                  Role: <?php echo $User['role_id']=='1'?'Admin':'User'; ?>
                                  <small>  </small>
                                </p>
                              </li>
                              <!-- Menu Body -->
                              <li class="user-body">
                                <div class="row">
                                  <div class="col-xs-12 text-center time">
                                        <h1 class="animated fadeInLeft">{{date('H:i')}}</h1>
                                        <p class="animated fadeInRight">{{date('Y-m-d H:i:s')}}</p>
                                  </div>
                                </div>
                                <!-- /.row -->
                              </li>
                              <!-- Menu Footer-->
                              <li class="user-footer">
                                <div class="pull-left">
                                  <a href="{{url('profile')}}" class="btn btn-default btn-flat">Profile</a>
                                </div>
                                <div class="pull-right">
                                <a href="{{url('auth/logout')}}" class="btn btn-default btn-flat">Sign out</a>
                                </div>
                              </li>
                            </ul>
                          </li>
                          <!-- Control Sidebar Toggle Button -->
                          <li>
                            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                          </li>
                        </ul>
                      </div>

                    </nav>
                  </header>
                  <!-- Left side column. contains the logo and sidebar -->


            <aside class="main-sidebar">
                    <!-- sidebar: style can be found in sidebar.less -->
                    <section class="sidebar">
                      <!-- Sidebar user panel -->
                      <div class="user-panel">
                        <div class="pull-left image">
                          <img src="{{asset('public/dist/img/user.png')}}" class="img-circle" alt="User Image">
                        </div>
                        <div class="pull-left info">
                          <p> @isset($User)
                                {{($User['User_name'])}}
                              @endisset</p>
                          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                        </div>
                      </div>
                      <!-- search form -->
                      <form action="https://google.com" target="_blank" method="get" class="sidebar-form">
                        <div class="input-group">
                          <input type="text" name="q" class="form-control" placeholder="Search...">
                              <span class="input-group-btn">
                                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                                </button>
                              </span>
                        </div>
                      </form>
                      <!-- /.search form -->
                      <!-- sidebar menu: : style can be found in sidebar.less -->
                      {{-- Menuleft --}}
                      <ul class="sidebar-menu">
                        <li class="header">MAIN NAVIGATION</li>

                        <li class="treeview"><a href="{{url('main')}}">
                            <i class="fa fa-dashboard"></i><span> Dashboard</span></a></li>

                        @if ($User['role_id'] ==='1')
                        <li class="treeview">
                               <a href="#">
                                  <i class="fa fa-user"></i>
                                  <span>จัดการผู้ใช้งาน</span>
                                  <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                  </span>
                                </a>
                                <ul class="treeview-menu">
                                   <li class=""><a href="{{url('auth_user')}}"><i class="fa fa-circle-o"></i> ข้อมูลผู้ใช้งาน </a></li>

                                </ul>
                              </li>
                        @endif

                        <li class="treeview">
                          <a href="#">
                            <i class="fa  fa-list-alt"></i> <span>หมวดหมู่</span>
                            <span class="pull-right-container">
                              <i class="fa fa-angle-left pull-right"></i>
                            </span>
                          </a>
                          <ul class="treeview-menu">
                            <li><a href="{{url('category/material_group')}}"><i class="fa fa-circle-o"></i> กลุ่มวัตถุดิบ </a></li>
                            <li><a href="{{url('category/foods_group')}}"><i class="fa fa-circle-o"></i> กลุ่มอาหาร </a></li>
                          </ul>
                        </li>

                        <li class="treeview">
                                <a href="#">
                                  <i class="fa fa-briefcase"></i> <span>รายการอาหาร </span>
                                  <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                  </span>
                                </a>
                                <ul class="treeview-menu">
                                <li><a href="{{url('food')}}"><i class="fa fa-circle-o"></i>ข้อมูลรายการอาหาร</a></li>
                                @if ($User['role_id'] ==='1')
                                <li><a href="{{url('food/Form')}}">
                                    <i class="fa fa-circle-o"></i>สร้างรายการอาหาร</a>
                                </li>
                                @endif
                                </ul>
                              </li>

                        <li><a href="{{url('Calculate')}}"><i class="fa fa-book"></i> <span>คำนวณ</span></a></li>

                        {{-- <li class="treeview">
                                <a href="#">
                                  <i class="fa fa-table"></i> <span>ออกใบสั่งของ</span>
                                  <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                  </span>
                                </a>
                                <ul class="treeview-menu">
                                  <li><a href="pages/tables/simple.html"><i class="fa fa-circle-o"></i> Simple tables</a></li>
                                  <li><a href="pages/tables/data.html"><i class="fa fa-circle-o"></i> Data tables</a></li>
                                </ul>
                              </li> --}}

                      </ul>
                    </section>
                    <!-- /.sidebar -->
                  </aside>

                @yield('content')

                <footer class="main-footer">
                        <div class="pull-right hidden-xs">
                          <b>Version</b> 1.0
                        </div>
                        <strong>Copyright &copy; 2019  </strong> ระบบสูตรอาหาร
                      </footer>

                      <!-- Control Sidebar -->
                      <aside class="control-sidebar control-sidebar-dark">

                        <!-- Tab panes -->
                        <div class="tab-content">
                          <!-- Home tab content -->
                          <div class="tab-pane" id="control-sidebar-home-tab">


                          </div>
                          <!-- /.tab-pane -->

                          <!-- Settings tab content -->
                          <div class="tab-pane" id="control-sidebar-settings-tab">
                            <form method="post">
                              <h3 class="control-sidebar-heading">General Settings</h3>

                              <div class="form-group">
                                <label class="control-sidebar-subheading">
                                  Report panel usage
                                  <input type="checkbox" class="pull-right" checked>
                                </label>

                                <p>
                                  Some information about this general settings option
                                </p>
                              </div>
                              <!-- /.form-group -->

                              <div class="form-group">
                                <label class="control-sidebar-subheading">
                                  Allow mail redirect
                                  <input type="checkbox" class="pull-right" checked>
                                </label>

                                <p>
                                  Other sets of options are available
                                </p>
                              </div>
                              <!-- /.form-group -->

                              <div class="form-group">
                                <label class="control-sidebar-subheading">
                                  Expose author name in posts
                                  <input type="checkbox" class="pull-right" checked>
                                </label>

                                <p>
                                  Allow the user to show his name in blog posts
                                </p>
                              </div>
                              <!-- /.form-group -->

                              <h3 class="control-sidebar-heading">Chat Settings</h3>

                              <div class="form-group">
                                <label class="control-sidebar-subheading">
                                  Show me as online
                                  <input type="checkbox" class="pull-right" checked>
                                </label>
                              </div>
                              <!-- /.form-group -->

                              <div class="form-group">
                                <label class="control-sidebar-subheading">
                                  Turn off notifications
                                  <input type="checkbox" class="pull-right">
                                </label>
                              </div>
                              <!-- /.form-group -->

                              <div class="form-group">
                                <label class="control-sidebar-subheading">
                                  Delete chat history
                                  <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
                                </label>
                              </div>
                              <!-- /.form-group -->
                            </form>
                          </div>
                          <!-- /.tab-pane -->
                        </div>
                      </aside>
                      <!-- /.control-sidebar -->
                      <!-- Add the sidebar's background. This div must be placed
                           immediately after the control sidebar -->
                      <div class="control-sidebar-bg"></div>
            </div>
            <div class="modal fade" id="modal_loading" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-loading" role="document">
                        <h1><i class="fa fa-refresh fa-spin fa-3x fa-fw"></i><p>Loading...</p></h1>
                    </div>
                </div>
            <!-- ./wrapper -->
            @yield('script_footer')
            <!-- SlimScroll -->
            <script src="{{asset('/public/plugins/slimScroll/jquery.slimscroll.min.js')}}"></script>
            <!-- FastClick -->
            <script src="{{asset('/public/plugins/fastclick/fastclick.js')}}"></script>
            <!-- AdminLTE App -->
            <script src="{{asset('/public/dist/js/app.min.js')}}"></script>
            <!-- AdminLTE for demo purposes -->
            <script src="{{asset('/public/dist/js/setting.js')}}"></script>
            <!-- page script -->
            <script src="{{asset('/public/dist/js/main.js')}}"></script>
             <!-- page moment -->
             <script src="{{asset('/public/dist/js/moment.js')}}"></script>

            <script>
                    $(function () {
                      $("#example1").DataTable({
                        // dom: 'lfrtip<"toolbar">',
                        // initComplete: function() {
                        //     $("div.toolbar").html('<button onclick="deleteAll()" type="button" class="btn btn-danger">ยกเลิก</button>');
                        // },
                      });
                      $('#example2').DataTable({
                        "paging": true,
                        "lengthChange": false,
                        "searching": false,
                        "ordering": true,
                        "info": true,
                        "autoWidth": false,
                      });

                    });
                    // Loading
                    $(window).bind('beforeunload', function() {
                        //   $('#modal_loading').html('<div class="loader loader-default is-active" data-text="Loading"></div>');
                          $('#modal_loading').html('<div class="loader loader-bouncing is-active"></div>');
                        // $('#modal_loading').modal({ backdrop: 'static', keyboard: false });
                    });

                  </script>

                <script>
                         var updateTime = function () {
                        var timestamp = <?php echo "'".time()."'";?>;
                        date = moment(Date(timestamp))
                        $('.time h1').html(date.format('HH:mm'));
                        // $('#date_dayly').html(date.format('dddd, MMMM Do YYYY'));
                        $('.time p').html(date.format('dddd, MMMM Do YYYY'));
                        timestamp++;
                    };

                    $(document).ready(function(){
                        updateTime();
                        setInterval(updateTime, 1000);

                    });
                    </script>
    </body>
</html>
