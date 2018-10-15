<?php
require_once ('config.php');

session_start();
@$type = $_POST['type'];
@$year = $_POST['year'];

if ($type == 'gen')
	{
	$getreportYear = $functs->getreportYearfn($year);
	echo json_encode($getreportYear);
	}

if ($type == 'trend')
	{
	$getopenreport = $functs->getopenreportfn($year);
	$getaddreport = $functs->getaddreportfn($year);
	$getcloreport = $functs->getcloreportfn($year);
	$output = [];
	$output["open"] = $getopenreport;
	$output["add"] = $getaddreport;
	$output["clo"] = $getcloreport;
	echo json_encode($output);
	}

if ($type == 'product')
	{
	$getproreport = $functs->getproreportfn($year);
	$getmapreport = $functs->getmapreportfn($year);
	$getclosedreport = $functs->getclosedreportfn($year);
	$output = [];
	$output["pro"] = $getproreport;
	$output["map"] = $getmapreport;
	$output["close"] = $getclosedreport;
	echo json_encode($output);
	}

if ($type == 'return')
	{
	$getreturnReport = $functs->getreturnReportFn($year);
	echo json_encode($getreturnReport);
	}

if ($type == 'cat')
	{
	$getreturnReport = $functs->getcatReport($year);
	echo json_encode($getreturnReport);
	}

if ($type == 'ren')
	{
	$getrenReporta = $functs->getrenReport($year);
	echo json_encode($getrenReporta);
	}

if ($type == 'f_ren')
	{
	@$yea = $_POST['yea'];
	@$r_ven = $_POST['r_ven'];
	@$r_bd = $_POST['r_bd'];
	$getrenReporta = $functs->getrenReportF($yea, $r_ven, $r_bd);
	echo json_encode($getrenReporta);
	}

if ($type == 'f_cat')
	{
	@$yea = $_POST['yea'];
	@$r_ven = $_POST['r_ven'];
	@$r_bd = $_POST['r_bd'];
	$getrenReporta = $functs->getcatReportF($yea, $r_ven, $r_bd);
	echo json_encode($getrenReporta);
	}

if ($type == 'repcli')
	{
	@$sta = $_POST['sta'];
	@$cit = $_POST['cit'];
	@$zon = $_POST['zon'];
	@$are = $_POST['are'];
	@$age = $_POST['age'];
	@$gen = $_POST['gen'];
	@$mar = $_POST['mar'];
	@$yea = $_POST['yea'];
	@$r_vint = $_POST['r_vint'];
	$getrenReporta = $functs->getCliRep($sta, $cit, $zon, $are, $age, $gen, $mar, $yea, $r_vint);
	echo json_encode($getrenReporta);
	}

?>
