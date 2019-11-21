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
                <li><a href="{{url('auth_user')}}"><i class="fa fa-dashboard"></i> Home</a></li>
                  <li class="active">
                      @if(isset($data))
                        {{ 'Edit Users' }}
                        @else{{ 'Add Users' }} @endif
                    </li>
                </ol>
              </section>

              <!-- Main content -->
              <section class="content">
                <!-- Info boxes -->
                <div class="row">
                        <!-- left column -->
                        <div class="col-lg-offset-1 col-lg-10">
                          <!-- general form elements -->
                          <div class="box box-primary">
                            <div class="box-header with-border">
                              <h3 class="box-title">@if(isset($data))
                                {{ 'Edit Users' }}
                                @else{{ 'Add Users' }} @endif </h3>
                            </div>

                            <!-- /.box-header -->
                            <!-- form start -->
                            <form id="form" role="form"
                              method="post" enctype="multipart/form-data"
                              action="@if(isset($data))
                              {{url('auth_user/update')}}
                              @else{{url('auth_user/save')}} @endif">
                                @csrf
                                <input type="hidden" name="user_id" value="@isset($data){{$data->user_id}}@endisset">
                              <div class="box-body">
                                <div class="row">
                                <div class="col-xs-6">
                                    <div class="form-group">
                                    <label for="Username">Username</label>
                                    <input type="text" class="form-control " required  value="@isset($data){{$data->User_name}}@endisset" name="Username"  id="Username" placeholder="Username">
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="form-group">
                                    <label for="Password">Password</label>
                                    <input type="password" class="form-control " name="Password"  required id="Password" placeholder="Password">
                                    </div>
                               </div>
                               <div class="col-xs-6">
                                    <div class="form-group">
                                            <label for="Name">ชื่อ</label>
                                            <input type="text" class="form-control " value="@isset($data){{$data->name}}@endisset" name="Name" required id="Name" placeholder="Name">
                                    </div>
                                 </div>
                                 <div class="col-xs-6">
                                    <div class="form-group">
                                            <label for="Surname">นามสกุล</label>
                                            <input type="text" class="form-control " value="@isset($data){{$data->surname}}@endisset" name="Surname" required  id="Surname" placeholder="Surname">
                                    </div>
                                 </div>

                                 <div class="col-xs-6">
                                         <div class="form-group">
                                        <label for="">สิทธิ์ </label>
                                        @php
                                       /*   $role = array('1' => 'Admin',
                                          '2' => 'User', ); */
                                        @endphp
                                        <select class="form-control" name="role_id" id="" required>
                                            @foreach ($roleAll as $k =>$v)
                                        <option  <?php if(isset($data)){
                                            echo ($data->role_id===''.$v->role_id.'') ? 'selected' : '' ;
                                        }  ?>
                                         value="{{$v->role_id}}">{{$v->role_name}}</option>
                                        @endforeach
                                        </select>
                                        </div>
                                   </div>

                                 <div class="col-xs-6">
                                    <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control " value="@isset($data){{$data->email}}@endisset" name="email" required id="email" placeholder="Email">
                                    </div>
                                 </div>

                                 <div class="col-xs-6">
                                                <div class="form-group">
                                                    <label for="address">ที่อยู่</label>
                                                    <textarea id="address" class="form-control" name="address" rows="3">@isset($data){{$data->address}}@endisset</textarea>
                                                </div>
                                 </div>


                                     <div class="col-xs-6">
                                            <div class="form-group">
                                                    <label for="phone">phone</label>
                                                    <input type="phone" class="form-control " value="@isset($data){{$data->phone}}@endisset" name="phone" id="phone" placeholder="phone">
                                            </div>
                                         </div>

                               <div class="col-xs-6">
                                    <div class="form-group">
                                        <div class="checkbox">
                                        <label>
                                            <input required
                                            <?php if(isset($data)){
                                                echo ($data->status==='Y') ? 'checked' : '' ;
                                            }else{
                                                echo "checked";
                                            } ?>  name="state" type="checkbox">เปิดใช้งาน
                                        </label>

                                        </div>
                                    </div>
                                </div>

                               {{-- <div class="col-xs-6">
                                    <div class="form-group">
                                    <label for="exampleInputFile"><p class="help-block">รูปโปรไฟล์<font color="red"> (ถ้ามี)</font></p></label>
                                    <input type="file" name="file" id="file">
                                    </div>
                                </div> --}}

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

                              <!-- /.box-body -->
                              <div class="box-footer">
                                <button style="float: right" id="btn-save" type="button" class="btn btn-primary">บักทึก</button>
                              </div>

                            </form>
                          </div>


                        </div>

                      </div>
                <!-- /.row -->

              </section>
              <!-- /.content -->
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
                                <?php if(isset($data)){ ?>
                                    if($(this).attr('name') ==='Password'){
                                    chk_from = true;
                                }
                                <?php } ?>

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
