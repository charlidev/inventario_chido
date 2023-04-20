function login() {

    let data = {
        'usuario': $('#user').val(),
        'contraseña': $('#pass').val()
    }

    $.ajax({
        type: "POST",
        url: "php/loginController.php",
        data: data,
        dataType: "json",
        success: function(data) {
            if(data.status == 0){
                swal({
                    title: "Error",
                    text: data.msg,
                    icon: "error"
                });
                $('#user').val('');
                $('#pass').val('');
            }
            else{
                window.location.replace("home.php");
            }
        }
    });
}

function agregarDependencia(){
    
    let data = {
        'nombreDepen': $('#nombreDepen').val(),
        'estatusDepen': $('#estatusDepen').val()
    }

    $.ajax({
        type: "POST",
        url: "php/agregarDependencia.php",
        data: data,
        dataType: "json",
        success: function(data) {
            if(data.status == 1){
                swal({
                    title: "Éxito",
                    text: data.msg,
                    icon: "success"
                }).then(function(){
                    // Esta función se ejecuta cuando el usuario hace clic en "OK"
                    $("#formAgregarDependencia").trigger("reset");
                    $("#modalAgregarDependencia").modal("hide");
                    $('#dataTable').load(location.href + " #dataTable");
                });
            }
            else{
                swal({
                    title: "Error",
                    text: data.msg,
                    icon: "error"
                });
            }
        }
    });
}

function editarDependencia(){
    
}

//Función para elimnar registro de dependencia
function eliminarRegistro(idDependencia) {

    let id = idDependencia;

    swal({
        title: "¿Estás seguro?",
        text: "Una vez eliminado, no podrás recuperar este registro",
        icon: "warning",
        buttons: ["Cancelar", "Eliminar"],
        dangerMode: true,
    }).then((result) => {
        console.log(result.value);
      if (result.value) {
        // Si el usuario confirma la eliminación, enviar la petición AJAX
        console.log(result.value);
        $.ajax({
          type: "POST",
          url: "php/eliminarDependencia.php",
          data: id,
          dataType: "json",
          success: function(data) {
            // Si la eliminación fue exitosa, mostrar una alerta de éxito
            if(data.status == 1){
                swal({
                    title: "Éxito",
                    text: data.msg,
                    icon: "success"
                }).then(function(){
                    // Esta función se ejecuta cuando el usuario hace clic en "OK"
                    $('#dataTable').load(location.href + " #dataTable");
                });
            }
            else{
                swal({
                    title: "Error",
                    text: data.msg,
                    icon: "error"
                });
            }
          }
          
        });
      }
    });
  }

