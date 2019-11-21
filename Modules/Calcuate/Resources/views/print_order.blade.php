@extends('..layouts.structure')
@section('title','ใบสั่งของรวม ')
@section('content')
<style>
table {
  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

table td, #table th {
  border: 1px solid #ddd;
  padding: 8px;
}


table tr:nth-child(even){background-color: #f2f2f2;}

/* table tr:hover {background-color: #ddd;} */


@page {
        size: 204mm 260mm;
        margin: 0;
    }

    @media print {
        html, body {
            width: 204mm;
            height: 260mm;
            background-color: #FFFFFF;
        }
        .page {
            margin: 0;
            border: initial;
            border-radius: initial;
            width: initial;
            min-height: initial;
            box-shadow: initial;
            background: initial;
            page-break-after: always;

        }
    }
	
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h4>
			<br>
		</h4>

		<ol class="breadcrumb">
			<li><a href="{{url('main')}}"><i class="fa fa-dashboard"></i> Home</a></li>
			<li><a href="{{url('Calculate')}}">ใบสั่งของรวม </a></li>
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
		<div class="container-fluid">
             <div class="box box-widget">
				{{-- <div class="panel-heading">รายการอาหาร</div> --}}
				<div class="box-body">
							<div style="text-align: center;">
			
						@foreach ($datas_head_food as $key =>$v)
						<p> <u><b>กลุ่มอาหาร</b> </u> &nbsp; <?php echo $v->group_name ;?>	</p>	
			 			<p> <u><b>ชื่ออาหาร</b> </u>&nbsp;  <?php echo $v->name_food ;?> </p>
						 <p> <u><b>จำนวน</b> </u>&nbsp; Serve ที่สั่ง  <?php echo $num_serve ;?> </p>
						 
						@endforeach
						
							</div>			
					 <div class="clearfix"></div><br>
					<table class="table  table-striped">
						<thead><tr>
							<th style="text-align: center; background-color: #4CAF50;color: white;" 
							rowspan="1" colspan="6" align="center">
							 วัตถุดิบที่ต้องสั่ง</th>
							</tr>
					<tr style="background-color: #ddd;">
						<th>รหัส</th>
						<th>วัตถุดิบ</th>
						<th>รายละเอียด</th>
						<th>ปริมาณที่ต้องการสั่ง</th>
						<th>หน่วย</th>
						<th>ราคา</th>
					</tr>
				 </thead>
						<tbody>

							@foreach ($datas as $key =>$v)
						<tr>
							<td>{{$v['group_id']}}</td>
							<td>{{$v['group_name']}}</td>
							<td>{{$v['detail']}}</td>
							<td>{{$v['val_order']}}</td>
							<td>{{$v['unit']}}</td>
							<td>{{$v['price']}}</td>
						</tr>		
							@endforeach
						<tr>
							<td colspan="4"></td>
							<td>รวม</td>
							<td>{{$sum_totoal}}</td>
						</tr>

					</tbody>
				</table>
				</div>

			
						<div class="box-body">
								<div class="page col-xs-12 col-md-12 col-sm-12">
								<h5><u>รายละเอียดวิธีการทำ</u></h5>

								@foreach ($datas_head_food as $key =>$v)
									 <?php echo $v->detail ;?>
								@endforeach
								<div class="clearfix"></div><br>
								<left><img  class=" img-thumbnail" id="blah" style="max-width: 300px; max-height: 460px;text-align: left "
									src="{{url('/public/'.$datas_head_food[0]->img)}}" alt="your image" />
									<div class="clearfix"></div><br>
									<div  style="text-align: left" class="text-justify"> <u> <b>{{$datas_head_food[0]->name_food}} </b> </u> </div>
								</left>
							</div>	
						</div>

		

			</div>

			{{-- <button class="btn btn-app" style="float: right" onclick="back()" id="btn-save_submit">
					<i class="fa fa-home"></i> กลับ
			</button> --}}
		</div>

		<!-- Main row -->

	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->


<script>
$(document).ready(function () {
	// window.print();
});
function back(){
	 window.location.href="{{url('Calculate')}}"
}



</script>
@endsection
