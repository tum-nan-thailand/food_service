@extends('..layouts.structure')
@section('title','ระบบสูตรอาหาร')
@section('content')

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
              <!-- Content Header (Page header) -->
              <section class="content-header">
                <h4>
<br>
                </h4>

                <ol class="breadcrumb">
                  <li><a href="{{url('main')}}"><i class="fa fa-dashboard"></i> Home</a></li>
                  <li class="active">Profile</li>
                </ol>
              </section>

              <section class="content">

                    <div class="row">

                      <div class="col-md-9">
                        <div class="nav-tabs-custom">
                          <ul class="nav nav-tabs">


                            <li class="active"><a href="#settings" data-toggle="tab" aria-expanded="true">Settings</a></li>
                          </ul>
                          <div class="tab-content">


                            <div class="tab-pane active" id="settings">
                              <form id="form" class="form-horizontal" method="post" action="{{url('profile/update')}}" enctype="multipart/form-data" >
                                   @csrf
                                <div class="form-group">
                                            <label for="inputName" class="col-sm-2 control-label">Username</label>
                                            <div class="col-sm-10">
                                              <input type="text" class="form-control " required  value="@isset($data){{$data->User_name}}@endisset" name="Username"  id="Username" placeholder="Username">
                                          </div>
                                 </div>

                                <div class="form-group">
                                  <label for="inputName" class="col-sm-2 control-label">ชื่อ</label>
                                  <div class="col-sm-10">
                                    <input type="text" class="form-control " required value="@isset($data){{$data->name}}@endisset" name="name"  id="Name" placeholder="Name">
                                </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputName" class="col-sm-2 control-label">นามสกุล</label>
                                    <div class="col-sm-10">
                                          <input type="text" class="form-control " required value="@isset($data){{$data->surname}}@endisset" name="surname"  id="surname" placeholder="surname">
                                    </div>
                                </div>
                                <div class="form-group">
                                  <label for="inputEmail" class="col-sm-2 control-label">Email</label>

                                  <div class="col-sm-10">
                                        <input type="text" class="form-control " required  value="@isset($data){{$data->email}}@endisset" name="email"  id="email" placeholder="email">
                                    </div>
                                </div>
                                <div class="form-group">
                                  <label for="inputName" class="col-sm-2 control-label">สิทธิ์</label>
                                  <div class="col-sm-10">
                                        <select class="form-control "  name="role_id" id="" >
                                    <option value="">@isset($data){{$data->role_name}}@endisset</option>
                                        </select>
                                    </div>
                                   <!--div class="col-sm-10">
                                        @php
                                        $role = array('1' => 'Admin',
                                        '2' => 'User', );
                                      @endphp
                                          <select class="form-control "  name="role_id" id="" >
                                              @foreach ($role as $k =>$v)
                                            <?php /*if(isset($data)){
                                              echo ($data->role_id===''.$k.'') ? '<option value="'.$k.'">'.$v.'</option>' : '' ;
                                          } */ ?>

                                          @endforeach
                                          </select>
                                  </div-->
                                </div>

                                <div class="form-group">
                                        <label for="phone" class="col-sm-2 control-label">เบอร์โทร</label>

                                        <div class="col-sm-10">
                                                <input type="text" class="form-control" name="phone" value="@isset($data){{$data->phone}}@endisset" id="phone" placeholder="phone">
                                        </div>
                                </div>


                                <div class="form-group">
                                  <label for="inputAddress" class="col-sm-2 control-label">Address</label>

                                  <div class="col-sm-10">
                                    <textarea class="form-control" id="inputAddress"  name="address" placeholder="Address">@isset($data){{$data->address}}@endisset</textarea>
                                  </div>
                                </div>

                                <div class="form-group">
                                  <div class="col-sm-offset-2 col-sm-10">
                                  <a href="{{url('main')}}" style="float: right;margin-right: 1cm" class="btn btn-default">ย้อนกลับ</a>
                                    <button id="btn-save" type="button" style="float: right;margin-right: 0.2cm" class="btn btn-primary">แก้ไข</button>
                                </div>
                                </div>

                                @if(\Illuminate\Support\Facades\Session::has('message'))
                                <div class="alert alert-danger">
                                    <strong><i class="fa fa-exclamation-triangle" aria-hidden="true"></i></strong> {{session('message')}}
                                </div>
                                @endif


                                  @if (count($errors) > 0)
                                  <div class = "alert alert-danger">
                                  <ul>
                                      @foreach ($errors->all() as $error)
                                          <li>{{ $error }}</li>
                                      @endforeach
                                  </ul>
                                  </div>
                              @endif
                              </form>
                            </div>
                            <!-- /.tab-pane -->
                          </div>
                          <!-- /.tab-content -->
                        </div>
                        <!-- /.nav-tabs-custom -->
                      </div>
                      <!-- /.col -->

                      <div class="col-md-3">

                            <!-- Profile Image -->
                            <div class="box box-primary">
                              <div class="box-body box-profile">
                                <img class="profile-user-img img-responsive img-circle" src="{{url('public/dist/img/user.png')}}" alt="User profile picture">
                                <h3 class="profile-username text-center">@isset($data){{$data->User_name}}@endisset</h3>

                                <p class="text-muted text-center">@isset($data){{$data->role_name}}@endisset</p>

                                <ul class="list-group list-group-unbordered">
                                  <li class="list-group-item">
                                    <b>ชื่อ</b> <a class="pull-right">@isset($data){{$data->name}}@endisset</a>
                                  </li>
                                  <li class="list-group-item">
                                    <b>นามสกุล</b> <a class="pull-right">@isset($data){{$data->surname}}@endisset</a>
                                  </li>
                                  <li class="list-group-item">
                                    <b>เบอร์โทร</b> <a class="pull-right">@isset($data){{$data->phone}}@endisset</a>
                                  </li>
                                </ul>

                                <a href="{{url('profile/change_pass')}}" class="btn btn-primary btn-block"><b>เปลี่ยนรหัสผ่าน</b></a>
                              </div>
                              <!-- /.box-body -->
                            </div>
                            <!-- /.box -->

                            <!-- About Me Box -->

                            <!-- /.box -->
                          </div>
                          <!-- /.col -->
                    </div>
                    <!-- /.row -->

                  </section>

            </div>
            <!-- /.content-wrapper -->
    <script>


         $('#btn-save').click(function (e) {
             e.preventDefault();
             validate()
         });

        function validate() {
            var ststus = true;
            var chk_from = true;
            $('form#form').find('input,select,textarea').each(function(){
                if($(this).prop('required')){
                            if(this.value == '' || this.value == null){
                                chk_from = false;
                                if(chk_from === false){
                                    swal('Warning!','กรุณากรอกข้อมูล '+$(this).attr('placeholder')+'','warning');
                                return false;
                                }
                            }
                        }
                });
                if(chk_from){
                  $('#form').submit();
                }
        }

    </script>

@endsection
