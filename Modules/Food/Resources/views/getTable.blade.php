<div class="table-responsive">
    <table id="table_" class="table table-striped table-bordered table-responsive" style="width:100%">
        {{-- {{dd($datas)}} --}}
            <thead>
                <tr>
                    <th style="min-width:80px">รหัส</th>
                    <th style="min-width:180px">รายการอาหาร</th>
                    <th style="min-width:180px">กลุ่มอาหาร </th>
                    {{-- <th style="min-width:100px">หน่วยนับ </th> --}}
                    <th style="min-width:100px">ราคา</th>
                    <th align="center" style="min-width:10px;text-aling:center">View</th>
                    @if (Session::get('auth')['role_id'] ==='1')  <th style="min-width:50px">Tool</th> @endif
                </tr>
            </thead>
            <tbody>
                @foreach ($datas as $key => $v)
                    <tr>
                        <td>{{$v->docno}}</td>
                        <td>{{$v->name_food}}</td>
                        <td>{{$v->group_name}}</td>
                        <td>{{$v->sum_totoal}}</td>
                        <td align="center"><button type="button" style="padding: 2px;" class="btn btn-xs btn-success"  onclick="view('{{$v->docno}}')" ><i class="fa fa-eye" aria-hidden="true"></i></button></td>
                        @if (Session::get('auth')['role_id'] ==='1')
                        <td>
                            <button onclick="edit_('{{$v->docno}}')" class="btn btn-primary btn-sm"> <i class="glyphicon glyphicon-pencil"></i> Edit</button>
                            <button onclick="delete_('{{$v->docno}}')"  class="btn btn-danger btn-sm"> <i class="glyphicon glyphicon-remove"></i> Delete</button>
                        </td>
                        @endif
                    </tr>
                @endforeach


            </tbody>

        </table>
</div>
    <script>
            $(document).ready(function() {
                $('#table_').DataTable(
                    {
                        //  "autoWidth": false,
                        // scrollY: ' 80vh',
                        // scrollX: true,
                        // scrollCollapse: true,
                })
            } );


            function delete_(id) {
                var img = '<center><img src="{{asset("public/images/loading.gif")}}" class="user-image" alt="User Image"></center>';
                $('#content').html(img);
                $.ajax({
                    type: "post",
                    url: "{{url('food/delete_foods')}}",
                    data: {
                        _token : '{{ csrf_token()}}',
                        id : id,
                    },
                }).done(function (res) {
                    if(res.message ==='success'){
                        getTable();
                        swal("Good job!", "ดำเนินการสำเร็จ", "success");
                    }else{
                        alert('เกิดข้อผิดพลาด')
                        $('#content').html('');
                    }
                    })
                .fail(function (jqXHR, textStatus, errorThrown) {
                  alert('เกิดข้อผิดพลาด')
                  $('#content').html('');
                });
            }

            function edit_(id) {
                window.location.href = '{{url("food/form_update_food")}}?id='+id+''
            }
    </script>
