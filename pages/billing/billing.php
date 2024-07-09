
<?php

  include("../../class.admin.php");
  $auth_item = new admin(); 

  $clinic_id=$_GET['uid'];
  $date=$_GET['date'];
  $date_converted = explode("-", $date); 
    
  $startdate = date('Y-m-d', strtotime($date_converted['0'])) . " 00:00:00";
  $enddate = date('Y-m-d', strtotime($date_converted['1'])) . " 23:59:59";
  
try {
  $stmt_user= $auth_item->runQuery("SELECT 
        name,
        payment,
        (SELECT count(uid) FROM medical_record WHERE clinics = '$clinic_id' and DATE(date_created) BETWEEN '$startdate' AND '$enddate') as clinic_count, 
        payment * (SELECT count(uid) FROM medical_record WHERE clinics = '$clinic_id' and DATE(date_created) BETWEEN '$startdate' AND '$enddate') as sum
    FROM tbl_clinics 
    WHERE id= '$clinic_id'");
  $stmt_user->execute();
  $row_user=$stmt_user->fetch(PDO::FETCH_ASSOC);
  
} catch (Exception $e) {
    echo $e->getMessage();
}

  $stmt = $auth_item->runQuery("SELECT
        first_name,
        middle_name,
        last_name, 
        internal_reference_no,
        date_created
    FROM medical_record
    WHERE  clinics = '$clinic_id' and DATE(date_created) BETWEEN '$startdate' AND '$enddate' ORDER BY date_created DESC");

  $stmt->execute();
  $users = $stmt->fetchAll();
  




?>
<!DOCTYPE html>
<html>
  <head>

  <title>Generated Billings</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
 <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <!--   <style>
      table,
      th,
      td {
        padding: 10px;
        border: 1px solid black;
        border-collapse: collapse;
      }
    </style> -->

</head>
  <body><br> <br>
    <center>


      <div class="container">
        <div class="text-right"> 
            <button type="button" class="btn btn-primary btn_download">DOWNLOAD</button>   
        </div> 
        <br>
     
        <div class="card">
          <div class="card-header  bg-primary text-white">
            Infomartion
          </div>
          <div class="card-body">
              <table class="table table-bordered">
              <?php  //while($row = $result->fetch_assoc()) { ?>
                <tr>
                  <th width="200px"><strong>Clinic Name : </strong></th>
                  <th> <?php  echo $row_user['name'];?></th>
                </tr>
                <tr>
                  <th width="200px"><strong>Date Range : </strong></th>
                  <td> <?php echo date('F d Y', strtotime($startdate)) . " - " . date('F d Y', strtotime($enddate));?></td>
                </tr>
                <tr>
                  <th width="200px"><strong>Payment per Upload : </strong></th>
                  <th> <?php  echo $row_user['payment']; ?></th>
                </tr>

                <tr>
                  <th width="200px"><strong>Total Upload : </strong></th>
                  <th> <?php echo  $row_user['clinic_count'];?></th>
                </tr>

                <tr>
                  <th width="200px"><strong>Amount : </strong></th>
                        <th> <?php  echo $row_user['sum'];?></th>
                </tr>
              <?php //} ?>
            </table>
          </div>
        </div>

        <br>

        <div class="card">
          <div class="card-header bg-primary text-white">
            List
          </div>
          <div class="card-body">

            <table class="table  table-striped" id="example" class="display">
                <thead>
                    <tr>
                        <th style="text-align: center;"> Referrence No. </th>
                        <th style="text-align: center;"> Name </th>
                        <th style="text-align: center;"> Date </th>
                    </tr>
                </thead>
                <tbody>
                     <?php   foreach($users as $user) { ?>
                        <tr>
                            <td style="text-align: center; "><?php  echo $user['internal_reference_no'];?></td>
                            <td style="text-align: center; "><?php  echo $user['first_name'] . " " . $user['middle_name'] . " " . $user['last_name'];?></td>
                            <td style="text-align: center; "><?php  echo $user['date_created'];?></td>
                        </tr>
                      <?php } ?>
                </tbody>
            </table>
          </div>
        </div>
      </div>
    </center>

</body>
</html>
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script type="text/javascript">
  new DataTable('#example');

   $(document).on("click",".btn_download",function(){ 
      window.location.href ="download";
        // window.open("download?uid=" + <?php echo $clinic_id; ?> + "&startdate=" + <?php echo $startdate; ?>+ "&endate=" + <?php echo $enddate; ?>);   
      alert();

  });


</script>