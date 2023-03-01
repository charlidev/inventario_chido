// (function () {
//     'use strict'

//     // Fetch all the forms we want to apply custom Bootstrap validation styles to
//     var forms = document.querySelectorAll('.needs-validation')

//     // Loop over them and prevent submission
//     Array.prototype.slice.call(forms)
//         .forEach(function (form) {
//         form.addEventListener('submit', function (event) {
//             if (!form.checkValidity()) {
//             event.preventDefault()
//             event.stopPropagation()
//             }

//             form.classList.add('was-validated')
//         }, false)
//         })
// })()

function loginProveedor() {

    let data = {
        'usuario': $('#email').val(),
        'contraseña': $('#password').val()
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
            }
            else{
                window.location.replace("home.html");
            }
        }
    });
}
