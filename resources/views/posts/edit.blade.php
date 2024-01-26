@extends('layouts.app')
@section('title')
    Editar cargo
@endsection
@section('content')
<div class="container mt-5 mb-6">
    <div class="card text-dark bg-light">
      <div class="card-body">
        <form action="{{route('posts.update', $post->id)}}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3 mt-3">
              <label for="name" class="form-label">Nombre:</label>
              <input type="name" class="form-control" value="{{$post->name}}" placeholder="Ingrese Nombre" name="name">
              @foreach($errors->get('name') as $error)
                <strong class="text-danger">{{$error}}</strong>
              @endforeach
              <div class="mb-3 mt-3">
                <label for="" class="form-label">Area:</label>
                <select class="form-select form-select-lg" name="area" id="">
                  @foreach ($areas as $area)
                      <option value="{{$area->id}}">{{$area->name}}</option>
                  @endforeach
                </select>
                @foreach($errors->get('area') as $error)
                <strong class="text-danger">{{$error}}</strong>
              @endforeach
              </div>
              
            </div>
            <div class="container text-center">
              <button type="submit" class="btn btn btn-outline-primary mt-3 px-5 me-2">Editar</button>
              <a href="{{route('areas.index')}}" class="btn btn-outline-danger mt-3 px-5 ms-2">Cancelar</a>
          </div>
          </form>
      </div>
    </div>
</div>
@endsection

    
</body>