<?php
        session_start();
        date_default_timezone_set("Asia/Karachi");
        include "db.php";

if(!(isset($_SESSION["login_user"])))
{
    
    header("Location: index.php");
    
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>HAT INC. Daily Task Manager</title>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
<script type="text/javascript" src="http://js.nicedit.com/nicEdit-latest.js"></script> <script type="text/javascript">
//<![CDATA[
        bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
  //]]>
  </script>
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.0/jquery.min.js"></script>
</head>
<body>
<!-- Header -->
<div id="header">
  <div class="shell">
    <!-- Logo + Top Nav -->
    <div id="top">
 <img src="css/images/logo/logo.png" style="height: 175%; width: 12%;">
      <div id="top-navigation"> Welcome <?php 
if (isset($_SESSION['pid'])) {
  echo "Sponser , ";
}
 ?><a href="#"><strong><?php echo $_SESSION['uname'];?></strong></a> <span>|</span> <a href="#">Help</a> <span>|</span> <a href="profile_setting.php">Profile Settings</a> <span>|</span> <a href="?logout">Log out</a> </div>
    </div>
    <!-- End Logo + Top Nav -->
    <!-- Main Nav -->
    <div id="navigation">
      <ul>
        <li><a href="dashboard.php" class="active"><span>Dashboard</span></a></li>
        <li><a href="all_tasks.php"><span>All Tasks</span></a></li>
        <li><a href="todays_work_report.php"><span>Todays Works Report</span></a></li>
        <li><a href="taskcalander.php"><span>Task Calendar</span></a></li>
         <?php
                if ($_SESSION["uid"]==1) {
               ?>
        <li><a href="user_managment.php"><span>User Management</span></a></li>
        <li><a href="projects_managment.php"><span>Project Management</span></a></li>
        <?php
        //        <li><a href="admintaskcalander.php"><span>Admin Task Calendar</span></a></li>
                 } 
                ?>
      </ul>
    </div>
    <!-- End Main Nav -->
  </div>
</div>
<!-- End Header -->
