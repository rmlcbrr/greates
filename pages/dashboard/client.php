<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Dashboard</title>
   <link rel="icon" type="image/x-icon" href="https://systechph-medical.com/assets/systech.png">
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <?php
  include("../includes/css.php");
  include("../../class.admin.php");
  $auth_item = new admin();

  $log_uid = $_SESSION['uid'];
  if ($log_uid == "") {
    $log_uid = $_SESSION['u_id'];
  }

  $date_curr = date("Y-m-d");
  ?>
  <!-- Google Font -->

</head>

<body class="hold-transition skin-blue sidebar-mini  ">


  <?php
  include("../includes/main-header.php");

  ?>

  <!-- Content Wrapper. Contains page content -->



  <!-- Info boxes -->

  <!-- /.row -->
  <?php
  include("row_client1.php");
  include("row3.php");
  ?>
  </br></br>




  <ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
      <button class="nav-link active" id="home-page1-tab" data-toggle="tab" data-target="#home-page1" type="button" role="tab" aria-controls="home-page1" aria-selected="true">Top 10 latest transaction</button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="home-pag2-tab" data-toggle="tab" data-target="#home-pag2" type="button" role="tab" aria-controls="home-pag2" aria-selected="false">Logs</button>
    </li>
  </ul>
  <div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active bg-white p-2" id="home-page1" role="tabpanel" aria-labelledby="home-page1-tab">
      <div class="box-header with-border">
        <table class="table no-margin">
          <thead>
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Doctor</th>
              <th>Clinic Name</th>
              <th>Status</th>

            </tr>
          </thead>
          <tbody>
            <?php

            if ((strtolower($_SESSION['u_account_type'])) === "admin") {
              $query_items = "SELECT uid,first_name,middle_name,last_name,is_submitted,(SELECT tc.name FROM tbl_clinics as tc WHERE id=branch_id) as clinicss,
(SELECT concat(mu.fname,' ',mu.lname)  as fullnames FROM medical_users as mu WHERE id=mr.creator) as doctorss FROM medical_record as mr  Where is_submitted='0'  order by DATE(date_created) desc limit 0,10";
            } else {

              $query_items = "SELECT uid,first_name,middle_name,last_name,is_submitted,(SELECT tc.name FROM tbl_clinics as tc WHERE id=branch_id) as clinicss,
(SELECT concat(mu.fname,' ',mu.lname) as fullnames FROM medical_users as mu WHERE id=mr.creator) as doctorss FROM medical_record as mr Where is_submitted='0'  and   branch_id='$clinic_ids' order by DATE(date_created) desc limit 0,10";
            }

            $stmt = $auth_item->runQuery($query_items);
            $stmt->execute();
            while ($Rows = $stmt->fetch(PDO::FETCH_ASSOC)) {

              if ($Rows['is_submitted'] == 0) {
                $stat = '<span class="label label-success">Transferred</span>';
              } else {
                $stat = '<span class="label label-warning">Pending</span>';
              }

            ?>
              <tr>
                <td><?php echo $Rows['uid']; ?></td>
                <td><?php echo $Rows['first_name'] . " " . $Rows['last_name']; ?></td>
                <td><?php echo $Rows['doctorss']; ?></td>
                <td><?php echo $Rows['clinicss']; ?></td>
                <td><span class="badge badge-success"><?= $stat; ?> </span></td>

              </tr>

              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
    <div class="tab-pane fade bg-white p-2" id="home-pag2" role="tabpanel" aria-labelledby="home-pag2-tab">
      <div class="box-body">
        <table class="table no-margin">
          <thead>
            <tr>

              <th>Activity</th>
              <th>Remarks</th>
              <th>Date</th>
            </tr>
          </thead>
          <tbody>
            <?php

            if ((strtolower($_SESSION['u_account_type'])) === "admin") {
              $query_items = "SELECT * FROM tpl_sys_log  order by DATE(`date`) desc limit 0,10";
            } else {

              $query_items = "SELECT * FROM tpl_sys_log Where uid='$log_uid' order by DATE(`date`) desc limit 0,10";
            }

            $stmt = $auth_item->runQuery($query_items);
            $stmt->execute();
            while ($Rows = $stmt->fetch(PDO::FETCH_ASSOC)) {

            ?>
              <tr>
                <td><?php echo $Rows['activity']; ?></td>
                <td><?php echo $Rows['remarks']; ?></td>
                <td><?php echo $Rows['date']; ?></td>

              </tr>

              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>


  </section>

  </div>
  <!-- /.col -->
  </div>
  <!-- /.row -->




  <?php
  include("../includes/footer.php");
  ?>

  <!-- ./wrapper -->
  <?php
  include("../includes/js.php");
  $present = DATE('Y');
  $clinic_ids = $_SESSION['clinic_id'];
  $entry = "SELECT
    count(IF(MONTH(date_created) = 1, uid, NULL)) AS 'January',
    count(IF(MONTH(date_created)= 2, uid, NULL)) AS 'Feburary',
    count(IF(MONTH(date_created) = 3, uid, NULL)) AS 'March',
    count(IF(MONTH(date_created)= 4,uid, NULL)) AS 'April',
    count(IF(MONTH(date_created) = 5,uid, NULL)) AS 'May',
    count(IF(MONTH(date_created)= 6,uid, NULL)) AS 'June',
    count(IF(MONTH(date_created) = 7,uid, NULL)) AS 'July',
    count(IF(MONTH(date_created) = 8, uid, NULL)) AS 'August',
    count(IF(MONTH(date_created)= 9,uid, NULL)) AS 'September',
    count(IF(MONTH(date_created)= 10,uid, NULL)) AS 'October',
    count(IF(MONTH(date_created) = 11,uid, NULL)) AS 'November',
    count(IF(MONTH(date_created)= 12,uid, NULL)) AS 'December'
FROM medical_record WHERE YEAR(date_created)='$present' and (is_submitted=NULL or is_submitted='0' or is_submitted='NULL')  and branch_id='$clinic_ids' ";


  $entry2 = "SELECT
    count(IF(MONTH(date_created) = 1, uid, NULL)) AS 'January',
    count(IF(MONTH(date_created)= 2, uid, NULL)) AS 'Feburary',
    count(IF(MONTH(date_created) = 3, uid, NULL)) AS 'March',
    count(IF(MONTH(date_created)= 4,uid, NULL)) AS 'April',
    count(IF(MONTH(date_created) = 5,uid, NULL)) AS 'May',
    count(IF(MONTH(date_created)= 6,uid, NULL)) AS 'June',
    count(IF(MONTH(date_created) = 7,uid, NULL)) AS 'July',
    count(IF(MONTH(date_created) = 8, uid, NULL)) AS 'August',
    count(IF(MONTH(date_created)= 9,uid, NULL)) AS 'September',
    count(IF(MONTH(date_created)= 10,uid, NULL)) AS 'October',
    count(IF(MONTH(date_created) = 11,uid, NULL)) AS 'November',
    count(IF(MONTH(date_created)= 12,uid, NULL)) AS 'December'
FROM medical_record WHERE YEAR(date_created)='$present' and is_submitted='1'  and branch_id='$clinic_ids' ";



  $last7days = "select count(*) as total_upload,date(date_created) as dc from medical_record
       where date_created > now() - interval 1 week and branch_id='$clinic_ids' group by  date(date_created) ; ";

  $stmt_6 = $auth_item->runQuery($last7days);
  $stmt_6->execute();
  $date_7days = "";
  $count_7days = "";
  while ($Rows_6 = $stmt_6->fetch(PDO::FETCH_ASSOC)) {
    $date_7days .= '"' . $Rows_6['dc'] . '"' . ",";


    $counting = $Rows_6['total_upload'];
    if ($counting <= 0) {
      $counting = 0;
    }
    $count_7days .= intval($counting) . ",";
  }


  $date_7days = substr_replace($date_7days, "", -1);
  $count_7days = substr_replace($count_7days, "", -1);


  ?>

  <script src="../../dist/js/moment.min.js"></script>
  <script src="../../plugins/datepicker/bootstrap-datetimepicker.js"></script>
  <script src="../../plugins/daterangepicker/daterangepicker.js"></script>
  <script type="text/javascript">
    // -----------------------
    // - MONTHLY SALES CHART -
    // -----------------------

    // Get context with jQuery - using jQuery's .get() method.
    var salesChartCanvas = $('#salesChart').get(0).getContext('2d');
    // This will get the first returned node in the jQuery collection.
    var salesChart = new Chart(salesChartCanvas);

    var salesChartData = {
      labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
      datasets: [{
        label: 'Successful Upload',
        fillColor: 'rgb(210, 214, 222)',
        strokeColor: 'rgb(210, 214, 222)',
        pointColor: 'rgb(210, 214, 222)',
        pointStrokeColor: '#c1c7d1',
        pointHighlightFill: '#fff',
        pointHighlightStroke: 'rgb(220,220,220)',
        data: [<?php $auth_item->data1($entry); ?>]
      }]
    };

    var salesChartOptions = {
      // Boolean - If we should show the scale at all
      showScale: true,
      // Boolean - Whether grid lines are shown across the chart
      scaleShowGridLines: false,
      // String - Colour of the grid lines
      scaleGridLineColor: 'rgba(0,0,0,.05)',
      // Number - Width of the grid lines
      scaleGridLineWidth: 1,
      // Boolean - Whether to show horizontal lines (except X axis)
      scaleShowHorizontalLines: true,
      // Boolean - Whether to show vertical lines (except Y axis)
      scaleShowVerticalLines: true,
      // Boolean - Whether the line is curved between points
      bezierCurve: true,
      // Number - Tension of the bezier curve between points
      bezierCurveTension: 0.3,
      // Boolean - Whether to show a dot for each point
      pointDot: false,
      // Number - Radius of each point dot in pixels
      pointDotRadius: 4,
      // Number - Pixel width of point dot stroke
      pointDotStrokeWidth: 1,
      // Number - amount extra to add to the radius to cater for hit detection outside the drawn point
      pointHitDetectionRadius: 20,
      // Boolean - Whether to show a stroke for datasets
      datasetStroke: true,
      // Number - Pixel width of dataset stroke
      datasetStrokeWidth: 2,
      // Boolean - Whether to fill the dataset with a color
      datasetFill: true,
      // String - A legend template
      legendTemplate: '<ul class=\'<%=name.toLowerCase()%>-legend\'><% for (var i=0; i<datasets.length; i++){%><li><span style=\'background-color:<%=datasets[i].lineColor%>\'></span><%=datasets[i].label%></li><%}%></ul>',
      // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
      maintainAspectRatio: true,
      // Boolean - whether to make the chart responsive to window resizing
      responsive: true
    };

    // Create the line chart
    salesChart.Line(salesChartData, salesChartOptions);






    //Create the line chart
    var last7days = {
      labels: [<?php echo $date_7days; ?>],
      datasets: [{
        label: "Items Created",
        fillColor: "rgba(210, 214, 222, 1)",
        strokeColor: "rgba(210, 214, 222, 1)",
        pointColor: "rgba(210, 214, 222, 1)",
        pointStrokeColor: "#c1c7d1",
        pointHighlightFill: "#fff",
        pointHighlightStroke: "rgba(220,220,220,1)",
        data: [<?php echo $count_7days; ?>]
      }]
    };
    //-------------
    //- BAR CHART -
    //-------------
    var barChartCanvas2 = $("#salesChart7days").get(0).getContext("2d");
    var barChart2 = new Chart(barChartCanvas2);
    var barChartData2 = last7days;
    barChartData2.datasets[0].fillColor = "#00a65a";
    barChartData2.datasets[0].strokeColor = "#00a65a";
    barChartData2.datasets[0].pointColor = "#00a65a";
    var barChartOptions2 = {
      //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
      scaleBeginAtZero: true,
      //Boolean - Whether grid lines are shown across the chart
      scaleShowGridLines: true,
      //String - Colour of the grid lines
      scaleGridLineColor: "rgba(0,0,0,.05)",
      //Number - Width of the grid lines
      scaleGridLineWidth: 1,
      //Boolean - Whether to show horizontal lines (except X axis)
      scaleShowHorizontalLines: true,
      //Boolean - Whether to show vertical lines (except Y axis)
      scaleShowVerticalLines: true,
      //Boolean - If there is a stroke on each bar
      barShowStroke: true,
      //Number - Pixel width of the bar stroke
      barStrokeWidth: 2,
      //Number - Spacing between each of the X value sets
      barValueSpacing: 5,
      //Number - Spacing between data sets within X values
      barDatasetSpacing: 1,
      //String - A legend template
      legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].fillColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
      //Boolean - whether to make the chart responsive
      responsive: true,
      maintainAspectRatio: true
    };

    barChartOptions2.datasetFill = false;
    barChart2.Bar(barChartData2, barChartOptions2);
  </script>

</body>

</html>