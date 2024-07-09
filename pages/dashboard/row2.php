
<?php 
date_default_timezone_set("Asia/Manila"); 
$dt = new DateTime("now", new DateTimeZone('Asia/Manila'));
$date=$dt->format("Y-m-d H:i:s");
$date_only=$dt->format("Y-m-d");
?>

        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title">Monthly Recap Report of Registed Enterprise</h5>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>


                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <div class="col-md-8">
                    <p class="text-center">
                      <strong>Monthly : 1 Jan, <?php echo DATE('Y');?> - 31 Dec, <?php echo DATE('Y');?></strong>
                    </p>

                    <div class="chart">
                      <!-- Sales Chart Canvas -->
                      <canvas id="myYearlyGraph" height="350" style="height: 350px;"></canvas>
                    </div>
                    <!-- /.chart-responsive -->
                  </div>
                  <!-- /.col -->










                  <div class="col-md-4">

             <div class="info-box mb-3">
              <span class="info-box-icon bg-aqua"><i class="fa fa-upload"></i></span>

              <div class="info-box-content">
                <?php 

                    $totalUploadThisweek="SELECT count(uid) as total FROM   medical_record WHERE  YEARWEEK(`date_created`, 1) = YEARWEEK('$date_only', 1)  ";
                    $stmtUploadThisweek= $auth_item->runQuery($totalUploadThisweek);
                    $stmtUploadThisweek->execute();
                    $rowUploadThisweek=$stmtUploadThisweek->fetch(PDO::FETCH_ASSOC);

                    $totalUploadThisweekString=trim($rowUploadThisweek['total']);

                    if($totalUploadThisweekString===""){
                      $totalUploadThisweekString=0;
                    }
                ?>

                   <span class="info-box-text">This Week </span>
                <span class="info-box-number"><?php echo   number_format($totalUploadThisweekString, 2, '.', ',') ; ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
            <div class="info-box mb-3 ">
              <span class="info-box-icon bg-red"><i class="fa fa-cloud-upload"></i></span>
                <?php 

                    $totalUploadLastweek="SELECT count(uid) as total FROM   medical_record   WHERE  (DATE(date_created) >= '$date_only' - INTERVAL DAYOFWEEK('$date_only')+6 DAY AND DATE(date_created) < '$date_only'- INTERVAL DAYOFWEEK('$date_only')-1 DAY)  ";
                    $stmtUploadLastweek= $auth_item->runQuery($totalUploadLastweek);
                    $stmtUploadLastweek->execute();
                    $rowUploadLastweek=$stmtUploadLastweek->fetch(PDO::FETCH_ASSOC);

                    $totalUploadLastweekString=trim($rowUploadLastweek['total']);

                    if($totalUploadLastweekString===""){
                      $totalUploadLastweekString=0;
                    }
                ?>

              <div class="info-box-content">
                <span class="info-box-text">Last Week</span>
                <span class="info-box-number"><?php echo   number_format($totalUploadLastweekString, 2, '.', ','); ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
                <?php 

                    $totalUploadlastmonth="SELECT count(uid) as total FROM   medical_record WHERE YEAR(date_created) = YEAR(CURRENT_DATE - INTERVAL 1 MONTH) AND MONTH(date_created) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH)";
                    $stmtUploadLastmonth= $auth_item->runQuery($totalUploadlastmonth);
                    $stmtUploadLastmonth->execute();
                    $rowUploadLastmonth=$stmtUploadLastmonth->fetch(PDO::FETCH_ASSOC);

                    $totalUploadLastmonthString=trim($rowUploadLastmonth['total']);

                    if($totalUploadLastmonthString===""){
                      $totalUploadLastmonthString=0;
                    }
                ?>



            <!-- /.info-box -->
            <div class="info-box mb-3 ">
              <span class="info-box-icon bg-info"><i class="fa fa-level-up"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Last Month </span>
                <span class="info-box-number"><?php echo  number_format($totalUploadLastmonthString, 2, '.', ',');  ?></span>
              </div>


              <!-- /.info-box-content -->
            </div>

             <div class="info-box mb-3 ">
              <span class="info-box-icon bg-danger"><i class="fa fa-arrow-circle-up"></i></span>
                            <div class="info-box-content">
                <span class="info-box-text">This Year </span>
                <span class="info-box-number"><?php echo  number_format($totalcoProString, 2, '.', ',');  ?></span>
              </div>
            </div>
          </div>
                    <!-- /.progress-group -->
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>





     
              <!-- ./card-body -->
                 <div class="card-footer" style="background-color: #B6882D; color: white;">
                <div class="row">
      

             <div class="col-sm-4 col-6">
                    <div class="description-block border-right">
              <?php 

                    $top1Clinic="SELECT tc.name,(SELECT count(uid) FROM medical_record where clinics=tc.id) as total_count FROM tbl_clinics as tc order by total_count desc limit 1";
                    $stmttop1Clinic= $auth_item->runQuery($top1Clinic);
                    $stmttop1Clinic->execute();
                    $rowtop1Clinic=$stmttop1Clinic->fetch(PDO::FETCH_ASSOC);

                    $totaltop1ClinicString=trim($rowtop1Clinic['total_count']);
                    $nameClinic1=trim($rowtop1Clinic['name']);
                    if($totaltop1ClinicString===""){
                      $totaltop1ClinicString=0;
                    }
                ?>
                      <h5 class="description-header"><?php echo $nameClinic1." : Upload (".number_format($totaltop1ClinicString,0, '.', ',').")";?></h5>
                      <span class="description-text">Top 1 Clinic</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
   

                  <!-- /.col -->
                  <div class="col-sm-4 col-6">
                    <div class="description-block border-right">
                <?php 

                    $top2Clinic="SELECT tc.name,(SELECT count(uid) FROM medical_record where clinics=tc.id) as total_count FROM tbl_clinics as tc order by total_count desc limit 1,1";
                    $stmttop2Clinic= $auth_item->runQuery($top2Clinic);
                    $stmttop2Clinic->execute();
                    $rowtop2Clinic=$stmttop2Clinic->fetch(PDO::FETCH_ASSOC);

                    $totaltop2ClinicString=trim($rowtop2Clinic['total_count']);
                    $nameClinic2=trim($rowtop2Clinic['name']);
                    if($totaltop2ClinicString===""){
                      $totaltop2ClinicString=0;
                    }
                ?>
                      <h5 class="description-header"><?php echo $nameClinic2." : Upload (".number_format($totaltop2ClinicString,0, '.', ',').")";?></h5>
                      <span class="description-text">Top 2 Clinic</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
  <!--                 <div class="col-sm-3 col-6">
                    <div class="description-block border-right">
                   <h5 class="description-header"><?php //echo  number_format($totalSusAveFCount,0, '.', ',');?></h5>
                      <span class="description-text">Wider conversations around Partnerships</span>
                    </div>
              
                  </div> -->
                  <!-- /.col -->
                 <div class="col-sm-4 col-6">
                    <div class="description-block ">
                          <?php 

                    $top3Clinic="SELECT tc.name,(SELECT count(uid) FROM medical_record where clinics=tc.id) as total_count FROM tbl_clinics as tc order by total_count desc limit 2,1";
                    $stmttop3Clinic= $auth_item->runQuery($top3Clinic);
                    $stmttop3Clinic->execute();
                    $rowtop3Clinic=$stmttop3Clinic->fetch(PDO::FETCH_ASSOC);

                    $totaltop3ClinicString=trim($rowtop3Clinic['total_count']);
                    $nameClinic3=trim($rowtop3Clinic['name']);
                    if($totaltop3ClinicString===""){
                      $totaltop3ClinicString=0;
                    }
                ?> 
                      <h5 class="description-header"><?php echo $nameClinic3." : Upload (".number_format($totaltop3ClinicString,0, '.', ',').")";?></h5>
                      <span class="description-text">Top 3 Clinic </span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                </div>



                <!-- /.row -->
              </div>
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->
    </div> 