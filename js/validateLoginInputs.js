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

//FUNCIONES PARA LA PAGINA DE METERIAL
function agregarMaterial(){
    
  let data = {
      'nombreMaterial': $('#nombreMaterial').val()
  }

  $.ajax({
      type: "POST",
      url: "php/agregarMaterial.php",
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
                  $("#formAgregarMaterial").trigger("reset");
                  $("#modalAgregarMaterial").modal("hide");
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

function eliminarMaterial (idMaterial) {

  let data = {'id': idMaterial};
  swal({
    title: "¿Estás seguro?",
    text: "Una vez eliminado, no podrás recuperar este registro.",
    icon: "warning",
    buttons: true,
    dangerMode: true,
  }).then((willDelete) => {
    if (willDelete) {
      // Si el usuario confirma la eliminación, enviar la petición AJAX
      $.ajax({
        type: "POST",
        url: "php/eliminarMaterial.php",
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

function mostrarMaterial(idMaterial){
  let data = {'id': idMaterial};
  $.ajax({
    type: "POST",
    url: "php/mostrarMaterial.php",
    data: data,
    dataType: "JSON",
    success: function(mate){
        $('#idEditarMaterial').val(mate.id);
        $('#editarMaterial').val(mate.nombre);
    }
});
}

function editarMaterial(){
  let data = {
    'id': $('#idEditarMaterial').val(),
    'material': $('#editarMaterial').val(),
  }
  $.ajax({
    type: "POST",
    url: "php/actualizarMaterial.php",
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
                $("#formEditarMaterial").trigger("reset");
                $("#modalEditarMaterial").modal("hide");
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

//FUNCIONES PARA LA PAGINA DE UNIDAD
function agregarUnidad(){

  let data = {
      'nombreUnidad': $('#nombreUnidad').val()
  }

  $.ajax({
      type: "POST",
      url: "php/agregarUnidad.php",
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
                  $("#formAgregarUnidad").trigger("reset");
                  $("#modalAgregarUnidad").modal("hide");
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

function eliminarUnidad (idUnidad) {

  let data = {'id': idUnidad};
  swal({
    title: "¿Estás seguro?",
    text: "Una vez eliminado, no podrás recuperar este registro.",
    icon: "warning",
    buttons: true,
    dangerMode: true,
  }).then((willDelete) => {
    if (willDelete) {
      // Si el usuario confirma la eliminación, enviar la petición AJAX
      $.ajax({
        type: "POST",
        url: "php/eliminarUnidad.php",
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

function mostrarUnidad(idUnidad){
  let data = {'id': idUnidad};
  $.ajax({
    type: "POST",
    url: "php/mostrarUnidad.php",
    data: data,
    dataType: "JSON",
    success: function(unidad){
        $('#editaridUnidad').val(unidad.id);
        $('#editarUnidad').val(unidad.nombre);
    }
});
}

function editarUnidad(){
  let data = {
    'id': $('#editaridUnidad').val(),
    'unidad': $('#editarUnidad').val(),
  }
  $.ajax({
    type: "POST",
    url: "php/actualizarUnidad.php",
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
                $("#formEditarUnidad").trigger("reset");
                $("#modalEditarUnidad").modal("hide");
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

//FUNCIONES PARA LA PAGINA DE MARCA
function agregarMarca(){

  let data = {
      'nombreMarca': $('#nombreMarca').val()
  }

  $.ajax({
      type: "POST",
      url: "php/agregarMarca.php",
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
                  $("#formAgregarMarca").trigger("reset");
                  $("#modalAgregarMarca").modal("hide");
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

function eliminarMarca (idMarca) {

  let data = {'id': idMarca};
  swal({
    title: "¿Estás seguro?",
    text: "Una vez eliminado, no podrás recuperar este registro.",
    icon: "warning",
    buttons: true,
    dangerMode: true,
  }).then((willDelete) => {
    if (willDelete) {
      // Si el usuario confirma la eliminación, enviar la petición AJAX
      $.ajax({
        type: "POST",
        url: "php/eliminarMarca.php",
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

function mostrarMarca(idMarca){
  let data = {'id': idMarca};
  $.ajax({
    type: "POST",
    url: "php/mostrarMarca.php",
    data: data,
    dataType: "JSON",
    success: function(marca){
        $('#editaridMarca').val(marca.id);
        $('#editarMarca').val(marca.nombre);
    }
});
}

function editarMarca(){
  let data = {
    'id': $('#editaridMarca').val(),
    'marca': $('#editarMarca').val(),
  }
  $.ajax({
    type: "POST",
    url: "php/actualizarMarca.php",
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
                $("#formEditarMarca").trigger("reset");
                $("#modalEditarMarca").modal("hide");
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

//FUNCIONES PARA LA PAGINA DE ARTICULO
function agregarArticulo(){

  let data = {
      'nombreArticulo': $('#nombreArticulo').val(),
      'existenciaArticulo': $('#existenciaArticulo').val(),
      'fechaRegistroArticulo': $('#fechaRegistroArticulo').val(),
      'oficioArticulo': $('#oficioArticulo').val(),
      'marcaArticulo': $('#marcaArticulo').val(),
      'materialArticulo': $('#materialArticulo').val(),
      'unidadArticulo': $('#unidadArticulo').val()
  }

  $.ajax({
      type: "POST",
      url: "php/agregarArticulo.php",
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
                  $("#formAgregarArticulo").trigger("reset");
                  $("#modalAgregarArticulo").modal("hide");
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

function mostrarArticulo(idArticulo){
  alert(idArticulo);
  let data = {'id': idArticulo};
  $.ajax({
    type: "POST",
    url: "php/mostrarArticulo.php",
    data: data,
    dataType: "JSON",
    success: function(arti){
        $('#editaridArticuloE').val(arti.id);
        $('#nombreArticuloE').val(arti.nombre);
        $('#existenciaArticuloE').val(arti.existencia);
        $('#fechaRegistroArticuloE').val(arti.fechaRegistro);
        $('#oficioArticuloE').val(arti.oficioEntra);
        // Actualizar el campo de selección de marca
        $('#marcaArticuloE').html('<option value="' + arti.marca + '">' + arti.marca + '</option>');

        // Actualizar el campo de selección de material
        $('#materialArticuloE').html('<option value="' + arti.material + '">' + arti.material + '</option>');

        // Actualizar el campo de selección de unidad
        $('#unidadArticuloE').html('<option value="' + arti.unidad + '">' + arti.unidad + '</option>');
    }
});
}