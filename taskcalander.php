<?php
include 'header.php';
if (isset($_SESSION['pid'])) {
 $sql = "Select * From timesheet where pid =".$_SESSION['pid'];
}
elseif($_SESSION['uid']==1){
$sql = "Select * From timesheet";
}
else{
$sql = "Select * From timesheet uid =".$_SESSION["uid"];
}

?>
<!-- Container -->
<div id="container">
  <div class="shell">
    <!-- Small Nav -->
    <div class="small-nav"> <a href="#">Dashboard</a> <span>&gt;</span>Calendar Of All Tasks </div>
    <!-- End Small Nav -->

    <!-- Main -->
    <div id="main">
      <div class="cl">&nbsp;</div>
      <!-- Content -->
      <div id="content">
        <!-- Box -->
        <div class="box">
          <!-- Box Head -->
          <div class="box-head">
            <h2 class="left">Task Calendar For Year <?php echo date("Y"); ?></h2>
            <div class="right">
              <label>search articles</label>
              <input type="text" class="field small-field" />
              <input type="submit" class="button" value="search" />
            </div>
          </div>
          <!-- End Box Head -->
<link href='taskcalender/fullcalendar.css' rel='stylesheet' />
<link href='taskcalender/fullcalendar.print.css' rel='stylesheet' media='print' />
<script src='taskcalender/lib/moment.min.js'></script>
<script src='taskcalender/lib/jquery.min.js'></script>
<script src='taskcalender/fullcalendar.min.js'></script>
<script>

  $(document).ready(function() {
    
    $('#calendar').fullCalendar({
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'month,agendaWeek,agendaDay,listWeek'
      },
      defaultDate: '<?php echo date("Y");?>-<?php echo date("m");?>-<?php echo date("d");?>',
      navLinks: true, // can click day/week names to navigate views
      editable: true,
      eventLimit: true, // allow "more" link when too many events
      events: [
<?php

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {

?>

        {
          title: '<?php echo $row["title"] ; ?>',
          url: 'dailyworkchart.php?date=<?php echo $row["project_date"] ; ?>',
          start: '<?php echo $row["project_date"] ; ?>'
        },
<?php }} ?>
      ]
    });
    
  });

</script>


  <div id='calendar'></div>
  </div>
        <!-- End Box -->
      </div>
      <!-- End Content -->

<!-- Sidebar -->
      <div id="sidebar">
        <!-- Box -->
        <div class="box">
          <!-- Box Head -->
          <div class="box-head">
            <h2>Management</h2>
          </div>
          <!-- End Box Head-->
          <div class="box-content"> <a href="#" class="add-button"><span>Add new Task</span></a>
            <div class="cl">&nbsp;</div>
            <p class="select-all">
              <input type="checkbox" class="checkbox" />
              <label>select all</label>
            </p>
            <p><a href="#">Delete Selected</a></p>
            <!-- Sort -->
            <div class="sort">
            <script id="cid0020000129660648378" data-cfasync="false" async src="//st.chatango.com/js/gz/emb.js" style="width: 100%;height: 100%;">{"handle":"oolay","arch":"js","styles":{"a":"000000","b":100,"c":"FFFFFF","d":"FFFFFF","k":"000000","l":"000000","m":"000000","n":"FFFFFF","p":"11.07","q":"000000","r":100,"cnrs":"0.35","fwtickm":1}}</script>
            </div>
            <!-- End Sort -->
          </div>
        </div>
        <!-- End Box -->
      </div>
      <!-- End Sidebar -->
      <div class="cl">&nbsp;</div>
    </div>
    <!-- Main -->
  </div>
</div>
<!-- End Container -->


<?php
include 'footer.php';
?>