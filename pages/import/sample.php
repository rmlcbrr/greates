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
?>
    <link rel="stylesheet" href="../../dist/css/style.css"   media="print" >
     <link rel="stylesheet" href="../../dist/css/style.css"   >
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
<body class="hold-transition skin-blue sidebar-mini sidebar-collapse ">
<div class="wrapper">
<style type="text/css">
  @media print {

    body {
   display:table;
   margin: 0; 
   table-layout:fixed;
   padding-top:2.5cm;
   padding-bottom:2.5cm;
   height:auto;
    }

  .highlited {
    color: red !important;
    -webkit-print-color-adjust: exact;
  }
    th{
    font-size:12px; 
    }
        td{
    font-size:11px; 
    }
    @page {
    margin: 1cm;
  }
}

@page {
    margin: 1cm;
}

 table th{
    font-size:12px; 
  }
  td{
    font-size:11px; 
  }
 @page {
  size: A4;
  margin: 0;
}
  @media print {
  html, body {
    width: 210mm;
    height: 297mm;
  }
    body {
   display:table;
   table-layout:fixed;
   padding-top:0cm;
    padding-left:0cm;
     padding-right:0cm;
   padding-bottom:2.5cm;
   height:auto;
    }

  .highlited {
    color: red !important;
    -webkit-print-color-adjust: exact;
  }
    th{
    font-size:12px; 
    }
        td{
    font-size:11px; 
    }
@page {
    margin: 0;
}
}

@page {
    margin: 0;
}

 table th{
    font-size:12px; 
  }
  td{
    font-size:11px; 
  }

</style>
<?php
include("../includes/main-header.php");
include("../includes/aside.php");
  include("../../class.admin.php");
  $auth_item = new admin(); 
?>
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
<?php 

?>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#"> Certificate</a></li>
      </ol>
    </section>
  </br>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
  
          <!-- /.box -->

          <div class="box">
            <div class="box-header">
            <h4>
View 
        <small>Details of  Certificate</small>
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
              <h3 class="box-title">Clinics Sample  certificate   <input type='button' id='btn' value='Print Certificate' onclick='printDiv();'></h3>
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


<?php
include("../includes/footer.php");
?>

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
      radioClass   : 'iradio_flat-green'
    })


    function printDiv() 
{

  var divToPrint=document.getElementById('DivIdToPrint');

  var newWin=window.open('','Print-Window');

  newWin.document.open();

  newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');

  newWin.document.close();

  setTimeout(function(){newWin.close();},10);

}
</script>
</html>
