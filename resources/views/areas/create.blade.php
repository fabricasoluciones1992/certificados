@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card text-dark bg-light">
      <div class="card-body">
        <form action="{{route('areas.store')}}" method="POST">
            @csrf
            <div class="mb-3 mt-3">
              <label for="name" class="form-label">Nombre:</label>
              <input type="name" class="form-control" id="name" placeholder="Ingrese Nombre del área" name="name">
            </div>
            <button type="submit" class="btn btn-primary">Crear</button>
          </form>
      </div>
    </div>
</div>
@endsection

    
</body>