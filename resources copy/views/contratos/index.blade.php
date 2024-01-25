@extends('layouts.app')
@section('title')
  Contratos
@endsection
@section('head')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
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
    <a href="{{asset('/home')}}"><button class="btn btn-outline-danger shadow bg-body-tertiary rounded" id=""><i class="fa-solid fa-arrow-left px-3 justify-content-center"></button></i></a>
  </div>
  {{-- Botón para crear un contrato --}}
  <div class="mt-3 d-grid gap-2 d-md-flex justify-content-md-end">
    <a name="" id="" class="btn btn-outline-success  shadow bg-body-tertiary rounded" href="{{route('contracts.create')}}" role="button">Crear un nuevo contrato</a>
</div>
<!--Tabla de Contratos-->
<div class="container-fluid mt-4">
  <table class="table table-blue text-light table-bordered shadow bg-body-tertiary rounded " id="myTable">
    <thead class="text-center">
        <tr>
          <th scope="col">Nombres</th>
          <th scope="col">Cargo</th>
          <th scope="col">Tipo de contrato</th>
          <th scope="col">Editar</th>
          <th scope="col">Eliminar</th>
        </tr>
    </thead>
    <tbody class="table-group-divider">
      @foreach ($contracts as $contract)
      @if($contract->status != 2)
      <tr>
        <td scope="col" class="text-capitalize"> {{$contract->users->name}}</td>
        <td scope="col" class="text-capitalize">{{$contract->posts->name}}</td>
        <td scope="col">{{$contract->typeContracts->type_contract}} </td>
        <td><div hclass="btn-group " role="group" aria-label="Button group name"><a href="{{route('contracts.edit', $contract->id)}}"> <button type="button" class="btn btn-outline-success"><i class="fa-solid fa-pen"></i></button></a></td>
        <td>
          <form action="{{route('contracts.destroy', $contract->id)}}" method="POST">
            @csrf @method('DELETE')
          <div class="btn-group " role="group" aria-label="Button group name"> 
            <button type="submit" class="btn btn-outline-danger">
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
  $(document).ready( function () {
$('#myTable').DataTable();
} );
</script>
@endsection
