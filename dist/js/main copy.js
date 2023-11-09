$(function () {
    $('#assetOverview').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excelHtml5',
                title: 'Fixed Asset Inventory Report',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5 ]
                }
            },
            {
                extend: 'pdfHtml5',
                title: 'Fixed Asset Inventory Report',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5 ]
                }
            },
            {
                extend: 'print',
                title: 'Fixed Asset Inventory Report',
                customize: function ( win ) {
                    $(win.document.body)
                        .css( 'font-size', '10pt' )
                    $(win.document.body).find( 'table' )
                        .addClass( 'compact' )
                        .css( 'font-size', 'inherit' )
                },
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5 ]
                },
            },
            'colvis'
        ]
    } );
})