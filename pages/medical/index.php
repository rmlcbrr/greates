<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin</title>
    <link rel="icon" type="image/x-icon" href="https://systechph-medical.com/assets/systech.png">

    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <link rel="stylesheet" href="../../css/medical.examination.css">

    <style>
        .card {
            border-radius: 15px
        }

        .input-group-text {
            background-color: #520CF3;
            color: white;
            font-weight: 500;
        }

        .progress-bar {
            background-color: gainsboro;
        }

        .disorder-card {
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.25);
        }

        .shadow-card {
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.25);
        }

        img#image {
            width: 200px;
            padding: 26px;
            border-radius: 35px;
        }
    </style>
    <?php

    session_start();
    include("../includes/css.php");
    include("../../class.admin.php");
    $auth_item = new admin();

    try {
        $stmt_settings = $auth_item->runQuery("SELECT value FROM tbl_settings WHERE purpose='path_to_production'");
        $stmt_settings->execute();
        $row_settings = $stmt_settings->fetch(PDO::FETCH_ASSOC);
        $path_to_prod = $row_settings['value'];
    } catch (PDOException $e) {
        echo $e->getMessage();
    }





    try {
        $Uid_temps =  $_SESSION['u_id'];
        $stmt_user = $auth_item->runQuery("SELECT username,clinic,email FROM medical_users WHERE id='$Uid_temps'");
        $stmt_user->execute();
        $row_user = $stmt_user->fetch(PDO::FETCH_ASSOC);
        //$username_login=$row_user['username'];

        $username_login = $row_user['email'];


        $clinic_user = $row_user['clinic'];
        $stmt_clinic = $auth_item->runQuery("SELECT lto_accreditation_no from tbl_clinics WHERE id ='$clinic_user' ");
        $stmt_clinic->execute();

        if ($stmt_clinic->rowCount() > 0) {

            $row_clinic = $stmt_clinic->fetch(PDO::FETCH_ASSOC);
            $lto_accreditation_no = $row_clinic['lto_accreditation_no'];
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }


    $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $input_length = strlen($permitted_chars);

    $random_string = '';
    for ($i = 0; $i < 5; $i++) {
        $random_character = $permitted_chars[mt_rand(0, $input_length - 1)];
        $random_string .= $random_character;
    }
    $reference_no_generated = "";
    $reference_no_generated = strtoupper($random_string) . strtotime(date('Y-m-d H:i:s'));

    ?>
    <link href="../../dist/css/jquery-ui.css?<?php echo time(); ?>" rel="stylesheet" />


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

    .content {
        padding: 0px 3rem 1.5rem !important;
    }
</style>

<body class="hold-transition skin-blue sidebar-mini  ">


    <?php
    include("../includes/main-header.php");

    ?>
    <div class="wrapper" style="background: white;">
        <main class="content">



            <!-- Start Medical Modal -->
            <div id="start-medical-modal" class="modal" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="row justify-content-end me-2">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="p-5 text-center">
                                <img class="img-fluid" src="../../assets/main/start-medical-modal-bg.png">
                                <h4>START MEDICAL EXAMINATION?</h4>
                                <div class="w-100 mt-4">
                                    <button id="go-to-step-3" data-bs-dismiss="modal" class="btn text-white fw-bold fs-5 w-50" style="background-color: #520CF3;">Proceed</button>
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
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="p-5 text-center">
                                <img class="img-fluid" src="https://i.postimg.cc/7LBvmK1y/start-acuity-test-modal.png">
                                <h4 class="mt-5">Next Examinations Visual Acuity Test</h4>
                                <div class="w-100 mt-5">
                                    <button id="go-to-question-3" data-bs-dismiss="modal" class="btn text-white fw-bold fs-5 w-50" style="background-color: #520CF3;">Proceed</button>
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
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="p-5 text-center">
                                <img class="img-fluid" src="../../assets/main/start-contrast-sensitivity-test-modal.png">
                                <h4 class="mt-5">Proceed to Next Examinations Contrast Sensitivity Test</h4>
                                <div class="w-100 mt-5">
                                    <button id="go-to-question-5" data-bs-dismiss="modal" class="btn text-white fw-bold fs-5 w-50" style="background-color: #520CF3;">Proceed</button>
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
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="p-5 text-center">
                                <img class="img-fluid" src="../../assets/main/start-hearing-test-modal.png">
                                <h4 class="mt-5">Final Examinations Hearing Test</h4>
                                <div class="w-100 mt-5">
                                    <button id="go-to-question-7" data-bs-dismiss="modal" class="btn text-white fw-bold fs-5 w-50" style="background-color: #520CF3;">Proceed</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div id="wizard">
                <!-- Stepper -->
                <div class="card mt-4 p-4" style="box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.25);">

                    <div class="d-flex justify-content-between align-items-center mt-2">
                        <div>
                            <h4 class="color-purple">Medical Examination</h4>
                            <h6 id="reference-number" class="text-secondary">Reference #: <span style="color: #520CF3;">20JNQ1682688680</span> </h6>
                        </div>
                        <div class="text-end">
                            <h6 class="text-secondary">Welcome User : <?php echo $_SESSION['full_names'];  ?></h6>
                            <h6 id="current-date" class="text-secondary">---</h6>
                            <h6 id="accreditation-number" class="text-secondary">LTO Accreditation #:<span style="color: #520CF3;">20JNQ1682688680</span></h6>
                        </div>
                    </div>

                    <div class=" row nav nav-tabs" role="tablist">
                        <div class="d-flex align-items-center">
                            <div class="text-center" role="presentation" class="active">
                                <a href="#step1" class="steppers active" data-toggle="tab" aria-controls="step1" role="tab" title="Step 1">
                                    <i id="step-1-icon" class="material-icons align-middle mb-1 fs-2" style="color: #520CF3;">how_to_reg</i>
                                    <span class="fw-bold">Step 1</span>
                                </a>
                            </div>
                            <div class="progress w-50 align-self-start mt-3" style="height: 5px;">
                                <div id="step-1-progress" class="progress-bar" role="progressbar" style="width: 100%"></div>
                            </div>

                            <div class="text-center">
                                <i id="step-2-icon" class="material-icons align-middle mb-1 fs-2">health_and_safety</i>
                                <span class="fw-bold">Step 2</span>
                            </div>
                            <div class="progress w-50 align-self-start mt-3" style="height: 5px;">
                                <div id="step-2-progress" class="progress-bar" role="progressbar" style="width: 100%"></div>
                            </div>

                            <div class="text-center">
                                <i id="step-3-icon" class="material-icons align-middle mb-1 fs-2">visibility</i>
                                <span class="fw-bold">Step 3</span>
                            </div>
                            <div class="progress w-50 align-self-start mt-3" style="height: 5px;">
                                <div id="step-3-progress" class="progress-bar" role="progressbar" style="width: 100%"></div>
                            </div>

                            <div class="text-center">
                                <i id="step-4-icon" class="material-icons align-middle mb-1 fs-2">medical_information</i>
                                <span class="fw-bold">Step 4</span>
                            </div>
                            <div class="progress w-50 align-self-start mt-3" style="height: 5px;">
                                <div id="step-4-progress" class="progress-bar" role="progressbar" style="width: 100%"></div>
                            </div>

                            <div class="text-center">
                                <i id="done-icon" class="material-icons align-middle mb-5 fs-2">check_circle</i>
                            </div>

                        </div>

                    </div>
                </div>

                <form method="post" accept-charset="utf-8" name="form1">
                    <input name="hidden_data" id='hidden_data' type="hidden" />
                </form>



                <?php include("step1.php"); ?>

                <?php include("step2.php"); ?>

                <?php include("examination.php"); ?>

                <?php include("step3.php"); ?>

                <?php include("step4.php"); ?>

            </div>
        </main>

    </div>
    <!-- /.content -->
    <?php
    include("../includes/footer.php");
    ?>
    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script src="../../js/medical.examination.js"></script>
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

    <!-- <script src="../../dist/js/webcam.min.js"></script> -->

</body>
<script type="text/javascript">
    // $("#previewModalInfo").modal("show");
    var items = Array("call.php", "call1.php", "call2.php", "call3.php", "call4.php", "call5.php");
    var calldata = items[Math.floor(Math.random() * items.length)];


    function loadPreviewInfo() {


        //*******STEP1******//
        var transaction_types = $("#transaction_types option:selected").text();
        var bdate = $("#dob").val();
        var age = $("#age").val();
        var surname = $("#surname").val();
        var mname = $("#mname").val();
        var fname = $("#fname").val();
        var gender = $("#gender").val();
        var marital_status = $("#marital_status").val();
        var address = $("#address").val();
        var nationality = $("#nationality option:selected").text();


        $("#previewNationality").text(nationality);


        //*******STEP2******//
        var heights = $("#heights").val();
        var weights = $("#weights").val();
        var bp = $("#bp").val();
        var bt = $("#blood_types").val();
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


        var driver_assessment = $("input[name='driver_assessment']:checked").val();
        var driver_remarks = $("#driver_recommendation").val();

        var img_data = "";
        img_data = $("#blah").attr('src');

        $("#previewName").text(fname + " " + mname + " " + surname);
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


        if (bt === "") {
            bt = "DID NOT PROVIDE";
        }
        $("#previewBloodType").text(bt);

        var multiple_condition_preview = "";
        $("input:checkbox[name=condition_driving]:checked").each(function() {
            // yourArray.push($(this).val());

            multiple_condition_preview = $(this).val() + "," + multiple_condition_preview;


        });

        multiple_condition_preview = $.trim(multiple_condition_preview);

        var cons = "";
        if (multiple_condition_preview.indexOf('0') != -1) {
            cons = "None";
        } else {
            if (multiple_condition_preview.indexOf('1') != -1) {
                cons = "Drive only with corrective lens";
            }
            if (multiple_condition_preview.indexOf('2') != -1) {
                cons = cons + " / Drive only with special equipment for upper limbs ";
            }
            if (multiple_condition_preview.indexOf('3') != -1) {
                cons = cons + " / Drive only with special equipment for lower limbs";
            }
            if (multiple_condition_preview.indexOf('4') != -1) {
                cons = cons + " / Drive only during daylight";
            }
            if (multiple_condition_preview.indexOf('5') != -1) {
                cons = cons + " /  Drive with hearing aid";
            }

        }



        var assessments = "";
        if (driver_assessment === "1") {
            assessments = "Fit to drive ";
        } else
        if (driver_assessment === "2") {
            assessments = " Unfit to Drive";
        } else
        if (driver_assessment === "3") {
            assessments = " Permanent";
        } else
        if (driver_assessment === "4") {
            assessments = "Temporary";
        } else
        if (driver_assessment === "5") {
            assessments = "Refer to Specialist for Further Evaluation";
        } else {
            assessments = "Fit to drive ";
        }

        $("#previewConditions").text(cons);
        $("#previewAssesment").text(assessments);
        $("#previewRemarks").text(driver_remarks);

    }

    function getBase64Image(img) {
        // var canvas = document.createElement("canvas");
        // canvas.width = img.width;
        // canvas.height = img.height;
        // var ctx = canvas.getContext("2d");
        // ctx.drawImage(img, 0, 0);
        var dataURL = canvas.toDataURL("image/png");
        return dataURL.replace(/^data:image\/(png|jpg);base64,/, "");
        //       return "/6D/qAB6TklTVF9DT00gOQpQSVhfV0lEVEggMzIwClBJWF9IRUlHSFQgNDgwClBJWF9ERVBUSCA4ClBQSSA1MDAKTE9TU1kgMQpDT0xPUlNQQUNFIEdSQVkKQ09NUFJFU1NJT04gV1NRCldTUV9CSVRSQVRFIDEuMjUwMDAw/6gAJkRFUk1BTE9HIElkZW50aWZpY2F0aW9uIFN5c3RlbXMgR21iSP+kADoJBwAJMtMmPAAK4PMahAEKQe/xvAELjidlPwAL4Xmk3QAJLv9V0wEK+TPRtgEL8ocfNwAKJnfaDP+lAYUCACwErukE0eQErukE0eQErukE0eQErukE0eQE3Q8DGocE2pwDGjwE37ADGtgE8aYDHP8E/DUDHkQE5PcDG3oE5GoDG2kE6hcDHBcE324DGtAE0LUE+nMEzrIE+AkE2hsDGiwE4JsDGvQE1/QDGeoE9yMDHagDG0wDIMIDHzgDJXcDG7YDIUEDHv0DJTADIAoDJnMDJOADLEADIUgDJ/ADJwsDLtoDG6ADIScDHjcDJEIDHScDIvwDHskDJPEDIaYDKGADJ3MDL1cDIC4DJp4DJnADLiAE6zcDHDoE7RkDHHQDHnsDJJQDHVwDIzwDGiIDH1wDG/UDIY0DHYIDI2kDHzQDJXIDIyADKicDH64DJgMDJb8DLUwDJ+4DL+oDIY8DKEUDJN4DLD0DKT8DMX8DKRUDMUwDK7gDNHYDJqUDLl8DMOgDOrADNHQDPvEDUVcDYZsDJ/4DL/0DNLsDP0cDKFkDMGoDSHsDVvsAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAD/ogARAP8B4AFAAl0+BEjYACh4/6YAoAAAAAAECwsPDRAQGB8AAAAAsbKztQGtrq+wtre4ubq7BgeoqqusvL2+v/IFCAlmpKWmp6nAwcLDxMUCCmmdn6ChoqPGx8jNBAsMD5SYmZyeycrLzM7a8QMNDhKSlZeam9DR1e7w8/QTZXV6gImMjZCTls/S09TX2dzd3t/g6u8QESEiI2xwdHZ5fH+BgoeKi47W2+Pl5ujs7fX29/n7/6MAAwDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDD6fp/f7cMMMPq9vt/d/5h9P1YYfThz/1+Pdh7cPb/wBv+3lVsq1lXaPrw+j/ANyq+WLy1GV0yy+VZ9v1fv8A+Mqrld/5ctplavt/uw+j/fKw5aHLKZeHLa5Z3/n24d39OWty2WXky5f8/wBGGHq/m/oyzGXHyr32vrw9v6vu5VrLJZZnK7f1f9fV9H+uVbys2VSyyGVxr+vD2/XV9r8P9mf93t/jI5jIeIO8yz4fUqAcQ8Oh2vb9zcxCv16mvZ2+zShT6PmGyo6kJv8AnD8Hl6vzdBN8Xb1+Juvs1cX3HO+9d5vnpQPTwTeXV+ilCae7xkPx9a0BvpzZhEf5AWscQSZ88me4Mujd+dWseI0diuz9MT4mhr/V6/N5PcKuyVe0yQLfu5vh/Z971ig12yJPsQ3ifGvn/B5Li4m1a+pe1TUE3l+Hpj98SQbPZ9lN/wDvsq3sA/4jE5jYFaEnxHXU7n0uSfE3SDL/AEQ9yKqNEN14cS/HL0flaziDf27ebza62oaxHShMY+47PwEIsNBOzf26aIWEgrHCVyWGg81nDhFbuSqP3wrcbW+AB2E9SdDRyDaq1iPjRrLWM5R6mLVLbZVTndOOxBofDpVzBKITCZL8vXtYiTjrGerys025iFe/s6hxFGqu6Vvx9DQ0BmhiK0RTcnSGhIq5ol3ibJDbz30UWV+LzNLvCz8u1mvtHSiJDU3EVYQ1OghXkuzdGiYVa0uQvNzobTYY4geonIMKKdm+lQ4hc6Gl4/g3MfbFw4hDWe9Vr4A18XhiGxpws7aFANquA4hup12y2HZUpVECxE9Uam5mJY8XYxjZTG66O9yDyEYIEiLknCL37ntAfdJiecdcHFxi3RSFcaarRyORsuuLb0X+aBTE3qKyPajfcW+w8eu98OrWsy0NnNXy+QhM+ezWt6p27+u6Wfp5sxX2iczWM6gYMoKzaYFNpuOQr9HnsgOm4sRBUR8LvVs8wszvLEFe0H/Izbp6vJfqdMdjt8tN+iXBVN0Jmi4V6K/zNNobCxE8LtZlLtFrnEUzjJy64t8sJeQzmOGvOjYhKFBYGMkA/dSWnPTQU5qbD1A9Dl1vLIN40yHOpCm4xtqK3X6ezhYPGDGLBS1jyVzRL3jRoYSoQI8hqouWHOrmks8ZNArlVENlrJytci+Kecs92kzmMGOjshR1dWmnG6v1XgGdvqrzvoOY3bisBObWsKlnMKa1uNt2botoQEzmU0t5YamXQVtCZVOlZal1ei/c64pqeZN3a8EQlbW4pmJVe2lMvx2ePM2eMUvr+Ppp3oskMxbvWbhq1s8vnlvOe/htW4ezs8tdroTms7s9SoaamVNxgSvE7VYmmJY2scTrCitFJHOSnblvXytciBTms0sqVUrwGgUGbT5K8/sVi3wipq6mEbuMnB1QpQL+MoXochl5KJpY4QOrs2VIJ92RT1KjYWumxj5xs9LoMCo19TRbM4yorQ0kNcdwTPODowQclxpgMzCQ5ZVrvzhrZMKrmPsqi9/jSaCxAyBKLo2nbWbBPEBrUFLg1ZhZvbMDtiVpb5jrZBEJiEjsS2kDWpzphVBciSShIa4Y2qjnRABK8FnNAz0oS5C3OTje0ZWNtsDr3FkJ/BELkNcPfN3eMz5MFiz4j8BGvnMqrA77qaXygVjSyGFd6kPegHtyahp2Mat7WW4xlVZZXIHVGE5OStz2qet57xOZJraQOdqRJcimYUoua6t51VwLETSAUBGpxLpZOV4wsosMrLFTEepjUpcR1ON44ie4gsRsA2WxKYoMAkxSsrieZzGLnm3WKNKAE5jRCTAahUltYeMnkm7P01xoiMxhBKdcikJIKc1oU5RpQCkFkdn12hYbHeBhlyWTSLwmjRVBxkXGbOlEVGp7zxmyu2Vgrts4RyXZ0Na7UquWrITkSbE660QKd1qNSmSrB5NdO4SiQ1Ro1vIJx0a7osA972XymbppjG47HVC2ESxCXDdbKJVwzNr3BiAR7u74F8EejnkEimzs4W1SWinogmEzdXyRt+Ae6F1EXsmdFdC/Jr84UkqQzHrdQvn3iNPn55KnglAfFrXq5fRz3jMa1OlqWLaPPVvGc7pLdXB1T2QKcEkNkGXPe0cgnHiW1zXeBvEZclgfEXhIFIJzT75O4hihw8ZQrtFqIMKrI8mq16pUWjBOMmPB8VyOyBzmsWQF6nix5HMZSuNKxVGuOoMZiEELJ7r6yxGvrYskbBuNm7MeInQXbGRbZaLr/ikXeKABo7Sruo/F+3Ml0whBPpojBGn9Jg7Ea7IabJDrizfyxHEYEhKR6RbttOwpje+zNrpZTt6IaxmdBN4y32CbnXlMVqIodJH+f4vm0WljST220iq4nTkZXsB1YWrjkIUklrBaB98TNBoI+StbYhqB90k1i45e669yHgQyDIKCgWqznU52MniC6Hofqdtxudddr1allypMJ2t19FTqzq20VBMTVACbtkl37dTimpGS4yJl73MdMUGW7F17E0hwicxQ5W1dkBrsobtxtS0u2hurXVYmcJGYkiCYcVpzLNzQKwepoOic7xaB6kQIKcZqaxp528Eu1WTkhx27aHjmZZcUwyEzWq3NE9txTkJhvvaB1KdjNyHtltWNJlkG17QSsCPwmZ8k2X2ICJN91kNlhXUmfGNzephL3yryNk+kyXtPypLGzpFqq9iJHeOO3ZCNi2MZtinHBSfEWvNsDV2nOFLLPRZsh0IU+wpm10Ih0jWiHrK2dZQC38hV7NpRSUwW8PRfmvYmQrzlM05cEh5LL47agKaiuIsCzz7rUAM/R0vGl3dX5loZjICTS1yOZZIOeAIVpQr4nLjLGyrN0Z6gdFFaVnMpz5Xv5br2MFc5m6RvQdzggWM084yrqWusTxtbaiLZGg++RIFBclgbkGgveroFDYl4Hx36L9mc0FkbqZLm5qOtCXlMY8HxZ3R/0zQs1HOTatG4+qmwNVZzlYpWujtt1sYnjtEc8f22I0aVTiS+UWfki9qrSOa17VbX0f7cyK67CxG5wM2U+n5TQ7U2c1hEs32U69VbkFORWaDu+35SB+SoknKPP/eCWOZMMajByUfDRHSwp37UHRarVdFEimJw2aJAZtQRlMakNIXwi6yqs5h1vE4o1Vkg8ZOTWjpVWUkRbke5ox2yeXfJxoISLkmy+wZEg/eXym56kH396c0kaO5AceurzWva+t9pTnVV0XcKXjw8X4XZPV8rLvmp8nzdxwnNPP0/B+L16fSn5fn4HOWxFfp6YMs9Y9RTGqiENVG4Do27HTAGryxu/Y7t9KjFUzRsvoDfL+75ISsKY4RXf5/h7fZwrFpzCaYVp4VrvsaU7TVY1u/n4FG0DmUERAaOotTe0imaDJIq4XcW1YTrXUXXZqQskRZPCy54XhB8LYQmNIU153bdzIpcc5Xet3QjP2jqHjGnMjQrQtiyyGhyDNvJOn75AZ+EG6kEJD31m4zFzroFkA2AQqUtx4w1LJZveCdB4+vWEGiB6KjbO/o6c8YseUT01HMtmxxAKrk6ZFOOsEZ4LgT3gyYi7HN+bMB9Gnh5u4MQy7Lmf4PtP9fDoNpzX7H/AH7tyj8fs5rVniEH7M2tUH+lq4geJjD2dSvls1B/l09bJjAksZ5/kLxbqGnM1KWqVwQfOmAznoYQfKRW+URZApmb7evurRHybOhb520Z+jUZXIjco8b4FpqZps4jyGLHE1CgL3j4jPkrjQX8BHoWg3H3yvRtNBnBh5Ig6RAopILI2uDkNeTnpOYn1SqU2Dgi3G2q9MFqBN1cNgniF6rtDlg8RBgzCTadiAU49GxI4176bQFaUR6NZd4oIbRFAVbPj/R9z0nMbW1+pO4THt5+AH3iaw2O7OqI9zfNvmKJNEKxRbolRwKYZIsGNrGerm/GqY1oU/s5v0mmWbuCY1vayOrs2QLPu1NmJpvcu/gLdVqjmMXIrQFnL6Oa8MbXtdcKHFJfGcCaSDPwlyWRF/CUYCIoLwXqpaQ3RPjv3LYF1YcqjxppBUTYuL7inNdTHmy5atvpGcju/LepyG+vZR1HOdPwajavr7ulbjmOj1IHhbb7Ea5UFiJ7erz5tAvV/jv5idiNCi8d/wCfWFO1jWliMHDaG7W8a4sKYnQMOj82f49naTZzBKjgnrfXmQATETVua6hElvJszRVakS0/FZY1s5IaGyTbOIGVuniJDnYMq67AGY6jSj0WWE4osxmDl7t7aeWWnvwYty1bZeAiNBoEuTBI2GXheiIIeRFxu0xdFDFhYJzkXEARApWwxg1TSuB6HMIp2scLhJpnGSzmFLqTe11ZtunNG7q7WPbHN10RKZq3Rc6qEHP54AeIkQTBbXNvosWcwGsH2anLtapBzNYbBfoqv5ni+cXixxoto21QWM6ggT6VnGDAOYXFSTg9VbWkU7XsfI5UoccAOZoNBbgvFwiZTDcDgDhRFRkPHqCniri53fMgQRA8e+fg/6YAnQEAAgECAgMIBgoSEBMgEwAAs7UBsrYCAwSxtwUGBwgJCrC4C2mur7m6DA0OJCUqrK27vA8QERITIiMmJygpKywuaqu9vhQfICEvMTI0NTY3ODtDqKoVFy0wOTw9P0VGSk1PVFepv8HCFhobHB0zOj5AQUJER0hLTE5WWlthm5+jpabAw8TFxsoYGR5QUVJVWVxijpWWl5igoqTH/6MAAwHtvOldC/M14a9/rb7GFV4zpRyenR9ldGunTkTx9e2pNtXpx19mvT2dDatvCnieqPXv2vXueBc7+6fX3118fb04FeHd3bbf7u/bV/nreHj1nffX62323wKleOvXp06dPYby2eN+Hj0v2dOrv1ht3R6+Je3t4ba0eDW3j0x04OxQwK1ONnU177J16mvBqttfZ9f+v2pK49fCd19HadPE410O7r0nQvpz29cPDVj2AduNaYfc26OHyVeutzXbpzbhWKejzIeIPTbn0ua3rNul3fAL8Y2+PeciupreBF4FTXbBtrbXCiLt0dSdevCiLR3d2r468KvXbwuiqlu9ly5sa+E1TeRlJH1VHiTw6E26eqd5xtlSyyjk9Oqevr7ap1eD16kfXTtQ8dtrKvVaedXg6AduDeT3D1eq/Hzdc9dvHrzPZE18J33tytm2vfOtTrfFp7/F8Xx6TwOGspv2HTWrOLetTazXWHBrxJW1teN9Nt+ozoT1Xd2cNuu0778Jq932am/ade6PU8e89nTh4VfT2S/6Z3d/2fqd9zavF+vaX09eu918L2Xb1db8Ndjfret7eH/E9mvs6dTfRjwr/l9njVw4Htdb6/Z3dfX17q41t12Uun1HFOu3Vhrt2ahKfcO2zMPuvVS/c6ddWo86jbhIcutX1ldZV87UUOo1xuDXWiVXIUx4QjXBLjQgHU3Per1xW2HgFzxltzptxJbXr6637PV4caa8O66rHqnS95UvWiDVjvuagbdx7CVW9JVd2385W0uuGr1uXez49F3tdJTNfr8emxxqVdxwQ4ia3UvGvYObj261vv8AVNivJVeBjvOvMrXYL2lw5Me/pUtOa07dcMOOvebQdmuhwV2lVLarkV0iWam18C7tZ3mvTWjhUva/HqvSni9esE1K1OFSybOvRG+JNrrv29hKeSN91Ay+C1XSVNrNr4J0Nte+4ry1drKMXRyJ4PWjrtzZ0CNHb1N0UeV3EfI3ki8rGOjzSNTVqHNsjrLHleGo632XEwDHjZNetBCLwY332zauZhq6wWcAxV6F1wZtGLrk4hKOmx1q64ulYrbauNUwCax5Oy1cu07KmspuuwtgRvtwT7hZ7lUbSqrsoMFdOnNIddaMnZtLjR1eBNpbCrA4FBRXSMteBiom2TgUV0L22g3w1hrrrHF9Dkm011v2WnEhKJt4qcBxr4dRnecbcHSVU12vgkCroUedFa9bgcmFdNda225azZm1vVexdtlmr7o9uI++NYfKYFfIYpj5TRMvIMbRE5MuDLlea8BFOC6xll01xcku5fNhi8ax8msZbAOLULFuWcyzR8rFBeSyy7Czmksrr2JUGox5bYbbxcOLeGONj3ztwbafcYj4PkduvW++X49l9+2vXad9bPFlW0Vcs4vTPgXtT3vG+tQ1HXpxE1dfHaeO11wp6kDV6+u+LdeMZ18Zr/R9db7uX4+ts9f9Xf38CnboGvT9f9X6477g/rvV6a/ZXr4bdb29evhr11a6nA1+z7en9Hj061r4m8o7p0LuH232dZ/PWxOv2G979p08O+eFbS+C7SumNU25XG7lUR52x7cUgx8zqOq+5Tq7djm9Q8LOZKuHXXoPAah4amxDbiONtetM1eFda216S5TfHogzU75tDhbr1h0CdaN5LlauvX2+vw9V8XX1f8OkrpeL4XjUqezDHeXCX4azxlbVzEuq611rgatfbW23TrTy2a9uHpZ7NeFtx716PffGxumbG2vNl4Ij2OCHbsVrdPmrN10vsrXDNnXmbGy2Xg4lX0164bn2HA27r12Nps+ziV1KubU1fG77vU9L1lYrfe1TbZ6X4X11veV3+2aj09det4VXT+h9vXvNXYN97G23TrXhfX1nA2jXs/X4d2ybcDpttseCV0nThrrqGvqnVZtx6F33/Z7NqHpxtnf09fXYdeJtLlQrqbc0SVco5NKB267ttUPK1dDdHNrYPDWzs1q/DVsljxuU1QHW9eJdsu++FcjAnTaocR29fhbNtdpq77e/w6Q8Jr4923GuteCDdew4k27iddawbxmur1qth5dDHW7nfaPAwGpt37bd/BlVr1db28DwOFM1trpPGx46w67VWq3xJ022p6QXkdZtq+t2j2EYw7dUhLs8rLGg5rQ2sV4lSu/Jg4iTrslQ6cQlGHBXAqWwfAoXhRWLbFeLZezQNnAhXfWutzWzgS9e5vbWWHEFj4WuvLbDNpVzbiwgd5tcOVQL1vF6nCsgL0oey/BrZw8HG0IWL2UYNYeZ7du8vlD7iWQeYl6VtfIjNbjjY4mSPkRc04OTDNxlHJIKxDgJdkI80rZiba83Sy4R4oIRYXxCLDZryEqpVx4jmo9Cnld0a5SHEcWYSPIM2xe3oML5mU0dXmynpOqnMovYhRRxu7nXaGp1eIbXlOr2Xu2eRUKWrubPFJcL60bPCw1qX403TwKOv29dYMONL6+gvdL25Nk6XKL2OBWsYTbypXh11ubVyBMGseay3Zrow4l6zaqqa1yJezbWDkYagHbrFvv2J5nRlHYNRg12EacVXIcI4Hm4ZewQ5OhdYORDIAvASIpK5srvuVsQORTSJHiRYIhyuJG6LvsGX1IVzQqnDqcahNomb5EayHZ4FuWV7j24oR93bxnf18tbVOvWu953Xdt+vu+vwru59Tp7P93+zwnqnhy19v1/1f8Ax/8Af6q8PZ4nB74+P9P+z/39s2He9NmX3/b1/p8J3cSvXO/x/wD3+rvm3Xk3t0n/AM/X1a8KdzsSu72f+1dTvu99VPr9g/0fb4NcQb9nfL2du6ned7q6yuvedfB4Xrq/ZDr09vXx4mvXw1O//p/VNtuOu3q6XUvuOvI2uGp7PF7+nETw7/b1Dbw5GrPXNe9173n+o9d+NL7p22BXv+Pf3x18j7fZ/vb+0vs8PbOl7bC8q6er9Xtr1v6v59deLXXw/wB//D/f7f8Akerpx8PHb/r/ALf6Pb6/9n1nXhZXd6r9mtf7ulBx228D/p6//q539Xe7a9Z9b/t//vsqe296z9X6/b/19ft29Z3Vv1l9x4/8/a1OhwpA27v+P2vQeJXSav8ARPYy+BBqp/r6dfX0riVb0fVX2t8RdmFV6o8Vu9Z4euzqPCvrt8Pb49J3hy1fs8f+HX7Tbx8OT7PXXspleV7bWiJ7rXR8vfSE76vmyu6a6zXv7Ntp07+tdaeTLWbdOgnBNV1+u+t338SMXwdjW+N7ey5t3TqXZwNb6wgVfK+kOpVe0NuZtU69dbu3eIVT02ItcFtdu7p1LOOrCatEXlWL1uqjzI4Ii8bbJdKXz2pikHmjjaVt5GWU+Yh22WtGHy1PC9ivIyiVr169jCvD2ezpTyb16bdKo9XPb23erK8dZ04ndOnd6y8VfFs6zbq7PINdu+q1oqreDG3wfazajh1lV3Tu7tZXFmx1voeJV3w1KHZ2751nTgRwdeh1erwdaJttg114lFVeGmzjcrbAyjl1u6x0lczvqul9Rlc2dHDNQ5ltOHyJHtxvt+yA+S57err3+D2O3W5cCuVeMp22ud1XxK16+016/Zt43xft+z29OmP6f+f9Kb9tel48H6/t61fAPZ9fjXTp7fGvZrwubeGvrNTu7/s/n4L3z7ev1vT6+p4cKI6936rCeN8TF9frvuvw1eDGrnqr2953m96GvRrb7b25I6mz/wDm3dr11OFYLNq6xTjfTpt1rbrOrxqz7fDu67Es5VW39N7ePdr1rk+Hg1K7q7cM9/brtqHlrw6NVb2M6u12nhyLlyo+zv8ADveBC+pW3rnjrxLl9y989brwenU1u++/DXx5bbHR6+vx7vZ9ZwQ9XhrDx9Xt9Xs149/jW2vW/b19lO8rXw6V1rY1TjeL1+zo98Tj4Ie31vqmrxrN9b6eP2SuNBP1+3v8NdunMb8NXbXwudeN3fgdK79rvnesO49lPTkE1xTtsnJ77uUp24B8DWNTzIa3Y8yprg8dehyvbaO11e1vBTWieHs9jtfA1nhd60euJx2ddeh11OkvgN6srpa3yDqdOtvdfS+Djv8AV9jH290rgwr2d5fqnshwYYujwYnFYoVZtyZdPdXrpriVHaeHg1DiY266wIcipfcEcVxNamyXtNubs4vprh5mHFvbh6+81H3WutYu+zbp1Iym+dC7W9Sa8S716ZJ1Hg9LrcbXxqojVOB4WxjfWi9eLXj6+oay+/Z43X2d91WuxZvFZsX6+vReNB3lQ1vpfK11qmVZxK6t3Nb6dTjTVdPDbXXDwGyIbS04us1Tw6WQ4nQKdbuPNm1wvzOXD24R76VdnlIzr4R8pCo29llVeA506t4pObeudjCcXDTRbDgZAFrZ4IynXR5s2MBZyQTuTo8QjKK2oq/JU2uijjY3LyyuWyY1UjyGJBeypdwGjkkcVNQex1uyqeYpLPM9toAe4a60vuPW/ZfuVLtNvJU1mr0vmmtuofX3UcrhetsQ7CeuWtW8TBrfWXOvA11he2xC74OtNa31b8B59a1lTug8KJs5vW+bpdZDgS3Hi6+BV8aMO2uqhwKqOA6kODdS0j5LbmxKjfNKZrA8hE7dlWPvEB8iEbs8hHFBTythbL9wpYpyMrQx4jHFjFOFwjOsoXmjoPIl33OyUvOtYuLsOVwlDhfLRGPIDDseZjlt5MoIDRyYjDJzS9E5sInbssfeH3m5svmIN6x5tsNDnUMFoPlvBHkaPlIkvNVDiYso2TkS1uNy3spHWEDyGSPEN2t4XlWHCw7H9hcLzdGHlaxWKo5GjCHbg2+8Q2le5dXdS+YFkQhyqrStTpK53LZrrcp59Ix26kriS72zWNeLarNZrdcbVqXjbkrtrG9qaeBivXst33x4kOmRA41Dpe2G+wo2gJscwvW9SvK7DTUeCy7z0uPIWCVDmKAxs5uAgduEkPeKph7jTF53LiI9j0iyyta4jNpdTUhxHbKF2nAiDcJdHAzSkE4jKhsqVyWiKStXguK2rDzYTYYMeJAhHWVfZVGNmPErAs6yzmTVQ1vkyqqW082tdSwDsKdWoa+6YO3VrB7rm/NQMJXkdCnyGDbJyDK4K8imGJyRzeHyiakPcLCuJhaxdMeRDKQ5phJeHyjA5A4LFeYEQPKOphfIYuKJzE0B5GVI9usMfdBIvlHccwcBDsVjKSnkBGLLORHCYObm5cuPIdcU4eRi8uK5Iy4kE5uqNWclwxqyU8QhCx7HG0cawexpjizmR0ebEwMexiie4/UFmr/EuE3P8JCO9P746EN7h/ecPJKcn7jhjxIypWT8rEIoPlfzDhwROaZfyIMcWPMYQ/ONRiZcHAhZ9LuYaKblyO4H6CD5mJGhMpg9JvIxgYTDgRpFqyJ8zDJeDLox0cDwfmdDcOhou5jB0fmZZB3GBIILlKY5fSEd6ZQ5GHFQgn4iPJyxjilYekXBDJlGsGC8ksiYf2xMkHAxgRjE9I4YjgcKaBmiOHCwE9CRIZGh3JucGGiCIWfOYMOXcMN6xNB+R4OHI6EGOSJkzXoZTuHBuESKJCFhgj5yInF7HDTNkw6D98yPuuFGDdLE3sfhDIw3LkEQhcpHDwT7o4YRwxwYcMdzEMMNBT4TcxwA4MA6Gjow3PwsExWKY72DFQiYGhXR+8hBaajS5IQsSVuMLhyedwkGGjTvIOVQSOiHnEwU6GEjBMDSGFMDHzsSMpNyZrGrpdYdzYkfuom9IKWbkMG0MMGJFwfEmjCOGowcN3khAazSYfQjlq+CESXm9BzZkPjBI0ZY1BqJE2hGGKyffNFqFxG9xhMks1VwLhj8YJtTVwcEBMIwvCUtfK5EhBmtxjLpgiYrAuETIedwIJsS0SA4YJh1ZQlw85vFcOB3U1Fq4VdXpXzG5MDpeDII4M3CX6HkCbjA1m5VWbjAYT7qcWO5GC4cMMmjFwec4OAY6IMowO4wfEOXgEtNLcOBlOVjlj53BA3BGDo1lMPY/fvzVh2ImGLTCMMjBj/3MIRhwLw6sI4oWomhZufumHKEdwjRLxeiQjkRPO1ljwckqCYMGCLCW4fvJlNzWDIyxiS4DhdAX755UVhLphud6RGEPuruMDlzWKwRjDNWODL99hDRl1BMVgZdOQW4OBl5PQkdLiS44IO4clLWAfwEYsc3kEre+Bl9IZcDikcjFSDHCZPvGjgwYa3oxcGjkWGX4nQcscAYVjGGKjl+Vw862tFhDSsUkJeTB8Qx3MRjCEMkXCaVoedTFR4NMdBwZHgXK+IijHIYTFLh0DAYckT0ESGiWOHIb2OTcekZcNzgy4E5EcPnNobgIkI70wuhhw+ghHBCLCIwwYXRMJDQ+JMXudGoaKZIXEl2EfjWUxGi9KXCCYscMddX5wdCxMbNMGDDBl0SvkFMJh0OIximQwPyJhIR0NHLdzVwhLfpcpgYQYEcUsCzBD6Byb3kb3+2YJf1AQl//6MAAwH6gsUP43/wBwf4gMHF0f0PYxdE/gMKVk/vvIwH5hY3fI5H5zDh4MXcn41hFD4CP7a8qNDkBH9BxXDeFSP03to8U4DkjLfnN1GK3Lou8I/QaXxdDLh4McHyLo7nsd2q4XD+0cGMcDuMMNy/MeVPM8A+d8ruY5cOCAw+Uw5JeERTiaMND46PISjgEcG4MnzmgaUEMlG8zfpYtLoBuQcmhDB8buYzWuVZMMcGVhGL8joYNzh8rlgZPja0MD2FEMOGL8blQ8pxAw6Lht9JwTDlwnTDofOaGU90WOCHB+6yty5ewI5YQh9BoZcA6Lom64uHgfEGlHN0UHgfOMXBKDmYA3Dhy5PvOSJh0XLGBo8HJgh6XRwZCGarBghArzhHDkhg3mEhEV5r519x3mEho6GH0OHBHIsYAGpxG4RyHwrlexymjFtDDDJ8KxcmF5OTJrggYVX4mFpnUOwjghoyt78JF3hEwaXtRg0vDCoZflMEaFZWDeZdnCmKyv8AaXmZUh0w4rNVThcMUg/KwjDC5NYQhkVVwwifdOLh1yR4uWLArA3uPvHFMg7jF2xvcbjD954vlWEK0KWVWF+E8pl0cNYp0cGQgfePM4MqQ3XheCr98ODHiY6Zu6jgdxhcH4HNcliwMkfic0bjQ4rFy6GF0T4V0WG9xRCG9woFwtfO4rcyuJxchAWX6K5OjvKNHeLAy+d3GTeOoYc2ww4fQsDAQwHAmuDQhkIhHD8xkMaxwU3kIxvRyfM6MOhKlsMBGEeCR+Z3EGEtluvFyQiYfiqGLXeuFOJBgZdF85h3JpRo5AjGEtxcHD8JiyVHSizBKCVUYMI4YYD74QHFbmGCVBjlnfGBv1h81A8FwKu+o4WHoNDIZCa4cLK0tDercPvhSmL5rRilWKwWBgfiI4cKwI8CVGGHBgjh+Mgb7vLvYBvDRj8jgHmaLovYvotbNHgbnfbhZVemhwuDBxI4COHB9AaE2hl3OVcIRcBB+Nd7gCLHLFy6N4Pmty7nsWGQ3nzui7ljDBCDejhfocm5hhyGTQ/fY/w1h+oNcGP+Zcqcz+66PYfvu9jHBl/dcvkf3EwYNx2P7yvIj+g3Pld7+Fdzo+Yw/gOTyNGOTCfjH3XR0fSO8wbzCYdxvP7av7JH5U/sEMuT6H7h5H0j2HuGjlfjfdHi8kGvwu9ORxf0BudzxPmf6zDQ/Kb3DuY8Ayn7Qjou5w4NxE3vncG4wbjcuhwMXl9Bh+BgZGGD56/sEEyZT5x3HBMmDI/gdKY+8eY+6Q/rHN5nymR4m85GH6Q998j+FeZh3H5jBo+QMnEwfG+UyxckB3MMj95h8BlwMMMN4/G7mHA0OA5NKfkebh4kMulLvflMEYwwc3JhhWBj8JHQjHLxNFiRgMI+cIZYvF0NGMGGDQ85HQjvYSoZcOHCaEH7pzJUTZCJxRAYEIYPSbhDBkw4MUtYIfK4cIwjuMu67wwxX7ZCOTmKS0MBufvG5wRIsMGSU7lhgj6D3XekAcIEYRfxPIyw4nxnuLgxXM5sr4Xscu6jNcHQMkfvvlMNm8yw4nndHgZeBgw4YOV+VyR7BHcu4B/aOBwXfeHiOHznIwsD4DDgh+AcOVwZR0WHod7CA6OlKcLuG5/Ibgqzg70P20MGSMDAu8iR85zHRqNEYckyPpfIYSGTekCGD0kMOQ0XLgwQl8H5zc8WNrgwaMY/G6HB0TDFuU4UyQD0Jk4uHIt3DJDc+hMHNTeYcG40SF+gfMRwm8yfSbjRwug4AYP4VMGdXmciOH+8QyfiWPldDepuHB8g7yGHgOTJgg/QmCOHeb0hGOD6RDiyzgnA+lH9h7D8bk8xlI/geDzcn7q8D3H6g4AH+Z7eN/yna0v8Z/3r/fMHI/deL5n5j0H8L/Kf5z/IfoP9DxPxnwPB+gwv9o7Xpf7B2zz/ACHme1wdx8Ce8dr2cXiYeww9sgf6X8J/aIfieJ9w/wAr+g5P53BxP3jee+Zf7hitzDkfQ8zibngwIuWH5HgbiK7j6XsfMR/wL+l99h/hOxh8Z5Hmhl4n8Ae69sK/yvbEGHzH7z7i4X/IZP4De4YOhh/u1g+BwficPF95/IqHvmD4n4H9Iv7B/eNx2P4zDvfIq8n5Xidj7hD0Uv8AXD8KbiPvPN/iOJ8p9w/kP/F7Yc95/idDccXB+l7d0+oTyTt0T6gTJf0P1AIOfUB1p2172752yx/ne3iPqAgJ+oO6z+MVP4nCuH+BywwvBh++5eQfvjyDFZfzMIrqPAwMH8y6MI4cPByfpXkx/C6Jo4YvIy/Sx5u43Ohi4fQ8Hiw0F0Y/QnCnJCVDIkZUYEX5R7CPF3kSMIfKEODHAYDzMfnre5WMXF4dzkyPyGhowwBDFbjcFZPlcGHAR3GFOBkyfgWGVd44HK7zzm5MkVTLhi6MWNekw7ncrwMIXZhMPzEdxGGDehl0ckfmLwYMrHAAYMkeL8zgwcFwugYIwjl9LmuSxcuixjHD8Lkyw0cuAAG944v9wxbDLob1/acOiQgRiR0NHenpI8WEN6O43H5XeEXccD5TDuMqQrQxWho+itHBUU3kdwQi77yfCbnRhgcmQ9xw/KxODucLCGDAxy/fK+AhEhhjkL0fyvBcn5DKqJk0KMCDobz0kCLDJhjHCDB4AvpNxhyYDQeJ81scqRwLgMko6blwEPkTJlhgp3GGEY6PodDLDDE0I73LwfiMMN5uGGhFjuq4QH43eMMuFgRcUlwiEIx+g8pHe4NCPyHI3pl2uEMowcv43guQysJrH86ZcgZNx/ba0IaULvNDLG/uuDcOhuM3CVlvDhwaHzO8eTucv0po7zeOgvIr97WNqjhwRw/GfsVk0cGhH0JuODhN5FXIvE+g4rKjEGyBkMp+28LMuGD+2e4w3rk1I4flXBlikI713GWJCsnneLBPM6P0GTDvSLHDkwQj9ByMmDyOhisuH6DRPfDRh9JvXcYdxh3j52GDQYYKMMd5ovE/EfcfSmSMeQYcsRY4cIehw8zBoGFiZWOj+gwfndHgbjAOXccD0ByNB5Es0PynwGH6VjvHc7zIQjg/CkY0YpYqOCFkY/S8jsdzHeH5BjuYOHeEPxu90FY6DH9p0fff3X9k+oNXXD2z5h/9DtjV/mP4H+R/0GX+Y/GeVhyT6Xmf6n87/Zf43R7ZJ5Gj/hNDL25JD7ic3LDtdz9l5Hzv9lh2zh264x5Gjg8j87oe8H+d/Gf130sfM8L7ZZjuf8Rl4JoZf8b+d/mN6aLkwflOL+k3L5TR/K83eMGD/E/3E8hg5v8AKfof0vJjwPK/E/OQ/Af6TyI/ur7x+6/uP/YcnKfocO9ydsoGH+68DJwP5D/zP3je9sicn/UdrueY/gPgO2iP8z+N++/3D+E3GHgP6TzP8b/K9sS/UGuzl/xhjWv8pGVAyuh+hwL/AJGIR3sJcf3HRlQjHDhvNfmXKhweC/muMWVkMUaOg/hcGaI/cr8LuNGOHD2X+0EdHARixyUhkiD9JglGhCUJQ3AMAJ6XiZcEA0chEPob3EYGGLBbXJd5WVD5VjHcFDattG+t1J8x2GXcbiCoHz0LDLmhy3KpcahHN6HoYYuFQtlSqyFCjHDhTD6TeuRcBlzebYfMo6MqKlUMIEcrr0WURMHnvFZbChwEbVdrlWkuEYHpFgwMsDiCkdx6WULHbRxRkxQ20tS4SyPxECJGEYEWVQBm0iRgQ+hhAjuDc2uFixwfM4YRhlh0I3dstGEYFZPjMGQjCXgI0FQJZHinysFwphgQA4OH6Woxw7nAFVGaiEL0MPyEohBgYG4C7NYIixPkOBocgjAwLgYXh85hoQmq5M2GNrwkTKVKPOwIhCI4cEbu9mEMVHRhCn7xvRw72GLjgw6Cx9AYN66JSwyBUti4c04fObkYMGGSq11G0wRoZeLPjN7GGTCA4QYYIYIL8REwsYS4YFI2wltOHcYPhOFpHCDC7vZhGUhGJZHB8S7mDDBHcGCsGFjCHxsIMqGNlw1rrrWELg4TAnw1o5CKOpgLvCuBCEdDBH77DckcJGGW7RwaG59BkwxgmiEpUplJbWh+AohhyihQlOHDHeHzmXJm7cmB3sfyjmpd7bMRwek98iYojkiaODQ+d3EMobl3OjF+6cq3DlyQKINRK0MGT7z5q4MDDhI7jQ+65fIbwjdx5MP3EYxu13MMM1PQ7jJlXDi2qWEMXHDo/C7zg7wYOGyEcmX5XiZNCIYrNOQ0PhHQwEIZRDYllEZrDcek3pljkUcgGHJ8pitxEcOTCLVQwaDk+Y3JGDCEIOHQyxflOJgy8Xgb3zu9dKUjg3MIx3GE87wdyJg5mLwZSPwsOLoQ8zF3HzMMuHFyvIx0MuH5WG83Bk4GDJWD4WDDsNDRiLFjk+RhgwbhhgTLDB+JjDDCOg73AJH+F0cn0mEjl0MGimj+IFgwYRI5cHEyPzOjCMsMFuhkhB/CZJTEMVgIQcMphDR+lhhg5XCg4ZWEw/ScXiRY7n8Bgw4MCwIaUQyfkrQD3X6g6ePqAkQfqAZV/wAD27p24D2yh9QFivbPvbSnFPnP+07Ysd5B7asf4jcfUA3R/wCp20Dg/wDJ7Zh/SeR7ad/wnb1L2yj2/B+l7fE+8HbFH+ky/UBdf/+h";

    }




    $('#dob').datepicker({
        onSelect: function(value, ui) {
            var today = new Date(),
                age = today.getFullYear() - ui.selectedYear;
            if (ui.selectedMonth > today.getMonth()) {
                // console.log("Greather month : ");
                age = age - 1;
            }
            if (today.getMonth() == ui.selectedMonth) {
                // console.log("Same Month With Date : " + today.getDate() + " : " + ui.selectedDay);

                if (parseInt(ui.selectedDay) > parseInt(today.getDate())) {
                    //   console.log("Greather Date : ");
                    age = age - 1;
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

    $(document).on("change", "#transaction_types", function() {
        var id = $(this).val();
        if ($.trim(id) === "10" || $.trim(id) === '10') {
            $("#license_number").attr("readonly", true);
            $("#license_number").val("SP");
        } else if ($.trim(id) === "2" || $.trim(id) === '2') {
            $("#license_number").attr("readonly", true);
            $("#license_number").val("NP");

        } else if ($.trim(id) === "2" || $.trim(id) === '2') {
            $("#license_number").attr("readonly", true);
            $("#license_number").val("SP");
        } else {
            $("#license_number").attr("readonly", false);
        }
    });


    //************************************STEP2**********************************//


    //************************************EXAMINATION**********************************//

    var myArray = [
        "8.jpg",
        "12.jpg",
        "15.jpg",
        "35.jpg",
        "73.jpg",
        "74.png"
    ];
    var img_cnt = 1;

    function moveImage() {
        var answer = $.trim($("#color_answers").val());
        if (answer !== "") {
            if (img_cnt < 6) {

                $("#color_exam").attr("src", "../../dist/test/" + myArray[img_cnt]);
                img_cnt++;
                $("#color_answers").val("");
            } else {
                //$("#moveModal").modal("show");
                $("#submit-answer").hide();
                //$("#color_exam").attr("src", "../../dist/test/eye_test.jpg");                 
            }

        }
        $("#color_answers").focus();
    }
    $("#color_exam").attr("src", "../../dist/test/8.jpg");



    $("#submit-answer").click(function(e) {
        var data = $.trim($("#color_answers").val());
        if (data === "") {
            $("#color_answers").css('border-color', 'red');
            // step1_error++;
            //$.notify("Some field that are required are empty!! ","warning");

            swal("System message", 'Some field that are required are empty!! ', "warning");
        } else {
            moveImage();
            $("#color_answers").css('border-color', '');
        }
        $("#color_answers").focus();
        return false;
    });

    $(document).keypress(function(e) {

        if (e.which == 13) {
            var data = $.trim($("#color_answers").val());
            if (data === "") {
                $("#color_answers").css('border-color', 'red');

                //$.notify("Some field that are required are empty!! ","warning");

                swal("System message", 'Some field that are required are empty!! ', "warning");
                // step1_error++;
            } else {
                moveImage();
                $("#color_answers").css('border-color', '');
            }
            $("#color_answers").focus();
            return false;
        }
    });



    $(document).on('click', "#play_sounds_left", function(e) {
        var x = document.getElementById("carteSoudCtrl");
        x.play();
        // $("#set_msg_hearing").text();


    });

    $(document).on('click', "#play_sounds_right", function(e) {
        var x = document.getElementById("carteSoudCtr2");
        x.play();
        // $("#set_msg_hearing").text();


    });




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


    //************************************STEP 4**********************************//

    $(document).on('ifChanged', '#condition_driving0', function() {

        if ($(this).is(":checked")) {
            $('.none_checkbox').attr('disabled', true);
        } else {
            $('.none_checkbox').attr('disabled', false);
        }
    });

    $(document).on('ifChanged', '.none_checkbox', function() {


        if ($("#condition_driving1").is(":checked") || $("#condition_driving2").is(":checked") || $("#condition_driving3").is(":checked") || $("#condition_driving4").is(":checked") || $("#condition_driving5").is(":checked")) {

            $('#condition_driving0').attr('disabled', true);
        } else {

            $('#condition_driving0').attr('disabled', false);

        }
    });
    //************************************FINALSTEP**********************************//


    //************************************FINALSTEP**********************************//
    $(document).on('click', "#preview_details", function(e) {

        $("#previewModalInfo").modal("show");
        loadPreviewInfo();
    });


    //************************************FINALSTEP**********************************//
    $(document).on('click', "#preview_show_modalScanner", function(e) {
        $("#previewModalInfo").modal("hide");
        bios()
    });




    function bios() {
        var vDiv = document.getElementById('imagediv');
        vDiv.innerHTML = "";
        var image = document.createElement("img");
        image.id = "image";
        image.src = "../../dist/img/bio.jpg";
        vDiv.appendChild(image);
        //  onStart();
        $("#previewExamModal").modal("show");
    }

    const loadScanner = () => {
        let vDiv = document.getElementById('imagediv');
        vDiv.innerHTML = "";
        let image = document.createElement("img");
        image.id = "image";
        image.src = "../../dist/img/security_bnr_fp.gif";
        vDiv.appendChild(image);
    }


    $(document).on('click', "#proceeds_save", function(e) {
        loadScanner();
        console.log("Starting Scanning");
        //manualTest();
        var $this = $("#proceeds_save");
        $this.button('loading');

        $.ajax({
            url: 'http://127.0.0.1:8081/',
            type: 'POST',
            processData: false,
            contentType: false,
            cache: false,
            crossDomain: true,
            success: function(result) {
                //  console.log(result);
                var obj = jQuery.parseJSON(result);
                //  D
                // $this.button('reset');
                console.log("Starting Accessing Xampp");
                var vDiv = document.getElementById('imagediv');
                vDiv.innerHTML = "";
                var image = document.createElement("img");
                image.id = "image";
                // image.src = "https://systechph-medical.com/biometric/read/" + obj.img;
                image.src = "http://127.0.0.1:8081/read/" + obj.img;
                vDiv.appendChild(image);
                $('#proceeds_save').html('Saving...');
                setTimeout(() => {
                    $("#previewExamModal").modal("hide");
                    proceedData(obj.base64);
                }, 2000);
                //  alert(result);
                // alert("http://localhost/java_bio/read/"+result);

            },
            error: function(err) {
                console.log("error_problem_to_java_xampp");
                var $this = $("#proceeds_save");
                $this.button('reset');
                $("#proceeds_save").removeAttr("disabled");
                swal("Systech : Xampp was not started or Java was not install ", "warning");
                // $.notify("Error : Xampp was not started or Java was not install , Try again ","warning");
                //console.log(JSON.stringify(err));
            }



        });



    });

    /// Function Start
    function proceedData(data_bio) {
        //*******STEP1******//
        var transtype = $("#transaction_types").val();
        var license = $("#license_number").val();
        var bdate = $("#dob").val();
        var surname = $("#surname").val();
        var mname = $("#mname").val();
        var fname = $("#fname").val();
        var gender = $("#gender").val();
        var marital_status = $("#marital_status").val();
        var nationalities = $("#nationalities").val();
        var address = $("#address").val();
        var mobile = $("#mobile_num").val();
        var email = $("#email_add").val();

        //*******STEP2******//
        var heights = $("#heights").val();
        var weights = $("#weights").val();
        var bp = $("#bp").val();
        var bt = $("#blood_types").val();
        var gen = $("#gen_phys_text").val();
        var cont = $("#cont_disease_text").val();

        var lower_extreme_left = $("#lower_exte_left option:selected").val();
        var upper_extreme_left = $("#upper_exte_left option:selected").val();
        var lower_extreme_right = $("#lower_exte_right option:selected").val();
        var upper_extreme_right = $("#upper_exte_right option:selected").val();

        var general_physique = $("input[name='general_physique']:checked").val();
        var contagious_disease = $("input[name='contagious_disease']:checked").val();



        //*******STEP3******//
        var metabolic_diabetes = $("input[name='metabolic_diabetes']:checked").val();
        var under_medication_diabetes = $("input[name='under_medication_diabetes']:checked").val();

        var metabolic_epilepsy = $("input[name='metabolic_epilepsy']:checked").val();
        var under_medication_epilepsy = $("input[name='under_medication_epilepsy']:checked").val();
        var last_seizure = $("#last_seizure").val();

        var metabolic_apnes = $("input[name='metabolic_apnes']:checked").val();
        var under_medication_apnes = $("input[name='under_medication_apnes']:checked").val();

        var metabolic_aggressive = $("input[name='metabolic_aggressive']:checked").val();
        var under_medication_aggressive = $("input[name='under_medication_aggressive']:checked").val();


        var metabolic_other = $("input[name='metabolic_other']:checked").val();
        var under_medication_other = $("input[name='under_medication_other']:checked").val();


        var snellen_left = $("#snellen_left").val();
        var snellen_right = $("#snellen_right").val();
        //rgb(33, 37, 41)
        var eye_left_correction = $("input[name='eye_left_correction']:checked").val();
        var eye_right_correction = $("input[name='eye_right_correction']:checked").val();




        var eye_left_color = $("input[name='eye_left_color']:checked").val();
        var eye_right_color = $("input[name='eye_right_color']:checked").val();


        var hearing_left = $("#hearing_left option:selected").val();
        var hearing_right = $("#hearing_right option:selected").val();


        var eye_left_color_data = $("#eye_left_color_data").val();
        var eye_right_color_data = $("#eye_right_color_data").val();

        var med_diabetes = $("#med_diabetes").val();
        var med_epilepsy = $("#med_epilepsy").val();
        var med_apnea = $("#med_apnea").val();
        var med_disorder = $("#med_disorder").val();
        var med_other = $("#med_other").val();



        //*******STEP4******//
        //remove due to changes in the multiple selection
        //var condition_driving=$("input[name='condition_driving']:checked").val();
        var driver_assessment = $("input[name='driver_assessment']:checked").val();
        var driver_remarks = $("#driver_recommendation").val();
        var duration_temporary = $("#duration_temporary").val();

        var img_data = "";
        // img_data=$("#blah").attr('src');
        // img_data=$("#canvas").attr('src');

        /*
              var base64 = getBase64Image(document.getElementById("blah"));*/

        // var img_temp="";
        // //img_temp=$(".profile-pic")[0];
        // img_temp=$("#canvas")[0];
        // var base64 = getBase64Image(img_temp);

        var img_temp = "";
        //img_temp=$(".profile-pic")[0];
        img_temp = $("#canvas")[0];
        var canvas = document.getElementById("canvas");
        var dataURL = canvas.toDataURL("image/png");
        var base64 = getBase64Image(dataURL);


        var temp_eye_left_correction = "0";
        var temp_eye_right_correction = "0";
        if (eye_left_correction == "correction_left") {
            temp_eye_left_correction = "1";
        }
        if (eye_right_correction == "correction_right") {
            temp_eye_right_correction = "1";
        }




        var temp_marital_status = "";
        if (marital_status == "Married") {
            temp_marital_status = "M";
        } else
        if (marital_status == "Separated") {
            temp_marital_status = "P";
        } else
        if (marital_status == "Single") {
            temp_marital_status = "S";
        } else
        if (marital_status == "Widow") {
            temp_marital_status = "W";
        } else {
            temp_marital_status = "S";
        }

        var temp_lower_extreme_left = "";
        if (lower_extreme_left == "Normal") {
            temp_lower_extreme_left = "1";
        } else
        if (lower_extreme_left == "With Disability") {
            temp_lower_extreme_left = "2";
        } else
        if (lower_extreme_left == "With Special Equipment") {
            temp_lower_extreme_left = "3";
        }


        var temp_lower_extreme_right = "";
        if (lower_extreme_right == "Normal") {
            temp_lower_extreme_right = "1";
        } else
        if (lower_extreme_right == "With Disability") {
            temp_lower_extreme_right = "2";
        } else
        if (lower_extreme_right == "With Special Equipment") {
            temp_lower_extreme_right = "3";
        }


        var temp_upper_extreme_left = "";
        if (upper_extreme_left == "Normal") {
            temp_upper_extreme_left = "1";
        } else
        if (upper_extreme_left == "With Disability") {
            temp_upper_extreme_left = "2";
        } else
        if (upper_extreme_left == "With Special Equipment") {
            temp_upper_extreme_left = "3";
        }

        var temp_upper_extreme_right = "";
        if (upper_extreme_right == "Normal") {
            temp_upper_extreme_right = "1";
        } else
        if (upper_extreme_right == "With Disability") {
            temp_upper_extreme_right = "2";
        } else
        if (upper_extreme_right == "With Special Equipment") {
            temp_upper_extreme_right = "3";
        }

        var temp_gen = "";
        if (gender == "Male") {
            temp_gen = "M";
        } else {
            temp_gen = "F";
        }

        var temp_driver_assessment = "";
        var temp_duration_temporary = "";
        var temp_driver_assessment2 = "";
        /*if(driver_assessment=="1"){ temp_driver_assessment="Fit"; temp_driver_assessment2="Fit";}else
        if(driver_assessment=="2"){ temp_driver_assessment="Unfit"; temp_driver_assessment2="Unfit";}else
        if(driver_assessment=="3"){ temp_driver_assessment="Temporary"; temp_duration_temporary=duration_temporary;  temp_driver_assessment2="Fit";}else
        if(driver_assessment=="4"){ temp_driver_assessment="Permanent"; temp_driver_assessment2="Unfit";}else
        if(driver_assessment=="5"){ temp_driver_assessment="Refer"; temp_driver_assessment2="Unfit";}
        */
        /// Unfit -> Temporary
        /// Unfit - > Unfit



        if (driver_assessment == "1") {
            temp_driver_assessment = "Fit";
            temp_driver_assessment2 = "Fit";
        } else
        if (driver_assessment == "2") {
            temp_driver_assessment = "Unfit";
            temp_driver_assessment2 = "Temporary";
        } else
        if (driver_assessment == "3") {
            temp_driver_assessment = "Fit";
            temp_duration_temporary = duration_temporary;
            temp_driver_assessment2 = "Temporary";
        } else
        if (driver_assessment == "4") {
            temp_driver_assessment = "Unfit";
            temp_driver_assessment2 = "Permanent";
        } else
        if (driver_assessment == "5") {
            temp_driver_assessment = "Unfit";
            temp_driver_assessment2 = "Refer";
        }

        var temp_blood_type = "";

        if (bt == "O positive") {
            temp_blood_type = "O+";
        } else
        if (bt == "O negative") {
            temp_blood_type = "O-";
        } else
        if (bt == "A positive") {
            temp_blood_type = "A+";
        } else
        if (bt == "A negative") {
            temp_blood_type = "A-";
        } else
        if (bt == "B positive") {
            temp_blood_type = "B+";
        } else
        if (bt == "B negative") {
            temp_blood_type = "B-";
        } else
        if (bt == "AB positive") {
            temp_blood_type = "AB+";
        } else
        if (bt == "AB negative") {
            temp_blood_type = "AB-";
        } else {
            temp_blood_type = "-";
        }
        ///*****************MULTIPLE CONDITION********************************//
        var multiple_condition = "";
        $("input:checkbox[name=condition_driving]:checked").each(function() {
            // yourArray.push($(this).val());

            multiple_condition = $(this).val() + "," + multiple_condition;


        });
        //console.log(multiple_condition.slice(0,-1));
        //console.log(multiple_condition.charAt(0));
        var condition_driving = multiple_condition.charAt(0);
        if (condition_driving === 0) {
            condition_driving = "";
        }
        multiple_condition = multiple_condition.slice(0, -1);
        if (multiple_condition === "" || multiple_condition === '' || multiple_condition === 0 || multiple_condition === "0") {
            multiple_condition = "1";
        }
        ///*****************MULTIPLE CONDITION********************************//

        var jsonData = JSON.stringify({
            "physician_username": "<?php echo $username_login; ?>",
            "physician_biometrics": [data_bio],
            "lto_accreditation_no": "<?php echo $lto_accreditation_no; ?>",
            "Exam_Datas": [{
                "lto_client_id": "",
                "first_name": fname,
                "last_name": surname,
                "middle_name": mname,
                "address": address,
                "date_of_birth": bdate,
                "gender": temp_gen,
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
                "medical_exam_date": "<?php echo date('Y-m-d'); ?>",
                "client_application_date": "<?php echo date('Y-m-d'); ?>",
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
                "diabetes": metabolic_diabetes,
                "diabetes_treatment": under_medication_diabetes,
                "epilepsy": metabolic_epilepsy,
                "epilepsy_treatment": under_medication_epilepsy,
                "last_seizure": last_seizure,
                "sleepapnea": metabolic_apnes,
                "sleepapnea_treatment": under_medication_apnes,
                "mental": metabolic_aggressive,
                "mental_treatment": under_medication_aggressive,
                "other": metabolic_other,
                "other_treatment": under_medication_other,
                "other_medical_condition": multiple_condition,
                "temporary_duration": temp_duration_temporary,
                "remarks": driver_remarks,
                "medical_certificate_validity": "<?php echo date("Y-m-d", strtotime("+60 days")); ?>",
                "eye_color": eye_right_color_data,
                "blood_type": temp_blood_type
            }]
        });

        console.log(jsonData)

        var fd = new FormData();
        fd.append('json', jsonData);

        console.log("Call data : " + calldata)
        $.ajax({
            url: "call/" + calldata,
            type: "POST",
            data: fd,
            processData: false,
            contentType: false,
            type: 'POST',
            cache: false,
            xhrFields: {
                withCredentials: true
            },
            crossDomain: true,
            success: function(response) {

                var check_status = $.trim(response);

                if (check_status !== "failed" || check_status != 'failed') {
                    console.log("Starting Saving to database passed data to dermalog API");
                    //  console.log((response));
                    $("#proceeds_save").attr("disabled", "disabled");
                    var fd = new FormData();
                    fd.append('status', "7");
                    fd.append('img_data', dataURL);
                    fd.append('transtype', transtype);
                    fd.append('license', license);
                    fd.append('bdate', bdate);
                    fd.append('surname', surname);
                    fd.append('mname', mname);
                    fd.append('fname', fname);
                    fd.append('gender', gender);
                    fd.append('marital_status', marital_status);
                    fd.append('nationalities', nationalities);
                    fd.append('address', address);
                    fd.append('mobile', mobile);
                    fd.append('email', email);

                    fd.append('heights', heights);
                    fd.append('weights', weights);
                    fd.append('bp', bp);
                    fd.append('bt', bt);
                    fd.append('gen', gen);
                    fd.append('cont', cont);
                    fd.append('lower_extreme_right', lower_extreme_right);
                    fd.append('upper_extreme_right', upper_extreme_right);
                    fd.append('lower_extreme_left', lower_extreme_left);
                    fd.append('upper_extreme_left', upper_extreme_left);
                    fd.append('general_physique', general_physique);
                    fd.append('contagious_disease', contagious_disease);



                    fd.append('metabolic_diabetes', metabolic_diabetes);
                    fd.append('under_medication_diabetes', under_medication_diabetes);
                    fd.append('metabolic_epilepsy', metabolic_epilepsy);
                    fd.append('under_medication_epilepsy', under_medication_epilepsy);
                    fd.append('last_seizure', last_seizure);
                    fd.append('metabolic_apnes', metabolic_apnes);
                    fd.append('under_medication_apnes', under_medication_apnes);
                    fd.append('metabolic_aggressive', metabolic_aggressive);
                    fd.append('under_medication_aggressive', under_medication_aggressive);
                    fd.append('metabolic_other', metabolic_other);
                    fd.append('under_medication_other', under_medication_other);

                    fd.append('snellen_left', snellen_left);
                    fd.append('snellen_right', snellen_right);
                    fd.append('eye_left_color', eye_left_color);
                    fd.append('eye_right_color', eye_right_color);

                    fd.append('eye_left_correction', eye_left_correction);
                    fd.append('eye_right_correction', eye_right_correction);
                    fd.append('hearing_left', hearing_left);
                    fd.append('hearing_right', hearing_right);
                    fd.append('eye_right_color_data', eye_right_color_data);
                    fd.append('eye_left_color_data', eye_left_color_data);

                    fd.append('med_diabetes', med_diabetes);
                    fd.append('med_epilepsy', med_epilepsy);
                    fd.append('med_apnea', med_apnea);
                    fd.append('med_disorder', med_disorder);
                    fd.append('med_other', med_other);


                    fd.append('condition_driving', multiple_condition);
                    fd.append('driver_assessment', driver_assessment);
                    fd.append('duration_temporary', duration_temporary);
                    fd.append('driver_remarks', driver_remarks);


                    fd.append('internal_reference_no', check_status);

                    fd.append('reference_no_generated', "<?php echo $reference_no_generated; ?>");
                    // fd.append('jsonData',jsonData);

                    $.ajax({
                        url: "../../control/control_admin.php",
                        data: fd,
                        processData: false,
                        contentType: false,
                        cache: false,
                        type: 'POST',

                        success: function(result) {
                            //alert(result);
                            var $this = $("#proceeds_save");
                            $this.button('reset');
                            $("#proceeds_save").removeAttr("disabled");
                            console.log("Done saving to server");
                            swal("Systech : Adding of medical record was successfull!! ", "success");

                            //  $this.html("Save");   
                            $("#proceeds_save").removeAttr("disabled");
                            //  oTable.ajax.reload();
                            window.location.replace("../import/view_cert.php?uid=<?php echo base64_encode($reference_no_generated); ?>");

                        },
                        error: function(err) {
                            console.log("error_saving_to_database in webserver or client");
                            var $this = $("#proceeds_save");
                            $this.button('reset');
                            $("#proceeds_save").removeAttr("disabled");
                            //   failedLogs(jsonData);

                            swal("Systech : Error saving record to cloud server database", "warning");

                            //console.log(JSON.stringify(err));
                        }

                    });
                    //  var $this = $(this);
                    //  $this.html('Saving..');


                } else if (check_status === "failed" || check_status === 'failed') {


                    swal("Systech : Invalid biometric or check internet connection please try again..", "warning");

                    console.log("error finger print in user side");
                    var $this = $("#proceeds_save");
                    $this.button('reset');
                    $("#proceeds_save").removeAttr("disabled");
                    // failedLogs(jsonData);
                } else {

                    swal("Systech : Failed to upload... try to relogin your account it may be cache error ", "warning");

                    console.log("error either in webserver or client print");
                    var $this = $("#proceeds_save");
                    $this.button('reset');
                    $("#proceeds_save").removeAttr("disabled");
                    // failedLogs(jsonData);
                }

            },
            error: function(err) {
                console.log("error internent connection ");
                var $this = $("#proceeds_save");
                $this.button('reset');
                $("#proceeds_save").removeAttr("disabled");
                // failedLogs(jsonData);

                swal("Systech : Internet Connection Timeout Check your ISP provider.", "warning");

                //console.log(JSON.stringify(err));
            }
        });




    }
    /// Function End



    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
        checkboxClass: 'icheckbox_flat-green',
        radioClass: 'iradio_flat-green'
    });

    //failed logs
    function failedLogs(jsonData) {
        console.log("Failed Data Record");
        var fd = new FormData();
        fd.append('status', "15");
        fd.append('jsonData', jsonData);

        $.ajax({
            url: "../../control/control_admin.php",
            type: 'POST',
            data: fd,
            processData: false,
            contentType: false,

            cache: false,
            success: function(result) {
                //    console.log(result);


            },
            error: function(err) {
                console.log(err);
            }

        });
    }


    //email validation
    function IsEmail(email) {
        var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if (!regex.test(email)) {
            return false;
        } else {
            return true;
        }
    }




    //****************************FOR SEARCH OF EXISTING USER **************************************//

    // var searcoTable=$("#searchUser").DataTable({
    //   "processing": true,
    //   "serverSide": true,
    //     "ajax": "../data/search_user_list.php",

    //     });


    //   $(document).on("click",".release-info",function(){

    //     var myjson=$(this).attr("data-json");
    //     var obj = $.parseJSON(myjson);
    //     var bdateArray=obj.bdate.split('-');
    //     var today = new Date(), 
    //             age = today.getFullYear() - bdateArray[0];
    //             if ( bdateArray[1] > today.getMonth() ) {
    //                // console.log("Greather month : ");
    //                age=age-1;
    //             }
    //             if (today.getMonth() == bdateArray[1]) {
    //                 // console.log("Same Month With Date : " + today.getDate() + " : " + ui.selectedDay);

    //                 if ( parseInt(bdateArray[2]) > parseInt(today.getDate())) {
    //                   //   console.log("Greather Date : ");
    //                       age=age-1;
    //                 }
    //             }

    //       $('#age').val(age);

    //       $("#dob").datepicker("setDate" , obj.bdate);
    //       $("#surname").val(obj.last_name);
    //       $("#mname").val(obj.middle_name);
    //       $("#fname").val(obj.first_name);
    //       $("#gender").val(obj.gender);
    //       $("#marital_status").val(obj.marital_status);
    //       $("#nationalities").val(obj.nationality).change();
    //       $("#address").val(obj.address);
    //       $("#mobile_num").val(obj.mobile);
    //       $("#email_add").val(obj.email);
    //       $.notify("Adding record to input data was success ","info");
    //     });
    //****************************FOR SEARCH OF EXISTING USER **************************************//
</script>

</html>