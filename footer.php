<div id="footer">
  <div class="shell"> <span>&copy; <?php echo date("o");?>- <a href="http://www.hatinco.com/">HAT Inc. 2019</a></span></div>
</div>
</body>
</html>
<?php
if (isset($_GET['logout'])) {
	// remove all session variables
session_unset(); 

// destroy the session 
session_destroy(); 

  echo "<script> window.location.href = 'index.php';</script>";
}

?>