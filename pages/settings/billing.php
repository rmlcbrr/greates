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

<link rel="stylesheet" href="../../plugins/datepicker/bootstrap-datetimepicker.css">
<link rel="stylesheet" href="../../plugins/daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <link rel="stylesheet" href="../../dist/css/medic.css">
</head>
<style>
#item_load #theImg {
    position: relative;
 display: block;
    margin: 0px auto;
}
#item_load2 #theImg2 {
    position: relative;
 display: block;
    margin: 0px auto;
}
</style>
<body class="hold-transition skin-blue sidebar-mini sidebar-collapse ">
<div class="wrapper">
      <style>
         input[type=checkbox]
{
  /* Double-sized Checkboxes */
  -ms-transform: scale(2); /* IE */
  -moz-transform: scale(2); /* FF */
  -webkit-transform: scale(2); /* Safari and Chrome */
  -o-transform: scale(2); /* Opera */
  transform: scale(2);
  padding: 10px;
}

/* Might want to wrap a span around your checkbox text */
.checkboxtext
{
  /* Checkbox text */
  font-size: 110%;
  display: inline;
}
#rel
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
        <li><a href="#">Billing</a></li>
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
        <small>Billing</small>
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
              <h3 class="box-title">  Clinic List </h3>
            </div>
            <div class="box-body">
              <!-- Date -->
              <!-- /.form group -->

          
              <div class="form-group">
                <label></label>
           <div class="box-body">
              <table id="example2" style="width: 100%;" class="table table-bordered table-striped">
                <thead>
                       <tr>

        <th>Action</th> 
        <th>Clinic</th>
  <th>LTO Accreditation</th>
                </tr>
                </thead>

                <tbody>
           
        <tfoot>
                        <tr> 
 
        <th>Action</th> 
        <th>Clinic</th>
      
  <th>LTO Accreditation</th>
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

        <!-- /.col (right) -->
  <div class="row">

  
          <!-- /.box -->

        </div>
        <!-- /.col (left) -->
        <div class="col-md-6">
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">  Invoice List </h3>
            </div>
            <div class="box-body">
              <!-- Date -->
              <!-- /.form group -->

          
              <div class="form-group">
                <label></label>
           <div class="box-body"  id="item_load2">
             
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


       <div class="col-md-6">
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Unbilled Uploads </h3>
            </div>
            <div class="box-body" id="item_load">
              <!-- Date -->
              <!-- /.form group -->

              
      
              <!-- /.form group -->

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

  <!-- /.content-wrapper -->

<?php
include("../includes/footer.php");
?>

</div>
<!-- ./wrapper -->
<?php
include("../includes/js.php");
?>
  <!-- Modal -->
<div id="myModalwarning" class="modal fade  modal-warning" role="dialog">
  <div class="modal-dialog  modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Message</h4>
      </div>
      <div class="modal-body">
        <h3>Error Found : No data selected ,Process was halted. </h3>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>



<!-- Modal -->
<div id="myModalApprove" class="modal fade  modal-info" role="dialog">
  <div class="modal-dialog  modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Message</h4>
      </div>
      <div class="modal-body">
     <h3>Are you sure to approve billing item/s?</h3>
      </div>
      <div class="modal-footer">
    <button type="button" id="save-approve" class="btn btn-success" >Proceed</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


<!-- Modal -->
<div id="myModalApproveGenerate" class="modal fade  modal-default" role="dialog">
  <div class="modal-dialog  modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Message</h4>
      </div>
      <div class="modal-body" id="load_modal_computation">
      
      </div>
      <div class="modal-footer">
    <button type="button" id="save-approve" class="btn btn-success" >Approved</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>



<!-- Modal -->
<div id="myModalViewApproved" class="modal fade  modal-default" role="dialog">
  <div class="modal-dialog  modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Message</h4>
      </div>
      <div class="modal-body" id="load_modal_data">
      
      </div>
      <div class="modal-footer">
           <button type="button" class="btn btn-default">Download PDF</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<script src="../../dist/js/moment.min.js"></script>
<script src="../../plugins/datepicker/bootstrap-datetimepicker.js"></script>
<script src="../../plugins/daterangepicker/daterangepicker.js"></script>
</body>
<script type="text/javascript">


    // $("#example1").DataTable();
    oTable=$("#example2").DataTable({
  "processing": true,
  "serverSide": true,
    "ajax": "../data/clinic_list_billing.php",
    scrollY:200,
    pageLength : 5,
        scrollX: true,

        "pageLength": 100,
        scroller: true,
     "aoColumnDefs": [
                { 'bSortable': false, 'aTargets': [0] }]
    });
    //Wizard


        $(document).on('click','.view_btn', function (e) {
            var id=$(this).attr("id");

    loadbar();
    loadbar2();
    var id=$.trim($(this).attr("id"));

    $("#theImg2").fadeOut(1000, function() { $(this).remove();
    $("#item_load2").fadeIn(3000,function() {
    $(this).load("load_data_table2.php?search="+encodeURI(id));
                          });

     });


        $("#theImg").fadeOut(1000, function() { $(this).remove();
      $("#item_load").fadeIn(3000,function() {
    $(this).load("load_data_table.php?search="+encodeURI(id));
                          });
           });
    });



    $(document).on('click','#submit_billing', function (e) {
     var id=$(this).attr("id");
      $("#myModalApproveGenerate").modal("show");
       $("#load_modal_data").load("load_invoice_new_data.php?search="+encodeURI(id));
    });

    $(document).on('click','.view_invoice', function (e) {
     var id=$(this).attr("id");

      $("#load_modal_data").load("load_invoice_view_data.php?search="+encodeURI(id));
      $("#myModalViewApproved").modal("show");

    });



  function loadbar() {
      $("#item_load").html("");
    var url = "../../dist/img/loader1.gif";
    $('#item_load').prepend('<img id="theImg" src="../../dist/img/loader1.gif" />')
 
  }
    function loadbar2() {
      $("#item_load2").html("");
    var url = "../../dist/img/loader1.gif";
    $('#item_load2').prepend('<img id="theImg2" src="../../dist/img/loader1.gif" />')
 
  }
</script>
</html>
