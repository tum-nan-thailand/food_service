<head>
     <meta charset="UTF-8">
    <style>
            table {
              border-collapse: collapse;
              width: 100%;
            }

            table td, table th {
              border: 1px solid #ddd;
              padding: 8px;
            }

            table td{
                text-align: left;
            }
            table th {
              padding-top: 12px;
              padding-bottom: 12px;
              text-align: left;
              background-color: #4CAF50;
              color: white;
              text-align: center;
            }
            </style>
</head>


    <table id="table_" class="table table-striped table-bordered" style="width:100%">
    {{-- {{dd($datas)}} --}}
        <thead>
            <tr>
                <th style="min-width:80px;">รหัส</th>
                <th style="min-width:180px">กลุ่ม</th>
                <th style="min-width:180px">รายละเอียด </th>
                <th style="min-width:100px">หน่วยนับ </th>
                <th style="min-width:100px">ราคา</th>
            </tr>
        </thead>

        <tbody>
                @foreach ($datas as $key => $v)
                <tr>
                   <td>{{$v->group_id}}</td>
                   <td>{{$v->group_name}}</td>
                   <td>{{$v->detail}}</td>
                   <td>{{$v->unit}}</td>
                   <td>{{$v->price}}</td>
               </tr>
           @endforeach

        </tbody>

    </table>
