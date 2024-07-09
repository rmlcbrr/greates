///////////////// VIDEO CAPTURE
const video = document.getElementById("video");
const canvas = document.getElementById("canvas");
const snap = document.getElementById("capture-photo");
const errorMsgElement = document.getElementById("spanErrorMsg");

const constraints = {
  audio: false,
  video: {
    width: 200,
    height: 200,
  },
};

//access webcam
async function init() {
  try {
    const stream = await navigator.mediaDevices.getUserMedia(constraints);
    handleSuccess(stream);
  } catch (e) {
    errorMsgElement.innerHTML = `navigator.getUserMedia.error:${e.toString()}`;
  }
}

//success
function handleSuccess(stream) {
  window.stream = stream;
  video.srcObject = stream;
}

//load init
init();

//draw image
var context = canvas.getContext("2d");
snap.addEventListener("click", function () {
  //250 225
  context.drawImage(video, 0, 0, 250, 225);
  did_change_img=1;
         var canvas = document.getElementById("canvas");
        var dataURL = canvas.toDataURL("image/png");
         document.getElementById('hidden_data').value = "";
        document.getElementById('hidden_data').value = dataURL;
        
});

$(document).ready(function () {

  ///////////////// STEPPER JS
  $("#go-to-step-2").click(function () {

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
                   //$.notify("Some field that are required are empty!! ","warning");
                    

                    swal("System message", 'Some field that are required are empty!! ', "warning");      
                    return false;
                   }
                 

    if ($("#step-2").is(":hidden")) {
      $("#step-2").slideDown(500);
      $("#step-1").slideUp(500);
      $("#step-3").slideUp(500);
      $("#step-4").slideUp(500);
      $("#steps-done").slideUp(500);

      $("#step-2-icon").css("color", "#520CF3");
      $("#step-1-progress").css("background-color", "#520CF3");
    }
  });

  $("#go-to-step-3").click(function () {
    if ($("#step-3").is(":hidden")) {
      $("#step-3").slideDown(500);
      $("#step-1").slideUp(500);
      $("#step-2").slideUp(500);
      $("#step-4").slideUp(500);
      $("#steps-done").slideUp(500);

      $("#step-3-icon").css("color", "#520CF3");
      $("#step-2-progress").css("background-color", "#520CF3");
    }
  });

  $(".go-to-step-4").click(function () {
    if ($("#step-4").is(":hidden")) {
      $("#step-4").slideDown(500);
      $("#step-1").slideUp(500);
      $("#step-3").slideUp(500);
      $("#step-2").slideUp(500);
      $("#steps-done").slideUp(500);

      $("#step-4-icon").css("color", "#520CF3");
      $("#step-3-progress").css("background-color", "#520CF3");
    }
  });

  $("#go-to-done-steps").click(function () {
    if ($("#steps-done").is(":hidden")) {
      $("#steps-done").slideDown(500);
      $("#step-1").slideUp(500);
      $("#step-2").slideUp(500);
      $("#step-3").slideUp(500);
      $("#step-4").slideUp(500);

      $("#done-icon").css("color", "#520CF3");
      $("#step-4-progress").css("background-color", "#520CF3");
    }
  });

  $("#go-back-to-step-1").click(function () {
    if ($("#step-1").is(":hidden")) {
      $("#step-1").slideDown(500);
      $("#step-2").slideUp(500);
      $("#step-3").slideUp(500);
      $("#step-4").slideUp(500);
      $("#steps-done").slideUp(500);

      $("#step-2-icon").css("color", "#212529");
      $("#step-1-progress").css("background-color", "#DCDCDC");
    }
  });

  $("#go-back-to-step-2").click(function () {
    if ($("#step-2").is(":hidden")) {
      $("#step-2").slideDown(500);
      $("#step-1").slideUp(500);
      $("#step-3").slideUp(500);
      $("#step-4").slideUp(500);
      $("#steps-done").slideUp(500);

      $("#step-3-icon").css("color", "#212529");
      $("#step-2-progress").css("background-color", "#DCDCDC");
    }
  });

  $("#go-back-to-step-3").click(function () {
    if ($("#step-3").is(":hidden")) {
      $("#step-3").slideDown(500);
      $("#step-1").slideUp(500);
      $("#step-2").slideUp(500);
      $("#step-4").slideUp(500);
      $("#steps-done").slideUp(500);

      $("#step-4-icon").css("color", "#212529");
      $("#step-3-progress").css("background-color", "#DCDCDC");
    }
  });

  $("#go-back-to-step-4").click(function () {
    if ($("#step-4").is(":hidden")) {
      $("#step-4").slideDown(500);
      $("#step-1").slideUp(500);
      $("#step-2").slideUp(500);
      $("#step-3").slideUp(500);
      $("#steps-done").slideUp(500);

      $("#done-icon").css("color", "#212529");
      $("#step-4-progress").css("background-color", "#DCDCDC");
    }
  });

  ///////////////// DISABILITY JS
  //************************************STEP2**********************************//
  $("#general_disabilities").click(function () {
    if ($("#gen_phys_text").is(":hidden")) {
      $("#gen_phys_text").show();
    }
  });

  $("#general_physique").click(function () {
    if ($("#gen_phys_text").is(":visible")) {
      $("#gen_phys_text").hide();
    }
  });


  $("#contagious_disease").click(function () {
    if ($("#cont_disease_text").is(":hidden")) {
      $("#cont_disease_text").show();
    }
  });

  $("#contagious").click(function () {
    if ($("#cont_disease_text").is(":visible")) {
      $("#cont_disease_text").hide();
    }
  });
//************************************STEP2**********************************//
  ///////////////// DISORDER JS
  // Diabetes
  $("#diabetes1").click(function () {
    if ($("#diabetes-content").is(":hidden")) {
      $("#diabetes-content").slideDown();
    }
  });

  $("#diabetes").click(function () {
    if ($("#diabetes-content").is(":visible")) {
      $("#diabetes-content").slideUp();
    }
  });

  // Epilepsy
  $("#epilepsy1").click(function () {
    if ($("#epilepsy-content").is(":hidden")) {
      $("#epilepsy-content").slideDown();
    }
  });

  $("#epilepsy").click(function () {
    if ($("#epilepsy-content").is(":visible")) {
      $("#epilepsy-content").slideUp();
    }
  });

  // Sleep apnea
  $("#apnes1").click(function () {
    if ($("#sleep-apnea-content").is(":hidden")) {
      $("#sleep-apnea-content").slideDown();
    }
  });

  $("#apnes").click(function () {
    if ($("#sleep-apnea-content").is(":visible")) {
      $("#sleep-apnea-content").slideUp();
    }
  });

  // Aggressive Disorder
  $("#aggressive1").click(function () {
    if ($("#aggressive-disorder-content").is(":hidden")) {
      $("#aggressive-disorder-content").slideDown();
    }
  });

  $("#aggressive").click(function () {
    if ($("#aggressive-disorder-content").is(":visible")) {
      $("#aggressive-disorder-content").slideUp();
    }
  });

  // Other Disorder
  $("#others1").click(function () {
    if ($("#others-disorder-content").is(":hidden")) {
      $("#others-disorder-content").slideDown();
    }
  });

  $("#others").click(function () {
    if ($("#others-disorder-content").is(":visible")) {
      $("#others-disorder-content").slideUp();
    }
  });


  ///////////////// QUESTION TRANSITIONS
  $('#go-to-question-2').click(function() {
    if($('#question-2-card').is(":hidden")) {
        $('#question-2-card').slideDown();
        $('#question-1-card').slideUp();
        $('#question-3-card').slideUp();
        $('#question-4-card').slideUp();
        $('#question-5-card').slideUp();
        $('#question-6-card').slideUp();
        $('#question-7-card').slideUp();
        $('#question-8-card').slideUp();
    }
  })

  $('#go-to-question-3').click(function() {
    if($('#question-3-card').is(":hidden")) {
        $('#question-3-card').slideDown();
        $('#question-1-card').slideUp();
        $('#question-2-card').slideUp();
        $('#question-4-card').slideUp();
        $('#question-5-card').slideUp();
        $('#question-6-card').slideUp();
        $('#question-7-card').slideUp();
        $('#question-8-card').slideUp();
    }
  })

  $('.go-to-question-4').click(function() {
    if($('#question-4-card').is(":hidden")) {
        $('#question-4-card').slideDown();
        $('#question-1-card').slideUp();
        $('#question-2-card').slideUp();
        $('#question-3-card').slideUp();
        $('#question-5-card').slideUp();
        $('#question-6-card').slideUp();
        $('#question-7-card').slideUp();
        $('#question-8-card').slideUp();
    }
  })

  $('#go-to-question-5').click(function() {
    if($('#question-5-card').is(":hidden")) {
        $('#question-5-card').slideDown();
        $('#question-1-card').slideUp();
        $('#question-2-card').slideUp();
        $('#question-3-card').slideUp();
        $('#question-4-card').slideUp();
        $('#question-6-card').slideUp();
        $('#question-7-card').slideUp();
        $('#question-8-card').slideUp();
    }
  })

  $('.go-to-question-6').click(function() {
    if($('#question-6-card').is(":hidden")) {
        $('#question-6-card').slideDown();
        $('#question-1-card').slideUp();
        $('#question-2-card').slideUp();
        $('#question-3-card').slideUp();
        $('#question-5-card').slideUp();
        $('#question-4-card').slideUp();
        $('#question-7-card').slideUp();
        $('#question-8-card').slideUp();
    }
  })

  $('#go-to-question-7').click(function() {
    if($('#question-7-card').is(":hidden")) {
        $('#question-7-card').slideDown();
        $('#question-1-card').slideUp();
        $('#question-2-card').slideUp();
        $('#question-3-card').slideUp();
        $('#question-4-card').slideUp();
        $('#question-6-card').slideUp();
        $('#question-5-card').slideUp();
        $('#question-8-card').slideUp();
    }
  })

  $('.go-to-question-8').click(function() {
    if($('#question-8-card').is(":hidden")) {
        $('#question-8-card').slideDown();
        $('#question-1-card').slideUp();
        $('#question-2-card').slideUp();
        $('#question-3-card').slideUp();
        $('#question-4-card').slideUp();
        $('#question-6-card').slideUp();
        $('#question-5-card').slideUp();
        $('#question-7-card').slideUp();
    }
  })


  ///////////////// EYE CON

  // QUESTION 1 EYE
  $("#color_blind_exam_left").click(function () {
    var currentColor = $("#color_blind_exam_left").css("color");

    if (currentColor === "rgb(82, 12, 243)") {
      $("#color_blind_exam_left").css("color", "#212529");
      //$("#question-1-right-eye-icon").css("color", "#212529");
    } else {
      $("#color_blind_exam_left").css("color", "#520CF3");
      //$("#question-1-right-eye-icon").css("color", "#212529");
    }
  });

  $("#question-1-right-eye-icon").click(function () {
    var currentColor = $("#question-1-right-eye-icon").css("color");

    if (currentColor === "rgb(82, 12, 243)") {
      $("#question-1-right-eye-icon").css("color", "#212529");
      //$("#question-1-left-eye-icon").css("color", "#212529");
    } else {
      $("#question-1-right-eye-icon").css("color", "#520CF3");
     // $("#question-1-left-eye-icon").css("color", "#212529");
    }
  });

  // QUESTION 2 EYE
  $("#question-2-left-eye-icon").click(function () {
    var currentColor = $("#question-2-left-eye-icon").css("color");

    if (currentColor === "rgb(82, 12, 243)") {
      $("#question-2-left-eye-icon").css("color", "#212529");
      $("#question-2-right-eye-icon").css("color", "#212529");
    } else {
      $("#question-2-left-eye-icon").css("color", "#520CF3");
      $("#question-2-right-eye-icon").css("color", "#212529");
    }
  });

  $("#question-2-right-eye-icon").click(function () {
    var currentColor = $("#question-2-right-eye-icon").css("color");

    if (currentColor === "rgb(82, 12, 243)") {
      $("#question-2-right-eye-icon").css("color", "#212529");
      $("#question-2-left-eye-icon").css("color", "#212529");
    } else {
      $("#question-2-right-eye-icon").css("color", "#520CF3");
      $("#question-2-left-eye-icon").css("color", "#212529");
    }
  });

  // ACUITY QUESTION 1 EYE
  $("#right_eye_blind").click(function () {
    var currentColor = $("#right_eye_blind").css("color");

    if (currentColor === "rgb(82, 12, 243)") {
      $("#right_eye_blind").css("color", "#212529");
     // $("#right-eye-with-lens").css("color", "#212529");
    } else {
      $("#right_eye_blind").css("color", "#520CF3");
     // $("#right-eye-with-lens").css("color", "#212529");
    }
  });

  $("#corrective_eye_right").click(function () {
    var currentColor = $("#corrective_eye_right").css("color");

    if (currentColor === "rgb(82, 12, 243)") {
      $("#corrective_eye_right").css("color", "#212529");
    //  $("#right-eye-blind").css("color", "#212529");
    } else {
      $("#corrective_eye_right").css("color", "#520CF3");
    //  $("#right-eye-blind").css("color", "#212529");
    }
  });

  // ACUITY QUESTION 2 EYE
  $("#left_eye_blind").click(function () {
    var currentColor = $("#left_eye_blind").css("color");

    if (currentColor === "rgb(82, 12, 243)") {
      $("#left_eye_blind").css("color", "#212529");
    //  $("#left-eye-with-lens").css("color", "#212529");
    } else {
      $("#left_eye_blind").css("color", "#520CF3");
    //  $("#left-eye-with-lens").css("color", "#212529");
    }
  });

  $("#corrective_eye_left").click(function () {
    var currentColor = $("#left-eye-with-lens").css("color");

    if (currentColor === "rgb(82, 12, 243)") {
      $("#corrective_eye_left").css("color", "#212529");
     // $("#left-eye-blind").css("color", "#212529");
    } else {
      $("#corrective_eye_left").css("color", "#520CF3");
     // $("#left-eye-blind").css("color", "#212529");
    }
  });

  

  // CONTRAST SENSITIVITY QUESTION 2 EYE

  $("#contrast-sensitivity-right-eye-with-lens").click(function () {
    var currentColor = $("#contrast-sensitivity-right-eye-with-lens").css("color");

    if (currentColor === "rgb(82, 12, 243)") {
      $("#contrast-sensitivity-right-eye-with-lens").css("color", "#212529");
    } else {
      $("#contrast-sensitivity-right-eye-with-lens").css("color", "#520CF3");
    }
  });

  $("#contrast-sensitivity-left-eye-with-lens").click(function () {
    var currentColor = $("#contrast-sensitivity-left-eye-with-lens").css("color");

    if (currentColor === "rgb(82, 12, 243)") {
      $("#contrast-sensitivity-left-eye-with-lens").css("color", "#212529");
    } else {
      $("#contrast-sensitivity-left-eye-with-lens").css("color", "#520CF3");
    }
  });

  // HEARING TEST QUESTION 1 
  $("#left_hearing_aid").click(function () {
    var currentColor = $("#left-hearing-aid").css("color");

    if (currentColor === "rgb(82, 12, 243)") {
      $("#left_hearing_aid").css("color", "#212529");
     // $("#right-hearing-aid").css("color", "#212529");
    } else {
      $("#left_hearing_aid").css("color", "#520CF3");
     // $("#right-hearing-aid").css("color", "#212529");
    }
  });

  $("#right_hearing_aid").click(function () {
    var currentColor = $("#right-hearing-aid").css("color");

    if (currentColor === "rgb(82, 12, 243)") {
      $("#right_hearing_aid").css("color", "#212529");
    //  $("#left-hearing-aid").css("color", "#212529");
    } else {
      $("#right_hearing_aid").css("color", "#520CF3");
     // $("#left-hearing-aid").css("color", "#212529");
    }
  });

  // HEARING TEST QUESTION 2 
  $("#q8-left-hearing-aid").click(function () {
    var currentColor = $("#q8-left-hearing-aid").css("color");

    if (currentColor === "rgb(82, 12, 243)") {
      $("#q8-left-hearing-aid").css("color", "#212529");
      $("#q8-right-hearing-aid").css("color", "#212529");
    } else {
      $("#q8-left-hearing-aid").css("color", "#520CF3");
      $("#q8-right-hearing-aid").css("color", "#212529");
    }
  });

  $("#q8-right-hearing-aid").click(function () {
    var currentColor = $("#q8-right-hearing-aid").css("color");

    if (currentColor === "rgb(82, 12, 243)") {
      $("#q8-right-hearing-aid").css("color", "#212529");
      $("#q8-left-hearing-aid").css("color", "#212529");
    } else {
      $("#q8-right-hearing-aid").css("color", "#520CF3");
      $("#q8-left-hearing-aid").css("color", "#212529");
    }
  });
  
});
