@extends('layouts.app')
@section('title')
  Edición de Contratos
@endsection
@section('content')
<div class="container">
  <div class="mb-5 mt-5 d-grid gap-2 d-md-flex justify-content-md-end ">
    <a href="{{asset('/contracts')}}"><button class="btn btn-outline-danger shadow bg-body-tertiary rounded" id=""><i class="fa-solid fa-arrow-left px-3 justify-content-center"></button></i></a>
  </div>
    <div class="card text-dark bg-light  shadow p-3 mb-5 bg-body-tertiary rounded">
      <div class="card-body">
        <form action="{{route('contracts.update', $contracts->id)}}" method="POST">
            @csrf @method('PUT')
            <div class="mb-3 mt-3">
              <fieldset disabled>
                <label for="disabledTextInput" class="form-label">Usuario:</label>
                <label class="form-label ms-2 text-danger text-capitalize" id="disabledTextInput" value="{{$contracts->id_users}}" aria-label="Default select example">{{$contracts->users->name}}</label>
              </fieldset>
            </div>
            <div class="mb-3 mt-3">
              <label for="name" class="form-label">Inicio del Contrato:</label>
              <input type="date" class="form-control" id="start" value="{{$contracts->start}}" placeholder="Digite la fecha inicio del contrato" name="start">
              {{-- Alerta Validación --}}
              @foreach($errors->get('start') as $error)
                <strong class="text-danger"> {{$error}} </strong>
              @endforeach
            </div>
            <div class="mb-3 mt-3">
              <label for="name" class="form-label">Fin del Contrato:</label>
              <input type="date" class="form-control" id="end" value="{{$contracts->end}}" placeholder="Digite la fecha fin del contrato" name="end">
            {{-- Alerta Validación --}}
            @foreach($errors->get('end') as $error)
              <strong class="text-danger"> {{$error}} </strong>
            @endforeach
            </div>
            <div class="mb-3 mt-3">
              <label for="name" class="form-label">Salario del Contrato:</label>
              <input type="number" min="0" class="form-control" value="{{$contracts->salary}}" id="salary" placeholder="Digite el salario del contrato" name="salary">
            {{-- Alerta Validación --}}
            @foreach($errors->get('salary') as $error)
              <strong class="text-danger"> {{$error}} </strong>
            @endforeach
            </div>
            <div class="mb-3 mt-3">
              <label for="name" class="form-label">Seleccione el cargo:</label>
              <select class="form-select" name="id_posts" aria-label="Default select example">
                <option value="{{$contracts->posts->id}}" selected>{{$contracts->posts->name}}</option>
                @foreach ($posts as $post)
                <option value="{{$post->id}}">{{$post->name}}</option>
              @endforeach
              </select>
            </div>
            <div class="mb-3 mt-3">
              <label for="name" class="form-label">Seleccione el tipo de contrato:</label>
              <select class="form-select" name="id_type_contracts" aria-label="Default select example">
                <option value="{{$contracts->typeContracts->id}}" selected>{{$contracts->typeContracts->type_contract}}</option>
                @foreach ($typeContracts as $typeContract)
                <option value="{{$typeContract->id}}">{{$typeContract->type_contract}}</option>
      
              @endforeach
              </select>
                {{-- Alerta Validación --}}
              @foreach($errors->get('id_type_contracts') as $error)
                <strong class="text-danger"> {{$error}} </strong>
              @endforeach
            </div>
            <button type="submit" class=" mt-5 w-25 btn btn-blue ">Editar</button>

          </form>
      </div>
    </div>
</div>
@endsection
