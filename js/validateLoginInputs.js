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
                });
                $('#dataTable').load(location.href + " #dataTable");
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

function mostrarDependencia(idDependencia){
    let data = {'id': idDependencia};
    $.ajax({
      type: "POST",
      url: "php/mostrarDependencia.php",
      data: data,
      dataType: "JSON",
      success: function(depen){
          $('#idEditar').val(depen.id);
          $('#nombreEditar').val(depen.nombre);
          $('#estatusEditar').val(depen.estatus);
      }
  });
}

//Función para elimnar registro de dependencia
function eliminarDependencia(idDependencia) {

    let data = {'id': idDependencia};
    swal({
      title: "¿Estás seguro?",
      text: "Una vez eliminado, no podrás recuperar este registro",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    }).then((willDelete) => {
      if (willDelete) {
        // Si el usuario confirma la eliminación, enviar la petición AJAX
        $.ajax({
          type: "POST",
          url: "php/eliminarDependencia.php",
          data: data,
          dataType: "json",
          success: function(data) {
            // Si la eliminación fue exitosa, mostrar una alerta de éxito
            if(data.status == 1){
              swal({
                title: "Éxito.",
                text: data.msg,
                icon: "success"
              });
              $('#dataTable').load(location.href + " #dataTable");
            }
            else{
              swal({
                title: "Error.",
                text: data.msg,
                icon: "error"
              });
            }
          }
        });
      }
    });
  }

function editarDependencia(){
    let data = {
      'id': $('#idEditar').val(),
      'nombreEDepen': $('#nombreEditar').val(),
      'estatusEDepen': $('#estatusEditar').val()
    }
    $.ajax({
      type: "POST",
      url: "php/actualizarDependencia.php",
      data: data,
      dataType: "JSON",
      success: function(data) {
          if(data.status == 1){
              swal({
                  title: "Éxito",
                  text: data.msg,
                  icon: "success"
              }).then(function(){
                  // Esta función se ejecuta cuando el usuario hace clic en "OK"
                  $("#formEditarDependencia").trigger("reset");
                  $("#modalEditarDependencia").modal("hide");
              });
              $('#dataTable').load(location.href + " #dataTable");
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

