<?php
include 'header.php';
?>
<!-- Container -->
<div id="container">
  <div class="shell">
    <!-- Small Nav -->
    <div class="small-nav"> <a href="#">Dashboard</a> <span>&gt;</span>List Of All Current Project </div>
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
            <h2 class="left">Current Project</h2>
          </div>
          <!-- End Box Head -->

<div class="table">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tbody>
        <tr>
            <th><h3>No#</h3></th>
            <th><h3>Title</h3></th>
            <th><h3>Accetance Date</h3></th>
            <th><h3>Sponser</h3></th>
            <th><h3>Details :</h3></th>
           <th><h3>Remove</h3></th>
        </tr>
   <?php
                                    $sql = "SELECT project.*,user.uname FROM project
INNER JOIN
user ON
project.p_sponser = user.uid";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        ?><tr>
                                    <td><?php echo  $row["pid"];?></td>
                                    <td><?php echo  $row["pname"];?></td>
                                    <td><?php echo  $row["p_date"];?></td>
                                    <td><?php echo  $row["uname"];?></td>
                                    <td><?php echo  $row["p_details"];?></td>
                                  <td><a href="?delete=<?php echo  $row["pid"];?>" class="fa fa-trash-o fa-2x"></a></td>
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
$sql = "DELETE FROM project WHERE pid=".$id;


if ($conn->query($sql) === TRUE) {

       echo '<div class="msg msg-ok">
      <p><strong>Project has Been removed Successfully!</strong></p>
      <a href="#" class="close">close</a> </div>';

            echo '<script>alert("Project Deleted Sucessfully")</script>';

      echo "<script>window.location.assign(\"project_managment.php\");</script>";

} else {
  echo '<div class="msg msg-error">
      <p><strong> Error ! '.$sql.'</strong></p>
      <a href="#" class="close">close</a> </div>'. $conn->error;
}

$conn->close();

}
?>
 </div>
 <div class="box">
          <!-- Box Head -->
          <div class="box-head">
            <h2>Add New project *</h2>
          </div>
          <!-- End Box Head -->
          <form action="" method="post">
            <!-- Form -->
            <div class="form">
              <p> <span class="req">max 25 characters</span>
                <label>Project Title <span>(Required Field)</span></label>
                <input type="text" class="field size1" name="name" maxlength="25">
              </p>
               <p> <span class="req">max 50 characters</span>
                <label>Acceptance Date <span>(Required Field)</span></label>
                <input type="date" class="field size1" name="adate" maxlength="50">
              </p>
               <p> <span class="req">max 25 characters</span>
                <label>Sponser <span>(Required Field)</span></label>
                <select name="sponser"  class="field size1">
                 <?php
                                    $sql = "SELECT * FROM user";
                                    $result = $conn->query($sql);

                                  if ($result->num_rows > 0) {
                                  // output data of each row
                           while($row = $result->fetch_assoc()) {
                                                                ?>
                  <option value="<?php echo  $row["uid"];?>"><?php echo  $row["uname"];?></option>
                  <?php }}?>
                </select>
              </p>
               <p>
                <label>Details <span>(Required Field)</span></label>
                <input type="text" class="field size1" name="details" required="required">
              </p>
            </div>
            <!-- End Form -->
            <!-- Form Buttons -->
            <div class="buttons">
              <input type="submit" class="button" value="submit" name="submit">
            </div>
            <!-- End Form Buttons -->
          </form>
           <?php
          if (isset($_POST['submit']) ) {
            # code...
            if ($_POST['adate'] !="" || $_POST['name'] !="" ) {
              $name = $_POST['name'];
            $adate = $_POST['adate'];
            $sponser = $_POST['sponser'];
            $details = $_POST['details'];
            $dateUF=strtotime($adate); 
            $adate=date("Y-m-d", $dateUF);  
            $sql ="INSERT INTO project ( pname , p_date ,  p_sponser ,  p_details ) VALUES ('$name','$adate', '$sponser' , '$details')";

          if ($conn->query($sql) === TRUE) {
          echo '<div class="msg msg-ok">
      <p><strong>project Has Been Created Successfully!</strong></p>
      <a href="#" class="close">close</a> </div>
      ';
            }
            
          } 

           else{
            echo '<div class="msg msg-error">
      <p><strong> Error ! Password Does not Match !</strong></p>
      <a href="#" class="close">close</a> </div>';
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
          <div class="box-content"> <a href="#" class="add-button"><span>Add new Project</span></a>
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