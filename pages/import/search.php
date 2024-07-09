<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Systech QR</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- MATERIAL DESIGN ICONIC FONT -->
    <link rel="stylesheet" href="fonts/material-design-iconic-font/css/material-design-iconic-font.min.css">
    
    <!-- STYLE CSS -->
    <link rel="stylesheet" href="css/style.css">
  </head>

  <body>
<style type="text/css">
 #customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-bottom: 12px;
  text-align: left;
  background-color: #04AA6D;
  color: white;
}
.inner {
    flex-direction: column;
  	padding: 10px;
      margin-top: 90px !important;
}	
.conatiner-header {
    display: flex;
    justify-content: space-evenly;
  align-items: center;
}
</style>
    <div class="wrapper">
      <div class="inner">
     

          

          <?php 

    include("../../class.admin.php");
    $auth_item = new admin(); 
    //   date_default_timezone_set("Asia/Manila"); 
      // $uid = '1Q6T81696913465';

      $internal_reference_no=($_GET['internal_reference_no']);

     try{


    $stmt = $auth_item->runQuery("SELECT mr.*,tc.name as clinicname,CONCAT(mu.fname,' ',mu.lname) as doc_fullname,mu.prc_license_number,mu.ptr_number , (SELECT name FROM nationalities WHERE return_value=nationality LIMIT 1) as nationality_name
     from medical_record as  mr  LEFT JOIN  tbl_clinics as  tc  ON  tc.id=mr.branch_id
      LEFT JOIN  medical_users as mu ON mu.id=mr.doctor_attended WHERE mr.internal_reference_no='$internal_reference_no'");
    $stmt->execute();
    $user=$stmt->fetch(PDO::FETCH_ASSOC);
    }
      catch(PDOException $e)
      {
        echo $e->getMessage();
      }

  $internal_reference_no = $user['internal_reference_no'];
 $lastname = $user['last_name'];
  $first_name = $user['first_name'];
  $middle_name = $user['middle_name'];

  $uid=$user['uid'];

  $fullname=$first_name." ".$middle_name." ".$lastname;

      $today=$user['date_created'];
    $today=date('F j, Y H:i:s',strtotime($todadate_createdy));

      $clinicname = $user['clinicname'];
        $doc_fullname = $user['doc_fullname'];
        //https://systechph-medical.com/pages
          ?>
    <h3>LTMS MEDICAL VERIFCATION SYSTEM </h3>
     <div class="conatiner-header">
      <div class="left-header">
        <img  src="../../assets/logo/Land_Transportation_Office.svg.png" style="width: 123px;" alt="">
      </div>
      <div class="left-header">
        <img  src="../../assets/systech.png" style="width: 158px; " alt="">
      </div>
     </div>
        
    <div class="container-tbl">
      <Table width="100%" border="0" id="customers" style="align-content: center;"> 
        <tr>
          <tr><th  colspan="2">LTMS Medical Certicate Number</th></tr>
          <tr><Td  colspan="2">  <h4 style="color:red"> <?php echo   $internal_reference_no; ?></h4></Td></tr>
          <tr><td  colspan="2">LTMS Client Name</td></tr>
          <tr><Td  colspan="2" >  <h4 > <?php echo   $fullname; ?></h4></Td></tr>
          <tr><td  colspan="2">Certificate Number</td></tr>
          <tr><Td  colspan="2">  <h4 > <?php echo   $uid; ?></h4></Td></tr>
          <tr><td  colspan="2">Medical Examination Date</td></tr>
          <tr><Td  colspan="2">  <h4 > <?php echo   $today; ?></h4></Td></tr>
          <tr><td  colspan="2">Medical Clinic</td></tr>
          <tr><Td  colspan="2">  <h4 > <?php echo   $clinicname; ?></h4></Td></tr>
          <tr><td  colspan="2">Doctor's Name</td></tr>
          <tr><Td  colspan="2">  <h4 > <?php echo   $doc_fullname; ?></h4></Td></tr>
        </tr>
      </Table>
    </div>

      
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/main.js"></script>
  </body>
</html>