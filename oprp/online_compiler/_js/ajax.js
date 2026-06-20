function myscript()
{
	var event_id = $("#allevents :selected").val();
		$.ajax({ 
		   type: "POST",
		   url: "ajax/showdescription.php?event_id="+event_id,
		   success: function(msg){
			  $("#description").html(msg);
		   }
		});
}	