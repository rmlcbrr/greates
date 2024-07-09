<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>dashboard</title>
   <link rel="icon" type="image/x-icon" href="https://systechph-medical.com/assets/systech.png">
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <?php
  include("../includes/css.php");
  include("../../class.admin.php");
  $auth_item = new admin();

  ?>
</head>

<body class="hold-transition skin-blue sidebar-mini  ">


  <?php
  include("../includes/main-header.php");
  ?>

  <!-- Content Wrapper. Contains page content -->

  <!-- Content Header (Page header) -->



  <!-- Info boxes -->
  <?php
  include("row1.php");
  include("row2.php");
  ?>
  </br>
  <div class="row">

    <div class="col-md-6">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Browser Usage</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
              <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove">
              <i class="fas fa-times"></i>
            </button>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <div class="row">
            <div class="col-md-8">
              <div class="chart-responsive">
                <canvas id="pieChart" height="150"></canvas>
              </div>
              <!-- ./chart-responsive -->
            </div>
            <!-- /.col -->
            <div class="col-md-4">
              <ul class="chart-legend clearfix">
                <li><i class="far fa-circle text-danger"></i> Chrome</li>
                <li><i class="far fa-circle text-success"></i> IE</li>
                <li><i class="far fa-circle text-warning"></i> FireFox</li>
                <li><i class="far fa-circle text-info"></i> Safari</li>
                <li><i class="far fa-circle text-primary"></i> Opera</li>
                <li><i class="far fa-circle text-secondary"></i> Navigator</li>
              </ul>
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.card-body -->
        <div class="card-footer p-0">
          <ul class="nav nav-pills flex-column">
            <li class="nav-item">
              <a href="#" class="nav-link">
                United States of America
                <span class="float-right text-danger">
                  <i class="fas fa-arrow-down text-sm"></i>
                  12%</span>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                India
                <span class="float-right text-success">
                  <i class="fas fa-arrow-up text-sm"></i> 4%
                </span>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                China
                <span class="float-right text-warning">
                  <i class="fas fa-arrow-left text-sm"></i> 0%
                </span>
              </a>
            </li>
          </ul>
        </div>
        <!-- /.footer -->
      </div>
    </div>


    <div class="col-md-6">
      <div class="card card-success">
        <div class="card-header">
          <h3 class="card-title">Stacked Bar Chart</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
              <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove">
              <i class="fas fa-times"></i>
            </button>
          </div>
        </div>
        <div class="card-body">
          <div class="chart">
            <canvas id="stackedBarChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
          </div>
        </div>
        <!-- /.card-body -->
      </div>
    </div>
  </div>
  <!-- /.card -->
  </br>


  <ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
      <button class="nav-link active" id="home-page1-tab" data-toggle="tab" data-target="#home-page1" type="button" role="tab" aria-controls="home-page1" aria-selected="true">Top 10 latest transaction</button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="home-page2-tab" data-toggle="tab" data-target="#home-page2" type="button" role="tab" aria-controls="home-page2" aria-selected="false">Logs</button>
    </li>
  </ul>
  <div class="tab-content" id="myTabContent">
    <div class="tab-pane fade bg-white p-2 show active" id="home-page1" role="tabpanel" aria-labelledby="home-page1-tab">
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
    <div class="tab-pane fade bg-white p-2" id="home-page2" role="tabpanel" aria-labelledby="home-page2-tab">
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
  <!-- /.row -->
  </section>
  <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  </div>
  </main>

  <?php
  include("../includes/footer.php");
  ?>

  <!-- ./wrapper -->
  <?php
  include("../includes/js.php");
  $present = DATE('Y');




  // $data1="SELECT
  //     count(IF(MONTH(date_created) = 1, id, NULL)) AS 'January',
  //     count(IF(MONTH(date_created)= 2, id, NULL)) AS 'Feburary',
  //     count(IF(MONTH(date_created) = 3, id, NULL)) AS 'March',
  //     count(IF(MONTH(date_created)= 4,id, NULL)) AS 'April',
  //     count(IF(MONTH(date_created) = 5,id, NULL)) AS 'May',
  //     count(IF(MONTH(date_created)= 6,id, NULL)) AS 'June',
  //     count(IF(MONTH(date_created) = 7,id, NULL)) AS 'July',
  //     count(IF(MONTH(date_created) = 8, id, NULL)) AS 'August',
  //     count(IF(MONTH(date_created)= 9,id, NULL)) AS 'September',
  //     count(IF(MONTH(date_created)= 10,id, NULL)) AS 'October',
  //     count(IF(MONTH(date_created) = 11,id, NULL)) AS 'November',
  //     count(IF(MONTH(date_created)= 12,id, NULL)) AS 'December'
  // FROM tbl_investor WHERE YEAR(date_created)='$present' ";


  $data1 = "SELECT
    cal.dt,
  monthname(DATE(cal.dt)) as monthNameData,
    COUNT(t.date_created) AS count
FROM
(
    SELECT DATE_FORMAT(CURDATE(), '%Y-%m-01') AS dt UNION ALL
    SELECT DATE_FORMAT(DATE_SUB(CURDATE(), INTERVAL 1 MONTH), '%Y-%m-01') UNION ALL
    SELECT DATE_FORMAT(DATE_SUB(CURDATE(), INTERVAL 2 MONTH), '%Y-%m-01') UNION ALL
    SELECT DATE_FORMAT(DATE_SUB(CURDATE(), INTERVAL 3 MONTH), '%Y-%m-01') UNION ALL
    SELECT DATE_FORMAT(DATE_SUB(CURDATE(), INTERVAL 4 MONTH), '%Y-%m-01') UNION ALL
    SELECT DATE_FORMAT(DATE_SUB(CURDATE(), INTERVAL 5 MONTH), '%Y-%m-01') UNION ALL
    SELECT DATE_FORMAT(DATE_SUB(CURDATE(), INTERVAL 6 MONTH), '%Y-%m-01') UNION ALL
    SELECT DATE_FORMAT(DATE_SUB(CURDATE(), INTERVAL 7 MONTH), '%Y-%m-01') UNION ALL
    SELECT DATE_FORMAT(DATE_SUB(CURDATE(), INTERVAL 8 MONTH), '%Y-%m-01') UNION ALL
    SELECT DATE_FORMAT(DATE_SUB(CURDATE(), INTERVAL 9 MONTH), '%Y-%m-01') UNION ALL
    SELECT DATE_FORMAT(DATE_SUB(CURDATE(), INTERVAL 10 MONTH), '%Y-%m-01') UNION ALL
    SELECT DATE_FORMAT(DATE_SUB(CURDATE(), INTERVAL 11 MONTH), '%Y-%m-01')
) cal
LEFT JOIN medical_record t
    ON cal.dt = DATE_FORMAT(date_created, '%Y-%m-01')

WHERE
    t.date_created >= DATE_SUB(CURDATE(), INTERVAL 12 MONTH)   

GROUP BY
    cal.dt
ORDER BY
    cal.dt asc;";
  $stmt12 = $auth_item->runQuery($data1);
  $stmt12->execute();

  $stringDate12 = "";
  $numberDate12 = "";
  while ($Rows12 = $stmt12->fetch(PDO::FETCH_ASSOC)) {
    $stringDate12 .= '"' . $Rows12['monthNameData'] . '",';
    $numberDate12 .= intval($Rows12['count']) . ",";
  }

  ////


  $data1 = "SELECT";
  $stmt12 = $auth_item->runQuery($data1);
  $stmt12->execute();

  $stringDate12 = "";
  $numberDate12 = "";
  while ($Rows12 = $stmt12->fetch(PDO::FETCH_ASSOC)) {
    $stringDate12 .= '"' . $Rows12['monthNameData'] . '",';
    $numberDate12 .= intval($Rows12['count']) . ",";
  }
  ?>

  <!-- ChartJS -->
  <script src="../../plugins/chart.js/Chart.min.js"></script>
  <script src="../../dist/js/moment.min.js"></script>
  <script src="../../plugins/datepicker/bootstrap-datetimepicker.js"></script>
  <script src="../../plugins/daterangepicker/daterangepicker.js"></script>

  <script src="../../plugins/flot/jquery.flot.min.js"></script>
  <!-- FLOT RESIZE PLUGIN - allows the chart to redraw when the window is resized -->
  <script src="../../plugins/flot/jquery.flot.resize.min.js"></script>
  <script type="text/javascript">
    oTable = $("#example_2").DataTable({
      "processing": true,
      "serverSide": true,
      "scrollY": "300px",
      aaSorting: [
        [1, 'desc']
      ],
      "ajax": "../data/dashboard_table.php",

    });
    console.log("...");
    // -----------------------
    // - MONTHLY SALES CHART -
    // -----------------------


    // Sales chart
    var salesChartCanvas = document.getElementById('myYearlyGraph').getContext('2d')
    // $('#revenue-chart').get(0).getContext('2d');


    var salesChartData = {
      labels: [<?php echo $stringDate12; ?>],
      datasets: [{
        label: 'APPROVED',
        backgroundColor: 'rgba(60,141,188,0.9)',
        borderColor: 'rgba(60,141,188,0.8)',
        pointRadius: false,
        pointColor: '#3b8bba',
        pointStrokeColor: 'rgba(60,141,188,1)',
        pointHighlightFill: '#fff',
        pointHighlightStroke: 'rgba(60,141,188,1)',
        data: [<?php echo  $numberDate12; ?>]
      }]
    }

    var salesChartOptions = {
      maintainAspectRatio: false,
      responsive: true,
      legend: {
        display: false
      },
      scales: {
        xAxes: [{
          gridLines: {
            display: false
          }
        }],
        yAxes: [{
          gridLines: {
            display: false
          }
        }]
      }
    }

    // This will get the first returned node in the jQuery collection.
    // eslint-disable-next-line no-unused-vars
    var salesChart = new Chart(salesChartCanvas, { // lgtm[js/unused-local-variable]
      type: 'line',
      data: salesChartData,
      options: salesChartOptions
    })



    //-------------
    // - PIE CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
    var pieData = {
      labels: [
        'Chrome',
        'IE',
        'FireFox',
        'Safari',
        'Opera',
        'Navigator'
      ],
      datasets: [{
        data: [700, 500, 400, 600, 300, 100],
        backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de']
      }]
    }
    var pieOptions = {
      legend: {
        display: false
      }
    }
    // Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    // eslint-disable-next-line no-unused-vars
    var pieChart = new Chart(pieChartCanvas, {
      type: 'doughnut',
      data: pieData,
      options: pieOptions
    })

    //-----------------
    // - END PIE CHART -
    //-----------------
    //-------------
    //- BAR CHART -
    //-------------
    var barChartCanvas = $('#barChart').get(0).getContext('2d')
    var barChartData = $.extend(true, {}, areaChartData)
    var temp0 = areaChartData.datasets[0]
    var temp1 = areaChartData.datasets[1]
    barChartData.datasets[0] = temp1
    barChartData.datasets[1] = temp0

    var barChartOptions = {
      responsive: true,
      maintainAspectRatio: false,
      datasetFill: false
    }

    new Chart(barChartCanvas, {
      type: 'bar',
      data: barChartData,
      options: barChartOptions
    })
    //---------------------
    //- STACKED BAR CHART -
    //---------------------
    var stackedBarChartCanvas = $('#stackedBarChart').get(0).getContext('2d')
    var stackedBarChartData = $.extend(true, {}, barChartData)

    var stackedBarChartOptions = {
      responsive: true,
      maintainAspectRatio: false,
      scales: {
        xAxes: [{
          stacked: true,
        }],
        yAxes: [{
          stacked: true
        }]
      }
    }

    new Chart(stackedBarChartCanvas, {
      type: 'bar',
      data: stackedBarChartData,
      options: stackedBarChartOptions
    })
  </script>
</body>

</html>