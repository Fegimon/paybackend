	//Advance Receipt

	$(function() {
		$("#datepicker9").datepicker({ dateFormat: "mm-dd-yyyy" });
	});

	//Get customer name
	$("#cutomerreceipt").blur(function(){
		var customerid = $(this).val();
		$.ajax({
			url:'config/productadd.php',
			data:{
					type : "advancerendreceipt",
					value : customerid
				},
			type:"post",
			success:function(data)
			{
				var checked_data = jQuery.parseJSON(data);
				var	customername = checked_data[0].customer_name;
				$("#receiptname").val(customername);
				$("#receiptname").attr("disabled", "disabled");
			}
		});

		$.ajax({
			url:'config/productadd.php',
			data:{
					type : "advancetotalamout",
					customerid : customerid
				},
			type:"post",
			success:function(data)
			{
				var checked_data = jQuery.parseJSON(data);
				var	total_amount = checked_data[0].total_amount;
				$("#amount").val(total_amount);
				$("#amount").attr("disabled", "disabled");
			}
		});
    });

	// Advance Receipt Preparation
	 function advancereceipt(){
		 event.preventDefault();
		var customerid,customername,advamount,vouchernum,dateofpurch,type,remarks,recvamount,d_id;
		customerid =  $("#cutomerreceipt").val();
		customername =  $("#receiptname").val();
		advamount =  $("#amount").val();
		recvamount =  $("#recvamount").val();
		vouchernum =  $("#voucherno").val();
		dateofpurch =  $("#datepicker9").val();
		type =  $("#paytypeadvance").val();
		d_id =  $("#d_id").val();
	    //alert(d_id);

	 if (customerid==""){
			$('#arerror').html('<span>Please enter customer id</span>');
		}
		else
		{
			$('#arerror').html('');
		}
		if(customername=="")
		{
			$('#anameerror').html('<span>Please enter your name</span>');
		}
		else{
			$('#anameerror').html('');
		}
		if (advamount==""){
			$('#tamounterror').html('<span>Please enter total amount</span>');
		}
		else
		{
			$('#tamounterror').html('');
		}
		if(recvamount=="")
		{
			$('#receivederror').html('<span>Please enter received amount</span>');
		}
		else{
			$('#receivederror').html('');
		}

		if (vouchernum==""){
			$('#vouchererror').html('<span>Please enter voucher number</span>');
		}
		else
		{
			$('#vouchererror').html('');
		}
		if(dateofpurch=="")
		{
			$('#purchaseerror').html('<span>Please enter date of purchase</span>');
		}
		else{
			$('#purchaseerror').html('');
		}
		if(remarks=="")
		{
			$('#aremarkerror').html('<span>Please enter your remark</span>');
		}
		else{
			$('#aremarkerror').html('');
		}

		if(customerid=="" || customername=="" || advamount=="" || recvamount=="" || vouchernum=="" || dateofpurch=="" || remarks=="")
		{
			return false;
		}


		$.ajax({
			url:'TCPDF-master/examples/advancereceipt.php',
			data:{
				"customerid" : customerid,
				"customername" : customername,
				"advamount" : advamount,
				"recvamount" : recvamount,
				"vouchernum" : vouchernum,
				"dateofpurch" : dateofpurch,
				"type" : type,
				"remarks" : remarks,
                "d_id" : d_id
			},
			type:"post",
			success:function(data){
                     location.reload();
				$("#downloadview").attr("href", data);
				$("#downloadview").trigger("click");
				//console.log(data);
				// alert("Advanced Rent receipt Added Successfully");
				$("#arradd").html("Advance rent receipt details has been added").css("color");
				$("#arrmodal").modal();

				$('#arentreceiptform')[0].reset();
				}
		  });
	}
	$('#downloadview').click(function(){
        var thu = $('#downloadview').attr('href');
        window.open(thu, '_blank');
    });

	// Rent Receipt
 function rentreceipt(){

		var customerid,customername,advamount,type,rentcolon,recvamount,rentcollectedby,rentdepositedby,follow_status,rent_remark,rent_rpt;
		customerid =  $("#cutomerreceipt").val();
		customername =  $("#receiptname").val();
		advamount =  $("#balance").val();
		recvamount =  $("#receivedamt").val();
		rentcollectedby =  $("#rentcollectedby").val();
		rentdepositedby =  $("#rentdepositedby").val();
		type =  $("#paymenttype").val();
		rentcolon =  $("#rentcolon").val();
        rendepcolon =  $("#rendepcolon").val();
		follow_status =  $("#follow_status").val();
		rent_remark =  $("#rent_remark").val();
          //rent_rpt =  $("#rent_rpt").val();
        if($("#rent_rpt").prop('checked')==true)
		{
			var rec = 1;
		}
		else
		{
			var rec = 0;
		}

		if (customerid==""){
			$('#crerror').html('<span>Please enter customer id</span>');
		}
		else
		{
			$('#crerror').html('');
		}
		if(customername=="")
		{
			$('#rnameerror').html('<span>Please enter your name</span>');
		}
		else{
			$('#rnameerror').html('');
		}
		if (advamount==""){
			$('#ramounterror').html('<span>Please enter total amount</span>');
		}
		else
		{
			$('#ramounterror').html('');
		}
		if(recvamount=="")
		{
			$('#receivederror').html('<span>Please enter received amount</span>');
		}
		else{
			$('#receivederror').html('');
		}

		if (rentcolon==""){
			$('#collectedonerror').html('<span>Please enter collected date</span>');
		}
		else
		{
			$('#collectedonerror').html('');
		}


		if(customerid=="" || customername=="" || advamount=="" || recvamount=="" || rentcolon=="" )
		{
			return false;
		}



		$.ajax({
			url:'TCPDF-master/examples/rentreceipt.php',
			data:{
				"customerid" : customerid,
				"customername" : customername,
				"advamount" : advamount,
				"recvamount" : recvamount,
				"rentcollectedby" : rentcollectedby,
				"rentdepositedby" : rentdepositedby,
				"type" : type,
				"rentcolon" : rentcolon,
				"follow_status" : follow_status,
				"rent_remark" : rent_remark,
				"rent_rpt" : rent_rpt,
				"rec":rec,
				"rendepcolon":rendepcolon,
				"reciv":reciv
			},
			type:"post",
			success:function(data){
				//console.log(data);
				// alert("Rent receipt Added Successfully");
				$("#rentadd").html("Rent receipt details has been added").css("color");
			location.reload();
				 $("#rentmodal").modal();
				// $('#rentreceiptform')[0].reset();
			}
		  });
	}
	//General Expense
	function generalexpense(){
		event.preventDefault();
		var expensedate1,expenseid1,expenseproduct1,expensereason1,expenseamount1,expenseperson1,expensepay1,expense_remark1;
		expensedate1 =  $("#expensedate").val();
		expenseid1 =  $("#expenseid").val();
		expenseproduct1 =  $("#expenseproduct").val();
		expensereason1 =  $("#expensereason").val();
		expenseamount1 =  $("#expenseamount").val();
		expenseperson1 =  $("#expenseperson").val();
		expensepay1 =  $("#expensepay").val();
		expense_remark1 =  $("#expense_remark").val();

		if (expensedate1==""){
			$('#dexpenseerror').html('<span>Please enter date of expenses</span>');
		}
		else
		{
			$('#dexpenseerror').html('');
		}
		if(expenseid1=="")
		{
			$('#giderror').html('<span>Please enter customer id</span>');
		}
		else{
			$('#giderror').html('');
		}
		if (expenseproduct1==""){
			$('#gpiderror').html('<span>Please enter product id</span>');
		}
		else
		{
			$('#gpiderror').html('');
		}
		if(expensereason1=="")
		{
			$('#reasonerror').html('<span>Please enter valid reason</span>');
		}
		else{
			$('#reasonerror').html('');
		}

		if (expenseamount1==""){
			$('#amounterror').html('<span>Please enter amount</span>');
		}
		else
		{
			$('#amounterror').html('');
		}
		if(expenseperson1=="")
		{
			$('#personerror').html('<span>Please enter person name</span>');
		}
		else{
			$('#personerror').html('');
		}
		if(expensepay1=="")
		{
			$('#payerror').html('<span>Please enter pay maount</span>');
		}
		else{
			$('#payerror').html('');
		}
		if(expense_remark1=="")
		{
			$('#gremarkerror').html('<span>Please enter your remark</span>');
		}
		else{
			$('#gremarkerror').html('');
		}

		if(expensedate1=="" || expenseid1=="" || expenseproduct1=="" || expensereason1=="" || expenseamount1=="" || expenseperson1=="" || expensepay1=="" || expense_remark1=="")
		{
			return false;
		}


		$.ajax({
			url:'config/productadd.php',
			data:{
				"type" : "generalexpense",
				"expensedate" : expensedate1,
				"expenseid" : expenseid1,
				"expenseproduct" : expenseproduct1,
				"expensereason" : expensereason1,
				"expenseamount" : expenseamount1,
				"expenseperson" : expenseperson1,
				"expensepay" : expensepay1,
				"expense_remark" : expense_remark1
			},
			type:"post",
			success:function(data){
				//console.log(data);
				// alert("General Expense Added Successfully");
				$("#geadd").html("General expenses details has been added").css("color");
				$("#gemodal").modal();
				$('#generalexpenseform')[0].reset();
			}
		  });
	}

	//service Expense
	function serviceexpense(){
		event.preventDefault();
		var service_product,warranty_service,issuetype,service_amount,service_remark,servicestartfrom,serviceendto;
		var serivceexpwaiver = $("#serivceexpwaiver").is(":checked");
		if (serivceexpwaiver) {
            serivceexpwaiver = 1;
        } else {
            serivceexpwaiver = 0;
        }
		service_product =  $("#service_product").val();
		warranty_service =  $("#warranty_service").val();
		issuetype =  $("#issuetype").val();
		service_amount =  $("#service_amount").val();
		service_remark =  $("#service_remark").val();
		servicestartfrom =  $("#servicestartfrom").val();
		serviceendto =  $("#serviceendto").val();


		if (service_product==""){
			$('#proiderror').html('<span>Please enter date of expenses</span>');
		}
		else
		{
			$('#proiderror').html('');
		}
		if(warranty_service=="")
		{
			$('#warrantyerror').html('<span>Please enter customer id</span>');
		}
		else{
			$('#warrantyerror').html('');
		}
		if (issuetype==""){
			$('#issueerror').html('<span>Please enter product id</span>');
		}
		else
		{
			$('#issueerror').html('');
		}
		if(service_amount=="")
		{
			$('#amounterror').html('<span>Please enter valid reason</span>');
		}
		else{
			$('#amounterror').html('');
		}

		if (service_remark==""){
			$('#servicereamrkerror').html('<span>Please enter amount</span>');
		}
		else
		{
			$('#servicereamrkerror').html('');
		}
		if(servicestartfrom=="")
		{
			$('#frdateerror').html('<span>Please enter person name</span>');
		}
		else{
			$('#frdateerror').html('');
		}
		if(serviceendto=="")
		{
			$('#todateerror').html('<span>Please enter pay maount</span>');
		}
		else{
			$('#todateerror').html('');
		}

		if(service_product=="" || warranty_service=="" || issuetype=="" || service_amount=="" || service_remark=="" || servicestartfrom=="" || serviceendto=="")
		{
			return false;
		}




		$.ajax({
			url:'config/productadd.php',
			data:{
				"type" : "serviceexpance",
				"service_product" : service_product,
				"warranty_service" : warranty_service,
				"issuetype" : issuetype,
				"service_amount" : service_amount,
				"service_remark" : service_remark,
				"servicestartfrom" : servicestartfrom,
				"serviceendto" : serviceendto,
				"serivceexpwaiver" : serivceexpwaiver
			},
			type:"post",
			success:function(data){
			//	console.log(data);
				// alert("Service Expense Added Successfully");
				$("#sedd").html("Service expenses details has been added").css("color");
				$("#semodal").modal();
				$('#serviceexpenseform')[0].reset();
			}
		  });
	}

	function handler(e){
  		var d = e.target.value;
  		var mothes   = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun','Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
	    var d_y = d.split('-')[0];
	    var d_m = d.split('-')[1];
	    var d_d = d.split('-')[2];
	    var d_y = d_y.toString().substr(d_y.length -2);
	    var mon = mothes[parseInt(d_m,10)-1];
	    var dd = parseInt(d_d,10);
	    var odate =  dd + "-" + mon + "-" + d_y;

	    $.ajax({
			url:'config/productadd.php',
			data:{
				"type" : "trapdateprodct",
				"odate" : d
			},
			type:"post",
			success:function(data){
				var obj =JSON.parse(data);
				//console.log(obj);
				var i;
				for(i=0;i<obj.length;i++)
				{
					addtransportlist1(obj[i].customer_id,obj[i].product_id);
				}
			}
		  });
	}

	var ctr = 0;
	function addtransportlist1(productid,customerid) {
	    event.preventDefault();
	    ctr++;
	    var productid= productid;
	    var customerid= customerid;
	    var product = "transport_product" + ctr;
	    var customer = "transport_id" + ctr;
	    var newTr = '<tr><td><input type="text" value="'+productid+'" style="text-transform:uppercase;" class="form-control" onblur="transport_product(this,'+ ctr +')" id=' + product + ' name="transport_product[]" placeholder="Product ID" readonly/></td><td><input name="transportcustome_id[]" value="'+customerid+'" class="form-control" type="text" id=' + customer + ' placeholder="Customer ID " readonly/></td><td> <a class="trnsport_remove" href="" > <i class="fa fa-trash-o" title="Remove Product" aria-hidden="true"></i></a></td></tr>';
	    $('#transportlistadd').append(newTr);
	};






	//Vendor information add
	 function vendoradd(){
	 	event.preventDefault();
		var vendor =  $("#vendor").val();
		var vendordescription =  $("#vendordescription").val();

		if (vendor==""){
			$('#vendorerror').html('<span>Please enter vendor name</span>');
			return true;
		}
		else
		{
			$('#vendorerror').html('');
		}
		if(vendordescription=="")
		{
			$('#vendordescerror').html('<span>Please enter vendor description</span>');
			return true;
		}
		else{
			$('#vendordescerror').html('');
		}


		var statusvendor = $("#statusvendor").is(":checked");
		if (statusvendor) {
               statusvendor = 1;
            } else {
                statusvendor = 0;
            }
		//console.log(statusvendor);
		$.ajax({
			url:'config/systemparamaters.php',
			data:{
				"type" : "vendoradd",
				"vendor" : vendor,
				"vendordescription" : vendordescription,
				"statusvendor" : statusvendor
			},
			type:"post",
			success:function(data){
				vendorlist();
				// alert("Vendor Details has been added");
				$("#vendelete").html("");
				$("#venupdate").html("");
				$("#venadd").html("Vendor details has been added").css("color");
				$("#venmodal").modal();
				 $('#vendorform')[0].reset();
			}
		  });
	 }

	 // Delete Vendor
	 function deletevendor(data)
	 {
	 	var r = confirm("Are You Sure to delete the Vendor details!");
        if (r == true) {
       		$.ajax({
			url:'config/systemparamaters.php',
			data:{
				"type" : "deletevendorlist",
				"vendorid" : data
			},
			type:"post",
			success:function(data){
				vendorlist();
		// alert("Vendor Details has been Deleted");
				$("#venadd").html("");
				$("#venupdate").html("");
				$("#vendelete").html("Vendor details has been deleted").css("color");
				$("#venmodal").modal();
			}
		  });
        } else {
    		txt = "You pressed Cancel!";
		}
	 }

	 // Got data for edit Vendor
	 function editvendor(data)
	 {
	 	$(".addvendor").hide();
	 	$(".editvendor").show();
       		$.ajax({
			url:'config/systemparamaters.php',
			data:{
				"type" : "gotvendordetail",
				"vendorid" : data
			},
			type:"post",
			success:function(data){
				data = JSON.parse(data);
					$("#vendorid").val(data[0].vendor_id);
					$("#vendorname").val(data[0].name);
					var vendorstatus = data[0].status;
					$("#editvendordescription").val(data[0].description);
					if( vendorstatus == 1)
						$('#editstatusvendor').prop('checked', true);
					else
						$('#editstatusvendor').prop('checked', false);
				}
		  	});
	 }

	 //Vendor information edit
	 function editvendordata(){
	 	event.preventDefault();
		var vendorid =  $("#vendorid").val();
		var vendorname =  $("#vendorname").val();
		var editvendordescription =  $("#editvendordescription").val();

		if (vendorname==""){
			$('#evendorerror').html('<span>Please enter vendor name</span>');
			return true;
		}
		else
		{
			$('#evendorerror').html('');
		}
		if(editvendordescription=="")
		{
			$('#evendordescerror').html('<span>Please enter vendor description</span>');
			return true;
		}
		else{
			$('#evendordescerror').html('');
		}

		var editstatusvendor = $("#editstatusvendor").is(":checked");
		if (editstatusvendor) {
               editstatusvendor = 1;
            } else {
                editstatusvendor = 0;
            }
		$.ajax({
			url:'config/systemparamaters.php',
			data:{
				"type" : "editvendordetail",
				"vendorid" : vendorid,
				"vendorname" : vendorname,
				"editvendordescription" : editvendordescription,
				"editstatusvendor" : editstatusvendor
			},
			type:"post",
			success:function(data){
				vendorlist();$(".addvendor").show();
	 			$(".editvendor").hide();
				// alert("Vendor Details has been Updated");
				$("#vendelete").html("");
				$("#venadd").html("");
				$("#venupdate").html("Vendor details has been updated").css("color");
				$("#venmodal").modal();
			}
		  });
	 }

	function notedit()
	{
		event.preventDefault();
		$(".addvendor").show();
	 	$(".editvendor").hide();
	 	return false;
	}


	//nativity information add
	 function nativityadd(){
	 	event.preventDefault();
		var nativity =  $("#nativity").val();
		var nativitydescription =  $("#nativitydescription").val();

		if (nativity==""){
			$('#nativityerror').html('<span>Please enter nativity name</span>');
			return true;
		}
		else
		{
			$('#nativityerror').html('');
		}
		if(nativitydescription=="")
		{
			$('#nativitydescerror').html('<span>Please enter nativity description</span>');
			return true;
		}
		else{
			$('#nativitydescerror').html('');
		}

		var statusnativity = $("#statusnativity").is(":checked");
		if (statusnativity) {
               statusnativity = 1;
            } else {
                statusnativity = 0;
            }
		$.ajax({
			url:'config/systemparamaters.php',
			data:{
				"type" : "nativityadd",
				"nativity" : nativity,
				"nativitydescription" : nativitydescription,
				"statusnativity" : statusnativity
			},
			type:"post",
			success:function(data){
					// alert("Nativity Details has been added");
				$("#nativitydelete").html("");
				$("#nativityupdate").html("");
				$("#nativityadd").html("Nativity details has been updated").css("color");
				$("#nativitymodal").modal();
				nativitylist();$('#nativityform')[0].reset();
			}
		  });
	 }

	  // Delete Nativity
	 function deletenativity(data)
	 {
	 	var r = confirm("Are You Sure to delete the Nativity details!");
        if (r == true) {
       		$.ajax({
			url:'config/systemparamaters.php',
			data:{
				"type" : "deletenativitylist",
				"nativityid" : data
			},
			type:"post",
			success:function(data){
				nativitylist();
				// alert("Nativity Details has been Deleted");
				$("#nativityadd").html("");
				$("#nativityupdate").html("");
				$("#nativitydelete").html("Nativity details has been deleted").css("color");
				$("#nativitymodal").modal();
			}
		  });
        } else {
    		txt = "You pressed Cancel!";
		}
	 }

	  // Got data for edit nativity
	 function editnativity(data)
	 {
	 	$(".addnativity").hide();
	 	$(".editnativity").show();
       		$.ajax({
			url:'config/systemparamaters.php',
			data:{
				"type" : "gotnativitydetail",
				"nativityid" : data
			},
			type:"post",
			success:function(data){
				data = JSON.parse(data);
					$("#nativityid").val(data[0].id);
					$("#nativityname").val(data[0].name);
					var vendorstatus = data[0].status;
					$("#editnativitydescription").val(data[0].description);
					if( vendorstatus == 1)
						$('#editstatusnativity').prop('checked', true);
					else
						$('#editstatusnativity').prop('checked', false);
				}
		  	});
	 }

	 function noteditnativity()
	{
		event.preventDefault();
		$(".addnativity").show();
	 	$(".editnativity").hide();
	}

	//Nativity information edit
	 function editnativitydata(){
	 	event.preventDefault();
		var nativityid =  $("#nativityid").val();
		var nativityname =  $("#nativityname").val();
		var editnativitydescription =  $("#editnativitydescription").val();

		if (nativityname==""){
			$('#enativityerror').html('<span>Please enter nativity name</span>');
			return true;
		}
		else
		{
			$('#enativityerror').html('');
		}
		if(editnativitydescription=="")
		{
			$('#enativitydescerror').html('<span>Please enter nativity description</span>');
			return true;
		}
		else{
			$('#enativitydescerror').html('');
		}

		var editstatusnativity = $("#editstatusnativity").is(":checked");
		//console.log(nativityid);
		if (editstatusnativity) {
               editstatusnativity = 1;
            } else {
                editstatusnativity = 0;
            }
		$.ajax({
			url:'config/systemparamaters.php',
			data:{
				"type" : "editnativitydetail",
				"nativityid" : nativityid,
				"nativityname" : nativityname,
				"editnativitydescription" : editnativitydescription,
				"editstatusnativity" : editstatusnativity
			},
			type:"post",
			success:function(data){
				$(".addnativity").show();
	 			$(".editnativity").hide();nativitylist();
	 			// alert("Nativity Details has been Updated");
				$("#nativityadd").html("");
				$("#nativitydelete").html("");
				$("#nativityupdate").html("Nativity details has been updated").css("color");
				$("#nativitymodal").modal();
			}
		  });
	 }


	 function zonestates(){
		$.ajax({
			url:'config/systemparamaters.php',
			data:{
				"type" : "statelist"
			},
			type:"post",
			success:function(data){
				var sel = $("#zonestate");
				data = JSON.parse(data);
				    sel.empty();
				    for (var i=0; i<data.length; i++) {
				      sel.append('<option value="' + data[i].id + '">' + data[i].name + '</option>');
				    }
				    getzonecity();
			}
		});
	 }

	 function getzonecity(){
	 	var zonestate =  $("#zonestate").val();
		$.ajax({
			url:'config/systemparamaters.php',
			data:{
				"type" : "citylist",
				"stateid" : zonestate
			},
			type:"post",
			success:function(data){
				var sel = $("#zonecity");
				data = JSON.parse(data);
				    sel.empty();
				    for (var i=0; i<data.length; i++) {
				      sel.append('<option value="' + data[i].id + '">' + data[i].name + '</option>');
				    }
			}
		});
	 }

	 //Zone information add
	 function addzone(){
	 	event.preventDefault();
		var zonecity =  $("#zonecity").val();
		var zoneid =  $("#zoneid").val();
		var zonedescription =  $("#zonedescription").val();


		if (zoneid==""){
			$('#zoneerror').html('<span>Please enter zone id</span>');
			return true;
		}
		else
		{
			$('#zoneerror').html('');
		}
		if(zonedescription=="")
		{
			$('#zonedescerror').html('<span>Please enter zone description</span>');
			return true;
		}
		else{
			$('#zonedescerror').html('');
		}

		var statuszone = $("#statuszone").is(":checked");
		if (statuszone) {
               statuszone = 1;
            } else {
                statuszone = 0;
            }
		$.ajax({
			url:'config/systemparamaters.php',
			data:{
				"type" : "zoneadd",
				"zonecity" : zonecity,
				"zoneid" : zoneid,
				"zonedescription" : zonedescription,
				"statuszone" : statuszone
			},
			type:"post",
			success:function(data){
				zonelist();$('#zoneform')[0].reset();
				// alert("Zone Details has been added");
				$("#zdelete").html("");
				$("#zupdate").html("");
				$("#zadd").html("Zone details has been added").css("color");
				$("#zonemodal").modal();
			}

		  });
	 }

	 // Delete zone
	 function deletezone(data)
	 {
	 	var r =confirm("Are You Sure to delete the zone details!");
        if (r == true) {
       		$.ajax({
			url:'config/systemparamaters.php',
			data:{
				"type" : "deletezonelist",
				"zoneid" : data
			},
			type:"post",
			success:function(data){
				zonelist();
				// alert("Zone Details has been Deleted");
				$("#zadd").html("");
				$("#zupdate").html("");
				$("#zdelete").html(" Zone details has been deleted").css("color");
				$("#zonemodal").modal();
			}

		  });
        } else {
    		txt = "You pressed Cancel!";
		}
	 }


	  // Got data for edit zone
	 function editzone(data)
	 {
	 	$(".addzone").hide();
	 	$(".editzone").show();
       		$.ajax({
			url:'config/systemparamaters.php',
			data:{
				"type" : "gotzonedetail",
				"zoneid" : data
			},
			type:"post",
			success:function(data){
				data = JSON.parse(data);
					$("#zoneeditcity").val(data[0].city_id);
					$("#editzoneid").val(data[0].id);
					$("#zoneeditid").val(data[0].name);
					var vendorstatus = data[0].status;
					$("#editzonedescription").val(data[0].description);
					if( vendorstatus == 1)
						$('#editstatuszone').prop('checked', true);
					else
						$('#editstatuszone').prop('checked', false);
				}
		  	});
	 }


	 //Zone information edit
	 function editzonedata(){
	 	event.preventDefault();
		var zoneeditcity =  $("#zoneeditcity").val();
		var zoneeditid =  $("#zoneeditid").val();
		var editzoneid =  $("#editzoneid").val();
		var editzonedescription =  $("#editzonedescription").val();

		if (zoneeditid==""){
			$('#ezoneerror').html('<span>Please enter zone id</span>');
			return true;
		}
		else
		{
			$('#ezoneerror').html('');
		}
		if(editzonedescription=="")
		{
			$('#ezonedescerror').html('<span>Please enter zone description</span>');
			return true;
		}
		else{
			$('#ezonedescerror').html('');
		}

		var editstatuszone = $("#editstatuszone").is(":checked");
		if (editstatuszone) {
               editstatuszone = 1;
            } else {
                editstatuszone = 0;
            }
		$.ajax({
			url:'config/systemparamaters.php',
			data:{
				"type" : "editzonedetail",
				"zoneeditcity" : zoneeditcity,
				"zoneeditid" : zoneeditid,
				"editzoneid" : editzoneid,
				"editzonedescription" : editzonedescription,
				"editstatuszone" : editstatuszone
			},
			type:"post",
			success:function(data){
				zonelist();
				$(".addzone").show();
	 			$(".editzone").hide();
				// alert("Zone Details has been Updated");
				$("#zadd").html("");
				$("#zdelete").html("");
				$("#zupdate").append("Zone details has been updated").css("color");
				$("#zonemodal").modal();
			}
		  });
	 }

function noteditzone()
{
	event.preventDefault();
	$(".addzone").show();
	$(".editzone").hide();
}


//States information add
	 function addstates(){
	 	event.preventDefault();
		var stateid =  $("#stateid").val();
		var statedescription =  $("#statedescription").val();

		if (stateid==""){
			$('#stateerror').html('<span>Please enter state name</span>');
			return true;
		}
		else
		{
			$('#stateerror').html('');
		}
		if(statedescription=="")
		{
			$('#statedescerror').html('<span>Please enter state description</span>');
			return true;
		}
		else{
			$('#statedescerror').html('');
		}


		var statusstate = $("#statusstate").is(":checked");
		if (statusstate) {
               statusstate = 1;
            } else {
                statusstate = 0;
            }
		$.ajax({
			url:'config/systemparamaters.php',
			data:{
				"type" : "addstates",
				"stateid" : stateid,
				"statedescription" : statedescription,
				"statusstate" : statusstate
			},
			type:"post",
			success:function(data){
				// alert("State Details has been added");
				$("#statedelete").html("");
				$("#stateupdate").html("");
				$("#stateadd").html("State details has been added").css("color");
				$("#statemodal").modal();
				statelist();$('#statesform')[0].reset();
			}
		  });
	 }

	// Delete State
	 function deletestate(data)
	 {
	 	var r = confirm("Are You Sure to delete the state details!");
        if (r == true) {
       		$.ajax({
			url:'config/systemparamaters.php',
			data:{
				"type" : "deletestate",
				"id" : data
			},
			type:"post",
			success:function(data){
				statelist();
				// alert("State Details has been Deleted");
				$("#stateadd").html("");
				$("#stateupdate").html("");
				$("#statedelete").html("State details has been deleted").css("color");
				$("#statemodal").modal();
			}
		  });
        } else {
    		txt = "You pressed Cancel!";
		}
	 }


 // Got data for edit state
	 function editstate(data)
	 {
	 	$(".addstate").hide();
	 	$(".editstate").show();
       		$.ajax({
			url:'config/systemparamaters.php',
			data:{
				"type" : "editstate",
				"id" : data
			},
			type:"post",
			success:function(data){
				data = JSON.parse(data);
					$("#editstateid").val(data[0].id);
					$("#editstatename").val(data[0].name);
					var vendorstatus = data[0].status;
					$("#editstatedescription").val(data[0].description);
					if( vendorstatus == 1)
						$('#editstatusstate').prop('checked', true);
					else
						$('#editstatusstate').prop('checked', false);
				}
		  	});
	 }

//state information edit
	 function editstates(){
	 	event.preventDefault();
		var editstatename =  $("#editstatename").val();
		var editstateid =  $("#editstateid").val();
		var editstatedescription =  $("#editstatedescription").val();

		if (editstatename==""){
			$('#estateerror').html('<span>Please enter state name</span>');
			return true;
		}
		else
		{
			$('#estateerror').html('');
		}
		if(editstatedescription=="")
		{
			$('#estatedescerror').html('<span>Please enter state description</span>');
			return true;
		}
		else{
			$('#estatedescerror').html('');
		}



		var editstatusstate = $("#editstatusstate").is(":checked");
		if (editstatusstate) {
               editstatusstate = 1;
            } else {
                editstatusstate = 0;
            }
		$.ajax({
			url:'config/systemparamaters.php',
			data:{
				"type" : "editstatedetails",
				"editstateid" : editstateid,
				"editstatename" : editstatename,
				"editstatedescription" : editstatedescription,
				"editstatusstate" : editstatusstate
			},
			type:"post",
			success:function(data){
				statelist();
				$(".addstate").show();
	 			$(".editstate").hide();
				// alert("State Details has been Updated");
				$("#stateadd").html("");
				$("#statedelete").html("");
				$("#stateupdate").html("State details has been updated").css("color");
				$("#statemodal").modal();
			}
		  });
	 }

	 function noteditstates() {
	 	event.preventDefault();
	 	$(".addstate").show();
	 	$(".editstate").hide();
	 }




	 //Product information add
	 function addproduct(){
	 	event.preventDefault();
		var pcategory =  $("#pcategory").val();
		var productdescription =  $("#productdescription").val();


		if (pcategory==""){
			$('#pcategoryerror').html('<span>Please enter product category</span>');
			return true;
		}
		else
		{
			$('#pcategoryerror').html('');
		}
		if(productdescription=="")
		{
			$('#pcategorydescerror').html('<span>Please enter product category description</span>');
			return true;
		}
		else{
			$('#pcategorydescerror').html('');
		}

		var statusproduct = $("#statusproduct").is(":checked");
		if (statusproduct) {
               statusproduct = 1;
            } else {
                statusproduct = 0;
            }
		$.ajax({
			url:'config/systemparamaters.php',
			data:{
				"type" : "productadd",
				"pcategory" : pcategory,
				"productdescription" : productdescription,
				"statusproduct" : statusproduct
			},
			type:"post",
			success:function(data){
				gotproductcatlist();$('#productform')[0].reset();
				// alert("Product Details has been added");
				$("#proddelete").html("");
				$("#produpdate").html("");
				$("#prodadd").html("Product details has been added").css("color");
				$("#prodmodal").modal();
			}
		  });
	 }

	 // Delete Product
	 function deleteproduct(data)
	 {
	 	var r = confirm("Are You Sure to delete the product details!");
        if (r == true) {
       		$.ajax({
			url:'config/systemparamaters.php',
			data:{
				"type" : "deleteproductlist",
				"productid" : data
			},
			type:"post",
			success:function(data){
				gotproductcatlist();
				// alert("Product Details has been Deleted");
				$("#prodadd").html("");
				$("#produpdate").html("");
				$("#proddelete").html("Product details has been deleted").css("color");
				$("#prodmodal").modal();
			}
		  });
        } else {
    		txt = "You pressed Cancel!";
		}
	 }

	 // Got data for edit product
	 function editproduct(data)
	 {
	 	$(".addproduct").hide();
	 	$(".editproduct").show();
       		$.ajax({
			url:'config/systemparamaters.php',
			data:{
				"type" : "gotproductdetail",
				"productid" : data
			},
			type:"post",
			success:function(data){
				data = JSON.parse(data);
					$("#editpid").val(data[0].ptdcatgry_id);
					$("#editpcategory").val(data[0].name);
					var vendorstatus = data[0].status;
					$("#editproductdescription").val(data[0].description);
					if( vendorstatus == 1)
						$('#editstatusproduct').prop('checked', true);
					else
						$('#editstatusproduct').prop('checked', false);
				}
		  	});
	 }


//product category information edit
	 function editproductdetails(){
	 	event.preventDefault();
		var editpcategory =  $("#editpcategory").val();
		var editpid =  $("#editpid").val();
		var editproductdescription =  $("#editproductdescription").val();

		if (editpcategory==""){
			$('#epcategoryerror').html('<span>Please enter product category</span>');
			return true;
		}
		else
		{
			$('#epcategoryerror').html('');
		}
		if(editproductdescription=="")
		{
			$('#epcategorydescerror').html('<span>Please enter product category description</span>');
			return true;
		}
		else{
			$('#epcategorydescerror').html('');
		}


		var editstatusproduct = $("#editstatusproduct").is(":checked");
		if (editstatusproduct) {
               editstatusproduct = 1;
            } else {
                editstatusproduct = 0;
            }
		$.ajax({
			url:'config/systemparamaters.php',
			data:{
				"type" : "editproddetail",
				"editpid" : editpid,
				"editpcategory" : editpcategory,
				"editproductdescription" : editproductdescription,
				"editstatusproduct" : editstatusproduct
			},
			type:"post",
			success:function(data){
				gotproductcatlist();
				$(".addproduct").show();
	 			$(".editproduct").hide();
				// alert("Product Details has been Updated");
				$("#prodadd").html("");
				$("#proddelete").html("");
				$("#produpdate").html("Product details has been updated").css("color");
				$("#prodmodal").modal();
			}
		  });
	 }

	 function noteditproductdetails()
	 {
	 	event.preventDefault();
	 	$(".addproduct").show();
	 	$(".editproduct").hide();
	 }

	 //subcategory information add
	 function addsubcatproduct()
	 {
	 	event.preventDefault();
		var maincategorylist =  $("#maincategorylist").val();
         alert(maincategorylist);
		var subcategoryname =  $("#subcategoryname").val();
		var subcatdescription =  $("#subcatdescription").val();
		var cgst = $("#cgst").val();
		var sgst = $("#sgst").val();
		var igst = $("#igst").val();
		var ugst = $("#ugst").val();
		var cess = $("#cess").val();

		if (subcategoryname==""){
			$('#subcatgryerror').html('<span>Please enter product category</span>');
			return true;
		}
		else
		{
			$('#subcatgryerror').html('');
		}
		if(subcatdescription=="")
		{
			$('#subcatgrydescerror').html('<span>Please enter product category description</span>');
			return true;
		}
		else{
			$('#subcatgrydescerror').html('');
		}


		var subcatstatus = $("#subcatstatus").is(":checked");
		if (subcatstatus) {
               subcatstatus = 1;
            } else {
                subcatstatus = 0;
            }
		$.ajax({
			url:'config/systemparamaters.php',
			data:{
				"type" : "subcatgdd",
				"maincategorylist" : maincategorylist,
				"subcategoryname" : subcategoryname,
				"subcatdescription" : subcatdescription,
				"subcatstatus" : subcatstatus,
				"cgst" : cgst,
				"sgst" : sgst,
				"igst" : igst,
				"ugst" : ugst,
				"cess" : cess
			},
			type:"post",
			success:function(data){
				// alert("category Details has been added");
				$("#subpupdate").html("");
				$("#subpdelete").html("");
				$("#subpadd").html("Subcategory details has been added").css("color");
				$("#subpmodal").modal();
				gotproductsubcatlist();
				$('#addsubcategoryform')[0].reset();
			}
		  });
	 }

	 // Delete subcategory
	 function deletesubproductcat(data)
	 {
	 	var r = confirm("Are You Sure to delete the category details!");
        if (r == true) {
       		$.ajax({
			url:'config/systemparamaters.php',
			data:{
				"type" : "deletesubcatproductlist",
				"subproductid" : data
			},
			type:"post",
			success:function(data){
				gotproductsubcatlist();
				// alert("category Details has been Deleted");
				$("#subpupdate").html("");
				$("#subpadd").html("");
				$("#subpdelete").html("Subcategory details has been deleted").css("color");
				$("#subpmodal").modal();
			}
		  });
        } else {
    		txt = "You pressed Cancel!";
		}
	 }

	 // Got data for edit subcategory
	 function editsubcatproduct(data)
	 {
	 	$(".addsubproduct").hide();
	 	$(".editsubproduct").show();
       		$.ajax({
			url:'config/systemparamaters.php',
			data:{
				"type" : "gotsubproductdetail",
				"subproductid" : data
			},
			type:"post",
			success:function(data){
				data = JSON.parse(data);
					$("#editsubcategorylist").val(data[0].pr_sub_id);
					$("#editsubcategoryname").val(data[0].pr_sub_name);
                    $("#ecgst").val(data[0].CGST);
		            $("#esgst").val(data[0].SGST);
		            $("#eigst").val(data[0].IGST);
		            $("#eugst").val(data[0].UGST);
		            $("#ecess").val(data[0].CESS);
					var vendorstatus = data[0].status;
					$("#editsubcatdescription").val(data[0].description);
					if( vendorstatus == 1)
						$('#editsubcatstatus').prop('checked', true);
					else
						$('#editsubcatstatus').prop('checked', false);
				}
		  	});
	 }

//subcategory information edit
	 function editsubproductdetails(){
	 	event.preventDefault();
		var editsubcategoryname =  $("#editsubcategoryname").val();
		var editsubcategorylist =  $("#editsubcategorylist").val();
		var editsubcatdescription =  $("#editsubcatdescription").val();
		var cgst = $("#ecgst").val();
		var sgst = $("#esgst").val();
		var igst = $("#eigst").val();
		var ugst = $("#eugst").val();
		var cess = $("#ecess").val();

		if (editsubcategoryname==""){
			$('#esubcatgryerror').html('<span>Please enter product category</span>');
			return true;
		}
		else
		{
			$('#esubcatgryerror').html('');
		}
		if(editsubcatdescription=="")
		{
			$('#esubcatgrydescerror').html('<span>Please enter product category description</span>');
			return true;
		}
		else{
			$('#esubcatgrydescerror').html('');
		}


		var editsubcatstatus = $("#editsubcatstatus").is(":checked");
		if (editsubcatstatus) {
               editsubcatstatus = 1;
            } else {
                editsubcatstatus = 0;
            }
		$.ajax({
			url:'config/systemparamaters.php',
			data:{
				"type" : "editsubcatproddetail",
				"editcatid" : editsubcategorylist,
				"editsubcategoryname" : editsubcategoryname,
				"editsubcatdescription" : editsubcatdescription,
				"editsubcatstatus" : editsubcatstatus,
                "cgst" : cgst,
				"sgst" : sgst,
				"igst" : igst,
				"ugst" : ugst,
				"cess" : cess
			},
			type:"post",
			success:function(data){
				gotproductsubcatlist();
				$(".addsubproduct").show();
	 			$(".editsubproduct").hide();
 				// alert("Category Details has been Updated");
				$("#subpdelete").html("");
				$("#subpadd").html("");
				$("#subpupdate").html("Subcategory details has been updated").css("color");
				$("#subpmodal").modal();
			}
		  });
	 }

	function noteditsubcat()
	{
		event.preventDefault();
		$(".addsubproduct").show();
		$(".editsubproduct").hide();
	}

	//city information add
	 function addcities(){
	 	event.preventDefault();
		var statename =  $("#zonestate").val();
		var cityname =  $("#cityname").val();
		var citydescription =  $("#citydescription").val();

		if (cityname==""){
			$('#cityerror').html('<span>Please enter city name</span>');
			return true;
		}
		else
		{
			$('#cityerror').html('');
		}
		if(citydescription=="")
		{
			$('#citydescerror').html('<span>Please enter city description</span>');
			return true;
		}
		else{
			$('#citydescerror').html('');
		}


		var statuscity = $("#statuscity").is(":checked");
		if (statuscity) {
               statuscity = 1;
            } else {
                statuscity = 0;
            }
		$.ajax({
			url:'config/systemparamaters.php',
			data:{
				"type" : "addcities",
				"statename" : statename,
				"cityname" : cityname,
				"citydescription" : citydescription,
				"statuscity" : statuscity
			},
			type:"post",
			success:function(data){
				 cityid();$('#addcityform')[0].reset();
				 // alert("City Details has been added");
				$("#citydelete").html("");
				$("#cityupdate").html("");
				$("#cityadd").html("City details has been added").css("color");
				$("#citymodal").modal();
			}
		  });
	 }

//State
	 function statelists()
	 {
		$('#statelist tbody').remove();
		var statusdetails = "";
		event.preventDefault();
		$.ajax({ url: "config/systemparamaters.php",
			data:{
				"type" : "statelist"
			},
			type:"post",
			success: function(data)
				{
				  var sel = $("#zonestate");
					data = JSON.parse(data);
					sel.empty();
				    for (var i=0; i<data.length; i++) {
				      sel.append('<option value="' + data[i].id + '">' + data[i].name + '</option>');
				    }
				}
			});
	}

	// Delete City
	 function deletecity(data)
	 {
	 	var r = confirm("Are You Sure to delete the city details!");
        if (r == true) {
       		$.ajax({
			url:'config/systemparamaters.php',
			data:{
				"type" : "deletecities",
				"id" : data
			},
			type:"post",
			success:function(data){
				cityid();
				// alert("City Details has been Deleted");
				$("#cityadd").html("");
				$("#cityupdate").html("");
				$("#citydelete").html("City details has been deleted").css("color");
				$("#citymodal").modal();
			}
		  });
        } else {
    		txt = "You pressed Cancel!";
		}
	 }

	 // Got data for edit city
	 function editcity(data)
	 {
	 	$(".addcity").hide();
	 	$(".editcity").show();
       		$.ajax({
			url:'config/systemparamaters.php',
			data:{
				"type" : "editcity",
				"id" : data
			},
			type:"post",
			success:function(data){
				data = JSON.parse(data);
					$("#editcityid").val(data[0].id);
					$("#editcityname").val(data[0].name);
					var vendorstatus = data[0].status;
					$("#editcitydescription").val(data[0].description);
					if( vendorstatus == 1)
						$('#editcitystate').prop('checked', true);
					else
						$('#editcitystate').prop('checked', false);
				}
		  	});
	 }

//editcities information edit
	 function editcities(){
	 	event.preventDefault();
		var editcityname =  $("#editcityname").val();
		var editcityid =  $("#editcityid").val();
		var editcitydescription =  $("#editcitydescription").val();

		if (editcityname==""){
			$('#ecityerror').html('<span>Please enter city name</span>');
			return true;
		}
		else
		{
			$('#ecityerror').html('');
		}
		if(editcitydescription=="")
		{
			$('#ecitydescerror').html('<span>Please enter city description</span>');
			return true;
		}
		else{
			$('#ecitydescerror').html('');
		}


		var editcitystate = $("#editcitystate").is(":checked");
		if (editcitystate) {
               editcitystate = 1;
            } else {
                editcitystate = 0;
            }
		$.ajax({
			url:'config/systemparamaters.php',
			data:{
				"type" : "editcitydetails",
				"editcityid" : editcityid,
				"editcityname" : editcityname,
				"editcitydescription" : editcitydescription,
				"editcitystate" : editcitystate
			},
			type:"post",
			success:function(data){
				cityid();
				$(".addcity").show();
	 			$(".editcity").hide();
				// alert("City Details has been Updated");
				$("#cityadd").html("");
				$("#citydelete").html("");
				$("#cityupdate").html("City details has been updated").css("color");
				$("#citymodal").modal();
			}
		  });
	 }

	 function noteditcities()
	 {
	 	event.preventDefault();
	 	$(".addcity").show();
	 	$(".editcity").hide();
	 }


	 //Brand information add
	 function addbrand(){
	 	event.preventDefault();
		var brand =  $("#brand").val();
		var addbranddescr =  $("#addbranddescr").val();

		if (brand==""){
			$('#branderror').html('<span>Please enter state name</span>');
			return true;
		}
		else
		{
			$('#branderror').html('');
		}
		if(addbranddescr=="")
		{
			$('#branddescerror').html('<span>Please enter state description</span>');
			return true;
		}
		else{
			$('#branddescerror').html('');
		}

		var addbrandstatus = $("#addbrandstatus").is(":checked");
		if (addbrandstatus) {
               addbrandstatus = 1;
            } else {
                addbrandstatus = 0;
            }
		$.ajax({
			url:'config/systemparamaters.php',
			data:{
				"type" : "brandadd",
				"brand" : brand,
				"addbranddescr" : addbranddescr,
				"addbrandstatus" : addbrandstatus
			},
			type:"post",
			success:function(data){
				// alert("Brand Details has been added");
				$("#brandupdate").html("");
				$("#branddelete").html("");
				$("#brandadd").html("Brand details has been added").css("color");
				$("#brandmodal").modal();
				 gotbrandlist();$('#branchform')[0].reset();
			}
		  });
	 }


	 // Delete brand
	 function deletebrand(data)
	 {
	 	var r = confirm("Are You Sure to delete the brand details!");
        if (r == true) {
       		$.ajax({
			url:'config/systemparamaters.php',
			data:{
				"type" : "deletebrandlist",
				"brandid" : data
			},
			type:"post",
			success:function(data){
				 gotbrandlist();
				 // alert("Brand Details has been Deleted");
				$("#brandupdate").html("");
				$("#brandadd").html("");
				$("#branddelete").html("Brand details has been deleted").css("color");
				$("#brandmodal").modal();
			}
		  });
        } else {
    		txt = "You pressed Cancel!";
		}
	 }

	  // Got data for brand
	 function editbrand(data)
	 {
	 	$(".addbrand").hide();
	 	$(".editbrand").show();
       		$.ajax({
			url:'config/systemparamaters.php',
			data:{
				"type" : "editbrand",
				"brandid" : data
			},
			type:"post",
			success:function(data){
				data = JSON.parse(data);
					$("#editidbrand").val(data[0].brand_id);
					$("#editbrand").val(data[0].name);
					var vendorstatus = data[0].status;
					$("#editaddbranddescr").val(data[0].description);
					if( vendorstatus == 1)
						$('#editaddbrandstatus').prop('checked', true);
					else
						$('#editaddbrandstatus').prop('checked', false);
				}
		  	});
	 }


//brand information edit
	 function editbranddetails(){
	 	event.preventDefault();
		var editbrand =  $("#editbrand").val();
		var editidbrand =  $("#editidbrand").val();
		var editaddbranddescr =  $("#editaddbranddescr").val();

		if (editbrand==""){
			$('#ebranderror').html('<span>Please enter state name</span>');
			return true;
		}
		else
		{
			$('#ebranderror').html('');
		}
		if(editaddbranddescr=="")
		{
			$('#ebranddescerror').html('<span>Please enter state description</span>');
			return true;
		}
		else{
			$('#ebranddescerror').html('');
		}


		var editaddbrandstatus = $("#editaddbrandstatus").is(":checked");
		if (editaddbrandstatus) {
               editaddbrandstatus = 1;
            } else {
                editaddbrandstatus = 0;
            }
		$.ajax({
			url:'config/systemparamaters.php',
			data:{
				"type" : "editbranddetails",
				"editidbrand" : editidbrand,
				"editbrand" : editbrand,
				"editaddbranddescr" : editaddbranddescr,
				"editaddbrandstatus" : editaddbrandstatus
			},
			type:"post",
			success:function(data){
				gotbrandlist();
				$(".addbrand").show();
	 			$(".editbrand").hide();
				// alert("Brand Details has been Updated");
				$("#branddelete").html("");
				$("#brandadd").html("");
				$("#brandupdate").html("Brand details has been updated").css("color");
				$("#brandmodal").modal();
			}
		  });
	 }

	function notbrandedit() {
		event.preventDefault();
		$(".addbrand").show();
		$(".editbrand").hide();
	}


	 //employee information add
	 function addemployee(){
	 	event.preventDefault();
		var empyname =  $("#empyname").val();
		var empymbl =  $("#empymbl").val();
		var empemail =  $("#empemail").val();
		var empdesignation =  $("#empdesignation").val();

		var emp_mail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
		var emp_mobile = /^\d{10}$/;

		if (empyname==""){
			$('#empynameerror').html('<span>Please enter employee name</span>');
			return true;
		}
		else
		{
			$('#empynameerror').html('');
		}
		if(empymbl=="")
		{
			$('#empymblerror').html('<span>Please enter your mobile number</span>');
			return false;
		}
		else if(!emp_mobile.test(empymbl))
		{
			$('#empymblerror').html('<span>Please enter 10 digit mobile number</span>');
			return true;
		}
		else{
			$('#empymblerror').html('');
		}

		if (empemail==""){
			$('#empemailerror').html('<span>Please enter your email</span>');
			return false;
		}
		else if(!emp_mail.test(empemail))
		{
			$('#empemailerror').html('<span>Please enter correct email id</span>');
			return true;
		}
		else
		{
			$('#empemailerror').html('');
		}
		if(empdesignation=="")
		{
			$('#empdescerror').html('<span>Please enter designation</span>');
			return true;
		}
		else{
			$('#empdescerror').html('');
		}


		$.ajax({
			url:'config/systemparamaters.php',
			data:{
				"type" : "addemployee",
				"empyname" : empyname,
				"empymbl" : empymbl,
				"empemail" : empemail,
				"empdesignation" : empdesignation
			},
			type:"post",
			success:function(data){
				 employeetable();$('#employeeform')[0].reset();
				 // alert("Employee Details has been added");
				$("#empdelete").html("");
				$("#empupdate").html("");
				$("#empadd").html("Employee details has been added").css("color");
				$("#empmodal").modal();
			}
		  });
	 }


// Delete employee
	 function deleteemployee(data)
	 {
	 	var r = confirm("Are You Sure to delete the employee details!");
        if (r == true) {
       		$.ajax({
			url:'config/systemparamaters.php',
			data:{
				"type" : "deleteemployee",
				"id" : data
			},
			type:"post",
			success:function(data){
				 employeetable();
				 // alert("Employee Details has been Deleted");
				$("#empadd").html("");
				$("#empupdate").html("");
				$("#empdelete").html("Employee details has been deleted").css("color");
				$("#empmodal").modal();
			}
		  });
        } else {
    		txt = "You pressed Cancel!";
		}
	 }


// Got data for edit employe
	 function editemployee(data)
	 {
	 	$(".addemployee").hide();
	 	$(".editemployee").show();
       		$.ajax({
			url:'config/systemparamaters.php',
			data:{
				"type" : "editemployee",
				"id" : data
			},
			type:"post",
			success:function(data){
				data = JSON.parse(data);
					$("#editempyid").val(data[0].id);
					$("#editempyname").val(data[0].name);
					$("#editempymbl").val(data[0].mobile);
					$("#editempemail").val(data[0].email);
					$("#editempdesignation").val(data[0].designation);
				}
		  	});
	 }

	//Employee information edit
	 function editemployeedetails(){
	 	event.preventDefault();
		var editempyid =  $("#editempyid").val();
		var editempyname =  $("#editempyname").val();
		var editempymbl =  $("#editempymbl").val();
		var editempemail =  $("#editempemail").val();
		var editempdesignation =  $("#editempdesignation").val();

var editempdesignation =  $("#editempdesignation").val();


		var emp_mail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
		var emp_mobile = /^\d{10}$/;

		if (editempyname==""){
			$('#editempynameerror').html('<span>Please enter employee name</span>');
			return true;
		}
		else
		{
			$('#editempynameerror').html('');
		}
		if(editempymbl=="")
		{
			$('#editempymblerror').html('<span>Please enter your mobile number</span>');
			return false;
		}
		else if(!emp_mobile.test(editempymbl))
		{
			$('#editempymblerror').html('<span>Please enter 10 digit mobile number</span>');
			return true;
		}
		else{
			$('#editempymblerror').html('');
		}

		if (editempemail==""){
			$('#editempemailerror').html('<span>Please enter your email</span>');
			return false;
		}
		else if(!emp_mail.test(editempemail))
		{
			$('#editempemailerror').html('<span>Please enter correct email id</span>');
			return true;
		}
		else
		{
			$('#editempemailerror').html('');
		}
		if(editempdesignation=="")
		{
			$('#editempdescerror').html('<span>Please enter designation</span>');
			return true;
		}
		else{
			$('#editempdescerror').html('');
		}


		$.ajax({
			url:'config/systemparamaters.php',
			data:{
				"type" : "editemployeedetails",
				"editempyid" : editempyid,
				"editempyname" : editempyname,
				"editempymbl" : editempymbl,
				"editempemail" : editempemail,
				"editempdesignation":editempdesignation
			},
			type:"post",
			success:function(data){
				employeetable();
				$(".addemployee").show();
	 			$(".editemployee").hide();
				// alert("Employee Details has been Updated");
				$("#empadd").html("");
				$("#empdelete").html("");
				$("#empupdate").html("Employee details has been updated").css("color");
				$("#empmodal").modal();
			}
		  });
	 }

	 function noteditemployeedetails() {
	 	event.preventDefault();
	 	$(".addemployee").show();
	 	$(".editemployee").hide();
	 }

	 //company information add
	 function addcompany(){
	 	event.preventDefault();
		var companyname =  $("#companyname").val();
		var cmpydesc =  $("#cmpydesc").val();

		if (companyname==""){
			$('#companyerror').html('<span>Please enter company name</span>');
			return true;
		}
		else
		{
			$('#companyerror').html('');
		}
		if(cmpydesc=="")
		{
			$('#companydescerror').html('<span>Please enter comapany description</span>');
			return true;
		}
		else{
			$('#companydescerror').html('');
		}


		var companystatus = $("#companystatus").is(":checked");
		if (companystatus) {
               companystatus = 1;
            } else {
                companystatus = 0;
            }
		$.ajax({
			url:'config/systemparamaters.php',
			data:{
				"type" : "companyadd",
				"companyname" : companyname,
				"cmpydesc" : cmpydesc,
				"companystatus" : companystatus
			},
			type:"post",
			success:function(data){
				listcompany();	$('#companyform')[0].reset();
				// alert("Company Details has been added");
				$("#comupdate").html("");
				$("#comdelete").html("");
				$("#comadd").html("Company details has been added").css("color");
				$("#commodal").modal();
			}
		  });
	 }


	 // Delete Company
	 function deletecompany(data)
	 {
	 	var r = confirm("Are You Sure to delete the company details!");
        if (r == true) {
       		$.ajax({
			url:'config/systemparamaters.php',
			data:{
				"type" : "deletecompany",
				"id" : data
			},
			type:"post",
			success:function(data){
				listcompany();
				// alert("Company Details has been Deleted");
				$("#comupdate").html("");
				$("#comadd").html("");
				$("#comdelete").html("Company details has been deleted").css("color");
				$("#commodal").modal();
			}
		  });
        } else {
    		txt = "You pressed Cancel!";
		}
	 }

	  // Got data for edit company
	 function editcompany(data)
	 {
	 	$(".addcompany").hide();
	 	$(".editcmpany").show();
       		$.ajax({
			url:'config/systemparamaters.php',
			data:{
				"type" : "editcompany",
				"id" : data
			},
			type:"post",
			success:function(data){
				data = JSON.parse(data);
					$("#editcompanyid").val(data[0].id);
					$("#editcompanyname").val(data[0].name);
					var vendorstatus = data[0].status;
					$("#editcmpydesc").val(data[0].description);
					if( vendorstatus == 1)
						$('#editcompanystatus').prop('checked', true);
					else
						$('#editcompanystatus').prop('checked', false);
				}
		  	});
	 }

	//company information edit
	 function editcompanydetails(){
	 	event.preventDefault();
		var editcompanyid =  $("#editcompanyid").val();
		var editcompanyname =  $("#editcompanyname").val();
		var editcmpydesc =  $("#editcmpydesc").val();

		if (editcompanyname==""){
			$('#ecompanyerror').html('<span>Please enter company name</span>');
			return true;
		}
		else
		{
			$('#ecompanyerror').html('');
		}
		if(editcmpydesc=="")
		{
			$('#ecompanydescerror').html('<span>Please enter comapany description</span>');
			return true;
		}
		else{
			$('#ecompanydescerror').html('');
		}


		var editcompanystatus = $("#editcompanystatus").is(":checked");
		if (editcompanystatus) {
               editcompanystatus = 1;
            } else {
                editcompanystatus = 0;
            }
		$.ajax({
			url:'config/systemparamaters.php',
			data:{
				"type" : "editcompanydetails",
				"editcompanyid" : editcompanyid,
				"editcompanyname" : editcompanyname,
				"editcmpydesc" : editcmpydesc,
				"editcompanystatus" : editcompanystatus
			},
			type:"post",
			success:function(data){
				listcompany();
				$(".addcompany").show();
	 			$(".editcmpany").hide();
				// alert("Company Details has been Updated");
				$("#comdelete").html("");
				$("#comadd").html("");
				$("#comupdate").html("Company details has been updated").css("color");
				$("#commodal").modal();
			}
		  });
	 }

//variant information add

function addvariant(){

	 	event.preventDefault();
		var subcategoryproduct =  $("#subcategoryproduct").val();
		var variantname =  $("#variantname").val();
		var variantcode =  $("#variantcode").val();
		var verantdesct =  $("#verantdesct").val();
		var rendcost1 =  $("#rendcost1").val();
		var depositeamt1 =  $("#depositeamt1").val();
		var processingfees1 =  $("#processingfees1").val();
		var insfees1 =  $("#insfees1").val();
		var othersfees1 =  $("#othersfees1").val();
		var tenure1 =  $("#tenure1").val();


		//$("#rendcost1").val("0.00")
		//$("#depositeamt1").val("0.00")
		//$("#processingfees1").val("0.00")
		//$("#insfees1").val("0.00")
		//$("#othersfees1").val("0.00")
		//$("#tenure1").val("0.00")

		if (variantname==""){
			$('#varianterror').html('<span>Please enter variant name</span>');
			return true;
		}
		else
		{
			$('#varianterror').html('');
		}
		if(verantdesct=="")
		{
			$('#variantdescerror').html('<span>Please enter variant description</span>');
			return true;
		}
		else
		{
			$('#variantdescerror').html('');
		}

		if(variantcode=="")
		{
			$('#variantcodeerror').html('<span>Please enter variant code</span>');
			return true;
		}
		else
		{
			$('#variantcodeerror').html('');
		}

		var formData = new FormData($("form#variantform")[0]);

		 $.ajax({
        url: "config/sysvariantadd.php",
        type: 'POST',
        data: formData,
        async: false,
        success: function (data) {
           // console.log(data);variantlist();
			$("#variantdelete").html("");
			$("#variantupdate").html("");
			$("#variantadd").html("Variant details has been added").css("color");
			$("#variantmodal").modal();
			$('#variantform')[0].reset();
        },
        cache: false,
        contentType: false,
        processData: false
		});
		return false;
	 }


	 function variantgotsubcategory()
	{
		var maincategoryproduct = $("#maincategoryproduct").val();
		var obj=document.getElementById("subcategoryproduct");
		$("#subcategoryproduct").empty();
		$.ajax({ url: "config/systemparamaters.php",
			data:{
				"type" : "gotsubcategory",
				"mainid" : maincategoryproduct
			},
			type:"post",
			success: function(data)
				{
					//console.log(JSON.parse(data));
					selectValues = JSON.parse(data);
					for (var i = 0; i < selectValues.length; i++)     {
						opt = document.createElement("option");
						opt.value =selectValues[i].pr_sub_id;
						opt.text=selectValues[i].pr_sub_name;
						obj.appendChild(opt);
					}
				}
			});
	}


	// Delete Variant
	 function deletevariant(data)
	 {
	 	var r = confirm("Are You Sure to delete the variant details!");
        if (r == true) {
       		$.ajax({
			url:'config/systemparamaters.php',
			data:{
				"type" : "deletevariant",
				"id" : data
			},
			type:"post",
			success:function(data){
				variantlist();
				// alert("Variant Details has been Deleted");
			$("#variantadd").html("");
			$("#variantupdate").html("");
			$("#variantdelete").html("Variant details has been deleted").css("color");
			$("#variantmodal").modal();
			}
		  });
        } else {
    		txt = "You pressed Cancel!";
		}
	 }

	  // Got data for edit variant
		 function editvariant(data)
	 {
	 	$(".addvariant").hide();
	 	$(".editvariant").show();
		$('#editvariantcostadd tbody > tr').remove();
       		$.ajax({
			url:'config/systemparamaters.php',
			data:{
				"type" : "editvariant",
				"id" : data
			},
			type:"post",
			success:function(data){
				data = JSON.parse(data);
				//console.log(data);
					$("#editvariantid").val(data.variant[0].ptdvar_id);
					var vendorstatus = data.variant[0].status;
					$("#editvariantname").val(data.variant[0].name);
					$("#editverantdesct").val(data.variant[0].description);
					$("#editverantcode").val(data.variant[0].variant_code)
					if(parseInt(vendorstatus )== 1)
						$('#editstatusvariant').prop('checked', true);
					else
						$('#editstatusvariant').prop('checked', false);

				var d = data.variantcost.length;
				for(var i=0;i<d;i++)
				{
					//console.log(data.variantcost[i].rent_cost);
					event.preventDefault();
					var rendcost = "rendcost" + i;
					var depositeamt = "depositeamt" + i;
					var processingfees = "processingfees" + i;
					var insfees = "insfees" + i;
					var othersfees = "othersfees" + i;
					var tenure = "tenure" + i;
					var newTr = '<tr><td><input type="text" class="form-control" id=' + rendcost + ' name="rendcost[]" value='+data.variantcost[i].rent_cost+' placeholder="Rent Cost"/></td><td><input name="depositeamt[]"  class="form-control" type="text" id=' + depositeamt + ' value='+data.variantcost[i].security_deposit_price+' placeholder="Security Deposite Amount"/></td><td><input name="processingfees[]"  class="form-control" type="text" id=' + processingfees +' value='+data.variantcost[i].processing_fee+' placeholder="Processing Fees"/></td><td><input name="insfees[]"  class="form-control" type="text" id=' + insfees + ' value='+data.variantcost[i].ins_fee+' placeholder="Ins Fees"/></td><td><input name="othersfees[]"  class="form-control" type="text" id=' + othersfees + '  value='+data.variantcost[i].other_fee+' placeholder="Others Fees"/></td><td><input name="tenure[]"  class="form-control" value='+data.variantcost[i].tenure+' type="text" id=' + tenure + ' placeholder="Tenure"/></td><td> <a class="trnsport_remove" href=""> <i class="fa fa-trash-o" title="Remove Product" aria-hidden="true"></i></a></td></tr>';
					$('#editvariantcostadd').append(newTr);
				}

				}
		  	});
	 }

	//Variant information edit
	 function editvariantdetails(){
	 	event.preventDefault();
		var editvariantid =  $("#editvariantid").val();
		//console.log(editvariantid);
		var editvariantname =  $("#editvariantname").val();
		var editverantdesct =  $("#editverantdesct").val();
		var editverantcode =  $("#editverantcode").val();
		var editrendcost =  $("#editrendcost").val();
		var editdepositeamnt =  $("#editdepositeamnt").val();
		var editprocessingfees =  $("#editprocessingfees").val();
		var editinscost =  $("#editinscost").val();
		var editotherfee =  $("#editotherfee").val();


		if (editvariantname==""){
			$('#editvariantnameerror').html('<span>Please enter variant name</span>');
			return true;
		}
		else
		{
			$('#editvariantnameerror').html('');
		}
		if(editverantdesct=="")
		{
			$('#editverantdescterror').html('<span>Please enter variant description</span>');
			return true;
		}
		else
		{
			$('#editverantdescterror').html('');
		}

		if(editverantcode=="")
		{
			$('#editvencodeterror').html('<span>Please enter vendor code</span>');
			return true;
		}
		else
		{
			$('#editvencodeterror').html('');
		}


		var formData = new FormData($("form#editvariantform")[0]);
		$.ajax({
        url: "config/syseditvariantadd.php",
        type: 'POST',
        data: formData,
        async: false,
        success: function (data) {
            //console.log(data);variantlist();
			$(".addvariant").show();
	 		$(".editvariant").hide();
			$("#variantadd").html("");
			$("#variantdelete").html("");
			$("#variantupdate").html("Variant details has been updated").css("color");
			$("#variantmodal").modal();
        },
        cache: false,
        contentType: false,
        processData: false
		});
		return false;
	 }

  //Area information add
	 function addarea(){
	 	event.preventDefault();
		var areazone =  $("#areazone").val();
		var area =  $("#area").val();
		var areadescription =  $("#areadescription").val();

		if (area==""){
			$('#areaerror').html('<span>Please enter area name</span>');
			return true;
		}
		else
		{
			$('#areaerror').html('');
		}
		if(areadescription=="")
		{
			$('#areadescerror').html('<span>Please enter area description</span>');
			return true;
		}
		else
		{
			$('#areadescerror').html('');
		}


		var statusarea = $("#statusarea").is(":checked");
		if (statusarea) {
               statusarea = 1;
            } else {
                statusarea = 0;
            }
		$.ajax({
			url:'config/systemparamaters.php',
			data:{
				"type" : "addarea",
				"areazone" : areazone,
				"area" : area,
				"areadescription" : areadescription,
				"statusarea" : statusarea
			},
			type:"post",
			success:function(data){
				// alert("Area Details has been added");
			$("#areaupdate").html("");
			$("#areadelete").html("");
			$("#areaadd").html("Area details has been added").css("color");
			$("#areamodal").modal();
				arealist();
				$('#areaaddform')[0].reset();
			}
		  });
	 }



	// Delete area
	 function deletearea(data)
	 {
	 	var r = confirm("Are You Sure to delete the area details!");
        if (r == true) {
       		$.ajax({
			url:'config/systemparamaters.php',
			data:{
				"type" : "deletearea",
				"id" : data
			},
			type:"post",
			success:function(data){
				arealist();
				// alert("Area Details has been Deleted");
			$("#areaupdate").html("");
			$("#areaadd").html("");
			$("#areadelete").html("Area details has been deleted").css("color");
			$("#areamodal").modal();
			}
		  });
        } else {
    		txt = "You pressed Cancel!";
		}
	 }


	  // Got data for edit area
	 function editarea(data)
	 {
	 	$(".addareaform").hide();
	 	$(".editarea").show();
       		$.ajax({
			url:'config/systemparamaters.php',
			data:{
				"type" : "editarea",
				"id" : data
			},
			type:"post",
			success:function(data){
				data = JSON.parse(data);
					$("#areaid").val(data[0].id);
					$("#editarea").val(data[0].name);
					var vendorstatus = data[0].status;
					$("#editareadescription").val(data[0].description);
					if( vendorstatus == 1)
						$('#editstatusarea').prop('checked', true);
					else
						$('#editstatusarea').prop('checked', false);
				}
		  	});
	 }


	 //Area information edit
	 function editareadetails(){
	 	event.preventDefault();
		var areaid =  $("#areaid").val();
		var editarea =  $("#editarea").val();
		var editareadescription =  $("#editareadescription").val();

		if (editarea==""){
			$('#editareaerror').html('<span>Please enter area name</span>');
			return true;
		}
		else
		{
			$('#editareaerror').html('');
		}
		if(editareadescription=="")
		{
			$('#editareadescerror').html('<span>Please enter area description</span>');
			return true;
		}
		else
		{
			$('#editareadescerror').html('');
		}

		var editstatusarea = $("#editstatusarea").is(":checked");
		if (editstatusarea) {
               editstatusarea = 1;
            } else {
                editstatusarea = 0;
            }
		$.ajax({
			url:'config/systemparamaters.php',
			data:{
				"type" : "editareadetails",
				"areaid" : areaid,
				"editarea" : editarea,
				"editareadescription" : editareadescription,
				"editstatusarea" : editstatusarea
			},
			type:"post",
			success:function(data){
				arealist();
				// alert("Area Details has been Updated");
			$("#areaadd").html("");
			$("#areaadd").html("");
			$("#areaupdate").html("Area details has been updated").css("color");
			$("#areamodal").modal();
				$(".addareaform").show();
	 			$(".editarea").hide();
			}
		  });
	 }

	 function noteditarea()
	 {
	 	event.preventDefault();
	 	$(".addareaform").show();
	 	$(".editarea").hide();
	 }

$('#billupload').on("change", function(){
	var image = $('#billupload')[0].files[0].name;
});

$("#serialno").blur(function(){
		var serialnum = $(this).val();
		$.ajax({
			url:'config/productadd.php',
			data:{
					"type" : "checkserialnum",
					 serialnum : serialnum
				},
			type:"post",
			success:function(data)
			{
				if(data == 1)
				{
					$("#serialno").val("");
					alert("Serial Number Alread Exists");
				}
				else
				{

				}
			}
		});
    });


//Product Add & Edit Section


 function prdvariantlistdetails(productvar)
 {
 	var productvar = productvar.split(',');
 	$.ajax({
			url:'config/productadd.php',
			data:{
				"type" : "prdvariantlistdetails",
				"productvar" : productvar[0]
			},
			type:"post",
			success:function(data){
				data = JSON.parse(data);
				$("#rent").val( data[0].rent_cost);
				$("#processing_fee").val( data[0].processing_fee);
				$("#security_deposit").val( data[0].security_deposit_price);
			}
	});

 }


 function viewproductid(id)
{
   $('#produc_id').val(id);
  $('#imagediv').empty();
  $("#listofproductable").hide();
  $("#viewdetailsshow").show();
  $.ajax({
      url:'config/productadd.php',
      data:{
        "type" : "productview",
        "id" : id
      },
      type:"post",
      success:function(data){
       //console.log(data);
      data = JSON.parse(data);

      //console.log(data);
      $("#product_category").val(data.subcategory);
      $("#viewvariant").val(data.variantname);
      $("#viewbrand").val(data.brandname);
      $("#viewvendor").val(data.vendorname);
      $("#viewpurchasedate").val(data.productary[0].purchase_date);
      $("#viewpurchase_value").val(data.productary[0].purchase_cost);
      $("#viewother_charge").val(data.productary[0].expenses);
      $("#viewserialno").val(data.productary[0].sl_no);
      $("#viewwarranty").val(data.productary[0].warranty_end_date);
      $("#viewbillnumber").val(data.productary[0].bill_no);
      $("#viewrent").val(data.variantrent_cost);
      $("#viewprocessing_fee").val(data.processing_fee);
      $("#viewsecurity_deposit").val(data.security_deposit_price);


	  if(data.productary[0].product_owned_type == 1)
	  	$("#viewowned").val("owned");
      else
      	$("#viewowned").val("Third Party");
      if(data.productary[0].prtd_location == 1)
	  	$("#viewlocation").val("Godown");
      else
      	$("#viewlocation").val("customer's Place");
      	for (var i=0; i<data.productimgs.length; i++)
      	{
      		var path = "Documents/product/"+data.productid+data.productimgs[i].image_path;
      		//console.log(path);
      		var img = $('<img>');
            img.attr('src', path);
            img.appendTo('#imagediv');
      	}
      	$('#imagediv> img').attr('width', '100');
      	$('#imagediv> img').addClass('img-resposive');
        $('#imagediv> img').css("margin-right","15px");
      }
  });
}

function editproductid(id)
{
	editproductselectmaincategory();  editproductgotbrandlist();    editproductvendorlist();     editproductrentvendorlist();    editproductcitylist();

   $("#listofproductable").hide();
   $("#editdetailsshow").show();
   $.ajax({
      url:'config/productadd.php',
      data:{
        "type" : "editproductview",
        "id" : id
      },
      type:"post",
      success:function(data){
      data = JSON.parse(data);
      //console.log(data);
      $("#editprocategorylist").val(data.maincategory);
      thuthu(data.subcategory);
      //$("#editprosubcategoryproduct").val(data.subcategory);
      //$("#editproproductvariant").val(data.productary[0].ptdvar_id);
      $("#editproductid").val(data.productary[0].product_id);
      $("#editproproductbrand").val(data.productary[0].brand);
      $("#editprovendorbrand").val(data.productary[0].vendor).prop('selected', true);
      $("#editpropurchasedate").val(data.productary[0].purchase_date);
      $("#editpropurchase_value").val(data.productary[0].purchase_cost);
      $("#editproother_charge").val(data.productary[0].expenses);
      $("#editproserialno").val(data.productary[0].sl_no);
      $("#editprowarrantydate").val(data.productary[0].warranty_end_date);
      $("#editprobillnumber").val(data.productary[0].bill_no);
      $("#editprorent").val(data.variantrent_cost);
      $("#editproprocessing_fee").val(data.processing_fee);
      $("#editprosecurity_deposit").val(data.security_deposit_price);
      $("#editprorentpurchasedate").val(data.productary[0].rent_purchase_date);
      $("#editprorendpurchase_value").val(data.productary[0].rent_to_vendor_cost);
      $("#editprovendorthird").val(data.productary[0].rent_vendor);
      $("input[name=editproownedtype][value=" + data.productary[0].purchase_type + "]").prop('checked', true);
	  $("input[name=editprolocation][value=" + data.productary[0].prtd_location + "]").prop('checked', true);
      thuthu1(data.subcategory,data.productary[0].ptdvar_id);
      	for (var i=0; i<data.productimgs.length; i++)
      	{
      		var path = "Documents/product/"+data.productid+data.productimgs[i].image_path;
      		var url = data.productimgs[i].image_path;
            url = url.split("/");
			var title;
            if( url[1] =='productimages')
            {
            	title = 'Product Iamges';
            }
            else
            {
            	title = 'Bill Images';
            }
      		var img = $('<img>');
            img.attr('src', path);
            img.attr('title',title);
            img.appendTo('#editimagediv');
      	}
      	$('#editimagediv> img').attr('width', '100');
      	$('#editimagediv> img').addClass('img-resposive');
      	$("#editimagediv> img").css( { "margin-right" : "50px" } );
      }
  });

 	/*** Hide and Show product view third party Section ***/
		$('#optionsRadios1').click(function ()
		{
			$(".erentpurchvalue").hide();
			$(".erendpurchdate").hide();
			$("#erentvendor").hide();
			$(".erentvendor").hide();
			$("#editprovendorthird").hide();
		});

		$('#optionsRadios2').click(function () {
			$(".erentpurchvalue").show();
			$(".erendpurchdate").show();
			$("#erentvendor").show();
			$(".erentvendor").show();
			$("#editprovendorthird").show();

		});

}

function showtablehideview()
{

          location.reload();
	event.preventDefault();
	$("#listofproductable").show();
 	 $("#viewdetailsshow").hide();
       $("#editdetailsshow").hide();
}


	function selectmaincategory()
	{
		$.ajax({ url: "config/systemparamaters.php",
			data:{
				"type" : "selectmaincategory"
			},
			type:"post",
			success: function(data)
				{
					var obj=document.getElementById("categorylist");
					$("#categorylist").empty();
					$('#categorylist').append('<option disabled="disabled" selected="true">Select Option</option>');
					var selectValues = JSON.parse(data);
					for (var i = 0; i <= selectValues.length; i++)     {
						opt = document.createElement("option");
						opt.value =selectValues[i].ptdcatgry_id ;
						opt.text=selectValues[i].name;
						obj.appendChild(opt);
					}
				}
			});
	}

	function getsubcategory(categyid)
	{
		$.ajax({ url: "config/systemparamaters.php",
			data:{
				"type" : "gotsubcategory",
				"mainid" : categyid
			},
			type:"post",
			success: function(data)
				{
					var obj=document.getElementById("subcategoryproduct");
					$("#subcategoryproduct").empty();
					$('#subcategoryproduct').append('<option disabled="disabled" selected="true">Select Option</option>');
					var selectValues = JSON.parse(data);
					for (var i = 0; i <= selectValues.length; i++)     {
						opt = document.createElement("option");
						opt.value =selectValues[i].pr_sub_id+","+selectValues[i].description;
						opt.text=selectValues[i].pr_sub_name;
						obj.appendChild(opt);
					}
				}
			});
	}

function variantlist(subcatval)
	 {
	 	var subcatvalarray = subcatval.split(',');
		$.ajax({ url: "config/productadd.php",
			data:{
				"type" : "provariantlist",
				"subcategoryproduct" : subcatvalarray[0]
			},
			type:"post",
			success: function(data)
				{
					var obj=document.getElementById("productvariant");
					$("#productvariant").empty();
					$('#productvariant').append('<option disabled="disabled" selected="true">Select Option</option>');
					var selectValues = JSON.parse(data);
					for (var i = 0; i <= selectValues.length; i++)     {
						opt = document.createElement("option");
						opt.value =selectValues[i].ptdvar_id+","+selectValues[i].variant_code;
						opt.text=selectValues[i].name;
						obj.appendChild(opt);
					}
				}
			});
	}

	function gotbrandlist()
	 {
		var obj=document.getElementById("productbrand");
		$("#productbrand").empty();
		$.ajax({ url: "config/systemparamaters.php",
			data:{
				"type" : "brandlist"
			},
			type:"post",
			success: function(data)
				{
					var selectValues = JSON.parse(data);
					for (var i = 0; i <= selectValues.length; i++)     {
						opt = document.createElement("option");
						opt.value =selectValues[i].brand_id+","+selectValues[i].description; ;
						opt.text=selectValues[i].name;
						obj.appendChild(opt);
					}
				}
			});
	}

	function citylist()
	 {
		var obj=document.getElementById("cityproduct");
		$("#cityproduct").empty();
		event.preventDefault();
		$.ajax({ url: "config/systemparamaters.php",
			data:{
				"type" : "editzonecitylist"
			},
			type:"post",
			success: function(data)
				{
					var selectValues = JSON.parse(data);
					for (var i = 0; i <= selectValues.length; i++)     {
						opt = document.createElement("option");
						opt.value =selectValues[i].description; ;
						opt.text=selectValues[i].name;
						obj.appendChild(opt);
					}
				}
			});
	}

	function vendorlist(){
		var obj=document.getElementById("vendorbrand");
		$("#vendorbrand").empty();
		$.ajax({
			url:'config/systemparamaters.php',
			data:{
				"type" : "vendorlist"
			},
			type:"post",
			success:function(data){
					var selectValues = JSON.parse(data);
					for (var i = 0; i <= selectValues.length; i++)     {
						opt = document.createElement("option");
						opt.value =selectValues[i].vendor_id+","+selectValues[i].description; ;
						opt.text=selectValues[i].name;
						obj.appendChild(opt);
				}
			}
		  });
	 }

	 function rentvendorlist(){
		var obj=document.getElementById("vendorthird");
		$("#vendorthird").empty();
		$.ajax({
			url:'config/systemparamaters.php',
			data:{
				"type" : "rendvendorlist"
			},
			type:"post",
			success:function(data){
					var selectValues = JSON.parse(data);
					for (var i = 0; i <= selectValues.length; i++)     {
						opt = document.createElement("option");
						opt.value =selectValues[i].id+","+selectValues[i].description; ;
						opt.text=selectValues[i].name;
						obj.appendChild(opt);
				}
			}
		  });
	 }

$("form#productaddform").submit(function(event){
	// alert("jdgf");
	event.preventDefault();
    var formData = new FormData($(this)[0]);

    var Uploadbillimg =  $("#Uploadbillimg").val();
    var uploadproductimages =  $("#uploadproductimages").val();
    var rentpurchasedate =  $("#rentpurchasedate").val();
    var rendpurchase_value =  $("#rendpurchase_value").val();
    var subcategoryproduct =  $("#subcategoryproduct").val();
    var productvariant =  $("#productvariant").val();
    var purchasedate =  $("#purchasedate").val();
    var purchase_value =  $("#purchase_value").val();
    var other_charge =  $("#other_charge").val();
    var serialno =  $("#serialno").val();
    var warrantydate =  $("#warrantydate").val();
    var billnumber =  $("#billnumber").val();
	var min=4;

		if (Uploadbillimg=="")
		{
			$('#billimgerror').html('<span>Please upload your bill</span>');
		}
		else
		{
			$('#billimgerror').html('');
		}
		if (uploadproductimages=="")
		{
			$('#productimgerror').html('<span>Please upload your product image</span>');
		}
		else
		{
			$('#productimgerror').html('');
		}
		if (rentpurchasedate=="")
		{
			$('#rentpurchaseerror').html('<span>Please enter rent purchase date</span>');
		}
		else
		{
			$('#rentpurchaseerror').html('');
		}
		if (rendpurchase_value=="")
		{
			$('#rentpurchasevalueerror').html('<span>Please enter rent purchase value</span>');
		}
		else
		{
			$('#rentpurchasevalueerror').html('');
		}
		if (subcategoryproduct=="")
		{
			$('#subcategoryerror').html('<span>Please select main category</span>');
		}
		else
		{
			$('#subcategoryerror').html('');
		}
		if(productvariant=="")
		{
			$('#varianterror').html('<span>Please select sub category</span>');
		}
		else
		{
			$('#varianterror').html('');
		}
		if (purchasedate==""){
			$('#pdateerror').html('<span>Please enter purchase date</span>');
		}
		else
		{
			$('#pdateerror').html('');
		}
		if(purchase_value=="")
		{
			$('#pvalueerror').html('<span>Please enter purchase value</span>');
		}
		else{
			$('#pvalueerror').html('');
		}
		if (other_charge=="")
		{
			$('#otherchargeerror').html('<span>Please enter other charges</span>');
		}
		else
		{
			$('#otherchargeerror').html('');
		}

		if (warrantydate==""){
			$('#wperioderror').html('<span>Please enter warranty date</span>');
		}
		else
		{
			$('#wperioderror').html('');
		}
		if(billnumber=="")
		{
			$('#billnoerror').html('<span>Please enter bill number</span>');
		}
		else
		{
			$('#billnoerror').html('');
		}
		if(serialno=="")
		{
			$('#msnerror').html('<span>Please enter serial number</span>');
		}
		else if(serialno.length < min)
		{
			$('#msnerror').html('<span>Please enter atleast 4 digit serial number</span>');
		return false;
		}
		else
		{
			$('#msnerror').html('');
		}

		var a = $("#optionsRadios1").is(":checked");

		if(a)
		{
			if(Uploadbillimg=='' || uploadproductimages=='' || subcategoryproduct=='' || productvariant=='' || purchasedate=='' || purchase_value=='' || other_charge=='' || serialno=='' || warrantydate=='' || billnumber==''  )
			{
				return false;
			}
		}
		else
		{
			if(Uploadbillimg=='' || uploadproductimages=='' || subcategoryproduct=='' || productvariant=='' || purchasedate=='' || purchase_value=='' || other_charge=='' || serialno=='' || warrantydate=='' || billnumber=='' || rentpurchasedate=='' || rendpurchase_value=='' )
			{
				return false;
			}
		}


    $.ajax({
        url: "config/addproductdetails.php",
        type: 'POST',
        data: formData,
        async: false,
        success: function (data) {
			//console.log(data);
            // alert(data);
            $('form#productaddform')[0].reset();
			$("#billimages").empty();
			$("#productimages").empty();

        },
        cache: false,
        contentType: false,
        processData: false
    });
    return false;
});


 $("#Uploadbillimg").change(function(){
        readURL(this);
 });

 function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#billimages').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

 function handleFileSelect(evt) {
    var files = evt.target.files;
	for (var i = 0, f; f = files[i]; i++) {
	     if (!f.type.match('image.*')) {
    	    continue;
      	}
	    var reader = new FileReader();
	    reader.onload = (function(theFile) {
        return function(e) {
        var span = document.createElement('span');
        span.innerHTML = ['<img width="100px" class="thumb" src="', e.target.result,'" title="', escape(theFile.name), '"/>'].join('');
        document.getElementById('productimages').insertBefore(span, null);
        };
      })(f);
      reader.readAsDataURL(f);
    }
  }
	if(document.getElementById('uploadproductimages')!=null){
		document.getElementById('uploadproductimages').addEventListener('change', handleFileSelect, false);
	}

   function billfileselect(evt) {
    var files = evt.target.files;
	for (var i = 0, f; f = files[i]; i++) {
	     if (!f.type.match('image.*')) {
    	    continue;
      	}
	    var reader = new FileReader();
	    reader.onload = (function(theFile) {
        return function(e) {
        var span = document.createElement('span');
        span.innerHTML = ['<img width="100px" class="thumb" src="', e.target.result,'" title="', escape(theFile.name), '"/>'].join('');
        document.getElementById('billimages').insertBefore(span, null);
        };
      })(f);
      reader.readAsDataURL(f);
    }
  }
	if(document.getElementById('Uploadbillimg')!=null){
		document.getElementById('Uploadbillimg').addEventListener('change', billfileselect, false);
	}

  $("input[name='ownedtype']").click(function () {

    if($(this).val() == 0)
    {
    	$(".rentpurchvalue").show();
    	$(".rendpurchdate").show();
    	$("#rentvendor").show();
    	$(".rentvendor").show();
		$("#vendorthird").show();

    }
    else
    {
		$(".rentpurchvalue").hide();
		$(".rendpurchdate").hide();
		$("#rentvendor").hide();
    	$(".rentvendor").hide();
    	$("#vendorthird").hide();

    }
});


	function editproductselectmaincategory()
	{
		$("#editprocategorylist").empty();
		$.ajax({ url: "config/systemparamaters.php",
			data:{
				"type" : "selectmaincategory"
			},
			type:"post",
			success: function(data)
				{

					var selectValues = JSON.parse(data);
					for (var i = 0; i <	 selectValues.length; i++)     {
						 $('#editprocategorylist').append( '<option value="'+selectValues[i].ptdcatgry_id+'">'+selectValues[i].name+'</option>' );
					}
				}

			});
	}

	function thuthu(id)
	{
		var subcartval = id;
		var mainid = $("#editprocategorylist").val();
		editproductgetsubcategory(mainid,subcartval);
	}

	function editproductgetsubcategory(categyid,subval)
	{
		$("#editprosubcategoryproduct").empty();
		$.ajax({ url: "config/systemparamaters.php",
			data:{
				"type" : "gotsubcategory",
				"mainid" : categyid
			},
			type:"post",
			success: function(data)
				{
				var selectValues = JSON.parse(data);
				for (var i = 0; i < selectValues.length; i++)     {
					if(selectValues[i].pr_sub_id == subval) {
					 $('#editprosubcategoryproduct').append( '<option selected="selected" value="'+selectValues[i].pr_sub_id+'">'+selectValues[i].pr_sub_name+'</option>' );
					}
					else
					{
					$('#editprosubcategoryproduct').append( '<option value="'+selectValues[i].pr_sub_id+'">'+selectValues[i].pr_sub_name+'</option>' );
					}
				}

				}
			});
	}

	function thuthu1(id,vartid)
	{
		editproductvariantlist(id,vartid);
	}

function editproductvariantlist(subcatval,vartid)
	 {
	 	$("#editproproductvariant").empty();
	 	// alert(subcatval);
		$.ajax({ url: "config/productadd.php",
			data:{
				"type" : "provariantlist",
				"subcategoryproduct" : subcatval
			},
			type:"post",
			success: function(data)
				{
					var selectValues = JSON.parse(data);
					for (var i = 0; i < selectValues.length; i++)     {
					if(selectValues[i].ptdvar_id == vartid) {
					 $('#editproproductvariant').append( '<option selected="selected" value="'+selectValues[i].ptdvar_id+'">'+selectValues[i].name+'</option>' );
					}
					else
					{
					$('#editproproductvariant').append( '<option value="'+selectValues[i].ptdvar_id+'">'+selectValues[i].name+'</option>' );
					}
				}

				}
			});
	}

	function editproductgotbrandlist()
	 {
		var obj=document.getElementById("editproproductbrand");
		$("#editproproductbrand").empty();
		$.ajax({ url: "config/systemparamaters.php",
			data:{
				"type" : "brandlist"
			},
			type:"post",
			success: function(data)
				{
					var selectValues = JSON.parse(data);
					for (var i = 0; i <= selectValues.length; i++)     {
						opt = document.createElement("option");
						opt.value =selectValues[i].brand_id;
						opt.text=selectValues[i].name;
						obj.appendChild(opt);
					}
				}
			});
	}

	function editproductcitylist()
	 {
		var obj=document.getElementById("editprocityproduct");
		$("#editprocityproduct").empty();
		event.preventDefault();
		$.ajax({ url: "config/systemparamaters.php",
			data:{
				"type" : "editzonecitylist"
			},
			type:"post",
			success: function(data)
				{
					var selectValues = JSON.parse(data);
					for (var i = 0; i <= selectValues.length; i++)     {
						opt = document.createElement("option");
						opt.value =selectValues[i].description;
						opt.text=selectValues[i].name;
						obj.appendChild(opt);
					}
				}
			});
	}

	function editproductvendorlist(){
		var obj=document.getElementById("editprovendorbrand");
		$("#editprovendorbrand").empty();
		$.ajax({
			url:'config/systemparamaters.php',
			data:{
				"type" : "vendorlist"
			},
			type:"post",
			success:function(data){
					var selectValues = JSON.parse(data);
					for (var i = 0; i <= selectValues.length; i++)     {
						opt = document.createElement("option");
						opt.value =selectValues[i].vendor_id;
						opt.text=selectValues[i].name;
						obj.appendChild(opt);
				}
			}
		  });
	 }

	 function editproductrentvendorlist(){
		var obj=document.getElementById("editprovendorthird");

		$("#editprovendorthird").empty();
		$.ajax({
			url:'config/systemparamaters.php',
			data:{
				"type" : "rendvendorlist"
			},
			type:"post",
			success:function(data){
					var selectValues = JSON.parse(data);
					for (var i = 0; i <= selectValues.length; i++)     {
						opt = document.createElement("option");
						opt.value =selectValues[i].id;
						opt.text=selectValues[i].name;
						obj.appendChild(opt);
				}
			}
		  });
	 }

	 function editproductprdvariantlistdetails(productvar)
 {

 	$.ajax({
			url:'config/productadd.php',
			data:{
				"type" : "prdvariantlistdetails",
				"productvar" : productvar
			},
			type:"post",
			success:function(data){
				data = JSON.parse(data);
				$("#editprorent").val( data[0].rent_cost);
				$("#editproprocessing_fee").val( data[0].processing_fee);
				$("#editprosecurity_deposit").val( data[0].security_deposit_price);
			}
	});
 }



	function editproductdetailsupdate(){
		event.preventDefault();


	 var uploadeditbillimages =  $("#uploadeditbillimages").val();
    var uploadeditproductimages =  $("#uploadeditproductimages").val();
    var editprorentpurchasedate =  $("#editprorentpurchasedate").val();
    var editprorendpurchase_value =  $("#editprorendpurchase_value").val();
    var editprosubcategoryproduct =  $("#editprosubcategoryproduct").val();
    var editproproductvariant =  $("#editproproductvariant").val();
    var editpropurchasedate =  $("#editpropurchasedate").val();
    var editpropurchase_value =  $("#editpropurchase_value").val();
    var editproother_charge =  $("#editproother_charge").val();
    var editproserialno =  $("#editproserialno").val();
    var editprowarrantydate =  $("#editprowarrantydate").val();
    var editprobillnumber =  $("#editprobillnumber").val();
	var min=4

		if (editprorentpurchasedate=="")
		{
			$('#erentpurchaseerror').html('<span>Please enter rent purchase date</span>');
		}
		else
		{
			$('#erentpurchaseerror').html('');
		}
		if (editprorendpurchase_value=="")
		{
			$('#erentpurchasevalueerror').html('<span>Please enter rent purchase value</span>');
		}
		else
		{
			$('#erentpurchasevalueerror').html('');
		}
		if (editprosubcategoryproduct=="")
		{
			$('#esubcategoryerror').html('<span>Please select main category</span>');
		}
		else
		{
			$('#esubcategoryerror').html('');
		}
		if(editproproductvariant=="")
		{
			$('#evarianterror').html('<span>Please select sub category</span>');
		}
		else
		{
			$('#evarianterror').html('');
		}
		if (editpropurchasedate==""){
			$('#epdateerror').html('<span>Please enter purchase date</span>');
		}
		else
		{
			$('#epdateerror').html('');
		}
		if(editpropurchase_value=="")
		{
			$('#epvalueerror').html('<span>Please enter purchase value</span>');
		}
		else{
			$('#epvalueerror').html('');
		}
		if (editproother_charge=="")
		{
			$('#eotherchargeerror').html('<span>Please enter other charges</span>');
		}
		else
		{
			$('#eotherchargeerror').html('');
		}

		if (editprowarrantydate==""){
			$('#ewperioderror').html('<span>Please enter warranty date</span>');
		}
		else
		{
			$('#ewperioderror').html('');
		}
		if(editprobillnumber=="")
		{
			$('#ebillnoerror').html('<span>Please enter bill number</span>');
		}
		else
		{
			$('#ebillnoerror').html('');
		}

	   if(editproserialno=="")
		{
			$('#emsnerror').html('<span>Please enter serial number</span>');
		}
		else if(editproserialno.length < min)
		{
			$('#emsnerror').html('<span>Please enter atleast 4 digit serial number</span>');
		return false;
		}
		else
		{
			$('#emsnerror').html('');
		}


	   var b = $("#optionsRadios1").is(":checked");

		if(b)
		{
			if(editprosubcategoryproduct=='' || editproproductvariant=='' || editpropurchasedate=='' || editpropurchase_value=='' || editproother_charge=='' || editproserialno=='' || editprowarrantydate=='' || editprobillnumber=='')
			{
				return false;
			}
		}
		else
		{
			if(editprosubcategoryproduct=='' || editproproductvariant=='' || editpropurchasedate=='' || editpropurchase_value=='' || editproother_charge=='' || editproserialno=='' || editprowarrantydate=='' || editprobillnumber=='' || editprorentpurchasedate=='' || editprorendpurchase_value=='' )
		{
			return false;
		}
		}






	    var formData = new FormData($("form#editproductupdateform")[0]);
	    $.ajax({
	        url: "config/editproductdetails.php",
	        type: 'POST',
	        data: formData,
	        async: false,
	        success: function (data) {
	             $("#listofproductable").show();
					$("#editdetailsshow").hide();

			$("#imageothers").empty();
			$("#dispyproductimages").empty();
	        },
	        cache: false,
	        contentType: false,
	        processData: false
	    });
	    return false;
	}


//Payments Section

//Transport expense

$(".traproductlistdelete").click(function(){
     $(this).closest('tr').remove();
     return false;
 });


function transport_product(product,productid){
		var product = product.value;
		//console.log(productid);
		$.ajax({
			url:'config/productadd.php',
			data:{
					"productid" : product,
					"type" : "trcustidgot"
				},
			type:"post",
			success:function(data)
			{
				var data = JSON.parse(data);
				$("#transport_id"+productid).val(data[0].customer_id);
			}
		});
};


function transadd(){
	event.preventDefault();
    var formData = new FormData($("form#trannsportprocess")[0]);

	var datepicker13 =  $("#datepicker13").val();
	var transport_amount =  $("#transport_amount").val();
	var transport_remark =  $("#transport_remark").val();
	var driverid =  $("#driverid").val();
	var license =  $("#license").val();
	var validtill =  $("#validtill").val();
	var transport_product1 =  $("#transport_product1").val();
	var transport_id1 =  $("#transport_id1").val();


		if (datepicker13==""){
			$('#datepicker13error').html('<span>Please enter date of transport</span>');
		}
		else
		{
			$('#datepicker13error').html('');
		}
		if(transport_amount=="")
		{
			$('#transport_amounterror').html('<span>Please enter transport amount</span>');
		}
		else{
			$('#transport_amounterror').html('');
		}
		if(transport_remark==""){
			$('#transport_remarkerror').html('<span>Please enter about transport</span>');
		}
		else
		{
			$('#transport_remarkerror').html('');
		}
		if(driverid==""){
				$('#driveriderror').html('<span>Please enter driver ID</span>');
		}
		else
		{
			$('#driveriderror').html('');
		}
		if(license=="")
		{
			$('#licenseerror').html('<span>Please enter your license</span>');
		}
		else{
			$('#licenseerror').html('');
		}
		if(validtill==""){
			$('#validtillerror').html('<span>Please enter valid till date</span>');
		}
		else
		{
			$('#validtillerror').html('');
		}
		if(transport_product1=="")
		{
			$('#transport_product1error').html('<span>Please enter transport product</span>');
		}
		else{
			$('#transport_product1error').html('');
		}
		if(transport_id1=="")
		{
			$('#transport_id1error').html('<span>Please enter transport id</span>');
		}
		else{
			$('#transport_id1error').html('');
		}


		if(datepicker13=='' || transport_amount=='' || transport_remark=='' || driverid=='' || license=='' || validtill=='' || transport_product1=='' || transport_id1==''  )
		{
			return false;
		}



    $.ajax({
        url: "config/transportprocess.php",
        type: 'POST',
        data: formData,
        async: false,
        success: function (data) {
            // alert(data);
            $('form#trannsportprocess')[0].reset();
        },
        cache: false,
        contentType: false,
        processData: false
    });
    return false;
};

/**** Service Request ****/

function gotprodtforcusts(customblid)
{
	var custmblid = customblid.value.length;

	var customermblid =  $("#customermblid").val();
	var min = 6;
	var max = 10;

		if (customermblid==""){
			$('#customererror').html('<span>Please enter customer id</span>');
		}
		else
		{
			$('#customererror').html('');
		}

	if(custmblid == 10)
	{
		$('#serviceproductlistcus tbody').remove();
		var mblnum = customblid.value;
		$.ajax({
			url:'config/productadd.php',
			data:{
					"mobilenum" : mblnum,
					"type" : "gotproductforser1"
				},
			type:"post",
			success:function(data)
			{
				var data = JSON.parse(data);

				  for (var i=0; i<data.length; i++) {
				  		var id = data[i].product_id;
				  		var cid = data[i].customer_id;

				  		var statusdetails ='';
				  		if(data[i].service_status ==1)
				  		{
				  		statusdetails = '<a data-toggle="modal" data-target="#serviceclosemodal" onClick="closeservice(\''+ id +'\')">Close</a>';
				  		}
				  		else
				  		{
				  			statusdetails ='<a data-toggle="modal" data-target="#serviceinitmodal" onClick="initiateservice(\''+ id +'\',\''+ cid +'\')">Initiate</a>';
				  		}
				  		var row = $('<tr><td>' + data[i].customer_id+ '</td><td>' + data[i].product_id + '</td><td>'+ statusdetails +'</td></tr>');
						$('#serviceproductlistcus').append(row);
					}
			}
		});
	}
	else
	{
		$('#serviceproductlistcus tbody').remove();
		var custmid = customblid.value;
		$.ajax({
			url:'config/productadd.php',
			data:{
					"customerid" : custmid,
					"type" : "gotproductforser2"
				},
			type:"post",
			success:function(data)
			{
				var data = JSON.parse(data);

				  for (var i=0; i<data.length; i++) {
				  		var id = data[i].product_id;
				  		var cid = data[i].customer_id;

				  		var statusdetails ='';
				  		if(data[i].service_status ==1)
				  		{
				  		statusdetails = '<a data-toggle="modal" data-target="#serviceclosemodal" onClick="closeservice(\''+ id +'\')">Close</a>';
				  		}
				  		else
				  		{
				  			statusdetails ='<a data-toggle="modal" data-target="#serviceinitmodal" onClick="initiateservice(\''+ id +'\',\''+ cid +'\')">Initiate</a>';
				  		}
				  		var row = $('<tr><td>' + data[i].customer_id+ '</td><td>' + data[i].product_id + '</td><td>'+ statusdetails +'</td></tr>');
						$('#serviceproductlistcus').append(row);
					}
			}
		});
	}
}

function gotprodtidforcusts(productid)
{

		$('#serviceproductlistcus tbody').remove();

		var prdtid = productid.value;


		var productid =  $("#productid").val();

		if (productid==""){
			$('#producterror').html('<span>Please enter product id</span>');
		}
		else
		{
			$('#producterror').html('');
		}




		$.ajax({
			url:'config/productadd.php',
			data:{
					"productid" : prdtid,
					"type" : "gotproductforser3"
				},
			type:"post",
			success:function(data)
			{
				var data = JSON.parse(data);

				  for (var i=0; i<data.length; i++) {
				  		var id = data[i].product_id;
				  		var cid = data[i].customer_id;

				  		var statusdetails ='';
				  		if(data[i].service_status ==1)
				  		{
				  		statusdetails = '<a data-toggle="modal" data-target="#serviceclosemodal" onClick="closeservice(\''+ id +'\')">Close</a>';
				  		}
				  		else
				  		{
				  			statusdetails ='<a data-toggle="modal" data-target="#serviceinitmodal" onClick="initiateservice(\''+ id +'\',\''+ cid +'\')">Initiate</a>';
				  		}
				  		var row = $('<tr><td>' + data[i].customer_id+ '</td><td>' + data[i].product_id + '</td><td>'+ statusdetails +'</td></tr>');
						$('#serviceproductlistcus').append(row);
					}
			}
		});
}


function serviceinitiaprocess(){
	event.preventDefault();
    var serviceinitiativdate =  $("#serviceinitiativdate").val();
	var serviceproductid =  $("#serviceproductid").val();
	var serviceissue =  $("#serviceissue").val();
	var servicecustid =  $("#servicecustid").val();
	var serviceremarks =  $("#serviceremarks").val();



	if (serviceinitiativdate==""){
			$('#serviceiniterror').html('<span>Please enter service initiate date</span>');
		}
		else
		{
			$('#serviceiniterror').html('');
		}
		if (serviceissue==""){
			$('#serviceissueerror').html('<span>Please enter service issue</span>');
		}
		else
		{
			$('#serviceissueerror').html('');
		}
		if (serviceremarks==""){
			$('#serviceremarkserror').html('<span>Please enter service remarks</span>');
		}
		else
		{
			$('#serviceremarkserror').html('');
		}


		if(serviceinitiativdate=='' || serviceissue=='' || serviceremarks=='' )
		{
			return false;
		}


	$.ajax({
			url:'config/productadd.php',
			data:{
					"type" : "serviceadd",
					"serviceinitiativdate" : serviceinitiativdate,
					"serviceproductid" : serviceproductid,
					"serviceissue" : serviceissue,
					"servicecustid" : servicecustid,
					"serviceremarks" : serviceremarks
				},
			type:"post",
			success:function(data)
			{
				// alert("Service has been Added");
				$("#srclosed").html("");
				$("#sradd").html("Service requst details has been added").css("color");
				$("#srmodal").modal();

				$('#serviceinitmodal').modal('toggle');
				$("#customermblid").val("");
				$("#productid").val("");
				$('#serviceproductlistcus tbody').remove();
                location.reload();
			}
		});
};


	function initiateservice(produid,cusid) {
	event.preventDefault();
	$("#serviceproductid").val(produid);
	$("#servicecustid").val(cusid);
	}

	function closeservice(produid) {
	event.preventDefault();
	$("#serviceproductidclose").val(produid);
	employeelist();employeelist1();employeelist2();
	}


function servicecloseprocess(){
	//event.preventDefault();
    var serviced_by =  $("#serviced_by").val();
	var serviceproductidclose =  $("#serviceproductidclose").val();
	var service_amount =  $("#service_amount").val();
	var servicefrom_date =  $("#servicefrom_date").val();
	var serviceto_date =  $("#serviceto_date").val();
	var iswaiver = $("#iswaiver").is(":checked");
		if (iswaiver) {
               iswaiver = 1;
            } else {
                iswaiver = 0;
            }
    var servicewaiver_from_date =  $("#servicewaiver_from_date").val();
	var waiver_to_date =  $("#waiver_to_date").val();
	var customerfeetback = $('#customerfeetback').val();
	var ispaid = $("#ispaid").is(":checked");
		if (ispaid) {
               ispaid = 1;
            } else {
                ispaid = 0;
            }

	var received_ammout =  $("#received_ammout").val();
	var paymentmode =  $("#paymentmode").val();
	var colected_on =  $("#colected_on").val();

	var collectedby =  $("#collectedby").val();
	var deposit_on =  $("#deposit_on").val();
	var deposit_by =  $("#deposit_by").val();



		if (service_amount==""){
			$('#service_amounterror').html('<span>Please enter service amount</span>');
		}
		else
		{
			$('#service_amounterror').html('');
		}
		if (servicefrom_date==""){
			$('#servicefrom_dateerror').html('<span>Please enter service from date</span>');
		}
		else
		{
			$('#servicefrom_dateerror').html('');
		}
		if (serviceto_date==""){
			$('#serviceto_dateerror').html('<span>Please enter service to date</span>');
		}
		else
		{
			$('#serviceto_dateerror').html('');
		}
		if($('#iswaiver').prop('checked')== true)
		{
			if (servicewaiver_from_date==""){
				$('#servicewaiver_from_dateerror').html('<span>Please enter service waiver from date </span>');
			}
			else
			{
				$('#servicewaiver_from_dateerror').html('');
			}
			if (waiver_to_date==""){
				$('#waiver_to_dateerror').html('<span>Please enter waiver to date </span>');
			}
			else
			{
				$('#waiver_to_dateerror').html('');
			}
		}
		else
		{
			$('#servicewaiver_from_dateerror').html('');
			$('#waiver_to_dateerror').html('');
		}
		if($('#ispaid').prop('checked')== true)
		{
			if (customerfeetback==""){
				$('#customerfeederror').html('<span>Please enter customer feedback</span>');
			}
			else
			{
				$('#customerfeederror').html('');
			}
			if (received_ammout==""){
				$('#received_ammouterror').html('<span>Please enter received amount</span>');
			}
			else
			{
				$('#received_ammouterror').html('');
			}
			if (colected_on==""){
				$('#colected_onerror').html('<span>Please enter collected on</span>');
			}
			else
			{
				$('#colected_onerror').html('');
			}
			if (deposit_on==""){
				$('#deposit_onerror').html('<span>Please enter deposit on</span>');
			}
			else
			{
				$('#deposit_onerror').html('');
			}
		}
		else
		{
			$('#customerfeederror').html('');
			$('#received_ammouterror').html('');
			$('#colected_onerror').html('');
			$('#deposit_onerror').html('');
		}
		if($('#iswaiver').prop('checked')== true && $('#ispaid').prop('checked')== true)
	    {
			// alert("1");

			if(service_amount=='' || servicefrom_date=='' || serviceto_date=='' || servicewaiver_from_date=='' || waiver_to_date=='' || customerfeetback==''|| received_ammout==''|| colected_on==''|| deposit_on=='' )
			{
				return false;
			}
		}
		else if($('#iswaiver').prop('checked')== true)
	    {
			// alert("2");

			if(service_amount=='' || servicefrom_date=='' || serviceto_date=='' || servicewaiver_from_date=='' || waiver_to_date=='' )
			{
				return false;
			}
		}
		else if($('#ispaid').prop('checked')== true)
	    {
			// alert("3");

			if(service_amount=='' || servicefrom_date=='' || serviceto_date=='' || customerfeetback==''|| received_ammout==''|| colected_on==''|| deposit_on=='' )
			{
				return false;
			}
		}
		else
	    {
			// alert("4");
			if(service_amount=='' || servicefrom_date=='' || serviceto_date=='' )
			{
				return false;
			}
		}




	$.ajax({
			url:'config/productadd.php',
			data:{
					"type" : "serviceclose",
					"serviced_by" : serviced_by,
					"serviceproductidclose" : serviceproductidclose,
					"service_amount" : service_amount,
					"servicefrom_date" : servicefrom_date,
					"serviceto_date" : serviceto_date,
					"iswaiver" : iswaiver,
					"servicewaiver_from_date" : servicewaiver_from_date,
					"waiver_to_date" : waiver_to_date,
					"customerfeetback" : customerfeetback,
					"ispaid" : ispaid,
					"received_ammout" : received_ammout,
					"paymentmode" : paymentmode,
					"colected_on" : colected_on,
					"collectedby" : collectedby,
					"deposit_on"	: deposit_on,
					"deposit_by" : deposit_by
				},
			type:"post",
			success:function(data)
			{
				//console.log(data);
				$('#serviceclosemodal').modal('toggle');
				$('form#servicecloseprocess')[0].reset();
				$("#customermblid").val("");
				$("#productid").val("");
				$('#serviceproductlistcus tbody').remove();
				// alert("service closed");
				$("#sradd").html("");
				$("#srclosed").html("Service closed").css("color");
				$("#srmodal").modal();
			}
		});
		location.reload();
};

 $("#Uploadbillimg").change(function () {
	    var lg = $(this).get(0).files.length;
		var items = $(this).get(0).files;
		var fileSize = 0;

		if( lg > 1)
		{
			if (lg > 2){
				$("#billimgerror").html("You can only upload a maximum of 2 files");
				$("#billimages").html("");
				$('#Uploadbillimg').val('');
			}
			else{
				$("#billimgerror").html("");
			}
		}

		if (lg > 0) {
               for (var i = 0; i < lg; i++) {
                   fileSize = fileSize+items[i].size;
               }
               if(fileSize > 2097152) {
					$("#filesizeberror").html("File size must not be more than 2 MB");
                    $('#Uploadbillimg').val('');
				}
		}

        var fileExtension = ['jpeg', 'jpg', 'png', 'gif', 'bmp'];
        if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
			$("#typebillimgerror").html("Only formats are allowed : "+fileExtension.join(', '));
        }
		else{
			$("#typebillimgerror").html("");
		}

		if( ($('#billimgerror').html() == "") && ($('#filesizeberror').html() == "") && ($('#typebillimgerror').html() == ""))
		{
			var fd = new FormData();
			var file_data = $('#Uploadbillimg')[0].files; // for multiple files
			for(var i = 0;i< file_data.length;i++){
				fd.append("file_"+i, file_data[i]);
			}
			var other_data = file_data.length;
			fd.append("lengthofbill",other_data);
			fd.append("imagestype",1);

			$.ajax({
					url:'config/billimageupload.php', // point to server-side PHP script
					dataType: 'text',  // what to expect back from the PHP script, if anything
					cache: false,
					contentType: false,
					processData: false,
					data: fd,
					type: 'post',
					success: function(data){
						//console.log(data); // display response from the PHP script, if any
					}
			});
		}
		else
		{
			// alert("thu");
		}


    });


$("#uploadproductimages").change(function () {
	    var lg = $(this).get(0).files.length;
		var items = $(this).get(0).files;
		var fileSize = 0;

		if( lg > 1)
		{
			if (lg > 6){
				$("#productimgerror").html("You can only upload a maximum of 6 files");
				$('#uploadproductimages').val('');
				$("#productimages").html("");
			}
			else{
				$("#productimgerror").html("");
			}
		}

		if (lg > 0) {
               for (var i = 0; i < lg; i++) {
                   fileSize = fileSize+items[i].size;
               }
               if(fileSize > 2097152) {
					$("#filesizeperror").html("File size must not be more than 2 MB");
                    $('#uploadproductimages').val('');
					$("#productimages").html("");
				}
				else{
					$("#filesizeperror").html("");
				}
		}

        var fileExtension = ['jpeg', 'jpg', 'png', 'gif', 'bmp'];
        if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
			$("#typeproductimgerror").html("Only formats are allowed : "+fileExtension.join(', '));
			$('#uploadproductimages').val('');
			$("#productimages").html("");
        }
		else{
			$("#typeproductimgerror").html("");
		}

		if( ($('#typeproductimgerror').html() == "") && ($('#filesizeperror').html() == "") && ($('#productimgerror').html() == ""))
		{
			var fd = new FormData();
			var file_data = $('#uploadproductimages')[0].files; // for multiple files
			for(var i = 0;i< file_data.length;i++){
				fd.append("file_"+i, file_data[i]);
			}
			var other_data = file_data.length;
			fd.append("lengthofbill",other_data);
			fd.append("imagestype",0);

			$.ajax({
					url:'config/billimageupload.php', // point to server-side PHP script
					dataType: 'text',  // what to expect back from the PHP script, if anything
					cache: false,
					contentType: false,
					processData: false,
					data: fd,
					type: 'post',
					success: function(data){
					//	console.log(data); // display response from the PHP script, if any
					}
			});
		}
		else
		{
			//alert("thu");
		}

    });

	var dew = 0;
$(document).on('change',"input[type='date']",function(event) {
	var a = $(this).val();
    var arr = a.split("-");

	if(parseInt(arr[0]) > 2050)
	{
		$(this).val(dew);

	}
	else
	{
		dew = a;

	}
	 if(arr[0].length <= 4)
	{
		dew = a;
	}
	else
	{
		$(this).val(dew);
	}
});

$(document).on('keypress',"input[placeholder='Phone ']",function(event) {
	if($(this).val().length > 9)
	{
		return false;
	}
	  var charCode = (event.which) ? event.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
});

$(document).on('keypress',"input[placeholder='Mobile']",function(event) {
	if($(this).val().length > 9)
	{
		return false;
	}
	  var charCode = (event.which) ? event.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
});
