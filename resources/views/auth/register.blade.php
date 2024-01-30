@extends('layouts.app')
@section('title')
  Registro
@endsection
@section('content')

<section class="registro"></section>
    <br><br>
    <div class=" col-form-label text-center text-blue ">
    <h1>Regístrate</h1>
    <!--Formulario de registro-->
    </div>
<div class="container mb-6">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="row">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Correo Institucional') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row my-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Contraseña') }}</label>

                            <div class="col-md-6">  
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirmar Contraseña') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
                                <p class="fs-7 text-secondary">La contraseña debe contener mínimo 8 caracteres y máximo 15 caracteres, dentro de los cuales debe haber por lo menos una letra, un número y un carácter especial</p>
                            </div>
                        </div>
                       
                        <div class="col-md-8 offset-md-4">
                            <div class="col-md-8 offset-md-2">
                                <button type="submit" class="btn btn-blue">
                                    {{ __('Registrar') }}
                                </button>
                            </div>
                        </div>
                        <a class="btn btn-link col-md-12 mt-2" href="{{ route('login') }}">{{ __('¿Ya tiene una cuenta? Inicie sesión') }}</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
