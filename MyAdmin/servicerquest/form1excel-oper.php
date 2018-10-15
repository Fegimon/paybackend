<?php
require(dirname(__FILE__).'/../../appcore/app-register.php');
$conn->check_admin();

#Page Config
include "pageconfig.php";

?>
<?php #Admin Html head
$conn->adminHtmlhead();
$conn->admninBody();
?>
<!-- Editor --> 
<script src='<?php echo SITE_URL;?>js/editor/scripts/innovaeditor.js' type="text/javascript"></script>
<script src="<?php echo SITE_URL;?>js/editor/editorjs/editor.js" type="text/javascript"></script>

<div class="wrapper">
  <?php include "../layout/header.php"; ?>
  <?php include "../layout/slidebar.php"; ?>
  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper"> 
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1><?php echo $Pagetitle['title']; ?>
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
              <h3 class="box-title text-navy"> <?php echo $Pagetitle['title']; ?></h3>
              <!--<div class="pull-right"> <a style="margin-right:4px;" class="btn  btn-default btn-xs text-purple" href="javascript:history.go(-1);"><i class="fa fa-arrow-left"></i> Back</a> </div>-->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <form role="form" method="post" name="frm_new" id="frm_new" action="<?php echo ADMIN_URL.$path_folder; ?>excel_download.php" enctype="multipart/form-data" >
                <!-- text input -->
                <div class="form-inline">
                
                 <div class="form-group">
                  <label> <span class="text-red"></span></label> 
                 </div> </br>
                  <div class="form-group">
                  <label> Select Request Status :<span class="text-red">*</span></label>&nbsp;
             <select name="status" id="status" class="form-control validate[required]">
              <option value=""> -- Select --</option>
             <option value="all"> All</option>
             <option value="W"> Pending</option>
             <option value="Y"> Processing</option>
             <option value="C"> Completed</option>
             <option value="N"> Cancelled</option>
             </select>
              </div>
                </div>
                <div class="clearfix"></div><br />
               
                <div class="form-inline">
                   <div  id="hideval">
                <div class="form-group">
                  <label> From :<span class="text-red">*</span></label>&nbsp;
              <input type="text" class="form-control validate[required]" placeholder="From" id="dt_from" name="dt_from"/>
              </div>
                             
                  <div class="form-group">
                  <label>To <span class="text-red">*</span></label>
              <input type="text" class="form-control validate[required]" placeholder="To" id="dt_to" name="dt_to"/>
                </div>
               </div>
				  </div>
                  </div>
                <div class="box-footer">
                 <center> <input type="hidden" name="successkey" id="successkey"  value="" />
                  <button class="btn btn-primary" name="btn_sub" id="btn_sub" type="submit">Submit</button></center>
                </div>
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
<!--File upload-->
<link href="<?php echo ADMIN_URL; ?>plugins/fileinputupload/fileinput.css" media="all" rel="stylesheet" type="text/css" />
<script type="text/javascript" language="javascript" charset="utf-8" src="<?php echo ADMIN_URL; ?>plugins/fileinputupload/fileinput.min.js"></script> 


<link href="<?php echo ADMIN_URL;?>js/calendar/css/jquery-ui-1.10.4.custom.min.css" rel="stylesheet" type="text/css" />
<script src="<?php echo ADMIN_URL; ?>js/calendar/js/jquery-ui-1.10.4.custom.min.js" type="text/javascript" charset="utf-8"></script> 

<script type="text/javascript">  
jQuery(document).ready(function() {
	 $("#hideval").show();
   $("#hideval1").hide();
jQuery("#frm_new").validationEngine();
setTimeout("document.getElementById('user_from').focus(); ", 500 ); 
});

/*


$( "#dt_from" ).datepicker({
    changeMonth: true,
    changeYear: true,
    showButtonPanel: true,
    dateFormat: "yy-mm-dd",
    maxDate:0,
      onSelect: function(selected) {
          $("#dt_to").datepicker("option","minDate", selected)
        },
});

$( "#dt_to" ).datepicker({
    changeMonth: true,
    changeYear: true,
    showButtonPanel: true,
    dateFormat: "yy-mm-dd",
    maxDate:30,
      onSelect: function(selected) {
          $("#dt_from").datepicker("option","maxDate", selected)
        },
});
*/

//  $("#from_date").datepicker({
//       changeMonth: false,
//     changeYear: false,
//     dateFormat: "yy-mm-dd",
//          maxDate :0,
//         //stepMonths: 0,
//         //showOtherMonths:false,
//           //defaultDate: "+1w",
//           //selectOtherMonths: true,


//         onClose: function (selectedDate) {
//             $("#to_date").datepicker("option", "minDate", selectedDate);
//         }
//     });
//     $("#to_date").datepicker({
//       changeMonth: false,
//     changeYear: false,
//       dateFormat: "yy-mm-dd",
//       maxDate:30,

//      //maxDate : 20,
//       //startDate: '+1d',

//         //numberOfMonths: [ 1, 1 ],

//        // showCurrentAtPos: -1,
//         //defaultDate: "+1w",
//         //stepMonths: 1,
//          //selectOtherMonths: true,            
//       //        showOtherMonths:false,
//            //   numberOfMonths: [1 , 1],
//         onClose: function (selectedDate) {
//             $("#from_date").datepicker("option", "maxDate", selectedDate);

// }

// });




// $( "#date_id" ).datepicker({
//     changeMonth: true,
//     changeYear: true,
//     numberOfMonths: 1,
//     maxDate:0,
//     dateFormat: "dd-mm-yy",  
//             });
/*

$( "#from_date" ).datepicker({
    changeMonth: true,
    changeYear: true,
    //numberOfMonths: 1,
    maxDate:0,
    dateFormat: "yy-mm-dd",
     //numberOfMonths: 1,
//showCurrentAtPos: 1,

    onSelect: function(selected) {
          $("#to_date").datepicker("option","minDate", selected)
          
          
                  var tt = document.getElementById('from_date').value;

          alert(tt);
        }
    });


$( "#to_date" ).datepicker({
    changeMonth: false,
    changeYear: false,
    //numberOfMonths: 1,
    maxDate:30,
    dateFormat: "yy-mm-dd",
     // showCurrentAtPos: 1,
          //numberOfMonths: 3,
          //showMonthAfterYear : true,

    onSelect: function(selected) {
           $("#from_date").datepicker("option","maxDate", selected)
           var isDisabled = $( "#to_date" ).datepicker( "option", "maxDate","disabled" );
           alert(isDisabled);


        }
    });
*/


$("#reportuser").click(function(){
    $("#hideval").hide();
    $("#hideval1").show();
});

$("#reportall").click(function(){
    $("#hideval").show();
    $("#hideval1").hide();
});

</script>
</body></html>