$(function () {
    $('#assetOverview').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excelHtml5',
                title: 'Fixed Asset Inventory Report'
            },
            {
                extend: 'pdfHtml5',
                title: 'Fixed Asset Inventory Report'
            }
        ]
    } );
})