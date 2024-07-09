<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<?php
session_start();
include("../includes/css.php");
include("../../class.admin.php");
  $auth_item = new admin(); 

  try{
  $stmt_settings = $auth_item->runQuery("SELECT * FROM tbl_settings WHERE purpose='path_to_production'");
  $stmt_settings->execute();
  $row_settings=$stmt_settings->fetch(PDO::FETCH_ASSOC);
  $path_to_prod=$row_settings['value'];
  }
    catch(PDOException $e)
    {
      echo $e->getMessage();
    }
     $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';   
        $input_length =strlen($permitted_chars);

        $random_string = '';
        for($i = 0; $i < 15; $i++) {
            $random_character = $permitted_chars[mt_rand(0, $input_length - 1)];
            $random_string .= $random_character;
        }

    $reference_no_generated=strtoupper($random_string);


  try{
    $Uid_temps=  $_SESSION['u_id'];
  $stmt_user= $auth_item->runQuery("SELECT * FROM medical_users WHERE id='$Uid_temps'");
  $stmt_user->execute();
  $row_user=$stmt_user->fetch(PDO::FETCH_ASSOC);
  $username_login=$row_user['username'];


  $clinic_user=$row_user['clinic'];
    $stmt_clinic = $auth_item->runQuery("SELECT * from tbl_clinics WHERE id ='$clinic_user' ");
    $stmt_clinic->execute();

    if($stmt_clinic->rowCount()>0)
    {
      
    $row_clinic=$stmt_clinic->fetch(PDO::FETCH_ASSOC);
     $lto_accreditation_no=$row_clinic['lto_accreditation_no'];
    }
    }
    catch(PDOException $e)
    {
      echo $e->getMessage();
    }





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

/* Large rounded green border */
hr.new5 {
  border: 10px solid skyblue;
  border-radius: 5px;
}
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
        <li class="active">Steps</li>
      </ol>
    </section>


    <section class="content"  style="margin-top: -15px;">
          <!-- Main content -->

    <section>
        <div class="wizard">
            <div class="wizard-inner">
                <div class="connecting-line"></div>
                <ul class="nav nav-tabs" role="tablist">

                    <li role="presentation" class="active">
                        <a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" title="Step 1">
                            <span class="round-tab">
                                <i class="glyphicon glyphicon-list-alt"></i>
                            </span>
                        </a>
                    </li>

                    <li role="presentation" class="disabled"  >
                        <a href="#step2" data-toggle="tab" aria-controls="step2" role="tab" title="Step 2">
                            <span class="round-tab" >
                                <i class="glyphicon glyphicon-pencil"></i>
                            </span>
                        </a>
                    </li>
                    <li role="presentation" class="disabled">
                        <a href="#step3" data-toggle="tab" aria-controls="step3" role="tab" title="Step 3">
                            <span class="round-tab">
                                <i class="glyphicon glyphicon-book"></i>
                            </span>
                        </a>
                    </li>

                            <li role="presentation" class="disabled">
                        <a href="#step4" data-toggle="tab" aria-controls="step3" role="tab" title="Step 3">
                            <span class="round-tab">
                                <i class="glyphicon glyphicon-book"></i>
                            </span>
                        </a>
                    </li>





                    <li role="presentation" class="disabled">
                        <a href="#complete" data-toggle="tab" aria-controls="complete" role="tab" title="Complete">
                            <span class="round-tab">
                                <i class="glyphicon glyphicon-ok"></i>
                            </span>
                        </a>
                    </li>
                </ul>
            </div>

            <form role="form">
                <div class="tab-content">
                    <div class="tab-pane active" role="tabpanel" id="step1">
                      <div class="container"  style="margin-top: -30px;">
                        <div class="row">
                        <?php  include("step1.php");?>
                      </div>
                        </div>
                        <ul class="list-inline pull-right">
                            <li><button id="step1_preview" type="button" class="btn btn-primary next-step">Save and continue</button></li>
                        </ul>
                    </div>
                    <div class="tab-pane" role="tabpanel" id="step2">
                      <div class="container"  style="margin-top: -30px;">
                        <div class="row">
                        <?php include("step2.php");?>
                      </div>
                        </div>
                        <ul class="list-inline pull-right">
                            <li><button type="button" class="btn btn-default prev-step">Previous</button></li>
                            <li><button   type="button" id="check_before_start" class="btn btn-primary ">Start Examinations</button></li>
                        </ul>
                    </div>
                    <div class="tab-pane" role="tabpanel" id="step3">
                       <div class="container"  style="margin-top: -30px;">
                        <div class="row">
     <?php include("examination.php");?>
                        </div>
                        </div>
                        <ul class="list-inline pull-right">
                            <li><button type="button" class="btn btn-default prev-step">Previous</button></li>
                            <li><button type="button" class="btn btn-default next-step">Skip</button></li>
                            <li><button id="step3_preview"  type="button" class="btn btn-primary btn-info-full next-step">Save and continue</button></li>
                        </ul>
                    </div>

                   <div class="tab-pane" role="tabpanel" id="step4">
                       <div class="container"  style="margin-top: -30px;">
                        <div class="row">
     <?php include("step3.php");?>
                        </div>
                        </div>
                        <ul class="list-inline pull-right">
                            <li><button type="button" class="btn btn-default prev-step">Previous</button></li>
                            <li><button type="button" class="btn btn-default next-step">Skip</button></li>
                            <li><button id="step4_preview"  type="button" class="btn btn-primary btn-info-full next-step">Save and continue</button></li>
                        </ul>
                    </div>
                    <div class="tab-pane" role="tabpanel" id="complete">
                           <?php include("step4.php");?>
                                           <ul class="list-inline pull-right">
                            <li><button type="button" class="btn btn-default prev-step">Previous</button></li>
             
                            <li><button type="button" id="preview_details" class="btn btn-primary btn-info-full ">Preview</button></li>
                        </ul>s
                    </div>
                    <div class="clearfix"></div>
                </div>
            </form>
        </div>
    </section>

  
  </div>
    <!-- /.content -->
    <?php
include("../includes/footer.php");
?>

  </div>
  <!-- /.content-wrapper -->

    <?php
include("modal_exam.php");
?>
</div>
<!-- ./wrapper -->

<?php

include("../includes/js.php");
?>

<script src="../../dist/js/webcam.min.js"></script>

</body>
<script type="text/javascript">




function loadPreviewInfo(){

      var bdate=$("#dob").val();
      var age=$("#age").val();
      var surname=$("#surname").val();
      var mname=$("#mname").val();
      var fname=$("#fname").val();
      var gender=$("#gender").val();
      var marital_status=$("#marital_status").val();
      var address=$("#address").val();

        //*******STEP2******//
      var heights=$("#heights").val(); 
      var weights=$("#weights").val(); 
      var bp=$("#bp").val(); 
      var bt=$("#blood_types").val(); 




       //*******STEP4******//
      var condition_driving=$("input[name='condition_driving']:checked").val();
      var driver_assessment=$("input[name='driver_assessment']:checked").val();
      var driver_remarks=$("#driver_recommendation").val(); 

      var img_data="";  
      img_data=$("#blah").attr('src');

      $("#previewName").text(fname+" "+mname+" "+surname);
      $("#previewAddress").text(address);
      $("#previewBday").text(bdate);
      $("#previewAge").text(age);
      $("#previewBday").text(bdate);
      $("#previewGender").text(gender);



      $("#previewStatus").text(marital_status);

      $("#previewHeight").text(heights);
      $("#previewWeight").text(weights);
      $("#previewBloodPressure").text(bp);

      if(bt===""){
        bt="DID NOT PROVIDE";
      }
      $("#previewBloodType").text(bt);

      var cons="";
      if(condition_driving==="0"){
        cons="None";
      }else 
      if(condition_driving==="1"){
        cons="Drive only with corrective lens";
      }else 
      if(condition_driving==="2"){
        cons=" Drive only with special equipment for upper limbs ";
      }else 
      if(condition_driving==="3"){
        cons="Drive only with special equipment for lower limbs";
      }else 
      if(condition_driving==="4"){
        cons="Drive only during daylight";
      }else 
      if(condition_driving==="5"){
        cons=" Drive with hearing aid";
      }



            var assessments="";
      if(driver_assessment==="1"){
        assessments="Fit to drive ";
      }else 
      if(driver_assessment==="2"){
        assessments=" Unfit to Drive";
      }else 
      if(driver_assessment==="3"){
        assessments=" Permanent";
      }else 
      if(driver_assessment==="4"){
        assessments="Temporary";
      }else 
      if(driver_assessment==="5"){
        assessments="Refer to Specialist for Further Evaluation";
      }

      $("#previewConditions").text(cons);
      $("#previewAssesment").text(assessments);
      $("#previewRemarks").text(driver_remarks);
     
}

//$("#previewExamModal").modal("show");
    //Initialize tooltips
  //  $('.nav-tabs > li a[title]').tooltip();
  //  $("#previewExamModal").modal("show");
 //   $("#proceeds_save").hide();
    //Wizard
function getBase64Image(img) {
  var canvas = document.createElement("canvas");
  canvas.width = img.width;
  canvas.height = img.height;
  var ctx = canvas.getContext("2d");
  ctx.drawImage(img, 0, 0);
  var dataURL = canvas.toDataURL("image/png");
  return dataURL.replace(/^data:image\/(png|jpg);base64,/, "");
}

    $('a[data-toggle="tab"]').on('show.bs.tab', function (e) {

        var $target = $(e.target);
    
        if ($target.parent().hasClass('disabled')) {
            return false;
        }
    });

    $(".next-step").click(function (e) {

        var $active = $('.wizard .nav-tabs li.active');

        var steps=$('.wizard .nav-tabs li.active').find('a[data-toggle="tab"]').attr("aria-controls");
        if(steps=="step1"){
                var step1_error=0;
                $('.required_item').each(function (index, value) {
                      //  console.log('item=' + index  );

                        var idx=$(this).attr('id');
                        var data=$(this).val();
                        if(data===""){
                        $("#"+idx).css('border-color','red');

                        step1_error++;
                        }else{
                        $("#"+idx).css('border-color','');  
                        }
                       
                        });
                if(step1_error>=1){
                   $.notify("Some field that are required are empty!! ","warning");
                    return false;
                }
        }




        $active.next().removeClass('disabled');
      
        nextTab($active);

    });
    $(".prev-step").click(function (e) {

        var $active = $('.wizard .nav-tabs li.active');
        prevTab($active);

    });


function nextTab(elem) {

    $(elem).next().find('a[data-toggle="tab"]').click();
}
function prevTab(elem) {
    $(elem).prev().find('a[data-toggle="tab"]').click();
}


  $(document).on("click","#check_before_start",function(){
        var steps=$('.wizard .nav-tabs li.active').find('a[data-toggle="tab"]').attr("aria-controls");
            if(steps=="step2"){
                var step1_error2=0;
                $('.required_item2').each(function (index, value) {
                       // console.log('item=' + index  );

                        var idx=$(this).attr('id');
                        var data=$(this).val();
                        if(data===""){
                        $("#"+idx).css('border-color','red');
                     
                        step1_error2++;
                        }else{
                        $("#"+idx).css('border-color','');  
                        }
                       
                        });
                if(step1_error2>=1){
                   $.notify("Some field that are required are empty!! ","warning");          
                     return false;
                }
        }
$("#proceedExamModal").modal("show");

    });

    $(document).on("click","#proceeds",function(){
        var $active = $('.wizard .nav-tabs li.active');
        $active.next().removeClass('disabled');
        nextTab($active);
        $("#proceedExamModal").modal("hide");
        voice("Welcome  To Computerize Medical Examination System");
    });

/*
window.onbeforeunload = function() {
   return "Do you really want to leave our brilliant application?";
   //if we return nothing here (just calling return;) then there will be no pop-up question at all
   //return;
};*/
//************************************STEP1**********************************//
 Webcam.set({
        width: 150,
        height:110,
        image_format: 'jpeg',
        jpeg_quality: 90
    });
  
    Webcam.attach( '#my_camera' );

    function take_snapshot() {

        Webcam.snap( function(data_uri) {
            $(".image-tag").val(data_uri);
            document.getElementById('results').innerHTML = '<img id="blah" class="img-thumbnail" style="width:260px; height:90px;" src="'+data_uri+'"/>';
        //          var base64 = getBase64Image(document.getElementById("blah"));
      //console.log(base64);
        } );



    }



$('#dob').datepicker({
    onSelect: function(value, ui) {
    var today = new Date(), 
            age = today.getFullYear() - ui.selectedYear;
        $('#age').val(age);
    },
    dateFormat: 'yy-mm-dd', 
    maxDate: '+0d',
    changeMonth: true,
    changeYear: true,
    defaultDate: '-50yr',
    yearRange: '1930:2030'
});

  $(document).on("change","#transaction_types",function(){
var id= $(this).val() ;
  if($.trim(id)==="10"  ||  $.trim(id)==='10'){
   $("#license_number").attr("readonly", true); 
      $("#license_number").val("SL");
            }else  if($.trim(id)==="2"  ||  $.trim(id)==='2'){
$("#license_number").attr("readonly", true); 
      $("#license_number").val("NP");

           }else  if($.trim(id)==="2"  ||  $.trim(id)==='2'){
$("#license_number").attr("readonly", true); 
      $("#license_number").val("SL");
            }else{
     $("#license_number").attr("readonly", false); 
            }
    });



  $(document).on("click","#search_user",function(){

    $("#searchModal").modal("show");
      });
//************************************STEP2**********************************//

 $(document).on("ifChanged","#general_disabilities",function(){

        if(this.checked) // if changed state is "CHECKED"
    {
   $("#gen_phys_text").prop("disabled", false); 
    }
    else
    {
   $("#gen_phys_text").prop("disabled", true); 
   $("#gen_phys_text").val("");
    }
    });


  $(document).on("ifChanged","#contagious_disease",function(){
        if(this.checked) // if changed state is "CHECKED"
    {
   $("#cont_disease_text").attr("disabled", false); 
    }
    else
    {
   $("#cont_disease_text").attr("disabled", true); 
    $("#cont_disease_text").val("");
    }
    });


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
                       // step1_error++;
            $.notify("Some field that are required are empty!! ","warning");
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

            $.notify("Some field that are required are empty!! ","warning");
                       // step1_error++;
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


 var count_set4_1=0;
 $(document).on('click',".set4_1_btn",function (e) {

count_set4_1++;
if(sounds_status==="Left"){
  sounds_status="Right";
  $("#play_sounds_left").attr("id", "play_sounds_right");
$("#set_msg_hearing").text("Listen again and where did you hear the sounds?");
}else{
  sounds_status="Left";
    $("#play_sounds_right").attr("id", "play_sounds_left");
    
}
  
if(count_set4_1>=2){
   $(".next-step").click();
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
      speechSynthesis.speak(msg);
  }
      }

//************************************STEP3**********************************//


$('#last_seizure').datepicker({
    onSelect: function(value, ui) {
        var today = new Date(), 
        age = today.getFullYear() - ui.selectedYear;
        $('#age').val(age);
    },
       dateFormat: 'yy-mm-dd', 
    maxDate: '+0d',
    changeMonth: true,
    changeYear: true
});


 $(document).on("ifChanged","#diabetes",function(){

        if(this.checked) // if changed state is "CHECKED"
    {
    $(".diabetes_medic").attr('disabled', true); 
    $(".diabetes_medic").iCheck('uncheck');

    }
    else
    {

    $(".diabetes_medic").attr('disabled', false);
          $(".diabetes_medic").iCheck({
      radioClass   : 'iradio_flat-green'
    })
    }
    });



 $(document).on("ifChanged","#epilepsy",function(){
        if(this.checked) // if changed state is "CHECKED"
    {
    $(".metabolic_epilepsy").attr('disabled', true); 
    $(".metabolic_epilepsy").iCheck('uncheck');
    $("#last_seizure").attr("disabled", true); 
    }
    else
    {

    $("#last_seizure").attr("disabled", false); 
        $(".metabolic_epilepsy").attr('disabled', false); 
          $(".metabolic_epilepsy").iCheck({
      radioClass   : 'iradio_flat-green'
    })
    }
    });


  $(document).on("ifChanged","#Apnes",function(){
        if(this.checked) // if changed state is "CHECKED"
    {
      $(".metabolic_apnes").attr('disabled', true); 
      $(".metabolic_apnes").iCheck('uncheck');

    }
    else
    {
     $(".metabolic_apnes").attr('disabled', false);
      $(".metabolic_apnes").iCheck({
      radioClass   : 'iradio_flat-green'
    })
   
    }
    });



  $(document).on("ifChanged","#aggressive",function(){
        if(this.checked) // if changed state is "CHECKED"
    {
    $(".metabolic_aggressive").attr('disabled', true); 
    $(".metabolic_aggressive").iCheck('uncheck');

    }
    else
    {
     $(".metabolic_aggressive").attr('disabled', false);
      $(".metabolic_aggressive").iCheck({
      radioClass   : 'iradio_flat-green'
    })
   
    }
    });




  $(document).on("ifChanged","#Others",function(){
        if(this.checked) // if changed state is "CHECKED"
    {
    $(".metabolic_other").attr('disabled', true); 
      $(".metabolic_other").iCheck('uncheck');

    }
    else
    {

    $(".metabolic_other").attr('disabled', false);
          $(".metabolic_other").iCheck({
      radioClass   : 'iradio_flat-green'
    })
    }
    });



      //************************************FINALSTEP**********************************//
     $(document).on('click',"#preview_details",function (e) {
        
$("#previewModalInfo").modal("show");
loadPreviewInfo();
     });


      //************************************FINALSTEP**********************************//
     $(document).on('click',"#preview_show_modalScanner",function (e) {
        $("#previewModalInfo").modal("hide");
           bios()
     });




function bios(){
        var vDiv = document.getElementById('imagediv');
        vDiv.innerHTML = "";
        var image = document.createElement("img");
        image.id = "image";
        image.src = "../../dist/img/biometric.gif";
        vDiv.appendChild(image); 
        //  onStart();
        $("#previewExamModal").modal("show");   
}


$(document).on('click',"#proceeds_save",function (e) {
     console.log("Starting Scanning");
     var $this = $("#proceeds_save");

     $this.button('loading');
                 
$.ajax({
          url: 'http://localhost/java_bio/index.php',        
          type: 'POST',
  processData: false,
  contentType: false,
  success:function(result){
  //  console.log(result);
    var obj = jQuery.parseJSON(result);
 //  D
 // $this.button('reset');
  console.log("Starting Accessing Xampp");
                    var vDiv = document.getElementById('imagediv');
                    vDiv.innerHTML = "";
                    var image = document.createElement("img");
                    image.id = "image";
                    image.src ="http://localhost/java_bio/read/"+obj.img;
                    vDiv.appendChild(image); 
                    proceedData(obj.base64);
                  //  alert(result);
                   // alert("http://localhost/java_bio/read/"+result);

  }, error: function(err){
                                              console.log("error_problem_to_java");
                                              var $this = $("#proceeds_save");
                                              $this.button('reset');
                                          
                                             $.notify("Error : Xampp was not started please start xampp first to your pc ","warning");
                                  //console.log(JSON.stringify(err));
  }

});



    });

function proceedData(data_bio){
     //*******STEP1******//
      var transtype=$("#transaction_types").val();
      var license=$("#license_number").val();
      var bdate=$("#dob").val();
      var surname=$("#surname").val();
      var mname=$("#mname").val();
      var fname=$("#fname").val();
      var gender=$("#gender").val();
      var marital_status=$("#marital_status").val();
      var nationalities=$("#nationalities").val();
      var address=$("#address").val();
      var mobile=$("#mobile_num").val();
      var email=$("#email_add").val();

        //*******STEP2******//
      var heights=$("#heights").val(); 
      var weights=$("#weights").val(); 
      var bp=$("#bp").val(); 
      var bt=$("#blood_types").val(); 
      var gen=$("#gen_phys_text").val(); 
      var cont=$("#cont_disease_text").val();  
      var lower_extreme_left=$("input[name='lower_exte_left']:checked").val();
      var upper_extreme_left=$("input[name='upper_exte_left']:checked").val();     
      var lower_extreme_right=$("input[name='lower_exte_right']:checked").val();
      var upper_extreme_right=$("input[name='upper_exte_right']:checked").val();     
      var general_physique=$("input[name='general_physique']:checked").val();
      var contagious_disease=$("input[name='contagious_disease']:checked").val();



       //*******STEP3******//
      var metabolic_diabetes=$("input[name='metabolic_diabetes']:checked").val();   
      var under_medication_diabetes=$("input[name='under_medication_diabetes']:checked").val();   

      var metabolic_epilepsy=$("input[name='metabolic_epilepsy']:checked").val();   
      var under_medication_epilepsy=$("input[name='under_medication_epilepsy']:checked").val();   
      var last_seizure=$("#last_seizure").val();

      var metabolic_apnes=$("input[name='metabolic_apnes']:checked").val();   
      var under_medication_apnes=$("input[name='under_medication_apnes']:checked").val();   

      var metabolic_aggressive=$("input[name='metabolic_aggressive']:checked").val();   
      var under_medication_aggressive=$("input[name='under_medication_aggressive']:checked").val();   


      var metabolic_other=$("input[name='metabolic_other']:checked").val();   
      var under_medication_other=$("input[name='under_medication_other']:checked").val(); 


      var snellen_left=$("#snellen_left").val();
      var snellen_right=$("#snellen_right").val();  
      var eye_left_correction=$("input[name='eye_left_correction']:checked").val();
      var eye_right_correction=$("input[name='eye_right_correction']:checked").val();

      var eye_left_color=$("input[name='eye_left_color']:checked").val();
      var eye_right_color=$("input[name='eye_right_color']:checked").val();


      var hearing_left=$("input[name='hearing_left']:checked").val(); 
      var hearing_right=$("input[name='hearing_right']:checked").val(); 



       //*******STEP4******//
      var condition_driving=$("input[name='condition_driving']:checked").val();
      var driver_assessment=$("input[name='driver_assessment']:checked").val();
      var driver_remarks=$("#driver_recommendation").val(); 
      var duration_temporary=$("#duration_temporary").val(); 

      var img_data="";  
      img_data=$("#blah").attr('src');

      var base64 = getBase64Image(document.getElementById("blah"));
var temp_eye_left_correction="0";
var temp_eye_right_correction="0";
if(eye_left_correction=="correction_left"){ temp_eye_left_correction="1"; }
if(eye_right_correction=="correction_right"){ temp_eye_right_correction="1"; }




var temp_marital_status="";
if(marital_status=="Married"){ temp_marital_status="M";}else
if(marital_status=="Separated"){ temp_marital_status="P";}else
if(marital_status=="Single"){ temp_marital_status="S";}else
if(marital_status=="Widow"){ temp_marital_status="W";}else{ temp_marital_status="S";}

var temp_lower_extreme_left="";
if(lower_extreme_left=="Normal"){ temp_lower_extreme_left="1";}else
if(lower_extreme_left=="With Disability"){ temp_lower_extreme_left="2";}else
if(lower_extreme_left=="With Special Equipment"){ temp_lower_extreme_left="3";}


var temp_lower_extreme_right="";
if(lower_extreme_right=="Normal"){ temp_lower_extreme_right="1";}else
if(lower_extreme_right=="With Disability"){ temp_lower_extreme_right="2";}else
if(lower_extreme_right=="With Special Equipment"){ temp_lower_extreme_right="3";}


var temp_upper_extreme_left="";
if(upper_extreme_left=="Normal"){ temp_upper_extreme_left="1";}else
if(upper_extreme_left=="With Disability"){ temp_upper_extreme_left="2";}else
if(upper_extreme_left=="With Special Equipment"){ temp_upper_extreme_left="3";}

var temp_upper_extreme_right="";
if(upper_extreme_right=="Normal"){ temp_upper_extreme_right="1";}else
if(upper_extreme_right=="With Disability"){ temp_upper_extreme_right="2";}else
if(upper_extreme_right=="With Special Equipment"){ temp_upper_extreme_right="3";}
    
      var temp_gen="";
if(gender=="Male"){temp_gen="M";}else{temp_gen="F";}

var temp_driver_assessment="";
var temp_duration_temporary="";
if(driver_assessment=="1"){ temp_driver_assessment="Fit";}else
if(driver_assessment=="2"){ temp_driver_assessment="Unfit";}else
if(driver_assessment=="3"){ temp_driver_assessment="Temporary"; temp_duration_temporary=duration_temporary;}else
if(driver_assessment=="4"){ temp_driver_assessment="Permanent";}else
if(driver_assessment=="5"){ temp_driver_assessment="Refer";}


var temp_blood_type="";

if(bt=="O positive"){ temp_blood_type="O+";}else
if(bt=="O negative"){ temp_blood_type="O-";}else
if(bt=="A positive"){ temp_blood_type="A+";}else
if(bt=="A negative"){ temp_blood_type="A-";}else
if(bt=="B positive"){ temp_blood_type="B+";}else
if(bt=="B negative"){ temp_blood_type="B-";}else
if(bt=="AB positive"){ temp_blood_type="AB+";}else
if(bt=="AB negative"){ temp_blood_type="AB-";}



var jsonData=JSON.stringify(
{
  "physician_username":"<?php echo $username_login; ?>",
  "physician_biometrics": [data_bio],
  "lto_accreditation_no": "<?php echo $lto_accreditation_no; ?>",
  "Exam_Datas": [
    {
      "lto_client_id": "",
      "first_name": fname,
      "last_name": surname,
      "middle_name": mname,
      "address": address,
      "date_of_birth": bdate,
      "gender":temp_gen,
      "nationality": nationalities,
      "civil_status": temp_marital_status,
      "height": heights,
      "weight": weights,
      "purpose": transtype,
      "license_no": license,
      "condition": condition_driving,
      "assessment": temp_driver_assessment,
      "assessment_status": temp_driver_assessment,
      "medical_exam_date":"<?php echo date('Y-m-d');?>",
      "client_application_date": "<?php echo date('Y-m-d');?>",
      "itpcode": "",
      "reference_no": "<?php  echo $reference_no_generated; ?>",
      "physician_prc_license_no": "<?php echo $_SESSION['prc_license_number']; ?>",
      "occupation": "",
      "applicant_photo": base64,
      "blood_pressure": bp,
      "disability": general_physique,
      "disease": contagious_disease,
      "snellen_bailey_lovie_left": snellen_left,
      "snellen_bailey_lovie_right": snellen_right,
      "corrective_lens_left": temp_eye_left_correction,
      "corrective_lens_right": temp_eye_right_correction,
      "color_blind_left": eye_left_color,
      "color_blind_right": eye_right_color,
      "hearing_left": hearing_left,
      "hearing_right": hearing_right,
      "upper_extremities_left": temp_upper_extreme_left,
      "upper_extremities_right": temp_upper_extreme_right,
      "lower_extremities_left": temp_lower_extreme_left,
      "lower_extremities_right": temp_lower_extreme_right,
      "diabetes":metabolic_diabetes,
      "diabetes_treatment": under_medication_diabetes,
      "epilepsy": metabolic_epilepsy,
      "epilepsy_treatment": under_medication_epilepsy,
      "last_seizure":last_seizure,
      "sleepapnea": metabolic_apnes,
      "sleepapnea_treatment": under_medication_apnes,
      "mental": metabolic_aggressive,
      "mental_treatment": under_medication_aggressive,
      "other": metabolic_other,
      "other_treatment":under_medication_other,
      "other_medical_condition": "",
      "temporary_duration": temp_duration_temporary,
      "remarks": driver_remarks,
      "medical_certificate_validity": "<?php echo date("Y-m-d",strtotime("+60 days"));?>",
      "eye_color": 1,
      "blood_type": temp_blood_type
    }
  ]
});

    console.log(jsonData)
  console.log("Starting Saving to database data to dermalog API");
$.ajax({
             url: "https://dermalog.ph:7167/ords/dl_interfaces/interface_CLINICS/v1/med_exam_results",
             type: "POST",
             dataType: "json",
            contentType: 'application/json; charset=utf-8',                  
             data: jsonData,
             headers: {
            'Access-Control-Allow-Origin': '*',
            'Content-Type':'application/json'
           },
               // This is the important part
           xhrFields: {
              withCredentials: true
           },
           crossDomain: true,
           success: function(response){
              console.log("Starting Saving to database passed data to dermalog API");
              //  console.log((response));
               $("#proceeds_save").attr("disabled", "disabled");
                           var fd = new FormData();
                          fd.append('status',"7");
                         fd.append('img_data',img_data);
                          fd.append('transtype',transtype);
                          fd.append('license',license);
                          fd.append('bdate',bdate);
                          fd.append('surname',surname);
                          fd.append('mname',mname);
                          fd.append('fname',fname);
                          fd.append('gender',gender);
                          fd.append('marital_status',marital_status);
                          fd.append('nationalities',nationalities);
                          fd.append('address',address);
                          fd.append('mobile',mobile);
                          fd.append('email',email);

                          fd.append('heights',heights);
                          fd.append('weights',weights);
                          fd.append('bp',bp);
                          fd.append('bt',bt);
                          fd.append('gen',gen);
                          fd.append('cont',cont);
                          fd.append('lower_extreme_right',lower_extreme_right);
                          fd.append('upper_extreme_right',upper_extreme_right);
                          fd.append('lower_extreme_left',lower_extreme_left);
                          fd.append('upper_extreme_left',upper_extreme_left);
                          fd.append('general_physique',general_physique);
                          fd.append('contagious_disease',contagious_disease);



                          fd.append('metabolic_diabetes',metabolic_diabetes);
                          fd.append('under_medication_diabetes',under_medication_diabetes);
                          fd.append('metabolic_epilepsy',metabolic_epilepsy);
                          fd.append('under_medication_epilepsy',under_medication_epilepsy);
                          fd.append('last_seizure',last_seizure);
                          fd.append('metabolic_apnes',metabolic_apnes);
                          fd.append('under_medication_apnes',under_medication_apnes);
                          fd.append('metabolic_aggressive',metabolic_aggressive);
                          fd.append('under_medication_aggressive',under_medication_aggressive);
                          fd.append('metabolic_other',metabolic_other);
                          fd.append('under_medication_other',under_medication_other);

                          fd.append('snellen_left',snellen_left);
                          fd.append('snellen_right',snellen_right);
                          fd.append('eye_left_color',eye_left_color);
                          fd.append('eye_right_color',eye_right_color);

                          fd.append('eye_left_correction',eye_left_correction);
                          fd.append('eye_right_correction',eye_right_correction);
                          fd.append('hearing_left',hearing_left);
                          fd.append('hearing_right',hearing_right);




                          fd.append('condition_driving',condition_driving);
                          fd.append('driver_assessment',driver_assessment);
                          fd.append('duration_temporary',duration_temporary);
                          fd.append('driver_remarks',driver_remarks);


                          fd.append('reference_no_generated',"<?php echo $reference_no_generated; ?>");

                          fd.append('jsonData',jsonData);
                          
                              $.ajax({
                            url: "../../control/control_admin.php",
                            data: fd,
                            processData: false,
                            contentType: false,
                            type:'POST',
                            success:function(result){
                          //alert(result);
                           var $this = $("#proceeds_save");
                           $this.button('reset');
                           console.log("Done saving to server");
                              $.notify("Adding of medical record was successfull!! ","success");
                          
                                //  $this.html("Save");   
                                   $("#proceeds_save").removeAttr("disabled");
                                      //  oTable.ajax.reload();
                                  window.location.replace("../import/view_cert?uid=<?php echo base64_encode($reference_no_generated); ?>");
                
                                },
                               error: function(err){
                                              console.log("error_saving_to_database");
                                              var $this = $("#proceeds_save");
                                              $this.button('reset');
                                              failedLogs(jsonData);
                                            $.notify("Error saving record to cloud server database","warning");
                                  //console.log(JSON.stringify(err));
                               }

                                    });
                          //  var $this = $(this);
                          //  $this.html('Saving..');
                     



             },
             error: function(err){
                            console.log("error finger print");
                            var $this = $("#proceeds_save");
                            $this.button('reset');
                            failedLogs(jsonData);
                          $.notify("Invalid biometric please try again.. ","warning");
                //console.log(JSON.stringify(err));
             }
        }); 




}




    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
    });

    //failed logs
    function failedLogs(jsonData){
      console.log("Failed Data Record");
               var fd = new FormData();
              fd.append('status',"15");        
              fd.append('jsonData',jsonData);
                          
              $.ajax({
              url: "../../control/control_admin.php",
              type: 'POST',
              data: fd,
              processData: false,
              contentType: false,
              success:function(result){
                console.log(result);
              

              }, error: function(err){
                       console.log(err);                                
              }

            });
    }


    //email validation
 function IsEmail(email) {
  var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  if(!regex.test(email)) {
    return false;
  }else{
    return true;
  }
                    }
</script>
</html>
