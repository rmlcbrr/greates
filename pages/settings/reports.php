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
  session_start();
  error_reporting(0);
  header('Access-Control-Allow-Origin: *');
  header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE');
  header('Access-Control-Allow-Headers: Origin, Content-Type, Accept, Authorization, X-Request-With');

  include("../includes/css.php");
  ?>
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
  include("../includes/aside.php");
  include("../../class.admin.php");
  $auth_item = new admin();
  $Uid_temps =  $_SESSION['u_id'];
  $stmt_user = $auth_item->runQuery("SELECT * FROM medical_users WHERE id='$Uid_temps'");
  $stmt_user->execute();
  $row_user = $stmt_user->fetch(PDO::FETCH_ASSOC);
  $username_login = $row_user['username'];

  $clinic_user = $row_user['clinic'];
  $stmt_clinic = $auth_item->runQuery("SELECT * from tbl_clinics WHERE id ='$clinic_user' ");
  $stmt_clinic->execute();

  if ($stmt_clinic->rowCount() > 0) {

    $row_clinic = $stmt_clinic->fetch(PDO::FETCH_ASSOC);
    $lto_accreditation_no = $row_clinic['lto_accreditation_no'];
  }
  ?>


  <div class="container-fluid p-0">
    <div class="row mb-3">
      <div class="header-card card p-4">
        <div class="d-flex justify-content-between align-items-center mt-2">
          <div>
            <h2 class="color-purple">Reports</h2>
            <h6 class="text-secondary"></h6>
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
        <div class="box-header">
          <h3 class="box-title">Uploaded to LTO</h3>
        </div>
        <div class="box-body">

          <div class="row">
            <div class="col-md-6">
              <table border="0">
                <tr>
                  <?php

                  //echo base64_decode("ODg4ODg4");
                  $account_types = trim(strtolower($_SESSION['u_account_type']));

                  ?>
                  <td>
                    <small>Filter By Clinic</small><select class="form-control noSpace" id="clinics" style="width: 217px;">
                      <?php
                      if ($account_types == "admin") {

                      ?>
                        <option value="All">All</option>
                      <?php
                      }



                      if (!empty($_SESSION['clinic_id']) && strtolower($_SESSION['u_account_type']) !== "admin") {
                        $clinics_id = $_SESSION['clinic_id'];
                        $stmt = $auth_item->runQuery("SELECT * FROM tbl_clinics WHERE id='$clinics_id'");
                        $stmt->execute();
                        $Row = $stmt->fetch(PDO::FETCH_ASSOC);
                        echo "<option value='" . $Row['id'] . "'>" . $Row['name'] . "</option>";
                      } else {
                        $stmt = $auth_item->runQuery("SELECT * FROM tbl_clinics ");
                        $stmt->execute();
                        while ($Row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                          echo "<option value='" . $Row['id'] . "'>" . $Row['name'] . "</option>";
                        }
                      }
                      ?>
                    </select>
                  </td>
                  <td>
                    <small>ate Created</small>
                    <input style="width: 217px;" type="text" class="form-control search-box" value="" id="date_created" name="datefilter" placeholder="Enter Date Created" />
                  </td>
                  <Td width="100px;"> <button type="button" class="btn btn-info mt-4" id="search_clinic"> <span class="fa fa-search"></span> Search</button></Td>
                </tr>
              </table>
            </div>
            <div class="col-md-6">
              <Table class="d-flex flex-row-reverse mr-2 mt-3">
                <tr>
                  <Td>
                    <button type="button" class="btn btn-info btn_reports" id="excel" title="Download Excel"> <span class="fa fa-file-csv"></span> </button>
                  </Td>
                  <td>&nbsp;</td>
                  <td>
                    <button type="button" class="btn btn-info btn_pdf" id="upload_to_server" title="Download Excel"> <span class="fa fa-file-pdf"></span> </button>
                  </td>
                </tr>
              </Table>
            </div>
          </div>
          <div class="form-group">
            <div class="box-body">
              <table id="example2" style="width: 100%;" class="table table-bordered table-striped text-center">
                <thead>
                  <tr>
                    <th>Dermalog ID</th>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Driver License</th>
                    <th>Clinic</th>
                    <th>Doctor Attended</th>
                    <th>Date</th>
                    <th>Validity</th>
                    <th>Action</th>
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

  <!-- /.content-wrapper -->

  <?php
  include("../includes/footer.php");
  ?>

  </div>
  <!-- ./wrapper -->
  <?php
  include("../includes/js.php");
  ?>

  <div class="modal fade" id="previewExamModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
          <h4 class="modal-title" id="myModalLabel">System Message</h4>
        </div>
        <div class="modal-body">
          <h4>Doctors biometric is needed</h4>
          <input type="hidden" id="qualityInputBox" size="20" value="Good">
          <centeR>
            <div id="status"></div>
          </centeR>
          <select class="form-control" id="readersDropDown" style="display: none;" onchange="selectChangeEvent()">
          </select>
          <center>
            <div id="imagediv" style=""></div>

          </center>
          <small>Please wait until the device start blinking of greenlight before puting your finger to the device.</small>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-info" id="proceeds_save">Scan Now</button>
          <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>


  <script src="../../dist/js/moment.min.js"></script>
  <script src="../../plugins/datepicker/bootstrap-datetimepicker.js"></script>
  <script src="../../plugins/daterangepicker/daterangepicker.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/plug-ins/1.11.3/sorting/datetime-moment.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.8.4/moment.min.js"></script>

</body>
<?php

//$username_login=$row_user['username'];

?>
<script type="text/javascript">
  // Responsive, Sort toggle, and pagination go away when I add this line
  // But Datetime sorting works with this line though
  $.fn.dataTable.moment('F j, Y H:i:s');

  $('#date_created').daterangepicker({
    autoUpdateInput: false,
    locale: {
      cancelLabel: 'Clear'
    }
  });


  $('input[name="datefilter"]').on('apply.daterangepicker', function(ev, picker) {
    $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
  });

  $('input[name="datefilter"]').on('cancel.daterangepicker', function(ev, picker) {
    $(this).val('');
  });


  // $("#example1").DataTable();
  oTable = $("#example2").DataTable({
    "processing": true,
    "serverSide": true,
    "ajax": "../data/report_list2.php",
    // "order": [[8, 'desc']],//order column in descending order.
    //   "columnDefs": [
    //     {"orderable": false, "targets": 10 },
    //     {"orderable": false, "targets": 3 },
    //     { "type": "date", "targets": 9 }
    //   ]

  });

  //Wizard
  $(document).on("click", "#search_clinic", function() {
    var clinics = $("#clinics").val();
    var dcr = $("#date_created").val();

    var temp = clinics + "," + dcr;
    oTable.columns(1).search(temp).draw();

  });



  $('.btn_reports').on('click', function() { // for select box

    var clinics = $("#clinics").val();
    var dcr = $("#date_created").val();

    var temp = clinics + "," + dcr;
    //window.open("wb_report.php?date1="+encodeURI(date)+'&date2='+encodeURI(date2), '_blank');
    window.open("excel/report_excel.php?data=" + encodeURI(temp), '_blank');
  });


  $('#btn_pdf_server').on('click', function() { // for select box

    var clinics = $("#clinics").val();
    var dcr = $("#date_created").val();

    var temp = clinics + "," + dcr;
    //window.open("wb_report.php?date1="+encodeURI(date)+'&date2='+encodeURI(date2), '_blank');
    window.open("pdf/report_pdf.php?data=" + encodeURI(temp), '_blank');
  });


  $(document).on('click', '.edit_btn', function(e) {
    var id = $(this).attr("id");
    window.location.replace("../edit/edit_report.php?uid=" + id);

  });


  $(document).on('click', '.view_btn', function(e) {
    var id = $(this).attr("id");
    //  window.location.replace("../import/view_cert?uid="+id);
    window.open("../import/view_cert.php?uid=" + id, '_blank');
  });

  var id_extend_btn = "";
  $(document).on('click', '.extend_btn', function(e) {
    id_extend_btn = $(this).attr("id");

    //alert("<?php //echo $username_login; 
              ?>"+"<?php //echo $lto_accreditation_no; 
                    ?>====="+id_extend_btn);
    bios();

  });



  function bios() {
    var vDiv = document.getElementById('imagediv');
    vDiv.innerHTML = "";
    var image = document.createElement("img");
    image.id = "image";
    image.src = "../../dist/img/biometric.gif";
    vDiv.appendChild(image);
    //  onStart();
    $("#previewExamModal").modal("show");
  }


  $(document).on('click', "#proceeds_save", function(e) {
    console.log("Starting Scanning");
    var $this = $("#proceeds_save");

    $this.button('loading');
    console.log("Accessing Xampp");
    $.ajax({
      url: 'http://localhost/java_bio/index.php',
      type: 'POST',
      processData: false,
      contentType: false,

      cache: false,
      success: function(result) {
        //  console.log(result);
        var obj = jQuery.parseJSON(result);
        //  D
        // $this.button('reset');
        console.log("Starting Accessing Xampp");
        var vDiv = document.getElementById('imagediv');
        vDiv.innerHTML = "";
        var image = document.createElement("img");
        image.id = "image";
        image.src = "http://localhost/java_bio/read/" + obj.img;
        vDiv.appendChild(image);
        proceedData(obj.base64);
        //  alert(result);
        // alert("http://localhost/java_bio/read/"+result);

      },
      error: function(err) {
        console.log("error_problem_to_java");
        var $this = $("#proceeds_save");
        $this.button('reset');

        $.notify("Error : Xampp was not started please start xampp first to your pc ", "warning");
        //console.log(JSON.stringify(err));
      }

    });
  });


  function proceedData(data_bio) {

    var fd = new FormData();
    fd.append('bio', data_bio);
    fd.append('date_created', "<?php echo date('Y-m-d'); ?>");
    fd.append('username_login', "<?php echo $username_login; ?>");
    fd.append('lto_accreditation_no', "<?php echo $lto_accreditation_no; ?>");
    fd.append('uid', id_extend_btn);
    $.ajax({
      url: "call_extend.php",
      type: "POST",
      data: fd,
      processData: false,
      contentType: false,
      type: 'POST',
      cache: false,
      xhrFields: {
        withCredentials: true
      },
      crossDomain: true,
      success: function(response) {

        console.log(response);

        var check_status = $.trim(response);
        if (check_status !== "failed" || check_status != 'failed') {
          var $this = $(this);
          $this.html('Saving..');
          $("#proceeds_save").attr("disabled", "disabled");
          $.notify("Extending validity is success !! ", "success");

        } else if (check_status === "failed" || check_status === 'failed') {
          $.notify("Invalid biometric or connection to network problem please try again.. ", "warning");
          console.log("error finger print");
          var $this = $("#proceeds_save");
          $this.button('reset');
          oTable.draw();
          //  failedLogs(jsonData);
        } else {
          $.notify("Invalid biometric or connection to network problem please try again.. ", "warning");
          console.log("error finger print");
          var $this = $("#proceeds_save");
          $this.button('reset');
          // failedLogs(jsonData);
        }

      },
      error: function(err) {
        console.log("error");
        var $this = $("#proceeds_save");
        $this.button('reset');

        $.notify("Invalid biometric please try again ", "warning");
        //console.log(JSON.stringify(err));
      }
    });


  }
</script>

</html>