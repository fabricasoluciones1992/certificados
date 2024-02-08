@extends('layouts.app')
@section('title')
  Registro
@endsection
@section('content')

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
                    <form method="POST" action="{{ route('confirm_password') }}">
                        @csrf
                        @method('PUT')
                        <div class="row my-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Contraseña actual') }}</label>

                            <div class="col-md-6">  
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">

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
                                <input id="password" type="password" class="form-control @error('new_password') is-invalid @enderror" name="new_password" autocomplete="new-password">

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
                                <input id="password" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" autocomplete="new-password">
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
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
