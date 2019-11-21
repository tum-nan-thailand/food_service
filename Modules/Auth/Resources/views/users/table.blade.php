@extends('..layouts.structure')
@section('title','จัดการผู้ใช้งาน')
@section('content')

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
              <!-- Content Header (Page header) -->
              <section class="content-header">
                <h4>
                ข้อมูลผู้ใช้งาน &nbsp;&nbsp; <a href="{{url('auth_user/form')}}" class="btn btn-success btn-sm"><i class="fa fa-plus" aria-hidden="true"></i> เพิ่มผู้ใช้</a>
                </h4>

                <ol class="breadcrumb">
                  <li><a href="{{url('main')}}"><i class="fa fa-dashboard"></i> Home</a></li>
                  <li class="{{url('auth_user')}}">User </li>
                </ol>
              </section>

              <!-- Main content -->
              <section class="content">
                <!-- Info boxes -->
                <div class="row">

                  <!-- fix for small devices only -->
                  <div class="clearfix visible-sm-block"></div>

                  <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="box">

                     <div class="box-body">
                            <form id="frm" class="form-inline" method="Post" enctype="multipart/form-data" action="http://cbglinewebdev.azurewebsites.net/Pro_Report/ExportExcel">
                                @csrf
                                <div class="form-group">
                                    <label for="text">Username:</label>
                                    <input class="form-control" type="text" required="" name="Username" id="Username" placeholder="Username">
                                </div>
                                <div class="form-group">
                                    <label for="txtdate">Name:</label>
                                    <input class="form-control" type="text" required="" name="Name" id="Name" placeholder="Name">
                                </div>

                                <div class="form-group">
                                    <label for="pwd">Surname:</label>
                                    <input class="form-control" type="text" required="" name="Surname" id="Surname" placeholder="Surname">
                                </div>

                                <button type="button" id="SearchTable" onclick="" class="btn btn-default">Search</button>
                                <!--
                                <button type="button" id="ExportExcel" onclick="" class="btn btn-default">Excel</button> -->
                            </form>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.row -->

                <div class="row">
                  <div class="col-md-12">
                    <div class="box">
                        {{-- <div class="box-header">
                                <h3 class="box-title">Users</h3>
                        </div> --}}
                        <div class="box-body"  id="data_user">  </div>
                        <span id="view"></span>
                    </div>
                    <!-- /.box -->
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->

                <!-- Main row -->
                <div align="center" class="x_content" id="report">
              </section>
              <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->


                    <script>
                        $(document).ready(function () {
                            SearchTable();
                        });

                        function SearchTable() {
                         var load = "";
                        load += '<div class="modal-backdrop fade in" style="height: 100vh;z-index:9999;position:fixed;">';
                        load += '<div style="margin: 50vh;text-align: center;"> <img src="{{asset("public/images/loading.gif")}}" width="100"></div>';
                        load += '</div>';
                        $('#report').html(load);
                            $.ajax({
                                type: "post",
                                url: "{{url('auth_user/getdata')}}",
                                data: {
                                    _token : '{{ csrf_token()}}',
                                },
                                // data: $('#frm').serialize(),
                                // dataType: "dataType",
                                // success: function (res) {
                                //     $('#data_user').html(res);
                                // }
                            }).done(function (res) {
                                $('#report').html('');
                                $('#data_user').html(res);
                                })
                            .fail(function (jqXHR, textStatus, errorThrown) {
                               alert('เกิดข้อผิดพลาด')
                               $('#report').html('');
                              $('#data_user').html('');
                            });
                        }

                        $('#SearchTable').click(function (e) {
                            e.preventDefault();
                            var img = '<center><img src="{{asset("public/images/loading.gif")}}" class="user-image" alt="User Image"></center>';
                            $('#data_user').html(img);

                            $.ajax({
                                type: "post",
                                url: "{{url('auth_user/getdata')}}",
                                data: $('#frm').serialize(),
                                // dataType: "dataType",
                                // success: function (res) {
                                //     $('#data_user').html(res);
                                // }
                            }).done(function (res) {
                                $('#data_user').html(res);
                                })
                            .fail(function (jqXHR, textStatus, errorThrown) {
                               alert('เกิดข้อผิดพลาด')
                              $('#data_user').html('');
                            });
                        });

                        function change_status(userid,state) {
                        var load = "";
                        load += '<div class="modal-backdrop fade in" style="height: 100vh;z-index:9999;position:fixed;">';
                        load += '<div style="margin: 50vh;text-align: center;"> <img src="{{asset("public/images/loading.gif")}}" width="100"></div>';
                        load += '</div>';
                        $('#report').html(load);
                            $.ajax({
                                type: "post",
                                url: "{{url('auth_user/change_status')}}",
                                data: {
                                    _token : '{{ csrf_token()}}',
                                    user_id : userid,
                                    state : state,
                                },

                                success: function (res) {
                                    $('#report').html('');
                                    SearchTable();
                                    swal("Good job!", "ดำเนินการสำเร็จ", "success");
                                }
                            });
                        }

                        function delete_(userid) {
                        var load = "";
                        load += '<div class="modal-backdrop fade in" style="height: 100vh;z-index:9999;position:fixed;">';
                        load += '<div style="margin: 50vh;text-align: center;"> <img src="{{asset("public/images/loading.gif")}}" width="100"></div>';
                        load += '</div>';
                        $('#report').html(load);
                            $.ajax({
                                type: "post",
                                url: "{{url('auth_user/delete')}}",
                                data: {
                                    _token : '{{ csrf_token()}}',
                                    user_id : userid,
                                },
                                success: function (res) {
                                    $('#report').html('');
                                    SearchTable();
                                    swal("Good job!", "ดำเนินการสำเร็จ", "success");
                                }
                            });
                        }

                        function view(userid) {
                        var load = "";
                        load += '<div class="modal-backdrop fade in" style="height: 100vh;z-index:9999;position:fixed;">';
                        load += '<div style="margin: 50vh;text-align: center;"> <img src="{{asset("public/images/loading.gif")}}" width="100"></div>';
                        load += '</div>';
                        $('#report').html(load);
                            $.ajax({
                                type: "get",
                                url: "{{url('auth_user/view')}}",
                                data: {
                                    _token : '{{ csrf_token()}}',
                                    user_id : userid,
                                },

                                success: function (res) {
                                    $('#report').html('');
                                    $('#view').html(res);
                                    $('#view_user_Modal').modal();
                                }
                            });
                        }

                  </script>
@endsection
