@extends('layouts.app')

@section('content')
<div class="container my-6">
    <div class="row">
        <a name="" id="" class="btn btn-success" href="{{route('contracts.create')}}" role="button">Crear un nuevo contrato</a>
    </div>
    <div class="table-responsive">
        <table class="table table-dark">
            <thead>
                <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($contracts as $contract)
                <tr class="">
                    <td>{{$area->name}}</td>
                    <td>
                        <div class="btn-group">
                            <a name="" id="" class="btn btn-primary" href="{{route('contracts.edit', $area->id)}}" role="button">Editar</a>
                            <form action="{{route('contracts.destroy', $area->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                            <input type="hidden" name="id" value="{{$area->id}}">
                            <input type="submit" value="Eliminar" class="btn btn-danger">
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
</div>
@endsection

    
</body>