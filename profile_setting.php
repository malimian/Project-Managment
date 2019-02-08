<?php
include 'header.php';

$sql = "Select * From user Where uid =".$_SESSION["uid"];
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
    <div class="small-nav"> <a href="#">Dashboard</a> <span>&gt;</span>List Of All Current Users </div>
    <!-- End Small Nav -->

    <!-- Main -->
    <div id="main">
      <div class="cl">&nbsp;</div>
      <!-- Content -->
      <div id="content">
<div class="box">
          <!-- Box Head -->
          <div class="box-head">
            <h2>Change Profile Settings</h2>
          </div>
          <!-- End Box Head -->
          <form action="" method="post">
            <!-- Form -->
            <div class="form">
              <p> <span class="req">max 25 characters</span>
                <label>User Name <span>(Required Field)</span></label>
                <input type="text" class="field size1" name="name" maxlength="25" value="<?php echo $row["uname"];?>">
              </p>
               <p> <span class="req">max 50 characters</span>
                <label>Password <span>(Required Field)</span></label>
                <input type="password" class="field size1" name="pass1" maxlength="50" value="<?php echo $row["upass"];?>">
              </p>
              <p> <span class="req">max 25 characters</span>
                <label>Confirm Password <span>(Required Field)</span></label>
                <input type="password" class="field size1" name="pass2" maxlength="50" value="<?php echo $row["upass"];?>">
              </p>
               <p> <span class="req">max 25 characters</span>
                <label>Email <span>(Required Field)</span></label>
                <input type="email" class="field size1" name="email" maxlength="25" value="<?php echo $row["uemail"];?>">
              </p>
               <p> <span class="req">max 14 characters</span>
                <label>Contact <span>(Required Field)</span></label>
                <input type="text" class="field size1" name="phoneno" maxlength="14" value="<?php echo $row["upno"];?>">
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
}
}
?>

           <?php
          if (isset($_POST['submit']) ) {
            # code...
            if ($_POST['pass1'] == $_POST['pass2'] && $_POST['pass1'] !="" ) {
              $name = $_POST['name'];
            $pass1 = $_POST['pass1'];
            $email = $_POST['email'];
            $phoneno = $_POST['phoneno'];

            $sql ="Update  user SET uname ='$name'  , uemail ='$email' ,  upno='$phoneno',  upass='$pass1' Where uid=".$_SESSION["uid"];

          if ($conn->query($sql) === TRUE) {
          echo '<div class="msg msg-ok">
      <p><strong>User Has Been Updated Successfully!</strong></p>
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