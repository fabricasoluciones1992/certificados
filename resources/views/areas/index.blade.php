@extends('layouts.app')
@section('title')
    Areas y cargos
@endsection
@section('head')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />

<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
@endsection
@section('content')
<div class="container my-6">
    <div class="row">
        <div class="mb-3 col-6 text-end">
            <a name="" id="" class="btn btn-success col-12" href="{{route('areas.create')}}" role="button">Crear Areas</a>
        </div>
        <div class="mb-3 col-6">
        <a name="" id="#" class="btn btn-primary col-12" href="{{route('posts.create')}}" role="button">Crear cargos</a>
        </div>
    </div>
    <div class="container-fluid">
        <table class="table table-blue text-light table-bordered" id="myTable">
            <thead class="text-center">
                <tr class="">
                    <th class="col-10">Nombre</th>
                    <th class="col-2">Acciones</th>
                </tr>
            </thead>
            <tbody class="text-center">
                @foreach ($areas as $area)
                <tr class="">
                    <td>{{$area->name}}</td>
                    <td class="text-center">
                        <div class="btn-group">
                            <a name="edit" id="" class="btn btn-outline-success fa-solid fa-pen me-2 rounded px-3" href="{{route('areas.edit', $area->id)}}" role="button"></a>
                            <input type="hidden" name="id" value="{{$area->id}}">
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<script>
    $(document).ready( function () {
  $('#myTable').DataTable();
} );
  </script>
@endsection