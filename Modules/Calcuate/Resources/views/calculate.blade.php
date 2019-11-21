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
{{-- 					<div class="box-header with-border">
						<div class="box-title">คำนวณ
						</div>

					</div> --}}

					<div class="box-body" id="content">  

						<div class="container-fluid">
							<div class="row">
								<div class="col-xs-12 col-md-3 col-sm-3">
									<div class="panel panel-default">
										<div class="panel-heading">เลือกกลุ่มอาหาร </div>
										<div class="panel-body" style="height: 150px;">
											<select id="list_groupfood" name="" id="">
												<option value="">เลือกกลุ่มอาหาร</option>
											</select>
											<div id="con_list_group_food">
												<table class="table table-bordered table-striped">
													<thead>
														<tr>    
															<th>รหัส</th>    
															<th>กลุ่มอาหาร</th>
														</tr>
													</thead>
													<tbody>
														<td></td>
														<td></td>
													</tbody>
												</table>
											</div>
										</div>
									</div>
								</div>
								<div class="col-xs-12 col-md-4 col-sm-4">
									<div class="panel panel-default">
										<div class="panel-heading">รายการอาหาร </div>
										<div class="panel-body" style="height: 150px;">
											<select onchange="get_calculate()" id="list_food" name="" id="">
												{{-- <option value="">เลือกรายการอาหาร</option> --}}
											</select>
											<div id="con_list_food">
											<table class="table table-striped table-bordered table-responsive" style="width:100%">
												<thead>
													<tr>    
														<th>ราคา</th>    
														<th>จำนวน Serve</th>
														<th>รายละเอียด</th>
													</tr>
												</thead>
												<tbody>
													<td></td>
													<td></td>
													<td></td>
												</tbody>
											</table>	
											</div>

										</div>
									</div>
								</div>
								<div class="col-xs-12 col-md-5 col-sm-5">
									<div class="panel panel-default">
										<div class="panel-heading">คำนวณ</div>
										<div class="panel-body" >
											<div class="clearfix"></div><br>
											<div id="con_calculate_food">
											<table class="table table-striped table-bordered table-responsive" style="width:100%">
												<thead>
													<tr>    
														<th>วัตถุดิบ</th>  
														<th>รายละเอียด</th>  
														<th>ปริมาณที่ต้องสั่ง</th>   
														<th>หน่วย</th> 
														<th>ราคา</th>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td></td>
														<td></td>
														<td></td>
														<td></td>
													</tr>
													{{-- <tr>
														<td colspan="2"></td>
														<td style="" >รวม</td>
													</tr> --}}
												</tbody>
											</table>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="box">
			<div class="box-body" id="content">  
				<div class="container-fluid">
					<div class="row">
						<div class="col-xs-12 col-md-12 col-sm-12">
							<div class="panel panel-default">
								{{-- <div class="panel-heading">วัตถุดิบ </div> --}}
								<div class="panel-body" id="con_detail_food" style="">
										<table class="table table-bordered table-striped">
											<thead><tr>
												<th style="text-align: center; background-color: #4CAF50;color: white;" 
												rowspan="1" colspan="6" align="center">
												 ข้อมูลวัตถุดิบทั้งหมด ตามรายการอาหาร</th>
												</tr>
										<tr>
											<th>รหัส</th>
											<th>วัตถุดิบ</th>
											<th>รายละเอียด</th>
											<th>ปริมาณ</th>
											<th>หน่วยนับ</th>
											<th>ราคา</th>
										</tr></thead>
											<tbody>

										</tbody>
									</table>
								</div>
							</div>
						</div>
						<form  	method="POST" 
						enctype="multipart/form-data" 
						action="{{url('Calculate/print_order')}}" 
						id="frm">
							
						</form>
						<button disabled="true" class="btn btn-app" style="float: right" onclick="btn_save()" id="btn-save_submit">
							<i class="fa fa-save"></i> ใบสั่งของ
						</button>
					</div>
				</div>	
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
		$("#list_groupfood").select2(
		{
			placeholder: "-- เลือกกลุ่มอาหาร --",
            // allowClear: true,
            width: '100%'
        }
        );

		$("#list_food").select2(
		{
			placeholder: "-- เลือกรายการอาหาร --",
            // allowClear: true,
            width: '100%'
        }
        );
		Selected_list_group_food();

		/*Event*/
		$('#list_groupfood').change(function (e) { 
			e.preventDefault();
				$.ajax({
				type: "get",
				url: "{{url('Calculate/get_datas_groupfood')}}",
				data: {
					_token : '{{csrf_token()}}',
					id : $(this).val(),
				},
				datatype: 'json'
				})
				.done(function (res) {
					var data = jQuery.parseJSON(res);
					var datas_group_food = data.datas_group_food
					var datas_list_food = data.datas_list_food

					var html_ = '';
					html_ += '<table class="table table-bordered table-striped">';
							html_ += '<thead>';
									html_ += '<tr>';
											html_ += '<th>รหัส</th> ';
											html_ += '<th>กลุ่มอาหาร</th> ';   
											
									html_ += '</tr>';
									html_ += '</thead>';
						html_ += '<tbody>';
								$.each(datas_group_food, (key, value) => {
									html_ += '<tr>';
											html_ += '<td>' + value["group_id"] + '</td>';
											html_ += '<td>' + value["group_name"] + '</td>';
											html_ += '<td></td>';
									html_ += '</tr>';
								});
						html_ += '</tbody>';
					html_ += '</table>';
					$('#con_list_group_food').html(html_);
					html_ ='';
				  
						html_ += '<option value="">เลือกรายการอาหาร</option>';
								$.each(datas_list_food, (key, value) =>{
									html_ += '<option value="'+ value["docno"] + '">'+ value["name_food"] + '</option>';
								})
					 
					$('#list_food').html(html_);

				})
				.fail(function (jqXHR, textStatus, errorThrown) {
				
				});
		});

	});

	const btn_save = () =>{
		$('#frm').submit();
	}

	const get_calculate = (datas) =>{

		datas = (datas === undefined? null : datas );
	 

			var id = $('#list_food').val();
			$.ajax({
				type: "get",
				url: "{{url('Calculate/get_datas_food_price')}}",
				data: {
					_token : '{{csrf_token()}}',
					id : id,
				},
				datatype: 'json'
				})
				.done(function (res) {
					var data = jQuery.parseJSON(res);
					var datas_list_food = data.datas_list_food
					var datas_list_food_detail = data.datas_list_food_detail
					var datas_calculate = data.datas_calculate

				if(datas === null){
					var html_ = '';
					html_ += '<table class="table table-bordered table-striped">';
							html_ += '<thead>';
									html_ += '<tr>';
											html_ += '<th>ราคา</th> ';
											html_ += '<th>จำนวน Serve</th> ';   
											html_ += '<th>รายละเอียด</th> ';   
									html_ += '</tr>';
									html_ += '</thead>';
						html_ += '<tbody>';
								$.each(datas_list_food, function(key, value) {
									html_ += '<tr>';
											html_ += '<td id="t_sum">' + value["sum_totoal"] + '</td>';
											html_ += '<td><input type="number" style="" onchange="change_calculate()" id="num_serve" value="1"></td>';
											html_ += '<td align="center"><button type="button" style="padding: 2px;" class="btn btn-xs btn-success" onclick="view(\'' + value["docno"] + '\')"><i class="fa fa-eye" aria-hidden="true"></i></button></td>';
									html_ += '</tr>';
								});
						html_ += '</tbody>';
					html_ += '</table>';
					$('#con_list_food').html(html_);
				}
				// แสดง ราคาต่อ serve
				// if(datas !== null) {
				// 	var t_sum = datas_list_food[0].sum_totoal;
				// 	price_food = parseInt(t_sum);
				// 	var sum_price_food = (price_food*datas);
				// 	$('#t_sum').html(sum_price_food);
				// }

					html_ = '';
					html_ += '<table class="table table-striped table-bordered table-responsive" style="width:100%">';
							html_ += '<thead>';
									html_ += '<tr>';
											html_ += '<th >วัตถุดิบ</th> ';    
											html_ += '<th >รายละเอียด</th> ';    
											html_ += '<th >ปริมาณที่ต้องสั่ง</th> ';
											html_ += '<th >หน่วย</th> ';
											html_ += '<th >ราคา</th> ';

									html_ += '</tr>';
									html_ += '</thead>';
	
									html_ += '<tbody>';
										var sum_totoal = 0;
											$.each(datas_calculate, function(key, value) {
													var val = value["qty"];
													var price = value["price"];
													val = (datas === null? val : (val*datas) );
													price = (datas === null? price : (price*datas) );
													price = parseInt(price);
													sum_totoal += price;

											html_ += '<tr>';		
												html_ += '<td>' + value["group_name"] + '</td>';
												html_ += '<td>' + value["detail"] + '</td>';
												html_ += '<td>'+'<input type="text" readonly name="" style="color: deepskyblue;width: 80%;" value="'+val+'" id="">&nbsp;&nbsp;</td>';
												html_ += '<td >' + value["unit"] + '</td>';
												html_ += '<td >' + price + '</td>';
											html_ += '</tr>';

											})

												html_ += '<tr>';
													html_ += '<td ></td>';
													html_ += '<td ></td>';
													html_ += '<td >รวม</td>';
													html_ += '<td >'+sum_totoal+'</td>';
											html_ += '</tr>';

									html_ += '</tbody>';
					html_ += '</table>';
					$('#con_calculate_food').html(html_);

					html_ = '';
					html_ += '<table class="table table-bordered table-striped">';
							html_ += '<thead>';
									html_ += '<tr>';
											html_ += '<th style="text-align: center; background-color: #4CAF50;color: white;" rowspan="1" colspan="6" align="center"> ข้อมูลวัตถุดิบทั้งหมด ตามรายการอาหาร</th>';    
									html_ += '</tr>';

									html_ += '<tr>';
											html_ += '<th>รหัส</th>';    
											html_ += '<th>วัตถุดิบ</th>'; 
											html_ += '<th>รายละเอียด</th>'; 
											html_ += '<th>ปริมาณ</th>'; 
											html_ += '<th>หน่วยนับ</th>'; 
											html_ += '<th>ราคา</th>'; 
									html_ += '</tr>';

									html_ += '</thead>';
	
									html_ += '<tbody>';

										$.each(datas_list_food_detail, (key, value) => {
										html_ += '<tr>';
											html_ += '<td>' + value["group_id"] + '</td>';
											html_ += '<td>' + value["group_name"] + '</td>';
											html_ += '<td>' + value["detail"] + '</td>';
											html_ += '<td>' + value["qty"] + '</td>';
											html_ += '<td>' + value["unit"] + '</td>';
											html_ += '<td>' + value["price"] + '</td>';
									    html_ += '</tr>';
											})

									html_ += '</tbody>';
					html_ += '</table>';
					$('#con_detail_food').html(html_);
					
					
					// form
					html_ = '';
					var sum_totoal = 0;
					var count_list =1;
					count_list = (datas === null? count_list : datas );
					$.each(datas_calculate, function(key, value) {
 					var val = value["qty"];
					var price = value["price"];
					val = (datas === null? val : (val*datas) );
					price = (datas === null? price : (price*datas) );
					price = parseInt(price);
					sum_totoal += price;
					html_ += '<tr>';	
					html_ += '<td>'+'<input type="hidden" readonly name="count_list" style="color: deepskyblue;" value="'+count_list+'" id=""></td>';	
					html_ += '<td>'+'<input type="hidden" readonly name="docno" style="color: deepskyblue;" value="'+value["docno"]+'" id=""></td>';	
					html_ += '<td>'+'<input type="hidden" readonly name="group_id[]" style="color: deepskyblue;" value="'+value["group_id"]+'" id=""></td>';
					html_ += '<td>'+'<input type="hidden" readonly name="group_name[]" style="color: deepskyblue;" value="'+value["group_name"]+'" id=""></td>';
					html_ += '<td>'+'<input type="hidden" readonly name="detail[]" style="color: deepskyblue;" value="'+value["detail"]+'" id=""></td>';
					html_ += '<td>'+'<input type="hidden" readonly name="val_order[]" style="color: deepskyblue;" value="'+val+'" id=""></td>';
					html_ += '<td>'+'<input type="hidden" readonly name="unit[]" style="color: deepskyblue;" value="'+value["unit"]+'" id=""></td>';
					html_ += '<td>'+'<input type="hidden" readonly name="price[]" style="color: deepskyblue;" value="'+price+'" id=""></td>';
					html_ += '</tr>';
					})
					html_ += '<td>'+'<input type="hidden" readonly name="sum_totoal" style="color: deepskyblue;" value="'+sum_totoal+'" id=""></td>';
					html_ += '{@csrf}';
					$('#frm').html(html_);

					$('#btn-save_submit').attr("disabled", false);
					

				})
				.fail(function (jqXHR, textStatus, errorThrown) {
				
				});
		}





	function Selected_list_group_food() {
		$.ajax({
			type: "get",
			url: "{{url('Calculate/get_list_group_food')}}",
			data: {
				_token : '{{csrf_token()}}',
			},
			datatype: 'json'
		})
		.done(function (res) {
			$('#list_groupfood').html(res);
		})
		.fail(function (jqXHR, textStatus, errorThrown) {
			alert('เกิดข้อผิดพลาด')
		});
	}


	const view = (docno) =>{
		window.open("{{url('food/view')}}?docno="+docno+"", '_blank');
	}

	const change_calculate = () =>{
		if($('#num_serve').val() <0){
			alert('จำนวนเสริฟไม่ถูกต้อง');
			$('#num_serve').val(0)
			return false;
		}
		  get_calculate($('#num_serve').val());
	}

</script>

@endsection
