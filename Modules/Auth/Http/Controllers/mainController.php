<?php

namespace Modules\Auth\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Routing\Route;

use App\Http\Requests\LoginRequest;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Systems;
use Redirect;

class mainController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
        public function __construct(Request $request,Route $route)
        {
            $this->middleware(function ($request, $next) {
                if(Session::get('auth')['role_id'] <> '1'){
                    return Redirect::to('/main');
                }else{
                    return $next($request);
                }
            });


        }

    public function showform_users()
    {
        return view('auth::users/table');
    }

    public function get_data(Request $request,Route $route)
    {
        $post = $request->all();
        $where = ''; $html_ = '';
        if (isset($post) && $post <> '') {
            if (isset($post['Username']) && $post['Username'] <>'') {
                $where .="and User_name like '%".$post['Username']."%'";
            }
            if (isset($post['Name']) && $post['Name'] <>'') {
                $where .="and name like '%".$post['Name']."%'";
            }
            if (isset($post['Surname']) && $post['Surname'] <>'') {
                $where .="and surname like '%".$post['Surname']."%'";
            }

        }

        $user = DB::select('select * from st_users where 1=1 '.$where.' order by created_at desc');
        $html_ .= '<table id="example3" class="table table-bordered table-hover" style="width:100%">';
        $html_ .= '<thead>';
        $html_ .= '<tr>';
        $html_ .= '<th>ลำดับ</th>';
        $html_ .= '<th>user_id</th>';
        $html_ .= '<th>Username</th>';
        $html_ .= '<th>Name</th>';
        $html_ .= '<th>Surname</th>';
        $html_ .= '<th>สถานะ</th>';
        $html_ .= '<th>Action</th>';
        $html_ .= '</tr>';
        $html_ .= '</thead>';

        $html_ .= '<tbody>';
        if (count($user) > 0) {
            foreach ($user as $key => $v) {
                $html_ .= '<tr>';
                $html_ .= '<td>'.($key+1).'</td>';
                $html_ .= '<td>'.$v->user_id.'</td>';
                $html_ .= '<td>'.$v->User_name.'</td>';
                $html_ .= '<td>'.$v->name.'</td>';
                $html_ .= '<td>'.$v->surname.'</td>';
                $html_ .= '<td style="text-align: center">';
                if ($v->status ==='Y') {
                    $html_ .= '<button  onclick ="change_status(\''.trim($v->user_id).'\',\'Y\')" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="เปิด/ปิดสถานะ">
                    <i class="fa fa-check"></i></button></td>';
                }else{
                    $html_ .= '<button  onclick ="change_status(\''.trim($v->user_id).'\',\'N\')" class="btn btn-default btn-sm" data-toggle="tooltip" data-placement="top" title="เปิด/ปิดสถานะ">
                    <i class="fa fa-user-times"></i></a></button>';
                }

                $html_ .= ' <td>

                <div class="dropdown">
                <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">จัดการ
                <span class="caret"></span></button>
                <ul class="dropdown-menu">
                  <li><a  onclick ="view(\''.trim($v->user_id).'\')" >View</a></li>
                  <li><a href="'.url('auth_user/form/?user='.$v->user_id.'').'">Edit</a></li>
                  <li><a  onclick ="delete_(\''.trim($v->user_id).'\')" >Delete</a></li>
                </ul>
              </div></td>';
              $html_ .= ' </tr>';
            }


        }
        $html_ .= '</tbody>';
        $html_ .= '</table>';
        $html_ .= '<script>
                     $("#example3").DataTable();
                    </script>';
        echo $html_;
    }
    public function form(Request $request,Route $route)
    {
        $data = array();
        $post = $request->all();
        if (isset($post) && $post <> null) {
            $data['data'] =  DB::table('st_users')
            ->where('user_id','=',''.$post['user'].'')->first();
        }
        $data['roleAll'] = Systems::roleNameAll();

        return view('auth::users/showform',$data);
    }

    public function view(Request $request,Route $route)
    {
        $get = $request->all(); $user =array();
        if (isset($get) && $get <> null) {
            $user = DB::table('st_users')->where('user_id','=',''.$get['user_id'].'')->first();
                $data['data'] = $user;
                $data['roleAll'] = Systems::roleNameAll();
            return view('auth::users/view',$data);
        }
    }

    public function save(Request $request,Route $route)
    {
        $post = $request->all();
        $val = Validator::make($request->all(), [
            'Username' => 'required',
            'Password' => 'required',
            'Name' => 'required',
            'Surname' => 'required',
            'role_id' => 'required',
            'email' => 'required',
            'state' => 'required',
            // 'fileToUpload' => 'file|max:1024',
        ]);
        if ($val->fails()) {
            return redirect()->back()->withInput()->withErrors($val->errors());
        }else{

            $check = DB::select('select * from st_users where User_name =  ?', [''.$post['Username'].'']);
            if(count($check) > 0){
                return redirect()->back()->with('message','ขออภัยมี username นี้อยู่ในระบบแล้ว!');
                exit();
            }
            else{
                // $_us_id = Systems::getUserid_all();
                // $_us_id = $_us_id[0]->user_id;
                $_us_id = 'US'.date('Ymdhis');
                $_us_id = (isset($post['user_id'])&& $post['user_id']<>'') ? $post['user_id'] : $_us_id ;
                  $arrayData = array(
                  'user_id' => $_us_id,
                  'name' => $post['Name'],
                  'surname' => $post['Surname'],
                  'User_name' => $post['Username'],
                  'password' => hash('sha256', $post['Password']),
                  'role_id' => $post['role_id'],
                  'email' => $post['email'],
                  'address' => $post['address'],
                  'phone' => $post['phone'],
                  'status' => $state = (isset($post['state'])&&$post['state'] ==='on') ? 'Y' : 'N' ,
                  'created_at' => date('Y-m-d'),
                  'create_by' => ''.Session::get('auth')['user_id'].'',
                );

                $res = DB::table('st_users')->insertGetId($arrayData);
                try {
                    if($res)  return redirect('auth_user'); exit();
                } catch (\Throwable $th) {
                    return redirect()->back()->with('message','Error!');
                }
            }

        }
    }

    public function update(Request $request,Route $route)
    {
        $post = $request->all();
        $val = Validator::make($request->all(), [
            'Username' => 'required',
            'Name' => 'required',
            'Surname' => 'required',
            'role_id' => 'required',
            'email' => 'required',
        ]);
        if ($val->fails()) {
            return redirect()->back()->withInput()->withErrors($val->errors());
        }else{

                $arrayData = array(
                    'name' => $post['Name'],
                    'surname' => $post['Surname'],
                    'User_name' => $post['Username'],
                    'role_id' => $post['role_id'],
                    'email' => $post['email'],
                    'address' => $post['address'],
                    'phone' => $post['phone'],
                    'status' => $state = (isset($post['state'])&&$post['state'] ==='on') ? 'Y' : 'N' ,
                    'updated_at' => date('Y-m-d'),
                    'update_by' => ''.Session::get('auth')['user_id'].'',
              );
              if((isset($post['Password'])&&$post['Password']<>null)) $arrayData['password'] = hash('sha256', $post['Password']);
              $res = DB::table('st_users')->where('user_id','=',''.$post['user_id'].'')->update($arrayData);
              try {
                if($res)  return redirect('auth_user'); exit();
                } catch (\Throwable $th) {
                    return redirect()->back()->with('message','Error!');
                }
        }
    }

    public function change_status(Request $request,Route $route)
    {
        $post = $request->all();
        if (isset($post) && $post <> null) {
            if (isset($post['user_id']) && $post['user_id'] <>'' && isset($post['state']) && $post['state'] <>'') {
                $state = ($post['state']==='Y') ? 'N' : 'Y' ;
               DB::update('update st_users set status = "'.$state.'" where user_id = ?', [$post['user_id']]);

            }
        }
    }

    public function delete(Request $request,Route $route)
    {
        $post = $request->all();
        if (isset($post) && $post <> null) {
            if (isset($post['user_id']) && $post['user_id']) {
                $sql = "delete from st_users where user_id = '".$post['user_id']."' ";
                DB::select($sql);
            }
        }
    }

}
