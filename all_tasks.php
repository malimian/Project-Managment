<?php
include 'header.php';
if(isset($_SESSION["pid"])){

              $sql = "
SELECT timesheet.t_id, timesheet.title, timesheet.project_date, timesheet.posttime , user.uid , user.uname,
timesheet.timming_in , timesheet.timming_out , timesheet.percent_work,project.pname,project.pid
FROM timesheet
INNER JOIN user
ON timesheet.uid=user.uid
INNER JOIN project
ON project.pid=timesheet.pid
WHERE timesheet.pid=".$_SESSION["pid"]."
ORDER BY timesheet.posttime";

}
else{

                $sql = "
              SELECT timesheet.t_id, timesheet.title, timesheet.project_date, timesheet.posttime , user.uid , user.uname,
              timesheet.timming_in , timesheet.timming_out , timesheet.percent_work ,project.pname
FROM timesheet
INNER JOIN user
ON timesheet.uid=user.uid
INNER JOIN project
ON project.pid=timesheet.pid
ORDER BY timesheet.posttime;
";
}
?>
<!-- Container -->
<div id="container">
  <div class="shell">
    <!-- Small Nav -->
    <div class="small-nav"> <a href="#">Dashboard</a> <span>&gt;</span>List Of All Tasks </div>
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
            <h2 class="left">Current Articles</h2>
            <div class="right">
              <label>search articles</label>
              <input type="text" class="field small-field" />
              <input type="submit" class="button" value="search" />
            </div>
          </div>
          <!-- End Box Head -->
          <!-- Table -->
          <div class="table">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <th>Project Name</th>
                <th>Title</th>
                <th>Date</th>
                <th>Added by</th>
                <th>Hours Spent</th>
                <th>Progress</th>
                <th>Delete</th>
                <th>Edit</th>
              </tr>

              <?php

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {

        $time1 =explode(":", $row["timming_in"]);
        $time2 =explode(":", $row["timming_out"]);

        $time3 = $time2[0]-$time1[0];

   ?>


              <tr>
                <td><?php echo $row["pname"] ; ?></td>
                <td><h3><a href="task.php?id=<?php echo $row["t_id"] ; ?>"><?php echo $row["title"] ; ?></a></h3></td>
                <td><?php echo $row["posttime"] ; ?></td>
                <td><a href="#"><?php echo $row["uname"] ; ?> </a></td>
                <td><?php echo $time3;?></td>
                <td><progress value="<?php echo $row["percent_work"] ;?>" max="100"></input></td>
                <?php
                if(!($_SESSION["uid"] == $row["uid"]) && $_SESSION["uid"] != 1){
                  echo'<td  class="ico del"><a>&#x2718;</a></td><td class="ico edit"><a>&#x2718;</a></td>';
      }else{
        ?>
         <td><a href="?delete=<?php echo $row["t_id"] ; ?>" class="ico del">Delete</a></td><td><a href="edit_task.php?id=<?php echo $row["t_id"] ; ?>" class="ico edit">Edit</a></td>
<?php
      }
      ?>
               
              </tr>
           <?php
            }
} else {
    echo "<td>0 results</td>";
}
               ?>
            </table>
            <?php
            if (isset($_GET['delete'])) {

    $id=$_GET['delete'];
    // sql to delete a record
$sql = "DELETE FROM timesheet WHERE t_id=".$id;


if ($conn->query($sql) === TRUE) {
    echo '
    <div class="msg msg-ok">
      <p><strong>Task Deleted Successfully!</strong></p>
      <a href="#" class="close">close</a> </div>';

} else {
    echo '<div class="msg msg-error">
      <p><strong>Error ! '.$conn->error.'</strong></p>
      <a href="#" class="close">close</a> </div>';
}


}
            ?>
            <!-- Pagging -->
            <div class="pagging">
              <div class="left">Showing 1-12 of 44</div>
              <div class="right"> <a href="#">Previous</a> <a href="#">1</a> <a href="#">2</a> <a href="#">3</a> <a href="#">4</a> <a href="#">245</a> <span>...</span> <a href="#">Next</a> <a href="#">View all</a> </div>
            </div>
            <!-- End Pagging -->
          </div>
          <!-- Table -->
        </div>
        <!-- End Box -->
      </div>
      <!-- End Content -->
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
<!-- Footer -->
<?php
include 'footer.php';
?>
<!-- End Footer -->

