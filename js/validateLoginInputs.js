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

