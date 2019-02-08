<?php
include 'header.php';
?>
<!-- Container -->
<div id="container">
  <div class="shell">
    <!-- Small Nav -->
    <div class="small-nav"> <a href="#">Dashboard</a> <span>&gt;</span>List Of All Current Users </div>
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
            <h2 class="left">Current Users</h2>
            <div class="right">
              <label>search articles</label>
              <input type="text" class="field small-field" />
              <input type="submit" class="button" value="search" />
            </div>
          </div>
          <!-- End Box Head -->

<div class="table">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tbody>
        <tr>
            <th><h3>No#</h3></th>
            <th><h3>Name</h3></th>
            <th><h3>Password</h3></th>
            <th><h3>Email</h3></th>
            <th><h3>Phone No</h3></th>
           <th><h3>Remove</h3></th>
        </tr>
   <?php
                                    $sql = "SELECT * FROM user";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        ?><tr>
                                    <td><?php echo  $row["uid"];?></td>
                                    <td><?php echo  $row["uname"];?></td>
                                    <td><?php echo  $row["upass"];?></td>
                                    <td><?php echo  $row["uemail"];?></td>
                                    <td><?php echo  $row["upno"];?></td>
                                  <td><a href="?delete=<?php echo  $row["uid"];?>" class="fa fa-trash-o fa-2x"></a></td>
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

if (isset($_GET['delete']) && ! ($_GET['delete'] == 1 ) ) {

    $id=$_GET['delete'];
    // sql to delete a record
$sql = "DELETE FROM user WHERE uid=".$id;


if ($conn->query($sql) === TRUE) {

       echo '<div class="msg msg-ok">
      <p><strong>User has Been removed Successfully!</strong></p>
      <a href="#" class="close">close</a> </div>
      ';

} else {
  echo '<div class="msg msg-error">
      <p><strong> Error ! '.$sql.'</strong></p>
      <a href="#" class="close">close</a> </div>'. $conn->error;
}

$conn->close();

}
else if (isset($_GET['delete']) && $_GET['delete'] == 1) {
  echo '<div class="msg msg-error">
      <p><strong> Error ! Dont Be Stupid :( You Can not Delete Your Self -_- !!!</strong></p>
      <a href="#" class="close">close</a> </div>';
}
?>
 </div>
 <div class="box">
          <!-- Box Head -->
          <div class="box-head">
            <h2>Add New User *</h2>
          </div>
          <!-- End Box Head -->
          <form action="" method="post">
            <!-- Form -->
            <div class="form">
              <p> <span class="req">max 25 characters</span>
                <label>User Name <span>(Required Field)</span></label>
                <input type="text" class="field size1" name="name" maxlength="25">
              </p>
               <p> <span class="req">max 50 characters</span>
                <label>Password <span>(Required Field)</span></label>
                <input type="password" class="field size1" name="pass1" maxlength="50">
              </p>
              <p> <span class="req">max 25 characters</span>
                <label>Confirm Password <span>(Required Field)</span></label>
                <input type="password" class="field size1" name="pass2" maxlength="50">
              </p>
               <p> <span class="req">max 25 characters</span>
                <label>Email <span>(Required Field)</span></label>
                <input type="email" class="field size1" name="email" maxlength="25">
              </p>
               <p> <span class="req">max 14 characters</span>
                <label>Contact <span>(Required Field)</span></label>
                <input type="text" class="field size1" name="phoneno" maxlength="14">
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
            if ($_POST['pass1'] == $_POST['pass2'] && $_POST['pass1'] !="" ) {
              $name = $_POST['name'];
            $pass1 = $_POST['pass1'];
            $email = $_POST['email'];
            $phoneno = $_POST['phoneno'];

            $sql ="INSERT INTO user ( uname , uemail ,  upno ,  upass ) VALUES ('$name','$email', '$phoneno' , '$pass1')";

          if ($conn->query($sql) === TRUE) {
          echo '<div class="msg msg-ok">
      <p><strong>User Has Been Created Successfully!</strong></p>
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
          <div class="box-content"> <a href="#" class="add-button"><span>Add new User</span></a>
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