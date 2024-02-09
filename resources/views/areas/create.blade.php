@extends('layouts.app')
@section('title')
    Crear áreas
@endsection
@section('content')
<div class="container my-6">
    <div class="card text-dark bg-light">
      <div class="card-body">
        <form action="{{route('areas.store')}}" method="POST">
            @csrf
            <div class="mb-3 mt-3">
              <label for="name" class="form-label">Nombre:</label>
              <input type="name" class="form-control" id="name" placeholder="Ingrese Nombre del área" name="name">
              @foreach($errors->get('name') as $error)
              <strong class="text-danger">{{$error}}</strong>
              @endforeach
            </div>
            <div class="container text-center">
              <button type="submit" class="btn btn btn-primary mt-3 px-5 me-2">Crear</button>
              <a href="{{url()->previous()}}" class="btn btn-danger mt-3 px-5 ms-2">Cancelar</a>
          </div>
          </form>
      </div>
    </div>
</div>
@endsection

    
</body>