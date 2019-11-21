<?php

namespace Modules\Calcuate\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Systems;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\DB;

class CalculateController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('calcuate::calculate');
    }

    public function get_list_group_food(Request $request, Route $route)
    {
        $data = array();
        $post = $request->all();
        $result = DB::select('SELECT * from st_food_group');
        $html_ = '';

        $html_ .= '<option value="">..เลือกกลุ่มวัตถุดิบ..</option>';
        $id = '';
        foreach ($result as $k => $v) {
            $selected = $v->group_id == $id ? 'selected' : '';
            $html_ .= '<option ' . $selected . ' value="' . $v->group_id . '">' . $v->group_id . ' > (' . $v->group_name . ')</option>';
        }
        echo $html_;
        exit();
    }

    public function get_datas_groupfood(Request $request, Route $route)
    {
        $data = array();
        $post = $request->all();
        $result['datas_group_food'] = DB::select("SELECT * from st_food_group where group_id = '".$post['id']."' ");
        $result['datas_list_food'] = DB::select("SELECT * from st_food_head WHERE group_food = '".$post['id']."' ");

        echo json_encode($result);
    }

    public function get_datas_food_price(Request $request, Route $route)
    {
        $data = array();
        $post = $request->all();
        $result['datas_list_food'] = DB::select("SELECT * from st_food_head WHERE docno = '".$post['id']."' ");
        
        $result['datas_list_food_detail'] = DB::select("select st_food_detail.*,st_material_group.group_id,st_material_group.group_name,st_material_group.detail from st_food_detail 
        LEFT JOIN st_material_group on st_food_detail.id_material_group = st_material_group.group_id
        where docno = '".$post['id']."'");

        $result['datas_calculate'] = DB::select("select 
        st_food_detail.docno
        ,st_food_detail.id_material_group
        ,sum( st_food_detail.qty) as qty
        ,sum( st_food_detail.price) as price
        ,st_food_detail.unit
        ,st_food_detail.create_by
        ,st_material_group.group_name 
        ,st_material_group.group_id
        ,st_material_group.detail
        from st_food_detail 
        LEFT JOIN st_material_group on st_food_detail.id_material_group = st_material_group.group_id
        where docno = '".$post['id']."'
        GROUP BY docno,id_material_group,create_by,group_id,group_name,st_food_detail.unit,st_material_group.detail");
 
        echo json_encode($result);
    }

    public function print_order(Request $request, Route $route)
    {  
        $data = array();
        $post = $request->all();
        if($post){
            // dd($post);
            $data = array();
            //set Data
            for ($i=0; $i < count($post['group_id']); $i++) { 
                $data[$i]['group_id'] = $post['group_id'][$i];
                $data[$i]['group_name'] = $post['group_name'][$i];
                $data[$i]['detail'] = $post['detail'][$i]; 
                $data[$i]['val_order'] = $post['val_order'][$i];
                $data[$i]['unit'] = $post['unit'][$i];
                $data[$i]['price'] = $post['price'][$i]; 
            }

            // dd($post);
            $sum_totoal = $post['sum_totoal'];
            $datas['datas'] = $data;
            $datas['sum_totoal'] = $sum_totoal;
            $datas['num_serve'] = $post['count_list'];
            $datas['datas_head_food'] = DB::select("SELECT st_food_head.*,st_food_group.group_name from st_food_head 
            LEFT JOIN st_food_group on st_food_head.group_food = st_food_group.group_id
             where st_food_head.docno = '".$post['docno']."' ");
      
            return view('calcuate::print_order',$datas);
        }else{
            return Redirect::to('/main');
        }
    }
}
