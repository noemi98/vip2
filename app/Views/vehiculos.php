<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css"> -->
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">


    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">

</head>

<body>
    <nav class="navbar navbar-light bg-light position-relative overflow-hidden">
        <div class="logo-container navbar-center">
            <span class="navbar-brand mb-0 h1">
                <img src="<?= base_url('assets/images/logo_vip-blanco.png') ?>" alt="">
            </span>
        </div>
        <img src="<?= base_url('assets/images/vehiculo.png') ?>" alt="Vehículo" class="vehiculo vehiculo-original">
        <img src="<?= base_url('assets/images/vehiculo2.png') ?>" alt="Vehículo alterno" class="vehiculo vehiculo-alt">
    </nav>

    <!-- Panel lateral izquierdo -->
    <div id="panelLateral" class="form-group">
        <form id="formVehiculo" action="<?= base_url('save_vehiculo')?>" method="post">
            <h3>Registrar Vehículo</h3>
            <div class="form-group pt-3">
                <label for="placa">Placa</label>
                <input type="text" class="form-control" id="placa" placeholder="Ingrese la placa"
                    oninput="this.value = this.value.toUpperCase()">
            </div>
            <div class="form-group pt-3">
                <label for="marca">Marca</label>
                <select class="form-control" id="marca">
                    <option value="" selected disabled>-Seleccionar-</option>
                    <?php for($i=0; $i<count($marcas); $i++){?>
                    <option value="<?= $marcas[$i]->codigo?>"><?= $marcas[$i]->nombre?></option>
                    <?php } ?>

                </select>
            </div>
            <div class="form-group pt-3">
                <label for="modelo">Modelo</label>
                <input type="text" class="form-control" id="modelo" placeholder="Ingrese el modelo"
                    oninput="this.value = this.value.toUpperCase()">
            </div>

            <div class="form-group pt-3">
                <label for="anioFab">Año de Fabricación</label>
                <input type="number" class="form-control" id="anioFab" placeholder="Ingrese el año de fabricación">
            </div>
            <input type="hidden" id="isUpdate" value="0">
            <input type="hidden" id="codVehiculo" value="">

            <!-- Datos del contacto -->
            <div id="divBtnContacto">
                <button type="button"
                    class="btn p-0 border-0 bg-transparent pt-3 pb-3 d-flex justify-content-center align-items-center"
                    title="Agregar contacto" id="addContacto">
                    <i class="fa fa-user-plus" aria-hidden="true"></i>
                </button>
            </div>
            <div id="formContacto" class="contacto-section p-3 mt-4 rounded" hidden>
                <h5>Datos del CONTACTO</h5>
                <div class="form-group pt-3">
                    <label for="nombres">Nombres</label>
                    <input type="text" class="form-control" id="nombres" placeholder="Ingrese los nombres del contacto"
                        oninput="this.value = this.value.toUpperCase()">
                </div>
                <div class="form-group pt-3">
                    <label for="apellidos">Apellidos</label>
                    <input type="text" class="form-control" id="apellidos"
                        placeholder="Ingrese los apellidos del contacto"
                        oninput="this.value = this.value.toUpperCase()">
                </div>
                <div class="form-group pt-3">
                    <label for="nrodoc">Nro Documento</label>
                    <input type="text" class="form-control" id="nrodoc" placeholder="Ingrese el número de documento"
                        oninput="this.value = this.value.toUpperCase()">
                </div>
                <div class="form-group pt-3">
                    <label for="correo">Correo</label>
                    <input type="email" class="form-control" id="correo" placeholder="Ingrese el correo electrónico"
                        oninput="this.value = this.value.toUpperCase()">
                </div>
                <div class="form-group pt-3">
                    <label for="telefono">Teléfono</label>
                    <input type="text" class="form-control" id="telefono" placeholder="Ingrese el celular del contacto"
                        oninput="this.value = this.value.toUpperCase()">
                </div>
            </div>

            <!-- Fin contacto -->
            <div class="pt-4">
                <button type="submit" id="btnGuardar" class="btn btn-success">Guardar</button>
                <button type="button" id="btnCancelar" class="btn btn-danger">Cancelar</button>
            </div>
        </form>
    </div>


    <div class="container">
        <h3 class="input-form pt-5">Gestión de Vehículos</h3>
        <div class="d-flex justify-content-end pt-3 pb-3">
            <button class="btn btn-primary" id="btnAbrirPanel">Nuevo</button>
        </div>

        <div class="table-responsive">
            <table id="tblVehiculos" class="table table-responsive table-striped display responsive nowrap"
                style="width:100%">
                <thead>
                    <tr>
                        <th>N°</th>
                        <th>Placa</th>
                        <th>Marca</th>
                        <th>Modelo</th>
                        <th>Año Fabricación</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="bodyVehiculos">

                </tbody>

            </table>
        </div>
    </div>

    <!-- Modal de Contacto -->
    <div class="modal fade" id="modalContacto" tabindex="-1" aria-labelledby="modalContactoLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalContactoLabel">Detalles del Contacto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Nombres:</label>
                                <div id="nombresMdl" class="form-control-plaintext">--</div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Apellidos:</label>
                                <div id="apellidosMdl" class="form-control-plaintext">--</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Nro. Documento:</label>
                                <div id="nrodocMdl" class="form-control-plaintext">--</div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Teléfono</label>
                                <div id="telefonoMdl" class="form-control-plaintext">--</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-6">
                                <label class="form-label fw-bold">Correo</label>
                                <div id="correoMdl" class="form-control-plaintext">--</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
    $(document).ready(function() {
        $('#tblVehiculos').DataTable({
            responsive: true,
            processing: true,
            ajax: {
                type: "GET",
                url: "<?= base_url(); ?>list",
            },
            columns: [{
                    data: null,
                    render: function(data, type, row, meta) {
                        return meta.row + 1;
                    },
                    orderable: false,
                    searchable: false
                },
                {
                    "data": "placa"
                },
                {
                    "data": "marca"
                },
                {
                    "data": "modelo"
                },
                {
                    "data": "anioFabricacion"
                },
                {
                    data: null,
                    render: function(data, type, row) {
                        const contactoBtn = row.codCliente > 0 ?
                            `<button class="btn btn-sm btn-success btnContact" data-id="${row.codCliente}" title="Ver Contacto"><i class="fas fa-user"></i></button>` :
                            `<button class="btn btn-sm btn-success btnContact" title="Sin contacto" disabled><i class="fas fa-user"></i></button>`;

                        return `
                                <button class="btn btn-sm btn-primary btnEdit" data-id="${row.codigo}" title="Editar"><i class="fas fa-pen"></i></button>
                                <button class="btn btn-sm btn-danger btnDelete" data-id="${row.codigo}" title="Eliminar"><i class="fas fa-trash"></i></button>
                                ${contactoBtn}
                            `;
                    },
                    orderable: false,
                    searchable: false
                }
            ],
            language: {
                "decimal": "",
                "emptyTable": "No hay información",
                "info": "Mostrando del _START_ al _END_ de _TOTAL_ registros",
                "infoEmpty": "Mostrando del 0 al 0 de 0 Registros",
                "infoFiltered": "(Filtrado de _MAX_ registros en total)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ registros",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "Buscar:",
                "zeroRecords": "Sin resultados encontrados",
                "paginate": {
                    "first": "Primero",
                    "last": "Ultimo",
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            },

        });

        $('#btnAbrirPanel').click(function() {
            $('#panelLateral').addClass('abierto');
        });

        $('#btnCancelar').click(function() {
            $('#panelLateral').removeClass('abierto');
            limpiarCampos();
        });

        $('#formVehiculo').submit(function(e) {
            e.preventDefault();
            //console.log('Formulario enviado...');

            marca = $('#marca').val();
            placa = $('#placa').val();
            modelo = $('#modelo').val();
            anioFab = $('#anioFab').val();

            //Datos del contacto
            nombres = $('#nombres').val();
            apellidos = $('#apellidos').val();
            nrodoc = $('#nrodoc').val();
            correo = $('#correo').val();
            telefono = $('#telefono').val();

            isUpdate = $('#isUpdate').val();

            if (isUpdate == 1) {
                //UPDATE
                codVehiculo = $('#codVehiculo').val();
                $.ajax({
                    method: "POST",
                    url: "<?= base_url(); ?>delete_vehiculo",
                    data: {
                        "placa": placa,
                        "marca": marca,
                        "modelo": modelo,
                        "anioFab": anioFab,
                        "nombres": nombres,
                        "apellidos": apellidos,
                        "nrodoc": nrodoc,
                        "correo": correo,
                        "telefono": telefono,
                        "isDelete": 0,
                        "codvehiculo": codVehiculo,
                    },
                    dataType: 'json',
                    success: function(reponse) {
                        console.log(reponse);
                        if (reponse.status = 'ok') {
                            $('#tblVehiculos').DataTable().ajax.reload();
                            Swal.fire({
                                title: '¡Vehículo actualizado!',
                                text: 'La información del vehículo fue actualizada con éxito.',
                                icon: 'success',
                                confirmButtonColor: '#145b9c',
                            });
                            limpiarCampos();
                        }

                    }
                });
            } else {
                //CREATE
                $.ajax({
                    method: "POST",
                    url: "<?= base_url(); ?>save_vehiculo",
                    data: {
                        "placa": placa,
                        "marca": marca,
                        "modelo": modelo,
                        "anioFab": anioFab,
                        "nombres": nombres,
                        "apellidos": apellidos,
                        "nrodoc": nrodoc,
                        "correo": correo,
                        "telefono": telefono,
                    },
                    dataType: 'json',
                    success: function(reponse) {
                        console.log(reponse);
                        if (reponse.status = 'ok') {
                            $('#tblVehiculos').DataTable().ajax.reload();
                            Swal.fire({
                                title: '¡Vehículo registrado!',
                                text: 'La información del vehículo fue registrado con éxito.',
                                icon: 'success',
                                confirmButtonColor: '#145b9c',
                            });
                            limpiarCampos();
                        }

                    }
                });
            }


            $('#panelLateral').removeClass('abierto');

        });


        // Cerrar el modal y limpiar los campos
        $('#modalContacto').on('hidden.bs.modal', function() {
            $('#nombre, #apellidos, #nrodoc, #telefono').val('');
        });
    });

    $('#tblVehiculos').on('click', '.btnContact', function() {
        var codCliente = $(this).data('id');
        if (codCliente > 0) {
            $.ajax({
                url: '<?= base_url(); ?>get_contacto/' + codCliente,
                method: 'GET',
                dataType: 'json',
                success: function(response) {
                if (response.status === 'ok') {
                    var contacto = response.data;
                    $('#nombresMdl').text(contacto[0].nombres);
                    $('#apellidosMdl').text(contacto[0].apellidos);
                    $('#nrodocMdl').text(contacto[0].nroDoc);
                    $('#telefonoMdl').text(contacto[0].telefono);
                    $('#correoMdl').text(contacto[0].correo);
                    $('#modalContacto').modal('show');
                } else {
                    Swal.fire('Error', 'No se encontró el contacto.', 'error');
                }
                },
                error: function() {
                Swal.fire('Error', 'Hubo un problema al cargar los datos.', 'error');
                }
            });
        }
    });

    $('#tblVehiculos').on('click', '.btnEdit', function() {
        const id = $(this).data('id');

        $('#formContacto').prop('hidden', false);
        $('#divBtnContacto').prop('hidden', true);

        $.ajax({
            method: "POST",
            url: "<?= base_url(); ?>vehiculoById",
            data: {
                "codvehiculo": id,
            },
            dataType: 'json',
            success: function(data) {
                $('#panelLateral').addClass('abierto');
                $('#marca').val(data[0].codMarca);
                $('#placa').val(data[0].placa);
                $('#modelo').val(data[0].modelo);
                $('#anioFab').val(data[0].anioFabricacion);

                $('#nombres').val(data[0].nombres);
                $('#apellidos').val(data[0].apellidos);
                $('#nrodoc').val(data[0].nroDoc);
                $('#correo').val(data[0].correo);
                $('#telefono').val(data[0].telefono);

                $('#btnGuardar').text('Guardar Cambios');
                $('#isUpdate').val(1);
                $('#codVehiculo').val(id);

            }
        });
    });

    $('#tblVehiculos').on('click', '.btnDelete', function() {
        const id = $(this).data('id');
        Swal.fire({
            title: '¿Estás seguro de eliminar el vehículo?',
            text: "Esta acción eliminará el registro de forma permanente.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Sí, eliminar',
            confirmButtonColor: '#ff133f',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                $.post('<?= base_url(); ?>delete_vehiculo', {
                    codvehiculo: id,
                    isDelete: 1
                }, function(response) {
                    $('#tblVehiculos').DataTable().ajax.reload();
                }, 'json');
            }
        });
    });

    function limpiarCampos() {
        $('#marca').val('');
        $('#placa').val('');
        $('#modelo').val('');
        $('#anioFab').val('');
        $('#btnGuardar').text('Guardar');
    }

    $('#addContacto').click(function() {
        //alert("Agregar contacto");
        $('#formContacto').prop('hidden', false);
        $('#divBtnContacto').prop('hidden', true);

    });
    </script>



</body>

</html>