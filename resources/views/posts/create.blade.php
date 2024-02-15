@extends('layouts.app')
@section('title')
Crear cargo
@endsection
@section('content')
<div class="container my-6">
    <div class="card text-dark bg-light">
      <div class="card-body">
        <form action="{{route('posts.store')}}" method="POST">
            @csrf
            <div class="my-3">
              <label for="name" class="form-label">Nombre:</label>
              <input type="name" class="form-control" id="name" placeholder="Ingrese Nombre (Solo en mayúsculas)" name="name">
              @foreach($errors->get('name') as $error)
                <strong class="text-danger">{{$error}}</strong>
              @endforeach
            </div>
            <select class="form-select" name="id_areas">
              <option value=null>Selecciona el area</option>
              @foreach ($areas as $area)
              <option value="{{$area->id}}">{{$area->name}}</option>
              @endforeach
            
              
          </select>
          @foreach($errors->get('id_areas') as $error)
              <strong class="text-danger">{{$error}}</strong>
              @endforeach
            <div class="container text-center">
              <button type="submit" class="btn btn btn-primary mt-3 px-5 me-2">Crear</button>
              <a href="{{route('areas.index')}}" class="btn btn-danger mt-3 px-5 ms-2">Cancelar</a>
          </div>
        </form>
      </div>
    </div>
</div>
@endsection

    
</body>