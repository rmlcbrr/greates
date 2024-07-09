
<?php
include("../../class.admin.php");
  $auth_item = new admin(); 
  $id=base64_decode($_GET['search']);

    try{
  $stmt_settings = $auth_item->runQuery("SELECT tc.name,tc.lto_accreditation_no FROM lto2.tbl_billing as tb Inner join tbl_clinics as tc ON tc.id= tb.branch  WHERE tb.id='$id'");
  $stmt_settings->execute();
  $row_settings=$stmt_settings->fetch(PDO::FETCH_ASSOC);
  $clinic_name=$row_settings['name'];
    $lto_accreditation_no=$row_settings['lto_accreditation_no'];
  }
    catch(PDOException $e)
    {
      echo $e->getMessage();
    }
?>
<table style="width: 100%;"  border="0">

<tr> 

	<td><img src="../../dist/img/mybg.jpg" style="width:150px; " /></td>
	<td><h3>108 Residence - Bldg 108 Congressional Ave, </br> Project 8, Quezon City </h3></td>
</tr>


<tr> 

	<td colspan="2"><center><h1>Statement of Account</h1></center></td>
</tr>


<tr> 

	<td colspan=""><h5><?php echo $clinic_name; ?> </br> <?php echo $lto_accreditation_no; ?></h5></td>
</tr>


<tr> 

	<td colspan=""><h3>
		Previous Statement Balance  :   

	 </h3></td>
</tr>

<tr> 

	<td  colspan=""><h3>
		Previous Amount Due  :  </br>
		Date/Received Payment  : </br>
		Balance from Last Bill : </br>
		Current Due  : </br>
		Total Amout Due  :
		</h3></td>

	<td align="right" colspan=""><h3>

		0.00     </br> 
		0.00     </br> 
		0.00     </br> 		
		0.00     </br> 
		0.00     </br> 		
		</h3></td>
</tr>

<tr><Td><h2>    Current</h2></Td></tr>
<tr>
	<td colspan="2"><center>

		<table style="width: 100%;">

			<?php 

			$query_list="select count(*) as total_upload,date(date_created) as dc from medical_record
      			group by  date(date_created) order by date(date_created)  ";
      			 echo "<tr><th>Date</th><th>Upload</th><th>Rate</th><th>Total</th></tr> ";
  			  $stmt = $auth_item->runQuery($query_list);
			  $stmt->execute();
			  $total_upload_done=0;
			  $final_payment_done=0;
			  while($rows=$stmt->fetch(PDO::FETCH_ASSOC)){
			  $total=$rows['total_upload'];
			  $date_created=$rows['dc'];
			   $total_upload_done= $total_upload_done+$total;

			  $rate=30;
			  $final_total=0;
			  $final_total=$total*$rate;
			   $final_payment_done= $final_payment_done+$final_total;
			  echo "<tr><td>".$date_created."</td><td>".$total."</td><td>".$rate."</td><td>".$final_total."</td></tr> ";
				}

				  echo "<tr><td></td><td>
				  <h4>".$total_upload_done." </h4></td><td>
				  <h4>".$rate."</h4></td><td>
				  <h4>".$final_payment_done."</h4></td></tr> ";
			?>
		</table>
	</center>
	</td>

</tr>



</table></br>
<h5>
	Please remit check payment payable to Speed Powertech IT Solutions Inc by: </br>
> Depositing directly to our BDO 1192 Congressional Ave current account number  </br>
011928004133</br>
> Depositing directly to our Eastwest 2013 Congressional Ave current account number:</br>
200043739769
</br>
(Please email us the validated deposit slip within two days after the date deposited)

</h5>