<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin Medical</title>
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


  try{
    $Uid_temps=  $_SESSION['u_id'];
  $stmt_user= $auth_item->runQuery("SELECT username,clinic,email FROM medical_users WHERE id='$Uid_temps'");
  $stmt_user->execute();
  $row_user=$stmt_user->fetch(PDO::FETCH_ASSOC);
  //$username_login=$row_user['username'];

  $username_login=$row_user['email'];


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

$permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';   
        $input_length =strlen($permitted_chars);

        $random_string = '';
        for($i = 0; $i <5; $i++) {
            $random_character = $permitted_chars[mt_rand(0, $input_length - 1)];
            $random_string .= $random_character;
        }
     $reference_no_generated="";
    $reference_no_generated=strtoupper($random_string).strtotime(date('Y-m-d H:i:s'));
    

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
<body class="hold-transition skin-blue sidebar-mini sidebar-collapse ">


<?php
include("../includes/main-header.php");
include("../includes/aside.php");

?>
  <!-- Content Wrapper. Contains page content -->
      <div class="wrapper" style="background: white;">
      <main class="content">
                    <div class="row mb-3">
                        <div class="header-card card p-4">
                            <div class="d-flex justify-content-between align-items-center mt-2">
                                <div>
                                    <h2 class="color-purple">Applicants</h2>
                                    <h6 class="text-secondary">Medical Examination</h6>
                                </div>
                                <div class="text-end">
                                    <h6 class="text-secondary">Welcome User :  <?php echo $_SESSION['full_names'];  ?></h6>
                                    <h6 id="current-date" class="text-secondary">---</h6>
                                </div>
                            </div>
                        </div>
                    </div>

 <!-- Start Medical Modal -->
                    <div id="start-medical-modal" class="modal" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <div class="row justify-content-end me-2">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="p-5 text-center">
                                        <img class="img-fluid" src="../../assets/main/start-medical-modal-bg.png">
                                        <h4>START MEDICAL EXAMINATION?</h4>
                                        <div class="w-100 mt-4">
                                            <button id="go-to-step-3" data-bs-dismiss="modal"
                                                class="btn text-white fw-bold fs-5 w-50"
                                                style="background-color: #520CF3;">Proceed</button>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <!-- Vision test 1 image -->
                    <div id="vision-question-1" class="modal" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered modal-xl">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <div class="row justify-content-end me-2">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="text-center p-5">
                                        <img src="../../assets/main/vision-test-question-1.png">
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <!-- Vision test 2 image -->
                    <div id="vision-question-2" class="modal" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered modal-xl">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <div class="row justify-content-end me-2">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="text-center p-5">
                                        <img src="../../assets/main/vision-test-question-2.png">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Open Acuity Test Modal -->
                    <div id="acuity-test-modal" class="modal" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <div class="row justify-content-end me-2">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="p-5 text-center">
                                        <img class="img-fluid"
                                            src="https://i.postimg.cc/7LBvmK1y/start-acuity-test-modal.png">
                                        <h4 class="mt-5">Next Examinations Visual Acuity Test</h4>
                                        <div class="w-100 mt-5">
                                            <button id="go-to-question-3" data-bs-dismiss="modal"
                                                class="btn text-white fw-bold fs-5 w-50"
                                                style="background-color: #520CF3;">Proceed</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Acuity test question 1 image -->
                    <div id="acuity-test-question-1" class="modal" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered modal-xl">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <div class="row justify-content-end me-2">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="text-center p-5">
                                        <img src="../../assets/main/acuity-test-question-1.png">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Contrast Sensitivity Test Modal -->
                    <div id="contrast-sensitivity-test-modal" class="modal" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <div class="row justify-content-end me-2">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="p-5 text-center">
                                        <img class="img-fluid"
                                            src="../../assets/main/start-contrast-sensitivity-test-modal.png">
                                        <h4 class="mt-5">Proceed to Next Examinations Contrast Sensitivity Test</h4>
                                        <div class="w-100 mt-5">
                                            <button id="go-to-question-5" data-bs-dismiss="modal"
                                                class="btn text-white fw-bold fs-5 w-50"
                                                style="background-color: #520CF3;">Proceed</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Contrast Sensitivity image -->
                    <div id="contrast-sensitivity-image" class="modal" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered modal-xl">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <div class="row justify-content-end me-2">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="text-center p-5">
                                        <img src="../../assets/main/contrast-sensitivity-test.png">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Hearing Test Modal -->
                    <div id="hearing-test-modal" class="modal" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <div class="row justify-content-end me-2">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="p-5 text-center">
                                        <img class="img-fluid" src="../../assets/main/start-hearing-test-modal.png">
                                        <h4 class="mt-5">Final Examinations Hearing Test</h4>
                                        <div class="w-100 mt-5">
                                            <button id="go-to-question-7" data-bs-dismiss="modal"
                                                class="btn text-white fw-bold fs-5 w-50"
                                                style="background-color: #520CF3;">Proceed</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


<div id="wizard">
                    <!-- Stepper -->
                    <div class="card mt-4" style="box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.25);">
                        <div  class=" row p-5 nav nav-tabs" role="tablist">

                            <div class="d-flex align-items-center">
                                <div class="text-center" role="presentation" class="active">
                                    <a href="#step1" class="steppers active" data-toggle="tab" aria-controls="step1" role="tab" title="Step 1">
                                    <i id="step-1-icon" class="material-icons align-middle mb-1 fs-2"
                                        style="color: #520CF3;">how_to_reg</i>
                                    <span class="fw-bold">Step 1</span>
                                    </a>
                                </div>
                                <div class="progress w-50 align-self-start mt-3" style="height: 5px;">
                                    <div id="step-1-progress" class="progress-bar" role="progressbar"
                                        style="width: 100%"></div>
                                </div>

                                <div class="text-center">
                                    <i id="step-2-icon"
                                        class="material-icons align-middle mb-1 fs-2">health_and_safety</i>
                                    <span class="fw-bold">Step 2</span>
                                </div>
                                <div class="progress w-50 align-self-start mt-3" style="height: 5px;">
                                    <div id="step-2-progress" class="progress-bar" role="progressbar"
                                        style="width: 100%"></div>
                                </div>


                                <div class="text-center">
                                    <i id="step-4-icon"
                                        class="material-icons align-middle mb-1 fs-2">medical_information</i>
                                    <span class="fw-bold">Step 3</span>
                                </div>
                                <div class="progress w-50 align-self-start mt-3" style="height: 5px;">
                                    <div id="step-4-progress" class="progress-bar" role="progressbar"
                                        style="width: 100%"></div>
                                </div>

                                <div class="text-center">
                                    <i id="done-icon" class="material-icons align-middle mb-5 fs-2">check_circle</i>
                                </div>

                            </div>

                        </div>
                    </div>




              <div class="row mb-3 mt-5">
                        <div class="col-lg-12">
                            <h6 id="reference-number" class="text-secondary">Reference #: <span
                                    style="color: #520CF3;">20JNQ1682688680</span> </h6>
                                <h6 id="accreditation-number" class="text-secondary">LTO Accreditation #:</h6>
                        </div>
                    </div>

 <?php
  $uid=base64_decode($_GET['uid']);
  try{
  $stmt = $auth_item->runQuery("SELECT mr.*,tc.name as clinicname,CONCAT(mu.fname,' ',mu.lname) as doc_fullname,mu.prc_license_number,mu.ptr_number from medical_record as  mr  
    INNER JOIN  tbl_clinics as  tc  ON  tc.id=mr.branch_id
    LEFT JOIN  medical_users as mu ON mu.id=mr.doctor_attended WHERE mr.uid='$uid'");
  $stmt->execute();
  $Row=$stmt->fetch(PDO::FETCH_ASSOC);
  }catch(PDOException $e)
    {
      echo $e->getMessage();
    } 



    ?>
      <form method="post" accept-charset="utf-8" name="form1">
      <input name="hidden_data" id='hidden_data' type="hidden"/>
    </form>
             
         
                        <?php include("step1.php");?>
                  
                        <?php include("step2.php");?>

                        <?php include("step3.php");?>
                       
                        <?php include("step4.php");?>
  
  </div>
    <!-- /.content -->
    <?php
include("../includes/footer.php");
?>
    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"
        integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
<script src="../../js/medical.examination.js"></script>
  </div>
  <!-- /.content-wrapper -->

    <?php
include("../medical/modal_exam.php");
?>
</div>
<!-- ./wrapper -->
<?php
include("../includes/js.php");
?>
<!-- <script src="../../dist/js/webcam.min.js"></script> -->
</body>
<script type="text/javascript">
var did_change_img="";
function getBase64Image(img) {
  var canvas = document.createElement("canvas");
  canvas.width = img.width;
  canvas.height = img.height;
  var ctx = canvas.getContext("2d");
  ctx.drawImage(img, 0, 0);
  var dataURL = canvas.toDataURL("image/png");
  return dataURL.replace(/^data:image\/(png|jpg);base64,/, "");
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
    defaultDate: '-18yr',
});



$('#dob').datepicker({
    onSelect: function(value, ui) {
    var today = new Date(), 
            age = today.getFullYear() - ui.selectedYear;
                       if ( ui.selectedMonth > today.getMonth() ) {
                console.log("Greather month : ");
               age=age-1;
            }
            if (today.getMonth() == ui.selectedMonth) {
                 console.log("Same Month With Date : " + today.getDate() + " : " + ui.selectedDay);
                 
                if ( parseInt(ui.selectedDay) > parseInt(today.getDate())) {
                     console.log("Greather Date : ");
                      age=age-1;
                }
            }
        $('#age').val(age);
    },
    dateFormat: 'yy-mm-dd', 
    maxDate: '+0d',
    changeMonth: true,
    changeYear: true,
    defaultDate: '-50yr',
    yearRange: '1900:2030'
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



  // $(document).on("click","#search_user",function(){

  //   $("#searchModal").modal("show");
  //     });
//************************************STEP2**********************************//



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



      //************************************FINALSTEP**********************************//


      //************************************FINALSTEP**********************************//
     $(document).on('click',"#preview_details",function (e) {

       loadPreviewInfo(); 
       $("#previewModalInfo").modal("show");
      // bios()
     });

      //************************************FINALSTEP**********************************//
     $(document).on('click',"#preview_show_modalScanner",function (e) {
        $("#previewModalInfo").modal("hide");
           bios()
     });

      //************************************FINALSTEP**********************************//


function bios(){
        var vDiv = document.getElementById('imagediv');
          vDiv.innerHTML = "";
                var image = document.createElement("img");
                    image.id = "image";
                    image.src = "../../dist/img/bio.jpg";
                     vDiv.appendChild(image); 
        //  onStart();
           $("#previewExamModal").modal("show");   
}

$(document).on('click',"#proceeds_save",function (e) {
     console.log("Starting Scanning");
     var $this = $("#proceeds_save");

     $this.button('loading');
                   console.log("Accessing Xampp");   
$.ajax({
  url: 'http://localhost/biometric/index.php',        
  type: 'POST',
  processData: false,
  contentType: false,

  cache: false,
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

    var uid="<?php echo  base64_decode($_GET['uid']); ?>";
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

      var lower_extreme_left=$("#lower_exte_left option:selected").val();
      var upper_extreme_left=$("#upper_exte_left option:selected").val();     
      var lower_extreme_right=$("#lower_exte_right option:selected").val();
      var upper_extreme_right=$("#upper_exte_right option:selected").val();

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
      //rgb(33, 37, 41)
      var eye_left_correction=$("input[name='eye_left_correction']:checked").val();
      var eye_right_correction=$("input[name='eye_right_correction']:checked").val();




      var eye_left_color=$("input[name='eye_left_color']:checked").val();
      var eye_right_color=$("input[name='eye_right_color']:checked").val();


      var hearing_left=$("#hearing_left option:selected").val(); 
      var hearing_right=$("#hearing_right option:selected").val(); 


      var eye_left_color_data=$("#eye_left_color_data").val(); 
      var eye_right_color_data=$("#eye_right_color_data").val(); 

      var med_diabetes=$("#med_diabetes").val(); 
      var med_epilepsy=$("#med_epilepsy").val(); 
      var med_apnea=$("#med_apnea").val(); 
      var med_disorder=$("#med_disorder").val(); 
      var med_other=$("#med_other").val(); 



      //*******STEP4******//
      //remove due to changes in the multiple selection
      //var condition_driving=$("input[name='condition_driving']:checked").val();
      var driver_assessment=$("input[name='driver_assessment']:checked").val();
      var driver_remarks=$("#driver_recommendation").val(); 
      var duration_temporary=$("#duration_temporary").val(); 

      var img_data="";  
      // img_data=$("#blah").attr('src');
      // img_data=$("#canvas").attr('src');
      
/*
      var base64 = getBase64Image(document.getElementById("blah"));*/

      var img_temp="";
      //img_temp=$(".profile-pic")[0];
      img_temp=$("#canvas")[0];
      var canvas = document.getElementById("canvas");
      var dataURL = canvas.toDataURL("image/png");
      var base64 = getBase64Image(dataURL);


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
var temp_driver_assessment2="";
/*if(driver_assessment=="1"){ temp_driver_assessment="Fit"; temp_driver_assessment2="Fit";}else
if(driver_assessment=="2"){ temp_driver_assessment="Unfit"; temp_driver_assessment2="Unfit";}else
if(driver_assessment=="3"){ temp_driver_assessment="Temporary"; temp_duration_temporary=duration_temporary;  temp_driver_assessment2="Fit";}else
if(driver_assessment=="4"){ temp_driver_assessment="Permanent"; temp_driver_assessment2="Unfit";}else
if(driver_assessment=="5"){ temp_driver_assessment="Refer"; temp_driver_assessment2="Unfit";}
*/
/// Unfit -> Temporary
/// Unfit - > Unfit



if(driver_assessment=="1"){ temp_driver_assessment="Fit"; temp_driver_assessment2="Fit";}else
if(driver_assessment=="2"){ temp_driver_assessment="Unfit"; temp_driver_assessment2="Temporary";}else
if(driver_assessment=="3"){ temp_driver_assessment="Fit"; temp_duration_temporary=duration_temporary;  temp_driver_assessment2="Temporary";}else
if(driver_assessment=="4"){ temp_driver_assessment="Unfit"; temp_driver_assessment2="Permanent";}else
if(driver_assessment=="5"){ temp_driver_assessment="Unfit"; temp_driver_assessment2="Refer";}

var temp_blood_type="";

if(bt=="O positive"){ temp_blood_type="O+";}else
if(bt=="O negative"){ temp_blood_type="O-";}else
if(bt=="A positive"){ temp_blood_type="A+";}else
if(bt=="A negative"){ temp_blood_type="A-";}else
if(bt=="B positive"){ temp_blood_type="B+";}else
if(bt=="B negative"){ temp_blood_type="B-";}else
if(bt=="AB positive"){ temp_blood_type="AB+";}else
if(bt=="AB negative"){ temp_blood_type="AB-";}else{
  temp_blood_type="-";
}
 ///*****************MULTIPLE CONDITION********************************//
        var multiple_condition="";
        $("input:checkbox[name=condition_driving]:checked").each(function(){
   // yourArray.push($(this).val());
              
                multiple_condition=$(this).val()+","+ multiple_condition;
              

        });
            //console.log(multiple_condition.slice(0,-1));
            //console.log(multiple_condition.charAt(0));
        var condition_driving = multiple_condition.charAt(0); 
        if(condition_driving===0){condition_driving="";}    
        multiple_condition=multiple_condition.slice(0,-1);  
      if(multiple_condition==="" || multiple_condition==='' || multiple_condition===0 || multiple_condition==="0"){
            multiple_condition="1";
        }
 ///*****************MULTIPLE CONDITION********************************//
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
      "license_no": "",
      //"license_no": license,
      "condition": multiple_condition,
      "assessment": temp_driver_assessment,
      "assessment_status": temp_driver_assessment2,
      "medical_exam_date":"<?php echo date('Y-m-d');?>",
      "client_application_date": "<?php echo date('Y-m-d');?>",
      "itpcode": "",
      "reference_no": "<?php echo $reference_no_generated; ?>",
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
      "other_medical_condition": multiple_condition,
      "temporary_duration": temp_duration_temporary,
      "remarks": driver_remarks,
      "medical_certificate_validity": "<?php echo date("Y-m-d",strtotime("+60 days"));?>",
      "eye_color":eye_right_color_data,
      "blood_type": temp_blood_type
    }
  ]
});







    console.log(jsonData)
    var items = Array("call.php", "call1.php","call2.php","call3.php","call4.php","call5.php");
    var calldata = items[Math.floor(Math.random()*items.length)];

   var fd = new FormData();
    fd.append('json',jsonData);
$.ajax({
             url: "../medical/call/"+calldata,
             type: "POST",        
             data: fd,
             processData: false,
             contentType: false,
             type:'POST',
             xhrFields: {
              withCredentials: true
             },
           crossDomain: true,
             success: function(response){



            var check_status=$.trim(response);

                        if(check_status!=="failed" || check_status!='failed'){
          var $this = $(this);
          $this.html('Saving..');
        $("#proceeds_save").attr("disabled", "disabled");
         var fd = new FormData();
        fd.append('status',"8");
        fd.append('img_data',dataURL);
        fd.append('uid',uid);
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

        fd.append('eye_right_color_data',eye_right_color_data);
        fd.append('eye_left_color_data',eye_left_color_data);


        fd.append('med_diabetes',med_diabetes);
        fd.append('med_epilepsy',med_epilepsy);
        fd.append('med_apnea',med_apnea);
        fd.append('med_disorder',med_disorder);
        fd.append('med_other',med_other);


        fd.append('condition_driving',condition_driving);
        fd.append('driver_assessment',driver_assessment);
        fd.append('duration_temporary',duration_temporary);
        fd.append('driver_remarks',driver_remarks);

        
        fd.append('internal_reference_no',check_status);

        fd.append('reference_no_generated',"<?php echo $reference_no_generated; ?>");
        fd.append('did_change_img',did_change_img);
            $.ajax({
          url: "../../control/control_admin.php",
          data: fd,
          processData: false,
          contentType: false,
          
  cache: false,
          type:'POST',
          success:function(result){
            console.log(result);
            $.notify("Updating of medical record was successfull!! ","success");
            setTimeout(function() {
                $this.html("Save");   
                 $("#proceeds_save").removeAttr("disabled");
                //location.reload();

                window.location.replace("../import/view_cert?uid=<?php echo base64_encode($reference_no_generated); ?>");
            }, 2000);
              }, error: function(err){
                                              console.log("error_saving_to_database");
                                              var $this = $("#proceeds_save");
                                              $this.button('reset');
                                          
                                          $.notify("Error saving record to cloud server database","warning");
                                  //console.log(JSON.stringify(err));
                               }

                  });
            
                        }else if(check_status==="failed" || check_status==='failed'){
                           $.notify("Invalid biometric or connection to network problem please try again.. ","warning");
                            console.log("error finger print");
                            var $this = $("#proceeds_save");
                            $this.button('reset');
                            //failedLogs(jsonData);
                        }else{
                           $.notify("Failed to upload... try to relogin your account it may be cache error ","warning");
                            console.log("error finger print");
                            var $this = $("#proceeds_save");
                            $this.button('reset');
                            //failedLogs(jsonData);
                        }

             },
             error: function(err){
                            console.log("error");
                           var $this = $("#proceeds_save");
                           $this.button('reset');
                        
                           $.notify("Internet Connection Timeout Check your ISP provider.. ","warning");
                //console.log(JSON.stringify(err));
             }
        }); 


}
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
              //  console.log(result);
              

              }, error: function(err){
                       console.log(err);                                
              }

            });
    }
   

    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
    });




function loadPreviewInfo(){


        //*******STEP1******//
      var transaction_types = $("#transaction_types option:selected").text();
      var bdate=$("#dob").val();
      var age=$("#age").val();
      var surname=$("#surname").val();
      var mname=$("#mname").val();
      var fname=$("#fname").val();
      var gender=$("#gender").val();
      var marital_status=$("#marital_status").val();
      var address=$("#address").val();
      var nationality = $("#nationality option:selected").text();
     

      $("#previewNationality").text(nationality);


        //*******STEP2******//
      var heights=$("#heights").val(); 
      var weights=$("#weights").val(); 
      var bp=$("#bp").val(); 
      var bt=$("#blood_types").val(); 
      var upper_exte_left = $("#upper_exte_left option:selected").text();
      var upper_exte_right = $("#upper_exte_right option:selected").text();

      $("#previewupper_exte_left").text(upper_exte_left);
      $("#previewupper_exte_right").text(upper_exte_right);      
      var lower_exte_left = $("#lower_exte_left option:selected").text();
      var lower_exte_right = $("#lower_exte_right option:selected").text();
      $("#previewlower_exte_left").text(lower_exte_left);
      $("#previewlower_exte_right").text(lower_exte_right);   


       //*******STEP4******//
      //var condition_driving=$("input[name='condition_driving']:checked").val();

 
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

      $("#previewTransaction_types").text(transaction_types);


      if(bt===""){
        bt="DID NOT PROVIDE";
      }
      $("#previewBloodType").text(bt);

      var multiple_condition_preview="";
        $("input:checkbox[name=condition_driving]:checked").each(function(){
   // yourArray.push($(this).val());
              
                multiple_condition_preview=$(this).val()+","+ multiple_condition_preview;
              

        });

      multiple_condition_preview=$.trim(multiple_condition_preview);

      var cons="";
      if(multiple_condition_preview.indexOf('0') != -1 ){
        cons="None";
      }else{ 
      if(multiple_condition_preview.indexOf('1') != -1){
        cons="Drive only with corrective lens";
      } 
      if(multiple_condition_preview.indexOf('2') != -1){
        cons=cons+" / Drive only with special equipment for upper limbs ";
      } 
      if(multiple_condition_preview.indexOf('3') != -1){
        cons=cons+" / Drive only with special equipment for lower limbs";
      } 
      if(multiple_condition_preview.indexOf('4') != -1){
        cons=cons+" / Drive only during daylight";
      } 
      if(multiple_condition_preview.indexOf('5') != -1){
        cons=cons+" /  Drive with hearing aid";
      }

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
      }else{
         assessments="Fit to drive ";
      }

      $("#previewConditions").text(cons);
      $("#previewAssesment").text(assessments);
      $("#previewRemarks").text(driver_remarks);
     
}


</script>
</html>
