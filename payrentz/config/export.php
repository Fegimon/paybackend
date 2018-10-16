<?php
	$db_name="paytrentz1";
	$conn = mysqli_connect("localhost", "root", "", $db_name);
	//mysqli_select_db("payrentz",$conn);
	@$stat = $_POST['stat'];
	@$page = $_POST['page'];
	@$type = $_POST['type'];
	$today = date('h-i-s');
	@$year = $_POST['year'];
	@$repbrand = $_POST['repbrand'];
	@$repvendor = $_POST['repvendor'];
	@$r_year = $_POST['r_year'];

	//customer
	if($type == 'general')
	{
		$table ='customer_general_detail';
    if($year)
		{
			$querys ="SELECT * FROM customer_general_detail where customer_status='1' and e_type='0'";
		}
		else
		{
			$querys ="SELECT * FROM customer_general_detail where customer_status='1' and e_type='0'";
		}
		$filename = "Customer General Detail List $today.csv";
	}
	if($type == 'address')
	{
		$table ='customer_address';
		$querys ="SELECT * FROM customer_address as a inner JOIN customer_general_detail as b ON a.customer_id = b.customer_id where b.customer_status='1' and b.e_type='0'";
		$filename = "Customer address Detail List $today.csv";
	}
	if($type == 'contact')
	{
		$table ='customer_contact';
		$querys ="SELECT * FROM customer_contact as a    LEFT JOIN customer_general_detail as b ON a.customer_id = b.customer_id where b.customer_status='1' and b.e_type='0'";
		$filename = "Customer Contact Detail List $today.csv";
	}
	if($type == 'reference')
	{
		$table ='customer_reference_detail';
		$querys ="SELECT * FROM customer_reference_detail as a   LEFT JOIN customer_general_detail as b ON a.customer_id = b.customer_id where b.customer_status='1' and b.e_type='0'";
		$filename = "Customer Refernce Detail List $today.csv";
	}
	if($type == 'rent')
	{
		$a="";
		if($repbrand)
		{
			$a .=" and p.brand='$repbrand'";
		}
		if($repvendor)
		{
			$a .="and p.vendor='$repvendor'";
		}
		if($r_year)
		{
			$a .="and a.year='$r_year'";
		}
		$table ='rent_history';
		$querys ="SELECT * FROM rent_history as a LEFT JOIN customer_general_detail as b ON a.customer_id = b.customer_id left join product as p on p.product_id= a.product_id where b.customer_status='1' and e_type='0' ".$a."  ";
		$filename = "Customer Rent History Detail List $today.csv";
	}
	if($type == 'current')
	{
		$table ='mapping_table';
		if($year)
		{
			$querys ="SELECT * FROM mapping_table where mapped_status='1' and is_closure='0' and r_year='$year'";
		}
		else
		{
			$querys ="SELECT * FROM mapping_table where mapped_status='1' and is_closure='0'";
		}
		$filename = "Current Product List $today.csv";
	}
	if($type == 'refund')
	{
		$table ='mapping_table';
		$querys ="SELECT * FROM mapping_table where  is_closure='1' and refund_status='0'";
		$filename = "Current Refund List $today.csv";
	}
	if($type == 'closed')
	{
		$table ='mapping_table';
		if($year)
		{
			$querys ="SELECT * FROM mapping_table as a LEFT JOIN customer_general_detail as b ON a.customer_id = b.customer_id where b.customer_status='1' and b.e_type='1' and a.mapped_status='1' and a.is_closure='1' and a.refund_status='0' and c_year='$year'";
		}
		else
		{
	  	$querys ="SELECT * FROM mapping_table as a LEFT JOIN customer_general_detail as b ON a.customer_id = b.customer_id where b.customer_status='1' and b.e_type='1' and a.mapped_status='1' and a.is_closure='1' and a.refund_status='0'";
		}
		$filename = "Current Closed List $today.csv";
	}

	//closed _list
	if($type == 'cgeneral')
	{
		$table ='customer_general_detail';
		$querys ="SELECT * FROM customer_general_detail where customer_status='1' and e_type='1'";
		$filename = "Closed Customer General Detail List $today.csv";
	}
	if($type == 'caddress')
	{
		$table ='customer_address';
		$querys ="SELECT * FROM customer_address as a LEFT JOIN customer_general_detail as b ON a.customer_id = b.customer_id where b.customer_status='1' and b.e_type='1'";
		$filename = "Closed Customer address Detail List $today.csv";
	}
	if($type == 'ccontact')
	{
		$table ='customer_contact';
		$querys ="SELECT * FROM customer_contact as a    LEFT JOIN customer_general_detail as b ON a.customer_id = b.customer_id where b.customer_status='1' and b.e_type='1'";
		$filename = "Closed Customer Contact Detail List $today.csv";
	}
	if($type == 'creference')
	{
		$table ='customer_reference_detail';
		$querys ="SELECT * FROM customer_reference_detail as a   LEFT JOIN customer_general_detail as b ON a.customer_id = b.customer_id where b.customer_status='1' and b.e_type='1'";
		$filename = "Closed Customer Refernce Detail List $today.csv";
	}
	if($type == 'crent')
	{
		$table ='rent_history';
		$querys ="SELECT * FROM rent_history as a LEFT JOIN customer_general_detail as b ON a.customer_id = b.customer_id where b.customer_status='1' and e_type='1'  ";
		$filename = "Closed Customer Rent History Detail List $today.csv";
	}
	if($type == 'cclosed')
	{
		$table ='mapping_table';
		if($year)
		{
			$querys ="SELECT * FROM mapping_table as a LEFT JOIN customer_general_detail as b ON a.customer_id = b.customer_id where b.customer_status='1' and b.e_type='1' and a.mapped_status='1' and a.is_closure='1' and a.refund_status='1' and close_year ='$year'";
		}
		else
		{
	    $querys ="SELECT * FROM mapping_table as a LEFT JOIN customer_general_detail as b ON a.customer_id = b.customer_id where b.customer_status='1' and b.e_type='1' and a.mapped_status='1' and a.is_closure='1' and a.refund_status='1' ";
		}
		$filename = "Current Closed List $today.csv";
	}

	//Non Customer
	if($type == 'egeneral')
	{
		$table ='customer_general_detail';
		if($year)
		{
			$querys ="SELECT * FROM customer_general_detail where customer_status='0' and year ='$year'";
		}
		else
		{
	    $querys ="SELECT * FROM customer_general_detail where customer_status='0' and year ='$year'";
		}
		$filename = "New Customer General Detail List $today.csv";
	}
	if($type == 'eaddress')
	{
		$table ='customer_address';
		$querys ="SELECT * FROM customer_address where enquiry_id  LIKE 'e%'";
		$filename = "New Customer Address Detail List $today.csv";
	}
	if($type == 'econtact')
	{
		$table ='customer_contact';
		$querys ="SELECT * FROM customer_contact where enquiry_id  LIKE 'e%'";
		$filename = "New Customer Contact Detail List $today.csv";
	}
	if($type == 'ereference')
	{
		$table ='customer_reference_detail';
		$querys ="SELECT * FROM customer_reference_detail where enquiry_id  LIKE 'e%'";
		$filename = "New Customer Refernce Detail List $today.csv";
	}

	//Enquiry List
	if($type == 'enq')
	{
		$table ='enquiries';
		$querys ="SELECT * FROM enquiries where enquiry_status='0' and is_closed='0'";
		$filename = "New Enquireis General Detail List $today.csv";
	}
	if($type == 'enq_produt')
	{
		$table ='enquiry_products';
		$querys ="SELECT * FROM enquiry_products as b LEFT JOIN enquiries as a ON b.enquiry_id = a.enquiry_id where a.enquiry_status='0' and a.is_closed='0'; ";
		$filename = "New Enquireis Product Detail List $today.csv";
	}

	//Verified Enquiry List
	if($type == 'venq')
	{
		$table ='enquiries';
		$querys ="SELECT * FROM enquiries where enquiry_status='1' and is_closed='0'";
		$filename = "Verified Enquireis General Detail List $today.csv";
	}
	if($type == 'venq_produt')
	{
		$table ='enquiry_products';
		$querys ="SELECT * FROM enquiry_products as b LEFT JOIN enquiries as a ON b.enquiry_id = a.enquiry_id where a.enquiry_status='1' and a.is_closed='0'; ";
		$filename = "Verified Enquireis Product Detail List $today.csv";
	}

	//rejected enquiries
	if($type == 'renq')
	{
		$table ='enquiries';
		$querys ="SELECT * FROM enquiries where is_closed='1'";
		$filename = "Verified Enquireis General Detail List $today.csv";
	}
	if($type == 'renq_produt')
	{
		$table ='enquiry_products';
		$querys ="SELECT * FROM enquiry_products as b LEFT JOIN enquiries as a ON b.enquiry_id = a.enquiry_id where  a.is_closed='1'; ";
		$filename = "Verified Enquireis Product Detail List $today.csv";
	}

	//product details
	if($type == 'product')
	{
		$table ='product';
		if($year)
		{
			$querys ="SELECT * FROM product where year='$year'";
		}
		else
		{
			$querys ="SELECT * FROM product ";
		}
		$filename = "Product Detail List $today.csv";
	}

	//invoice
	if($type == 'invoice')
	{
		$table ='invoice';
		$querys ="SELECT * FROM invoice";
		$filename = "Invoice Detail List $today.csv";
	}

	//service
	if($type == 'service')
	{
		$table ='service_table';
		$querys ="SELECT * FROM service_table where is_serviced='0'";
		$filename = "Current Service Detail List $today.csv";
	}
	if($type == 'cservice')
	{
		$table ='service_table';
		$querys ="SELECT * FROM service_table where is_serviced='1'";
		$filename = "Closed Service Detail List $today.csv";
	}

	//return list
	if($type == 'return')
	{
		$table ='service_table';
		$querys ="SELECT * FROM mapping_table where mapped_status='1' and is_returned='1'";
		$filename = "Return List $today.csv";
	}

	//transport list
	if($type == 'tranport')
	{

		$table ='transport_expenses';
		$querys ="SELECT * FROM transport_expenses ";
		$filename = "Tranport Detail List $today.csv";
	}
	if($type == 'gen_expence')
	{
		$table ='general_expenses';
		$querys ="SELECT * FROM general_expenses ";
		$filename = "General Expenses Detail List $today.csv";
	}

	//customer
	if($type == 'cus_map_product')
	{
		$table ='mapping_table';
		$querys ="SELECT * FROM `mapping_table` WHERE `mapped_status`=1 and `refund_status`=0 and `is_closure`=0 and `customer_id`='$stat'";
		$filename = "$stat Current Product List $today.csv";
	}
	if($type == 'cus_enq_product')
	{
		$table ='enquiry_products';
		$querys ="SELECT * FROM `enquiry_products` WHERE `customer_id`='$stat'";
		$filename = "$stat Enquiry List $today.csv";
	}
	if($type == 'cus_pay_product')
	{
		$table ='general_expenses';
		$querys ="SELECT * FROM general_expenses where  customer_id ='$stat'";
		$filename1 = "General Expenses Detail List $today.csv";
		$fp = fopen($filename1, 'w');
		$query = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA='$db_name' AND TABLE_NAME='$table'";
		$result = mysqli_query($conn, $query);
		while ($row = mysqli_fetch_row($result)) {
			$header1[] = $row[0];
		}
		header('Content-type: application/csv');
		header('Content-Disposition: attachment; filename='.$filename1);
		fputcsv($fp, $header1);
		$num_column = count($header1);
		$query =$querys;
		$result = mysqli_query($conn, $query);
		while($row = mysqli_fetch_row($result)) {
			fputcsv($fp, $row);
		}
		$table ='rent_history';
		$querys ="SELECT * FROM `rent_history` where  customer_id ='$stat'";
		$filename2 = "Rent History $today.csv";
		$fp = fopen($filename2, 'w');
		$query = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA='$db_name' AND TABLE_NAME='$table'";
		$result = mysqli_query($conn, $query);
		while ($row = mysqli_fetch_row($result)) {
			$header2[] = $row[0];
		}
		header('Content-type: application/csv');
		header('Content-Disposition: attachment; filename='.$filename2);
		fputcsv($fp, $header2);
		$num_column = count($header2);
		$query =$querys;
		$result = mysqli_query($conn, $query);
		while($row = mysqli_fetch_row($result)) {
			fputcsv($fp, $row);
		}
    $table ='service_table';
		$querys ="SELECT * FROM `service_table` WHERE `customer_id`='$stat'";
		$filename3 = "Service History $today.csv";
		$fp = fopen($filename3, 'w');
		$query = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA='$db_name' AND TABLE_NAME='$table'";
		$result = mysqli_query($conn, $query);
		while ($row = mysqli_fetch_row($result)) {
			$header3[] = $row[0];
		}
		header('Content-type: application/csv');
		header('Content-Disposition: attachment; filename='.$filename3);
		fputcsv($fp, $header3);

		$num_column = count($header3);
		$query =$querys;
		$result = mysqli_query($conn, $query);
		while($row = mysqli_fetch_row($result)) {
			fputcsv($fp, $row);
		}
	 	$table ='deposit_money_transaction';
		$querys ="SELECT * FROM `deposit_money_transaction` WHERE `customer_id`='$stat'";
		$filename4 = "Deposit Payment History $today.csv";
		$fp = fopen($filename4, 'w');
		$query = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA='$db_name' AND TABLE_NAME='$table'";
		$result = mysqli_query($conn, $query);
		while ($row = mysqli_fetch_row($result)) {
			$header4[] = $row[0];
		}
		header('Content-type: application/csv');
		header('Content-Disposition: attachment; filename='.$filename4);
		fputcsv($fp, $header4);
		$num_column = count($header4);
		$query =$querys;
		$result = mysqli_query($conn, $query);
		while($row = mysqli_fetch_row($result)) {
			fputcsv($fp, $row);
		}
	 	$table ='transport_expenses';
		$querys ="SELECT * FROM `transport_expenses` WHERE `customer_id`='$stat'";
		$filename5 = "Transport Expenses $today.csv";
		$fp = fopen($filename5, 'w');
		$query = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA='$db_name' AND TABLE_NAME='$table'";
		$result = mysqli_query($conn, $query);
		while ($row = mysqli_fetch_row($result)) {
			$header5[] = $row[0];
		}
		header('Content-type: application/csv');
		header('Content-Disposition: attachment; filename='.$filename5);
		fputcsv($fp, $header5);
		$num_column = count($header5);
		$query =$querys;
		$result = mysqli_query($conn, $query);
		while($row = mysqli_fetch_row($result)) {
			fputcsv($fp, $row);
		}
		$files = array($filename1,$filename2,$filename3,$filename4,$filename5);
		$zipname = "$stat"."payment".$today.".zip";
		$zip = new ZipArchive;
		$zip->open($zipname, ZipArchive::CREATE);
		foreach ($files as $file) {
  		$zip->addFile($file);
		}
		$zip->close();
		echo $zipname;
		exit();
	}
	if($type == 'cus_refund_product')
	{
		$table ='mapping_table';
		$querys ="SELECT * FROM `mapping_table` WHERE  `refund_status`=0 and `customer_id`='$stat' and is_closure = 1";
		$filename = "$stat Refund  List $today.csv";
	}
	if($type == 'cus_ex_product_list')
	{
		$table ='mapping_table';
		$querys ="SELECT * FROM `mapping_table` WHERE `is_closure`=1 and `customer_id`='$stat' and refund_status =1";
		$filename = "$stat Closed product List $today.csv";
	}

	//product report
	if($type == 'pro_map_product')
	{
		$table ='mapping_table';
		$querys ="SELECT * FROM `mapping_table` WHERE `mapped_status`=1 and `refund_status`=0 and `is_closure`=0 and `product_id`='$stat'";
		$filename = "$stat Current Customer  $today.csv";
	}
	if($type == 'pro_enq_product')
	{
		$table ='enquiry_products';
		$querys ="SELECT * FROM `enquiry_products` WHERE `product_id`='$stat'";
		$filename = "$stat Enquiry List $today.csv";
	}
	if($type == 'pro_pay_product')
	{
		$table ='general_expenses';
		$querys ="SELECT * FROM general_expenses where  product_id ='$stat'";
		$filename1 = "General Expenses Detail List $today.csv";
		$fp = fopen($filename1, 'w');
		$query = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA='$db_name' AND TABLE_NAME='$table'";
		$result = mysqli_query($conn, $query);
		while ($row = mysqli_fetch_row($result)) {
			$header1[] = $row[0];
		}
		header('Content-type: application/csv');
		header('Content-Disposition: attachment; filename='.$filename1);
		fputcsv($fp, $header1);
		$num_column = count($header1);
		$query =$querys;
		$result = mysqli_query($conn, $query);
		while($row = mysqli_fetch_row($result)) {
			fputcsv($fp, $row);
		}
		$table ='rent_history';
		$querys ="SELECT * FROM `rent_history` where  product_id ='$stat'";
		$filename2 = "Rent History $today.csv";
		$fp = fopen($filename2, 'w');
		$query = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA='$db_name' AND TABLE_NAME='$table'";
		$result = mysqli_query($conn, $query);
		while ($row = mysqli_fetch_row($result)) {
			$header2[] = $row[0];
		}
		header('Content-type: application/csv');
		header('Content-Disposition: attachment; filename='.$filename2);
		fputcsv($fp, $header2);
		$num_column = count($header2);
		$query =$querys;
		$result = mysqli_query($conn, $query);
		while($row = mysqli_fetch_row($result)) {
			fputcsv($fp, $row);
		}
    $table ='service_table';
		$querys ="SELECT * FROM `service_table` WHERE `product_id`='$stat'";
		$filename3 = "Service History $today.csv";
		$fp = fopen($filename3, 'w');
		$query = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA='$db_name' AND TABLE_NAME='$table'";
		$result = mysqli_query($conn, $query);
		while ($row = mysqli_fetch_row($result)) {
			$header3[] = $row[0];
		}
		header('Content-type: application/csv');
		header('Content-Disposition: attachment; filename='.$filename3);
		fputcsv($fp, $header3);
		$num_column = count($header3);
		$query =$querys;
		$result = mysqli_query($conn, $query);
		while($row = mysqli_fetch_row($result)) {
			fputcsv($fp, $row);
		}
	 	$table ='deposit_money_transaction';
		$querys ="SELECT * FROM `deposit_money_transaction` WHERE `product_id`='$stat'";
		$filename4 = "Deposit Payment History $today.csv";
		$fp = fopen($filename4, 'w');
		$query = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA='$db_name' AND TABLE_NAME='$table'";
		$result = mysqli_query($conn, $query);
		while ($row = mysqli_fetch_row($result)) {
			$header4[] = $row[0];
		}
		header('Content-type: application/csv');
		header('Content-Disposition: attachment; filename='.$filename4);
		fputcsv($fp, $header4);
		$num_column = count($header4);
		$query =$querys;
		$result = mysqli_query($conn, $query);
		while($row = mysqli_fetch_row($result)) {
			fputcsv($fp, $row);
		}
	 	$table ='transport_expenses';
		$querys ="SELECT * FROM `transport_expenses` WHERE `product_id`='$stat'";
		$filename5 = "Transport Expenses $today.csv";
		$fp = fopen($filename5, 'w');
		$query = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA='$db_name' AND TABLE_NAME='$table'";
		$result = mysqli_query($conn, $query);
		while ($row = mysqli_fetch_row($result)) {
			$header5[] = $row[0];
		}
		header('Content-type: application/csv');
		header('Content-Disposition: attachment; filename='.$filename5);
		fputcsv($fp, $header5);
		$num_column = count($header5);
		$query =$querys;
		$result = mysqli_query($conn, $query);
		while($row = mysqli_fetch_row($result)) {
			fputcsv($fp, $row);
		}
		$files = array($filename1,$filename2,$filename3,$filename4,$filename5);
		$zipname = "$stat"."payment".$today.".zip";
		$zip = new ZipArchive;
		$zip->open($zipname, ZipArchive::CREATE);
		foreach ($files as $file) {
		  $zip->addFile($file);
		}
		$zip->close();
		echo $zipname;
		exit();
	}
	if($type == 'pro_ex_product_list')
	{
		$table ='mapping_table';
		$querys ="SELECT * FROM `mapping_table` WHERE `is_closure`=1 and `product_id`='$stat'";
		$filename = "$stat Closed product List $today.csv";
	}
	if($type != 'cus_pay_product')
	{
		$fp = fopen($filename, 'w');
		$query = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA='$db_name' AND TABLE_NAME='$table'";
		$result = mysqli_query($conn, $query);
		while ($row = mysqli_fetch_row($result)) {
			$header[] = $row[0];
		}
		header('Content-type: application/csv');
		header('Content-Disposition: attachment; filename='.$filename);
		fputcsv($fp, $header);
		$num_column = count($header);
		$query =$querys;
		$result = mysqli_query($conn, $query);
		while($row = mysqli_fetch_row($result)) {
			fputcsv($fp, $row);
		}
		echo $filename;
	}
?>
