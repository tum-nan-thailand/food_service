  <!-- Modal -->
  <div class="modal fade" id="form_modal_material" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">ข้อมูลกลุ่มวัตถุดิบ</h4>
        </div>
        <div class="modal-body">
                <div class="row">
                <form action="{{url('category/material_group_save')}}" id="frm" method="POST">
                        @csrf
                        <div class="col-xs-6">
                            <div class="form-group">
                            <label for="group_id">รหัส</label>
                            <input type="text" class="form-control "  readonly   value="@isset($datas){{$datas->group_id}}@endisset"  name="group_id"  id="group_id" placeholder="รหัส">
                            </div>
                        </div>

                        <div class="col-xs-6">
                            <div class="form-group">
                            <label for="group_name">กลุ่ม</label>
                            <input type="text" class="form-control "   readonly  value="@isset($datas){{$datas->group_name}}@endisset"  name="group_name"  id="" placeholder="กลุ่ม">
                            </div>
                        </div>

                        <div class="col-xs-6">
                            <div class="form-group">
                            <label for="unit">หน่วยนับ</label>
                            <input type="text" class="form-control "   readonly  value="@isset($datas){{$datas->unit}}@endisset" name="unit"  id="" placeholder="หน่วยนับ">
                            </div>
                        </div>

                        <div class="col-xs-6">
                            <div class="form-group">
                            <label for="price">ราคา</label>
                            <input type="number" class="form-control "  readonly  value="@isset($datas){{$datas->price}}@endisset" name="price"  id="" placeholder="ราคา">
                            </div>
                        </div>

                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="detail">รายละเอียด</label>
                                <textarea id="" readonly class="form-control"  placeholder="รายละเอียด" name="detail" rows="3">@isset($datas){{$datas->detail}}@endisset</textarea>
                            </div>
                        </div>

                    </form>
              </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>
