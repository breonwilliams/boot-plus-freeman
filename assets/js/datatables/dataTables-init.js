jQuery(function ($) {
  //Only needed for the filename of export files.
  //Normally set in the title tag of your page.
  //document.title='Simple DataTable';
  // DataTable initialisation
    $.fn.dataTable.moment( 'HH:mm MMM D, YY' );
    $.fn.dataTable.moment( 'dddd, MMMM Do, YYYY' );
    $('#postsTable').DataTable(
      {
        "dom": '<"dt-buttons"Bf><"clear">lirtp',
        "paging": true,
        "autoWidth": true,
        "responsive": true,
        "buttons": [

        ],
          "order": [[ 0, 'desc' ]]
      }
  );
});