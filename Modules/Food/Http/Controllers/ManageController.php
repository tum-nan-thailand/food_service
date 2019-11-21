<?php

namespace Modules\Food\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Systems;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Redirect;

class ManageController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */

    public function __construct(Request $request,Route $route)
    {
        set_time_limit(0);

        $this->middleware(function ($request, $next) {
            if(Session::get('auth')['role_id'] <> '1'){
                return Redirect::to('/main');
            }else{
                return $next($request);
            }
        });
    }

    public function Form(Request $request, Route $route)
    {
        $data = array();
        $post = $request->all();
        $_us_id = Systems::getProfile();
        $_us_id = $_us_id->user_id;
        DB::delete("delete from  temp_st_food_detail_list_material where create_by = '" . $_us_id . "' ");

        $data['roleAll'] = Systems::roleNameAll();

        return view('food::form', $data);
    }

    public function update_form_tmp_form_detail_tmp(Request $request, Route $route)
    {
        $data = array();
        $post = $request->all();
        if ($post) {
            $_us_id = Systems::getProfile();
            $_us_id = $_us_id->user_id;
            // ราคา ต่อ 1 เสริฟ
            $price_  = ($post['price'] * $post['qty']);
            $data = array(
                'run_no' => $post['run_no'],
                'group_name_material' => $post['group_name_material'],
                'id_material_group' => $post['id_material_group'],
                'unit' => $post['unit'],
                'qty' => $post['qty'],
                'price' => $price_,
                'detail' => $post['detail'],
                'update_by' => $_us_id,
                'updated_at' => date('Y-m-d'),
            );
            // dd($data);

            try {
                $result = DB::table('temp_st_food_detail_list_material')
                ->where('run_no', '=', $post['run_no_defult'])
                ->where('create_by', '=', $_us_id)
                ->update($data);
                return response()->json(["data" => '09', "status" => 'success', 'message' => 'success']);
            } catch (\Throwable $th) {
                return response()->json(["data" => '09', "status" => 'unsuccess', 'message' => 'ข้อมูลลำดับซ้ำ']);
            }
        }
    }

    public function update_form_tmp_form_detail_tmp_EditPage(Request $request, Route $route)
    {
        $data = array();
        $post = $request->all();
        if ($post) {
            $_us_id = Systems::getProfile();
            $_us_id = $_us_id->user_id;
            $price_  = ($post['price'] * $post['qty']);
            $data = array(
                'run_no' => $post['run_no'],
                'group_name_material' => $post['group_name_material'],
                'id_material_group' => $post['id_material_group'],
                'unit' => $post['unit'],
                'qty' => $post['qty'],
                'price' => $price_,
                'detail' => $post['detail'],
                'update_by' => $_us_id,
                'updated_at' => date('Y-m-d'),
                'docno' => $post['docno'],
            );

            try {
                $result = DB::table('temp_st_food_detail_list_material')
                ->where('run_no', '=', $post['run_no_defult'])
                ->where('create_by', '=', $_us_id)
                ->where('docno', '=', $post['docno'])
                ->update($data);
                return response()->json(["data" => '09', "status" => 'success', 'message' => 'success']);
            } catch (\Throwable $th) {
                return response()->json(["data" => '09', "status" => 'unsuccess', 'message' => 'ข้อมูลลำดับซ้ำ']);
            }
        }
    }



    public function delete_form_detail_tmp(Request $request, Route $route)
    {
        $post = $request->all();
        if ($post) {
            DB::delete("delete from  temp_st_food_detail_list_material where run_no = '" . $post['id'] . "' ");
        }
    }

    public function delete_form_detail(Request $request, Route $route)
    {
        $post = $request->all();
        if ($post) {
            DB::delete("delete from  temp_st_food_detail_list_material
            where run_no = '" . $post['id'] . "'
            and docno = '" . $post['docno'] . "' ");
        }
    }

    public function CheckDuplicate_form_detail_tmp(Request $request, Route $route)
    {
        $post = $request->all();
        $_us_id = Systems::getProfile();
        $_us_id = $_us_id->user_id;
        if ($post['id']) {
            $data = array();
            $Duplicate = DB::table('temp_st_food_detail_list_material')
                ->where('run_no', '=', $post['id'])
                ->where('create_by', '=', $_us_id)
                ->first();
            if ($Duplicate) {
                return response()->json(["data" => '09', "status" => 'unsuccess', 'message' => 'ข้อมูลลำดับซ้ำ กรุณาจัดใหม่อีกครั้ง']);
            }
        }
    }

    public function CheckDuplicate_form_detail(Request $request, Route $route)
    {
        $post = $request->all();
        $_us_id = Systems::getProfile();
        $_us_id = $_us_id->user_id;

        if ($post['id'] && $post['docno']) {
            $data = array();
            $Duplicate = DB::table('temp_st_food_detail_list_material')
                ->where('run_no', '=', $post['id'])
                ->where('docno', '=', $post['docno'])
                ->where('create_by', '=', $_us_id)
                ->first();

            if ($Duplicate) {
                return response()->json(["data" => '09', "status" => 'unsuccess', 'message' => 'ข้อมูลลำดับซ้ำ กรุณาจัดใหม่อีกครั้ง']);
            }
        }
    }

    public function form_update_food(Request $request, Route $route)
    {

        $data = array();
        $post = $request->all();
        $_us_id = Systems::getProfile();
        $_us_id = $_us_id->user_id;
        $chcek = false;
        // $detail = DB::table('temp_st_food_detail_list_material')
        // ->where('create_by', '=', $_us_id)
        // ->get();
        // dd( $detail);
        if (isset($post) && $post != null) {
            $data['head'] = DB::table('st_food_head')->where('docno', '=', $post['id'])->first();
            $data['detail'] = DB::select('select st_food_detail.*
            ,st_material_group.group_name ,st_material_group.detail from st_food_detail
            LEFT JOIN st_material_group on st_food_detail.id_material_group = st_material_group.group_id
            where docno = ?
            ORDER BY st_food_detail.created_at desc', [$post['id']]);

            if(isset($data['head']) and isset($data['detail'])){
                $chcek = true;
            }
            DB::delete("delete from  temp_st_food_detail_list_material where create_by = '" . $_us_id . "' ");
             // insert Tmp
            try {
                foreach ($data['detail'] as $key => $v) {

                        DB::insert('insert into temp_st_food_detail_list_material (
                            run_no
                            ,id_material_group
                            ,group_name_material
                            ,qty
                            ,unit
                            ,price
                            ,create_by
                            ,created_at
                            ,docno
                            ,detail
                        ) values (?,?,?,?,?,?,?,?,?,?)', [
                            $v->run_no
                            , $v->id_material_group
                            , $v->group_name
                            , $v->qty
                            , $v->unit
                            , $v->price                   
                            , $v->create_by
                            , $v->created_at
                            , $v->docno
                            , $v->detail      
                        ]);
                }
            } catch (\Throwable $th) {
                return redirect('main');
            }
            if($chcek==true){
                return view('food::formEdit', $data);
            }else{
                return redirect('main');
            }

        }

    }

    public function listfood_save(Request $request, Route $route)
    {
        $post = $request->all();
        $_us_id = Systems::getProfile();
        $_us_id = $_us_id->user_id;

        $val = Validator::make($request->all(), [
            'docno' => 'required',
            'name_food' => 'required',
            'group_food' => 'required',
            'detail' => 'required',
            'file' => 'required|max:10000',

        ]);
        if ($val->fails()) {
            return redirect()->back()->withInput()->withErrors($val->errors());
        } else {
            $_upload_res = Systems::moveFileUploadCallback($request, $post['file'], 'img_food', date('Y-m-d'), 'food_' . Session::get('auth')['user_id']);
            //    $_upload_res['path']
            if (count($_upload_res) > 0) {
                $sum_tmp = DB::select("SELECT ROUND(sum(qty),2) as qty , sum(price)as price from temp_st_food_detail_list_material where create_by = '" . $_us_id . "'");
                $sum_qty = $sum_tmp[0]->qty;
                $sum_totoal = $sum_tmp[0]->price;
                $data_head = array(
                    'docno' => $post['docno'],
                    'name_food' => $post['name_food'],
                    'group_food' => $post['group_food'],
                    'sum_qty' => $sum_qty,
                    'sum_totoal' => $sum_totoal,
                    'detail' => $post['detail'],
                    'img' => $_upload_res['path'],
                    'create_by' => $_us_id,
                    'created_at' => date('Y-m-d'),
                );
                try {
                    $insert_head = DB::table('st_food_head')->insert($data_head);
                    if ($insert_head) {
                        $data_detial_ = DB::table('temp_st_food_detail_list_material')->where('create_by', '=', $_us_id)->get();
                        foreach ($data_detial_ as $key => $v) {
                            try {
                                DB::insert('insert into st_food_detail (
                        run_no
                        ,docno
                        ,id_material_group
                        ,qty
                        ,unit
                        ,price
                        ,create_by
                        ,created_at) values (?,?,?,?,?,?,?,?)', [
                                    $v->run_no
                                    , $post['docno']
                                    , $v->id_material_group
                                    , $v->qty
                                    , $v->unit
                                    , $v->price
                                    , $v->create_by
                                    , $v->created_at,
                                ]);
                            } catch (\Throwable $th) {
                                //throw $th;
                            }
                        }
                        DB::delete("delete from  temp_st_food_detail_list_material where create_by = '" . $_us_id . "' ");
                    }
                } catch (\Throwable $th) {
                    return redirect()->back()->with('message', 'เกิดข้อผิดพลาดรหัสรายการอาหารซ้ำ!');
                }
            }
            return redirect('/food');
        }
    }

    public function listfood_edit(Request $request, Route $route)
    {
        $post = $request->all();
        $_us_id = Systems::getProfile();
        $_us_id = $_us_id->user_id;

        $val = Validator::make($request->all(), [
            'docno' => 'required',
            'name_food' => 'required',
            'group_food' => 'required',
            'detail' => 'required',
            // 'file' => 'required|max:10000',
        ]);
        if ($val->fails()) {
            return redirect()->back()->withInput()->withErrors($val->errors());
        } else {
            if(isset($post['file'])){
                $_upload_res = Systems::moveFileUploadCallback($request, $post['file'], 'img_food', date('Y-m-d'), 'food_' . Session::get('auth')['user_id']);
            }
            $img = (isset($_upload_res['path'])) ? $_upload_res['path'] : '' ;
                $sum_tmp = DB::select("SELECT ROUND(sum(qty),2) as qty , sum(price)as price from temp_st_food_detail_list_material where create_by = '" . $_us_id . "'");
                $sum_qty = $sum_tmp[0]->qty;
                $sum_totoal = $sum_tmp[0]->price;
                $data_head = array(
                    'docno' => $post['docno'],
                    'name_food' => $post['name_food'],
                    'group_food' => $post['group_food'],
                    'sum_qty' => $sum_qty,
                    'sum_totoal' => $sum_totoal,
                    'detail' => $post['detail'],
                    'update_by' => $_us_id,
                    'updated_at' => date('Y-m-d'),
                );
                //ถ้ามีรุปใหม่ ให้อัพเดต
                if($img <>''){
                    $data_head += array(
                        'img' => $img,
                    );
                }


                try {
                    $insert_head = DB::table('st_food_head')
                    ->where('docno','=',$post['docno_default'])
                    ->update($data_head);

                    if ($insert_head) {
                        DB::delete("delete from st_food_detail where docno = '".$post['docno']."' and create_by = '" . $_us_id . "' ");
                        $data_detial_ = DB::table('temp_st_food_detail_list_material')->where('create_by', '=', $_us_id)->get();


                        foreach ($data_detial_ as $key => $v) {
                            try {
                                /*$data_detail = array(
                                    'run_no' => $v->run_no,
                                    'docno' => $post['docno'],
                                    'id_material_group' => $v->id_material_group,
                                    'qty' => $v->qty,
                                    'unit' => $v->unit,
                                    'price' => $v->price,
                                    'create_by' => $v->create_by,
                                    'created_at' => date('Y-m-d'),
                                );
                                */
                                DB::insert('insert into st_food_detail (
                                    run_no
                                    ,docno
                                    ,id_material_group
                                    ,qty
                                    ,unit
                                    ,price
                                    ,create_by
                                    ,created_at) values (?,?,?,?,?,?,?,?)'
                                    , [
                                    $v->run_no
                                    , $post['docno']
                                    , $v->id_material_group
                                    , $v->qty
                                    , $v->unit
                                    , $v->price
                                    , $v->create_by
                                    , $v->created_at,
                                ]);
                            } catch (\Throwable $th) {
                                //throw $th;
                            }
                        }
                        DB::delete("delete from  temp_st_food_detail_list_material where create_by = '" . $_us_id . "' ");

                    }
                } catch (\Throwable $th) {
                    return redirect()->back()->with('message', 'เกิดข้อผิดพลาดรหัสรายการอาหารซ้ำ!');
                }

            return redirect('/food');
        }
    }





    public function add_form_detail_tmp(Request $request, Route $route)
    {
        $data = array();
        $post = $request->all();
        if ($post) {
            $_us_id = Systems::getProfile();
            $_us_id = $_us_id->user_id;
            // ราคา ต่อ 1 เสริฟ
            $price_  = ($post['price'] * $post['qty']);
            $data = array(
                'run_no' => $post['run_no'],
                'group_name_material' => $post['group_name_material'],
                'id_material_group' => $post['id_material_group'],
                'unit' => $post['unit'],
                'qty' => $post['qty'],
                'price' =>  $price_,
                'detail' => $post['detail'],
                'create_by' => $_us_id,
                'created_at' => date('Y-m-d'),
            );
            try {
                $result = DB::table('temp_st_food_detail_list_material')->insertGetId($data);
                return response()->json(["data" => '09', "status" => 'success', 'message' => 'success']);
            } catch (\Throwable $th) {
                return response()->json(["data" => '09', "status" => 'unsuccess', 'message' => 'ข้อมูลลำดับซ้ำ']);
            }
        }
    }

    public function add_form_detail(Request $request, Route $route)
    {
        $data = array();
        $post = $request->all();
        if ($post) {
            $_us_id = Systems::getProfile();
            $_us_id = $_us_id->user_id;

            $data = array(
                'run_no' => $post['run_no'],
                'docno' => $post['docno'],
                'id_material_group' => $post['id_material_group'],
                'qty' => $post['qty'],
                'unit' => $post['unit'],
                'price' => $post['price'],
                'create_by' => $_us_id,
                'created_at' => date('Y-m-d'),
            );

            try {
                $result = DB::table('st_food_detail')->insert($data);
                return response()->json(["data" => '09', "status" => 'success', 'message' => 'success']);
            } catch (\Throwable $th) {
                return response()->json(["data" => '09', "status" => 'unsuccess', 'message' => 'ข้อมูลลำดับซ้ำ']);
            }
        }
    }

    public function delete_foods(Request $request, Route $route)
    {
        $post = $request->all();
        if ($post['id']) {
            DB::delete("delete from  st_food_head where docno = '" . $post['id'] . "' ");
            DB::delete("delete from  st_food_detail where docno = '" . $post['id'] . "' ");
            return response()->json(["data" => '09', "status" => 'success', 'message' => 'success']);
        }
    }

    public function add_form_detail_tmp_pageEdit(Request $request, Route $route)
    {
        $data = array();
        $post = $request->all();

        if ($post) {
            $_us_id = Systems::getProfile();
            $_us_id = $_us_id->user_id;
            // ราคา ต่อ 1 เสริฟ
            $price_  = ($post['price'] * $post['qty']);
            $data = array(
                'run_no' => $post['run_no'],
                'group_name_material' => $post['group_name_material'],
                'id_material_group' => $post['id_material_group'],
                'unit' => $post['unit'],
                'qty' => $post['qty'],
                'price' => $price_,
                'detail' => $post['detail'],
                'create_by' => $_us_id,
                'created_at' => date('Y-m-d'),
                'docno'=> $post['docno'],
            );
            try {

                $result = DB::table('temp_st_food_detail_list_material')->insertGetId($data);
                return response()->json(["data" => '09', "status" => 'success', 'message' => 'success']);
            } catch (\Throwable $th) {
                return response()->json(["data" => '09', "status" => 'unsuccess', 'message' => 'ข้อมูลลำดับซ้ำ']);
            }
        }
    }
}
