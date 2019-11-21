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

use Redirect;
use PHPExcel;
use PHPExcel_IOFactory;
use PHPExcel_Shared_Date;


class Importdata extends Model
{
    public static function group_material($file){
        require_once 'public/PHPExcel/Classes/PHPExcel.php';
        /** PHPExcel_IOFactory - Reader */
        include 'public/PHPExcel/Classes/PHPExcel/IOFactory.php';


        $inputFileName = $file;
        $inputFileName = 'public/'.$inputFileName;
        // $inputFileName = 'public/กลุ่มวัตถุดิบ.xls';


        $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
        $objReader = PHPExcel_IOFactory::createReader($inputFileType);
        $objReader->setReadDataOnly(true);
        $objPHPExcel = $objReader->load($inputFileName);

        /*
        // for No header
        $objWorksheet = $objPHPExcel->setActiveSheetIndex(0);
        $highestRow = $objWorksheet->getHighestRow();
        $highestColumn = $objWorksheet->getHighestColumn();

        $r = -1;
        $namedDataArray = array();
        for ($row = 1; $row <= $highestRow; ++$row) {
            $dataRow = $objWorksheet->rangeToArray('A'.$row.':'.$highestColumn.$row,null, true, true, true);
            if ((isset($dataRow[$row]['A'])) && ($dataRow[$row]['A'] > '')) {
                ++$r;
                $namedDataArray[$r] = $dataRow[$row];
            }
        }
        */


        $objWorksheet = $objPHPExcel->setActiveSheetIndex(0);
        $highestRow = $objWorksheet->getHighestRow();
        $highestColumn = $objWorksheet->getHighestColumn();

        if($highestRow<=1){
            return 'NO DATA';
        }
        // header
        $headingsArray = $objWorksheet->rangeToArray('A1:'.$highestColumn.'1',null, true, true, true);
        $headingsArray = $headingsArray[1];


        $r = 0;
        $namedDataArray = array();

        for ($row = 2; $row <= $highestRow; ++$row) {
            $dataRow  = $objWorksheet->rangeToArray('A'.$row.':'.$highestColumn.$row,null, true, true, true);
            if ((isset($dataRow[$row]['A'])) && ($dataRow[$row]['A'] > '')) {
            $arraydataRow[$r] = $dataRow[$row];
                ++$r;
            }
        }

        foreach ($arraydataRow as $k => $v) {
            $rowdata[]=[
              'group_id' => $v['A'],
              'group_name' => $v['B'],
              'detail' => $v['C'],
              'unit' => $v['D'],
              'price' => $v['E'],
            ];
        }

        $data["rowdata"]=$rowdata;
        return $data;
    }


    public static function group_foods($file){
        require_once 'public/PHPExcel/Classes/PHPExcel.php';
        /** PHPExcel_IOFactory - Reader */
        include 'public/PHPExcel/Classes/PHPExcel/IOFactory.php';


        $inputFileName = $file;

        $inputFileName = 'public/'.$inputFileName;
        $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
        $objReader = PHPExcel_IOFactory::createReader($inputFileType);
        $objReader->setReadDataOnly(true);
        $objPHPExcel = $objReader->load($inputFileName);

        $objWorksheet = $objPHPExcel->setActiveSheetIndex(0);
        $highestRow = $objWorksheet->getHighestRow();
        $highestColumn = $objWorksheet->getHighestColumn();

        if($highestRow<=1){
            return 'NO DATA';
        }
        // header
        $headingsArray = $objWorksheet->rangeToArray('A1:'.$highestColumn.'1',null, true, true, true);
        $headingsArray = $headingsArray[1];


        $r = 0;
        $namedDataArray = array();

        for ($row = 2; $row <= $highestRow; ++$row) {
            $dataRow  = $objWorksheet->rangeToArray('A'.$row.':'.$highestColumn.$row,null, true, true, true);
            if ((isset($dataRow[$row]['A'])) && ($dataRow[$row]['A'] > '')) {
            $arraydataRow[$r] = $dataRow[$row];
                ++$r;
            }
        }

        foreach ($arraydataRow as $k => $v) {
            $rowdata[]=[
              'group_id' => $v['A'],
              'group_name' => $v['B'],
            ];
        }

        $data["rowdata"]=$rowdata;
        return $data;
    }

}
