<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use PHPExcel;
use PHPExcel_IOFactory;

class Exportdata extends Model
{
    public static function group_material($data)
    {
        require_once 'public/PHPExcel/Classes/PHPExcel.php';
        /** PHPExcel_IOFactory - Reader */
        include 'public/PHPExcel/Classes/PHPExcel/IOFactory.php';

        $objPHPExcel = new PHPExcel();

        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(13.33);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(18.83);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(50);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(18.83);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(18.83);

        $objPHPExcel->getActiveSheet()->setTitle('กลุ่มวัตถุดิบ');
        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'รหัส');
        $objPHPExcel->getActiveSheet()->setCellValue('B1', "กลุ่ม");
        $objPHPExcel->getActiveSheet()->setCellValue('C1', "รายละเอียด");
        $objPHPExcel->getActiveSheet()->setCellValue('D1', "หน่วยนับ");
        $objPHPExcel->getActiveSheet()->setCellValue('E1', "หน่วยนับ");


        $i = 1;
        foreach ($data['datas'] as $k => $v) {
            $objPHPExcel->getActiveSheet()->setCellValue('A' . ($i + 1), $v->group_id);
            $objPHPExcel->getActiveSheet()->setCellValue('B' . ($i + 1), $v->group_name);
            $objPHPExcel->getActiveSheet()->setCellValue('C' . ($i + 1), $v->detail);
            $objPHPExcel->getActiveSheet()->setCellValue('D' . ($i + 1), $v->unit);
            $objPHPExcel->getActiveSheet()->setCellValue('E' . ($i + 1), $v->price);
            $i++;
        }

        $filename = "กลุ่มวัตถุดิบ.xlsx";
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        // We'll be outputting an excel file
        header('Content-type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename="'.$filename.'"');
       // Write file to the browser
        $objWriter->save('php://output');
        // $objWriter->save($filename);
    }

    public static function group_foods($data)
    {
        require_once 'public/PHPExcel/Classes/PHPExcel.php';
        include 'public/PHPExcel/Classes/PHPExcel/IOFactory.php';
        $objPHPExcel = new PHPExcel();

        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(13.33);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(18.83);

        $objPHPExcel->getActiveSheet()->setTitle('กลุ่มวัตถุดิบ');
        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'รหัส');
        $objPHPExcel->getActiveSheet()->setCellValue('B1', "กลุ่ม");

        $i = 1;
        foreach ($data['datas'] as $k => $v) {
            $objPHPExcel->getActiveSheet()->setCellValue('A' . ($i + 1), $v->group_id);
            $objPHPExcel->getActiveSheet()->setCellValue('B' . ($i + 1), $v->group_name);
            $i++;
        }

        $filename = "กลุ่มอาหาร.xlsx";
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        header('Content-type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename="'.$filename.'"');
        $objWriter->save('php://output');
    }

}
