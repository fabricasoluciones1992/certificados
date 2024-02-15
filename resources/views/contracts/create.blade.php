@extends('layouts.app')
@section('title')
  Crear nuevos contratos
@endsection
@section('content')
<div class="container">
  <div class="mb-5 mt-5 d-grid gap-2 d-md-flex justify-content-md-end ">
    <a href="{{route('contracts.index')}}"><button class="btn btn-danger shadow bg-body-tertiary rounded" id=""><i class="fa-solid fa-arrow-left px-3 justify-content-center"></button></i></a>
  </div>
    <div class="card text-dark bg-light  shadow p-3 mb-5 bg-body-tertiary rounded">
      <div class="card-body">
        <form id="tuFormulario" action="{{route('contracts.store')}}" method="POST">
            @csrf
            <div class="mb-3 mt-3">
              <label for="name" class="form-label">Seleccione un usuario:</label>
              <select class="form-select" name="id_users" aria-label="Default select example">
                <option value="" selected>Seleccione</option>
                @foreach ($users as $users)
                <option value="{{$users->id}}">{{$users->name}}</option>
              @endforeach
              </select>
                {{-- Alerta Validación --}}
              @foreach($errors->get('id_users') as $error)
                <strong class="text-danger"> {{$error}} </strong>
              @endforeach
            </div>
            <div class="mb-3 mt-3">
              <label for="name" class="form-label">Inicio del Contrato:</label>
              <input type="date" class="form-control" id="start" placeholder="Digite la fecha inicio del contrato" name="start">
              {{-- Alerta Validación --}}
              @foreach($errors->get('start') as $error)
                <strong class="text-danger"> {{$error}} </strong>
              @endforeach
            </div>
            <div class="mb-3 mt-3">
              <label for="name" class="form-label">Fin del Contrato:</label>
              <input type="date" class="form-control" id="end" placeholder="Digite la fecha fin del contrato" name="end">
              {{-- Alerta Validación --}}
              @foreach($errors->get('end') as $error)
                <strong class="text-danger"> {{$error}} </strong>
              @endforeach
            </div>
            <div class="mb-3 mt-3">
              <label for="name" class="form-label">Salario del Contrato:</label>
              <input type="number" min="0" class="form-control" id="salary" placeholder="Digite el salario del contrato" name="salary">
              {{-- Alerta Validación --}}
              @foreach($errors->get('salary') as $error)
                <strong class="text-danger"> {{$error}} </strong>
              @endforeach
            </div>
            <div class="mb-3 mt-3">
              <label for="name" class="form-label">Seleccione el cargo:</label>
              <select class="form-select" name="id_posts" aria-label="Default select example">
                <option value="" selected>Seleccione</option>
                @foreach ($posts as $post)
                <option value="{{$post->id}}">{{$post->name}}</option>
              @endforeach
              </select>
              {{-- Alerta Validación --}}
              @foreach($errors->get('id_posts') as $error)
                <strong class="text-danger"> {{$error}} </strong>
              @endforeach
            </div>
            <div class="mb-3 mt-3">
              <label for="name" class="form-label">Seleccione el tipo de contrato:</label>
              <select class="form-select" name="id_type_contracts" aria-label="Default select example">
                <option value="" selected>Seleccione</option>
                @foreach ($typeContracts as $typeContract)
                <option value="{{$typeContract->id}}">{{$typeContract->type_contract}}</option>
      
              @endforeach
              </select>
              {{-- Alerta Validación --}}
              @foreach($errors->get('id_type_contracts') as $error)
                <strong class="text-danger"> {{$error}} </strong>
              @endforeach
            </div>
            <div class="container text-center">
              <button type="submit" class="btn btn btn-success mt-3 px-5 me-2">Crear</button>
              <a href="{{route('contracts.index')}}" class="btn btn-danger mt-3 px-5 ms-2">Cancelar</a>
          </div>

          </form>
      </div>
    </div>
</div>
@endsection