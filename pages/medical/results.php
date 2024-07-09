<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<?php
include("../includes/css.php");
include("../../class.admin.php");
  $auth_item = new admin(); 
?>
<link href="../../dist/css/jquery-ui.css?<?php echo time(); ?>" rel="stylesheet"/>


  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->

  <link rel="stylesheet" href="../../dist/css/medic.css?<?php echo time(); ?>">
</head>
<style>

</style>
<body class="hold-transition skin-blue sidebar-mini sidebar-collapse "  >
<div class="wrapper">

<?php
include("../includes/main-header.php");
include("../includes/aside.php");
/*
  try {
  $db = new PDO('sqlite:medical_record.sqlite');

  $db->exec("CREATE TABLE medical_record(id INTEGER PRIMARY KEY, branch_id TEXT, purpose TEXT, drivers_id TEXT, bdate TEXT, surname TEXT, firstname TEXT, middlename TEXT, gender TEXT, marital TEXT, nationality TEXT, address TEXT, mobile  TEXT, emails TEXT, imgs TEXT, heights TEXT, weight TEXT, bp TEXT, blood_type TEXT,gen_phy TEXT,contagious_dis TEXT,upper_extrem TEXT,lower_extrem TEXT)"); 


} catch (Exception $e) {
  
}
*/


?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       APPLICANTS 
        <small> PAGES</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Medical</a></li>
        <li class="active">Step 1</li>
      </ol>
    </section>


    <section class="content"  style="margin-top: -15px;">
          <!-- Main content -->      <div class="row">
        <div class="col-xs-12">
  
          <!-- /.box -->

          <div class="box">
            <div class="box-header">
            <h4>
View 
        <small>Details of Clinis</small>
      </h4>
            </div>
            <!-- /.box-header -->

            <!-- /.box-body -->
          </div>
          <!-- /.box -->
      
      
      
      <div class="row">

  
          <!-- /.box -->

        </div>
        <!-- /.col (left) -->
        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Clinics</h3>
            </div>
            <div class="box-body">
              <!-- Date -->

              <!-- /.form group -->

              <!-- Date and time range -->
              <div class="form-group">
                <label></label>
           <div class="box-body">

            </div>
              </div>
              <!-- /.form group -->

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- iCheck -->
     
          <!-- /.box -->
        </div>
        <!-- /.col (right) -->
      </div>
      
      
      
      
      
        </div>


  </section>

  </div>

    <!-- /.content -->
    <?php
include("../includes/footer.php");
?>

  <!-- /.content-wrapper -->

    <?php
include("modal_exam.php");
?>
</div>
<!-- ./wrapper -->
<?php
include("../includes/js.php");
?>
<script src="../../dist/js/jquery-ui.min.js"></script>

<div class="modal fade" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog md-lg">
    <div class="modal-content">              
      <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <img src="" class="imagepreviews" style="width: 100%; " >
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="previewTest" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog md-lg">
    <div class="modal-content">              
      <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <img src="" class="imagepreviews" style="width: 100%; " >
      </div>
    </div>
  </div>
</div>

</body>
<script type="text/javascript">

    $(document).ready(function () {

//************************************EXAMINATION**********************************//

  var myArray = [
  "8.jpg",
  "12.jpg",
  "15.jpg",
  "35.jpg",
  "73.jpg",
  "74.png"
];
    var img_cnt=1;

    function  moveImage(){
      var answer=$.trim($("#color_answers").val());
      if(answer!==""){
       if(img_cnt<6){
      
    $("#color_exam").attr("src", "../../dist/test/"+myArray[img_cnt]);
     img_cnt++;
       $("#color_answers").val("");
                   }else{
                    $("#moveModal").modal("show");
    //$("#color_exam").attr("src", "../../dist/test/eye_test.jpg");                 
                   } 
   
                    }
                    $("#color_answers").focus();
    }
   $("#color_exam").attr("src", "../../dist/test/8.jpg");



    $("#submit-answer").click(function (e) {
                var data=$.trim($("#color_answers").val());
                if(data===""){
                        $("#color_answers").css('border-color','red');
                        step1_error++;
                        }else{
                         moveImage();
                        $("#color_answers").css('border-color','');  
                        }
        $("#color_answers").focus();
    return  false;
    });

      $(document).keypress(function(e) {
    if(e.which == 13) {
          var data=$.trim($("#color_answers").val());
                if(data===""){
                        $("#color_answers").css('border-color','red');
                        step1_error++;
                        }else{
                         moveImage();
                        $("#color_answers").css('border-color','');  
                        }
                       $("#color_answers").focus();
          return  false;
              }
            });


 
    $(document).on('click',"#proceed_next_exam1",function (e) {
    $("#moveModal").modal("hide");
    $("#set1").hide();
    $("#set2_1").show();
    $("#color_exam").attr("src", "../../dist/test/eye_test.jpg");   
    });

$('body').on('keydown', '#proceed_next_exam1', function (event) {
    var myself = this;
    if (event.keyCode === $.ui.keyCode.ENTER) {
      alert("123");
              event.stopPropagation();
    }
}); 
    $(document).on('click','.set2_1_btn',function (e) {
      $("#set2_1").hide();
      $("#set2_2").show();
    });


    $(document).on('click','.set2_2_btn',function (e) {
      $("#moveModal2").modal("show"); 
    });



    $(document).on('click',"#proceed_next_exam2",function (e) {
    $("#moveModal2").modal("hide");
    $("#set2_2").hide();
    $("#set3_1").show();
    $("#color_exam").attr("src", "../../dist/test/contrast.png");   
    });



    $(document).on('click','.set3_1_btn',function (e) {
      $("#set3_1").hide();
      $("#set3_2").show();
    });


    $(document).on('click','.set3_2_btn',function (e) {
      $("#moveModal3").modal("show"); 
    });


    $(document).on('click',"#proceed_next_exam3",function (e) {
    $("#moveModal3").modal("hide");
    $("#set3_2").hide();
    $("#set4").show();
    $("#color_exam").attr("src", "../../dist/test/hearing.jpg");   
    });


 $(document).on('click',"#play_sounds",function (e) {
        var x = document.getElementById("carteSoudCtrl"); 
          x.play(); 
          $("#set_msg_hearing").text();
});

var sounds_status="Left";

 $(document).on('click',"#play_sounds_left",function (e) {
        var x = document.getElementById("carteSoudCtrl"); 
          x.play(); 
          $("#set_msg_hearing").text();
          

});

 $(document).on('click',"#play_sounds_right",function (e) {
        var x = document.getElementById("carteSoudCtr2"); 
          x.play(); 
          $("#set_msg_hearing").text();
       

});


 $(document).on('click',".set4_1_btn",function (e) {


if(sounds_status==="Left"){
  sounds_status="Right";
  $("#play_sounds_left").attr("id", "play_sounds_right");
$("#set_msg_hearing").text("Listen again and where did you hear the sounds ??");
}else{
  sounds_status="Left";
    $("#play_sounds_right").attr("id", "play_sounds_left");
      $("#donemodal").modal("show");
}
  


});




//*****************************************8AUTOCHECKING********************************//

   $(document).on("ifChanged","#color_blind_exam_left",function(){
        if(this.checked) // if changed state is "CHECKED"
    {

$('#eye_left_color').iCheck('check'); //To check the radio button
    }
    else
    {
$('#eye_left_color').iCheck('uncheck'); //To check the radio button
   
    }
    });



   $(document).on("ifChanged","#color_blind_exam_right",function(){
        if(this.checked) // if changed state is "CHECKED"
    {

$('#eye_right_color').iCheck('check'); //To check the radio button
    }
    else
    {
$('#eye_right_color').iCheck('uncheck'); //To check the radio button
   
    }
    });



   $(document).on("ifChanged","#corrective_eye_right",function(){
        if(this.checked) // if changed state is "CHECKED"
    {

$('#eye_right_correction').iCheck('check'); //To check the radio button
    }
    else
    {
$('#eye_right_correction').iCheck('uncheck'); //To check the radio button
   
    }
    });


      $(document).on("ifChanged","#corrective_eye_left",function(){
        if(this.checked) // if changed state is "CHECKED"
    {

$('#eye_left_correction').iCheck('check'); //To check the radio button
    }
    else
    {
$('#eye_left_correction').iCheck('uncheck'); //To check the radio button
   
    }
    });




      $(document).on("ifChanged","#left_hearing_aid",function(){
        if(this.checked) // if changed state is "CHECKED"
    {

$('#hearing_left').iCheck('check'); //To check the radio button
    }
    else
    {
$('#hearing_left').iCheck('uncheck'); //To check the radio button
   
    }
    });


            
      $(document).on("ifChanged","#right_hearing_aid",function(){
        if(this.checked) // if changed state is "CHECKED"
    {

$('#hearing_right').iCheck('check'); //To check the radio button
    }
    else
    {
$('#hearing_right').iCheck('uncheck'); //To check the radio button
   
    }
    });
  $('.pop').on('click', function() {
      $('.imagepreviews').attr('src', $(this).find('img').attr('src'));
      $('#imagemodal').modal('show');   
      return false;
    });   
//*****************************************8AUTOCHECKING********************************//
//************************************VOICE**********************************//
      function  voice(messages){
          if ('speechSynthesis' in window) {
    speechSynthesis.onvoiceschanged = function() {
      //var $voicelist = $('#voices');

      //if($voicelist.find('option').length == 0) {
        speechSynthesis.getVoices().forEach(function(voice, index) {
          /*var $option = $('<option>')
          .val(index)
          .html(voice.name + (voice.default ? ' (default)' :''));

          $voicelist.append($option);*/
         // console.log(voice.name);
        });

      //  $voicelist.material_select();
     // }
    }

      var text = messages;
      var msg = new SpeechSynthesisUtterance();
      var voices = window.speechSynthesis.getVoices();
      msg.voice = voices[$('#voices').val()];
      msg.rate = 10 / 10;
      msg.pitch = 0;
      msg.text = text;
      msg.onend = function(e) {
      //  console.log('Finished in ' + event.elapsedTime + ' seconds.');
      };
     // speechSynthesis.speak(msg);
  }
      }

//************************************STEP3**********************************//

  $('#done').on('click', function() {
   window.location.replace("results");
      return false;
    });   

    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
    });
    }); 
</script>
</html>
