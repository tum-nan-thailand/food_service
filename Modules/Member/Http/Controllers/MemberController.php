<?php

namespace Modules\Member\Http\Controllers;

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


class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function profile()
    {
        $users = Systems::getProfile_role_name();
        $data['data'] =  $users[0];

        return view('member::profile',$data);
    }

    public function show_change_password()
    {
        $data['data'] =  Systems::getProfile();
        return view('member::show_change',$data);
    }

    public function change_password_save(Request $request, Route $route)
    {
        $post = $request->all();

        $val = Validator::make($request->all(), [
            'CurrentPassword' => 'required',
            'NewPassword' => 'required',
            'ConfirmPassword' => 'required',
        ]);
        if ($val->fails()) {
            return redirect()->back()->withInput()->withErrors($val->errors());
        } else {
            $check = Systems::Check_Password($post['CurrentPassword']);
            if($check <> null){
                DB::update('update st_users set password = "'.hash('sha256',$post['ConfirmPassword']).'" where user_id = ?', [''.Session::get('auth')['user_id'].'']);
                return Redirect::to('/auth/logout');
            }else{
                return redirect()->back()->with('message','ขออภัย รหัสผ่านเดิมไม่ถูกต้อง');
            }

        }
    }

    public function update(Request $request, Route $route)
    {
        $post = $request->all();
        $val = Validator::make($request->all(), [
            'Username' => 'required',
            'name' => 'required',
            'surname' => 'required',
        ]);
        if ($val->fails()) {
            return redirect()->back()->withInput()->withErrors($val->errors());
        } else {
        $arrayData = array(
            'name' => $post['name'],
            'surname' => $post['surname'],
            'User_name' => $post['Username'],
            'email' => $post['email'],
            'address' => $post['address'],
            'phone' => $post['phone'],
            'updated_at' => date('Y-m-d'),
      );

            $res = DB::table('st_users')->where('user_id','=',''.Session::get('auth')['user_id'].'')->update($arrayData);
              return redirect('profile'); exit();

    }
    }
}
