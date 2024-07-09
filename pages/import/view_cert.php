<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Medical</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <?php
  include("../includes/css.php");
  error_reporting(0);
  session_start();
  include("../../class.admin.php");
  $auth_item = new admin();
  ?>
  <link rel="stylesheet" href="../../dist/css/style.css" media="print">
  <!-- <link rel="stylesheet" href="../../dist/css/style.css"   > -->
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <link rel="stylesheet" href="../../dist/css/medic.css">

</head>
<style>

</style>

<body class="hold-transition skin-blue sidebar-mini  ">

  <style type="text/css">
    @media print {

      body {
        display: table;
        margin: 0;
        table-layout: fixed;
        padding-top: 1.5cm;
        padding-bottom: 1.5cm;
        height: auto;
      }

      .highlited {
        color: red !important;
        -webkit-print-color-adjust: exact;
      }

      th {
        font-size: 12px;
      }

      td {
        font-size: 11px;
      }

      @page {
        margin: 1cm;
      }
    }

    img {
      -webkit-print-color-adjust: exact;
    }

    @page {
      margin: 0.5cm;
    }

    table th {
      font-size: 12px;
    }

    td {
      font-size: 11px;
    }

    div#qrcode img {
      width: 100px;
    }
    div#qrcode {
      margin: 10px;
    }

    @page {
      size: A4;
      margin: 0;
    }

    @media print {

      html,
      body {
        width: 210mm;
        height: 297mm;
      }

      body {
        display: table;
        table-layout: fixed;
        padding-top: 0cm;
        padding-left: 0cm;
        padding-right: 0cm;
        padding-bottom: 2.5cm;
        height: auto;
      }

      .highlited {
        color: red !important;
        -webkit-print-color-adjust: exact;
      }

      th {
        font-size: 12px;
      }

      td {
        font-size: 11px;
      }

      @page {
        margin: 0;
      }
    }

    @page {
      margin: 0;
    }

    table th {
      font-size: 12px;
    }

    td {
      font-size: 11px;
    }
  </style>
  <?php

  include("../includes/main-header.php");

  ?>
  <div class="container-fluid p-0">
    <div class="row mb-3">
      <div class="header-card card p-4">
        <div class="d-flex justify-content-between align-items-center mt-2">
          <div>
            <h2 class="color-purple">Certificate Viewer</h2>
            <h6 class="text-secondary"></h6>
          </div>
          <div class="text-end">
            <h6 class="text-secondary">Welcome User : <?php echo $_SESSION['full_names'];  ?></h6>
            <h6 id="current-date" class="text-secondary">---</h6>
          </div>
        </div>
      </div>
    </div>


    <div class="row">


      <!-- /.box -->

    </div>
    <!-- /.col (left) -->
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title"> <input type='button' id='btn-prints' value='Print Certificate'></h3>
        </div>
        <div class="box-body" id="DivIdToPrint" style="width: 100%;">
          <?php
          include("certificate.php");
          ?>
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
  <!-- /.col -->
  </div>
  <!-- /.row -->
  </section>


  <Script>
    setTimeout(() => {
      $('.preloader').hide()
    }, 1000);

    function isOnline() {

      if (navigator.onLine) {
        console.log("Online");
      } else {
        console.log("Offline");
      }
    }

    isOnline();
  </Script>

  </div>
  <!-- ./wrapper -->


  <?php
  include("../includes/js.php");
  ?>
</body>



<script type="text/javascript">
  //Flat red color scheme for iCheck
  $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
    checkboxClass: 'icheckbox_flat-green',
    radioClass: 'iradio_flat-green'
  })


  $(document).on('click', '#btn-prints', function() {
    printDiv();
  });


  $(document).keypress(function(e) {


    if (e.which == 112) {
      printDiv();
    }
  });



  function printDiv() {

    setTimeout(function() {
      let divToPrint = document.getElementById('DivIdToPrint');
      let iframe = document.createElement('iframe');

      iframe.style.display = 'none';
      document.body.appendChild(iframe);

      let iframeDoc = iframe.contentDocument || iframe.contentWindow.document;

      iframeDoc.open();
      iframeDoc.write('<html><style>div#qrcode img {width: 100px !important;}</style><body onload="window.print()">' + divToPrint.innerHTML + '</body></html>');
      iframeDoc.close();

      iframe.contentWindow.focus();
      iframe.contentWindow.print();

    }, 250);

    // setTimeout(function(){newWin.close();},10);

  }
</script>

</html>

<?php
clearstatcache();

?>