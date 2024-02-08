@extends('layouts.app')
@section('title')
  Confirmar Contraseña
@endsection
@section('content')
    <!-- Modal -->
    <div class="modal modal-fullscreen" id="miModal" tabindex="-1" role="dialog" aria-labelledby="miModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-center" id="miModalLabel">¿Desea confirmar el cambio de contraseña?</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                  <i class="fa-solid fa-triangle-exclamation fa-5x text-danger mb-3"></i>
                    <h5 class="mb-3">Confirmar cambio</h5>
                    <p>¿Desea confirmar el cambio de contraseña?</p>
                </div>
            <div class="modal-footer d-flex justify-content-center align-items-center ">
                <form action="{{ route('update_password') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id_users" value="{{$request->new_password}}">
                    <button type="submit" value="1" name="opc" class="btn btn-success me-2">Solo crear</button>
                    <button type="submit" value="2" name="opc" class="btn btn-blue me-1">Desactivar</button>
                </form>
                <button type="button" value="3" name="opc" class="btn btn-danger" onclick="cancelar()">Cancelar</button>
            </div>
          </div>
        </div>
      </div>

      <!-- Script para mostrar el modal al cargar la página -->
      <script>
        $(document).ready(function () {
          $('#miModal').modal('show');
        });
        function cancelar() {
        // Redirige a contracts.create
        window.location.href = "{{ route('contracts.create') }}";
        }
      </script>
@endsection
