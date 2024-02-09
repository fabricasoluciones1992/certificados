<?php
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename="."HistorialCertificados".".xls");
 ?> 

 
<table>
        <thead>
            <tr>
                <th>Generado por: </th>
                <th>Fecha</th>
                <th>Hora</th>
            </tr>
        </thead>


            <tbody>
                @foreach ($data as $data)
                <tr>
                        <td>{{$data->name}}</td>
                        <td>{{$data->download_date}}</td>
                        <td>{{$data->download_hour}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>