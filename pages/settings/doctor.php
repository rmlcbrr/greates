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

<body class="hold-transition skin-blue sidebar-mini ">

  <?php
  include("../includes/main-header.php");

  include("../../class.admin.php");
  $auth_item = new admin();
  ?>

  <!-- Content Header (Page header) -->

  <?php

  ?>
  <div class="container-fluid p-0">
    <div class="row mb-3">
      <div class="header-card card p-4">
        <div class="d-flex justify-content-between align-items-center mt-2">
          <div>
            <h2 class="color-purple"> Doctors Account</h2>
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
        <div class="box-body">
          <!-- Date -->
          <Table class="d-flex flex-row-reverse mr-2">
            <tr>
              <Td>
                <button type="button" class="btn btn-info btn_reports" id="excel"> <span class="fa fa-file-csv" title='Download Excel'></span></button>
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

                    <th>Name</th>
                    <th>Email</th>
                    <th>PRC License#</th>
                    <th>PTR#</th>
                    <th>Clinic</th>
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
          <button type="button" class="close" data-bs-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
          <h4 class="modal-title" id="myModalLabel">System Message</h4>
        </div>
        <div class="modal-body">

          <centeR><span id="erroradd" style="color:red;"></span></centeR>
          <label>Clinic</label><select class="form-control noSpace" id="clinics">
            <?php
            $stmt = $auth_item->runQuery("SELECT * FROM tbl_clinics ");
            $stmt->execute();
            while ($Row = $stmt->fetch(PDO::FETCH_ASSOC)) {
              echo "<option value='" . $Row['id'] . "'>" . $Row['name'] . "</option>";
            }
            ?>
          </select>
          <strong>
            <lable>UserName : <span id="uname_span" style="color:red"></span><span id="uname_span2" style="color:green"></span></lable>
            <input type="text" name="clinicname" placeholder="Enter Username" id="uname" class="form-control noSpace" />
            <lable>Password :</lable>
            <input type="password" name="clinicname" placeholder="Enter Password" id="pwd" class="form-control noSpace" />
            <lable>Email Address :</lable>
            <input type="text" name="clinicname" placeholder="Enter Email Address" id="email" class="form-control noSpace" />
            <lable>First Name :</lable>
            <input type="text" name="clinicname" placeholder="Enter Physicians First Name" id="fname" class="form-control " />
            <lable>Last Name :</lable>
            <input type="text" name="clinicname" placeholder="Enter Physicians First Name" id="lname" class="form-control " />
            <lable>PRC Number:</lable>
            <input type="text" name="clinicname" placeholder="Enter PRC Number" id="prc_num" class="form-control " />
            <lable>PTR Number :</lable>
            <input type="text" name="clinicname" placeholder="Enter PTR Number " id="ptr_num" class="form-control " />
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

            <label>Clinic</label><select class="form-control noSpace" id="edit_clinic">
              <?php
              $stmt = $auth_item->runQuery("SELECT * FROM tbl_clinics ");
              $stmt->execute();
              while ($Row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<option value='" . $Row['id'] . "'>" . $Row['name'] . "</option>";
              }
              ?>
            </select>
            <strong>
              <lable>UserName : <span id="uname_span_edit" style="color:red"></span><span id="uname_span_edit2" style="color:green"></span></lable>
              <input type="text" name="clinicname" placeholder="Enter Username" id="edit_uname" class="form-control clear_input noSpace" />
              <lable>Password :</lable>
              <input type="password" name="clinicname" placeholder="Enter Password" id="edit_pwd" class="form-control  clear_input noSpace" />
              <lable>Email Address :</lable>
              <input type="text" name="clinicname" placeholder="Enter Email Address" id="edit_email" class="form-control noSpace" />
              <lable>First Name :</lable>
              <input type="text" name="clinicname" placeholder="Enter Physicians First Name" id="edit_fname" class="form-control  clear_input" />

              <lable>Last Name :</lable>
              <input type="text" name="clinicname" placeholder="Enter Physicians First Name" id="edit_lname" class="form-control  clear_input" />
              <lable>PRC Number:</lable>
              <input type="text" name="clinicname" placeholder="Enter PRC Number" id="edit_prc_num" class="form-control  clear_input" />
              <lable>PTR Number :</lable>
              <input type="text" name="clinicname" placeholder="Enter PTR Number " id="edit_ptr_num" class="form-control  clear_input" />
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


    var minLength = 3;
    var maxLength = 10;

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



    $("#add_rec").on("click", function() {

      $("#addmodal").modal("show");
    });
    var edit_id = "";
    $(document).on("click", ".edit_btn", function() {
      edit_id = $(this).attr("id");
      var myObj = JSON.parse($(this).attr("data-name"));
      $("#edit_fname").val(myObj[1]);
      $("#edit_lname").val(myObj[2]);
      $("#edit_prc_num").val(myObj[3]);
      $("#edit_ptr_num").val(myObj[4]);
      $("#edit_uname").val(myObj[5]);
      $("#edit_pwd").val(myObj[6]);
      $("#edit_clinic").val(myObj[7]);
      $("#edit_email").val(myObj[8]);
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
      "ajax": "../data/physician_list.php",
      "aoColumnDefs": [{
        'bSortable': false,
        'aTargets': [4]
      }]

    });

    $("#save_data").on("click", function() {
      $("#erroradd").text("");
      var fname = $("#fname").val();
      var email = $("#email").val();
      var clinics = $("#clinics").val();
      var lname = $("#lname").val();
      var prc_num = $("#prc_num").val();
      var ptr_num = $("#ptr_num").val();
      var uname = $("#uname").val();
      var pwd = $("#pwd").val();
      if (fname === "" || lname === "" || prc_num === "" || ptr_num === "" || pwd === "" || uname === "" || email === "") {
        $("#erroradd").text("Empty fields found!!");
        return false;
      }

      var $this = $(this);
      $this.html('Saving..');
      $("#save_data").attr("disabled", "disabled");
      var fd = new FormData();
      fd.append('status', "4");
      fd.append('fname', fname);
      fd.append('email', email);
      fd.append('clinics', clinics);
      fd.append('lname', lname);
      fd.append('uname', uname);
      fd.append('pwd', pwd);
      fd.append('prc_num', prc_num);
      fd.append('ptr_num', ptr_num);
      $.ajax({
        url: "../../control/control_admin.php",
        data: fd,
        processData: false,
        contentType: false,
        type: 'POST',
        success: function(result) {

          setTimeout(function() {
            if ($.trim(result) !== "alread_exist") {
              swal("Systech : Record of physicians  was successfull!!   ", "success");
              $(".clear_input").val("");
              $("#uname").css('border-color', '');
              $("#addmodal").modal("hide");
              setTimeout(function() {
                location.reload(true);
              }, 1000);
            } else {
              $("#uname").css('border-color', 'red');
              swal("Systech : Record of physicians username was already take   ", "warning");

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
      var prc_num = $("#edit_prc_num").val();
      var ptr_num = $("#edit_ptr_num").val();
      var uname = $("#edit_uname").val();
      var clinics = $("#edit_clinic").val();
      var pwd = $("#edit_pwd").val();
      if (fname === "" || lname === "" || prc_num === "" || ptr_num === "" || pwd === "" || uname === "") {
        $("#erroradd2").text("Empty fields found!!");
        return false;
      }

      var $this = $(this);
      $this.html('Saving..');
      $("#update_data").attr("disabled", "disabled");
      var fd = new FormData();
      fd.append('id', edit_id);
      fd.append('status', "6");
      fd.append('fname', fname);
      fd.append('lname', lname);
      fd.append('uname', uname);
      fd.append('pwd', pwd);
      fd.append('prc_num', prc_num);
      fd.append('ptr_num', ptr_num);
      fd.append('clinics', clinics);


      $.ajax({
        url: "../../control/control_admin.php",
        data: fd,
        processData: false,
        contentType: false,
        type: 'POST',
        success: function(result) {



          setTimeout(function() {
            if ($.trim(result) !== "alread_exist") {
              swal("Systech : Update of physicians  was successfull!!   ", "success");
              $(".clear_input").val("");
              $("#edit_uname").css('border-color', '');
              $("#editmodal").modal("hide");
              setTimeout(function() {
                location.reload(true);
              }, 1000);
            } else {
              $("#edit_uname").css('border-color', 'red');
              swal("Systech : Record of physicians username was already take   ", "warning");
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
            swal("Systech : Remove of physicians  was successfull!!   ", "success");
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


    $('.noSpace').keyup(function() {
      this.value = this.value.replace(/\s/g, '');
    });

  });
</script>

</html>