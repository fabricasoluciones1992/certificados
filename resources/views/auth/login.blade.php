@extends('layouts.app')
@section('title')
  Inicio sesión
@endsection
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!--encabezado titulo-->
    <section class="sectionTitulo2">
        <div class="divTitulo2">
          <div class="col-md-4 col-form-label text-md-end bg-red p-4 w-25 text-light">
            <h2>Obtén ahora tu </h2>
          </div>
          <div class="col-md-4 col-form-label text-md-end bg-blue p-4 mt-3 w-50 text-light">
            <h2>Certificado laboral</h2>
          </div>
        </div>
    </section>
      
      <!--formulario inicio sesión-->
      <section class="formsCards container mt-5 ">
        <h3 class="d-flex justify-content-center">Iniciar sesión</h3>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                        @csrf
                            <div class="row mb-3">
                                <label for="user" class="col-md-4 col-form-label text-md-start">{{ __('Usuario') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" autofocus>

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password" class="col-md-4 col-form-label text-md-start">{{ __('Contraseña') }}</label>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="current-password">
                                        <div class="input-group-append">
                                            <button id="show_password" class="btn btn-primary" type="button" onclick="mostrarPassword()"> <span class="fa fa-eye-slash icon"></span> </button>
                                        </div>
                                    </div>
                                    
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    <p class="fs-7 text-secondary">La contraseña debe contener mínimo 8 caracteres y máximo 15 caracteres, dentro de los cuales debe haber por lo menos una letra, un número y un carácter especial</p>
                                </div>
                            </div>
                        <div class="row mb-3 ">
                            <div class="col-md-8 offset-md-4">
                                <div class="col-md-8 offset-md-2 mt-2">
                                    <button type="submit" class="btn btn-blue">
                                        {{ __('Iniciar Sesión') }}
                                    </button>
                                </div>
                            </div>
                        @if (Route::has('register'))
                            <a class="btn btn-link col-md-12 mt-2" href="{{ route('register') }}">{{ __('¿No tiene una cuenta?, Registrese') }}</a>
                        @endif
                        <script type="text/javascript">
                            function mostrarPassword(){
                                var cambio = document.getElementById("password");
                                if(cambio.type == "password"){
                                    cambio.type = "text";
                                    $('.icon').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
                                }else{
                                    cambio.type = "password";
                                    $('.icon').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
                                }
                            } 
                        </script>
                        
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection