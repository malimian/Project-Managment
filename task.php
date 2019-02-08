    <?php
    include 'header.php';
    $task_id = $_GET['id'];

    $sql = "Select * From timesheet Where t_id =".$task_id;
    $result = $conn->query($sql);

    // if ($result->num_rows > 0) {
        // output data of each row
  
    $row = $result->fetch_assoc();
      // print_r($row);
      // die();
        // while($row = $result->fetch_assoc()) {
    ?>

    <style type="text/css">
     .checked {
          color: orange;
      }
      .rating{
        float: left;
        text-align: left;
        padding-left: 9px;
      }
      .buttons{
            height: 83px;
      }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
                <h2>Task Posted On <?php echo $row["posttime"] ; ?></h2>
              </div>
              <!-- End Box Head -->
                <!-- Form -->
                <div class="form">
                  <p> <span class="req">Max 100 Charaters</span>
                    <h1 style="color:#6fb344"> <?php echo $row["title"] ; ?></h1>
                  </p>
                       <!-- Making Box For Posted Time -->
              <div class="makeboxer">
        <?php
    //($_SESSION["uid"]==1) && 
           if (($_SESSION["uid"]==1) && isset($_POST['timeline'])) {

              $timeline = $_POST['timeline'];
              $specification = $_POST['specification'];
              $communication = $_POST['communication'];
              $comments = $_POST['comments'];
              $task_id = $_POST['id'];


              $sql = "Update timesheet SET timeline_rating = '$timeline' , specification_rating = '$specification' , communication_rating='$communication' , comments='$comments'  Where t_id =".$task_id;
        
              if ($conn->query($sql) === TRUE) {

                  $response = ['status'=>true];

              }   
              else{
                  $response = ['status'=>false];
              }      
              return json_encode($response);
           }

            $time1 =explode(":", $row["timming_in"]);
            $time2 =explode(":", $row["timming_out"]);

            $time3 = $time2[0]-$time1[0];
            $time4 = $time2[1]-$time1[1];

            ?>
                
              <span class="right"><h2> Time Spent : <?php echo $time3;?> Hours <?php echo $time4;?> Minutes</h2></span>
            <time datetime="<?php echo $row["project_date"] ; ?>" pubdate="pubdate">
            <h2>Published on <?php echo $row["project_date"] ; ?></h2></time>
                
          </div>
          <div class="makeboxer">
            <!-- Making Box For Posted Time -->
                 <p class="inline-field"> 
                    <label >Timming In : <?php echo $row["timming_in"] ; ?> </label>
                    </p>
                    <p class="inline-field"> 
                    <label>Timming Out : <?php echo $row["timming_out"] ; ?></label>
                  </p>
                   <p class="inline-field"> 
                    <label>Attachments : <a style="color: blue;" href="javascript:void(0);" onclick="download_files('<?php echo $row["uploaded_files"];?>')">Download</a></label>
                  </p>
                  </div>

                  <p> <span class="req">max 100 symbols</span>
                    <label>Task Details: </label>
                    </p>
                    <div class="makeboxer">
                      <?php echo $row["work_details"] ; ?>
                    </div>
                  </p>
                </div>
                
                <!-- End Form -->
                <!-- Form Buttons -->
    <div class="buttons">
            <!-- begin wwww.htmlcommentbox.com -->

    <div class="rating">
      <label>Timeline</label>
      <div id="timeline">
       <!--  <span class="fa fa-star" onclick="add_stars('timeline',1)"></span>
        <span class="fa fa-star" onclick="add_stars('timeline',2)"></span>
        <span class="fa fa-star" onclick="add_stars('timeline',3)"></span>
        <span class="fa fa-star" onclick="add_stars('timeline',4)"></span>
        <span class="fa fa-star" onclick="add_stars('timeline',5)"></span> -->
        <!-- <span id="txt_timeline"></span> -->
      </div>
      <label>Specification</label>
      <div id="specification">
       <!--  <span class="fa fa-star" onclick="add_stars('specification',1)"></span>
        <span class="fa fa-star" onclick="add_stars('specification',2)"></span>
        <span class="fa fa-star" onclick="add_stars('specification',3)"></span>
        <span class="fa fa-star" onclick="add_stars('specification',4)"></span>
        <span class="fa fa-star" onclick="add_stars('specification',5)"></span> -->
        <!-- <span id="txt_specification"></span> -->
        
      </div>
      <label>Communication</label>
      <div id="communication">
       <!--  <span class="fa fa-star" onclick="add_stars('communication',1)"></span>
        <span class="fa fa-star" onclick="add_stars('communication',2)"></span>
        <span class="fa fa-star" onclick="add_stars('communication',3)"></span>
        <span class="fa fa-star" onclick="add_stars('communication',4)"></span>
        <span class="fa fa-star" onclick="add_stars('communication',5)"></span> -->
        
      </div>
    </div>
    </div>
    <input type="hidden" id="timeline_hidden">
    <input type="hidden" id="specification_hidden">
    <input type="hidden" id="communication_hidden">
     
    <div class="txt_area">
        <textarea id="comments" style="width: 100%; height: 100%;" rows="5"></textarea>
    <button style="padding: 9px 10px 5px 10px;" onclick="save_comments();">Save</button>  
    </div>

    <!-- end www.htmlcommentbox.com -->


               
                <!-- End Form Buttons -->

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
    // }
    // }
    ?>

    <?php
    include 'footer.php';
    ?>
    <script>

    function save_comments(){

      var my_url = $(location).attr("href");
      $.ajax({
          url:my_url,
          type:'POST',
          data:{
              timeline:$('#timeline_hidden').val(),
              specification:$('#specification_hidden').val(),
              communication:$('#communication_hidden').val(),
              comments:$('.nicEdit-main').html(), // for comments
              id:'<?php echo $_GET["id"]; ?>'
          },
          datatype:'json',
          success:function(data){
            // alert('Saved');
            location.reload();
          }
        });

    }

     $(function(){

        add_stars('timeline','<?=$row["timeline_rating"]?>')
        add_stars('specification','<?=$row["specification_rating"]?>')
        add_stars('communication','<?=$row["communication_rating"]?>')

        $('.nicEdit-main').html('<?=$row["comments"]?>');
      });

    function add_stars(rev_div,num_stars){

          var timeline = ["Very Late","Late","On Time","Moderately Ahead Of Time","Quite Ahead Of Time"];

          var specification = ["Did not meet the specification at all","Partially met the specification","Met the specification","Surpassed the specifically","Significantly surpassed the specification"];

          var communication = ["Very difficult","Difficult","Fine","Really good","Exceptional"];

            var star_html = '';
            for (var i = 1;i<=num_stars;i++){ 
                star_html =star_html+ '<span class="fa fa-star checked" onclick="add_stars(\''+rev_div+'\','+i+')"></span> ';
            }
            var i=parseInt(num_stars)+1;

            for( ;i<=5;i++){
              star_html =star_html+ '<span class="fa fa-star" onclick="add_stars(\''+rev_div+'\','+i+')"></span> ';
            }

            if(rev_div == 'timeline'){ 
              star_html = star_html+'<span id="txt_timeline">'+timeline[num_stars-1]+'</span>';

            }
            else if(rev_div == 'specification'){ 
              star_html = star_html+'<span id="txt_specification">'+specification[num_stars-1]+'</span>';
            }
            else{//communication
              star_html = star_html+'<span id="txt_communication">'+communication[num_stars-1]+'</span>';
            }

            console.log('#'+rev_div+'_hidden');
            $('#'+rev_div+'_hidden').val(num_stars);
            $('#'+rev_div).html(star_html);
        }

     

      function download_files(urls){

        var url_arr = urls.split(',');

        for(var i=0;i<url_arr.length;i++){
          console.log(url_arr[i]);
          download_from_url(url_arr[i]);
        }

        return false;

      }

      function download_from_url(myurl){
        setTimeout(function() {
      
       url = myurl;
        downloadFile(url); // UNCOMMENT THIS LINE TO MAKE IT WORK
      
    }, 2000);

    // Source: http://pixelscommander.com/en/javascript/javascript-file-download-ignore-content-type/
    window.downloadFile = function (sUrl) {

        //If in Chrome or Safari - download via virtual link click
        if (window.downloadFile.isChrome || window.downloadFile.isSafari) {
            //Creating new link node.
            var link = document.createElement('a');
            link.href = sUrl;
            link.setAttribute('target','_blank');

            if (link.download !== undefined) {
                //Set HTML5 download attribute. This will prevent file from opening if supported.
                var fileName = sUrl.substring(sUrl.lastIndexOf('/') + 1, sUrl.length);
                link.download = fileName;
            }

            //Dispatching click event.
            if (document.createEvent) {
                var e = document.createEvent('MouseEvents');
                e.initEvent('click', true, true);
                link.dispatchEvent(e);
                return true;
            }
        }

        // Force file download (whether supported by server).
        if (sUrl.indexOf('?') === -1) {
            sUrl += '?download';
        }

        window.open(sUrl, '_blank');
        return true;
    }

    window.downloadFile.isChrome = navigator.userAgent.toLowerCase().indexOf('chrome') > -1;
    window.downloadFile.isSafari = navigator.userAgent.toLowerCase().indexOf('safari') > -1;
      }
    </script>