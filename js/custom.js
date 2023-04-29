(function ($) {
    "use strict"; // Start of use strict
    $('#sidebarCollapse').on('click', function () {
        $('#sidebar').toggleClass('active');
    });
    /*Loader Javascript
    -------------------*/
    var window_var = $(window);
    window_var.on('load', function () {
        $(".loading").fadeOut("fast");
        $("#snackbar").addClass("show");
    });

    // fullscreen function
    $(".fullscreen").on('click', function () {
        if (document.webkitCurrentFullScreenElement == null) {
            document.documentElement.webkitRequestFullScreen();
        } else {
            document.webkitCancelFullScreen();
        }
    });
    // fullscreen function End

})(jQuery);

$(".btnupd").on('click', function () {
    $.ajax({
        method: "POST",
        url: "get-staff.php",
        dataType: "json",
        data: { "data": this.id },
        success: function (data) {
            $("#updmodal").modal('show');
            $("#ustaff_name").val(data.name);
            $("#uphone").val(data.phone);
            $("#uemail").val(data.email);
            $("#id").val(data.id);
            if (data.role == 'doctor') {
                $("#ustaff_typeD").prop('checked', true);
            }
            else if (data.role == 'receptionist') {
                $("#ustaff_typeR").prop('checked', true);
            }

        },
        error: function () {
            window.alert("Failed");
        }
    });
});

$(".btnnew").on('click', function () {
    $("#newPatient").show();
});
$(".btnnext").on('click', function () {
    $("#newPatient").hide();
    $("#newPatient2").show();
});
$(".btnexist").on('click', function () {
    $("#exiPatient").show();
});
$("#prev_desc_modal").on('click', function () {
    $("#previous-appointment-modal").hide();
    $("#prev_appoint_date").empty();
    $("#patient_name").empty();
    $("#doctor_name").empty();
    $("#prev_appoint_id").empty();
    $("#bloodpressure").empty();
    $("#pheight").empty();
    $("#pweight").empty();
    $("#complaint").empty();
    $("#findings").empty();
    $("#advice").empty(); 
});

function close1() {
    $("#newPatient").hide();
    $("#newPatient2").hide();
    $("#exiPatient").hide();
    $("#previous-appointment-modal").hide();
    $("#previous-appointment-modal").hide();
    $("#prev_appoint_date").empty();
    $("#patient_name").empty();
    $("#doctor_name").empty();
    $("#prev_appoint_id").empty();
    $("#bloodpressure").empty();
    $("#pheight").empty();
    $("#pweight").empty();
    $("#complaint").empty();
    $("#findings").empty();
    $("#advice").empty(); 
}

// custom.js

$(document).ready(function() {
    // Fetch appointment data using AJAX when the page loads
    $.ajax({
        url: 'fetch-appointments.php',
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            // Iterate over each appointment and add a row to the table
            $.each(data, function(index, appointment) {
                var row = '<tr>' +
                    '<td>' + appointment.tid + '</td>' +
                    '<td>' + appointment.name + '</td>' +
                    '<td>' + appointment.complaint + '</td>' +
                    '<td> Pending</td>' +
                    '<td>' +
                        '<button class=" btn-primary btn-view p-1 border border-dark rounded" data-id="' + appointment.id + '"><a href="in-patient.php?id=' + appointment.id + '">Call In</a></button>' +
                        '<button class="ml-1 btn-danger btn-edit p-1 border border-dark rounded" data-id="' + appointment.id + '"><a href="delete-patient.php?id=' + appointment.id + '">Delete</a></button>' +
                        // '<button class="btn-delete" data-id="' + appointment.ID + '">Delete</button>' +
                    '</td>' +
                '</tr>';
                $('#appointment-table-body').append(row);
            });
        },
        error: function(xhr, status, error) {
            // Handle any errors that occur during the AJAX call
            console.error(error);
        }
    });

    // $('#appointments-table').on('click', '.btn-view', function() {
    //     var appointmentId = $(this).data('id');
    //     console.log(appointmentId);
    //     $.ajax({
    //         url : "fetch-patient-data.php?id="+appointmentId,
    //         method : "GET",
    //         success : function(data) {

    //         }
    //     })
    //     // Implement logic to display appointment edit form in a modal
    // });

    $('#appointments-table').on('click', '.btn-delete', function() {
        var appointmentId = $(this).data('id');
        // Implement logic to delete the appointment and remove it from the table
    });
});

function show_prev_visit(ap_id) {
    let id = ap_id;
    // console.log(id);
    $("#previous-appointment-modal").show();
    $.ajax({
        url : "fetch-prev-appointments.php",
        method : "POST",
        data: {
            id : id
        },
        success : function (data) {
            data = JSON.parse(data);
            console.log(data);
            $("#prev_appoint_date").append(data["date"]);
            $("#patient_name").append(data["patient_name"]);
            $("#doctor_name").append(data["doctor_name"]);
            $("#prev_appoint_id").append(data["ap_id"]);
            $("#bloodpressure").append(data["parameter"]["bp"]);
            $("#pheight").append(data["parameter"]["height"]);
            $("#pweight").append(data["parameter"]["weight"]);
            $("#complaint").append(data["complaint"]);
            $("#findings").append(data["findings"]);
            $("#advice").append(data["advice"]); 
        }
    })
}

const form = document.querySelector('#prescription-form');
const printBtn = document.querySelector('#print-btn');

form.addEventListener('input', () => {
  // Check if any input field has been filled out
  const inputs = form.querySelectorAll('input');
  const isFilled = Array.from(inputs).some(input => input.value.trim() !== '');

  // Enable the print button if any input field has been filled out
  printBtn.disabled = !isFilled;
});

printBtn.addEventListener('click', () => {
    let ap_id = $("#ap_id").val();
    window.print();
    window.onafterprint = function () {
        window.location.href = "add-prescription.php?id="+ap_id;
    }
});

