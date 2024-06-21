@extends('layouts.app')
@section('title')
    Certificados  
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <form id="verification" action="{{route('valCode')}}" method="POST">
            @csrf
        <div class="contHome col-md-12 mt-5">
            <div class="card mt-6">
                <div class="card-body text-center fs-3 p-5 m-3">
                    <input type="text" class="form-control" id="" placeholder="Digite el codigo de validación del contrato: " name="valCode">
                    <div class="container text-center">
                        <button type="submit" class="btn btn btn-success mt-3 px-5 me-2">Validar</button>
                    </div>
                </div>
                
            </div>
        </div>
        </form>
    </div>
</div>
@endsection