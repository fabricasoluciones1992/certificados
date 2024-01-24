@extends('layouts.app')
@section('title')
    Editar áreas
@endsection
@section('content')
<div class="container">
    <div class="card text-dark bg-light my-6">
      <div class="card-body">
        <form action="{{route('areas.update', $area->id)}}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3 mt-3">
              <label for="name" class="form-label">Nombre:</label>
              <input type="name" class="form-control" value="{{$area->name}}" placeholder="Ingrese Nombre" name="name">
            </div>
            <button type="submit" class="btn btn-primary">Editar</button>
          </form>
      </div>
    </div>
</div>
@endsection

    
</body>