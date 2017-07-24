$(document).ready(function() {
    // Prevents form from being submitted by enter key
    $(window).keydown(function(event){
        if(event.keyCode == 13) {
            event.preventDefault();
            if($( '.addtl_perm' ).is(":focus")){
                $(".add").click();
            }
            return false;
        }
    });

    //when the Add Filed button is clicked
    $("body").on("click", ".add", function () {
        // Change + button to X button
        $(this).parent("span").html('<button type="button" class="btn btn-danger delete"><span class="glyphicon glyphicon-remove"</span></button>');
        // remove "new_perm" class, which
        // should only be on the input with the green + next to it
        $('.new_perm').removeClass("new_perm");
        // prepend new input with green + button
        $("#items").prepend(
            '<div class="input-group" style="margin-bottom: 5px;">' +
            '<span class="input-group-btn">' +
            '<button type="button" class="btn btn-success add">' +
            '<span class="glyphicon glyphicon-plus"></span>' +
            '</button>' +
            '</span>' +
            '<input class="form-control addtl_perm new_perm" type="text" name="input[]">' +
            '</div>'
        );
        // focus newly created input
        $(".new_perm").focus();
    });

    $("body").on("click", ".delete", function (e) {
        $(this).parent("span").parent("div").remove();
    });


    $(".scroll").click(function (event) {
        event.preventDefault();
        $('html,body').animate({scrollTop: $(this.hash).offset().top}, 1200);
    });

}); // End on ready

// Masks phone input
jQuery(function($){
    $("#phone").mask("(999) 999-9999");
});

//
//Append a new row of code to the "#items" div
/*function addInput () {
 }*/

// Hides all of the Further Details options, and is called when the reset form button is pressed
function hideAll(){
    $selected = $('#typeselect');
    $('#placeholder').hide();
    $('#its_input').hide();
    $('#pubsafe_input').hide();
    $('#registrar_input').hide();

}

// Runs when the page is fully loaded. Hides all Further Details options
$( document ).ready(function() {
    $selected = $('#typeselect');
    hideAll(); // Begin with all options hidden
    $('#placeholder').show();

    // When the select input is changed, hide irrelevant options and show relevant ones
    $selected.change(function(){
        if($(this).val() == "" || $(this).val() == "None Applicable"){
            hideAll();
        }
        if($(this).val() == "Information and Technology Services"){
            hideAll();
            $('#its_input').show();
        }
        if($(this).val() == "Registrar"){
            hideAll();
            $('#registrar_input').show();
        }
        if($(this).val() == "Public Safety"){
            hideAll();
            $('#pubsafe_input').show();
        }
        if($(this).val() == "Network"){
            hideAll();
            $('#network_input').show();
        }
        if($(this).val() == "Webpage"){
            hideAll();
            $('#web_input').show();
        }
        if($(this).val() == "All Selected"){
            $('#asset_input').show();
            $('#hardware_input').show();
            $('#software_input').show();
            $('#printer_input').show();
            $('#web_input').show();
            $('#network_input').show();
        }
    });
});