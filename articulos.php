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
                                        $consulta = "SELECT a.idArticulo, a.Nombre, a.Existencia, a.fechaRegistro, a.oficioEntra, m.Marca, ma.Material, u.Nombre AS Unidad 
                                                    FROM tblArticulo a
                                                    INNER JOIN tblMarca m ON a.idMarca = m.idMarca
                                                    INNER JOIN tblMaterial ma ON a.idMaterial = ma.idMaterial
                                                    INNER JOIN tblUnidad u ON a.idUnidad = u.idUnidad";
                                        $resultado = sqlsrv_query($conexion, $consulta);
                                        while ($row = sqlsrv_fetch_array($resultado, SQLSRV_FETCH_ASSOC)) {
                                        ?>
                                            <tr>
                                                <td><?php echo $row['Nombre'] ?></td>
                                                <td><?php echo $row['Existencia'] ?></td>
                                                <td><?php echo date_format($row['fechaRegistro'], 'd-m-Y') ?></td>
                                                <td><?php echo $row['oficioEntra'] ?></td>
                                                <td><?php echo $row['Marca'] ?></td>
                                                <td><?php echo $row['Material'] ?></td>
                                                <td><?php echo $row['Unidad'] ?></td>
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


    <!-- Codigo del modal de AGREGAR ARTICULO-->
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
                            <label for="nombreArticulo">Nombre</label>
                            <input type="text" name="nombreArticulo" id="nombreArticulo" class="form-control" autocomplete="off">
                            <br>

                            <label for="existenciaArticulo">Existencia</label>
                            <input type="text" name="existenciaArticulo" id="existenciaArticulo" class="form-control" autocomplete="off">
                            <br>

                            <label for="fechaRegistroArticulo">Fecha de Registro</label>
                            <input type="text" name="fechaRegistroArticulo" id="fechaRegistroArticulo" class="form-control" autocomplete="off">
                            <br>

                            <label for="oficioArticulo">Oficio</label>
                            <input type="text" name="oficioArticulo" id="oficioArticulo" class="form-control" autocomplete="off">
                            <br>

                            

                            <?php
                                require 'php/db_connection.php';
                                $conexion = $connection;

                                // Consulta para obtener los materiales
                                $consultaMaterial = "SELECT idMaterial, Material FROM tblMaterial";
                                $resultadoMaterial = sqlsrv_query($conexion, $consultaMaterial);

                                // Consulta para obtener las unidades
                                $consultaUnidad = "SELECT idUnidad, Nombre FROM tblUnidad";
                                $resultadoUnidad = sqlsrv_query($conexion, $consultaUnidad);

                                // Consulta para obtener las unidades
                                $consultaMarca = "SELECT idMarca, Marca FROM tblMarca";
                                $resultadoMarca = sqlsrv_query($conexion, $consultaMarca);
                                ?>

                                <label for="marcaArticulo">Marca</label>
                                <!-- Generar opciones para la lista desplegable de Material -->
                                <select name="marcaArticulo" id="marcaArticulo" class="form-control">
                                    <?php
                                    while ($row = sqlsrv_fetch_array($resultadoMarca, SQLSRV_FETCH_ASSOC)) {
                                        echo '<option value="' . $row['idMarca'] . '">' . $row['Marca'] . '</option>';
                                    }
                                    ?>
                                </select>
                                <br>

                                <label for="materialArticulo">Material</label>
                                <!-- Generar opciones para la lista desplegable de Material -->
                                <select name="materialArticulo" id="materialArticulo" class="form-control">
                                    <?php
                                    while ($row = sqlsrv_fetch_array($resultadoMaterial, SQLSRV_FETCH_ASSOC)) {
                                        echo '<option value="' . $row['idMaterial'] . '">' . $row['Material'] . '</option>';
                                    }
                                    ?>
                                </select>
                                <br>
                                
                                <label for="unidadArticulo">Unidad</label>
                                <!-- Generar opciones para la lista desplegable de Unidad -->
                                <select name="unidadArticulo" id="unidadArticulo" class="form-control">
                                    <?php
                                    while ($row = sqlsrv_fetch_array($resultadoUnidad, SQLSRV_FETCH_ASSOC)) {
                                        echo '<option value="' . $row['idUnidad'] . '">' . $row['Nombre'] . '</option>';
                                    }
                                    ?>
                                </select>
                                <br>
                        </div>
                            
                    </div>
                        <div class="modal-footer">
                            <input type="button" class="btn btn-success" value="Agregar" onclick="agregarArticulo()">
                        </div>
                    </div>
                </form>
        </div>
    </div>

    <!-- Codigo del modal de EDITAR ARTICULO-->
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

                        <input type="text" name="editaridArticuloE" id="editaridArticuloE" class="form-control d-none " readonly>
                        <br>

                        <label for="nombreArticuloE">Nombre</label>
                        <input type="text" name="nombreArticuloE" id="nombreArticuloE" class="form-control" autocomplete="off">
                        <br>

                        <label for="existenciaArticuloE">Existencia</label>
                        <input type="text" name="existenciaArticuloE" id="existenciaArticuloE" class="form-control" autocomplete="off">
                        <br>

                        <label for="fechaRegistroArticuloE">Fecha de Registro</label>
                        <input type="text" name="fechaRegistroArticuloE" id="fechaRegistroArticuloE" class="form-control" autocomplete="off">
                        <br>

                        <label for="oficioArticuloE">Oficio</label>
                        <input type="text" name="oficioArticuloE" id="oficioArticuloE" class="form-control" autocomplete="off">
                        <br>


                        <label for="marcaArticuloE">Marca</label>
                        <!-- Generar opciones para la lista desplegable de Material -->
                        <select name="marcaArticuloE" id="marcaArticuloE" class="form-control">
                                
                        </select>
                        <br>

                        <label for="materialArticuloE">Material</label>
                        <!-- Generar opciones para la lista desplegable de Material -->
                        <select name="materialArticuloE" id="materialArticuloE" class="form-control">
                                
                        </select>
                        <br>
                                
                        <label for="unidadArticuloE">Unidad</label>
                        <!-- Generar opciones para la lista desplegable de Unidad -->
                        <select name="unidadArticuloE" id="unidadArticuloE" class="form-control">
                                
                        </select>
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
</script>
</body>