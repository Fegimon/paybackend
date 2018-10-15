<?php 
if($cms['tl_seo_title']!="")
{
	$seotitle=$conn->stripval($cms['tl_seo_title']);
}else
{
	$seotitle=$conn->stripval($EXTRA_ARG['seo_title']);
}
if($cms['tl_seo_description']!="")
{
	$seodescription=$conn->stripval($cms['tl_seo_description']);
}else
{
	$seodescription=$conn->stripval($EXTRA_ARG['seo_description']);
}
if($cms['tl_seo_keywords']!="")
{
	$seokeywords=$conn->stripval($cms['tl_seo_keywords']);
}else
{
	$seokeywords=$conn->stripval($EXTRA_ARG['seo_keywords']);
}
?>
<title><?php echo ($seotitle)?$seotitle:SITE_NAME; ?></title>
<meta name="description" content="<?php echo $seodescription; ?>" />
<meta name="keywords" content="<?php echo $seokeywords;?>" />
<?php include "seo-common.php"; ?>

