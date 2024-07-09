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
    maxDate: '+0d',
    changeMonth: true,
    changeYear: true,
    defaultDate: '-18yr',
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
   var obj = jQuery.parseJSON(result);
 //  console.log(obj.img);  
 // $this.button('reset');
                 var vDiv = document.getElementById('imagediv');
                    vDiv.innerHTML = "";
                    var image = document.createElement("img");
                    image.id = "image";
                    image.src ="http://localhost/java_bio/read/"+obj.img;
                    vDiv.appendChild(image); 
                    proceedData(obj.base64);
                  //  alert(result);
                   // alert("http://localhost/java_bio/read/"+result);

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
      var eye_left_color=$("input[name='eye_left_color']:checked").val();
      var eye_right_color=$("input[name='eye_right_color']:checked").val();
      var eye_left_correction=$("input[name='eye_left_correction']:checked").val();
      var eye_right_correction=$("input[name='eye_right_correction']:checked").val();

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
  "physician_username": "LTO-QA3060.LTO-QA.LOCAL",
  "physician_biometrics": ["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"],
  "lto_accreditation_no": "MED-CLINIC-10112020",
  "Exam_Datas": [
    {
      "lto_client_id": "",
      "first_name": fname,
      "last_name": surname,
      "middle_name": mname,
      "address": address,
      "date_of_birth": "1990-12-22T22:00:00Z",
      "gender":temp_gen,
      "nationality": "PHL",
      "civil_status": temp_marital_status,
      "height": heights,
      "weight": weights,
      "purpose": transtype,
      "license_no": "",
      "condition": condition_driving,
      "assessment": temp_driver_assessment,
      "assessment_status": temp_driver_assessment,
      "medical_exam_date": "2019-10-26T15:00:00Z",
      "client_application_date": "2019-12-15T15:00:00Z",
      "itpcode": "",
      "reference_no": "",
      "physician_prc_license_no": "19-0000011",
      "occupation": "",
      "applicant_photo": base64,
      "blood_pressure": bp,
      "disability": "",
      "disease": "",
      "snellen_bailey_lovie_left": 35,
      "snellen_bailey_lovie_right": 60,
      "corrective_lens_left": 1,
      "corrective_lens_right": 1,
      "color_blind_left": 0,
      "color_blind_right": 0,
      "hearing_left": hearing_left,
      "hearing_right": hearing_right,
      "upper_extremities_left": temp_upper_extreme_left,
      "upper_extremities_right": temp_upper_extreme_right,
      "lower_extremities_left": temp_lower_extreme_left,
      "lower_extremities_right": temp_lower_extreme_right,
      "diabetes": 0,
      "diabetes_treatment": 0,
      "epilepsy": 0,
      "epilepsy_treatment": 0,
      "last_seizure": "",
      "sleepapnea": 0,
      "sleepapnea_treatment": 0,
      "mental": 0,
      "mental_treatment": 0,
      "other": 0,
      "other_treatment": 0,
      "other_medical_condition": "",
      "temporary_duration": temp_duration_temporary,
      "remarks": driver_remarks,
      "medical_certificate_validity": "2019-12-31T11:00:00Z",
      "eye_color": 1,
      "blood_type": temp_blood_type
    }
  ]
});

    console.log(jsonData)

$.ajax({
             url: "https://dermalog.ph:6167/ords/dl_interfaces/interface_CLINICS/v1/med_exam_results",
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
              //  console.log((response));
             
                          //  var $this = $(this);
                          //  $this.html('Saving..');
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
                              $.ajax({
                            url: "../../control/control_admin.php",
                            data: fd,
                            processData: false,
                            contentType: false,
                            type:'POST',
                            success:function(result){
                          // alert(result);
                           var $this = $("#proceeds_save");
                           $this.button('reset');
                           console.log("done");
                              $.notify("Add of medical record was successfull!! ","success");
                              setTimeout(function() {
                                //  $this.html("Save");   
                                   $("#proceeds_save").removeAttr("disabled");
                                      //  oTable.ajax.reload();
                              window.location.replace("../settings/reports");
                              }, 2000);
                                }

                                    });



             },
             error: function(err){
              console.log("error");
                                         var $this = $("#proceeds_save");
                           $this.button('reset');
                        
                              $.notify("Invalid biometric please try again ","warning");
                //console.log(JSON.stringify(err));
             }
        }); 









}
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
    });

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
