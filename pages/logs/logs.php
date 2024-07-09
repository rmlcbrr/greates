<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Medical</title>
    <link rel="icon" type="image/x-icon" href="https://systechph-medical.com/assets/systech.png">
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
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
<link rel="stylesheet" href="../../plugins/datepicker/bootstrap-datetimepicker.css">
<link rel="stylesheet" href="../../plugins/daterangepicker/daterangepicker.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
<link rel="stylesheet" href="../../dist/css/medic.css">
</head>
<style>

</style>
<body class="hold-transition skin-blue sidebar-mini  ">


<?php
include("../includes/main-header.php");

?>

<?php 

?>
                <div class="container-fluid p-0">
                    <div class="row mb-3">
                        <div class="header-card card p-4">
                            <div class="d-flex justify-content-between align-items-center mt-2">
                                <div>
                                    <h2 class="color-purple">Logs</h2>
                                    <h6 class="text-secondary"></h6>
                                </div>
                                <div class="text-end">
                                    <h6 class="text-secondary">Welcome User :  <?php echo $_SESSION['full_names'];  ?></h6>
                                    <h6 id="current-date" class="text-secondary">---</h6>
                                </div>
                            </div>
                        </div>
                    </div>
  

        <!-- /.col (left) -->
        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">System Logs</h3>
            </div>
            <div class="box-body">
              <!-- Date -->
 <button type="button" class="btn btn-info btn_reports" id="excel" > <span class="fa fa-download"></span> Download Excel</button> 
              <!-- /.form group -->
   
              <!-- Date and time range -->
              <div class="form-group">
                <label></label>
           <div class="box-body">
              <table id="example1"  style="width: 100%;" class="table table-bordered table-striped">
                <thead>
              
                       <tr>
        <th>Activity</th>
        <th>Remarks</th> 
        <th>Type</th>
        <th>Date</th>   
                </tr>
                </thead>

                <tbody>
           
        <tfoot>
                        <tr>
        <th>Activity</th>
        <th>Remarks</th> 
        <th>Type</th>
        <th>Date</th>    
                </tr>
                </tfoot>
              </table>
            </div>
              </div>
              <!-- /.form group -->

            </div>
            <!-- /.box-body -->
          </div>

        </div>
        <!-- /.col (right) -->
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
<script src="../../dist/js/moment.min.js"></script>
<script src="../../plugins/datepicker/bootstrap-datetimepicker.js"></script>
<script src="../../plugins/daterangepicker/daterangepicker.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/plug-ins/1.11.3/sorting/datetime-moment.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.8.4/moment.min.js"></script>

</body>
<script type="text/javascript">

    // $("#example1").DataTable();
    oTable=$("#example1").DataTable({
  "processing": true,
  "serverSide": true,
    "ajax": "../data/sys_log.php",

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
