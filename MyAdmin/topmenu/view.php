<?php
require(dirname(__FILE__).'/../../appcore/app-register.php');
$conn->check_admin();

#Page Config
include "pageconfig.php";
$id = $conn->variable($q);

$res = $conn->select_query(TOPMENU,"*","tl_id='".$id."'","1");
 $user_country_name_details = $conn->select_query(COUNTRY,"*"," country_id='".$sel['user_country']."' AND status='1'","1"); 
  if($user_country_name_details['nr']){
    $user_country_name=$user_country_name_details['name'];
  } else {
    $user_country_name='';    
  }
?>
<?php #Admin Html head
$conn->adminHtmlhead();
$conn->admninBody();
?>

<div class="wrapper">
  <?php include "../layout/header.php"; ?>
  <?php include "../layout/slidebar.php"; ?>
  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper"> 
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1> <?php echo $Pagetitle['title']; ?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo ADMIN_URL; ?>common/home.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><?php echo $Pagetitle['title']; ?></li>
      </ol>
    </section>
    
    <!-- Main content -->
    <section class="content">
      <?php include "submenu.php"; ?>
      <!-- Default box -->
      <div class="row">
        <div class="col-md-10 col-md-offset-1">
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title text-navy">View <?php echo $Pagetitle['title']; ?></h3>
              <div class="pull-right"> <a style="margin-right:4px;" class="btn  btn-default btn-xs text-purple" href="javascript:history.go(-1);"><i class="fa fa-arrow-left"></i> Back</a> </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr class="head_bg">
                  <td width="100%" height="28" colspan="3" class="form_head">View Page Content</td>
                </tr>
                <tr>
                  <td colspan="3"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="27%" class="form_text">Pagename </td>
                        <td width="3%" align="center" class="form_text">:</td>
                        <td width="70%" class="form_text"><?php echo $res['tl_name']; ?></td>
                      </tr>
                          <tr  class="row_color">
                            <td valign="top" class="form_text" colspan="3"><strong>Content :</strong></td>
                            </tr>
                          <tr>
                            <td class="table_content" colspan="3">&nbsp;</td>
                          </tr>
                          <tr>
                            <td class="table_content" colspan="3" style="white-space:normal;"><?php echo $res['tl_content']; ?></td>
                          </tr>
                          <tr>
                            <td class="table_content" colspan="3">&nbsp;</td>
                          </tr>
                        </table>
          </td>
                </tr>
                  <tr class="head_bg">
                    <td width="100%" height="28" colspan="3" class="form_head">SEO Settings </td>
                    </tr>
                      <tr>
                        <td width="27%" class="form_text">Title</td>
                        <td width="3%" align="center"  class="form_text">:</td>
                        <td width="70%" class="form_text"><?php echo $res['tl_seo_title']; ?></td>
                      </tr>
                      <tr class="row_color">
                        <td class="form_text">Description</td>
                        <td align="center" class="form_text">:</td>
                        <td class="form_text"><?php echo $res['tl_seo_description']; ?></td>
                      </tr>
                      <tr>
                        <td class="form_text">Keywords (comma separated)</td>
                        <td align="center" class="form_text">:</td>
                        <td class="form_text"><?php echo $res['tl_seo_keywords']; ?></td>
                      </tr>
                <tr>
                  <td colspan="3">&nbsp;</td>
                </tr>
            </table></td>
          </tr>
          
        </table></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
    </table>
            </div>
            <!-- /.box-body --> 
            <!-- /.box --> 
          </div>
        </div>
      </div>
      <!-- /.box --> 
      
    </section>
    <!-- /.content --> 
  </div>
  <!-- /.content-wrapper -->
  
  <?php include "../common/footer.php"; ?>
  <!-- /.content-wrapper --> 
</div>
<?php include "../common/footer-scripts.php"; ?>
</body></html>
