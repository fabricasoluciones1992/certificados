@extends('layouts.app')
@section('title')
    Áreas y cargos
@endsection
@section('head')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />

<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
@endsection
@section('content')
<div class="container my-5">
    <!--Botón para volver-->
    <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-5">
        <a href="{{route('home')}}"><button class="btn btn-danger shadow bg-body-tertiary rounded" id=""><i class="fa-solid fa-arrow-left px-3 justify-content-center"></button></i></a>
    </div>
    <div class="row">
        <div class="col-6 text-end">
            <a name="" id="" class="btn btn-success col-12" href="{{route('areas.create')}}" role="button">Crear áreas</a>
        </div>
        <div class="col-6">
        <a name="" id="#" class="btn btn-primary col-12" href="{{route('posts.create')}}" role="button">Crear cargos</a>
        </div>
    </div>
    <div class="container-fluid mt-5">
        <table class="table table-blue text-light table-bordered shadow bg-body-tertiary rounded" id="myTable">
            <thead class="text-center">
                <tr class="">
                    <th class="col-10">Nombre</th>
                    <th class="col-2">Acciones</th>
                </tr>
            </thead>
            <tbody class="text-center">
                @foreach ($areas as $area)
                <tr class="">
                    <td>
                        <a class="text-light py-2 w-100" type="button" data-bs-toggle="collapse" data-bs-target="#demo{{$area->id}}" aria-expanded="false" aria-controls="demo{{$area->id}}"> 
                            {{$area->name}}
                        </a>
                        <div class="collapse" id="demo{{$area->id}}">
                            <ul class="list-group bg-blue text-light">
                                @foreach ($posts as $post)
                                    @if($post->id_areas == $area->id)
                                          
                                        <a name="edit" id="" class="btn btn-light border-0 my-2" href="{{route('posts.edit', $post->id)}}" role="button">
                                            <li class="list-group-item bg-blue text-light">{{$post->name}}
                                            </li>  </a>
                                    @endif
                                    
                                    
                                @endforeach
                                
                              </ul>
                        </div>
                    </td>
                    <td class="text-center">
                        <div class="btn-group">
                            <a name="edit" id="" class="btn btn-success fa-solid fa-pen me-2 rounded px-3" href="{{route('areas.edit', $area->id)}}" role="button"></a>
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
$(document).ready(function() {
    $('#myTable').DataTable({
        "language": {
            "search": "Buscar:",
            "lengthMenu": "Mostrar _MENU_ registros por página",
            "zeroRecords": "No se encontraron resultados",
            "info": "Mostrando página _PAGE_ de _PAGES_",
            "infoEmpty": "No hay registros disponibles",
            "infoFiltered": "(filtrados de _MAX_ registros en total)",
            "paginate": {
                "first": "Primera",
                "last": "Última",
                "next": "Siguiente",
                "previous": "Anterior"
            }
        }
    });
});

  </script>
@endsection