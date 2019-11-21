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
		<div class="container-fluid">
             <div class="box box-widget">
				{{-- <div class="panel-heading">รายการอาหาร</div> --}}
				<div class="box-body">
					<a class="btn btn-app" style="float: right" target="_blank" href="{{url('food/print_food').'?docno='.$head->docno.''}}">
						<i class="fa fa-print"></i> Print
					</a>
					<div class="row">
						<div class="col-md-12">


							<center><img  class="img_show img-thumbnail" id="blah" style="max-width: 300px; max-height: 460px;text-align: center "
								src="{{url('/public/'.$head->img)}}" alt="your image" />

								<div class="clearfix"></div><br>
								<div  style="text-align: center" class="text-justify"> <u> <b>{{$head->name_food}} </b> </u> </div>
							</center>

							<div class="clearfix"></div><br>
						</div>

						<!-- /.col -->
					</div>

							<!-- /.row -->

		<div class="row">
			<!-- left column -->
			<div class="col-lg-12">
				<!-- general form elements -->
				<div class="box box-widget">
					<div class="box-header with-border">
						ข้อมูลวัตถุดิบ
					</div>
					<div class="clearfix"></div>
					<div class="box-body">
						<div class="row">
							<div class="col-xs-12">
								<div class="table-wrapper-scroll-y food-detail-scrollbar" id="content_details_list_food">
									<?php echo $list_table_material ;?>		
								</div>
							</div>
						</div>
					</div>


				</div>
			</div>
		</div>

					<div class="row">
						<div class="col-md-12">
							<div class="detail">
								<u><b> รายละเอียดวิธีการทำ </b></u>
								<div>
									<?php echo $head->detail ;?>
								</div>
							</div>
						</div>
					</div>


				</div>

			</div>
		</div>

		<!-- Main row -->

	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->


<script>





</script>
@endsection
