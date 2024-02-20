@extends('template')

@section('title', 'categorias')

@push('css')
    {{-- SWEET ALERT 2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- DATATABLE --------------->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <!---------------------------->
@endpush

@section('content')

@if(session('success'))
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 2000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        });
            Toast.fire({
            icon: "success",
            title: "¡Operación exitosa!"
        });
    </script>
@endif

    <div class="container-fluid px-4">
        <h1 class="mt-4 text-center">Categorías</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
            <li class="breadcrumb-item active">Categorías</li>
        </ol>

        <div class="mb-4">
            <a href="{{ route('categorias.create') }}">
                <button type="button" class="btn btn-primary">Añadir nuevo registro</button>
            </a>
        </div>


        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Tabla Categorías
            </div>
            <div class="card-body">
                <table id="example" class="table table-light table-striped" style="width:100%">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categorias as $categoria)
                            <tr>
                                <td>{{ $categoria->caracteristica->id }}</td>
                                <td>{{ $categoria->caracteristica->nombre }}</td>
                                <td>{{ $categoria->caracteristica->descripcion }}</td>
                                <td class="text-center">
                                    <form class="d-inline" action="{{ route('categorias.edit', ['categoria' => $categoria]) }}">
                                        <button type="submit" class="text-success mx-1" style="border:none; background-color:transparent;" title="Editar">
                                            <i class="fa-regular fa-pen-to-square"></i>
                                        </button>
                                    </form>

                                    <button type="button" class="text-danger mx-1" style="border:none; background-color:transparent;" title="Borrar">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
@endsection

@push('js')
    <!-- DATATABLE -------------------->
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script>
        // new DataTable('#example');
        new DataTable('#example', {
            language: {
                info: 'Mostrar página _PAGE_ de _PAGES_',
                infoEmpty: 'No hay registros disponibles',
                infoFiltered: '(filtrado de _MAX_ registros totales)',
                lengthMenu: 'Mostrar _MENU_ registros por página',
                zeroRecords: 'No se encontró nada - Lo siento',
                search: 'Buscar:',
                paginate: {
                    next:'Siguiente',
                    previous:'Anterior'
                }
            }
        });
    </script>
@endpush