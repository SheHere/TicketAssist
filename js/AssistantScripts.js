//
// AssistantScripts.js
// Author: Nick Scheel
// This .js file is called on assistant.php, and houses the majority of the Javascript
// functions needed to display the page properly.
//

// Shows the Active Logs tab when a log is sent and reloads the page to ensure it is up to data
function showLogs() {
    $('.nav-tabs a[href="#logs"]').tab('show');
    // The timeout is needed for this function to work in Firefox.
    setTimeout(function () {
        document.getElementById("logiFrame").contentWindow.location.reload(true);
    }, 500);
}

// Hides all of the Further Details options, and is called when the reset form button is pressed
function hideAll(){
    $selected = $('#typeselect');
    $('#asset_input').hide();
    $('#hardware_input').hide();
    $('#software_input').hide();
    $('#printer_input').hide();
    $('#web_input').hide();
    $('#network_input').hide();
}

// Runs when the page is fully loaded. Hides all Further Details options
$( document ).ready(function() {

/* The below script checks if the user's browser is Internet Explorer, and if so,
 * displays a notice that tells them to use Chrome or Firefox instead.
 */
    // Hides the notice on page load
    $('#ie_notice').hide();
    var ua = window.navigator.userAgent;
    var msie = ua.indexOf("MSIE ");
    if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./))
    {
        // If browser is IE, show notice
        $('#ie_notice').show();
    }

/* The below script handles the "Further Details" section of the Ticket Assist form.
 * Initially hides all of the form options, and shows selected fields depending on
 * which option in the select is active.
 */
    //On load, find the select and set to variable
    var selected = $('#typeselect');
    hideAll(); // Begin with all options hidden

    // When the select input is changed, hide irrelevant options and show relevant ones
    selected.change(function(){
        //calls function hideAll() when "None Applicable" is active
        if($(this).val() == "" || $(this).val() == "None Applicable"){
            hideAll();
        }
        if($(this).val() == "Hardware"){
            hideAll();
            $('#hardware_input').show();
            $('#asset_input').show();
        }
        if($(this).val() == "Software"){
            hideAll();
            $('#software_input').show();
            $('#asset_input').show();

        }
        if($(this).val() == "Printer"){
            hideAll();
            $('#printer_input').show();
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