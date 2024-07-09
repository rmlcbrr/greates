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

<?php
include("../includes/main-header.php");
include("../includes/aside.php");
?>
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
<?php 

?>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Clinics</a></li>
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
View  <?php
//echo $_SESSION['u_account_type'];
 ?>
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
              <h3 class="box-title">Pending to LTO</h3>
            </div>
            <div class="box-body">
              <!-- Date -->
 <button type="button" class="btn btn-info btn_reports" id="excel" > <span class="fa fa-download"></span> Download Excel</button> 
              <!-- /.form group -->
 <button type="button" class="btn btn-info" id="upload_to_server" > <span class="fa fa-download"></span> Upload To LTO Server</button> 
              <!-- Date and time range -->
              <div class="form-group">
                <label></label>
           <div class="box-body">
              <table id="example2" style="width: 100%;" class="table table-bordered table-striped">
                <thead>
                       <tr>
        <th>ID</th>
        <th>Name</th> 
        <th>Type</th>
        <th>License</th>
        <th>Clinic</th>
        <th>Date</th>
        <th>Action</th>       
                </tr>
                </thead>

                <tbody>
           
        <tfoot>
                        <tr>
        <th>ID</th>
        <th>Name</th> 
        <th>Type</th>
        <th>License</th>
        <th>Clinic</th>
        <th>Date</th>
        <th>Action</th>         
                </tr>
                </tfoot>
              </table>
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




        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Uploaded To LTO</h3>
            </div>
            <div class="box-body">
              <!-- Date -->
 <button type="button" class="btn btn-info btn_reports" id="excel" > <span class="fa fa-download"></span> Download Excel</button> 
              <!-- /.form group -->

              <!-- Date and time range -->
              <div class="form-group">
                <label></label>
           <div class="box-body">
              <table id="example1" style="width: 100%;" class="table table-bordered table-striped">
                <thead>
                       <tr>
        <th>ID</th>
        <th>Name</th> 
        <th>Type</th>
        <th>License</th>
        <th>Clinic</th>
        <th>Date</th>
        <th>Action</th>       
                </tr>
                </thead>

                <tbody>
           
        <tfoot>
                        <tr>
        <th>ID</th>
        <th>Name</th> 
        <th>Type</th>
        <th>License</th>
        <th>Clinic</th>
        <th>Date</th>
        <th>Action</th>         
                </tr>
                </tfoot>
              </table>
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








      </div>
      
      
      
      
      
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>

  <!-- /.content-wrapper -->

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

    // $("#example1").DataTable();
    oTable=$("#example1").DataTable({
  "processing": true,
  "serverSide": true,
    "ajax": "../data/report_list.php",

    });

    // $("#example1").DataTable();
    oTable=$("#example2").DataTable({
  "processing": true,
  "serverSide": true,
    "ajax": "../data/report_list2.php",

    });
    //Wizard
    $(document).on('click','.edit_btn', function (e) {
            var id=$(this).attr("id");
       window.location.replace("edit_report?uid="+id);
      
    });


        $(document).on('click','.view_btn', function (e) {
            var id=$(this).attr("id");
       window.location.replace("../import/view_cert?uid="+id);
      
    });
    

</script>
</html>
