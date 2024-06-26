@extends('layouts.app')
@section('title', 'Certificados')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <form id="verification" action="{{ route('valCode') }}" method="POST">
            @csrf
            <div class="contHome col-md-12 mt-5">
                <div class="card mt-6">
                    <div class="card-body text-center fs-3 p-5 m-3">
                        <input type="text" class="form-control" id="valCode" placeholder="Digite el código de validación del contrato:" name="valCode">
                        <div class="container text-center">
                            <button type="submit" class="btn btn btn-success mt-3 px-5 me-2">Validar</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="validationResultModal" tabindex="-1" aria-labelledby="validationResultModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="validationResultModalLabel">Resultado de Validación</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p id="validationResultMessage"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<script>
    // JavaScript para mostrar la modal según el resultado
    @if(session('error'))
        $(document).ready(function() {
            $('#validationResultMessage').text("{{ session('error')['message'] }}");
            $('#validationResultModal').modal('show');
        });
    @endif
</script>
@endsection
