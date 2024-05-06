@extends('layouts.app')
@section('title')
  Registro
@endsection
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<div class="d-grid gap-2 d-md-flex justify-content-end m-5">
    <a href="{{route('users.show', Auth::id())}}"><button class="btn btn-danger" id=""><i class="fa-solid fa-arrow-left px-3 justify-content-center"></button></i></button></a>
  </div>
<section class="registro"></section>
    <br><br>
    <div class=" col-form-label text-center text-blue ">
    <h1>Cambio de Contraseña</h1>
    <!--Formulario de registro-->
    </div>
<div class="container mb-6">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('update_password') }}">
                        @csrf
                        @method('PUT')
                        <div class="row my-3">
                            
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Contraseña actual') }}</label>

                            <div class="col-md-6">  
                                <div class="input-group">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="button" onclick="mostrarPassword('password')"> <span class="fa fa-eye-slash icon"></span> </button>
                                </div>                                
                            </div>
                            
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row my-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Nueva contraseña') }}</label>

                            <div class="col-md-6">  
                                <div class="input-group">
                                    <input id="new_password" type="password" class="form-control @error('new_password') is-invalid @enderror" name="new_password" autocomplete="new-password">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="button" onclick="mostrarPassword('new_password')"> <span class="fa fa-eye-slash icon"></span> </button>
                                    </div>
                                </div>
                                
                                @error('new_password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row my-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Confirmar contraseña') }}</label>

                            <div class="col-md-6">  
                                <div class="input-group">
                                    <input id="password_confirmation_field" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" autocomplete="new-password">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="button" onclick="mostrarPassword('password_confirmation_field')"> <span class="fa fa-eye-slash icon"></span> </button>
                                    </div>                                    
                                </div>
                                
                                <p class="fs-7 text-secondary">La contraseña debe contener mínimo 8 caracteres y máximo 15 caracteres, dentro de los cuales debe haber por lo menos una letra, un número y un carácter especial</p>
                                @error('password_confirmation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-8 offset-md-4">
                            <div class="col-md-8 offset-md-2">
                                <button type="submit" class="btn btn-blue">
                                    {{ __('Registrar') }}
                                </button>
                            </div>
                        </div>
                        <script type="text/javascript">
                            function mostrarPassword(targetId) {
                                var cambio = document.getElementById(targetId);
                                if (cambio.type == "password") {
                                    cambio.type = "text";
                                    $('#' + targetId + ' .icon').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
                                } else {
                                    cambio.type = "password";
                                    $('#' + targetId + ' .icon').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
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
