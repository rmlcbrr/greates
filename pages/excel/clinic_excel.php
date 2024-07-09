<?php
error_reporting(0);
ini_set('display_errors', 0);
ini_set('log_errors', 1);
error_reporting(E_ALL & ~E_NOTICE);

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
//include_once("../connection/class.client.php");
include_once("phpexcel/xlsxwriter.class.php");
$filename = "report-".date('Y-m-d').".xlsx";
ob_end_clean();

header('Content-disposition: attachment; filename="'.XLSXWriter::sanitize_filename($filename).'"');
header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
header('Content-Transfer-Encoding: binary');
header('Cache-Control: must-revalidate');
header('Pragma: public');


$writer = new XLSXWriter();
/*
$writer->writeSheetHeader('Sheet1',    
  array('Transaction No'=>'string',
  'Item'=>'string',
  'Size'=>'string',
    'Addons'=>'string',
    'Date Purchased'=>'string',
    'Total'=>'string'));
*/
$start=date("Y-m-d",strtotime(urldecode($_GET['start'])))." 00:00:00";
$end=date("Y-m-d",strtotime(urldecode($_GET['end'])))." 23:59:59";


$styles1 = array( 'font'=>'Arial','font-size'=>11,'font-style'=>'bold', 'fill'=>'#eee', 'halign'=>'center', 'border'=>'left,right,top,bottom','wrap_text'=>true, );

//$start = strtotime($start);
//$end = strtotime($end);

$bid=$_SESSION['m_branch'];

         
       $large_cups=0;
            $small_cups=0;
            $total_sales=0;
$con=mysqli_connect("localhost","root","","ordering");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
$rt="Sales";
   $sql = "SELECT *  FROM `order` WHERE branch_id='$bid' and  (DATE(`date`) BETWEEN '$start' and '$end')   and status='Claimed' ";

$q=mysqli_query($con,$sql);
while($row=mysqli_fetch_assoc($q)){

                  $size=$row['size'];

                    if(ucfirst($size)=="Large" || strtoupper($size)=="L"){
                        $large_cups++;
                      }else{
                        $small_cups++;  
                      }
                    $total_sales+=$row['total'];
}
  $writer->writeSheetRow('Sheet1',  array("Date Range",$start." ".$end));
  $writer->writeSheetRow('Sheet1',  array("Report Type",$rt),$styles1);
  $writer->writeSheetRow('Sheet1',  array("Large Cups",$large_cups),$styles1);
  $writer->writeSheetRow('Sheet1',  array("Regular Cups",$small_cups),$styles1);
  $writer->writeSheetRow('Sheet1',  array("Total Sales",$total_sales),$styles1);
/*  $writer->writeSheetHeader('Sheet1',    
  array('Transaction No'=>'string',
  'Item'=>'string',
  'Size'=>'string',
    'Addons'=>'string',
    'Date Purchased'=>'string',
    'Total'=>'string'));*/
  $writer->writeSheetRow('Sheet1', array('Transaction No',
  'Item',
  'Size',
  'Addons',
  'Date Purchased',
  'Total'),$styles1
  );
   $sql = "SELECT *  FROM `order` WHERE branch_id='$bid' and (DATE(`date`) BETWEEN '$start' and '$end')  and status='Claimed' ORDER BY (`date`) DESC";
$q=mysqli_query($con,$sql);


while($row=mysqli_fetch_assoc($q)){
      $size=$row['size'];
      

                    if($size=="Large" || $size=="L"){
                        $large_cups+=$row['qty'];
                      }else{
                        $small_cups+=$row['qty'];
                      }
                    $total_sales+=$row['total'];


  $writer->writeSheetRow('Sheet1',  array(
    $row['transaction_no'], 
    $row['order'],
    $row['size'],
    $row['addons'],
    $row['date'],
    $row['total']
    )
   );

  
}
//******************************************************************88SHEET************************//



       $sql = "SELECT *  FROM food_category";
       $q=mysqli_query($con,$sql);

            $a=0;
            $data=array();
                $rowss=array();
          while($row=mysqli_fetch_assoc($q)){ 
 $a++;
          $newstr = str_replace("with", "w/", strtolower($row['fc_desc']));
      
            if(($a % 2) == 1){
             $rowss = array($newstr, 'Item','Regular','Large');  
             //array_push($data, $rowss);
            }else{
            
             $rowss = array($newstr, 'Item','Regular','Large'); 
          
             // array_push($data, $rowss);
            }
            $fcid="";
            $fcid=$row['fc_id'];

             $writer->writeSheetRow('Sheet2',$rowss,$styles1);  
            $sql2 = "SELECT *  FROM food_menu WHERE fc_id='$fcid' ";
           $q2=mysqli_query($con,$sql2);

          while($row2=mysqli_fetch_assoc($q2)){ 

             $fm_id=$row2['fm_id'];

 $sql3 = "SELECT count(*) as totals ,size FROM `order` WHERE category='$fcid' and fm_id='$fm_id'  and status='Claimed'  and (DATE(`date`) BETWEEN '$start' and '$end') Group by `size`";
             $q3=mysqli_query($con,$sql3);
             $row3=mysqli_fetch_assoc($q3);

                     $large=0;
              $regular=0;
              if(strtoupper($row3['size'])==="L" || ucfirst($row3['size'])==="Large"){
                $large=$row3['totals'];
              }else if(strtoupper($row3['size'])==="R" || ucfirst($row3['size'])==="Regular"){
                $regular=$row3['totals'];
              }
              $rowss=array('', $row2['f_name'],$regular,$large); 
             $writer->writeSheetRow('Sheet2',$rowss);  
                          }
             }

    //  $writer->writeSheet($data,'Sheet2');


//******************************************************************88SHEET************************//



       $sql = "SELECT  DATE(`date`) araws, SUM(total) totalCOunt
FROM    `order`
WHERE (DATE(`date`) BETWEEN '$start' and '$end') and status='Claimed'
GROUP   BY  DATE(`date`)
ORDER BY DATE(`date`) desc; ";
       $q=mysqli_query($con,$sql);
         $rowx = array('Date','Sales');  
 $writer->writeSheetRow('Sheet3',$rowx,$styles1);  
 
          while($row=mysqli_fetch_assoc($q)){ 
                            $rowss=array($row['araws'],$row['totalCOunt']); 
             $writer->writeSheetRow('Sheet3',$rowss);  
                          }
             










$writer->writeToStdOut();
//$writer->writeToFile('example.xlsx');
//echo $writer->writeToString();

exit(0);
?>