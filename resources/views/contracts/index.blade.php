@extends('layouts.app')
@section('title')
  Contratos
@endsection
@section('head')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
@endsection
@section('content')
<!--encabezado titulo -->
<section class="sectionTitulo">
    <div class="divTitulo col-md-4 col-form-label text-md-end bg-red p-3 w-50 text-light">
      <h2 >
      Contratos
      </h2>
    </div>
  </section>
<!--Filtros de búsqueda-->
<section class="text-center m-5" id="rol">
  <!--Filtro selección de cargo-->

  <!--Botón para volver-->
  <div class="d-grid gap-2 d-md-flex justify-content-md-end">
    <a href="{{route('home')}}"><button class="btn btn-danger shadow bg-body-tertiary rounded" id=""><i class="fa-solid fa-arrow-left px-3 justify-content-center"></button></i></a>
  </div>
  {{-- Botón para crear un contrato --}}
  <div class="mt-3 d-grid gap-2 d-md-flex justify-content-md-end">
    <a name="" id="" class="btn btn-success  shadow bg-body-tertiary rounded" href="{{route('contracts.create')}}" role="button">Crear un nuevo contrato</a>
</div>
<!--Tabla de Contratos-->
<div class="container-fluid mt-4">
  <table class="table table-blue text-light table-bordered shadow bg-body-tertiary rounded " id="myTable">
    <thead class="text-center">
        <tr>
          <th scope="col">Estado</th>
          <th scope="col">Nombres</th>
          <th scope="col">Cargo</th>
          <th scope="col">Tipo de contrato</th>
          <th scope="col">Salario</th>
          <th scope="col">fecha inicio del contrato</th>
          <th scope="col">fecha fin del contrato</th>
          <th scope="col">Editar</th>
          <th scope="col">Des/Activar</th>
        </tr>
    </thead>
    <tbody class="table-group-divider">
      @foreach ($contracts as $contract)
      @if ($contract->users->name == "0")
          
      @else
      <tr>
        <td scope="col" value="{{$contract->status}}" class="text-capitalize">@if($contract->status == 0) Inactivo @else Activo @endif</td>
        <td scope="col" class="text-capitalize"> {{$contract->users->name}}</td>
        <td scope="col" class="text-capitalize">{{$contract->posts->name}}</td>
        <td scope="col">{{$contract->typeContracts->type_contract}} </td>
        <td scope="col" class="text-capitalize">{{$contract->salary}}</td>
        <td scope="col" class="text-capitalize">{{$contract->start}}</td>
        <td scope="col" class="text-capitalize">{{$contract->end}}</td>
        <td><div hclass="btn-group " role="group" aria-label="Button group name"><a href="{{route('contracts.edit', $contract->id)}}"> <button type="button" class="btn btn-success"><i class="fa-solid fa-pen"></i></button></a></td>
        <td>
          <form action="{{route('contracts.destroy', $contract->id)}}" method="POST">
            @csrf @method('DELETE')
          <div class="btn-group " role="group" aria-label="Button group name"> 
            <button type="submit" class="btn btn-danger">
              <i class="fa-solid fa-trash"></i>
            </button></a>
          </form>
          </td>
      </tr>
      @endif
      @endforeach
    </tbody>
  </table>
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
