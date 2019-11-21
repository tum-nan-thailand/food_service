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
                  <li class="active">ImportData</li>
                </ol>
              </section>

              <section class="content">

                    <div class="row">
                        {{-- {{print_r($datas)}} --}}
                        <div class="col-xs-12 col-sm-12 col-md-12 card">

                         <div class="nav-tabs-custom">
                                <ul class="nav nav-tabs">
                             <li class="active"><a href="#settings" data-toggle="tab" aria-expanded="true"> <span class="glyphicon glyphicon-folder-open"></span> &nbsp; Import Data</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="settings">
                                    <form id="form" name="form" class="form-horizontal" method="post" action="{{url('category/upload_material_group')}}" enctype="multipart/form-data" >
                                        @csrf

                                        <div class="table-responsive">
                                            <table id="table_" class="table table-striped table-bordered table-responsive" style="width:100%">
                                                {{-- {{dd($datas)}} --}}
                                                    <thead>
                                                        <tr>
                                                            <th style="min-width:80px">รหัส</th>
                                                            <th style="min-width:180px">กลุ่ม</th>
                                                            <th style="min-width:180px">รายละเอียด </th>
                                                            <th style="min-width:100px">หน่วยนับ </th>
                                                            <th style="min-width:100px">ราคา</th>
                                                          </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($datas as $key => $v)
                                                            <tr>
                                                                <td>{{$v['group_id']}}</td>
                                                                <td>{{$v['group_name']}}</td>
                                                                <td>{{$v['detail']}}</td>
                                                                <td>{{$v['unit']}}</td>
                                                                <td>{{$v['price']}}</td>
                                                            </tr>
                                                        @endforeach


                                                    </tbody>

                                                </table>
                                                <div style="float: right">
                                                    <button style="" type="button" id="btn_save" class="btn btn-primary" onclick="checkImport()">บันทึก</button>
                                                <a  href="{{url('category/material_group')}}" class="btn btn-default"  >กลับ</a>
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
            function checkImport(){
                if(confirm("ยืนยันการบันทึกข้อมูล")){

                    var _token = '{{csrf_token()}}';
                    var jsondata = <?php echo json_encode($datas);?>;
                    console.log(jsondata)
                    $.ajax({
                        url: '{{ url("/category/material_group_checkImport") }}',
                        type: 'post',
                        //contentType: "application/json; charset=utf-8",
                        dataType: "json",
                        data: {jsondata : jsondata,_token:_token}
                    })
                    .done(function(res) {
                                if(res.status == 'success'){
                                    alert('บันทึกข้อมูลเรียบร้อย');
                                    window.location = '{{ url("category/material_group") }}';
                                    //location.reload();
                                }else{
                                    alert(res.message);
                                    return false
                                }

                        console.log("success");
                    })
                    .fail(function() {
                        console.log("error");
                    })
                    .always(function() {
                        console.log("complete");
                    });

            }
            }

            </script>

@endsection
