<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Medical</title>
  <link rel="icon" type="image/x-icon" href="https://systechph-medical.com/assets/systech.png">
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <?php
  include("../includes/css.php");
  include("../../class.admin.php");
  $auth_item = new admin();
  ?>

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <link rel="stylesheet" href="../../dist/css/medic.css">
</head>
<style>

</style>

<body class="hold-transition skin-blue sidebar-mini  ">


  <?php
  include("../includes/main-header.php");

  ?>


  <div class="container-fluid p-0">
    <div class="row mb-3">
      <div class="header-card card p-4">
        <div class="d-flex justify-content-between align-items-center mt-2">
          <div>
            <h2 class="color-purple">Users</h2>
          </div>
          <div class="text-end">
            <h6 class="text-secondary">Welcome User : <?php echo $_SESSION['full_names'];  ?></h6>
            <h6 id="current-date" class="text-secondary">---</h6>
          </div>
        </div>
      </div>
    </div>

    <!-- /.col (left) -->
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-body">
          <!-- Date -->
          <Table class="d-flex flex-row-reverse mr-2">
            <tr>
              <Td>
                <button type="button" class="btn btn-info btn_reports" id="excel" title="Download Excel"> <span class="fa fa-file-csv"></span> </button>
              </Td>
              <td>&nbsp;</td>
              <td>
                <button type='button' id='add_rec' class=' btn btn-block btn-info' data-toggle='modal' title='Add Record'><i class='fa fa-plus'></i></button>
              </td>
            </tr>
          </Table>
          <!-- /.form group -->

          <!-- Date and time range -->
          <div class="form-group">
            <div class="box-body">
              <table id="example1" style="width: 100%;" class="table table-bordered table-striped text-center">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Last Login</th>
                    <th>Account Type</th>
                    <th style="width:200px; ">Action</th>
                  </tr>
                </thead>

                <tbody>
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
          <button type="button" class="close" data-bs-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
          <h4 class="modal-title" id="myModalLabel">System Message</h4>
        </div>
        <div class="modal-body">

          <centeR><span id="erroradd" style="color:red;"></span></centeR>
          <strong>
            <lable>UserName : <span id="uname_span" style="color:red"></span><span id="uname_span2" style="color:green"></span></lable>
            <input type="text" name="clinicname" placeholder="Enter Username" id="uname" class="form-control noSpace" />
            <lable>Password :</lable>
            <input type="password" name="clinicname" placeholder="Enter Password" id="pwd" class="form-control noSpace" />
            <lable>First Name :</lable>
            <input type="text" name="clinicname" placeholder="Enter Users First Name" id="fname" class="form-control " />
            <lable>Last Name :</lable>
            <input type="text" name="clinicname" placeholder="Enter Users First Name" id="lname" class="form-control " />

            <lable>Clinic :</lable>
            <select class="form-control select2" id="clinic" style="width:100% ">
              <?php
              $stmt = $auth_item->runQuery("SELECT * FROM tbl_clinics");
              $stmt->execute();
              while ($Row = $stmt->fetch(PDO::FETCH_ASSOC)) {
              ?>
                <option value="<?php echo base64_encode($Row['id']); ?>"><?php echo $Row['name']; ?></option>
              <?php
              }
              ?>

            </select>
        </div>
        <div class="modal-footer">
          <button type="button" id="save_data" class="btn btn-info">Save</button>
          <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>


  <!-- Creates the bootstrap modal where the image will appear -->
  <div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-bs-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
          <h4 class="modal-title" id="myModalLabel">System Message</h4>
        </div>
        <div class="modal-body">

          <div class="form-group">

            <centeR><span id="erroradd2" style="color:red;"></span></centeR>
            <strong>
              <lable>UserName : <span id="uname_span_edit" style="color:red"></span><span id="uname_span_edit2" style="color:green"></span></lable>
              <input type="text" name="clinicname" placeholder="Enter Username" id="edit_uname" class="form-control noSpace" />
              <lable>Password :</lable>
              <input type="password" name="clinicname" placeholder="Enter Password" id="edit_pwd" class="form-control noSpace" />
              <lable>First Name :</lable>
              <input type="text" name="clinicname" placeholder="Enter Users First Name" id="edit_fname" class="form-control " />

              <lable>Last Name :</lable>
              <input type="text" name="clinicname" placeholder="Enter Users First Name" id="edit_lname" class="form-control " />

              <lable>Clinic :</lable>
              <select class="form-control select2" id="edit_clinic" style="width:100% ">
                <?php
                $stmt = $auth_item->runQuery("SELECT * FROM tbl_clinics");
                $stmt->execute();
                while ($Row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                ?>
                  <option value="<?php echo base64_encode($Row['id']); ?>"><?php echo $Row['name']; ?></option>
                <?php
                }
                ?>

              </select>
          </div>


        </div>

        <div class="modal-footer">
          <button type="button" id="update_data" class="btn btn-info">Update</button>
          <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>




  <!-- Creates the bootstrap modal where the image will appear -->
  <div class="modal fade" id="removemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-bs-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
          <h4 class="modal-title" id="myModalLabel">System Message</h4>
        </div>
        <div class="modal-body">

          Do you really want to delete this account?
        </div>
        <div class="modal-footer">
          <button type="button" id="remove_data" class="btn btn-info">Delete</button>
          <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
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

    $('.noSpace').keyup(function() {
      this.value = this.value.replace(/\s/g, '');
    });


    var minLength = 3;
    var maxLength = 20;

    $("#uname").on("keydown keyup change", function() {
      var value = $(this).val();

      if (value.length < minLength) {
        $("#uname_span2").text("");
        $("#uname_span").text("Text is short");
      } else if (value.length > maxLength) {
        $("#uname_span2").text("");
        $("#uname_span").text("Text is long");
      } else {
        $("#uname_span").text("");
        $("#uname_span2").text("Text is valid");
      }



    });



    $("#edit_uname").on("keydown keyup change", function() {
      var value = $(this).val();

      if (value.length < minLength) {
        $("#uname_span_edit2").text("");
        $("#uname_span_edit").text("Text is short");
      } else if (value.length > maxLength) {
        $("#uname_span_edit2").text("");
        $("#uname_span_edit").text("Text is long");
      } else {
        $("#uname_span_edit").text("");
        $("#uname_span_edit2").text("Text is valid");
      }



    });

    $("#add_rec").on("click", function() {

      $("#addmodal").modal("show");
    });
    var edit_id = "";
    $(document).on("click", ".edit_btn", function() {
      edit_id = $(this).attr("id");
      console.log(edit_id)
      var myObj = JSON.parse($(this).attr("data-name"));
      $("#edit_fname").val(myObj[1]);
      $("#edit_lname").val(myObj[2]);
      $("#edit_clinic").val(myObj[3]).change();
      $("#edit_uname").val(myObj[4]);
      $("#edit_pwd").val(myObj[5]);
      $("#editmodal").modal("show");
    });



    var remove_id = "";
    $(document).on("click", ".remove_btn", function() {
      remove_id = $(this).attr("id");
      $("#removemodal").modal("show");
    });
    // $("#example1").DataTable();
    oTable = $("#example1").DataTable({
      "processing": true,
      "serverSide": true,
      "ajax": "../data/user_list.php",

    });

    $("#save_data").on("click", function() {
      $("#erroradd").text("");
      var fname = $("#fname").val();
      var lname = $("#lname").val();
      var clinic = $("#clinic").val();
      var uname = $("#uname").val();
      var pwd = $("#pwd").val();
      if (fname === "" || lname === "" || clinic === "" || pwd === "" || uname === "") {
        $("#erroradd").text("Empty fields found!!");
        return false;
      }

      var $this = $(this);
      $this.html('Saving..');
      $("#save_data").attr("disabled", "disabled");
      var fd = new FormData();
      fd.append('status', "10");
      fd.append('fname', fname);
      fd.append('lname', lname);
      fd.append('uname', uname);
      fd.append('pwd', pwd);
      fd.append('clinic', clinic);
      $.ajax({
        url: "../../control/control_admin.php",
        data: fd,
        processData: false,
        contentType: false,
        type: 'POST',
        success: function(result) {

          setTimeout(function() {
            if ($.trim(result) !== "alread_exist") {
              swal("Systech : Add of user  was successfull!!   ", "success");
              $(".clear_input").val("");
              $("#uname").css('border-color', '');
              $("#addmodal").modal("hide");
              setTimeout(function() {
                location.reload(true);
              }, 1000);
            } else {
              $("#uname").css('border-color', 'red');
              swal("Systech : User username was already taken !!  ", "warning");
            }
            $this.html("Save");

            $("#save_data").removeAttr("disabled");
            oTable.ajax.reload();

          }, 2000);
        }

      });

    });

    $("#update_data").on("click", function() {
      $("#erroradd2").text("");
      var fname = $("#edit_fname").val();
      var lname = $("#edit_lname").val();
      var clinic = $("#edit_clinic").val();
      var uname = $("#edit_uname").val();
      var pwd = $("#edit_pwd").val();
      if (fname === "" || lname === "" || clinic === "" || pwd === "" || uname === "") {
        $("#erroradd2").text("Empty fields found!!");
        return false;
      }

      var $this = $(this);
      $this.html('Saving..');
      $("#update_data").attr("disabled", "disabled");
      var fd = new FormData();
      fd.append('id', edit_id);
      fd.append('status', "11");
      fd.append('fname', fname);
      fd.append('lname', lname);
      fd.append('uname', uname);
      fd.append('pwd', pwd);
      fd.append('clinic', clinic);
      $.ajax({
        url: "../../control/control_admin.php",
        data: fd,
        processData: false,
        contentType: false,
        type: 'POST',
        success: function(result) {
          setTimeout(function() {
            if ($.trim(result) !== "alread_exist") {
              swal("Systech : Update of user was successfull!!  ", "success");
              $(".clear_input").val("");
              $("#edit_uname").css('border-color', '');
              $("#editmodal").modal("hide");
              setTimeout(function() {
                location.reload(true);
              }, 1000);
            } else {
              $("#edit_uname").css('border-color', 'red');

              swal("Systech : Username was already taken !!  ", "warning");
            }
            $this.html("Update");
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
      fd.append('status', "12");
      fd.append('id', remove_id);
      $.ajax({
        url: "../../control/control_admin.php",
        data: fd,
        processData: false,
        contentType: false,
        type: 'POST',
        success: function(result) {
          console.log(result);

          setTimeout(function() {
            $this.html("Delete");
            swal("Systech : Remove of user was successfull!!   ", "success");

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
    */
  });
</script>

</html>