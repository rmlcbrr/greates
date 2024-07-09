
<?php

date_default_timezone_set("Asia/Manila"); 
$dt = new DateTime("now", new DateTimeZone('Asia/Manila'));
$date=$dt->format("Y-m-d H:i:s");
$date_only=$dt->format("Y-m-d");
 ?>


      <!-- Info boxes -->
              <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner" style="color:black !important;">
                <?php 

                    $totalUpload="SELECT count(uid) as total FROM `medical_record` ";
                    $stmtUpload= $auth_item->runQuery($totalUpload);
                    $stmtUpload->execute();
                    $rowUpload=$stmtUpload->fetch(PDO::FETCH_ASSOC);

                    $totalUploadString=trim($rowUpload['total']);

                    if($totalUploadString===""){
                      $totalUploadString=0;
                    }
                ?>
                <h3><?php echo $totalUploadString;?></h3>

                <p>OVERALL UPLOADED</p>
              </div>
              <div class="icon">
                <i class="ion ion-upload"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner" style="color:black !important;">
                <?php 

                    $totalUploadToday="SELECT count(uid) as total FROM `medical_record`  WHERE  DATE(date_created) ='$date_only' ";

                    $stmtUploadToday= $auth_item->runQuery($totalUploadToday);
                    $stmtUploadToday->execute();
                    $rowUploadToday=$stmtUploadToday->fetch(PDO::FETCH_ASSOC);

                    $totalUploadTodayString=trim($rowUploadToday['total']);

                    if($totalUploadTodayString===""){
                      $totalUploadTodayString=0;
                    }
                ?>
                <h3><?php echo  $totalUploadTodayString;?><sup style="font-size: 20px"></sup></h3>

                <p>TODAY UPLOADED</p>
              </div>
              <div class="icon">
                <i class="ion ion-upload"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner" style="color:black !important;">
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
                <h3><?php echo $totalUploadThisweekString;?></h3>

                <p>This Week </p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner" style="color:black !important;">
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

                <h3><?php echo $totalUploadLastmonthString; ?></h3>

                <p>Last Month</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>

