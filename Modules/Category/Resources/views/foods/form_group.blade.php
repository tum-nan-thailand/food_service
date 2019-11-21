  <!-- Modal -->
  <div class="modal fade" id="form_foods_material" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">@if(isset($datas))
                {{'แก้ไขกลุ่มอาหาร'}}
                @else{{'เพิ่มกลุ่มอาหาร'}} @endif</h4>
        </div>
        <div class="modal-body">
                <div class="row">
                <form id="frm"
                method="POST" enctype="multipart/form-data"
                action="@if(isset($datas))
                {{url('category/foods_group_update')}}
                @else {{url('category/foods_group_save')}} @endif">
                        @csrf
                        <div class="col-xs-6">
                                <div class="form-group">
                                <label for="group_id">รหัส</label>
                                <input type="text" class="form-control "  required   value="@isset($datas){{$datas->group_id}}@endisset"  name="group_id"  id="group_id" placeholder="รหัส">
                                </div>
                            </div>
                            @isset($datas)<input type="hidden" name="group_id_default" value="{{$datas->group_id}}">@endisset
                            <div class="col-xs-6">
                                <div class="form-group">
                                <label for="group_name">กลุ่ม</label>
                                <input type="text" class="form-control "   required  value="@isset($datas){{$datas->group_name}}@endisset"  name="group_name"  id="" placeholder="กลุ่ม">
                                </div>
                            </div>

                            {{-- <div class="col-xs-6">
                                <div class="form-group">
                                    <label for="detail">รายละเอียด</label>
                                    <textarea id="" required class="form-control"  placeholder="รายละเอียด" name="detail" rows="3">@isset($datas){{$datas->detail}}@endisset</textarea>
                                </div>
                            </div> --}}

                    </form>
              </div>
        </div>
        <div class="modal-footer">
         <button type="button" id="btn-save" onclick="" class="btn btn-success" >บันทึก</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>

<script>

        {{-- @if(isset($datas))
         @else --}}

        $('#group_id').blur(function (e) {
            e.preventDefault();
                            $.ajax({
                                    type: "get",
                                    url: "{{url('category/check_groupid_duplicate_foods')}}",
                                    data: {
                                        _token : '{{csrf_token()}}',
                                        group_id : $(this).val(),
                                    },
                                    datatype: 'json'
                                  })
                                .done(function (res) {
                                    if(res ==='true'){
                                        $('#group_id').val('');
                                        $('#group_id').focus();
                                        alert('ขออภัย รหัสนี้มีอยู่ในระบบแล้ว!');
                                        return false;
                                    }
                                    })
                                .fail(function (jqXHR, textStatus, errorThrown) {
                                  alert('เกิดข้อผิดพลาด');
                                  $('#group_id').val('');
                                });
            });

        {{-- @endif --}}



        $('#btn-save').click(function (e) {
             e.preventDefault();
             validate()
         });

        function validate() {
            var ststus = true;
            var chk_from = true;
            $('form#frm').find('input,select,textarea').each(function(){
                if($(this).prop('required')){
                            if(this.value == '' || this.value == null){
                                chk_from = false;
                                if(chk_from === false){
                                    // swal('Warning!','กรุณากรอกข้อมูล '+$(this).attr('placeholder')+'','warning');
                                    // alert('กรุณากรอกข้อมูล'+$(this).attr('placeholder')+'');
                                $(this).focus();
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
