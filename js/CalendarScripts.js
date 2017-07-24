/*
 * Called on CalendarIndex to display student info along the bottom of the page.
 */
$( document ).ready(function() {
    // Hides the student info section
    $('#stuInfo').hide();
}); // End of $( document ).ready(function()
//-----
// The following function is called when a Student is clicked, and displays their info along the bottom of the page
//-----
function showStudentInfo(user){
    var frm = $("#helperForm");
    //$('#helperInput').value = user;
    $.ajax({
        type: frm.attr('method'), // Used the method specified in the <form></form> declaration
        url: frm.attr('action'), // Uses the action specified in the <form></form> declaration
        data: {student: user}, // Serializes the form inputs to be sent with the request
        success: function(data){ // On successful send/return, run this function
            if(data == "db error"){
                alert(data);
            } else if(data == "input error"){
                alert(data);
            } else{
                $('#stuInfo').show();
                var ret = data.split("!");
                // ret[img_path, fname, lname, username, phone_number]

                $('#stuImg').attr("src", ret[0]);
                $('#stuName').html(ret[2] + ", " + ret[1]);
                $('#stuUsername').html(ret[3]);
                $('#stuNumber').html(ret[4]);
            }
        }
    });
}

