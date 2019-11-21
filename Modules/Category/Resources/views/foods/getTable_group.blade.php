<div class="table-responsive">
    <table id="table_" class="table table-striped table-bordered table-responsive" style="width:100%">
        {{-- {{dd($datas)}} --}}
            <thead>
                <tr>
                    <th style="min-width:80px">รหัส</th>
                    <th style="min-width:180px">กลุ่ม</th>
                    @if (Session::get('auth')['role_id'] ==='1')  <th style="min-width:50px">Tool</th> @endif
                </tr>
            </thead>
            <tbody>
                @foreach ($datas as $key => $v)
                    <tr>
                        <td>{{$v->group_id}}</td>
                        <td>{{$v->group_name}}</td>

                        {{-- <td><button type="button" style="padding: 2px;" class="btn btn-xs btn-success" onclick="view('{{$v->group_id}}')"><i class="fa fa-eye" aria-hidden="true"></i></button></td> --}}
                        @if (Session::get('auth')['role_id'] ==='1')
                        <td>
                            <button onclick="edit_('{{$v->group_id}}')" class="btn btn-primary btn-sm"> <i class="glyphicon glyphicon-pencil"></i> Edit</button>
                            <button onclick="delete_('{{$v->group_id}}')"  class="btn btn-danger btn-sm"> <i class="glyphicon glyphicon-remove"></i> Delete</button>
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


            function delete_(group_id) {
                var load = "";
                        load += '<div class="modal-backdrop fade in" style="height: 100vh;z-index:9999;position:fixed;">';
                        load += '<div style="margin: 50vh;text-align: center;"> <img src="{{asset("public/images/loading.gif")}}" width="100"></div>';
                        load += '</div>';
                        $('#report').html(load);
                $.ajax({
                    type: "post",
                    url: "{{url('category/delete_foods_group')}}",
                    data: {
                        _token : '{{ csrf_token()}}',
                        group_id : group_id,
                    },
                }).done(function (res) {
                    $('#report').html('');
                    if(res ==='success'){
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
                  $('#report').html('');
                });
            }

            function edit_(group_id) {
                var load = "";
                        load += '<div class="modal-backdrop fade in" style="height: 100vh;z-index:9999;position:fixed;">';
                        load += '<div style="margin: 50vh;text-align: center;"> <img src="{{asset("public/images/loading.gif")}}" width="100"></div>';
                        load += '</div>';
                        $('#report').html(load);
                $.ajax({
                    type: "get",
                    url: "{{url('category/form_foods_group')}}",
                    data: {
                        _token : '{{csrf_token()}}',
                        group_id : group_id,
                    },
                    datatype: 'json'
                  })
                .done(function (res) {
                    $('#report').html('');
                    $('#form_modal').html(res);
                    $('#form_foods_material').modal();
                    })
                .fail(function (jqXHR, textStatus, errorThrown) {
                  alert('เกิดข้อผิดพลาด')
                  $('#form_modal').html('');
                  $('#report').html('');
                });
            }
    </script>
