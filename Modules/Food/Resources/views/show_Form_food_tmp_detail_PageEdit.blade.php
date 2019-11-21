  <style>
  	.input_detailfood{
  		background-color: #ffffdb;
  	}

  </style>

  <!-- Modal -->
  <div class="modal fade" id="frm_list_detail" role="dialog">
  	<div class="modal-dialog modal-lg">
  		<div class="modal-content">
  			<div class="modal-header">
  				<button type="button" class="close" data-dismiss="modal">&times;</button>
  				<h4 class="modal-title">
  					Edit (  @if(isset($datas))
  					{{'แก้ไขกลุ่มอาหาร'}}
  				@else{{'เพิ่มรายการอาหาร'}} @endif)</h4>

  			</div>
  			<div class="modal-body">
  				<div class="row">
  					<form id="frm"
  					method="POST" enctype="multipart/form-data"
  					action="">
  					@csrf

  					<input type="hidden" class="form-control "   value="@isset($datas){{$datas->run_no}}@endisset"  name="run_no_defult"  id="run_no_defult">
				    <input type="hidden" class="form-control "   value="@isset($docno){{$docno}}@endisset"  name="docno"  id="docno">


  					<div class="col-xs-6">
  						<div class="form-group">
  							<label for="qty">ลำดับ</label>
  							<input type="number"  class="form-control "  step="1" required   value="@isset($datas){{$datas->run_no}}@endisset"  name="run_no"  id="run_no" placeholder="ลำดับ">
  						</div>
  					</div>

  					<div class="col-xs-6">
  						<div class="form-group">
  							<label for="id_material_group">วัตถุดิบอาหาร</label>
  							<input readonly="true" type="text" class="form-control "  value="@isset($datas){{$datas->group_name_material}}@endisset"  name="group_name_material"  id="group_name_material" placeholder="อัตโนมัติ">
  						</div>
  					</div>



  					<div class="col-xs-6">
  						<label for="id_material_group">รหัสวัตถุดิบ</label>
  						<select class="form-control " name="id_material_group" id="id_material_group" placeholder="รหัสวัตถุดิบ" required="required">
  							<option value="">..รหัสวัตถุดิบ..</option>
  						</select>
  					</div>

  					<div class="col-xs-6">
  						<div class="form-group">
  							<label for="price">ราคา</label>
  							<input readonly="true"  type="text" class="form-control "     value="@isset($datas){{$datas->price}}@endisset"  name="price"  id="price_material" placeholder="อัตโนมัติ">
  						</div>
  					</div>


  					<div class="col-xs-6">
  						<div class="form-group">
  							<label for="qty">ปริมาณ</label>
  							<input type="number" step="0.01" class="form-control "  required   value="@isset($datas){{$datas->qty}}@endisset"  name="qty"  id="qty" placeholder="ปริมาณ">
  						</div>
  					</div>


  					<div class="col-xs-6">
  						<div class="form-group">
  							<label for="unit">หน่วยนับ</label>
  							<input readonly="true" type="text" class="form-control "     value="@isset($datas){{$datas->unit}}@endisset"  name="unit"  id="unit_material" placeholder="อัตโนมัติ">
  						</div>
  					</div>

					  <div class="col-xs-6">
                        </div>

                        <div class="col-xs-6">
                                    <div class="form-group">
                                    <label for="detail">รายละเอียด</label>
                                    <textarea readonly="true" name="detail" class="form-control" rows="3" id="detail_material" placeholder="อัตโนมัติ">
                                    @isset($datas){{$datas->detail}}@endisset
                                    </textarea>                                
                            </div>
                        </div>

  				</form>
  			</div>
  		</div>
  		<div class="modal-footer">
  			<button type="button" id="btn-save" onclick="" class="btn btn-success" >ตกลง</button>
  			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
  		</div>
  	</div>
  </div>
</div>
</div>

<script>
	$(document).ready(function() {
		Selected_material_group();
		$("#id_material_group").select2(
		{
			placeholder: "-- เลือกรหัสวัตถุดิบ --",
            // allowClear: true,
            width: '100%'
        }
        );

		$('#id_material_group').change(function (e) {
			e.preventDefault();
			$.ajax({
				type: "get",
				url: "{{url('food/get_auto_form_detail_material')}}",
				data: {
					_token : '{{csrf_token()}}',
					id : $(this).val(),
				},
				datatype: 'json'
			})
			.done(function (res) {
				var obj = jQuery.parseJSON(res);
				if(obj !== undefined || obj !== ''){
					$('#group_name_material').val(obj.group_name);
					$('#unit_material').val(obj.unit);
					$('#price_material').val(obj.price);
					$('#detail_material').val(obj.detail);
				}
			})
			.fail(function (jqXHR, textStatus, errorThrown) {
				alert('เกิดข้อผิดพลาด')
			});

		});
		$('#run_no').change(function (e) {
			e.preventDefault();
			$.ajax({
				type: "get",
				url: "{{url('food/CheckDuplicate_form_detail')}}",
				data: {
					_token : '{{csrf_token()}}',
					id:$(this).val(),
					docno:'{{$docno}}',
				},
				datatype: 'json'
			})
			.done(function (res) {
				if(res.status ==='unsuccess'){
					swal('Warning!',''+res.message+'','warning');
					$('#run_no').val('');
					return false;
				}
			})
			.fail(function (jqXHR, textStatus, errorThrown) {
				alert('เกิดข้อผิดพลาด')
			});
		});

	});

	function Selected_material_group() {
		var id ='';
		<?php if(isset($datas->id_material_group)){ ?>
			id = '{{$datas->id_material_group}}';
			<?php } ?>
			$.ajax({
				type: "get",
				url: "{{url('food/Selected_material_group')}}",
				data: {
					_token : '{{csrf_token()}}',
					id:id,
				},
				datatype: 'json'
			})
			.done(function (res) {
				$('#id_material_group').html(res);
			})
			.fail(function (jqXHR, textStatus, errorThrown) {
				alert('เกิดข้อผิดพลาด')
			});
		}




		$('#btn-save').click(function (e) {
			e.preventDefault();
			validate()
		});

		function validate() {
			var ststus = true;
			var chk_from = true;
			var html_ = '';

			$('form#frm').find('input,select,textarea').each(
				function(index){
					var input = $(this);
					if($(this).prop('required')){
						if(this.value == '' || this.value == null){
							chk_from = false;
							if(chk_from === false){
								swal('Warning!','กรุณากรอกข้อมูล '+$(this).attr('placeholder')+'','warning');
                                        // alert('กรุณากรอกข้อมูล'+$(this).attr('placeholder')+'');
                                        $(this).focus();
                                        return false;
                                    }
                                }
                            }
                        });

			if(chk_from){
				<?php if(isset($datas->id_material_group)){ ?>
					update_form_tmp();
					<?php }else{ ?>
						add_form_tmp();
						<?php   }    ?>
                }
            }
            const add_form_tmp = () =>{
                var load = "";
                    load += '<div class="modal-backdrop fade in" style="height: 100vh;z-index:9999;position:fixed;">';
                    load += '<div style="margin: 50vh;text-align: center;"> <img src="{{asset("public/images/loading.gif")}}" width="100"></div>';
                    load += '</div>';
                $('#report').html(load);
                          $.ajax({
                                type: "post",
                                url: "{{url('food/add_form_detail_tmp_pageEdit')}}",
                                data: $("#frm").serialize(),
                                datatype: 'json'
                              })
                            .done(function (res) {
                                $('#report').html('');
                                if(res.status ==='success'){
                                }else{
                                    swal('Warning!',''+res.message+'','warning');
                                }
                                $('#frm_list_detail').trigger("reset");
                                $('#frm_list_detail').modal('hide');
                                $('#frm_list_detail').html('');
                                get_table_form_tmp();


                                })
                            .fail(function (jqXHR, textStatus, errorThrown) {
                              alert('เกิดข้อผิดพลาด')
                              $('#report').html('');
                            });
            }

            const update_form_tmp = () =>{
            	var load = "";
            	load += '<div class="modal-backdrop fade in" style="height: 100vh;z-index:9999;position:fixed;">';
            	load += '<div style="margin: 50vh;text-align: center;"> <img src="{{asset("public/images/loading.gif")}}" width="100"></div>';
            	load += '</div>';
            	$('#report').html(load);
            	$.ajax({
            		type: "post",
            		url: "{{url('food/update_form_tmp_form_detail_tmp_EditPage')}}",
            		data: $("#frm").serialize(),
            		datatype: 'json'
            	})
            	.done(function (res) {
            		$('#report').html('');
            		if(res.status ==='success'){
            		}else{
            			swal('Warning!',''+res.message+'','warning');
            		}
            		$('#frm_list_detail').trigger("reset");
            		$('#frm_list_detail').modal('hide');
            		$('#frm_list_detail').html('');
            		get_table_form_tmp();


            	})
            	.fail(function (jqXHR, textStatus, errorThrown) {
            		alert('เกิดข้อผิดพลาด')
            		$('#report').html('');
            	});
            }


        </script>
