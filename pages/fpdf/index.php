<?php

//to printable area
$test = 8;
$border=0;
	require("fpdf.php");
	$pdf = new FPDF("P","mm",array(220,290));
	$pdf->AddPage();
	$pdf->SetFont('Arial','',10);
	//$pdf->SetTextColor(255,255,0);
	//$pdf->SetMargins(9, 5,7);
	$pdf->SetAutoPageBreak(false);
	
	//waybill 
	$pdf->SetFont('Arial','',16);
	$pdf->SetXY(190,0);
	$pdf->Cell(22.6,4.5,'3732478'.$test);
	
	
	$pdf->SetFont('Arial','',10);
	
	//FROM
	//Cell() does not respect line breaks, need special case to handle TO and FROM fields
	
	$pdf->SetXY(12,34);
	$pdf->Cell(98,14,'SMART Warehouse '.$test,$border,0,'C');
	
	//TO		
	$pdf->SetXY(115,34);
	$pdf->Cell(92.3,14,'Destination'.$test,$border,0,'C');
	
	
	//prepared by
	$pdf->SetFont('Arial','',8);
	$pdf->SetXY(12,54);
	$pdf->Cell(61,3.6,'prepared by'.$test,$border,0,'C');
	
	//prepared date and time
	$pdf->SetFont('Arial','',8);
	$pdf->SetXY(86,54);
	$pdf->Cell(28,4,'date and time prepared'.$test,$border,0,'C');
	
	//received by (courier)
	$pdf->SetFont('Arial','',8);
	$pdf->SetXY(117,54);	
	$pdf->Cell(56,4,'received by courier'.$test,$border,0,'C');
	
	//date and time received
	$pdf->SetFont('Arial','',8);
	$pdf->SetXY(188,54);	
	$pdf->Cell(28,4,' 2012-09-01 23:00:00'.$test,$border,0,'C');
	
	
	//repeat this stuff 18 times
	$pdf->SetFont('Arial','',10);
	$pdf->SetXY(4,84);
	$pdf->Cell(24.4,5,'quantity'.$test,$border,0,'C');

	$pdf->SetXY(34,84);
	$pdf->Cell(78.2,5,'description'.$test,$border,0,'C');	
	
	$pdf->SetXY(122,84);
	$pdf->Cell(51.4,5,'dimension'.$test,$border,0,'C');
	
	$pdf->SetXY(178,84);
	$pdf->Cell(19.6,5,'volume'.$test,$border,0,'C');
	
	$pdf->SetXY(203,84);
	$pdf->Cell(25.3,5,'actual'.$test,$border,0,'C');
	
	
		
	//total 1 
	$pdf->SetXY(179,198);
	$pdf->Cell(19.7,9.1,'Total 1'.$test,$border,0,'C');
	
	//total 2
	$pdf->SetXY(199,198);
	$pdf->Cell(25.1,9.1,'Total 2'.$test,$border,0,'C');
	
	
	
	//remarks
	$pdf->SetXY(8,205);
	$pdf->Cell(74.2,30.1,'REMARKS'.$test,$border,0,'C');
	
	
	
	//mode of shipment - air
	$pdf->SetXY(193,220);
	$pdf->Cell(7.7,5,'AIR'.$test,$border,0,'C');
	
	//mode of shipment - sea
	$pdf->SetXY(193,231);
	$pdf->Cell(7.7,5,'SEA'.$test,$border,0,'C');
	
	
	//mode of shipment - land
	$pdf->SetXY(193,242);
	$pdf->Cell(7.7,5,'LAND'.$test,$border,0,'C');
	
	
	//received by consignee
	$pdf->SetXY(12,260);
	$pdf->Cell(60.9,7.3,'consignee name'.$test,$border,0,'C');
	
	//date received by consignee
	$pdf->SetXY(84,260);
	$pdf->Cell(27.6,7.5,'date and time'.$test,$border,0,'C');
	
	//delivered by
	$pdf->SetXY(138.2,258);
	$pdf->Cell(67.5,4,'delivered by'.$test,$border,0,'C');
	
	//date and time delivered
	$pdf->SetXY(133,268);
	$pdf->Cell(72.4,4,'date and time'.$test,$border,0,'C');
	
	
	//waybill bottom
	$pdf->SetFont('Arial','',16);
	$pdf->SetXY(45,275);
	$pdf->Cell(24,4.5,'3732478'.$test,$border,0,'C');
	
	
	
	
	
	$pdf->Output();
	
	/*
	//no page scaling
	$test = 8;
$border=0;
	require("fpdf.php");
	$pdf = new FPDF("P","mm",array(217,280));
	$pdf->AddPage();
	$pdf->SetFont('Arial','',10);
	$pdf->SetTextColor(204,153,0);
	$pdf->SetMargins(9, 5,7);
	$pdf->SetAutoPageBreak(false);
	
	//waybill 
	$pdf->SetFont('Arial','',16);
	$pdf->SetXY(186,9);
	$pdf->Cell(22.6,4.5,'3732478'.$test);
	
	
	$pdf->SetFont('Arial','',10);
	
	//FROM
	//Cell() does not respect line breaks, need special case to handle TO and FROM fields
	
	$pdf->SetXY(12,40);
	$pdf->Cell(98,14,'SMART Warehouse '.$test,$border,0,'C');
	
	//TO		
	$pdf->SetXY(115,40);
	$pdf->Cell(92.3,14,'Destination'.$test,$border,0,'C');
	
	
	//prepared by
	$pdf->SetFont('Arial','',8);
	$pdf->SetXY(12,58);
	$pdf->Cell(61,3.6,'prepared by'.$test,$border,0,'C');
	
	//prepared date and time
	$pdf->SetFont('Arial','',8);
	$pdf->SetXY(86,58);
	$pdf->Cell(28,4,'date and time prepared'.$test,$border,0,'C');
	
	//received by (courier)
	$pdf->SetFont('Arial','',8);
	$pdf->SetXY(117,58);	
	$pdf->Cell(56,4,'received by courier'.$test,$border,0,'C');
	
	//date and time received
	$pdf->SetFont('Arial','',8);
	$pdf->SetXY(188,58);	
	$pdf->Cell(28,4,' 2012-09-01 23:00:00'.$test,$border,0,'C');
	
	
	//repeat this stuff 18 times
	$pdf->SetFont('Arial','',10);
	$pdf->SetXY(8.3,84);
	$pdf->Cell(24.4,5,'quantity'.$test,$border,0,'C');

	$pdf->SetXY(36,84);
	$pdf->Cell(78.2,5,'description'.$test,$border,0,'C');	
	
	$pdf->SetXY(120,84);
	$pdf->Cell(51.4,5,'dimension'.$test,$border,0,'C');
	
	$pdf->SetXY(174,84);
	$pdf->Cell(19.6,5,'volume'.$test,$border,0,'C');
	
	$pdf->SetXY(194,84);
	$pdf->Cell(25.3,5,'actual'.$test,$border,0,'C');
	
	
		
	//total 1 
	$pdf->SetXY(174,197);
	$pdf->Cell(19.7,9.1,'Total 1'.$test,$border,0,'C');
	
	//total 2
	$pdf->SetXY(194,197);
	$pdf->Cell(25.1,9.1,'Total 2'.$test,$border,0,'C');
	
	
	
	//remarks
	$pdf->SetXY(12.5,205);
	$pdf->Cell(74.2,30.1,'REMARKS'.$test,$border,0,'C');
	
	
	
	//mode of shipment - air
	$pdf->SetXY(186,216.5);
	$pdf->Cell(7.7,5,'AIR'.$test,$border,0,'C');
	
	//mode of shipment - sea
	$pdf->SetXY(186,227.5);
	$pdf->Cell(7.7,5,'SEA'.$test,$border,0,'C');
	
	
	//mode of shipment - land
	$pdf->SetXY(186,237.2);
	$pdf->Cell(7.7,5,'LAND'.$test,$border,0,'C');
	
	
	//received by consignee
	$pdf->SetXY(12.8,255);
	$pdf->Cell(60.9,7.3,'consignee name'.$test,$border,0,'C');
	
	//date received by consignee
	$pdf->SetXY(84,255);
	$pdf->Cell(27.6,7.5,'date and time'.$test,$border,0,'C');
	
	//delivered by
	$pdf->SetXY(138.2,252);
	$pdf->Cell(67.5,4,'delivered by'.$test,$border,0,'C');
	
	//date and time delivered
	$pdf->SetXY(133,260);
	$pdf->Cell(72.4,4,'date and time'.$test,$border,0,'C');
	
	
	//waybill bottom
	$pdf->SetFont('Arial','',16);
	$pdf->SetXY(45,272);
	$pdf->Cell(24,4.5,'3732478'.$test,$border,0,'C');
	
	
	
	
	
	$pdf->Output();
	
	
	
	*/
?>