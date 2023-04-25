// Call the dataTables jQuery plugin
$(document).ready(function() {
  $('#dataTable').DataTable({
    // aquí se modifica la cantidad de registros a mostrar en la tabla
    lengthMenu: [10, 20, 30, 40, 50],
    columnDefs: [
      // aquí se define por cuales columnas NO hace la busqueda
      {searchable:false, target:[1,2]}
    ],
    dom:"Bfrtilp",
    buttons: [{
      extend: 'excelHtml5',
      text: "<i class='fas fa-file-csv'></i>",
      titleAttr: 'Exportar archivo Excel',
      className: 'btn btn-success'
      },
      {
        extend: 'pdfHtml5',
        text: "<i class='fas fa-file-pdf'></i>",
        titleAttr: 'Exportar archivo PDF',
        className: 'btn btn-danger'
      }
    ]
  });
});