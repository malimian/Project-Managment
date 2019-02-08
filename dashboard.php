<?php

include 'header.php';

if (isset($_SESSION['pid'])) {
 $sql = "
SELECT timesheet.t_id, timesheet.title, timesheet.project_date, timesheet.posttime , user.uid , user.uname,project.pname,project.pid
FROM timesheet
INNER JOIN user
ON timesheet.uid=user.uid
INNER JOIN project
ON timesheet.pid=project.pid
WHERE project.pid=".$_SESSION['pid']."
ORDER BY timesheet.posttime DESC Limit 0 ,10";

}
else{
$sql = "
SELECT timesheet.t_id, timesheet.title, timesheet.project_date, timesheet.posttime , user.uid , user.uname,project.pname,project.pid
FROM timesheet
INNER JOIN user
ON timesheet.uid=user.uid
INNER JOIN project
ON timesheet.pid=project.pid
ORDER BY timesheet.posttime DESC Limit 0 ,10;
";
}

?>
<!-- Container -->
<div id="container">
  <div class="shell">
    <!-- Small Nav -->
    <div class="small-nav"> <a href="#">Dashboard</a> <span>&gt;</span> Current Task </div>
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
            <h2 class="left">Current Tasks</h2>
            <div class="right">
              <label>search Task</label>
              <input type="text" class="field small-field" />
              <input type="submit" class="button" value="search" />
            </div>
          </div>
          <!-- End Box Head -->
          <!-- Table -->
          <div class="table">
          <div id="load_tweets">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <th>Project</th>
                <th>Title</th>
                <th>Date</th>
                <th>Added by</th>
                <th>Delete</th>
                <th>Edit</th>
              </tr>

              <?php

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
   ?>

              <tr>
                <td><a href="all_tasks.php?pid=<?php echo $row["pid"] ; ?>"><?php echo $row["pname"] ; ?> </a></td>
                <td><h3><a href="task.php?id=<?php echo $row["t_id"] ; ?>"><?php echo $row["title"] ; ?></a></h3></td>
                <td><?php echo $row["posttime"] ; ?></td>
                <td><a href="#"><?php echo $row["uname"] ; ?> </a></td>
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
            </div>
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
              <div class="left">Showing latest Task 10-1</div>
              <div class="right"><a href="all_tasks.php">View all</a> </div>
            </div>
            <!-- End Pagging -->
          </div>
          <!-- Table -->
        </div>
        <!-- End Box -->
        <!-- Box -->
        <div class="box">
          <!-- Box Head -->
          <div class="box-head">
            <h2>Add Daily Task</h2>
          </div>
          <!-- End Box Head -->
          <form action="" method="post" novalidate enctype="multipart/form-data">
            <!-- Form -->
            <div class="form">
            <p> <span class="req">Max 100 Charaters</span>
                <label>Project<span>(Required Field)</span></label>
              <select name="project"  class="field size1" required="required">
                 <?php
                                    $sql = "SELECT * FROM project";
                                    $result = $conn->query($sql);

                                  if ($result->num_rows > 0) {
                                  // output data of each row
                           while($row = $result->fetch_assoc()) {
                                                                ?>
                  <option value="<?php echo  $row["pid"];?>"><?php echo  $row["pname"];?></option>
                  <?php }}?>
                </select>
              </p>

              <p> <span class="req">Max 100 Charaters</span>
                <label>Task Title <span>(Required Field)</span></label>
                <input type="text" class="field size1" name="title" value="default" required="required"/>
              </p>
              <p class="inline-field">
                <label>Date</label>
                <input type="date" class="field size1" name="task_date" value="<?php echo date("Y-m-d"); ?>" required="required" />
              </p>

              <p class="inline-field">
                <label>Upload files</label>
                <input type="file" class="field size1" name="upload_files[]" multiple />
              </p>

             <p class="inline-field"> 
                <label class="field size2" >Timming In : </label>
                <input type="text" class="field size3" name="time_in" value="<?php echo date("h:i:s a"); ?>" required="required" />
                <label class="field size2">Timming Out : </label>
                <input type="text" class="field size3" name="time_out" value="<?php echo date("h:i:s a"); ?>" required="required" />
              </p>
              <p class="inline-field">
               <script type="text/javascript">
                  function updateTextInput(val) {
          document.getElementById('textInput').innerHTML=val+"% Of task Completed"; 
        }
                </script>
                <label class="field size1">Percentage Of Task Completed :  <i class="right" id="textInput"> 0 to 100 %</i> </label>
                <input type="range" name="work_range" value="0" min="0" max="100"  onchange="updateTextInput(this.value);" required="required">
              </p>
              <p> <span class="req">max 100 symbols</span>
                <label>Task Details<span>(Required Field)</span></label>
                <textarea class="field size1" rows="10" cols="30" name="task_detail" required="required"></textarea>
              </p>
            </div>
            <!-- End Form -->
            <!-- Form Buttons -->
            <div class="buttons">
              <input type="reset" class="button" value="RESET" />
              <input type="submit" class="button" value="submit" name="submit_task" />
            </div>
            <!-- End Form Buttons -->
          </form>
          <?php 
          if (isset($_POST['submit_task']) && $_POST['title'] != "" ) {
            # code...
            $project =$_POST['project'];
            $task_title = $_POST['title'];
            $task_date = $_POST['task_date'];
            $time_in = $_POST['time_in'];
            $time_out = $_POST['time_out'];
            $task_detail = $_POST['task_detail'];
            $id= $_SESSION["uid"];
            $range=$_POST['work_range'];
            $my_files = $_FILES['upload_files'];
            // print_r( $my_files);
            // print_r( $my_files[1]['name'][0]);
             // print_r($_FILES['upload_files']['name'][1]);


    $img_desc = reArrayFiles($my_files);
    $imgs = '';
    
    foreach($img_desc as $val)
    {
        $newname = date('YmdHis',time()).mt_rand().'.jpg';
        $file_path = 'uploads/'.$newname;
        move_uploaded_file($val['tmp_name'],$file_path);
        $imgs .= base_url($file_path).',';
    }
    $imgs = rtrim($imgs,',');

            $sql = "INSERT INTO timesheet (pid,title, project_date, timming_in , timming_out , work_details , posttime, percent_work, uid,uploaded_files ) VALUES ('$project','$task_title', '$task_date', '$time_in' , '$time_out' , '$task_detail' ,NOW(),'$range','$id','$imgs')";

          if ($conn->query($sql) === TRUE) {
          echo '<div class="msg msg-ok">
      <p><strong>Your Task has been uploaded Successfully!</strong></p>
      <a href="#" class="close">close</a> </div>
      ';
          } 
            else{
            echo '<div class="msg msg-error">
      <p><strong> Error ! '.$sql.'</strong></p>
      <a href="#" class="close">close</a> </div>'. $conn->error;
          }

            }// end of submit button    


    function reArrayFiles($file)
    {
        $file_ary = array();
        $file_count = count($file['name']);
        $file_key = array_keys($file);
        
        for($i=0;$i<$file_count;$i++)
        {
            foreach($file_key as $val)
            {
                $file_ary[$i][$val] = $file[$val][$i];
            }
        }
        return $file_ary;
    }

    function base_url($file_path=''){

    return sprintf(
      "%s://%s%s%s",
      isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
      $_SERVER['SERVER_NAME'],
      str_replace('dashboard.php', '', $_SERVER['REQUEST_URI']),
      $file_path
    );
  }
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
<!-- Footer -->
<?php
include 'footer.php';
?>
<!-- End Footer -->

