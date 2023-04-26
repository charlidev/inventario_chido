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

//FUNCIONES PARA LA PAGINA DE DEPENDEDENCIAS
function agregarDependencia(){
    
    let data = {
        'nombreDepen': $('#nombreDepen').val(),
        'estatusDepen': $('input[name=estatusDepen]:checked').val()
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
          if (depen.estatus === 'Activo' || depen.estatus === 'Activa') {
            $('#activoEdi').prop('checked', true);
          } else {
            $('#inactivoEdi').prop('checked', true);
          }
      }
  });
}

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
      'estatusEDepen': $('input[name=estatusDepen]:checked').val()
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

//FUNCIONES PARA LA PAGINA DE ROL
function agregarRol(){
    
  let data = {
      'nombreRol': $('#nombreRol').val(),
      'estatusRol': $('input[name=estatusRol]:checked').val()
  }

  $.ajax({
      type: "POST",
      url: "php/agregarRol.php",
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
                  $("#formAgregarRol").trigger("reset");
                  $("#modalAgregarRol").modal("hide");
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

function eliminarRol(idRol) {

  let data = {'id': idRol};
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
        url: "php/eliminarRol.php",
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

function mostrarRol(idRol){
  let data = {'id': idRol};
  $.ajax({
    type: "POST",
    url: "php/mostrarRol.php",
    data: data,
    dataType: "JSON",
    success: function(rol){
        $('#idEditarRol').val(rol.id);
        $('#nombreEditarRol').val(rol.nombre);
        if (rol.estatus === 'Activo' || rol.estatus === 'Activa') {
          $('#activoEdiRol').prop('checked', true);
        } else {
          $('#inactivoEdiRol').prop('checked', true);
        }
    }
});
}

function editarRol(){
  let data = {
    'id': $('#idEditarRol').val(),
    'nombreRole': $('#nombreEditarRol').val(),
    'estatusRole': $('input[name=estatusRol]:checked').val()
  }
  $.ajax({
    type: "POST",
    url: "php/actualizarRol.php",
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
                $("#formEditarRol").trigger("reset");
                $("#modalEditarRol").modal("hide");
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