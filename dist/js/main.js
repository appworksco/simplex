// Load data from server
var i = 0;

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
    
    $('.table').DataTable({
        pageLength: 50,
        lengthMenu: [50, 100, 150, 200],
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });


    // Tools
    // If manage employee is clicked
    $("#manageEmployee").click(function () {
        window.open('.././dashboard/employee.php', null, 'popup');
    })

    // If refresh button is clicked
    $("#loadDataButton").click(function () {
        $("#loadDataModal").show(); //F11
        $("#loadData").click(); //F11
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
