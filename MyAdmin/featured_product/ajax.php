<?php
require(dirname(__FILE__).'/../../appcore/app-register.php');
$conn->check_admin();

//print_r($_GET); exit;
$json = array();

	if (isset($_GET['filter_name'])) {


		$product_list = $conn->select_query(PRODUCT, "*", "p_name LIKE '%".$_GET['filter_name']."%' AND p_status='Y'", "5");
		
		foreach ($product_list['result'] as $result) {
			$json[] = array(
					'product_id' => $result['p_id'],
					'name'       => strip_tags(html_entity_decode($result['p_name'], ENT_QUOTES, 'UTF-8')),
				);
		}
		
	}

	echo json_encode($json);
?>