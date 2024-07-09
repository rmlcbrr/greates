
<?php

  $clinic_id = '196';
  $startdate = '2023-10-10 00:00:00';
  $enddate = '2023-10-11 23:59:59';

  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "lto2";

  $conn = new mysqli($servername, $username, $password, $dbname);
  // Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
  
  $sql = "SELECT 
        name,
        payment,
        (SELECT count(uid) FROM lto2.medical_record WHERE clinics = '$clinic_id' and date_created BETWEEN '$startdate' AND '$enddate') as clinic_count, 
        payment * (SELECT count(uid) FROM lto2.medical_record WHERE clinics = '$clinic_id' and date_created BETWEEN '$startdate' AND '$enddate') as sum
    FROM lto2.tbl_clinics 
    WHERE id= '$clinic_id' ";

    $result = $conn->query($sql);

    $retrieveData = "SELECT
    first_name,
    middle_name,
      last_name, 
      internal_reference_no,
    date_created
   FROM lto2.medical_record
   WHERE  clinics = '$clinic_id' and date_created BETWEEN '$startdate' AND '$enddate' ";

    $resultRetrieved = $conn->query($retrieveData);

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
            <button type="button" class="btn btn-primary">DOWNLOAD</button>   
        </div> 
        <br>
     
        <div class="card">
          <div class="card-header  bg-primary text-white">
            Infomartion
          </div>
          <div class="card-body">
              <table class="table table-bordered">
              <?php  while($row = $result->fetch_assoc()) { ?>
                <tr>
                  <th width="200px"><strong>Clinic Name : </strong></th>
                  <th> <?php  echo $row['name'];?></th>
                </tr>
                <tr>
                  <th width="200px"><strong>Date Range : </strong></th>
                  <td> <?php echo date('F d Y', strtotime($startdate)) . " - " . date('F d Y', strtotime($enddate));?></td>
                </tr>
                <tr>
                  <th width="200px"><strong>Payment per Upload : </strong></th>
                  <th> <?php  echo $row['payment'];?></th>
                </tr>

                <tr>
                  <th width="200px"><strong>Total Upload : </strong></th>
                  <th> <?php echo  $row['clinic_count'];?></th>
                </tr>

                <tr>
                  <th width="200px"><strong>Amount : </strong></th>
                        <th> <?php  echo $row['sum'];?></th>
                </tr>
              <?php } ?>
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
                     <?php  while($data = $resultRetrieved->fetch_assoc()) { ?>
                        <tr>
                            <td style="text-align: center; "><?php  echo $data['internal_reference_no'];?></td>
                            <td style="text-align: center; "><?php  echo $data['first_name'] . " " . $data['middle_name'] . " " . $data['last_name'];?></td>
                            <td style="text-align: center; "><?php  echo $data['date_created'];?></td>
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
</script>