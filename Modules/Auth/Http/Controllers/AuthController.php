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

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
         return view('auth::login');
    }

    public function login(Request $request)
    {
        $post = $request->all();
        $val = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required',
        ]);
        if ($val->fails()) {

            return redirect()->back()->withInput()->withErrors($val->errors());
        } else {

            $username = str_replace(' ', '', trim($post['username']));  //ตัดค่าว่างในประโยคทั้งหมด
            $password = str_replace(' ', '', trim($post['password']));  //ตัดค่าว่างในประโยคทั้งหมด

            $user = DB::table('st_users')
            ->where('User_name','=',''.$username.'')
            ->where('password','=',''.hash('sha256', $password).'')
            // ->where('status','=','Y')
            ->first();

            if ($user <> null) {
                if($user->status <> 'Y'){
                    return Redirect::to('/auth/login')->with('message','ข้อมูลผู้ใช้งาน ยังไม่ได้เปิดใช้ กรุณาติดต่อ Admin');
                    exit();
                }
                $data_log = [
                    'user_id' => $user->user_id,
                    'User_name' => $user->User_name,
                    'title' => $user->User_name,
                    'created_at' => $user->created_at,
                    'updated_at' => $user->updated_at,
                    'Login' => date("Y-m-d H:i:s"),
                    'Computer_Name' => gethostbyaddr($_SERVER['REMOTE_ADDR']),
                    'IP' => \Request::ip(),
                ];

                $log_insert = DB::table('st_log_users')->insertGetId($data_log);

                $_user = array(
                    'user_id' => $user->user_id,
                    'User_name' => $user->User_name,
                    'User_firstname' => $user->name,
                    'User_surname' => $user->surname,
                    'role_id' => $user->role_id,
                );
                // $arry_active['active'][$user->user_id] = $user->status;

                $_role = Systems::getRoleID($user->user_id);

                session(['auth' => $_user,'log' => $data_log,'log_insert'=>$log_insert,'role'=>$_role]);
                if(Session::get('redirect_to') != ''){
                    return redirect(Session::get('redirect_to'));
                }else{
                    return redirect('/main');
                }

            }else{
                return redirect()->back()->with('message','รหัสผ่านไม่ถูกต้อง กรุณาติดต่อผู้ดูแลระบบ');
            }

            }
        }
    public function logout(Request $request)
        {
            $auth = session::get('auth');
            $log = session::get('log');
            $log_insert = session::get('log_insert');
            $data = ['Logout' => date("Y-m-d H:i:s")];
            DB::table('st_log_users')->where('id', $log_insert)->update($data);
            Session::flush();
            return redirect('/auth/login');
        }
    }
