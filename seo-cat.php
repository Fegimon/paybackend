<?php 
if($categorys['seo_title']!="")
{
	$seotitle=$conn->stripval($categorys['seo_title']);
}else
{
	$seotitle=$conn->stripval($EXTRA_ARG['seo_title']);
}
if($categorys['seo_description']!="")
{
	$seodescription=$conn->stripval($categorys['seo_description']);
}else
{
	$seodescription=$conn->stripval($EXTRA_ARG['seo_description']);
}
if($categorys['seo_keyword']!="")
{
	$seokeywords=$conn->stripval($categorys['seo_keyword']);
}else
{
	$seokeywords=$conn->stripval($EXTRA_ARG['seo_keywords']);
}
?>
<title><?php echo ($seotitle)?$seotitle:SITE_NAME; ?></title>
<meta name="description" content="<?php echo $seodescription; ?>" />
<meta name="keywords" content="<?php echo $seokeywords;?>" />
<?php include "seo-common.php"; ?>

