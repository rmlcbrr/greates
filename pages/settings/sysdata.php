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
View 
        <small>Details of Settings</small>
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
              <h3 class="box-title">Settings Data</h3>
            </div>
            <div class="box-body">
              <!-- Date -->
              <Table>
                <tr>
 <td>
<button type='button' id='add_rec'  class=' btn btn-block btn-info'  style="width: 120px;" data-toggle='modal' title='Add Record'><i class='fa fa-plus' ></i> Add Data</button>
</td>
</tr>
</Table>
              <!-- /.form group -->

              <!-- Date and time range -->
              <div class="form-group">
                <label></label>
           <div class="box-body">
              <table id="example1" style="width: 100%;" class="table table-bordered table-striped">
                <thead>
                       <tr>
                <th>ID</th>
                   <th>Purpose</th>
        <th>Value</th> 
      
        <th style="width:200px; ">Action</th>
                </tr>
                </thead>

                <tbody>
           
        <tfoot>
                        <tr>
                      <th>ID</th>
        <th>Value</th> 
 
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


  
        <!-- Creates the bootstrap modal where the image will appear -->
<div class="modal fade" id="addmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">System Message</h4>
      </div>
      <div class="modal-body">

        <centeR><span id="erroradd" style="color:red;"></span></centeR>

       <lable>Purpose :</lable>
<input type="text" name="purpose" placeholder="Enter purpose Name" id="purpose" class="form-control " />
   
        <lable>Value :</lable>
<input type="text" name="value_data" placeholder="Enter Value Data" id="value_data" class="form-control " />
      </div>
      <div class="modal-footer">
                <button type="button" id="save_data" class="btn btn-info" >Save</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

  
        <!-- Creates the bootstrap modal where the image will appear -->
<div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">System Message</h4>
      </div>
      <div class="modal-body">



       <lable>Purpose :</lable>
<input type="text" name="purpose" placeholder="Enter purpose Name" id="edit_purpose" class="form-control " />
      </div>
        <lable>Value :</lable>
<input type="text" name="value_data" placeholder="Enter Value Data" id="edit_value_data" class="form-control " />
      </div>
      <div class="modal-footer">
                <button type="button" id="update_data" class="btn btn-info" >Update</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


  
        <!-- Creates the bootstrap modal where the image will appear -->
<div class="modal fade" id="removemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">System Message</h4>
      </div>
      <div class="modal-body">
       
Do you really want to delete this item?
      </div>
      <div class="modal-footer">
                <button type="button" id="remove_data" class="btn btn-info" >Delete</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<?php
include("../includes/js.php");
?>
</body>
<script type="text/javascript">

var oTable; // use a global for the submit and return data rendering in the examples
 
$(document).ready(function() {

    $("#add_rec").on("click", function () {

      $("#addmodal").modal("show");
    });

       $(document).on("click",".view-info", function () {
     var  view_id=$(this).attr("id");
    window.location.replace("view_clinics?id="+view_id);
       });




var edit_id="";
        $(document).on("click",".edit_btn", function () {
      edit_id=$(this).attr("id");
      $("#edit_clinic_name").val($(this).attr("data-name"));


      $("#editmodal").modal("show");
       });



 var remove_id="";
        $(document).on("click",".remove_btn", function () {
      remove_id=$(this).attr("id");
      $("#removemodal").modal("show");
    });
   // $("#example1").DataTable();
    oTable=$("#example1").DataTable({
  "processing": true,
  "serverSide": true,
    "ajax": "../data/sysdata_list.php",

    });

$("#save_data").on("click", function() {
  $("#erroradd").text("");
var purpose=$("#purpose").val();
var value_data=$("#value_data").val();
if(value_data==="" || purpose===""){
$("#erroradd").text("Empty fields found!!");
  return false;
}

  var $this = $(this);
 $this.html('Saving..');
  $("#save_data").attr("disabled", "disabled");
  var fd = new FormData();
    fd.append('status',"13");
    fd.append('purpose',purpose);
      fd.append('value_data',value_data);
        $.ajax({
          url: "../../control/control_admin.php",
          data: fd,
          processData: false,
          contentType: false,
          type:'POST',
          success:function(result){
            console.log(result);
            $.notify("Add of settings item was successfull!! ","success");
            setTimeout(function() {
                $this.html("Save");   
                $("#purpose").val("");
                $("#value_data").val("");
                 $("#addmodal").modal("hide");
                 $("#save_data").removeAttr("disabled");
                      oTable.ajax.reload();
            }, 2000);
              }

                  });

    });

$("#update_data").on("click", function() {
var edit_purpose=$("#edit_purpose").val();
var edit_value_data=$("#edit_value_data").val();

$("#erroredit").text("");

if(edit_purpose==="" || edit_value_data==="" ){
$("#erroredit").text("Empty fields found!!");
  return false;
}
 var $this = $(this);
$this.html('Saving..');
  $("#update_data").attr("disabled", "disabled");
  var fd = new FormData();
    fd.append('status',"3");
    fd.append('edit_purpose',edit_purpose);

    fd.append('edit_value_data',edit_value_data);
        fd.append('id',edit_id);
        $.ajax({
                url: "../../control/control_admin.php",
          data: fd,
          processData: false,
          contentType: false,
          type:'POST',
          success:function(result){
            $.notify("Update of settings item was successfull!! ","success");
            setTimeout(function() {
                $this.html("Update");   
                $("#edit_clinic_name").val("");
                 $("#editmodal").modal("hide");
                 $("#update_data").removeAttr("disabled");
                      oTable.ajax.reload();
            }, 2000);
              }

                  });

    });






$("#remove_data").on("click", function() {

 var $this = $(this);
$this.html('Saving..');
  $("#remove_data").attr("disabled", "disabled");
  var fd = new FormData();
    fd.append('status',"5");
        fd.append('id',remove_id);
        $.ajax({
             url: "../../control/control_admin.php",
          data: fd,
          processData: false,
          contentType: false,
          type:'POST',
          success:function(result){
            console.log(result);
            $.notify("Remove of clinic was successfull!! ","success");
            setTimeout(function() {
                $this.html("Delete");   
                
                 $("#removemodal").modal("hide");
                 $("#remove_data").removeAttr("disabled");
                      oTable.ajax.reload();
            }, 2000);
              }

                  });

    });
/*
    oTable.MakeCellsEditable({
        "onUpdate": myCallbackFunction,
        "inputCss":'my-input-class',
        "columns": [0,1,2,3],
        "allowNulls": {
            "columns": [2],
            "errorClass": 'error'
        },
        "confirmationButton": { // could also be true
            "confirmCss": 'my-confirm-class',
            "cancelCss": 'my-cancel-class'
        }
      
    });
});

function myCallbackFunction (updatedCell, updatedRow, oldValue) {
    console.log("The new value for the cell is: " + updatedCell.data());
    console.log("The old value for that cell was: " + oldValue);
    console.log("The values for each cell in that row are: " + updatedRow.data());
}

function destroyTable() {
    if ($.fn.DataTable.isDataTable('#myAdvancedTable')) {
        table.destroy();
        table.MakeCellsEditable("destroy");
    }
}
*/});


</script>
</html>
