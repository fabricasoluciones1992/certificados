@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card text-dark bg-light">
      <div class="card-body">
        <form action="{{route('posts.update', $post->id)}}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3 mt-3">
              <label for="name" class="form-label">Nombre:</label>
              <input type="name" class="form-control" value="{{$post->name}}" placeholder="Ingrese Nombre" name="name">
              <div class="mb-3">
                <label for="" class="form-label">Area</label>
                <select class="form-select form-select-lg" name="" id="">
                  @foreach ($areas as $area)
                      <option value="{{$area->id}}">{{$area->name}}</option>
                  @endforeach
                </select>
              </div>
              
            </div>
            <button type="submit" class="btn btn-success">Editar</button>
          </form>
      </div>
    </div>
</div>
@endsection

    
</body>