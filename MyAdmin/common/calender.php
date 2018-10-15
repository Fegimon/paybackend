<?php
require(dirname(__FILE__).'/../../appcore/app-register.php');
$conn->check_admin();
$Menutoken="5";
$conn->valoperator("5");
?>
<?php #Admin Html head
$extrahead='<!-- fullCalendar 2.2.5-->
<link href="'.ADMIN_URL.'plugins/fullcalendar/fullcalendar.min.css" rel="stylesheet" type="text/css" />
<link href="'.ADMIN_URL.'plugins/fullcalendar/fullcalendar.print.css" rel="stylesheet" type="text/css" media="print"/>';
$conn->adminHtmlhead($extrahead);
$conn->admninBody();
?>
<div class="wrapper">
  <?php include "../layout/header.php"; ?>
  <?php include "../layout/slidebar.php"; ?>
  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper"> 
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1> Calender
        <?php /*?><small>it all starts here</small><?php */?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo ADMIN_URL; ?>common/home.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Calender</li>
      </ol>
    </section>
    
    <!-- Main content -->
    <section class="content">
      <?php include "../events/submenu.php"; ?>
      <!-- Default box -->
      <div class="row">
        <div class="col-md-9 col-md-offset-1">
          
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title text-green">Calender</h3>
            </div>
          <div class="box-body no-padding"> 
            <!-- THE CALENDAR -->
            <div id="calendar"></div>
          </div>
          <!-- /.box-body --> 
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
<!-- jQuery UI  --> 
<script src="<?php echo ADMIN_URL; ?>plugins/jQueryUI/jquery-ui-1.10.3.min.js" type="text/javascript"></script> 

<!-- fullCalendar 2.2.5 --> 
<script src="<?php echo ADMIN_URL; ?>plugins/moment/moment.min.js" type="text/javascript"></script> 
<script src="<?php echo ADMIN_URL; ?>plugins/fullcalendar/fullcalendar.min.js" type="text/javascript"></script> 
<script type="text/javascript">
      $(function () {

        /* initialize the external events
         -----------------------------------------------------------------*/
        function ini_events(ele) {
          ele.each(function () {

            // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
            // it doesn't need to have a start or end
            var eventObject = {
              title: $.trim($(this).text()) // use the element's text as the event title
            };

            // store the Event Object in the DOM element so we can get to it later
            $(this).data('eventObject', eventObject);

            // make the event draggable using jQuery UI
            $(this).draggable({
              zIndex: 1070,
              revert: true, // will cause the event to go back to its
              revertDuration: 0  //  original position after the drag
            });

          });
        }
        ini_events($('#external-events div.external-event'));

        /* initialize the calendar
         -----------------------------------------------------------------*/
        //Date for the calendar events (dummy data)
        var date = new Date();
        var d = date.getDate(),
                m = date.getMonth(),
                y = date.getFullYear();
        $('#calendar').fullCalendar({
          header: {
            left: 'prev,today',
            center: 'title',
            right: 'today,next'
           
          },
          buttonText: {
            today: 'today',
            month: 'month',
            week: 'week',
            day: 'day'
          },
		  <?php $events = $conn->select_query(EVENTS,"*","event_status='Y' order by event_date desc","");
		  if( $events['nr'])
		  {
			  $m=0;
		   ?>
          //Random default events
          events: [
		  <?php foreach($events['result']as $resevent){
			  echo ($m>0)?",":"";
			  ?>
            {
              title: '<?php echo $conn->stripval(ucfirst($resevent['event_title']));?>',
              start: '<?php echo $conn->stripval($resevent['event_date']);?>',
              backgroundColor: "#f56954", //red
			  url: '<?php echo ADMIN_URL.'events/view.php?q='.$resevent['event_id']; ?>',
              borderColor: "#f56954" //red
            }
			<?php $m++;}?>
            
          ],
		  <?php }?>
         
        });
        
      });
</script>
</body>
</html>