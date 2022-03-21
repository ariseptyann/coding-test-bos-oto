"use strict";
var dataSourceServerSide = function() {
  var initTable1 = function(elem, data) {
    let {url, column, columnDefs} = data;
    let table = $(elem);

    table.DataTable({
      responsive  : true,
      searchDelay : 500,
      processing  : true,
      serverSide  : true,
      ajax        : url,
      columns     : column ? column : [],
      columnDefs  : columnDefs ? columnDefs : []
    });
  };
  return {
    init: function(elem, data) {
      initTable1(elem, data);
      // $('.custom-select.form-control').select2({
      //   minimumResultsForSearch: Infinity
      // })
    },
  };
}();

$('body').on('click', '.delete-from-table', function(e){
  e.preventDefault();
  swal.fire({
    title             : 'Hapus data tersebut?',
    text              : "Data tidak bisa dikembalikan jika sudah terhapus",
    type              : 'warning',
    showCancelButton  : true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor : '#d33',
    confirmButtonText : 'Yes, Hapus!'
  }).then((result) => {
    if (result.value) {
      $(this).parent().submit();
    }
  })
});

// $(document).ready(function() {
//   dataSourceServerSide.init(url, column, columnDefs);
// });