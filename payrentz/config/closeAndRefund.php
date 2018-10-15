<?php
  require_once('config.php');
  @$type = $_POST['type'];
  @$p_id = $_POST['p_id'];
  @$c_date = $_POST['c_date'];
  @$remark = $_POST['remark'];
  @$rent = $_POST['rent'];
  @$a_ren = $_POST['a_ren'];
  @$r_pend = $_POST['r_pend'];
  @$refund = $_POST['refund'];
  @$c_id = $_POST['c_id'];
  @$cust_id = $_POST['cust_id'];
  if ($cust_id) {
      $c_id = $cust_id;
  }
  if ($type == "close") {
      $t       = date('d-m-Y');
      $c_m     = date("m", strtotime($t));
      $c_y     = date("y", strtotime($t));
      $t_d     = cal_days_in_month(CAL_GREGORIAN, $c_m, $c_y);
      $per_day = $rent / $t_d;
      $t       = date($c_date);
      $c_d     = date("d", strtotime($t));
      $c_d     = $c_d;
      $r_c     = $c_d * $per_day;
      if ($c_d < 8) {
          $t_c = $r_c + $a_ren;
      } else {
          $t_c = $r_c;
      }
     
      $getPendingCost      = $functs->getPendingCost($c_id);

 
      if (isset($getPendingCost[0]["received_total_rent_cost"])) {
          $revAmt = $getPendingCost[0]["received_total_rent_cost"];
      } else {
          $revAmt = 0;
      }

      $update       = array(
          'closure_remark' => $remark,
          'closure_date' => $c_date,
          "rent_cost" => $r_c,
          'is_closure' => 1,
          "tax" => 0
      );
      $where_clause = array(
          'product_id' => $p_id
      );
      $updated      = $functs->update('mapping_table', $update, $where_clause);

       $isHaveMappedProduct = $functs->isHaveMappedProductFn($c_id);
      $remove_type = 1;
      if (count($isHaveMappedProduct) > 0) {
          $remove_type = 0;
      }

      $pen          = $a_ren;
      $cus_detail   = $functs->particularCusGenDetailFn($c_id, 1);
      $prev_pend    = $cus_detail[0]["pending_cost"] + $pen;
      $revAmt       = $cus_detail[0]["extra_amount"] + $revAmt;
      $update       = array(
          'pending_cost' => $prev_pend,
          'remove_type' => $remove_type,
          'extra_amount' => $revAmt,
          'closed_on'=>$c_date
      );
      $where_clause = array(
          'customer_id' => $c_id
      );
      $updated      = $functs->update('customer_general_detail', $update, $where_clause);
      $update       = array(
          'total_rent_cost' => "total_rent_cost - $a_ren"
      );
      $where_clause = array(
          'customer_id' => $c_id
      );
      $updated      = $functs->update('invoice', $update, $where_clause);
      $delete_where = array(
          'total_rent_cost' => " < 5"
      );
      $table_name   = 'invoice';
      $functs->deletefn($delete_where, $table_name);
  }
  if ($type == "refund") {
      if ($refund > 0) {
          $pen = 0;
      } else {
          $pen = preg_replace("/-/", "", $refund);
      }
      $update       = array(
          'refund_remark' => $remark,
          'refund_amount' => $refund,
          "pending_minus" => $r_pend,
          'removed_status' => 1,
          'refund_status' => 1
      );
      $where_clause = array(
          'product_id' => $p_id
      );
      $updated      = $functs->update('mapping_table', $update, $where_clause);
      $update       = array(
          'pending_cost' => $pen
      );
      $where_clause = array(
          'customer_id' => $c_id
      );
      $updated      = $functs->update('customer_general_detail', $update, $where_clause);
  }
?>
