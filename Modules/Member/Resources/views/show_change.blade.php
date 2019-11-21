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
                            <div class="tab-pane" id="activity">
                              <!-- Post -->
                              <div class="post">
                                <div class="user-block">
                                  <img class="img-circle img-bordered-sm" src="../../dist/img/user1-128x128.jpg" alt="user image">
                                      <span class="username">
                                        <a href="#">Jonathan Burke Jr.</a>
                                        <a href="#" class="pull-right btn-box-tool"><i class="fa fa-times"></i></a>
                                      </span>
                                  <span class="description">Shared publicly - 7:30 PM today</span>
                                </div>
                                <!-- /.user-block -->
                                <p>
                                  Lorem ipsum represents a long-held tradition for designers,
                                  typographers and the like. Some people hate it and argue for
                                  its demise, but others ignore the hate as they create awesome
                                  tools to help create filler text for everyone from bacon lovers
                                  to Charlie Sheen fans.
                                </p>
                                <ul class="list-inline">
                                  <li><a href="#" class="link-black text-sm"><i class="fa fa-share margin-r-5"></i> Share</a></li>
                                  <li><a href="#" class="link-black text-sm"><i class="fa fa-thumbs-o-up margin-r-5"></i> Like</a>
                                  </li>
                                  <li class="pull-right">
                                    <a href="#" class="link-black text-sm"><i class="fa fa-comments-o margin-r-5"></i> Comments
                                      (5)</a></li>
                                </ul>

                                <input class="form-control input-sm" type="text" placeholder="Type a comment">
                              </div>
                              <!-- /.post -->

                              <!-- Post -->
                              <div class="post clearfix">
                                <div class="user-block">
                                  <img class="img-circle img-bordered-sm" src="../../dist/img/user7-128x128.jpg" alt="User Image">
                                      <span class="username">
                                        <a href="#">Sarah Ross</a>
                                        <a href="#" class="pull-right btn-box-tool"><i class="fa fa-times"></i></a>
                                      </span>
                                  <span class="description">Sent you a message - 3 days ago</span>
                                </div>
                                <!-- /.user-block -->
                                <p>
                                  Lorem ipsum represents a long-held tradition for designers,
                                  typographers and the like. Some people hate it and argue for
                                  its demise, but others ignore the hate as they create awesome
                                  tools to help create filler text for everyone from bacon lovers
                                  to Charlie Sheen fans.
                                </p>

                                <form class="form-horizontal">
                                  <div class="form-group margin-bottom-none">
                                    <div class="col-sm-9">
                                      <input class="form-control input-sm" placeholder="Response">
                                    </div>
                                    <div class="col-sm-3">
                                      <button type="submit" class="btn btn-danger pull-right btn-block btn-sm">Send</button>
                                    </div>
                                  </div>
                                </form>
                              </div>
                              <!-- /.post -->

                              <!-- Post -->
                              <div class="post">
                                <div class="user-block">
                                  <img class="img-circle img-bordered-sm" src="../../dist/img/user6-128x128.jpg" alt="User Image">
                                      <span class="username">
                                        <a href="#">Adam Jones</a>
                                        <a href="#" class="pull-right btn-box-tool"><i class="fa fa-times"></i></a>
                                      </span>
                                  <span class="description">Posted 5 photos - 5 days ago</span>
                                </div>
                                <!-- /.user-block -->
                                <div class="row margin-bottom">
                                  <div class="col-sm-6">
                                    <img class="img-responsive" src="../../dist/img/photo1.png" alt="Photo">
                                  </div>
                                  <!-- /.col -->
                                  <div class="col-sm-6">
                                    <div class="row">
                                      <div class="col-sm-6">
                                        <img class="img-responsive" src="../../dist/img/photo2.png" alt="Photo">
                                        <br>
                                        <img class="img-responsive" src="../../dist/img/photo3.jpg" alt="Photo">
                                      </div>
                                      <!-- /.col -->
                                      <div class="col-sm-6">
                                        <img class="img-responsive" src="../../dist/img/photo4.jpg" alt="Photo">
                                        <br>
                                        <img class="img-responsive" src="../../dist/img/photo1.png" alt="Photo">
                                      </div>
                                      <!-- /.col -->
                                    </div>
                                    <!-- /.row -->
                                  </div>
                                  <!-- /.col -->
                                </div>
                                <!-- /.row -->

                                <ul class="list-inline">
                                  <li><a href="#" class="link-black text-sm"><i class="fa fa-share margin-r-5"></i> Share</a></li>
                                  <li><a href="#" class="link-black text-sm"><i class="fa fa-thumbs-o-up margin-r-5"></i> Like</a>
                                  </li>
                                  <li class="pull-right">
                                    <a href="#" class="link-black text-sm"><i class="fa fa-comments-o margin-r-5"></i> Comments
                                      (5)</a></li>
                                </ul>

                                <input class="form-control input-sm" type="text" placeholder="Type a comment">
                              </div>
                              <!-- /.post -->
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="timeline">
                              <!-- The timeline -->
                              <ul class="timeline timeline-inverse">
                                <!-- timeline time label -->
                                <li class="time-label">
                                      <span class="bg-red">
                                        10 Feb. 2014
                                      </span>
                                </li>
                                <!-- /.timeline-label -->
                                <!-- timeline item -->
                                <li>
                                  <i class="fa fa-envelope bg-blue"></i>

                                  <div class="timeline-item">
                                    <span class="time"><i class="fa fa-clock-o"></i> 12:05</span>

                                    <h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3>

                                    <div class="timeline-body">
                                      Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                                      weebly ning heekya handango imeem plugg dopplr jibjab, movity
                                      jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                                      quora plaxo ideeli hulu weebly balihoo...
                                    </div>
                                    <div class="timeline-footer">
                                      <a class="btn btn-primary btn-xs">Read more</a>
                                      <a class="btn btn-danger btn-xs">Delete</a>
                                    </div>
                                  </div>
                                </li>
                                <!-- END timeline item -->
                                <!-- timeline item -->
                                <li>
                                  <i class="fa fa-user bg-aqua"></i>

                                  <div class="timeline-item">
                                    <span class="time"><i class="fa fa-clock-o"></i> 5 mins ago</span>

                                    <h3 class="timeline-header no-border"><a href="#">Sarah Young</a> accepted your friend request
                                    </h3>
                                  </div>
                                </li>
                                <!-- END timeline item -->
                                <!-- timeline item -->
                                <li>
                                  <i class="fa fa-comments bg-yellow"></i>

                                  <div class="timeline-item">
                                    <span class="time"><i class="fa fa-clock-o"></i> 27 mins ago</span>

                                    <h3 class="timeline-header"><a href="#">Jay White</a> commented on your post</h3>

                                    <div class="timeline-body">
                                      Take me to your leader!
                                      Switzerland is small and neutral!
                                      We are more like Germany, ambitious and misunderstood!
                                    </div>
                                    <div class="timeline-footer">
                                      <a class="btn btn-warning btn-flat btn-xs">View comment</a>
                                    </div>
                                  </div>
                                </li>
                                <!-- END timeline item -->
                                <!-- timeline time label -->
                                <li class="time-label">
                                      <span class="bg-green">
                                        3 Jan. 2014
                                      </span>
                                </li>
                                <!-- /.timeline-label -->
                                <!-- timeline item -->
                                <li>
                                  <i class="fa fa-camera bg-purple"></i>

                                  <div class="timeline-item">
                                    <span class="time"><i class="fa fa-clock-o"></i> 2 days ago</span>

                                    <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos</h3>

                                    <div class="timeline-body">
                                      <img src="http://placehold.it/150x100" alt="..." class="margin">
                                      <img src="http://placehold.it/150x100" alt="..." class="margin">
                                      <img src="http://placehold.it/150x100" alt="..." class="margin">
                                      <img src="http://placehold.it/150x100" alt="..." class="margin">
                                    </div>
                                  </div>
                                </li>
                                <!-- END timeline item -->
                                <li>
                                  <i class="fa fa-clock-o bg-gray"></i>
                                </li>
                              </ul>
                            </div>
                            <!-- /.tab-pane -->

                            <div class="tab-pane active" id="settings">
                              <form id="frm" action="{{url('profile/change_pass')}}" method="post" enctype="multipart/form-data"   class="form-horizontal">
                                @csrf
                                <div class="form-group">
                                            <label for="inputName" class="col-sm-2 control-label">Current Password</label>
                                            <div class="col-sm-10">
                                              <input type="password" class="form-control " required   name="CurrentPassword"  id="CurrentPassword" placeholder="Current Password">
                                          </div>
                                 </div>

                                <div class="form-group">
                                  <label for="inputName" class="col-sm-2 control-label">New Password</label>
                                  <div class="col-sm-10">
                                    <input type="password" class="form-control "  required  name="NewPassword"  id="NewPassword" placeholder="New Password">
                                </div>
                                </div>


                                <div class="form-group">
                                  <label for="inputAddress" class="col-sm-2 control-label">Confirm Password</label>

                                  <div class="col-sm-10">
                                    <input type="password" class="form-control " readonly  required name="ConfirmPassword"  id="ConfirmPassword" placeholder="Confirm Password">
                                  </div>
                                </div>


                                <div class="form-group" id="bn-s">
                                  <div class="col-sm-offset-2 col-sm-10">
                                  <a href="{{url('main')}}" style="float: right;margin-right: 1cm" class="btn btn-default">ย้อนกลับ</a>
                                 <span ><button id="btn-save" disabled type="button" style="float: right;margin-right: 0.2cm" class="btn btn-primary">เปลี่ยนรหัสผ่าน</button></span>
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
                                <img class="profile-user-img img-responsive img-circle" src="../../dist/img/user4-128x128.jpg" alt="User profile picture">

                                <h3 class="profile-username text-center">Nina Mcintire</h3>

                                <p class="text-muted text-center">Software Engineer</p>

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

                                <a href="{{url('auth/logout')}}" class="btn btn-primary btn-block"><b>ออกจากระบบ</b></a>
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

        $('#NewPassword').blur(function (e) {
             e.preventDefault();
             let num = $(this).val();
             if(num.length < 4){
                swal("รหัสผ่านน้อยกว่า 4 อักษร!")
                $("#ConfirmPassword").attr("readonly", true);
                 return false;
             }else{
                $("#ConfirmPassword").attr("readonly", false);
             }

         });

         $('#ConfirmPassword').blur(function (e) {
             e.preventDefault();
             if($(this).val() != $('#NewPassword').val()){
                swal("รหัสผ่านไม่ตรงกัน !")
                $('#btn-save').attr("disabled", true);
             }else if($(this).val() != '' && $(this).val() == $('#NewPassword').val()){
                $('#btn-save').attr("disabled", false);
             }
         });

         $('#ConfirmPassword').mouseout(function(){
            if($(this).val() != '' && $(this).val() == $('#NewPassword').val()){
                $('#btn-save').attr("disabled", false);
             }else{
                $('#btn-save').attr("disabled", true);
             }
       });
         $('#btn-save').click(function (e) {
             e.preventDefault();
              validate()
         });

        function validate() {
            var ststus = true;
            var chk_from = true;
            $('form#frm').find('input').each(function(){

                if($(this).prop('required')){
                            if(this.value == '' || this.value == null){
                                chk_from = false;
                                if(chk_from === false){
                                    swal('Warning!','กรุณากรอกข้อมูลให้ครบถ้วน','warning');
                                return false;
                                }


                            }
                        }
                });
                if(chk_from){
                  $('#frm').submit();
                }
        }

    </script>

@endsection
