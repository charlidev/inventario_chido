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
                        <h1 class="h3 mb-0 text-gray-800">Catálogo de Roles</h1>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarRol" id="btnAgregarDependencia">
                            Agregar Nuevo Rol
                        </button>
                    </div>

                    <!-- Datatable -->
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <!-- <th class="w-25">id</th> -->
                                            <th class="w-50">Nombre</th>
                                            <th class="w-25">Estatus</th>
                                            <th class="w-25">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        require 'php/db_connection.php';
                                        $conexion = $connection;
                                        $consulta = "SELECT idRol, nombreRol, Estatus FROM tblRol";
                                        $resultado = sqlsrv_query($conexion, $consulta);
                                        while ($row = sqlsrv_fetch_array($resultado, SQLSRV_FETCH_ASSOC)) {
                                        ?>
                                        <tr>
                                            <!-- <td><?php echo $row['idRol'] ?></td> -->
                                            <td><?php echo $row['nombreRol'] ?></td>
                                            <td><?php echo $row['Estatus'] ?></td>
                                            <td>
                                                <div class="text-center">
                                                    <div>
                                                        <button type="button" class="btn btn-primary" onclick="mostrarRol(<?php echo $row['idRol'] ?>)" data-toggle="modal" data-target="#modalEditarRol" id="btnAgregarDependencia">Editar</button>
                                                        <button type="button" class="btn btn-danger" onclick="eliminarRol(<?php echo $row['idRol'] ?>)">Borrar</button>
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


    <!-- Codigo del modal de AGRAGAR DEPENDENCIA-->
    <div class="modal fade" id="modalAgregarRol" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar Rol</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="formAgregarRol">
                    <div class="modal-body">
                        
                        <div>
                            <label for="Nombre">Nombre</label>
                            <input type="text" name="nombre" id="nombreRol" class="form-control">
                            <br>

                            <label for="estatusRol">Estatus</label>
                            <div>
                                <input type="radio" name="estatusRol" id="activo" value="Activo">
                                <label for="activo">Activo</label>

                                <input type="radio" name="estatusRol" id="inactivo" value="Inactivo">
                                <label for="inactivo">Inactivo</label>
                            </div>
                            <br>
                        </div>
                            
                    </div>
                        <div class="modal-footer">
                            <input type="button" class="btn btn-success" value="Agregar" onclick="agregarRol()">
                        </div>
                    </div>
                </form>
        </div>
    </div>

    <!-- Codigo del modal de EDITAR DEPENDENCIA-->
    <div class="modal fade" id="modalEditarRol" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Rol</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <div class="modal-body">
                <form method="POST" id="formEditarRol">
                    <div>
                        <label for="Nombre">ID</label>
                        <input type="text" name="idEditar" id="idEditarRol" class="form-control" readonly>
                        <br>

                        <label for="Nombre">Nombre</label>
                        <input type="text" name="nombreEditar" id="nombreEditarRol" class="form-control">
                        <br>

                        <label for="estatusRol">Estatus</label>
                            <div>
                                <input type="radio" name="estatusRol" id="activoEdiRol" value="Activo">
                                <label for="activoEdiRol">Activo</label>

                                <input type="radio" name="estatusRol" id="inactivoEdiRol" value="Inactivo">
                                <label for="inactivoEdiRol">Inactivo</label>
                            </div>
                        <br>
                    </div>
                    
                </form>
            </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" value="Guardar" onclick="editarRol()">Guardar</button>
                </div>
            </div>
        </div>
    </div>



</body>