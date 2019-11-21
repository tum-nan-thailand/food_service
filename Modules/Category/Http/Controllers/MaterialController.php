<?php

namespace Modules\Category\Http\Controllers;
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
use App\Importdata;
use App\Exportdata;
use PHPExcel;
use PHPExcel_IOFactory;
use PHPExcel_Shared_Date;
use PHPExcel_Style_NumberFormat;
use Redirect;

class MaterialController extends Controller
{

    public function material_group()
    {
        return view('category::material/table_group');
    }

    public function form_material_group(Request $request,Route $route)
    {
        $data['data'] = array();
        $get = $request->all();
        if(isset($get['group_id']) && $get['group_id'] <> null && $get['group_id'] <> ''){
            $data['datas'] = DB::table('st_material_group')->where('group_id','=',''.$get['group_id'].'')->first();
        }
        return view('category::material/form_group',$data);
    }

    public function getTable(Request $request,Route $route)
    {
        $data['datas'] = array();
        $data['datas'] = DB::select('select * from st_material_group ORDER BY created_at desc');
        return view('category::material/getTable_group',$data);
    }

    public function material_group_save(Request $request,Route $route)
    {
        $post = $request->all();
        $val = Validator::make($request->all(), [
            'group_id' => 'required',
            'group_name' => 'required',
            'unit' => 'required',
            'price' => 'required',
            'detail' => 'required',
        ]);
        if ($val->fails()) {
            return redirect()->back()->withInput()->withErrors($val->errors());
        }else{
                $_us_id = Systems::getProfile();
                $_us_id = $_us_id->user_id;
                  $arrayData = array(
                  'group_id' => $post['group_id'],
                  'group_name' => $post['group_name'],
                  'detail' => $post['detail'],
                  'unit' => $post['unit'],
                  'price' => $post['price'],
                  'create_by' => $_us_id,
                  'created_at' => date('Y-m-d'),
                //   'update_by' => $post['email'],
                //   'updated_at' => $post['address'],
                );
                try {
                    $res = DB::table('st_material_group')->insertGetId($arrayData);
                    return redirect('category/material_group');
                } catch (\Throwable $th) {
                    return redirect()->back()->with('message','เกิดข้อผิดพลาด!');
                }

        }
    }

    public function material_group_update(Request $request,Route $route)
    {
        $post = $request->all();
        $val = Validator::make($request->all(), [
            'group_id' => 'required',
            'group_name' => 'required',
            'unit' => 'required',
            'price' => 'required',
            'detail' => 'required',
            'group_id_default' => 'required',
        ]);
        if ($val->fails()) {
            return redirect()->back()->withInput()->withErrors($val->errors());
        }else{
                $_us_id = Systems::getProfile();
                $_us_id = $_us_id->user_id;
                  $arrayData = array(
                  'group_id' => $post['group_id'],
                  'group_name' => $post['group_name'],
                  'detail' => $post['detail'],
                  'unit' => $post['unit'],
                  'price' => $post['price'],
                //   'create_by' => $_us_id,
                //   'created_at' => date('Y-m-d'),
                  'update_by' => $_us_id,
                  'updated_at' =>  date('Y-m-d'),
                );
                try {
                    $res = DB::table('st_material_group')->where('group_id','=',''.$post['group_id_default'].'')->update($arrayData);
                    return redirect('category/material_group');
                } catch (\Throwable $th) {
                    return redirect()->back()->with('message','เกิดข้อผิดพลาด!');
                }

        }
    }

    public function check_groupid_duplicate(Request $request,Route $route)
    {
        $get = $request->all();
        if(isset($get['group_id']) && $get['group_id'] <> null && $get['group_id'] <> ''){
            $check = DB::select("select * from st_material_group where group_id = '".$get['group_id']."' ");
            if(count($check)>0){
                echo "true";
            }else{
                echo "no";
            }
        }
    }

    function view_material_group(Request $request,Route $route)
    {
        $get = $request->all();
        if(isset($get['group_id']) && $get['group_id'] <> null && $get['group_id'] <> ''){
            $data['datas'] = DB::table('st_material_group')->where('group_id','=',''.$get['group_id'].'')->first();
            return view('category::material/view_group',$data);
        }

    }

    function delete_material_group(Request $request,Route $route)
    {
        $get = $request->all();
        if(isset($get['group_id']) && $get['group_id'] <> null && $get['group_id'] <> ''){
            try {
                $res = DB::delete('delete from st_material_group where group_id = ?', [''.$get['group_id'].'']);
                echo "success";
            } catch (\Throwable $th) {
                echo "error";
            }
        }
    }
        // ถ้าออนไลน์
    public function example_import_materialgroup(Request $request,Route $route)
    {
       $html_ = '';
       $html_ .= '<style>
       .myofficeviewer{
         box-shadow: 0 0.25em 0.25em rgba(0, 0, 0, 0.1);
         border: 1px solid #ECECEC;
       }
      </style>
      ';
      $url = asset('/public/dist/file/materialgroup_excel_example.xls');
      $html_ .= '<iframe class="myofficeviewer" name="officeviewer" id="officeviewer1" frameborder="0" height="550" width="100%"
            src="https://view.officeapps.live.com/op/view.aspx?src='.$url.'"  >
    </iframe>';
    echo $html_;
    }

    public function import_material_group(Request $request,Route $route)
    {
        $data['data'] = array();
        $get = $request->all();
        return view('category::material/form_import_group',$data);
    }

    public function upload_material_group(Request $request,Route $route){
        $post = $request->all();
        $val = Validator::make($request->all(), [
            'excle_files' => 'required',
        ]);
        if ($val->fails()) {
            return redirect()->back()->withInput()->withErrors($val->errors());
        } else {
            try {
                $upload_data = [];
                $_upload_res = Systems::moveFileUploadCallback($request,$post['excle_files'],'groupMaterial',date('Y-m-d'),'import_'.Session::get('auth')['user_id']);
                session(['excle_files_groupFoods' => $_upload_res]);
                session(['upload_data' => $upload_data]);
                return redirect('category/upload_material_group_view');
              } catch (Exception  $e) {
                  return redirect()->back()->with('message','เกิดข้อผิดพลาด!');
              }

        }
    }

    public function upload_material_group_view(Request $request,Route $route)
    {
        //echo public_path().'\PHPExcel\Classes\PHPExcel.php';
        /** PHPExcel */
        if(Session::get('excle_files_groupFoods')['path'] == ''){
            return redirect()->back()->with('message','เกิดข้อผิดพลาด! กรุณาอัพโหลดไฟล์ก่อน');
        }
        $file = Session::get('excle_files_groupFoods')['path'];
        try {
          $getdata = Importdata::group_material($file);
          if($getdata ==='NO DATA'){
            return redirect()->back()->with('message','เกิดข้อผิดพลาด No DATA!');
          }
          $data["datas"]=$getdata["rowdata"];
          return view('category::material/view_import_group',$data);
        } catch (Exception  $e) {
            return redirect()->back()->with('message','เกิดข้อผิดพลาด!');
        }
    }

    public function material_group_checkImport(Request $request,Route $route)
    {
        $import_data = $request->input('jsondata');
        $arr_file = explode(".", Session::get('excle_files_groupFoods')['name']);
        $File_name =  $arr_file[0];

        if(!empty($import_data)){
            foreach ($import_data as $key => $v) {
                $log_data = [
                    'group_id' => $v['group_id'],
                    'group_name' => $v['group_name'],
                    'detail' => $v['detail'],
                    'unit' => $v['unit'],
                    'price' => $v['price'],
                    'File_name' => $File_name,
                ];
                $result = DB::table('temp_st_material_group')->insert($log_data);
                  //check ซ้ำ
            }
            $sql = "select temp_st_material_group.group_id from  temp_st_material_group
            where exists (
              select distinct st_material_group.group_id  from st_material_group
              where st_material_group.group_id = temp_st_material_group.group_id
            )
            and temp_st_material_group.File_name = '".$File_name."'";
            $result = DB::select($sql);
            if(!empty($result)){
                return response()->json(["data"=>'09',"status"=>'unsuccess','message'=>'ข้อมูลรหัสซ้ำ ไม่สามารถ Import ได้']);
            }else{
                try {
                    if(!empty($import_data)){
                        foreach ($import_data as $key => $v) {
                            $datas = [
                                'group_id' => $v['group_id'],
                                'group_name' => $v['group_name'],
                                'detail' => $v['detail'],
                                'unit' => $v['unit'],
                                'price' => $v['price'],
                            ];
                            $result = DB::table('st_material_group')->insert($datas);
                        }
                    }
                    return response()->json(["data"=>'09',"status"=>'success','message'=>'success']);
                } catch (\Throwable $th) {
                    return response()->json(["data"=>'09',"status"=>'unsuccess','message'=>'เกิดข้อผิดพลาด']);
                }
            }

        }else{
            return response()->json(["data"=>'09',"status"=>'unsuccess','message'=>'no data']);
        }

    }

    // public function export_excel_material_group(Request $request,Route $route)
    // {
    //         try {
    //             header("Pragma: public");
    //             header("Expires: 0");
    //             header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    //             header("Content-Type: application/force-download");
    //             header("Content-Type: application/octet-stream");
    //             header("Content-Type: application/download");
    //             header("Content-Disposition: attachment;filename=กลุ่มวัตถุดิบ ".date('Ymd').".xls");
    //             header("Content-Transfer-Encoding: binary");

    //             $data['datas'] = DB::select('select * from st_material_group');
    //             // echo "succsees";
    //             return view('category::material/export_group',$data);
    //             exit();
    //         } catch (\Throwable $th) {
    //             return redirect()->back()->with('message','เกิดข้อผิดพลาด!');
    //         }
    // }

    public function export_excel_material_group(Request $request,Route $route)
    {
            try {
                $data['datas'] = DB::select('select * from st_material_group');
                $getdata = Exportdata::group_material($data);
                exit();
            } catch (\Throwable $th) {
                return redirect()->back()->with('message','เกิดข้อผิดพลาด!');
            }
    }



}
