@extends('template')

@section('title', 'Editar usuario')

@push('css')
@endpush

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4 text-center">Editar Usuario</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
            <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Usuarios</a></li>
            <li class="breadcrumb-item active">Editar Usuario</li>
        </ol>

        <div class="container w-50 float-start">
            <form action='{{ route('users.update',['user' => $user]) }}' method="POST">
                @method('PATCH')
                @csrf
                <div class="row g-3">
                    {{-- Nombre --}}
                    <div class="row mb-4 mt-4">
                        <label for="name" class="col-sm-2 col-form-label">Nombre:</label>
                        <div class="col-sm-4">
                            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name) }}">
                        </div>
                        <div class="col-sm-4">
                            <div class="form-text">
                                Escriba un solo nombre
                            </div>
                        </div>
                        <div class="col-sm-2">
                            @error('name')
                                <small class="text-danger">{{'*'.$message}}</small>
                            @enderror
                        </div>
                    </div>

                    {{-- Email --}}
                    <div class="row mb-4">
                        <label for="email" class="col-sm-2 col-form-label">Email:</label>
                        <div class="col-sm-4">
                            <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $user->email) }}">
                        </div>
                        <div class="col-sm-4">
                            <div class="form-text">
                                Dirección de correo electrónico
                            </div>
                        </div>
                        <div class="col-sm-2">
                            @error('email')
                                <small class="text-danger">{{'*'.$message}}</small>
                            @enderror
                        </div>
                    </div>

                     {{-- Password --}}
                    <div class="row mb-4">
                        <label for="password" class="col-sm-2 col-form-label">Contraseña:</label>
                        <div class="col-sm-4">
                            <input type="password" name="password" id="password" class="form-control">
                        </div>
                        <div class="col-sm-4">
                            <div class="form-text">
                                Escriba una contraseña segura. Debe incluir números.
                            </div>
                        </div>
                        <div class="col-sm-2">
                            @error('password')
                                <small class="text-danger">{{'*'.$message}}</small>
                            @enderror
                        </div>
                    </div>

                    {{-- Confirm Password --}}
                    <div class="row mb-4">
                        <label for="password_confirm" class="col-sm-2 col-form-label">Confirmar contraseña:</label>
                        <div class="col-sm-4">
                            <input type="password" name="password_confirm" id="password_confirm" class="form-control">
                        </div>
                        <div class="col-sm-4">
                            <div class="form-text">
                                Vuelva a escribir su contraseña.
                            </div>
                        </div>
                        <div class="col-sm-2">
                            @error('password_confirm')
                                <small class="text-danger">{{'*'.$message}}</small>
                            @enderror
                        </div>
                    </div>

                    {{-- Roles --}}
                    <div class="row mb-4">
                        <label for="password_confirm" class="col-sm-2 col-form-label">Seleccionar rol:</label>
                        <div class="col-sm-4">
                            <select name="role" id="role" class="form-select">
                                @foreach ($roles as $item)
                                    @if ( in_array($item->name,$user->roles->pluck('name')->toArray()))
                                        <option selected value="{{ $item->name }}" @selected(old('role') == $item->name) >{{ $item->name }}</option>
                                    @else
                                        <option value="{{ $item->name }}" @selected(old('role') == $item->name) >{{ $item->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-text">
                                Escoja un rol para el usuario.
                            </div>
                        </div>
                        <div class="col-sm-2">
                            @error('role')
                                <small class="text-danger">{{'*'.$message}}</small>
                            @enderror
                        </div>
                    </div>

                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary" id="Cargar" name="Cargar" title="Cargar">Actualizar</button>
                    {{-- <a href="{{ route('roles.index') }}"><button type="button" class="btn btn-secondary bg-danger text-white" title="Cancelar" data-bs-dismiss="modal">Cerrar</button></a> --}}
                </div>
            </form>
        </div>

    </div>
@endsection

@push('js')
    
@endpush