<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="icon" type="image/x-icon" href="https://systechph-medical.com/assets/systech.png">

  <link rel="stylesheet" href="css/main.css">

  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <!-- JQuery -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  <!-- Google font -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,500;0,700;0,900;1,900&display=swap" rel="stylesheet">

  <!-- Google Icon -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

  <style>
    .form-control {
      background-color: transparent !important;
      border-color: rgba(255, 255, 255, 0.5) !important;
      /* Optional: change border color */
      color: #fff;
      /* Optional: change text color */
      border-bottom: 1px solid #C6C6C6;
      border-top: none;
      border-left: none;
      border-right: none;
    }

    .form-control::placeholder {
      color: white;
    }

    .img-fluid {
      max-width: 130px;
    }

    body {
      /*            background-image: url('assets/login/login-bg.png');*/

      background-image: url('dist/img/loginbg.png');

      background-size: cover;
      background-repeat: no-repeat;
      background-position: center;
      height: 100vh !important;
    }

    #emails {
      width: 100%;
      padding: 12px 20px;
      margin: 8px 0;
      box-sizing: border-box;
      border: none;
      border-bottom: 2px solid blue;
    }

    #upass {
      width: 100%;
      padding: 12px 20px;
      margin: 8px 0;
      box-sizing: border-box;
      border: none;
      border-bottom: 2px solid blue;
    }

    footer.d-flex.px-4.text-center {
      position: absolute;
      width: 100%;
      bottom: 0;
    }

    body.hold-transition.login-page {
      display: flex;
      justify-content: center;
      align-items: center;
    }
  </style>

  <!-- Google Font -->
</head>

<body class="hold-transition login-page">

  <div class="d-flex justify-content-center ">

    <div class="col-lg-5 col-sm-12">
      <div class="p-5 text-end card card-outline card-primary rounded" style="color:black; font-color:black;  box-shadow:
    inset 0 -3em 3em rgba(0, 200, 0, 0.3),
    0 0 0 2px white,
    0.3em 0.3em 1em dodgerblue;">
        <div class="row align-items-center mb-4">
          <!-- <img src="assets/login/title-svg.svg" class="mb-4"> -->
          <!-- <img src="dist/img/loginbg.png" class="mb-4"> -->


          <div class="col-4 text-end">
            <img src="assets/logo/Department_of_Transportation_(Philippines).svg.png" class="img-fluid">
          </div>
          <div class="col-4 text-end">
            <img src="dist/img/mybg.jpg" style="width:100%; " />
          </div>
          <?php //echo base64_decode("c3BlZWRwb3dlcnRlY2g="); 
          ?>
          <div class="col-4 text-start">
            <img src="assets/logo/Land_Transportation_Office.svg.png" class="img-fluid">
          </div>
        </div>
        <form>
          <div class="mb-4" style="color:black; font-color:black;">

            <div class="input-group">
              Username :
              <input type="text" class="" id="emails" placeholder="Enter your Username">
            </div>
          </div>
          <div class="mb-4">

            <div class="input-group"> Password :
              <input type="password" class="" id="upass" placeholder="Enter your Password">
            </div>
          </div>
          <div class="row mb-4">
            <div class="col-12 text-start">
              <input type="checkbox" class="form-check-input" id="remember-me">
              <label class="form-check-label " for="remember-me">Remember me</label>
            </div>
          </div>
          <div class="text-center">
            <button type="button" id="sign-in" class="btn btn-warning w-50 fs-5 ">Sign In</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  </div>

  <footer class="d-flex px-4 text-center">
    <div class="col-md-6 text-start">
      <h6 class="text-white">Copyright © LTO IT-Systems | LTO MEDIC</h6>
    </div>
    <div class="col-md-6 text-end">
      <h6 class="text-white">powered by: Systech</h6>
    </div>
  </footer>
</body>

<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="js/sweetalert.min.js"></script>
<script src="dist/js/notify.js"></script>

<!-- iCheck -->

<script>
  function proceedData(data) {

    console.log(data);

  }


  $(document).on('click', '#sign-in', function() {
    console.log("Logging");

    var uname = $.trim(encodeURI($("#emails").val()));
    var upass = $.trim(encodeURI($("#upass").val()));
    if (uname == "" || upass == "") {

      swal("Systech : System message", "System Found empty Fields!! ", "warning");
      return false;
    }
    var fd = new FormData();
    fd.append('uname', uname);
    fd.append('pass', upass);
    fd.append('status', "1");
    $.ajax({
      url: "control/control_admin.php",
      data: fd,
      processData: false,
      contentType: false,
      type: 'POST',
      success: function(result) {
        //alert(result);

        console.log(result);
        var $this = $("#sign-in");
        $this.button('loading');
        setTimeout(function() {
          $this.button('reset');

          if ($.trim(result) != 0) {
            // window.location.replace("pages/dashboard/index");
            var split = result.split(",");
            if (split[1] === "admin" || split[1] === "ADMIN") {
              window.location.replace("pages/dashboard/index.php");
            } else {
              window.location.replace("pages/dashboard/client.php");
            }
          } else {
            swal("Systech : System message", "Incorrect Credential Used!!!  ", "warning");

            return false;
          }
        }, 2000);
      }
    });
  });


  $(document).keypress(function(e) {
    if (e.which == 13) {


      var uname = $.trim(encodeURI($("#emails").val()));
      var upass = $.trim(encodeURI($("#upass").val()));
      if (uname == "" || upass == "") {
        swal("Systech : System message", "System Found empty Fields!! ", "warning");
        return false;
      }
      var fd = new FormData();
      fd.append('uname', uname);
      fd.append('pass', upass);
      fd.append('status', "1");
      $.ajax({
        url: "control/control_admin.php",
        data: fd,
        processData: false,
        contentType: false,
        type: 'POST',
        success: function(result) {


          var $this = $("#sign-in");
          $this.button('loading');
          setTimeout(function() {
            $this.button('reset');

            if ($.trim(result) != 0) {
              // window.location.replace("pages/dashboard/index");
              var split = result.split(",");
              if (split[1] === "admin" || split[1] === "ADMIN") {

                window.location.replace("pages/dashboard/index.php");
              } else {
                window.location.replace("pages/dashboard/client.php");
              }
            } else {

              swal("Systech : System message", "Incorrect Credential Used!!!  ", "warning");
              return false;
            }
          }, 2000);
        }
      });
    }
  });


  //alert(result);

  // Disable right-click
  document.addEventListener('contextmenu', (e) => e.preventDefault());

  function ctrlShiftKey(e, keyCode) {
    return e.ctrlKey && e.shiftKey && e.keyCode === keyCode.charCodeAt(0);
  }

  document.onkeydown = (e) => {
    // Disable F12, Ctrl + Shift + I, Ctrl + Shift + J, Ctrl + U
    if (
      event.keyCode === 123 ||
      ctrlShiftKey(e, 'I') ||
      ctrlShiftKey(e, 'J') ||
      ctrlShiftKey(e, 'C') ||
      (e.ctrlKey && e.keyCode === 'U'.charCodeAt(0))
    )
      return false;
  };
</script>
</body>

</html>