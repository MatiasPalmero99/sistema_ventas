@extends('template')

@section('title', 'Crear Compra')

@push('css')
    {{-- Bootstrap Select --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

    {{-- jquery --}}
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
@endpush

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4 text-center">Crear Compra</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
            <li class="breadcrumb-item"><a href="{{ route('compras.index') }}">Compras</a></li>
            <li class="breadcrumb-item active">Crear Compra</li>
        </ol>

        <div class="container-fluid">
            <form action='{{ route('clientes.store') }}' method="POST">
                @csrf
                <div class="row gy-4">

                    {{-- Compra Producto --}}
                    <div class="col-md-8">
                        <div class="text-white bg-primary p-1 text-center">
                            Detalles de la compra
                        </div>
                        <div class="p-3 border border-3 border-primary">
                            <div class="row">
                                {{-- Producto --}}
                                <div class="col-12 mb-4">
                                    <select name="producto_id" id="producto_id" class="form-control selectpicker" data-live-search="true" title="Busca un producto" data-size="5">
                                        @foreach ($productos as $item)
                                            <option {{ old('producto_id') == $item->id ? 'selected' : '' }} value="{{ $item->id }}">{{ $item->codigo.' - '.$item->nombre }}</option>
                                        @endforeach
                                    </select>
                                    @error('producto_id')
                                        <small class="text-danger">{{'*'.$message}}</small>
                                    @enderror
                                </div>

                                 {{-- Cantidad --}}
                                 <div class="col-md-4 mb-2">
                                    <label for="cantidad" class="form-label">Cantidad:</label>
                                    <input type="number" name="cantidad" id="cantidad" class="form-control">
                                    @error('cantidad')
                                        <small class="text-danger">{{'*'.$message}}</small>
                                    @enderror
                                </div>

                                {{-- Precio de compra --}}
                                <div class="col-md-4 mb-2">
                                    <label for="precio_compra" class="form-label">Precio de compra:</label>
                                    <input type="number" name="precio_compra" id="precio_compra" class="form-control" step="0.1">
                                    @error('precio_compra')
                                        <small class="text-danger">{{'*'.$message}}</small>
                                    @enderror
                                </div>

                                {{-- Precio de venta --}}
                                <div class="col-md-4 mb-2">
                                    <label for="precio_venta" class="form-label">Precio de venta:</label>
                                    <input type="number" name="precio_venta" id="precio_venta" class="form-control" step="0.1">
                                    @error('precio_venta')
                                        <small class="text-danger">{{'*'.$message}}</small>
                                    @enderror
                                </div>

                                {{-- Boton para agregar --}}
                                <div class="col-md-12 my-3 text-end">
                                    <button id="btn_agregar" type="button" class="btn btn-primary">Agregar</button>
                                </div>

                                {{-- Tabla para el detalle de la compra --}}
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table id="tabla_detalle" class="table table-hover">
                                            <thead class="bg-primary text-white">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Producto</th>
                                                    <th>Cantidad</th>
                                                    <th>Precio compra</th>
                                                    <th>Precio venta</th>
                                                    <th>Subtotal</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th></th>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th></th>
                                                    <th>Sumas</th>
                                                    <th><span id="sumas">0</span></th>
                                                </tr>
                                                <tr>
                                                    <th></th>
                                                    <th>IVA %</th>
                                                    <th><span id="iva">0</span></th>
                                                </tr>
                                                <tr>
                                                    <th></th>
                                                    <th>Total</th>
                                                    <th><span id="total">0</span></th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    {{-- Producto --}}
                    <div class="col-md-4">
                        <div class="text-white bg-success p-1 text-center">
                            Datos generales
                        </div>
                        <div class="p-3 border border-3 border-success">
                            <div class="row">
                                {{-- Proveedor --}}
                                <div class="col-md-12 mb-2">
                                    <label for="proveedore_id" class="form-label">Proveedor:</label>
                                    <select name="proveedore_id" id="proveedore_id" class="form-control selectpicker show-tick" data-live-search="true" title="Selecciona" data-size="5">
                                        @foreach ($proveedores as $item)
                                            <option {{ old('proveedore_id') == $item->id ? 'selected' : '' }} value="{{ $item->id }}">{{ $item->persona->razon_social }}</option>
                                        @endforeach
                                    </select>
                                    @error('documento_id')
                                        <small class="text-danger">{{'*'.$message}}</small>
                                    @enderror
                                </div>

                                {{-- Tipo de comprobante --}}
                                <div class="col-md-12 mb-2">
                                    <label for="comprobante_id" class="form-label">Comprobante:</label>
                                    <select name="comprobante_id" id="comprobante_id" class="form-control selectpicker show-tick" title="Selecciona">
                                        @foreach ($comprobantes as $item)
                                            <option {{ old('comprobante_id') == $item->id ? 'selected' : '' }} value="{{ $item->id }}">{{ $item->tipo_comprobante }}</option>
                                        @endforeach
                                    </select>
                                    @error('documento_id')
                                        <small class="text-danger">{{'*'.$message}}</small>
                                    @enderror
                                </div>

                                {{-- Numero de comprobante --}}
                                <div class="col-md-12 mb-2">
                                    <label for="numero_comprobante" class="form-label">Número de comprobante:</label>
                                    <input type="text" name="numero_comprobante" id="numero_comprobante" class="form-control" required>
                                    @error('numero_comprobante')
                                        <small class="text-danger">{{'*'.$message}}</small>
                                    @enderror
                                </div>

                                {{-- Impuesto --}}
                                <div class="col-md-6 mb-2">
                                    <label for="impuesto" class="form-label">Impuesto:</label>
                                    <input type="text" name="impuesto" id="impuesto" class="form-control border-success" readonly>
                                    @error('impuesto')
                                        <small class="text-danger">{{'*'.$message}}</small>
                                    @enderror
                                </div>

                                {{-- Fecha --}}
                                <div class="col-md-6 mb-2">
                                    <label for="fecha" class="form-label">Fecha:</label>
                                    <input type="date" name="fecha" id="fecha" class="form-control border-success" value="<?php echo date("Y-m-d") ?> " readonly>
                                    @error('fecha')
                                        <small class="text-danger">{{'*'.$message}}</small>
                                    @enderror
                                </div>

                                {{-- Botones --}}
                                <div class="col-md-12 my-3 text-center">
                                    <button type="submit" class="btn btn-success">Guardar</button>
                                </div>

                            </div>
                        </div>



                        {{-- <div class="col-12 col-md-6 mb-4">
                            <label for="documento_id" class="form-label">Tipo de documento:</label>
                            <select name="documento_id" id="documento_id" class="form-select">
                                <option value="" selected>Selecciona una opción</option>
                                @foreach ($documentos as $item)
                                    <option {{ old('documento_id') == $item->id ? 'selected' : '' }} value="{{ $item->id }}">{{ $item->tipo_documento }}</option>
                                @endforeach
                            </select>
                            @error('documento_id')
                                <small class="text-danger">{{'*'.$message}}</small>
                            @enderror
                        </div> --}}
                    </div>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary" id="Cargar" name="Cargar" title="Cargar">Cargar datos</button>
                    <a href="{{ route('clientes.index') }}"><button type="button" class="btn btn-secondary bg-danger text-white" title="Cancelar" data-bs-dismiss="modal">Cerrar</button></a>
                </div>
            </form>
        </div>

    </div>
@endsection

@push('js')
    {{-- Bootstrap 4, necesario para bootstrap select --}}
    {{-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    {{-- Bootstrap select --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

    {{-- Eventos --}}
    <script>
        $(document).ready(function () {

            $('#btn_agregar').click(function (e) { 
                agregarProducto();
            });

            $('#impuesto').val(impuesto + '%');

        });

            // Variables
            let cont = 0;
            let subtotal = [];
            let sumas = 0;
            let iva = 0;
            let total = 0;

            // Constantes
            const impuesto = 21;

            function agregarProducto(){
                let idProducto = $('#producto_id').val();
                let nameProducto = ($('#producto_id option:selected').text()).split(' - ')[1];
                let cantidad = $('#cantidad').val();
                let precioCompra = $('#precio_compra').val();
                let precioVenta = $('#precio_venta').val();

                // Calcular valores
                subtotal[cont] = cantidad * precioCompra;
                sumas+= subtotal[cont];
                iva = sumas/100 * impuesto;
                total = sumas + iva;
                

                let fila = '<tr>' +
                                '<th>'+ (cont + 1) +'</th>' +
                                '<td>'+ nameProducto +'</td>' +
                                '<td>'+ cantidad +'</td>' +
                                '<td>'+ precioCompra +'</td>' +
                                '<td>'+ precioVenta +'</td>' +
                                '<td>'+ subtotal[cont] +'</td>' +
                                '<td><i class="fa-regular fa-circle-xmark fs-3 text-danger"></i></td>' +
                            '</tr>';

                $('#tabla_detalle').append(fila);
                limpiarCampos();
                cont++;

                // Mostrar los campos calculados
                $('#sumas').html(sumas);
                $('#iva').html(iva.toFixed(2));
                $('#total').html(total);
            }

            function limpiarCampos() {
                let select = $('#producto_id');
                select.selectpicker();
                select.selectpicker('val', '');
                $('#cantidad').val('');
                $('#precioCompra').val('');
                $('#precioVenta').val('');
            }
        
    </script>
@endpush