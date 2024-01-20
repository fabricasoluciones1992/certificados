@extends('layouts.app')
@section('title')
    Editar usuario 
@endsection
@section('content')
    <br><br>
    <div class=" col-form-label text-md-center text-blue ">
    <h1>A continuación, complete la siguiente información:</h1>
    <!--Formulario de registro-->
    </div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('admins.update', $user->id) }}">
                        <input type="hidden" name="id_users" value="{{Auth::user()->id}}">
                        @csrf
                        @method('PUT')
                        <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Nombres') }}</label>
                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name" value="@if($user->name == '0'){{""}}@else{{$user->name}}@endif" placeholder="@if($user->name == '0'){{"Por Definir"}}@endif" autocomplete="name" autofocus>
                                    @foreach ($errors->get('name') as $error)
                                    <strong class="text-danger">{{ $error }}</strong>
                                @endforeach
                                <p class="fs-7 text-secondary">Los nombres deben contener mínimo 2 caracteres y máximo 100 caracteres</p>
                                </div>
                                </div>
                        <div class="row mb-3">
                            <label for="CC" class="col-md-4 col-form-label text-md-end">{{ __('Documento') }}</label>
                            <div class="col-md-6">
                                <input id="doc" type="number" class="form-control @error('') is-invalid @enderror" name="doc" value="{{$user->document}}" autocomplete="doc" autofocus>
                                @foreach ($errors->get('doc') as $error)
                                <strong class="text-danger">{{ $error }}</strong>
                            @endforeach
                            <p class="fs-7 text-secondary">El número de documento debe contener mínimo 8 caracteres y máximo 15 caracteres</p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="role" class="col-md-4 col-form-label text-md-end">{{ __('Rol') }}</label>

                            <div class="col-md-6">
                            <select id="role" class="form-control @error('') is-invalid @enderror" name="role" value="{{$user->roles->role}}" autocomplete="role" autofocus>
                                <option value="{{$user->id_roles}}" selected>{{$user->roles->role}}</option>
                                @foreach ($roles as $role)
                                @if($user->id_roles == $role->id)
                                @else
                                <option value="{{$role->id}}">
                                  {{$role->role}}
                                </option>
                                @endif
                                @endforeach
                             </select>
                             @foreach ($errors->get('role') as $error)
                             <strong class="text-danger">{{ $error }}</strong>
                         @endforeach
                            </div>
                        </div>
                        <div class="row">
                            <div class="col text-end">
                                <button type="submit" class="btn btn-blue px-3">
                                        {{ __('Enviar') }}
                                </button>
                            </div>
                            <div class="col ">
                                <a class="btn btn-danger" href="{{route('users.index')}}">Cancelar</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
