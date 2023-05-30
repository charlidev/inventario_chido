<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/login.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="./js/jquery-3.5.1.js"></script>
    <script src="./js/validateLoginInputs.js"></script>
    <title>Inicio de Sesión</title>
</head>
<body>
    <div class="wrapper">
        <div class="container main">
            <div class="row">
                <div class="col-md-6 side-image">
                    <!-------Image-------->
                </div>
                    <div class="col-md-6 right">
                        <form class="needs-validation" method="post" novalidate>
                            <div class="input-box">
                                <header>¡Bienvenido (a)!</header>
                                <div class="input-field">
                                    <input type="text" class="input" id="user" required name="usuario" autocomplete="off">
                                    <label for="user">Usuario</label>
                                </div>

                                <div class="input-field">
                                    <input type="password" class="input" id="pass" required name="contraseña">
                                    <label for="pass">Contraseña</label>
                                </div>

                                <br>
                                <div class="input-field">
                                    <button type="button" class="submit" name="btnIngresar" onclick="login()">Iniciar Sesión</button>
                                </div>
                                <br>
                                
                                <div class="input-field">
                                    <button type="button" class=" submit" data-bs-toggle="modal" data-bs-target="#registerModal">Regístrate</button>
                                </div>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="registerModalLabel">Registro</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="register-form">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" id="password" required>
                        </div>
                        <button type="submit" class="btn submit">Registrarse</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        //Código para que cuando de Enter se dispare el login
        $(document).ready(function() {
            // Capturamos el evento "keydown" en los inputs de usuario y contraseña
            $("#user, #pass").keydown(function(event) {
                // Si se presiona la tecla "Enter" (cuyo código es 13)
                if (event.keyCode === 13) {
                    // Ejecutamos la función "login()"
                    login();
                }
            });
        });
    </script>
</body>
</html>