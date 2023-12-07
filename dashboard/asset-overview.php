<?php
    include realpath(__DIR__ . '/../autoload.php');
    include realpath(__DIR__ . '/../models/departments-facade.php');
    include realpath(__DIR__ . '/../models/assets-facade.php');

    $departmentsFacade = new DepartmentsFacade;
    $assetsFacade = new AssetsFacade;

    // This will output the barcode as HTML output to display in the browser
    $generator = new Picqer\Barcode\BarcodeGeneratorHTML();
?>

<!DOCTYPE html>
<html>
<head>
    <title>One Centro - Asset Overview</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/s/bs/jszip-2.5.0,pdfmake-0.1.18,dt-1.10.10,b-1.1.0,b-flash-1.1.0,b-html5-1.1.0,b-print-1.1.0,fh-3.1.0,sc-1.4.0/datatables.min.css">
    <link rel="stylesheet" href=".././dist/css/main.css">
    <link rel="stylesheet" href=".././dist/css/styles.min.css">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/s/bs/jszip-2.5.0,pdfmake-0.1.18,dt-1.10.10,b-1.1.0,b-flash-1.1.0,b-html5-1.1.0,b-print-1.1.0,fh-3.1.0,sc-1.4.0/datatables.min.js"></script>

    <style id="compiled-css" type="text/css">
        .data-table-container {
            padding: 10px;
        }
        .dt-buttons .btn {
            margin-right: 3px;
        }

        @media all {
            .tableexportcustom td, .tableexportcustom th {
                text-align: left;
                display: block;
                float: left; 
                padding: 0 !important;
                margin: 0 !important;
                width: 100%;

                /* Change here to manipulate inside box */
            }
            .tableexportcustom td:first-child {
                font-size: 5px;
                font-weight: bold;
            }
            .tableexportcustom tr {
                margin: 5px;
            }
            .row { 
                page-break-inside:avoid; 
                page-break-after:auto; 
            }
            .page-break {
                page-break-after: always;
            }
            .tableexportcustom .row {
                margin: 8px 0;
            }
            .tableexportcustom .padding {
                padding: 10px;
                outline: 1px solid;
                margin: 5px 2px;
            }
            .tableexportcustom thead {
                display: none;
            }

            @page {}
            .row:nth-child(3) {
                page-break-after: always;
            }
            .row:nth-child(4n + 3) {
                page-break-after: always;
            }
        }

        @media print {
            @page {
            size: auto;
            margin-bottom: 5mm;
            }
        }
    </style>
</head>
<body>
<div class="data-table-container" style="overflow: hidden">
    <table class="table table-hover data-table">
        <thead>
            <tr>
                <th class="border-bottom-0">
                    <h6 class="fw-semibold mb-0">Employee</h6>
                </th>
                <th class="border-bottom-0">
                    <h6 class="fw-semibold mb-0">Department</h6>
                </th>
                <th class="border-bottom-0">
                    <h6 class="fw-semibold mb-0">Name of Item / Asset</h6>
                </th>
                <th class="border-bottom-0">
                    <h6 class="fw-semibold mb-0">Description</h6>
                </th>
                <th class="border-bottom-0">
                    <h6 class="fw-semibold mb-0">Quantity</h6>
                </th>
                <th class="border-bottom-0">
                    <h6 class="fw-semibold mb-0">Condition</h6>
                </th>
                <th class="border-bottom-0">
                    <h6 class="fw-semibold mb-0">Remarks</h6>
                </th>
                <th class="border-bottom-0">
                    <h6 class="fw-semibold mb-0">Barcode</h6>
                </th>
                <th class="border-bottom-0">
                    <h6 class="fw-semibold mb-0">Action</h6>
                </th>
            </tr>
        </thead>
        <tbody>
        <?php
        $fetchAssets = $assetsFacade->fetchAssets();
        while ($row = $fetchAssets->fetch(PDO::FETCH_ASSOC)) { ?>
            <tr>
                <td class="border-bottom-0">
                    <p class="mb-0 fw-normal"><?= $row["employee"]?></p>                         
                </td>
                <td class="border-bottom-0">
                    <?php
                    $departmentCode = $row["department"];
                    $fetchDepartmentByCode = $departmentsFacade->fetchDepartmentByCode($departmentCode);
                    while ($dept = $fetchDepartmentByCode->fetch(PDO::FETCH_ASSOC)) { ?>
                        <p class="mb-0 fw-normal"><?= $dept["department_name"]?></p>  
                    <?php } ?>
                </td>
                <td class="border-bottom-0">
                    <p class="mb-0 fw-normal"><?= $row["asset_name"]?></p>                         
                </td>
                <td class="border-bottom-0">
                    <p class="mb-0 fw-normal"><?= $row["description"]?></p>                         
                </td>
                <td class="border-bottom-0">
                    <p class="mb-0 fw-normal"><?= $row["quantity"]?></p>                         
                </td>
                <td class="border-bottom-0">
                    <p class="mb-0 fw-normal"><?= $row["con"]?></p>                         
                </td>
                <td class="border-bottom-0">
                    <p class="mb-0 fw-normal"><?= $row["remarks"]?></p>                         
                </td>
                <td class="border-bottom-0">    
                    <p class="mb-0 fw-normal"><?= $row["barcode"]?></p>                          
                </td>
                <td class="border-bottom-0">
                    <!-- <a href="" class="btn btn-info">Update</a> -->
                    <a href="delete-asset?asset_num=<?= $row["id"] ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this asset?');">Delete</a>
                </td>
            </tr> 
        <?php } ?>
        </tbody>
    </table>
</div>

<script type="text/javascript">
    $('table.data-table').DataTable({
        paging: true,
        columnDefs: [{
            targets: 'no-sort',
            orderable: false
        }],
        dom: '<"row"<"col-sm-6"B><"col-sm-6"f>>' +
            '<"row"<"col-sm-12"<"table-responsive"tr>>>' +
            '<"row"<"col-sm-5"i><"col-sm-7"p>>',
        fixedHeader: {
            header: true
        },
        buttons: {
            buttons: [{
                extend: 'print',
                text: '<i class="fa fa-print"></i> Print',
                exportOptions: {
                    columns: [ 0, 1, 2, 7],
                },
                customize: function ( win ) {
                    $(win.document.body).find( 'table' )
                        .removeClass( 'table' ).css( 'font-size', '5pt' );
                    $(win.document.body).find( 'table' )
                        .addClass( 'tableexportcustom' );
                    $(win.document.body).find( 'tr' )
                        .addClass( 'm-0' )
                        .css( 'border', 'solid 0px #000' );
                    $(win.document.body).find( 'h1' )
                        .css( 'font-size', '15px' );
                    $(win.document.body).find( 'tbody > tr > td:last-child' )
                        .addClass( 'barcode')
                        .addClass( 'd-flex')
                        .css( 'font-size', '16px' );
                    $(win.document.body).find( 'tbody > tr' )
                        .wrap( "<div class='col-xs-2 p-0'></div>" );
                    $(win.document.body).find( '.col-xs-2 > tr' )
                        .wrap( "<div class='padding m-0'></div>" );
                }
            }, {
                extend: 'excel',
                text: '<i class="fa fa-file-excel-o"></i> Excel',
            }],
            dom: {
                container: {
                    className: 'dt-buttons'
                },
                button: {
                    className: 'btn btn-default'
                }
            }
        }
    });
</script>

</body>
</html>
