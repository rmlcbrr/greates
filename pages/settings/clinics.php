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
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <link rel="stylesheet" href="../../dist/css/medic.css">
</head>
<style>

</style>

<body class="hold-transition skin-blue sidebar-mini sidebar-collapse ">


  <?php
  include("../includes/main-header.php");
  ?>

  <div class="container-fluid p-0">
    <div class="row mb-3">
      <div class="header-card card p-4">
        <div class="d-flex justify-content-between align-items-center mt-2">
          <div>
            <h2 class="color-purple">Clinic</h2>
            <h6 class="text-secondary"></h6>
          </div>
          <div class="text-end">
            <h6 class="text-secondary">Welcome User : <?php echo $_SESSION['full_names'];  ?></h6>
            <h6 id="current-date" class="text-secondary">---</h6>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-body">
          <!-- Date -->
          <Table class="d-flex flex-row-reverse mr-2">
            <tr>
              <Td>
                <button type="button" class="btn btn-info btn_reports" id="excel" title='Download Excel'> <span class="fa fa-file-csv"></span></button>
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
                    <th>LTO Accredication #</th>
                    <th>Payment Per Upload</th>

                    <th>Expiration Date in LTMS</th>
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


          <lable>Clinics Name :</lable>
          <input type="text" name="clinicname" placeholder="Enter Clinic Name" id="clinic_name" class="form-control " />


          <lable>LTO Accredication # :</lable>
          <input type="text" name="lto_accres" placeholder="Enter Lto Accredication #" id="lto_accre" class="form-control " />



          <lable>Expiration Date in LTMS (Year-month-day) :</lable>
          <input type="text" name="edit_lto_accres" placeholder="example : 2000-03-10  " id="expire_date" class="form-control " />

          <lable>Payment per upload :</lable>
          <input type="number" name="edit_lto_accres" placeholder="" id="payment" class="form-control " />
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



          <lable>Clinic Name :</lable></br>
          <input type="text" name="name" placeholder="Enter Clinic Name" id="edit_clinic_name" class="form-control " />

          <lable>LTO Accredication # :</lable>
          <input type="text" name="edit_lto_accres" placeholder="Enter Lto Accredication #" id="edit_lto_accre" class="form-control " />



          <lable>Expiration Date in LTMS (Year-month-day) :</lable>
          <input type="text" name="edit_lto_accres" placeholder="example : 2000-03-10  " id="edit_expire_date" class="form-control " />

          <lable>Payment per upload :</lable>
          <input type="number" name="edit_lto_accres" placeholder="" id="edit_payment" class="form-control " />
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

          Do you really want to delete this item?
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

    $("#add_rec").on("click", function() {

      $("#addmodal").modal("show");
    });

    $(document).on("click", ".view-info", function() {
      var view_id = $(this).attr("id");
      window.location.replace("view_clinics.php?id=" + view_id);
    });




    var edit_id = "";
    $(document).on("click", ".edit_btn", function() {
      edit_id = $(this).attr("id");
      $("#edit_clinic_name").val($(this).attr("data-name"));
      $("#edit_lto_accre").val($(this).attr("data-lto"));
      $("#edit_expire_date").val($(this).attr("data-expire-date"));
      $("#edit_payment").val($(this).attr("data-payment"));
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
      "ajax": "../data/clinic_list.php",

    });



    $('.btn_reports').on('click', function() { // for select box

      var clinics = $("#clinics").val();
      var dcr = $("#date_created").val();

      var temp = clinics + "," + dcr;
      //window.open("wb_report.php?date1="+encodeURI(date)+'&date2='+encodeURI(date2), '_blank');
      window.open("excel/report_clinic_excel.php?data=" + encodeURI(temp), '_blank');
    });

    $("#save_data").on("click", function() {
      $("#erroradd").text("");
      var clinic_name = $("#clinic_name").val();
      var lto_accre = $("#lto_accre").val();
      var expire_date = $("#expire_date").val();
      var payment = $("#payment").val();
      if (clinic_name === "" || lto_accre === "s" || payment === "") {
        $("#erroradd").text("Empty fields found!!");
        return false;
      }

      var $this = $(this);
      $this.html('Saving..');
      $("#save_data").attr("disabled", "disabled");
      var fd = new FormData();
      fd.append('status', "2");
      fd.append('name', clinic_name);
      fd.append('payment', payment);
      fd.append('expire_date', expire_date);
      fd.append('lto_accre', lto_accre);
      $.ajax({
        url: "../../control/control_admin.php",
        data: fd,
        processData: false,
        contentType: false,
        type: 'POST',
        success: function(result) {
          console.log(result);

          swal("Systech : Record of clinic  was successfull!!   ", "success");

          setTimeout(function() {
            $this.html("Save");
            $("#clinic_name").val("");
            $("#addmodal").modal("hide");
            $("#save_data").removeAttr("disabled");
            oTable.ajax.reload();
          }, 2000);
        }

      });

    });

    $("#update_data").on("click", function() {

      $("#erroredit").text("");
      var clinic_name = $("#edit_clinic_name").val();

      var expire_date = $("#edit_expire_date").val();
      var lto_accre = $("#edit_lto_accre").val();
      var payment = $("#edit_payment").val();

      if (clinic_name === "" || lto_accre === "s" || payment === "") {
        $("#erroredit").text("Empty fields found!!");
        return false;
      }

      var $this = $(this);
      $this.html('Saving..');
      $("#update_data").attr("disabled", "disabled");
      var fd = new FormData();
      fd.append('status', "3");
      fd.append('name', clinic_name);
      fd.append('payment', payment);
      fd.append('expire_date', expire_date);
      fd.append('lto_accre', lto_accre);
      fd.append('id', edit_id);
      $.ajax({
        url: "../../control/control_admin.php",
        data: fd,
        processData: false,
        contentType: false,
        type: 'POST',
        success: function(result) {
          swal("Systech : Update of clinic  was successfull!!   ", "success");

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
      fd.append('status', "5");
      fd.append('id', remove_id);
      $.ajax({
        url: "../../control/control_admin.php",
        data: fd,
        processData: false,
        contentType: false,
        type: 'POST',
        success: function(result) {
          console.log(result);
          swal("Systech : Remove of clinic  was successfull!!   ", "success");

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
    */
  });
</script>

</html>