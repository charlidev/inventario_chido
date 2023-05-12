<?php
    session_start();
    $usuario = $_SESSION['username'];
    
    if(!isset($usuario)){
        header('Location: index.php');
    }
?>

<?php require('header.php')?>

<body id="page-top">
    
    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php require('sidebar.php')?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php require('navbar.php')?>
                <!-- End of Topbar -->

                <!-- Comienza contenido de la Página -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h4 mb-0 text-gray-800">Catálogo de Artículos</h1>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarArticulo" id="btnAgregarArticulo">
                            Agregar Artículo
                        </button>
                    </div>

                    <!-- Datatable -->
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Existencia</th>
                                            <th>Código de barras</th>
                                            <th>Fecha Registro</th>
                                            <th>Oficio</th>
                                            <th>Marca</th>
                                            <th>Material</th>
                                            <th>Unidad</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        require 'php/db_connection.php';
                                        $conexion = $connection;
                                        $consulta = "SELECT idArticulo, Nombre, Existencia, Codigo, fechaRegistro, oficioEntra, idMarca, idMaterial, idUnidad FROM tblArticulo";
                                        $resultado = sqlsrv_query($conexion, $consulta);
                                        while ($row = sqlsrv_fetch_array($resultado, SQLSRV_FETCH_ASSOC)) {
                                        ?>
                                        <tr>
                                            <!-- <td><?php echo $row['idArticulo'] ?></td> -->
                                            <td><?php echo $row['Nombre'] ?></td>
                                            <td><?php echo $row['Existencia'] ?></td>
                                            <td><?php echo $row['Codigo'] ?></td>
                                            <td><?php echo date_format($row['fechaRegistro'], 'd-m-Y') ?></td>
                                            <td><?php echo $row['oficioEntra'] ?></td>
                                            <td><?php echo $row['idMarca'] ?></td>
                                            <td><?php echo $row['idMaterial'] ?></td>
                                            <td><?php echo $row['idUnidad'] ?></td>
                                            <td>
                                                <div class="text-center">
                                                    <div>
                                                        <button type="button" class="btn btn-primary" onclick="mostrarArticulo(<?php echo $row['idArticulo'] ?>)" data-toggle="modal" data-target="#modalEditarArticulo">Editar</button>
                                                        <button type="button" class="btn btn-danger" onclick="eliminarArticulo(<?php echo $row['idArticulo'] ?>)">Borrar</button>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- Termina el Datatable -->
                </div>
                <!-- Termina contenido de página -->
                


            </div>
            <!-- End of Main Content -->
            <!-- Footer -->
            <?php require('footer.php')?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->


    <!-- Codigo del modal de AGREGAR MARCA-->
    <div class="modal fade" id="modalAgregarArticulo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar Artículo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="formAgregarArticulo">
                    <div class="modal-body">
                        
                        <div>
                            <label for="Nombre">Nombre</label>
                            <input type="text" name="nombre" id="nombreArticulo" class="form-control">
                            <br>

                            <label for="Nombre">Existencia</label>
                            <input type="text" name="nombre" id="existenciaArticulo" class="form-control">
                            <br>

                            <label for="Nombre">Código</label>
                            <input type="text" name="nombre" id="codigoArticulo" class="form-control">
                            <br>

                            <label for="Nombre">Fecha de Registro</label>
                            <input type="text" name="nombre" id="fechaRegistroArticulo" class="form-control">
                            <br>

                            <label for="Nombre">Oficio</label>
                            <input type="text" name="nombre" id="oficioArticulo" class="form-control">
                            <br>

                            <label for="Nombre">Marca</label>
                            <input type="text" name="nombre" id="marcaArticulo" class="form-control">
                            <br>

                            <label for="Nombre">Material</label>
                            <input type="text" name="nombre" id="materialArticulo" class="form-control">
                            <br>

                            <label for="Nombre">Unidad</label>
                            <input type="text" name="nombre" id="unidadArticulo" class="form-control">
                            <br>
                        </div>
                            
                    </div>
                        <div class="modal-footer">
                            <input type="button" class="btn btn-success" value="Agregar" onclick="agregarMarca()">
                        </div>
                    </div>
                </form>
        </div>
    </div>

    <!-- Codigo del modal de EDITAR MARCA-->
    <div class="modal fade" id="modalEditarArticulo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Artículo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <div class="modal-body">
                <form method="POST" id="formEditarArticulo">
                    <div>

                        <input type="text" name="editaridUnidad" id="editaridMarca" class="form-control d-none " readonly>
                        <br>

                        <label for="Nombre">Nombre</label>
                        <input type="text" name="editarUnidad" id="editarMarca" class="form-control">
                        <br>

                    </div>
                    
                </form>
            </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" value="Guardar" onclick="editarMarca()">Guardar</button>
                </div>
            </div>
        </div>
    </div>


    <script src="js/datepicker.js"></script>
</body>