@extends('..layouts.structure')
@section('title','ระบบสูตรอาหาร')
@section('content')

<style>
	.box{
		padding-left: 15px;
		padding-right: 15px;
		padding-top: 2px;
	}


/* .box-body{padding-left: 30px;
    padding-right: 30px;
    padding-top: 20px;} */
    /* .food-detail-scrollbar { */
    	/* position: relative; */
    	/* height: 250px; */
    	/* overflow: auto; */
/*
}
.table-wrapper-scroll-y {
display: block;
}

#form-table {
  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#form-table td, #form-table th {
  border: 1px solid #ddd;
  padding: 8px;
}

#form-table tr:nth-child(even){background-color: #f2f2f2;}

#form-table tr:hover {background-color: #ddd;}

#form-table th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #4CAF50;
  color: white;
  } */


</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h4>
			<u> แก้ไขรายการอาหาร</u>
		</h4>

		<ol class="breadcrumb">
			<li><a href="{{url('main')}}"><i class="fa fa-dashboard"></i> Home</a></li>
			<li class="active">
				{{ 'Edit' }}
			</li>
		</ol>
	</section>

	<!-- Main content -->
	<!-- form start -->
	<form id="form" role="form"  method="post" enctype="multipart/form-data"
	action="{{url('food/listfood_edit')}}">
	@csrf
	<section class="content">
		<!-- Info boxes -->
		<div class="row">
			<!-- left column -->
			<div class="col-lg-12">
				<!-- general form elements -->
				<div id="form_modal"></div>
				<div class="box box-widget">
					<div class="box-header with-border">
						ข้อมูลรายการอาหาร
					</div>

					<!-- /.box-header -->

					<div class="box-body">
						<div class="row">
							<div class="col-xs-12">
								<table id="" class="table">
									<thead class="thead-inverse">
										<tr>
											<td style="max-width: 3cm" colspan="1">
												<input type="text"
												class="form-control form-control-sm " value="@isset($head){{$head->docno}}@endisset" required="required" name="docno" id="docno" aria-describedby="helpId" placeholder="รหัสรายการอาหาร..">
                                                <input type="hidden" name="docno_default" value="@isset($head){{$head->docno}}@endisset">
                                            </td>

											<td colspan="2">
												<input type="text"
												class="form-control form-control-sm" value="@isset($head){{$head->name_food}}@endisset" name="name_food" required="required" id="name_food" aria-describedby="helpId" placeholder="ชื่อรายการอาหาร.">
												{{-- <small id="helpId" class="form-text text-muted">รายการอาหาร..</small> --}}
											</td>
											<td colspan="3">
												<div class="col-lg-12">
													<select class="form-control form-control-sm" name="group_food" id="group_food" required="required" placeholder="กลุ่มอาหาร.">
														<option value="">..เลือกกลุ่มอาหาร..</option>
													</select>
												</div>

											</td>

										</tr>
									</thead>
									<tbody>


									</tbody>
								</table>
							</div>

						</div>
					</div>

				</div>


			</div>

		</div>

		<!-- /.row -->

		<div class="row">
			<!-- left column -->
			<div class="col-lg-12">
				<!-- general form elements -->
				<div class="box box-widget">
					<div class="box-header with-border">

						ข้อมูลวัตถุดิบ
						<span style="float: right"> <a onclick="add_showform_food()" name="" id="" class="btn btn-default btn-sm"  > <i class="fa fa-plus" aria-hidden="true"></i> </a></span>

					</div>
					<div class="clearfix"></div>
					<div class="box-body">
						<div class="row">
							<div class="col-xs-12">
								<div class="table-wrapper-scroll-y food-detail-scrollbar" id="content_details_list_food">

								</div>
							</div>
						</div>
					</div>


				</div>
			</div>
		</div>

		<!-- /.row -->

		<div class="row">
			<!-- left column -->
			<div class="col-lg-12">
				<!-- general form elements -->
				<div class="box box-widget">
					<div class="box-header with-border">
						<div style="text-align: center" ><i class="fa fa-fax"></i> &nbsp; <u>ข้อมูลรายละเอียด</u>  </div>
					</div>
					<div class="clearfix"></div><br>
					<div class="box-body">
						<div class="row">
							<div class="col-xs-12 col-sm-3" >
								<div><img  style="max-width: 250px; max-height: 360px;text-align: center " id="img_das" class="img-thumbnail" src="{{url('/public/'.$head->img.'')}}" alt="">
									<br>   <img  class="img_show" id="blah" style="max-width: 250px; max-height: 360px;text-align: center " src="#" alt="your image" />
								</div>

							</div>
							<div class="col-xs-12 col-sm-8">
								<div class="form-group">
									<label for="">รายละเอียดวิธีการทำ</label>
                                    <textarea id="detail" class="textarea"
                                     required="required" placeholder="...รายละเอียด."
                                     class="form-control"
                                     style="width: 100%; height: 200px; font-size: 14px;
                                      line-height: 18px; border: 1px solid #dddddd;
                                      padding: 10px;" name="detail"
                                      rows="10" cols="80">@isset($head){{$head->detail}}@endisset
                                    </textarea>
								</div>
								<div class="form-group">
									<label for="">รูปภาพ</label>
									<input  accept="image/*" type="file" required="required" class="form-control-file"  placeholder="รูปภาพ." name="file" id="imgInp" placeholder="" aria-describedby="fileHelpId">



									{{-- <small id="fileHelpId" class="form-text text-muted"></small> --}}
								</div>
							</div>
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
						{{-- <button style="float: right" id="btn-save_submit" type="button" class="btn btn-primary">บักทึก</button> --}}
						<a class="btn btn-app" style="float: right" id="btn-save_submit">
							<i class="fa fa-save"></i> Save
						</a>
					</div>

				</div>
			</div>
		</div>
		<div class="clearfix"></div><br>

		<div align="center" class="x_content" id="report">

		</div>

	</section>

</form>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script>
    $(document).ready(function () {
      get_table_form_tmp();
    });
	$(document).ready(function () {

        // set Data
        var id ='';
        <?php if(isset($head->group_food)){ ?>
        	id = '{{$head->group_food}}';
        	<?php } ?>
        	$.ajax({
        		type: "get",
        		url: "{{url('food/Selected_group_food')}}",
        		data: {
        			_token : '{{csrf_token()}}',
        			id:id,
        		},
        		datatype: 'json'
        	})
        	.done(function (res) {
        		$('#group_food').html(res);
        	})
        	.fail(function (jqXHR, textStatus, errorThrown) {
			// alert('เกิดข้อผิดพลาด')
			location.reload();
		});

        	/*********************set Data/************************/


        	/*****************************************/
        // CKEDITOR.replace('detail');
    //bootstrap WYSIHTML5 - text editor
    $(".textarea").wysihtml5();

    $('#blah').hide();
    $('#group_food').change(function (e) {
    	e.preventDefault();
    });

    $("#imgInp").change(function() {
    	readURL(this);
    });


});


function get_table_form_tmp() {
        var docno ='';
            <?php if(isset($head->docno)){ ?>
                docno = '{{$head->docno}}';
                <?php } ?>
        var load = "";
            load += '<div class="modal-backdrop fade in" style="height: 100vh;z-index:9999;position:fixed;">';
            load += '<div style="margin: 50vh;text-align: center;"> <img src="{{asset("public/images/loading.gif")}}" width="100"></div>';
            load += '</div>';
            $('#report').html(load);
            $.ajax({
                type: "get",
                url: "{{url('food/get_table_Edit_food')}}",
                data: {
                    _token : '{{csrf_token()}}',
                    docno:docno,
                },
                datatype: 'json'
            })
            .done(function (res) {
                $('#report').html('');
                $('#content_details_list_food').html(res);
            })
            .fail(function (jqXHR, textStatus, errorThrown) {
                // location.reload();
            });
        }
	function readURL(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();

			reader.onload = function(e) {
				$('#img_das').hide();
				$('#blah').show();
				$('#blah').attr('src', e.target.result);
			}

			reader.readAsDataURL(input.files[0]);
		}
	}



	function Selected_group_food() {
		var id ='';
		<?php if(isset($head->group_food)){ ?>
			id = '{{$head->group_food}}';
			<?php } ?>
			$.ajax({
				type: "get",
				url: "{{url('food/Selected_group_food')}}",
				data: {
					_token : '{{csrf_token()}}',
					id:id,
				},
				datatype: 'json'
			})
			.done(function (res) {
				$('#group_food').html(res);
			})
			.fail(function (jqXHR, textStatus, errorThrown) {
				alert('เกิดข้อผิดพลาด')
			});
		}



		function add_showform_food() {
			if($('#group_food').val()==='' || $('#group_food').val() ===undefined){
				alert('เลือกกลุ่มอาหาร');
				$('#group_food').focus();
				return false;
			}
            var load = "";
			load += '<div class="modal-backdrop fade in" style="height: 100vh;z-index:9999;position:fixed;">';
			load += '<div style="margin: 50vh;text-align: center;"> <img src="{{asset("public/images/loading.gif")}}" width="100"></div>';
			load += '</div>';
			$('#report').html(load);
			$.ajax({
				type: "get",
				url: "{{url('food/Form_Add_list_tmp_detail_Edit')}}",
				data: {
					_token : '{{csrf_token()}}',
					docno:'{{$head->docno}}'
				},
				datatype: 'json'
			})
			.done(function (res) {
                $('#report').html('');
				$('#form_modal').html(res);
				$('#frm_list_detail').modal();
			})
			.fail(function (jqXHR, textStatus, errorThrown) {
				alert('เกิดข้อผิดพลาด')
				$('#form_modal').html('');
			});

		}

		const edit_d = (id,docno) =>{
			var load = "";
			load += '<div class="modal-backdrop fade in" style="height: 100vh;z-index:9999;position:fixed;">';
			load += '<div style="margin: 50vh;text-align: center;"> <img src="{{asset("public/images/loading.gif")}}" width="100"></div>';
			load += '</div>';
			$('#report').html(load);
			$.ajax({
				type: "get",
				url: "{{url('food/Form_Edit_list_tmp_detail_pageEdit')}}",
				data: {
					_token : '{{csrf_token()}}',
					id:id,
					docno:docno,
				},
				datatype: 'json'
			})
			.done(function (res) {
				$('#report').html('');
				$('#form_modal').html(res);
				$('#frm_list_detail').modal();
			})
			.fail(function (jqXHR, textStatus, errorThrown) {
				alert('เกิดข้อผิดพลาด')
				$('#form_modal').html('');
			});
		}

		const del_d = (id,docno) =>{
			var load = "";
			load += '<div class="modal-backdrop fade in" style="height: 100vh;z-index:9999;position:fixed;">';
			load += '<div style="margin: 50vh;text-align: center;"> <img src="{{asset("public/images/loading.gif")}}" width="100"></div>';
			load += '</div>';
			$('#report').html(load);
			$.ajax({
				type: "post",
				url: "{{url('food/delete_form_detail')}}",
				data: {
					_token : '{{csrf_token()}}',
					id:id,
					docno:docno,
				},
				datatype: 'json'
			})
			.done(function (res) {
                swal('Success','ดำเนินการเรียบร้อย','success');
                $('#report').html('');
                get_table_form_tmp();


			})
			.fail(function (jqXHR, textStatus, errorThrown) {
				alert('เกิดข้อผิดพลาด')
			});
		}

		$('#btn-save_submit').click(function (e) {
			e.preventDefault();
			validate_form_submit();
		});

		function validate_form_submit() {
			var ststus = true;
			var chk_from = true;

			let  docno = $('#docno').val();
			let  name_food = $('#name_food').val();
			let  group_food = $('#group_food').val();
			let  detail = $('#detail').val();
			let  imgInp = $('#imgInp').val();

			if (docno ==='' || docno ===undefined) {
				swal('Warning!','กรุณากรอกข้อมูล รหัสรายการอาหาร','warning');
				$('#docno').focus();
				return false;
			}

			if (name_food ==='' || name_food ===undefined) {
				swal('Warning!','กรุณากรอกข้อมูล ชื่อรายการอาหาร','warning');
				$('#name_food').focus();
				return false;
			}

			if (group_food ==='' || group_food ===undefined) {
				swal('Warning!','กรุณากรอกข้อมูล กลุ่มอาหาร','warning');
				$('#group_food').focus();
				return false;
			}

			if (detail ==='' || detail ===undefined) {
				swal('Warning!','กรุณากรอกข้อมูล รายละเอียด','warning');
				$('#detail').focus();
				return false;
			}

			// if (imgInp ==='' || imgInp ===undefined) {
			// 	swal('Warning!','กรุณากรอกข้อมูล รูปภาพ','warning');
			// 	$('#imgInp').focus();
			// 	return false;
			// }

			if(chk_from){
				// var num = $('#form-table > tbody >tr').length;
				var num = $('#form-table > tbody > #GT').length;
				if(num <1){
					swal('Warning!','กรุณากรอกข้อมูล รายการวัตถุดิบ','warning');
					return false;
				}
				$('#form').submit();
			}
		}

	</script>

	@endsection
