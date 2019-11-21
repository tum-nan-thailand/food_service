<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <!-- Bootstrap 3.3.6 -->

    <title>Print อาหาร</title>


  <style>
    body {
        width: 100%;
        height: 100%;
        margin: 0;
        padding: 0;
        background-color: #FAFAFA;
        font: 13.5pt "Angsana New";

    }

    .page {
        width: 204mm;
        height: 260mm;
        padding: 0mm;
        margin: 10mm auto;
        border: 1px #D3D3D3 solid;
        background: white;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
    }
    .subpage {
        padding-top: 15mm;
        padding-left: 2mm;
        padding-right: 0mm;
        padding-bottom: 15mm;
        height: 260mm;

    }
    .img{
        width: 26mm;
        height: auto;
    }
    hr.style3 {
      border-top: 1px dashed #8c8b8b;
    }
    .td-table{
        padding: 0px;
    }

   .td_1{width: 11mm; text-align: center;}
   .td_2{width: 18mm; text-align: center;}
   .td_3{width: 70mm;}
   .td_4{width: 13mm; text-align: center;}
   .td_5{width: 11mm; text-align: center;}
   .td_6{width: 11mm; text-align: center;}
   .td_7{width: 15mm; text-align: right;}
   .td_8{width: 17mm; text-align: right; }
   .td_9{width: 28mm; text-align: right;}



   .t_tab_1{margin-top: 14px; margin-left: 113px;}
   .t_tab_2{margin-top: 35px; margin-left: 70px;}
   .t_tab_2_font{ font: 11pt "Angsana New"; }
   .t_tab_3{margin-left: 63px;}
   .t_tab_4{margin-top: 110px; float: right;}
   .t_tab_5{float: right;}

   .w_table{height:573px}

  .fixed{
   position:absolute;
   margin-left:115px;
   margin-top:25px;
}
.fixed2{
   position:absolute;
   margin-left:170px;
   margin-top:50px;
}



    @page {
        size: 204mm 260mm;
        margin: 0;
    }

    @media print {
        html, body {
            width: 204mm;
            height: 260mm;
            background-color: #FFFFFF;
        }
        .page {
            margin: 0;
            border: initial;
            border-radius: initial;
            width: initial;
            min-height: initial;
            box-shadow: initial;
            background: initial;
            page-break-after: always;

        }
      
            table {
                /* font-family: "Trebuchet MS", Arial, Helvetica, sans-serif; */
                border-collapse: collapse;
                width: 100%;
                }

                table td, table th {
                border: 1px solid #ddd;
                padding: 2px;
                }

                table tr:nth-child(even){background-color: #f2f2f2;}

                table tr:hover {background-color: #ddd;}

                table th {
                padding-top: 10px; 
                padding-bottom: 10px;
                text-align: left;
                /* background-color: #4CAF50; */
                /* color: white; */
                }
             }

            table {
                /* font-family: "Trebuchet MS", Arial, Helvetica, sans-serif; */
                border-collapse: collapse;
                width: 100%;
                }

                table td, table th {
                border: 1px solid #ddd;
                padding: 2px;
                }

                table tr:nth-child(even){background-color: #f2f2f2;}

                table tr:hover {background-color: #ddd;}

                table th {
                padding-top: 10px; 
                padding-bottom: 10px;
                text-align: left;
                /* background-color: #4CAF50; */
                /* color: white; */
                }

        </style>

<body >
</head>
<body onload="window.print();">
    <div class="page">
            <div class="container">
                    <div class="panel panel-default">
                        {{-- <div class="panel-heading">รายการอาหาร</div> --}}
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                        <div class="clearfix"></div><br>

                                    <center><img  class="img_show img-thumbnail" id="blah" style="max-width: 300px; max-height: 460px;text-align: center "
                                        src="{{url('/public/'.$head->img)}}" alt="your image" />

                                        <div class="clearfix"></div><br>
                                        <div  style="text-align: center" class="text-justify"> <u> <b>{{$head->name_food}} </b> </u> </div>
                                    </center>

                                    <div class="clearfix"></div><br>
                                </div>

                                <!-- /.col -->
                            </div> <div class="clearfix"></div><br>
                               <div class="row" style="margin-left: 1cm;">
                                <!-- left column -->
                                <div class="col-lg-12">
                                    <!-- general form elements -->
                                    <div class="box box-widget">
                                        <div class="box-header with-border">
                                            ข้อมูลวัตถุดิบ
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="box-body">
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <div class="table-wrapper-scroll-y food-detail-scrollbar" id="content_details_list_food">
                                                        <?php echo $list_table_material ;?>		
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                </div>
                                
                            </div>    
                            <div class="clearfix"></div><br>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="detail" style="margin-left: 1cm">
                                        <u><b> รายละเอียดวิธีการทำ </b></u>
                                        <div>
                                            <?php echo $head->detail ;?>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>

                    </div>
                </div>
    </div>

</body>
</html>
