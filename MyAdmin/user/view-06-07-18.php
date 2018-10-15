<?php
require(dirname(__FILE__).'/../../appcore/app-register.php');
$conn->check_admin();

#Page Config
include "pageconfig.php";
$id = $conn->variable($q);

$sel = $conn->select_query(USER,"*","user_id='".$id."'","1");
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

    <section class="content">
     
      <!-- Default box -->
      <div class="row">
        <div class="col-md-10 col-md-offset-1">
          <div class="box box-primary">
            <div class="box-body">
                    
                <div class="col-lg-6"></div>
                <div class="col-lg-6">
                   <div class="text-right">
                     <button onclick="print()">print</button>
                   </div>
                </div>
                  
                  <div class="col-lg-12">
                     <h3><b>Personal Details</b></h3>
                  </div>
                  
                 <div class="col-lg-3">
                   <p><b>First Name:</b> <?php echo $conn->stripval(ucfirst($sel['user_first_name']));?></p>
                 </div>
                <div class="col-lg-9">
                   <p><b>Last Name:</b> <?php echo $conn->stripval(ucfirst($sel['user_last_name']));?></p>
                </div>
               
                
                <div class="col-lg-3">
                   <p><b>Date Of Birth:</b> <?php echo $conn->stripval(date('d-m-Y',strtotime($sel['dob'])));?></p>
                 </div>
                <div class="col-lg-3">
                   <p><b>Gender:</b> <?php echo $sel['user_gender']; ?></p>
                </div>
                <div class="col-lg-6">
                   <p><b>Martial Status:</b> <?php echo ($sel['user_name']=='S'?'Sinle':'Married');?></p>
                </div>
                
                <div class="col-lg-3">
                   <p><b>Primary-contact:</b> <?php echo $sel['user_mobile']; ?></p>
                 </div>
                <div class="col-lg-9">
                   <p><b>Secondary-contact:</b> <?php echo $sel['secondary_contact']; ?></p>
                </div>
                
                 <div class="col-lg-3">
                   <p><b>Primary-Email:</b> <?php echo  $sel['user_email']; ?></p>
                 </div>
                <div class="col-lg-9">
                   <p><b>Secondary-Email:</b> <?php echo  $sel['secondary_email']; ?></p>
                </div>
                
                <div class="col-lg-12">
  <p><b>Permanent Address:</b> <?php echo  $sel['permanent_flat_no'].','. $sel['permanent_floor_no'].','. $sel['permanent_street_road_name'].','. $sel['permanent_area'].','. $sel['permanent_pin_code'].','. $sel['permanent_city'].','. $sel['permanent_state']; ?>.</p>
                </div>
                
                <div class="col-lg-12">
                  <p><b>Communication Address:</b><?php echo  $sel['user_primary_address'].','. $sel['floor_no'].','. $sel['street_road_name'].','. $sel['area'].','. $sel['pin_code'].','. $sel['city'].','. $sel['state']; ?>.</p>
                </div>
                
                 <div class="col-lg-12">
                   <p><b>Residence Status:</b> <?php echo  $sel['residence_status']; ?></p>
                </div>
                
               
                  <div class="col-lg-12">
                     <h3><b>Professional Details</b></h3>
                  </div>
                  
                  <div class="col-lg-6">
                   <p><b>Company Name:</b> <?php echo  $sel['company_name']; ?></p>
                 </div>
                <div class="col-lg-6">
                   <p><b>Designation:</b> <?php echo  $sel['designation']; ?>t</p>
                </div>
                
                <div class="col-lg-6">
                   <p><b>Department:</b> <?php echo  $sel['department']; ?></p>
                 </div>
                <div class="col-lg-6">
                   <p><b>Official Email:</b> <?php echo $sel['Official_email']; ?></p>
                </div>
                
                <div class="col-lg-12">
                  <p><b>Company Address:</b> <?php echo  $sel['company_address']; ?></p>
                </div>
                
               
                  <div class="col-lg-12">
                     <h3><b>Reference Details</b></h3>
                  </div>
                  
                <div class="col-lg-6">
                   <p><b>Reference Name 1:</b> <?php echo  $sel['reference_name1']; ?></p>
                 </div>
                <div class="col-lg-6">
                   <p><b>Reference Name 2:</b> <?php echo  $sel['reference_name2']; ?></p>
                </div>
                
                <div class="col-lg-6">
                   <p><b>Email ID:</b> <?php echo  $sel['Reference1_email1']; ?></p>
                 </div>
                <div class="col-lg-6">
                   <p><b>Email ID:</b> <?php echo  $sel['Reference2_email2']; ?></p>
                </div>
                
                <div class="col-lg-6">
                   <p><b>Address:</b> <?php echo  $sel['Reference1_adress']; ?>.</p>
                 </div>
                <div class="col-lg-6">
                   <p><b>Address:</b> <?php echo  $sel['Reference2_adress']; ?>.</p>
                </div>
                
                <div class="col-lg-6">
                   <p><b>Contact #:</b> <?php echo  $sel['Reference1_contact']; ?></p>
                 </div>
                <div class="col-lg-6">
                   <p><b>Contact #:</b> <?php echo  $sel['Reference2_contact']; ?></p>
                </div>
                
                <div>&nbsp;</div>
                  <div class="col-lg-12">
                     <h3><b>Documents Required</b></h3>
                  </div>
                  
                  <div class="col-lg-4">
                   <p><b>Id Proof:</b> <?php echo  $sel['id_proof_type']; ?></p>
                 </div>
               
                <div class="col-lg-8">
                   <p><b>Id Proof File:</b>  <?php if($sel['id_proof']!=''){ echo  $sel['id_proof'];  }else{?> --- <?php }?></p>
                </div>
                <div class="col-lg-4">
                   <p><b>Current Address Proof:</b> <?php echo  $sel['address_proof_type']; ?></p>
                 </div>
                
                <div class="col-lg-8">
                   <p><b>Current Address Proof File:</b>  <?php if($sel['current_address_proof']!=''){ echo  $sel['current_address_proof'];}else{ ?> ---  <?php }?></p>
                </div>
                
                 <div class="col-lg-4">
                   <p><b>Company Id Proof File:</b> <?php if($sel['company_id_card']!=''){ echo  $sel['company_id_card'];}else { ?> --- <?php }?></p>
                 </div>
                
                   
                <div class="col-lg-8">
      <p><b>Visiting Card File:</b>  <?php if($sel['visiting_card']!=''){ echo  $sel['visiting_card'];}else{ ?> ---  <?php }?></p>
                </div>
                <?php if($sel['bank_detail']=='bank'){?>
                 <div class="col-lg-4">
                   <p><b>Account Holder Name:</b> <?php echo  $sel['holder_name']; ?></p>
                </div>
                           
                <div class="col-lg-3">
                   <p><b>Account number :</b> <?php echo  $sel['acco_no']; ?></p>
                 </div>
                <div class="col-lg-3">
                   <p><b>Name Of The Bank:</b> <?php echo  $sel['name_of_the_bank']; ?></p>
                </div>
                
                 <div class="col-lg-2">
                   <p><b>IFSC Code:</b> <?php echo  $sel['ifsc_code']; ?></p>
                </div>
                <?php }elseif($sel['bank_detail']=='cancelled'){?>
                <div class="col-lg-12">
                   <p><b>Cancell Check Leaf:</b> <?php if($sel['cancel_leaf_file']!=''){ echo  $sel['cancel_leaf_file'];}else{ ?> ---  <?php }?></p>
                </div>
                <?php }?>
            </div>
            <!-- /.box-body --> 
            <!-- /.box --> 
          </div>
        </div>
      </div>
      <!-- /.box --> 
      
    </section>
   
<?php include "../common/footer-scripts.php"; ?>

</body></html>
