function markAll(str) 
{
    $(".chkall").prop("checked",true);
	$(".tbldatarow").addClass("warning");
	return true;
}
function unmarkAll() 
{
    $(".chkall").prop("checked",false);
	$(".tbldatarow").removeClass("warning");
	return true;
}
function check_confirm(custom_msg)
{
	var checked = []
	$("input[name='chkall[]']:checked").each(function (){
		checked.push(parseInt($(this).val()));
	});
	if(checked=="")
	{
		alert("Please select atleast one checkbox.")
		return false;
	}
	else
	{
		if(custom_msg){
			var checkconfirm=confirm(custom_msg);
			if(checkconfirm==false)
			{
				return false;
			}
		}
	}
	return true;
}

jQuery(".chkall").on("click", function() {
    $(this).closest("tr").addClass( this.checked ? "warning" : "").removeClass(this.checked ? "" : "warning");
});


