<?php

namespace Modules\Food\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Systems;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function list() {
        return view('food::table_food');
    }

    public function view(Request $request, Route $route)
    {
        // sleep(2);
        $get = $request->all();
        if($get['docno']){
            $data['head'] = DB::table('st_food_head')->where('docno', '=', $get['docno'])->first();
            $data['detail'] = DB::select('select st_food_detail.*,st_material_group.group_name from st_food_detail
            LEFT JOIN st_material_group on st_food_detail.id_material_group = st_material_group.group_id
            where docno = ?
            ORDER BY st_food_detail.created_at desc', [$get['docno']]);

            $_us_id = Systems::getProfile();
            $_us_id = $_us_id->user_id;
 
            $detail = DB::select("select st_food_detail.*,st_material_group.group_id,st_material_group.group_name,st_material_group.detail from st_food_detail 
            LEFT JOIN st_material_group on st_food_detail.id_material_group = st_material_group.group_id
            where docno = '".$get['docno']."'");
            
            $html_ = '<table class="table table-dark " id="form-table">';
            $html_ .= '<thead >';
            $html_ .= '<tr>';
            $html_ .= '<th scope="row">ลำดับที่</th>';
            $html_ .= '<th>รหัส </th>';
            $html_ .= '<th>วัตถุดิบอาหาร </th>';
            $html_ .= '<th>รายละเอียด </th>';
            $html_ .= '<th>ปริมาณ</th>';
            $html_ .= '<th>หน่วยนับ</th>';
            $html_ .= '<th>ราคา </th>';
            $html_ .= '</tr>';
            $html_ .= '</thead>';
            $html_ .= '<tbody>';
            $sum_total = 0;
            foreach ($detail as $key => $v) {
                $html_ .= '<tr id="GT">';
                $html_ .= '<td scope="row">' . $v->run_no . ' </td>';
                $html_ .= '<td>' . $v->docno . ' </td>';
                $html_ .= '<td>' . $v->group_name . ' </td>';
                $html_ .= '<td>' . $v->detail . ' </td>';
                $html_ .= '<td>' . $v->qty . '</td>';
                $html_ .= '<td>' . $v->unit . '</td>';
                $html_ .= '<td>' . $v->price . ' </td>';
               $html_ .= '</tr>';
                $sum_total += $v->price;
            }
            $html_ .= '<tr>';
 

            $html_ .= '<tr>';
            $html_ .='<td></td>';
            $html_ .='<td></td>';
            $html_ .= '<td></td>';
            $html_ .=  '<td></td>';
            $html_ .=   '<td colspan="2" align="center">รวม</td>';
            $html_ .=  '<td align="left">'.$sum_total.'</td>';
            $html_ .=  '</tr>';

            $html_ .= '</tr>';
            $html_ .= '</tbody>';
            $html_ .= '</table>';
            $html_ .=' <script>$("#form-table").DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                scrollY:        "70vh",
                scrollX:        true,
                scrollCollapse: true,
                paging:         true,

            });
            </script>';
            $data['list_table_material'] = $html_;
            return view('food::viewfood',$data);
        }
    }

    public function print_food(Request $request, Route $route)
    {
        $get = $request->all();
        if($get['docno']){
            $data['head'] = DB::table('st_food_head')->where('docno', '=', $get['docno'])->first();
            $data['detail'] = DB::select('select st_food_detail.*,st_material_group.group_name from st_food_detail
            LEFT JOIN st_material_group on st_food_detail.id_material_group = st_material_group.group_id
            where docno = ?
            ORDER BY st_food_detail.created_at desc', [$get['docno']]);

            $_us_id = Systems::getProfile();
            $_us_id = $_us_id->user_id;
 
            $detail = DB::select("select st_food_detail.*,st_material_group.group_id,st_material_group.group_name,st_material_group.detail from st_food_detail 
            LEFT JOIN st_material_group on st_food_detail.id_material_group = st_material_group.group_id
            where docno = '".$get['docno']."'");
            
            $html_ = '<table >';
            $html_ .= '<thead >';
            $html_ .= '<tr>';
            $html_ .= '<th scope="row">ลำดับที่</th>';
            $html_ .= '<th>รหัส </th>';
            $html_ .= '<th>วัตถุดิบอาหาร </th>';
            $html_ .= '<th>รายละเอียด </th>';
            $html_ .= '<th>ปริมาณ</th>';
            $html_ .= '<th>หน่วยนับ</th>';
            $html_ .= '<th>ราคา </th>';
            $html_ .= '</tr>';
            $html_ .= '</thead>';
            $html_ .= '<tbody>';
            $sum_total = 0;
            foreach ($detail as $key => $v) {
                $html_ .= '<tr id="GT">';
                $html_ .= '<td scope="row">' . $v->run_no . ' </td>';
                $html_ .= '<td>' . $v->docno . ' </td>';
                $html_ .= '<td>' . $v->group_name . ' </td>';
                $html_ .= '<td>' . $v->detail . ' </td>';
                $html_ .= '<td>' . $v->qty . '</td>';
                $html_ .= '<td>' . $v->unit . '</td>';
                $html_ .= '<td>' . $v->price . ' </td>';
               $html_ .= '</tr>';
                $sum_total += $v->price;
            }
            $html_ .= '<tr>';
 

            $html_ .= '<tr>';
            $html_ .='<td></td>';
            $html_ .='<td></td>';
            $html_ .= '<td></td>';
            $html_ .=  '<td></td>';
            $html_ .=   '<td colspan="2" align="center">รวม</td>';
            $html_ .=  '<td align="left">'.$sum_total.'</td>';
            $html_ .=  '</tr>';

            $html_ .= '</tr>';
            $html_ .= '</tbody>';
            $html_ .= '</table>';

            $data['list_table_material'] = $html_;

            return view('food::print_food',$data);
        }

    }


    public function getTable(Request $request, Route $route)
    {
        $data['datas'] = array();
        $data['datas'] = DB::select('select st_food_head.*,st_food_group.group_name from st_food_head
        LEFT JOIN st_food_group on st_food_head.group_food = st_food_group.group_id
        ORDER BY st_food_head.created_at desc');
        // dd($data);
        return view('food::getTable', $data);
    }



    public function Form_Add_list_tmp_detail(Request $request, Route $route)
    {
        $data = array();
        return view('food::show_Form_food_tmp_detail', $data);
    }

    public function Form_Edit_list_tmp_detail(Request $request, Route $route)
    {
        $post = $request->all();
        if ($post['id']) {
            $data = array();
            $data['datas'] = DB::table('temp_st_food_detail_list_material')->where('run_no', '=', $post['id'])->first();
            return view('food::show_Form_food_tmp_detail', $data);
        }
    }

    public function Form_Edit_list_tmp_detail_pageEdit(Request $request, Route $route)
    {
        $post = $request->all();

        if (isset($post['id']) && $post['id'] != '' && isset($post['docno']) && $post['docno'] != '') {

            $data = array();
            $data['datas'] = DB::table('temp_st_food_detail_list_material')
            ->where('run_no', '=', $post['id'])
            ->where('docno', '=', $post['docno'])
            ->first();
            $data['docno'] = $post['docno'];
            return view('food::show_Form_food_tmp_detail_PageEdit', $data);
        }
    }

    public function Form_Add_list_tmp_detail_Edit(Request $request, Route $route)
    {
        $data = array();
        $post = $request->all();
        $data['docno'] = $post['docno'];
        return view('food::show_Form_food_tmp_detail_PageEdit', $data);
    }

    public function Selected_group_food(Request $request, Route $route)
    {
        $data = array();
        $post = $request->all();
        $result = DB::select('SELECT * from st_food_group');
        $html_ = '';
        $html_ .= '<option value="">..เลือกกลุ่มอาหาร..</option>';

        $id = isset($post['id']) ? $post['id'] : '';
        foreach ($result as $k => $v) {
            $selected = $v->group_id == $id ? 'selected' : '';
            $html_ .= '<option ' . $selected . ' value="' . $v->group_id . '">' . $v->group_name . '</option>';
        }
        echo $html_;
        exit();
    }

    public function Selected_material_group(Request $request, Route $route)
    {
        $data = array();
        $post = $request->all();
        $result = DB::select('SELECT * from st_material_group');
        $html_ = '';
        $html_ .= '<option value="">..เลือกกลุ่มวัตถุดิบ..</option>';
        $id = $post['id'] ? $post['id'] : '';
        foreach ($result as $k => $v) {
            $selected = $v->group_id == $id ? 'selected' : '';
            $html_ .= '<option ' . $selected . ' value="' . $v->group_id . '">' . $v->group_id . ' > (' . $v->group_name . ') -> '. $v->detail .' </option>';
        }
        echo $html_;
        exit();
    }

    public function get_auto_form_detail_material(Request $request, Route $route)
    {
        $data = array();
        $post = $request->all();
        if ($post['id']) {
            $result = DB::table('st_material_group')->where('group_id', '=', $post['id'])->first();
            echo json_encode($result);
        }
        exit();
    }

    public function add_form_detail_tmp(Request $request, Route $route)
    {
        $data = array();
        $post = $request->all();
        if ($post) {
            $_us_id = Systems::getProfile();
            $_us_id = $_us_id->user_id;
            $data = array(
                'run_no' => $post['run_no'],
                'group_name_material' => $post['group_name_material'],
                'id_material_group' => $post['id_material_group'],
                'unit' => $post['unit'],
                'qty' => $post['qty'],
                'price' => $post['price'],
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

    public function get_table_form_tmp(Request $request, Route $route)
    {
        $_us_id = Systems::getProfile();
        $_us_id = $_us_id->user_id;
        $data = DB::table('temp_st_food_detail_list_material')
        ->where('create_by', '=', $_us_id)
        ->where('docno', '=',null)
        ->get();

        $html_ = '<table class="table table-bordered " id="form-table">';
        $html_ .= '<thead >';
        $html_ .= '<tr>';
        $html_ .= '<th scope="row">ลำดับที่</th>';
        $html_ .= '<th>รหัส </th>';
        $html_ .= '<th>วัตถุดิบอาหาร </th>';
        $html_ .= '<th>รายละเอียด </th>';
        $html_ .= '<th>ปริมาณ</th>';
        $html_ .= '<th>หน่วยนับ</th>';
        $html_ .= '<th>ราคา </th>';
        $html_ .= '<th>Tool</th>';
        $html_ .= '</tr>';
        $html_ .= '</thead>';
        $html_ .= '<tbody>';

        foreach ($data as $key => $v) {
            $html_ .= '<tr id="GT">';
            $html_ .= '<td scope="row">' . $v->run_no . ' </td>';
            $html_ .= '<td>' . $v->id_material_group . ' </td>';
            $html_ .= '<td>' . $v->group_name_material . ' </td>';
            $html_ .= '<td>' . $v->detail . ' </td>';
            $html_ .= '<td>' . $v->qty . '</td>';
            $html_ .= '<td>' . $v->unit . '</td>';
            $html_ .= '<td>' . $v->price . ' </td>';

            $html_ .= '<td><a href="#" onclick="edit_d(\'' . $v->run_no . '\')" class="btn btn-primary btn-sm a-btn-slide-text button_scale">
            <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
            <span><strong>Edit</strong></span>
             </a>
             <a name="" id="" onclick="del_d(\'' . $v->run_no . '\')" class="btn btn-danger btn-sm button_scale" href="#" role="button"><i class="fa fa-minus" aria-hidden="true"></i></a></td>';
            $html_ .= '</tr>';
        }
        $html_ .= '</tbody>';
        $html_ .= '</table>';

        $html_ .= '<script>
            $("#form-table").DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                // "autoWidth": false,
                scrollY:        "70vh",
                scrollX:        true,
                scrollCollapse: true,
                paging:         true,
              });

              </script>';
        echo $html_;
        exit();

    }


    public function get_table_Edit_food(Request $request, Route $route)
    {
        sleep(1);
        $post = $request->all();
        if($post){
            $_us_id = Systems::getProfile();
            $_us_id = $_us_id->user_id;
            // mark
            $detail = DB::table('temp_st_food_detail_list_material')
            ->where('create_by', '=', $_us_id)
            ->where('docno', '=',$post['docno'])
            ->get();
            $html_ = '<table class="table table-dark " id="form-table">';
            $html_ .= '<thead >';
            $html_ .= '<tr>';
            $html_ .= '<th scope="row">ลำดับที่</th>';
            $html_ .= '<th>รหัส </th>';
            $html_ .= '<th>วัตถุดิบอาหาร </th>';
            $html_ .= '<th>รายละเอียด </th>';
            $html_ .= '<th>ปริมาณ</th>';
            $html_ .= '<th>หน่วยนับ</th>';
            $html_ .= '<th>ราคา </th>';
            $html_ .= '<th>Tool</th>';
            $html_ .= '</tr>';
            $html_ .= '</thead>';
            $html_ .= '<tbody>';
            $sum_total = 0;
            foreach ($detail as $key => $v) {
                $html_ .= '<tr id="GT">';
                $html_ .= '<td scope="row">' . $v->run_no . ' </td>';
                $html_ .= '<td>' . $v->docno . ' </td>';
                $html_ .= '<td>' . $v->group_name_material . ' </td>';
                $html_ .= '<td>' . $v->detail . ' </td>';
                $html_ .= '<td>' . $v->qty . '</td>';
                $html_ .= '<td>' . $v->unit . '</td>';
                $html_ .= '<td>' . $v->price . ' </td>';

                $html_ .= '<td><a  onclick="edit_d(\'' . $v->run_no . '\',\'' . $v->docno . '\')" class="btn btn-primary btn-sm a-btn-slide-text button_scale">
                <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                <span><strong>Edit</strong></span>
                </a>
                <a name="" id="" onclick="del_d(\'' . $v->run_no . '\',\'' . $v->docno . '\')" class="btn btn-danger btn-sm button_scale"  role="button"><i class="fa fa-minus" aria-hidden="true"></i></a></td>';
                $html_ .= '</tr>';
                $sum_total += $v->price;
            }
            $html_ .= '<tr>';
 

            $html_ .= '<tr>';
            $html_ .='<td></td>';
            $html_ .='<td></td>';
            $html_ .= '<td></td>';
            $html_ .=  '<td></td>';
            $html_ .=   '<td colspan="2" align="center">รวม</td>';
            $html_ .=  '<td align="left">'.$sum_total.'</td>';
            $html_ .=  '</tr>';

            $html_ .= '</tr>';
            $html_ .= '</tbody>';
            $html_ .= '</table>';
            $html_ .=' <script>$("#form-table").DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                scrollY:        "70vh",
                scrollX:        true,
                scrollCollapse: true,
                paging:         true,

            });
            </script>';
            echo $html_;

        }
        exit();

    }





}
