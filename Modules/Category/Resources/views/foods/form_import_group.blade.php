@extends('..layouts.structure')
@section('title','Import กลุ่มอาหาร')
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
                  <li class="active">Food</li>
                </ol>
              </section>

              <section class="content">

                    <div class="row">

                      <div class="col-md-9">
                            <div class="nav-tabs-custom">
                                <ul class="nav nav-tabs">


                            <li class="active"><a href="#settings" data-toggle="tab" aria-expanded="true"> <span class="glyphicon glyphicon-folder-open"></span></a></li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="settings">
                                    <form id="form" name="form" class="form-horizontal" method="post" action="{{url('category/upload_foods_group')}}" enctype="multipart/form-data" >
                                        @csrf
                                        <div class="form-group">
                                                <label for="inputAddress" class="col-sm-2 control-label">File</label>

                                                <div class="col-sm-10">
                                                        <input class="form-control" type="file" id="excle_files" name="excle_files" placeholder="อัพโหลดไฟล์" required="">
                                                        <span class="red">รองรับไฟล์ .xls และ .xlsx ขนาด 10MB เท่านั้น **</span>
                                                    </div>

                                                </div>
                                        <div class="form-group">
                                                <div class="col-sm-offset-2 col-sm-10">
                                                <a href="{{url('category/material_group')}}" style="float: right;margin-right: 1cm" class="btn btn-default">ย้อนกลับ</a>
                                                   <button id="btn-save" type="button" class="btn btn-primary" style="float: right;margin-right: 0.2cm">
                                                        <span class="glyphicon glyphicon-upload"></span> Upload
                                                      </button>
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

                    </div>
                    <!-- /.row -->

                  </section>

            </div>
            <!-- /.content-wrapper -->

            <script type="text/javascript">

                $(document).ready(function () {
                    $('#btn-save').click(function (e) {
                        e.preventDefault();
                        validateForm();

                    });
                });

                function validateForm() {
                var ststus = true;
                var chk_from = true;
                var Adjust_Name = '';

                $('form#form').find('input,select,textarea').each(function(){
                    if($(this).prop('required')){
                        if(this.value == '' || this.value == null){
                            chk_from = false;
                            swal('Warning!','กรุณากรอกข้อมูล '+$(this).attr('placeholder')+'','warning');
                            return false;
                        }
                    }
                });
                if(chk_from){
                    $('#form').submit();
                }
            }
            </script>

@endsection
