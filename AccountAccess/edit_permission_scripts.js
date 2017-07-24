$( document ).ready(function() {
    $("#newPermForm").submit(function (e) {
        // The following line sets the value of the editor to a hidden form field.
        var frm = $("#newPermForm");
        $.ajax({
            type: frm.attr('method'),
            url: frm.attr('action'),
            data: frm.serialize(),
            success: function (data) {
                if (data != 'success') {
                    swal({
                        title: "Oops!",
                        text: "An error occured: " + data,
                        type: "error",
                        html: true
                    });
                } else {
                    swal({
                            title: "Success!",
                            text: "The new permission option has been added.",
                            type: "success",
                            html: true,
                            closeOnConfirm: false
                        },
                        function () {
                            location.reload(true);
                        });
                }
            }
        });
        e.preventDefault();
    });

    $("#allPermsForm").submit(function (e) {
        // The following line sets the value of the editor to a hidden form field.
        var frm = $("#allPermsForm");
        $.ajax({
            type: frm.attr('method'),
            url: frm.attr('action'),
            data: frm.serialize(),
            success: function (data) {
                if (data != 'success') {
                    swal({
                        title: "Oops!",
                        text: "An error occured.",
                        type: "error",
                        html: true
                    });
                } else {
                    swal({
                            title: "Success!",
                            text: "Your changes have been made.",
                            type: "success",
                            html: true,
                            closeOnConfirm: false
                        },
                        function () {
                            location.href = "https://tdta.stthomas.edu/AccountAccess/ViewPermissions.php";
                        });
                }
            }
        });
        e.preventDefault();
    });
});

// Delete permission option, require user confirmation
function confirmDelete(delete_id) {
    swal({
            title: "Are you sure?",
            text: "This permission option will be unassigned from all users, and it will be permanently deleted.",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: false
        },
        function () {
            $.ajax({
                type: 'POST',
                url: 'deletePermOption.php',
                data: {toDelete: delete_id},
                success: function (data) {
                    if (data != 'success') {
                        swal({
                            title: "Oops!",
                            text: "An error occured: " + data,
                            type: "error",
                            html: true
                        });
                    } else {
                        swal({
                                title: "Success!",
                                text: "Your changes have been made.",
                                type: "success",
                                html: true,
                                closeOnConfirm: false
                            },
                            function () {
                                location.reload(true);
                            });
                    }
                }
            });
        });
}