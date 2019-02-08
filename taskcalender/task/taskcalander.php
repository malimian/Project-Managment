<?php
include 'header.php';
if (isset($_SESSION['pid'])) {
 $sql = "Select * From timesheet where project_date='".date("Y").'-'.date("m").'-'.date("d")."' AND pid =".$_SESSION['pid'];
}
elseif($_SESSION['uid']==1){
$sql = "Select * From timesheet where project_date='".date("Y").'-'.date("m").'-'.date("d");
}
else{
$sql = "Select * From timesheet where project_date='".date("Y").'-'.date("m").'-'.date("d")."' AND uid =".$_SESSION["uid"];
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
            <h2 class="left">Task Calendar For Year <?php echo date("Y"); ?></h2>
            <div class="right">
              <label>search articles</label>
              <input type="text" class="field small-field" />
              <input type="submit" class="button" value="search" />
            </div>
          </div>
          <!-- End Box Head -->
<?php
function draw_calendar($month,$year,$task_is_or_not_is){

  /* draw table */
  $calendar = '<table cellpadding="0" cellspacing="0" class="calendar">';

  /* table headings */
  $headings = array('<font color="red">Sunday</font>','<font color="white">Monday</font>','<font color="white">Tuesday</font>','<font color="white">Wednesday</font>','<font color="white">Thursday</font>','<font color="white">Friday</font>','<font color="red">Saturday</font>');
  $calendar.= '<tr class="calendar-row"><td class="calendar-day-head">'.implode('</td><td class="calendar-day-head">',$headings).'</td></tr>';

  /* days and weeks vars now ... */
  $running_day = date('w',mktime(0,0,0,$month,1,$year));
  $days_in_month = date('t',mktime(0,0,0,$month,1,$year));
  $days_in_this_week = 1;
  $day_counter = 0;
  $dates_array = array();

  /* row for week one */
  $calendar.= '<tr class="calendar-row">';

  /* print "blank" days until the first of the current week */
  for($x = 0; $x < $running_day; $x++):
    $calendar.= '<td class="calendar-day-np"> </td>';
    $days_in_this_week++;
  endfor;

  /* keep going with days.... */
  for($list_day = 1; $list_day <= $days_in_month; $list_day++):
    $calendar.= '<td class="calendar-day">';
      /* add in the day number *  strlen(" to find length of digi/
      $calendar.= '<div class="day-number"><a href="dailyworkchart.php?date='.$year.'-0'.$month.'-0'.$list_day.'">'.$list_day.'</a></div>'; */


//these all pongrain was becase of adding zero :(


if ($task_is_or_not_is == true) {
    // output data of each row
 //echo  $result->fetch_assoc()['title'];

  $calendar.= '<div class="day-number">Worked Today<a href="dailyworkchart.php?date='.date("o").'-'.str_pad($month, 2, 0, STR_PAD_LEFT).'-'.str_pad($list_day, 2, 0, STR_PAD_LEFT).'">'.$list_day.'</a></div>';
  
}
else{

    $calendar.= '<div class="day-number"><a href="dailyworkchart.php?date='.date("o").'-'.str_pad($month, 2, 0, STR_PAD_LEFT).'-'.str_pad($list_day, 2, 0, STR_PAD_LEFT).'">'.$list_day.'</a></div>';
}
    


      /** QUERY THE DATABASE FOR AN ENTRY FOR THIS DAY !!  IF MATCHES FOUND, PRINT THEM !! **/
      $calendar.= str_repeat('<p> </p>',2);
      
    $calendar.= '</td>';
    if($running_day == 6):
      $calendar.= '</tr>';
      if(($day_counter+1) != $days_in_month):
        $calendar.= '<tr class="calendar-row">';
      endif;
      $running_day = -1;
      $days_in_this_week = 0;
    endif;
    $days_in_this_week++; $running_day++; $day_counter++;
  endfor;

  /* finish the rest of the days in the week */
  if($days_in_this_week < 8):
    for($x = 1; $x <= (8 - $days_in_this_week); $x++):
      $calendar.= '<td class="calendar-day-np"> </td>';
    endfor;
  endif;

  /* final row */
  $calendar.= '</tr>';

  /* end the table */
  $calendar.= '</table>';
  
  /* all done, return result */
  return $calendar;
}

$months = array(
    'January',
    'February',
    'March',
    'April',
    'May',
    'June',
    'July ',
    'August',
    'September',
    'October',
    'November',
    'December',
);
$count =0;
/* sample usages */

$task_is_or_not_is = false;

for ($i=1; $i <=12 ; $i++) { 
  # code...
  //shayad yahan p kaam kernae
  echo '<h2>'.$months[$count].' '.date("Y").'</h2>';

$sql = "Select * From timesheet where project_date='".date("o").'-'.str_pad($i, 2, 0, STR_PAD_LEFT)."'";
echo $sql;

$result = $conn->query($sql);

if ($result->num_rows > 0) {
 while($row = $result->fetch_assoc()) {
  echo draw_calendar($i,date("o"),$task_is_or_not_is=true);
}
}
else{
  echo "googlesssss";
  echo draw_calendar($i,date("o"),$task_is_or_not_is=false);
}


  $count++;
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


<?php
include 'footer.php';
?>