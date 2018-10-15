<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<meta name="description" content="<?php echo $conn->stripval($EXTRA_ARG['seo_description']); ?>" />
<meta name="keywords" content="<?php echo $conn->stripval($EXTRA_ARG['seo_keywords']); ?>" />
<?php include "seo-common.php"; ?>
<title><?php echo ($EXTRA_ARG['seo_title'])?$conn->stripval($EXTRA_ARG['seo_title']):SITE_NAME; ?></title>