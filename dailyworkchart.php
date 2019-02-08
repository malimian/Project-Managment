<?php
include 'header.php';
$date_of_project=$_GET['date'];
if($_SESSION["uid"]==1){
$sql = "Select timesheet.* , user.uname From timesheet
INNER JOIN user
ON timesheet.uid = user.uid
where project_date='$date_of_project'";
}
else{
$sql = "
Select timesheet.* , user.uname From timesheet
INNER JOIN user
ON timesheet.uid = user.uid
where project_date='$date_of_project' AND uid =".$_SESSION["uid"];
}
?>
<!-- Container -->
<div id="container">
  <div class="shell">
    <!-- Small Nav -->
    <div class="small-nav"> <a href="#">Dashboard</a> <span>&gt;</span> Current Articles </div>
    <!-- End Small Nav -->
    <br />
    <!-- Main -->
    <div id="main">
      <div class="cl">&nbsp;</div>
      <!-- Content -->
      <div id="content">
        <!-- Box -->
        <div class="box">
          <!-- Box Head -->
          <div class="box-head">
            <h2>Task Of <?php echo $date_of_project; ?></h2>
          </div>
          <!-- End Box Head -->
            <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
   
    <div id="chart_div"></div>

<script type='text/javascript'>//<![CDATA[

      google.charts.load('current', {'packages':['timeline']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ['Activity', 'Start Time', 'End Time'],
        <?php


$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $time1 =explode(":", $row["timming_in"]);
        $time2 =explode(":", $row["timming_out"]);

        $getdate=explode("-", $row["posttime"]);
        $getdateday=explode(" ", $getdate[2]);
        //print_r($getdate); 
        $time3 = $time2[0]-$time1[0];
      ?>
        ['<?php echo $row["title"] ; ?> , <?php echo $row["uname"] ; ?>',
         new Date(<?php echo $getdate[0];?>, <?php echo $getdate[1];?>, <?php echo $getdateday[0];?>, <?php echo $time1[0];?>, <?php echo $time1[1];?>),
         new Date(<?php echo $getdate[0];?>, <?php echo $getdate[1];?>, <?php echo $getdateday[0];?>, <?php echo $time2[0];?>, <?php echo $time2[1];?>)],
                  <?php
}
}
?>
      ]);

      var options = {
        height: 450,
      };

      var chart = new google.visualization.Timeline(document.getElementById('chart_div'));

      chart.draw(data, options);
    }

//]]> 

</script>
 </div>

            <!-- End Form -->
            <!-- Form Buttons -->
            <div class="buttons">
              <input type="button" class="button" value="preview" />
              <input type="submit" class="button" value="submit" name="update_task" />
            </div>
            <!-- End Form Buttons -->
          </form>
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
          <div class="box-content"> <a href="#" class="add-button"><span>Add new Article</span></a>
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