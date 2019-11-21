<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Route;

use PHPExcel;
use PHPExcel_IOFactory;
use PHPExcel_Shared_Date;
use PHPExcel_Style_NumberFormat;
use Redirect;

class Systems extends Model
{
    // log เปลี่ยนหน้า
    public static function Redirect($notRedirect = 'true')
    {
        // $agent = new Agent();
        // $platform['device'] = $agent->device();
        // $platform['platform'] = $agent->platform();
        // $platform['browser'] = $agent->browser();
        // $user_log = [
        //     'User_Id'        => Session::get('auth')['User_Id'],
        //     'Name'  => Session::get('auth')['User_Name'],
        //     'Employeeid'       => Session::get('auth')['User_Employeeid'],
        //     'Log_Ip'      => \Illuminate\Support\Facades\Request::ip(),
        //     'Log_Url'   => \Illuminate\Support\Facades\Request::fullUrl(),
        //     'Log_Referer'   => URL::previous(),
        //     'Created_At'   => date("Y-m-d H:i:s"),
        //     'Platform'   => json_encode($platform),
        // ];
        // $result = DB::connection('sqlsrv_write')->table('Log_Redirect')->insert($user_log);
        // return $result;
    }

    public static function getRoleID($ID, $label = false)
    {
        $data = array();
        $sql = "SELECT * FROM  st_user_rolemaster WHERE role_id IN (SELECT role_id FROM st_users WHERE user_id = '" . $ID . "')";
        $datas = DB::select($sql);

        if ($label) {
            $data = '';
            foreach ($datas as $key => $value) {
                $data .= '<span class="label label-default">' . $value->Title . '</span><br/>';
            }
        } else {
            $data = $datas;
        }
        return $data;
    }

    public static function getUserid_all()
    {
        $data = array();
        $sql = "select user_id from st_users ORDER BY user_id desc limit 1";
        $datas = DB::select($sql);
        return $datas;
    }

    public static function getProfile()
    {
        $datas = DB::table('st_users')
        ->where('user_id','=',''.Session::get('auth')['user_id'].'')->first();
        return $datas;
    }

    public static function getProfile_role_name()
    {
        $sql = " SELECT st_users.*,st_user_rolemaster.role_name from st_users
        LEFT JOIN st_user_rolemaster on st_users.role_id = st_user_rolemaster.id
        where st_users.user_id = '".Session::get('auth')['user_id']."'
        limit 1";
        $datas = DB::select($sql);
        return $datas;
    }

    public static function Check_Password($password)
    {
        $datas = DB::table('st_users')
        ->where('user_id','=',''.Session::get('auth')['user_id'].'')
        ->where('password','=',''.hash('sha256', $password).'')
        ->first();
        return $datas;
    }

    public static function roleNameAll()
    {
        $datas = DB::table('st_user_rolemaster')->get();
        return $datas;
    }

    public static function moveFileUploadCallback($request,$inputUpload,$folder_main,$folder_sub,$filename){
        // move file upload

        $move_file_list = [];
        //foreach ($inputUpload as $key => $value) {
            $folder = base_path("public/uploads/".$folder_main."/".$folder_sub);
            $path = "uploads/".$folder_main."/".$folder_sub;
            $file = $inputUpload;
            $type_file = $file->getClientOriginalExtension();
            $size_file = $file->getClientSize();
            $type = $file->getClientMimeType();
            $name = $filename.'_'.date("YmdHis").'_'.rand(10000,90000).'.'.$type_file;
            $move_file = $file->move($folder, $name);
            $move_file_list['name'] = $name;
            $move_file_list['path'] = $path.'/'.$name;

        //}
        return $move_file_list;
    }
}
