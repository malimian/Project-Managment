<?php
include 'header.php';
$task_id = $_GET['id'];

$sql = "Select timesheet.*,project.pid,project.pname From timesheet
INNER JOIN project
ON timesheet.pid = project.pid
Where t_id =".$task_id;
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      
    	if(!($_SESSION["uid"] == $row["uid"]) && $_SESSION["uid"] != 1){

    		header("Location: index.php");

    		exit("You are Not Allowed To Make Edits");
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
            <h2>Task Posted On <?php echo $row["project_date"] ; ?></h2>
          </div>
          <!-- End Box Head -->
           <form action="#" method="post">
            <!-- Form -->
            <div class="form">
            <p> <span class="req">Max 100 Charaters</span>
                <label>Project<span>(Required Field)</span></label>
              <select name="project"  class="field size1" required="required">
                  <option value="<?php echo  $row["pid"];?>"><?php echo  $row["pname"];?></option>
                </select>
              </p>

              <p> <span class="req">Max 100 Charaters</span>
                <label>Task Title <span>(Required Field)</span></label>
                <input type="text" class="field size1" name="title" value="<?php echo $row["title"] ; ?>" />
              </p>
              <p class="inline-field">
                <label>Date</label>
                <input type="date" class="field size1" name="task_date" value="<?php echo $row["project_date"];?>" />
              </p>
             <p class="inline-field"> 
                <label class="field size2" >Timming In : </label>
                <input type="text" class="field size3" name="time_in" value="<?php echo $row["timming_in"] ; ?>" />
                <label class="field size2">Timming Out : </label>
                <input type="text" class="field size3" name="time_out" value="<?php echo $row["timming_out"] ; ?>" />
              </p>

              <p> <span class="req">max 100 symbols</span>
                <label>Task Details<span>(Required Field)</span></label>
                <textarea class="field size1" rows="10" cols="30" name="task_detail"><?php echo $row["work_details"];?></textarea>
              </p>
            </div>
            <!-- End Form -->
            <!-- Form Buttons -->
            <div class="buttons">
              <input type="button" class="button" value="preview" />
              <input type="submit" class="button" value="submit" name="update_task" />
            </div>
            <!-- End Form Buttons -->
          </form>
          <?php
}
}
?>
 <?php
          if (isset($_POST['update_task']) && $_POST['title'] != "" ) {
            # code...
            $task_title = $_POST['title'];
            $task_date = $_POST['task_date'];
            $time_in = $_POST['time_in'];
            $time_out = $_POST['time_out'];
            $task_detail = $_POST['task_detail'];


            $sql = "Update timesheet SET title = '$task_title' , project_date = '$task_date' , timming_in='$time_in' , timming_out='$time_out' , work_details='$task_detail' Where t_id =".$task_id;

          if ($conn->query($sql) === TRUE) {
          echo '<div class="msg msg-ok">
      <p><strong>Your Task has been Updated Successfully!</strong></p>
      <a href="#" class="close">close</a> </div>
      ';
          } 
            else{
            echo '<div class="msg msg-error">
      <p><strong> Error ! '.$sql.'</strong></p>
      <a href="#" class="close">close</a> </div>'. $conn->error;
          }

            }// end of submit button    
          ?>
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