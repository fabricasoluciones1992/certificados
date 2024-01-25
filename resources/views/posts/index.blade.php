@extends('layouts.app')
@section('title')
  Cargos
@endsection
@section('content')
@section('head')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
@endsection
<section class="m-5">
     <!--Botón para volver-->
  <div class="d-grid gap-2 d-md-flex justify-content-end">
    <a href="{{asset('/home')}}"><button class="btn btn-outline-danger shadow bg-body-tertiary rounded" id=""><i class="fa-solid fa-arrow-left px-3 justify-content-center"></button></i></a>
  </div>
    <div class="d-grid gap-2 d-md-flex justify-content-md-end my-3">
        <a name="" id="" class="btn btn-outline-success  shadow bg-body-tertiary rounded px-5" href="{{route('posts.create')}}" role="button">Crear cargo</a>
    </div>
    
    <div class="table-responsive">
        <table class="table table-blue text-light table-bordered shadow rounded text-center" id="myTable">
            <thead>
                <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Area</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                <tr class="">
                    <td>{{$post->name}}</td>
                    <td>{{$post->areas->name}}</td>
                    <td>
                        <div hclass="btn-group " role="group" aria-label="Button group name"><a href="{{route('posts.edit', $post->id)}}"> <button type="button" class="btn btn-outline-success"><i class="fa-solid fa-pen"></i></button></a>
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
</body>