<?php  require(dirname(__FILE__).'/../../appcore/app-register.php');
$conn->check_admin();

#Page Config
include "pageconfig.php";

#Fetch value

$feature_details = $conn->select_query(FEATUREDPRODUCT,"*","","");
$feature_products=array();
foreach ($feature_details['result'] as $key => $feature_detail) {
  $p_details = $conn->select_query(PRODUCT,"*","p_status='Y' AND p_id='".$feature_detail['fp_prodict_id']."'","1");
  if($p_details['nr']){
    $feature_products[]=array(
          'product_id' => $p_details['p_id'],
          'name'        => $p_details['p_name']
        );
  }
  $fp_price_category=$feature_detail['fp_price_id'];
}

if(isset($edit))
{
  
  if(isset($_POST['product_names'])){

    $selcheck = $conn->Execute("DELETE FROM ".FEATUREDPRODUCT);
  
    foreach ($_POST['product_names'] as $key => $product_details) {
      $new=array("fp_prodict_id"=>$product_details, "fp_price_id"=>$price_category);
      $ins = $conn->insert(FEATUREDPRODUCT,"",$new);
    }
               
    if($ins)
    {
      $succAlert = "Successfully Updated.";
      $conn->adminAlert($pageKey,$succAlert);
      $rpage=(isset($_REQUEST['rpage']))? base64_decode($_REQUEST['rpage']):ADMIN_URL.$path_folder.'list.php';
      $conn->divert($rpage);
    }
  } else {
     echo "<script>alert('Please Select Product Name ');</script>";
  } 
}

$product_list = $conn->select_query(PRODUCT, "*", "p_status='Y'");

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
      <h1><?php echo $Pagetitle['title']; ?></h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo ADMIN_URL; ?>common/home.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><?php echo $Pagetitle['title']; ?></li>
      </ol>
    </section>
    
    <!-- Main content -->
    <section class="content">
      <?php //include "submenu.php"; ?>
      <!-- Default box -->
      <div class="row">
        <div class="col-md-10 col-md-offset-1">
        <?php if($errAlert){?>
          <div class="alert alert-danger alert-dismissable">
            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
            <h4><i class="icon fa fa-check"></i> Alert!</h4>
            <?php echo $errAlert; ?> </div>
          <?php }?>
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title  text-navy"><?php echo ucfirst($btn_name).' '.$Pagetitle['title']; ?></h3>
              <div class="pull-right">
              <?php $rpage=(isset($_REQUEST['rpage']))? base64_decode($_REQUEST['rpage']):ADMIN_URL.$path_folder.'list.php'; ?>
                  <a style="margin-right:4px;" class="btn  btn-default btn-xs text-purple" href="<?php echo $rpage; ?>"><i class="fa fa-arrow-left"></i> Back</a>
                  </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <form role="form" method="post" name="frm_edit" id="frm_edit" action="" enctype="multipart/form-data">
                <!-- text input -->
                
                <?php if($product_list['nr']){ ?> 
                  
                  <div class="form-group">
                    <label class="col-sm-2 control-label" for="input-category"><span data-toggle="tooltip" title="product Name">Product Name</span></label>
                    <div class="col-sm-10">
                      <input type="text" name="product_name" value="" placeholder="Product Name" id="input-category" class="form-control" />
                      <div id="product-name" class="well well-sm" style="height: 150px; overflow: auto;">
                        <?php foreach ($feature_products as $product_category) { ?>
                        <div id="product-name<?php echo $product_category['product_id']; ?>"><i class="fa fa-minus-circle"></i> <?php echo $product_category['name']; ?>
                          <input type="hidden" name="product_names[]" value="<?php echo $product_category['product_id']; ?>" />
                        </div>
                        <?php } ?>
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-sm-2 control-label" ><span data-toggle="tooltip" title="Price Category">Price Category</span></label>
                    <div class="col-sm-10">
                      <div class="radio">
                        <label><input name="price_category" class="validate[required]" id="price_category" type="radio" value="hp" <?php echo $conn->ischecked('hp',$fp_price_category); ?>> House Price</label>&nbsp;&nbsp;
                        <label><input name="price_category" class="validate[required]" id="price_category" type="radio" value="op" <?php echo $conn->ischecked('op',$fp_price_category); ?>> Office Price</label>&nbsp;&nbsp;
                        <label><input name="price_category" class="validate[required]" id="price_category" type="radio" value="ep" <?php echo $conn->ischecked('ep',$fp_price_category); ?>> Event Price</label>
                      </div>
                    </div>
                  </div> 

                  <?php /* ?><table class="table table-striped">
                    <tr><th>Product Name <span class="text-red"> *</span></th><th>Price Category <span class="text-red"> *</span></th></tr>
                    <?php foreach ($product_list['result'] as $key => $value) {  ?>
                      <tr>

                        <td>
                          <div class="col-md-6">
                            <div class="form-group">
                                
                                <input type="checkbox" id="inlineCheckbox1" class="validate[required]" name="product_category[]" value="<?php echo $value['p_id']; ?>"> <?php echo $value['p_name']; ?> 

                                <div class="error_p_name"></div>
                            </div>  
                          </div>
                        </td>

                        <td>  
                          <div class="col-md-6">
                            <div class="form-group">
                              <div class="radio">
                                <label><input name="setting_operator" id="setting_operator" type="radio" value="Y" <?php echo $conn->ischecked('Y',$sel['setting_operator']); ?>> House Price</label>&nbsp;&nbsp;<label><input name="setting_operator" id="setting_operator" type="radio" value="N" <?php echo $conn->ischecked('N',$sel['setting_operator']); ?>> Office Price</label>&nbsp;&nbsp;<label><input name="setting_operator" id="setting_operator" type="radio" value="N" <?php echo $conn->ischecked('N',$sel['setting_operator']); ?>> Event Price</label>
                              </div>
                            </div> 
                          </div>  
                        </td>  

                      </tr>
                    <?php } ?>
                  </table> <?php */ ?>
                  <div class="box-footer"><center><input type="hidden" name="successkey" id="successkey"  value="" />
                    <button class="btn btn-primary" name="edit" id="edit" type="submit">Submit</button></center>
                  </div>
                <?php } else { echo "No Record Found"; } ?>
              </form>
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
<script type="text/javascript">
  // Product Name uploadUrl: "<?php echo ADMIN_URL.$path_folder; ?>/ajax.php?func=fileupload", // server upload action
$('input[name=\'product_name\']').autocomplete({
  'source': function(request, response) {    
    $.ajax({
      url: '<?php echo ADMIN_URL.$path_folder; ?>/ajax.php?filter_name=' +  encodeURIComponent(request),
      dataType: 'json',     
      success: function(json) {
        response($.map(json, function(item) {
          return {
            label: item['name'],
            value: item['product_id']
          }
        }));
      }
    });
  },
  'select': function(item) {
    $('input[name=\'product_name\']').val('');
    
    $('#product-name' + item['value']).remove();
    
    $('#product-name').append('<div id="product-name' + item['value'] + '"><i class="fa fa-minus-circle"></i> ' + item['label'] + '<input type="hidden" name="product_names[]" value="' + item['value'] + '" /></div>'); 
  }
});

$('#product-name').delegate('.fa-minus-circle', 'click', function() {
  $(this).parent().remove();
});
</script>
<!--File upload-->
<link href="<?php echo ADMIN_URL; ?>plugins/fileinputupload/fileinput.css" media="all" rel="stylesheet" type="text/css" />
<script type="text/javascript" language="javascript" charset="utf-8" src="<?php echo ADMIN_URL; ?>plugins/fileinputupload/fileinput.min.js"></script> 

<script type="text/javascript">  
 jQuery(document).ready(function() {
jQuery("#frm_edit").validationEngine();
});
</script>
</body>
</html>
