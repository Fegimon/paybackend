/*** Previous next option in customer section ***/
$('.next').click(function(){
  $('.nav-tabs > .active').next('li').find('a').trigger('click');
});
$('.prev').click(function(){
  $('.nav-tabs > .active').prev('li').find('a').trigger('click');
});



//Existing User (Enquiry)
	 function enquirycform(){
		// console.log("jfhd");
			//alert('a');
	  cus_id =  $("#cus_id").val();
	  cus_name =  $("#cus_name").val();
	  datepicker =  $("#datepicker").val();
	  e_attend =  $("#e_attend").val();
	  e_assign =  $("#e_assign").val();
	  datepicker1 =  $("#datepicker1").val();
	  remark1 =  $("#remark1").val();

	if (cus_id=="")
	{
		$('#cusiderror').html('<span>Please enter customer id</span>');
	}
	else
	{
		$('#cusiderror').html('');
	}
	if (cus_name=="")
	{
		$('#cusnameerror').html('<span>Please enter customer name</span>');
	}
	else
	{
		$('#cusnameerror').html('');
	}
	if (datepicker=="")
	{
		$('#doeerror').html('<span>Please enter date of enquiry</span>');
	}
	else
	{
		$('#doeerror').html('');
	}

	if (datepicker1=="")
	{
		$('#doeferror').html('<span>Please enter follow up on</span>');
	}
	else
	{
		$('#doeferror').html('');
	}if (remark1=="")
	{
		$('#rmarkerror').html('<span>Please enter remark</span>');
	}
	else
	{
		$('#rmarkerror').html('');
	}

	if(cus_id=="" || cus_name=="" || datepicker=="" || datepicker1=="" || remark1=="")
	{
	//alert('aaa');
		event.preventDefault();

	}





	}


//New User (Enquiry)
	function newenqform(){
	  cus_name1 =  $("#cus_name1").val();
	  cus_phone1 =  $("#cus_phone1").val();
	  cus_email1 =  $("#cus_email1").val();
	  com_name1 =  $("#com_name1").val();
	  newdatepicker =  $("#newdatepicker").val();
	  newdatepicker1 =  $("#newdatepicker1").val();
	  newremark1 =  $("#newremark1").val();
  	if (cus_name1=="")
  	{
  		$('#cusname1error').html('<span>Please enter customer name</span>');
  	}
  	else
  	{
  		$('#cusname1error').html('');
  	}
  	if (cus_phone1=="")
  	{
  		$('#newphoneerror').html('<span>Please enter customer phone</span>');
  	}
  	else
  	{
  		$('#newphoneerror').html('');
  	}
  	if (cus_email1=="")
  	{
  		$('#newemailerror').html('<span>Please enter customer email</span>');
  	}
  	else
  	{
  		$('#newemailerror').html('');
  	}

  	if (com_name1=="")
  	{
  		$('#comnameerror').html('<span>Please enter company name</span>');
  	}
  	else
  	{
  		$('#comnameerror').html('');
  	}
  	if (newdatepicker=="")
  	{
  		$('#newdoeerror').html('<span>Please enter date of enquiry</span>');
  	}
  	else
  	{
  		$('#newdoeerror').html('');
  	}
  	if (newdatepicker1=="")
  	{
  		$('#newdoe1error').html('<span>Please enter follow up on</span>');
  	}
  	else
  	{
  		$('#newdoe1error').html('');
  	}
  	if (newremark1=="")
  	{
  		$('#newremarkerror').html('<span>Please enter remark</span>');
  	}
  	else
  	{
  		$('#newremarkerror').html('');
  	}

  	if(cus_name1=="" || cus_phone1=="" || cus_email1=="" || com_name1=="" || newdatepicker==""  || newdatepicker1=="" || newremark1=="")
  	{
  		event.preventDefault();
  	}
  } 		



	// Service Request Validation




	var ckbox = $('#iswaiver');

    $('input').on('click',function () {
        if (ckbox.is(':checked')) {
            $(".iswaiver").show();
        } else {
           $(".iswaiver").hide();
        }
    });


	var ckbox1 = $('#ispaid');

    $('input').on('click',function () {
        if (ckbox1.is(':checked')) {
            $(".ispaidamount").show();
        } else {
           $(".ispaidamount").hide();
        }
    });
