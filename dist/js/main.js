// Load data from server
var i = 0;

// Initialize datepicker
$(function () {
    $('.datepicker').datepicker();
});

function move() {
    if (i == 0) {
        i = 1;
        var elem = document.getElementById("myBar");
        var width = 1;
        var ran = Math.floor((Math.random() * 30));
        var id = setInterval(frame, ran);

        function frame() {
            if (width >= 100) {
                clearInterval(id);
                i = 0;
            } else {
                width++;
                elem.style.width = width + "%";
            }
            if (width == 100) {
                location.reload();
            }
        }
    }
}

$(function () {

    // Display mobile modal in mobile view
    var width = $(window).width();
    if (width > 768) {
        $('#mobileModal').show();
    }

    $('.table').DataTable({
        pageLength: 50,
        lengthMenu: [50, 100, 150, 200],
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });

    // Tools
    $("#manageEmployee").click(function () {
        window.open('.././dashboard/employee.php', null, 'popup');
    })
    $("#manageDepartments").click(function () {
        window.open('.././dashboard/departments.php', null, 'popup');
    })
    $("#managePositions").click(function () {
        window.open('.././dashboard/positions.php', null, 'popup');
    })
    $("#manageServices").click(function () {
        window.open('.././dashboard/services.php', null, 'popup');
    })
    $("#manageIssues").click(function () {
        window.open('.././dashboard/issues.php', null, 'popup');
    })
    $("#manageMunicipality").click(function () {
        window.open('.././dashboard/municipality.php', null, 'popup');
    })
    $("#municipalityButton").click(function () {
        window.open('.././dashboard/municipality.php', null, 'popup');
    })
    $("#manageLGU").click(function () {
        window.open('.././dashboard/lgu.php', null, 'popup');
    })
    $("#LGUButton").click(function () {
        window.open('.././dashboard/lgu.php', null, 'popup');
    })
    $("#manageProjectType").click(function () {
        window.open('.././dashboard/project-type.php', null, 'popup');
    })
    $("#projectTypeButton").click(function () {
        window.open('.././dashboard/project-type.php', null, 'popup');
    })

    // Plugins
    $("#fixedAssetInventory").click(function () {
        window.open('.././dashboard/fixed-asset-inventory.php', null, 'popup');
    })
    $("#rfid").click(function () {
        window.open('../rfid.php', null, 'popup');
    })
    $("#cts").click(function () {
        window.open('.././dashboard/cts', null, 'popup');
    })

    // Reports
    $("#biddingReports").click(function () {
        window.open('.././dashboard/bidding-information.php', null, 'popup');
    })
    $("#biddingInformationButton").click(function () {
        window.open('.././dashboard/bidding-information.php', null, 'popup');
    })
    $("#expensesReports").click(function () {
        window.open('.././dashboard/expenses.php', null, 'popup');
    })
    $("#expensesButton").click(function () {
        window.open('.././dashboard/expenses.php', null, 'popup');
    })
    $("#POReports").click(function () {
        window.open('.././dashboard/purchase-order.php', null, 'popup');
    })
    $("#purchaseOrderButton").click(function () {
        window.open('.././dashboard/purchase-order.php', null, 'popup');
    })
    $("#deliveryReports").click(function () {
        window.open('.././dashboard/deliveries.php', null, 'popup');
    })
    $("#deliveriesButton").click(function () {
        window.open('.././dashboard/deliveries.php', null, 'popup');
    })
    $("#paymentReports").click(function () {
        window.open('.././dashboard/payments.php', null, 'popup');
    })
    $("#accountsPaymentButton").click(function () {
        window.open('.././dashboard/payments.php', null, 'popup');
    })
    $("#timestamp").click(function () {
        window.open('.././dashboard/timestamp.php', null, 'popup');
    })

    // If info button is clicked
    $("#infoButton").click(function () {
        window.open('../info.php', null, 'popup');
    })

    // If refresh button is clicked
    $("#loadDataButton").click(function () {
        $("#loadDataModal").show();
        $("#loadData").click();
    })

    // If log button is clicked
    $("#logButton").click(function () {
        window.open('../log-file.txt', null, 'popup');
    })

})

// document.addEventListener('keydown', function() {
//     if (event.keyCode == 123) {
//       alert("Developed by: ICT Department");
//       return false;
//     } else if (event.ctrlKey && event.shiftKey && event.keyCode == 73) {
//       alert("Developed by: ICT Department");
//       return false;
//     } else if (event.ctrlKey && event.keyCode == 85) { 
//       alert("Developed by: ICT Department");
//       return false;
//     }
//   }, false);

//   if (document.addEventListener) {
//     document.addEventListener('contextmenu', function(e) {
//         alert("Developed by: ICT Department");
//         e.preventDefault();
//     }, false);
//   } else {
//     document.attachEvent('oncontextmenu', function() {
//         alert("Developed by: ICT Department");
//         window.event.returnValue = false;
//     });
//   }

// Render Time
function renderTime() {
    var currentTime = new Date();
    var diem = "AM";
    var h = currentTime.getHours();
    var m = currentTime.getMinutes();
    var s = currentTime.getSeconds();
    setTimeout('renderTime()', 1000);
    if (h == 0) {
        h = 12;
    } else if (h == 12) {
        diem = "PM";
    } else if (h > 12) {
        h = h - 12;
        diem = "PM";
    }
    if (h < 10) {
        h = "0" + h;
    }
    if (m < 10) {
        m = "0" + m;
    }
    if (s < 10) {
        s = "0" + s;
    }
    var myClock = document.getElementById('clockDisplay');
    myClock.textContent = h + ":" + m + ":" + s + " " + diem;
    myClock.innerText = h + ":" + m + ":" + s + " " + diem;
}
renderTime();
