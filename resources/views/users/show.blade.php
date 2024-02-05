@extends('layouts.app')
@section('title')
    información personal
@endsection
@section('content')
            <!--Botón para volver-->
  <div class="d-grid gap-2 d-md-flex justify-content-end m-5">
    <a href="{{asset('/home')}}"><button class="btn btn-outline-danger" id=""><i class="fa-solid fa-arrow-left px-3 justify-content-center"></button></i></button></a>
  </div>
  <section class="container my-5 w-50">
    <!--Formulario de registro-->
    <div class="card text-md-center">
        <div class="card-header  text-blue ">
        <h1>Tu infomación:</h1>
      </div>
      <div class="card-body">
        <h2 class="py-2"><b class="pe-3">Nombres:</b>
          @if( $user->name == '0' )
              {{"Por definir"}}
          @else
              {{ $user->name }}
          @endif
              </h2>
            <h3 class="py-2"><b class="pe-3">Correo:</b> {{$user->email}}</h3>
            <h4 class="py-2"><b class="pe-3">Tipo de Documento:</b> {{$user->documents->type}}</h4>
            <h4 class="py-2"><b class="pe-3">Documento:</b>
          @if( $user->doc === '0' )
              {{"Por definir"}}
          @else
              {{ $user->document }}
          @endif</h4>
            <h4 class="py-2"><b class="pe-3">Rol:</b> {{$user->roles->role}}</h4>
            <div class="row container px-5">
              <div class="col-6">
                <a class="btn btn-primary" href="{{route('select_contract')}}" role="button">Mis contratos</a>
              </div>
              <div class="col-6">
                <a class="btn btn-success" href="{{route('edit_password')}}" role="button">Cambiar Contraseña</a>
              </div>
            </div>
    </div>
  </section>
@endsection
