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
                customize: function ( win ) {
                    $(win.document.body).find( 'table' )
                        .removeClass( 'table' );
                    $(win.document.body).find( 'table' )
                        .addClass( 'tableexportcustom' );
                    $(win.document.body).find( 'tbody' )
                        .addClass( '' );
                     $(win.document.body).find( 'tr' )
                        .addClass( 'item' )
                        .css( 'border', 'solid 0px #000' );
                     $(win.document.body).find( 'h1' )
                        .css( 'font-size', '22px' );
                  
                    $(win.document.body).find( 'tbody > tr' ).wrap( "<div class='col-xs-3'></div>" );
                    $(win.document.body).find( '.col-xs-3 > tr' ).wrap( "<div class='padding'></div>" );
                    var divs = $(win.document.body).find( 'tbody > .col-xs-3' );
                    //delete divs[ 0 ];
                    console.log(divs);
                    var x = 0;
                    for(var i = 0; i < divs.length; i+=4) {
                        divs.slice(i, i+4).wrapAll("<div class='row'></div>");
                        $( "tbody row:nth-child(4)" ).after( "<div class='page-break'></div>" );
                    }
                }
            },
            'colvis'
        ]
    } );
})