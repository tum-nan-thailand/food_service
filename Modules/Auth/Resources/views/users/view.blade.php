  <!-- Modal -->
  <div class="modal fade" id="view_user_Modal" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">ข้อมูลส่วนตัว</h4>
        </div>
        <div class="modal-body">
                <div class="row">
                        <div class="col-xs-6">
                            <div class="form-group">
                            <label for="Username">Username</label>
                            <input type="text" class="form-control " readonly    value="@isset($data){{$data->User_name}}@endisset" name="Username"  id="Username" placeholder="Username">
                            </div>
                        </div>

                       <div class="col-xs-6">
                            <div class="form-group">
                                    <label for="Name">ชื่อ</label>
                                    <input type="text" class="form-control " readonly  value="@isset($data){{$data->name}}@endisset" name="Name"  id="Name" placeholder="Name">
                            </div>
                         </div>
                         <div class="col-xs-6">
                            <div class="form-group">
                                    <label for="Surname">นามสกุล</label>
                                    <input type="text" class="form-control " readonly  value="@isset($data){{$data->surname}}@endisset" name="Surname"   id="Surname" placeholder="Surname">
                            </div>
                         </div>
                         <div class="col-xs-6">
                                <div class="form-group">
                               <label for="">สิทธิ์ </label>
                               @php
                              /*   $role = array('1' => 'Admin',
                                 '2' => 'User', ); */
                               @endphp
                               <select disabled class="form-control" name="role_id" id="" required>
                                   @foreach ($roleAll as $k =>$v)
                               <option  <?php if(isset($data)){
                                   echo ($data->role_id===''.$v->role_id.'') ? 'selected' : '' ;
                               }  ?>
                                value="{{$v->role_id}}">{{$v->role_name}}</option>
                               @endforeach
                               </select>
                               </div>
                          </div>


                         <div class="col-xs-6">
                            <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control " readonly  value="@isset($data){{$data->email}}@endisset" name="email"  id="email" placeholder="Email">
                            </div>
                         </div>

                         <div class="col-xs-6">
                                <div class="form-group">
                                        <label for="phone">เบอร์โทร</label>
                                        <input type="phone" class="form-control " readonly value="@isset($data){{$data->phone}}@endisset" name="phone" required id="phone" placeholder="phone">
                                </div>
                             </div>

                             <div class="col-xs-6">
                                            <div class="form-group">
                                                <label for="address">ที่อยู่</label>
                                                <textarea id="address" class="form-control" readonly name="address" rows="3">@isset($data){{$data->address}}@endisset</textarea>
                                            </div>
                             </div>

                       </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>
