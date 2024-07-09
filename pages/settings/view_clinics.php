<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | General Form Elements</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <?php

  include("../includes/css.php");
  include("../../class.admin.php");
  $auth_item = new admin();
  ?>
  <link href="../../dist/css/jquery-ui.css" rel="stylesheet" />


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
  .sidebar-mini.sidebar-collapse .content-wrapper,
  .sidebar-mini.sidebar-collapse .right-side,
  .sidebar-mini.sidebar-collapse .main-footer {
    margin-left: 0px !important;
    z-index: 840;
  }

  .content {
    padding: 0px 0px 0px !important;
  }
</style>

<body class="hold-transition skin-blue sidebar-mini sidebar-collapse ">
  <div class="wrapper">

    <?php
    include("../includes/main-header.php");
    include("../includes/aside.php");

    $id = base64_decode($_GET['id']);
    $query_items = "SELECT * FROM `tbl_clinics` WHERE id='$id'";
    $stmt = $auth_item->runQuery($query_items);
    $stmt->execute();
    $Row = $stmt->fetch(PDO::FETCH_ASSOC);

    ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          View of Clinic
          <small> PAGES</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li><a href="#">Clinic View</a></li>

        </ol>
      </section>
      <section class="content">
        <div class="row">
          <div class="col-xs-12">
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

            <section class="content">

              <!-- left column -->

              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">CLINIC INFORMATION</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal">
                  <div class="box-body">
                    <div class="form-group">

                      <h5> <label class="col-sm-2 control-label">Clinic</label></h5>

                      <h3> <?php echo  $Row['name']; ?></h3>

                    </div>



                  </div>
                  <!-- /.box-body -->

                </form>
              </div>
              <!-- /.box -->

              <!-- Form Element sizes -->

              <!-- /.box-body -->

              <!-- /.box -->

              <!-- /.box -->

              <!-- /.box -->

              <!--/.col (left) -->
              <!-- right column -->
              <!-- Horizontal Form -->
              <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">Transaction Information</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal">
                  <div class="box-body">
                    <table id="example1" style="width: 100%;" class="table table-bordered table-striped text-center">
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
                    </table>
                  </div>
                </form>
              </div>
              </form>
              <!-- /.box -->
          </div>
          </form>

      </section>


    </div>
    <!-- /.content -->
    <?php
    include("../includes/footer.php");
    ?>

  </div>
  <!-- /.content-wrapper -->


  </div>
  <!-- ./wrapper -->
  <?php
  include("../includes/js.php");
  ?>
  <script src="../../dist/js/jquery-ui.min.js"></script>

</body>
<script type="text/javascript">
  // $("#example1").DataTable();
  oTable = $("#example1").DataTable({
    "processing": true,
    "serverSide": true,
    "ajax": "../data/view_clinic_logs.php",

  });
</script>

</html>