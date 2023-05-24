// Obtener el elemento de entrada de fecha
var fechaRegistroInput = document.getElementById('fechaRegistroArticulo');
var fechaRegistroInput = document.getElementById('fechaRegistroArticuloE');

// Obtener la fecha actual
var fechaActual = new Date();

// Convertir la fecha actual en formato legible
var dia = fechaActual.getDate();
var mes = fechaActual.getMonth() + 1;
var anio = fechaActual.getFullYear();
var fechaActualFormateada = dia + '/' + mes + '/' + anio;

// Establecer la fecha actual en el valor del campo de entrada de fecha
fechaRegistroInput.value = fechaActualFormateada;

// Agregar un selector de fecha utilizando la librería datepicker (requiere jQuery)
$(document).ready(function() {
$('#fechaRegistroArticulo').datepicker();
$('#fechaRegistroArticuloE').datepicker();
});