<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
?>
<?php function slidersubmenu($pid)
{
	global $conn;
	global $sel;
	global $SubMenutoken;
	$submenus = $conn->select_query(ADMINMENU,"*","pid='".$pid."' AND menu_status='Y' order by menu_pos","");
	if($submenus['nr'])
	{?>
     <ul class="treeview-menu">
     <?php
		foreach($submenus['result']as $ressub)
		{
			$submenucheck = $conn->select_query(ADMINMENU,"menu_id","pid='".$ressub['menu_id']."' AND menu_status='Y'","1");
			?>
			<li class="<?php echo ($submenucheck['nr'])?"treeview":"" ?><?php echo ($SubMenutoken==$ressub['menu_id'])?' active':""; ?>" ><a href="<?php echo ($ressub['menu_link'])?ADMIN_URL.$ressub['menu_link']:"javascript:void(0);"; ?>" title="<?php echo $conn->stripval(ucfirst($ressub['menu_title'])); ?>"> <i class="fa <?php echo $conn->stripval($ressub['menu_icon']); ?>"></i> <span><?php echo $conn->stripval(ucfirst($ressub['menu_title'])); ?></span>
        <?php  if($submenucheck['nr'])
                {?>
                <i class="fa fa-angle-left pull-right"></i>
                <?php }?>
        </a>
        <?php  if($submenucheck['nr'])
                {
                   slidersubmenu($ressub['menu_id']);
                }?>
        </li>
        <?php 
		}?></ul>
	<?php }
	
}
?>
<!-- Left side column. contains the logo and sidebar -->
<?php

if($_SESSION['type']=='O')
{
	if($sel_op['feat_id'])
	{
		$slidercond=" AND menu_id IN (".$sel_op['feat_id'].")";
	}else
	{
		$slidercond=" AND menu_id IN ('')";
	}
}
 $Slidermenu = $conn->select_query(ADMINMENU,"*","menu_status='Y' AND pid='0' ".$slidercond." order by menu_pos",""); ?>
<aside class="main-sidebar"> 
  <div class="user-panel">
<?php if($RES_SURL['setting_logo']!='')
{
	
	$logoexist = $conn->image_exist($RES_SURL['setting_logo'],"../../uploads/common/");
	$logoimg = ($logoexist) ? SITE_URL."uploads/common/".$RES_SURL['setting_logo'] : ADMIN_URL."img/logo.png";?>
            <div class="image" style="text-align:center;" >
              <img src="<?php echo SITE_URL; ?>timthumb.php?src=<?php echo $logoimg;?>&w=100&zc=0&q=95" alt="<?php echo SITE_NAME; ?>" title="<?php echo SITE_NAME; ?>"   />
            </div>
            <?php }?>
          </div>
<!-- sidebar: style can be found in sidebar.less -->
  
  <?php /*?><!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search..."/>
          <span class="input-group-btn">
          <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
          </span> </div>
      </form>
      <!-- /.search form --><?php */?>
  <!-- sidebar menu: : style can be found in sidebar.less -->
 
  <section class="sidebar"> 
    <!-- Sidebar user panel -->
    <ul class="sidebar-menu" id="sildermenu_id">
      <li class="header" style="background: #055996;color: #fff;">MAIN</li>
     <li class="<?php echo ($conn->PHP_SELF()=="home.php")?"active":""; ?>" title="Home"> <a href="<?php echo ADMIN_URL.'common/home.php'; ?>"> <i class="fa fa-dashboard"></i> <span>Home</span></a>
      </li>
      <?php if($Slidermenu['nr'])
	   {
		   foreach($Slidermenu['result'] as $ressilder)
		   {
			   $submenucheck = $conn->select_query(ADMINMENU,"menu_id","pid='".$ressilder['menu_id']."' AND menu_status='Y'","1");
			  ?>
			  <li class="<?php echo ($submenucheck['nr'])?"treeview":"" ?> <?php echo ($Menutoken==$ressilder['menu_id'])?'active':""; ?>"   ><a href="<?php echo ($ressilder['menu_link'])?ADMIN_URL.$ressilder['menu_link']:"javascript:void(0);"; ?>" title="<?php echo $conn->stripval(ucfirst($ressilder['menu_title'])); ?>"> <i class="fa <?php echo $conn->stripval($ressilder['menu_icon']); ?>"></i> <span><?php echo $conn->stripval(ucfirst($ressilder['menu_title'])); ?></span>
        <?php  if($submenucheck['nr'])
                {?>
                <i class="fa fa-angle-left pull-right"></i>
                <?php }?>
        </a>
        <?php  if($submenucheck['nr'])
                {
                    slidersubmenu($ressilder['menu_id']);
                }?>
        </li>
			<?php
            }
		}?>
        <li class="<?php echo ($conn->PHP_SELF()=="changepassword.php")?"active":""; ?> title="Change Password"> <a  href="<?php echo ADMIN_URL.'common/changepassword.php'; ?>"> <i class="fa fa-unlock-alt"></i> <span>Change password</span></a></li>  
      <li  title="Logout"> <a onclick="return confirm('Are you sure want to Sign out?');"  href="<?php echo ADMIN_URL.'common/logout.php'; ?>"> <i class="fa fa-unlock"></i> <span>Sign out</span></a></li>      
    </ul>
    
  </section>
  <!-- /.sidebar --> 
</aside>
