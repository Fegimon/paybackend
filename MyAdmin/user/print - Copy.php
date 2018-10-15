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
                      <button>print</button>
                   </div>
                </div>
                  
                  <div class="col-lg-12">
                     <h3><b>Personal Details</b></h3>
                  </div>
                  
                 <div class="col-lg-3">
                   <p><b>First Name:</b> Sakthi Rajesh</p>
                 </div>
                <div class="col-lg-9">
                   <p><b>Last Name:</b> Sakthi Rajesh</p>
                </div>
               
                
                <div class="col-lg-3">
                   <p><b>Date Of Birth:</b> 06/09/98</p>
                 </div>
                <div class="col-lg-3">
                   <p><b>Gender:</b> Male</p>
                </div>
                <div class="col-lg-6">
                   <p><b>Martial Status:</b> Single</p>
                </div>
                
                <div class="col-lg-3">
                   <p><b>Primary-contact:</b> 9965665996</p>
                 </div>
                <div class="col-lg-9">
                   <p><b>Secondary-contact:</b> 9965665996</p>
                </div>
                
                 <div class="col-lg-3">
                   <p><b>Primary-Email:</b> someone@exp.com</p>
                 </div>
                <div class="col-lg-9">
                   <p><b>Secondary-Email:</b> someone@example.com</p>
                </div>
                
                <div class="col-lg-12">
                  <p><b>Permanent Address:</b> 445 Mount Eden Road, Mount Eden, Chennai, Floor.no:545, 613313, Tamilnadu,india.</p>
                </div>
                
                <div class="col-lg-12">
                  <p><b>Communication Address:</b> 445 Mount Eden Road, Mount Eden, Chennai, Floor.no:545, 613313, Tamilnadu,india.</p>
                </div>
                <div>&nbsp;</div>
                  <div class="col-lg-12">
                     <h3><b>Professional Details</b></h3>
                  </div>
                  
                  <div class="col-lg-6">
                   <p><b>Company Name:</b> Mirrorminds Technology Solutions</p>
                 </div>
                <div class="col-lg-6">
                   <p><b>Designation:</b> Web Designing,Web Development</p>
                </div>
                
                <div class="col-lg-6">
                   <p><b>Department:</b> Mirrorminds Technology Solutions</p>
                 </div>
                <div class="col-lg-6">
                   <p><b>Official Email:</b> Mirrorminds.in</p>
                </div>
                
                <div class="col-lg-12">
                  <p><b>Company Address:</b> 445 Mount Eden Road, Mount Eden, Chennai, Floor.no:545, 613313, Tamilnadu,india.</p>
                </div>
                
                <div>&nbsp;</div>
                  <div class="col-lg-12">
                     <h3><b>Reference Details</b></h3>
                  </div>
                  
                <div class="col-lg-6">
                   <p><b>Reference Name 1:</b> Mirrorminds Technology Solutions</p>
                 </div>
                <div class="col-lg-6">
                   <p><b>Reference Name 2:</b> Web Designing,Web Development</p>
                </div>
                
                <div class="col-lg-6">
                   <p><b>Email ID:</b> someone@example.com</p>
                 </div>
                <div class="col-lg-6">
                   <p><b>Email ID:</b> someone@example.com</p>
                </div>
                
                <div class="col-lg-6">
                   <p><b>Address:</b> 445 Mount Eden Road, Mount Eden, Chennai, Floor.no:545, 613313, Tamilnadu,india.</p>
                 </div>
                <div class="col-lg-6">
                   <p><b>Address:</b> 445 Mount Eden Road, Mount Eden, Chennai, Floor.no:545, 613313, Tamilnadu,india.</p>
                </div>
                
                <div class="col-lg-6">
                   <p><b>Contact #:</b> 9978868890</p>
                 </div>
                <div class="col-lg-6">
                   <p><b>Contact #:</b> 9978868890</p>
                </div>
                
                <div>&nbsp;</div>
                  <div class="col-lg-12">
                     <h3><b>Documents Required</b></h3>
                  </div>
                  
                  <div class="col-lg-4">
                   <p><b>Aadhar Card:</b> 9978868890</p>
                 </div>
                <div class="col-lg-8">
                   <p><b>Aadhar Card:</b> 9978868890</p>
                </div>
                
                <div class="col-lg-4">
                   <p><b>Company ID Card:</b> 9978868890</p>
                 </div>
                <div class="col-lg-4">
                   <p><b>Account holder name:</b> Sakthi Rajesh</p>
                </div>
                <div class="col-lg-4">
                   <p><b>Account number:</b> 9978868890</p>
                </div>
                
                <div class="col-lg-4">
                   <p><b>Visiting Card:</b> 9978868890</p>
                 </div>
                <div class="col-lg-4">
                   <p><b>Name of the bank:</b> Indian Bank</p>
                </div>
                <div class="col-lg-4">
                   <p><b>IFSC code:</b> IDIB0000123</p>
                </div>
                
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
