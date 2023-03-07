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
                window.location.replace("dashboard.html");
            }
        }
    });
}
