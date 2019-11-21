@extends('..layouts.structure')
@section('title','รายการอาหาร')
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
                  <li class="{{url('category/material_group')}}">รายการอาหาร</li>
                </ol>
              </section>

              <!-- Main content -->
              <section class="content">

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

                <div class="row">
                    <div class="col-md-12">
                            <div id="form_modal"></div>
                        <div class="box">
                          <div class="box-header with-border">
            <div class="box-title">รายการอาหาร
                             </div>
                    {{-- @if (Session::get('auth')['role_id'] ==='1')
                            <div class="box-tools pull-right">

                              <div class="btn-group">
                                <button type="button" class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                จัดการ &nbsp; <i class="fa fa-wrench"></i> </button>
                                <ul class="dropdown-menu" role="menu">
                                  <li><a href="{{asset('/public/dist/file/ตัวอย่างไฟล์ Import รายการอาหาร.xlsx')}}" download>ตัวอย่าง import</a></li>
                                  <li><a  href="{{url('category/import_foods_group')}}">Import Excel</a></li>
                                  <li><a href="{{url('category/export_excel_foods_group')}}">Export Excel</a></li>
                                </ul>
                              </div>
                            </div>
                    @endif --}}
                          </div>

                          <div class="box-body" id="content">  </div>


                        </div>
                    </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->

                <!-- Main row -->

              </section>
              <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->


                    <script>
                        $(document).ready(function () {
                            getTable();
                        });

                        function add_showform() {
                             $.ajax({
                                type: "get",
                                url: "{{url('category/form_foods_group')}}",
                                data: {
                                    _token : '{{csrf_token()}}',
                                },
                                datatype: 'json'
                              })
                            .done(function (res) {
                                $('#form_modal').html(res);
                                $('#form_foods_material').modal();
                                })
                            .fail(function (jqXHR, textStatus, errorThrown) {
                              alert('เกิดข้อผิดพลาด')
                              $('#form_modal').html('');
                            });

                        }

                    function getTable() {
                      var img = '<center><img src="{{asset("public/images/loading.gif")}}" class="user-image" alt="User Image"></center>';
                      $('#content').html(img);
                            $.ajax({
                                type: "post",
                                url: "{{url('food/getTable_foods')}}",
                                data: {
                                    _token : '{{ csrf_token()}}',
                                },
                            }).done(function (res) {
                                $('#content').html(res);
                                })
                            .fail(function (jqXHR, textStatus, errorThrown) {
                              alert('เกิดข้อผิดพลาด')
                              $('#content').html('');
                            });
                        }

                        function view(docno) {
                              window.open("{{url('food/view')}}?docno="+docno+"", '_blank');
                        }


                  </script>
@endsection
