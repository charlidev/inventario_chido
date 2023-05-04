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
                        <h1 class="h3 mb-0 text-gray-800">Catálogo de Unidades</h1>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarUnidad" id="btnAgregarUnidad">
                            Agregar Unidad
                        </button>
                    </div>

                    <!-- Datatable -->
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th class="w-50">Unidad</th>
                                            <th class="w-25">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        require 'php/db_connection.php';
                                        $conexion = $connection;
                                        $consulta = "SELECT idUnidad, Nombre FROM tblUnidad";
                                        $resultado = sqlsrv_query($conexion, $consulta);
                                        while ($row = sqlsrv_fetch_array($resultado, SQLSRV_FETCH_ASSOC)) {
                                        ?>
                                        <tr>
                                            <!-- <td><?php echo $row['idUnidad'] ?></td> -->
                                            <td><?php echo $row['Nombre'] ?></td>
                                            <td>
                                                <div class="text-center">
                                                    <div>
                                                        <button type="button" class="btn btn-primary" onclick="mostrarUnidad(<?php echo $row['idUnidad'] ?>)" data-toggle="modal" data-target="#modalEditarUnidad">Editar</button>
                                                        <button type="button" class="btn btn-danger" onclick="eliminarUnidad(<?php echo $row['idUnidad'] ?>)">Borrar</button>
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


    <!-- Codigo del modal de AGREGAR UNIDAD-->
    <div class="modal fade" id="modalAgregarUnidad" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar Unidad</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="formAgregarUnidad">
                    <div class="modal-body">
                        
                        <div>
                            <label for="Nombre">Unidad</label>
                            <input type="text" name="nombre" id="nombreUnidad" class="form-control">
                            <br>
                        </div>
                            
                    </div>
                        <div class="modal-footer">
                            <input type="button" class="btn btn-success" value="Agregar" onclick="agregarUnidad()">
                        </div>
                    </div>
                </form>
        </div>
    </div>

    <!-- Codigo del modal de EDITAR MATERIAL-->
    <div class="modal fade" id="modalEditarUnidad" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Unidad</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <div class="modal-body">
                <form method="POST" id="formEditarUnidad">
                    <div>

                        <input type="text" name="editaridUnidad" id="editaridUnidad" class="form-control d-none " readonly>
                        <br>

                        <label for="Nombre">Nombre</label>
                        <input type="text" name="editarUnidad" id="editarUnidad" class="form-control">
                        <br>

                    </div>
                    
                </form>
            </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" value="Guardar" onclick="editarUnidad()">Guardar</button>
                </div>
            </div>
        </div>
    </div>

</body>