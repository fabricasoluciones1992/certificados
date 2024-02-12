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
<!--Tabla de Contratos-->
<div class="container-fluid mt-4">
  <table class="table table-blue text-light table-bordered shadow bg-body-tertiary rounded " id="myTable">
    <thead class="text-center">
        <tr>
          <th scope="col">Nombres</th>
          <th scope="col">Cargo</th>
          <th scope="col">Tipo de contrato</th>
          <th scope="col">Generar</th>
        </tr>
    </thead>
    <tbody class="table-group-divider">
      @foreach ($data as $contract)
      <tr>
        <td scope="col" class="text-capitalize"> {{$contract->users->name}}</td>
        <td scope="col" class="text-capitalize">{{$contract->posts->name}}</td>
        <td scope="col">{{$contract->typeContracts->type_contract}} </td>
        <td><div hclass="btn-group " role="group" aria-label="Button group name"><a href="{{route('certificates', $contract->id)}}"> <button type="button" class="btn btn-success"><i class="fa-solid fa-arrow-right-from-bracket"></i></button></a></td>
      </tr>
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
