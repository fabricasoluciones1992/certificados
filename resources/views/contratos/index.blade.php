@extends('layouts.app')

@section('content')

<div class="container my-6">
    <div class="mb-4 d-grid gap-2 d-md-flex justify-content-md-end">
        <a href="{{asset('/home')}}"><button class="btn btn-outline-danger" id=""><i class="fa-solid fa-arrow-left px-3 justify-content-center"></button></i></a>
      </div>
    <div class="row">
        <a name="" id="" class="btn btn-success" href="{{route('contracts.create')}}" role="button">Crear un nuevo contrato</a>
    </div>
    <div class="table-responsive">
        <table class="table table-dark">
            <thead>
                <tr>
                    <th scope="col">Contratos</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($contracts as $contract)
                <tr class="">
                    <td>{{$contract->name}}</td>
                    <td>
                        <div class="btn-group">
                            <a name="" id="" class="btn btn-primary" href="{{route('contracts.edit', $contract->id)}}" role="button">Editar</a>
                            <form action="{{route('contracts.destroy', $contract->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                            <input type="hidden" name="id" value="{{$contract->id}}">
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