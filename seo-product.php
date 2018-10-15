<?php 
if($product_details['pp_seo_title']!="")
{
	$seotitle=$conn->stripval($product_details['pp_seo_title']);
}else
{
	$seotitle=$conn->stripval($EXTRA_ARG['seo_title']);
}
if($product_details['pp_seo_desc']!="")
{
	$seodescription=$conn->stripval($product_details['pp_seo_desc']);
}else
{
	$seodescription=$conn->stripval($EXTRA_ARG['seo_description']);
}
if($product_details['pp_seo_keyword']!="")
{
	$seokeywords=$conn->stripval($product_details['pp_seo_keyword']);
}else
{
	$seokeywords=$conn->stripval($EXTRA_ARG['seo_keywords']);
}
?>
<title><?php echo ($seotitle)?$seotitle:SITE_NAME; ?></title>
<meta name="description" content="<?php echo $seodescription; ?>" />
<meta name="keywords" content="<?php echo $seokeywords;?>" />
<?php include "seo-common.php"; ?>

