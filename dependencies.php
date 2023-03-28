<?php
    session_start();
    $usuario = $_SESSION['username'];
    
    if(!isset($usuario)){
        header('Location: index.php');
    }
?>

<?php 
    require 'php/db_connection.php';
    $conexion = $connection;
    $consulta = "SELECT idDependencia, Nombre, Estatus FROM tblDependencia";
    $resultado = sqlsrv_query($conexion, $consulta);    
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
                        <h1 class="h3 mb-0 text-gray-800">Catálogo de Dependencias</h1>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarDependencia" id="btnAgregarDependencia">
                            Agregar Dependencia
                        </button>
                    </div>

                    <!-- Datatable -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Aquí podrían ir los botones para exportar.</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <!-- <th class="w-25">id</th> -->
                                            <th class="w-50">Dependencia</th>
                                            <th class="w-25">Estatus</th>
                                            <th class="w-25">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            while ($row = sqlsrv_fetch_array($resultado, SQLSRV_FETCH_ASSOC)) {
                                        ?>
                                        <tr>
                                            <!-- <td><?php echo $row['idDependencia'] ?></td> -->
                                            <td><?php echo $row['Nombre'] ?></td>
                                            <td><?php echo $row['Estatus'] ?></td>
                                            <td></td>
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


    <!-- Aqui puede ir el codigo del modal -->
    <div class="modal fade" id="modalAgregarDependencia" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar Dependencia</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <div class="modal-body">
                <form method="POST" id="formAgregarDependencia">
                    <div>
                        <label for="Nombre">Nombre de la dependencia</label>
                        <input type="text" name="nombre" id="nombre" class="form-control">
                        <br>

                        <label for="Nombre">Estatus de la dependencia</label>

                        <div class="d-flex justify-content-between">
                            <div>
                                <input type="radio" name="radio" id="radio1" value="1">
                                <label for="radio1">Activa</label>
                            </div>
                            <div>
                                <input type="radio" name="radio" id="radio2" value="2">
                                <label for="radio2">Inactiva</label>
                            </div>
                            <div> </div>
                        </div>

                    </div>
                </form>
            </div>
                <div class="modal-footer">
                    <input type="submit" name="action" id="action" class="btn btn-success" value="Agregar">
                    
                </div>
            </div>
        </div>
    </div>

</body>