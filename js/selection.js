
$( document ).ready(function() {
    $selected = $('#typeselect');
	$('#asset_input').hide();
	$('#hardware_input').hide();
    $('#software_input').hide();
    $('#printer_input').hide();
    $('#web_input').hide();
	$('#network_input').hide();
	
	function hideAll(){
		$selected = $('#typeselect');
		$('#asset_input').hide();
		$('#hardware_input').hide();
		$('#software_input').hide();
		$('#printer_input').hide();
		$('#web_input').hide();
		$('#network_input').hide();
	}

	$selected.change(function(){
	if($(this).val() == "" || $(this).val() == "None Applicable"){
		$('#asset_input').hide();
		$('#hardware_input').hide();
		$('#software_input').hide();
		$('#printer_input').hide();
		$('#web_input').hide();
		$('#network_input').hide();
    }
    if($(this).val() == "Hardware"){
        if($('#hardware_input').is(":hidden")){
            $('#hardware_input').show();
        }
		if($('#asset_input').is(":hidden")){
            $('#asset_input').show();
        } 		
        $('#software_input').hide();
        $('#printer_input').hide();
		$('#web_input').hide();
		$('#network_input').hide();
    }
    if($(this).val() == "Software"){
        if($('#software_input').is(":hidden")){
            $('#software_input').show();            
        }
		if($('#asset_input').is(":hidden")){
            $('#asset_input').show();
        } 
        $('#hardware_input').hide();
        $('#printer_input').hide(); 
        $('#web_input').hide();
		$('#network_input').hide();
    }
    if($(this).val() == "Printer"){
        if($('#printer_input').is(":hidden")){
            $('#printer_input').show();            
        }
        $('#asset_input').hide();
		$('#hardware_input').hide();
        $('#software_input').hide();
        $('#web_input').hide();
		$('#network_input').hide();
    } 
    if($(this).val() == "Network"){
        if($('#network_input').is(":hidden")){
            $('#network_input').show();            
        }
        $('#asset_input').hide();
		$('#hardware_input').hide();
        $('#software_input').hide(); 
        $('#printer_input').hide();
    }	
    if($(this).val() == "Webpage"){
        if($('#web_input').is(":hidden")){
            $('#web_input').show();            
        }
        $('#asset_input').hide();
		$('#hardware_input').hide();
        $('#software_input').hide(); 
        $('#printer_input').hide();
		$('#network_input').hide();
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