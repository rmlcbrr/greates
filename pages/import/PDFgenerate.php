<?php
// 	 date_default_timezone_set("Asia/Manila"); 
// 	$uid = '1Q6T81696913465';

  // // $uid=base64_decode($_GET['uid']);
// 	$host='localhost';
// 	$username='root';
// 	$password='';
// 	$dbname = "lto2";
// 	$conn=mysqli_connect($host,$username,$password,"$dbname");

error_reporting(0);
 date_default_timezone_set("Asia/Manila"); 
  $uid=base64_decode($_GET['uid']);
	// $result = mysqli_query($conn,"SELECT mr.*,tc.name as clinicname,CONCAT(mu.fname,' ',mu.lname) as doc_fullname,mu.prc_license_number,mu.ptr_number , (SELECT name FROM nationalities WHERE return_value=nationality LIMIT 1) as nationality_name
   	// 	from medical_record as  mr  INNER JOIN  tbl_clinics as  tc  ON  tc.id=mr.branch_id
    // LEFT JOIN  medical_users as mu ON mu.id=mr.doctor_attended WHERE mr.uid='$uid'");
	// $user = mysqli_fetch_array($result);

	  try{


  $stmt = $auth_item->runQuery("SELECT mr.*,tc.name as clinicname,CONCAT(mu.fname,' ',mu.lname) as doc_fullname,mu.prc_license_number,mu.ptr_number , (SELECT name FROM nationalities WHERE return_value=nationality LIMIT 1) as nationality_name
   from medical_record as  mr  INNER JOIN  tbl_clinics as  tc  ON  tc.id=mr.branch_id
    LEFT JOIN  medical_users as mu ON mu.id=mr.doctor_attended WHERE mr.uid='$uid'");
  $stmt->execute();
  $user=$stmt->fetch(PDO::FETCH_ASSOC);
  }
    catch(PDOException $e)
    {
      echo $e->getMessage();
    }

	$lastname = $user['last_name'];
	$first_name = $user['first_name'];
	$middle_name = $user['middle_name'];
	$bdate = date("F d Y", strtotime($user['bdate']));
	$address = $user['address'];
	$gender = $user['gender'];
	$marital_status = $user['marital_status'];
	$internal_reference_no = $user['internal_reference_no'];
	$driver_license = $user['driver_license'];
	$nationality_name = $user['nationality_name'];

	$qr_code = 'qrcode.jpg';

	if($user['imgs'] == "") {
		$imgs = "default.jpg";
	} else {
		$imgs = $user['imgs'];
	}

	$doc_fullname = $user['doc_fullname'];
	$prc_license_number = $user['prc_license_number'];
	$ptr_number = $user['ptr_number'];
	$clinicname = $user['clinicname'];
	$uid = $user['uid'];

    $today=$user['date_created'];
    $todayv=date('F j, Y H:i:s',strtotime($today));

   	$today=$user['date_created'];
    $today=date('F j, Y H:i:s',strtotime($todadate_createdy));

     //*************************GENERAL
   if($user['general_physique']=="0"){
        $general_physique_normal=true;
        $general_physique_with=false;
    }else{
        $general_physique_normal=false;
        $general_physique_with=true;
    }

    //*************************CONTAGIOUS
    if($user['contagious_desiease']=="0"){
        $contagious_desiease_normal=true;
        $contagious_desiease_with=false;
    }else{
        $contagious_desiease_normal=false;
        $contagious_desiease_with=true;
    }

 	$r_color="Brown";
    $l_color="Brown";
    if($user['eye_color_left']=="1"){ $l_color="Black";}else
    if($user['eye_color_left']=="2"){ $l_color="Brown";}else
    if($user['eye_color_left']=="3"){ $l_color="Gray";}else
    if($user['eye_color_left']=="4"){ $l_color="Other";}else
    if($user['eye_color_left']=="5"){ $l_color="Blue";}


    if($user['eye_color_right']=="1"){ $r_color="Black";}else
    if($user['eye_color_right']=="2"){ $r_color="Brown";}else
    if($user['eye_color_right']=="3"){ $r_color="Gray";}else
    if($user['eye_color_right']=="4"){ $r_color="Other";}else
    if($user['eye_color_right']=="5"){ $r_color="Blue";}

	$dob= $user['bdate']; //date of Birth
	$dateOfBirth = $dob;
	$today = date("Y-m-d");
	$diff = date_diff(date_create($dateOfBirth), date_create($today));
	$age = $diff->format('%y');

	$current_date= date($today,strtotime("+60 days"));
    $current_date=strtotime($current_date);
    $from_date=date('F j, Y',strtotime("+60 days",strtotime($today)));
            
	require_once('tcpdf/tcpdf.php');  
	$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  
	$pdf->SetCreator(PDF_CREATOR);  
	$pdf->SetTitle("Generated PDF");  
	$pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);  

	// set default header data
	$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 035', PDF_HEADER_STRING);
	$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));  
	$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));  
	$pdf->SetMargins(10, 10, 10, 10);
	// set margins
	$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
	$pdf->SetHeaderMargin(PDF_MARGIN_HEADER, '', PDF_MARGIN_FOOTER);
	$pdf->SetFooterMargin();

	$pdf->SetLineStyle( array( 'width' => 100, 'color' => array(0,0,0)));

	// $fontpath4='tcpdf/times.ttf';
	// $fontname4 = $pdf->addTTFfont($fontpath4, 'TrueTypeUnicode', '', 96);

	$pdf->SetDefaultMonospacedFont('helvetica');  
	$pdf->SetMargins(PDF_MARGIN_LEFT, '10', PDF_MARGIN_RIGHT);  
	$pdf->setPrintHeader(false);  
	$pdf->setPrintFooter(false);  
	$pdf->SetAutoPageBreak(TRUE, 10);  
	$pdf->SetFont('helvetica', '', 19); 

	$pdf->SetLineStyle(array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));

	$pdf->AddPage('P', 'A4');

	$pdf->SetLineStyle( array( 'width' => 0.1, 'color' => array(0,0,0)));
	$pdf->Line(5,47,205,47); //top
	$pdf->Line(5,42,205,42); //top
	$pdf->Line(5,42,5,71);//left
	$pdf->Line(205,42,205,71); //right
	$pdf->Line(5,71,205,71); //down
	//1st Box

	$pdf->Line(5,75,205,75); //top
	$pdf->Line(5,80,205,80); //buttom
	$pdf->Line(5,75,5,80);//left
	$pdf->Line(205,75,205,80); //right

	$pdf->Line(5,81,205,81); //top
	$pdf->Line(5,122,205,122); //buttom
	$pdf->Line(5,81,5,122);//left
	$pdf->Line(205,81,205,122); //right
	//2nd box
	
	$pdf->Line(5,124,125,124); //top
	$pdf->Line(5,230,125,230); //buttom
	$pdf->Line(5,124,5,230);//left
	$pdf->Line(125,230,125,124); //right

	$pdf->Line(6,126,124,126); //top
	$pdf->Line(6,130,124,130); //buttom	
	$pdf->Line(6,126,6,130); //left
	$pdf->Line(124,126,124,130); //right

	$pdf->Line(6,177,124,177); //top
	$pdf->Line(6,181,124,181); //buttom	
	$pdf->Line(6,177,6,181); //left
	$pdf->Line(124,177,124,181); //left
	//3rd box

	$pdf->Line(127,230,127,124); //left
	$pdf->Line(205,124,205,230); //right
	$pdf->Line(127,124,205,124); //top
	$pdf->Line(127,230,205,230); //buttom

	$pdf->Line(128,126,204,126); //top
	$pdf->Line(128,130,204,130); //buttom
	$pdf->Line(128,126,128,130); //left
	$pdf->Line(204,126,204,130); //top

	$pdf->Line(128,151,204,151); //top
	$pdf->Line(128,155,204,155); //buttom
	$pdf->Line(128,151,128,155); //left
	$pdf->Line(204,151,204,155); //right

	$pdf->Line(128,180,204,180); //top	
	$pdf->Line(128,184,204,184); //buttom	
	$pdf->Line(128,180,128,184); //left	
	$pdf->Line(204,180,204,184); //right			
	// forth box


	//texbox lines
	$pdf->Line(50,235,115,235); //physicial line
	$pdf->Line(50,239,115,239); //PRC License num
	$pdf->Line(50,243,115,243); //prt num
	$pdf->Line(50,247,115,247);	//issued at
	
	$pdf->Line(50,258,115,258);	//Certnum
	$pdf->Line(50,251,115,251);	//SIgnature

	$pdf->Line(177,246.5,204,246.5);	//date issued at
	$pdf->Line(177,252,204,252);	//valid unti	
	// $pdf->SetLineStyle( array( 'width' => 0.1, 'color' => array(0,0,0)));
	// $pdf->Line(195,55,15,55); //down
	// $pdf->Line(195,15,15,15); //top
	// $pdf->Line(195,15,195,55); //right

	$pdf->SetFont('times', 'B', 17.5); 
	$x = $pdf->pixelsToUnits('77');
	$y = $pdf->pixelsToUnits('23');
    $txt = "MEDICAL CERTIFICATE FOR DRIVER'S LICENSE";
	$pdf->Text  ( $x, $y, $txt, false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );

	$x = $pdf->pixelsToUnits('190');
	$y = $pdf->pixelsToUnits('64');
    $txt = "LTMS REFERENCE NO:";
	$pdf->Text  ( $x, $y, $txt, false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );

	$x = $pdf->pixelsToUnits('198');
	$y = $pdf->pixelsToUnits('84');
    $pdf->SetTextColor(255,0,0);
	$pdf->Text  ( $x, $y, $internal_reference_no, false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );


    $pdf->SetTextColor(0,0,0);
	$pdf->SetFont('times', 'B', 9); 
	$x = $pdf->pixelsToUnits('224');
	$y = $pdf->pixelsToUnits('119');
    $txt = "APPLICANT'S INFORMATION";
	$pdf->Text  ( $x, $y, $txt, false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );

	$pdf->SetFont('times', 'B', 9); 
	$x = $pdf->pixelsToUnits('229');
	$y = $pdf->pixelsToUnits('213');
    $txt = "PHYSICAL INFORMATION";
	$pdf->Text  ( $x, $y, $txt, false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );

	$pdf->SetFont('times', 'B', 9); 
	$xtest = $pdf->pixelsToUnits('150');
	$ytest = $pdf->pixelsToUnits('358');
    $txttest = "VISUAL TEST";
	$pdf->Text  ( $xtest, $ytest, $txttest, false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );

	$pdf->SetFont('times', 'B', 9); 
	$xtest = $pdf->pixelsToUnits('75');
	$ytest = $pdf->pixelsToUnits('502');
    $txttest = "METABOLICAND NEUROLOGICAL DISORDER";
	$pdf->Text  ( $xtest, $ytest, $txttest, false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );

	$pdf->SetFont('times', 'B', 9); 
	$xtest = $pdf->pixelsToUnits('430');
	$ytest = $pdf->pixelsToUnits('358');
    $txttest = "AUDITORY TEST";
	$pdf->Text  ( $xtest, $ytest, $txttest, false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );

	$pdf->SetFont('times', 'B', 9); 
	$xtest = $pdf->pixelsToUnits('440');
	$ytest = $pdf->pixelsToUnits('427');
    $txttest = "ASSESSMENT";
	$pdf->Text  ( $xtest, $ytest, $txttest, false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );

	$pdf->SetFont('times', 'B', 9); 
	$xtest = $pdf->pixelsToUnits('440');
	$ytest = $pdf->pixelsToUnits('510');
    $txttest = "CONDITIONS";
	$pdf->Text  ( $xtest, $ytest, $txttest, false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );

	$pdf->SetFont('times', '', 7); 
	$xtest = $pdf->pixelsToUnits('11');
	$ytest = $pdf->pixelsToUnits('660');
    $txttest = "PHYSICIAN";
	$pdf->Text  ( $xtest, $ytest, $txttest, false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );

	$pdf->SetFont('times', '', 7); 
	$xtest = $pdf->pixelsToUnits('11');
	$ytest = $pdf->pixelsToUnits('670');
    $txttest = "PRC LICENSEN NUMBER";
	$pdf->Text  ( $xtest, $ytest, $txttest, false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );

	$pdf->SetFont('times', '', 7); 
	$xtest = $pdf->pixelsToUnits('11');
	$ytest = $pdf->pixelsToUnits('680');
    $txttest = "PTR NUMBER";
	$pdf->Text  ( $xtest, $ytest, $txttest, false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );

	$pdf->SetFont('times', '', 7); 
	$xtest = $pdf->pixelsToUnits('11');
	$ytest = $pdf->pixelsToUnits('690');
    $txttest = "ISSUED AT";
	$pdf->Text  ( $xtest, $ytest, $txttest, false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );

	$pdf->SetFont('times', '', 7); 
	$xtest = $pdf->pixelsToUnits('11');
	$ytest = $pdf->pixelsToUnits('700');
    $txttest = "CERTIFICATE NUMBER #";
	$pdf->Text  ( $xtest, $ytest, $txttest, false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );

	$pdf->SetFont('times', '', 7); 
	$xtest = $pdf->pixelsToUnits('11');
	$ytest = $pdf->pixelsToUnits('724');
    $txttest = "SIGNATURE";
	$pdf->Text  ( $xtest, $ytest, $txttest, false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );

	$pdf->SetFont('times', '', 7); 
	$xtest = $pdf->pixelsToUnits('356');
	$ytest = $pdf->pixelsToUnits('710');
    $txttest = "VALID UNTIL";
	$pdf->Text  ( $xtest, $ytest, $txttest, false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );
	$ytest = $pdf->pixelsToUnits('717');
    $txttest = "(60 DAYS FROM DATE ISSUE)";
	$pdf->Text  ( $xtest, $ytest, $txttest, false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );

	$pdf->SetFont('times', '', 7); 
	$xtest = $pdf->pixelsToUnits('356');
	$ytest = $pdf->pixelsToUnits('690');
    $txttest = "DATE ISSUED";
	$pdf->Text  ( $xtest, $ytest, $txttest, false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );
	$pdf->SetFont('times', '', 7); 
	$xtest = $pdf->pixelsToUnits('356');
	$ytest = $pdf->pixelsToUnits('702');
    $txttest = "THIS MEDICAL CERTIFICATE IS";
	$pdf->Text  ( $xtest, $ytest, $txttest, false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );

	$pdf->SetFont('times', '', 7); 
	$xtest = $pdf->pixelsToUnits('356');
	$ytest = $pdf->pixelsToUnits('660');
    $txttest = "REMARKS";
	$pdf->Text  ( $xtest, $ytest, $txttest, false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );

	$pdf->SetXY(5, 15);
	$pdf->Image('../../dist/img/department.png', '', '', 20, 20, '', '', 'T', false, 100, '', false, false, 0, false, false, false);

	$pdf->SetXY(180, 15);
	$pdf->Image('../../dist/img/lto.png', '', '', 30, 20, '', '', 'T', false, 100, '', false, false, 0, false, false, false);


	$pdf->SetXY(178, 50);
	$pdf->Image('../../control/upload/'.$imgs, '', '', 30, 20, '', '', 'T', false, 100, '', false, false, 0, false, false, false);


	//qrcode
	$pdf->SetXY(183, 207);
	$pdf->Image($qr_code , '', '', 20, 20, '', '', 'T', false, 100, '', false, false, 0, false, false, false);


	//fistbox lines
	$pdf->Line(33,53,71,53);	//lastname
	$pdf->Line(73,53,127,53);	//firstname
	$pdf->Line(130,53,178,53);	//middlename

	$pdf->SetFont('times', 'B', 9); 
	$xtest = $pdf->pixelsToUnits('20');
	$ytest = $pdf->pixelsToUnits('142');
    $txttest = "NAME:";
	$pdf->Text  ( $xtest, $ytest, $txttest, false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );

	$pdf->SetFont('times', '', 7); 
	$xtest = $pdf->pixelsToUnits('120');
	$ytest = $pdf->pixelsToUnits('150');
    $txttest = "SURNAME";
	$pdf->Text  ( $xtest, $ytest, $txttest, false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );

	$pdf->SetFont('times', '', 7); 
	$xtest = $pdf->pixelsToUnits('255');
	$ytest = $pdf->pixelsToUnits('150');
    $txttest = "FIRST NAME";
	$pdf->Text  ( $xtest, $ytest, $txttest, false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );

	$pdf->SetFont('times', '', 7); 
	$xtest = $pdf->pixelsToUnits('410');
	$ytest = $pdf->pixelsToUnits('150');
    $txttest = "MIDDLE NAME";
	$pdf->Text  ( $xtest, $ytest, $txttest, false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );

	$pdf->Line(25,61,178,61);	//address

	$pdf->SetFont('times', 'B', 9); 
	$xtest = $pdf->pixelsToUnits('20');
	$ytest = $pdf->pixelsToUnits('163');
    $txttest = "ADDRESS:";
	$pdf->Text  ( $xtest, $ytest, $txttest, false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );

	$pdf->Line(55,65.5,75,65.5);	//DRIVERS LICENSE ADDRESS
	$pdf->SetFont('times', 'B', 9); 
	$xtest = $pdf->pixelsToUnits('20');
	$ytest = $pdf->pixelsToUnits('177');
    $txttest = "DRIVERS LICENSE ADDRESS:";
	$pdf->Text  ( $xtest, $ytest, $txttest, false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );

	$pdf->Line(105,65.5,178,65.5);	//DATE OF BIRTH
	$pdf->SetFont('times', 'B', 9); 
	$xtest = $pdf->pixelsToUnits('220');
	$ytest = $pdf->pixelsToUnits('177');
    $txttest = "DATE OF BIRTH:";
	$pdf->Text  ( $xtest, $ytest, $txttest, false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );

	$pdf->Line(33,70,78,70);	//NATIONALITY
	$pdf->SetFont('times', 'B', 9); 
	$xtest = $pdf->pixelsToUnits('20');
	$ytest = $pdf->pixelsToUnits('190');
    $txttest = "NATIONALITY	:";
	$pdf->Text  ( $xtest, $ytest, $txttest, false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );

	$pdf->Line(100,70,87,70);	//AGE
	$pdf->SetFont('times', 'B', 9); 
	$xtest = $pdf->pixelsToUnits('220');
	$ytest = $pdf->pixelsToUnits('190');
    $txttest = "AGE:";
	$pdf->Text  ( $xtest, $ytest, $txttest, false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );

	$pdf->Line(115,70,130,70);	//GENDER
	$pdf->SetFont('times', 'B', 9); 
	$xtest = $pdf->pixelsToUnits('282');
	$ytest = $pdf->pixelsToUnits('190');
    $txttest = "GENDER:";
	$pdf->Text  ( $xtest, $ytest, $txttest, false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );

	$pdf->Line(161,70,178,70);	//marital status
	$pdf->SetFont('times', 'B', 9); 
	$xtest = $pdf->pixelsToUnits('369');
	$ytest = $pdf->pixelsToUnits('190');
    $txttest = "MARITAL STATUS:";
	$pdf->Text  ( $xtest, $ytest, $txttest, false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );

	$pdf->SetFont('times', 'B', 9); 
	$xtest = $pdf->pixelsToUnits('20');
	$ytest = $pdf->pixelsToUnits('229');
    $txttest = "GENERAL PHYSIQUE:";
	$pdf->Text  ( $xtest, $ytest, $txttest, false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );

	//Upper Extremities
	$xtest = $pdf->pixelsToUnits('20');
	$ytest = $pdf->pixelsToUnits('280');
	$pdf->Text  ( $xtest, $ytest,'UPPER EXTREMITIES', false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );

	//Upper Extremities (LEFT)
	$xtest = $pdf->pixelsToUnits('20');
	$ytest = $pdf->pixelsToUnits('290');
	$pdf->Text  ( $xtest, $ytest,'LEFT', false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );

	//Upper Extremities (RIGHT)
	$xtest = $pdf->pixelsToUnits('150');
	$ytest = $pdf->pixelsToUnits('290');
	$pdf->Text  ( $xtest, $ytest,'RIGHT', false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );


	//Upper Extremities
	$xtest = $pdf->pixelsToUnits('285');
	$ytest = $pdf->pixelsToUnits('280');
	$pdf->Text  ( $xtest, $ytest,'LOWER EXTREMITIES', false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );

	//LOWER Extremities (LEFT)
	$xtest = $pdf->pixelsToUnits('285');
	$ytest = $pdf->pixelsToUnits('290');
	$pdf->Text  ( $xtest, $ytest,'LEFT', false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );

		//LOWER Extremities (RIGHT)
	$xtest = $pdf->pixelsToUnits('430');
	$ytest = $pdf->pixelsToUnits('290');
	$pdf->Text  ( $xtest, $ytest,'RIGHT', false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );

	$pdf->SetFont('times', 'B', 7); 
	$xtest = $pdf->pixelsToUnits('20');
	$ytest = $pdf->pixelsToUnits('270');
    $txttest = "HEIGHT";
	$pdf->Text  ( $xtest, $ytest, $txttest, false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );

	$xtest = $pdf->pixelsToUnits('77');
	$ytest = $pdf->pixelsToUnits('270');
    $txttest = "(CMS)";
	$pdf->Text  ( $xtest, $ytest, $txttest, false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );

	$xtest = $pdf->pixelsToUnits('99');
	$ytest = $pdf->pixelsToUnits('270');
    $txttest = "WEIGHT";
	$pdf->Text  ( $xtest, $ytest, $txttest, false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );

	$pdf->Line(18,98,27,98); //height
	$pdf->Line(55,98,47,98); //weight

	$xtest = $pdf->pixelsToUnits('155');
	$ytest = $pdf->pixelsToUnits('270');
    $txttest = "(KGS)";
	$pdf->Text  ( $xtest, $ytest, $txttest, false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );

	$pdf->SetFont('times', 'B', 7); 
	$xtest = $pdf->pixelsToUnits('20');
	$ytest = $pdf->pixelsToUnits('370');
    $txttest = "Visual Acuity";
	$pdf->Text  ( $xtest, $ytest, $txttest, false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );

	$pdf->SetFont('times', 'B', 7); 
	$xtest = $pdf->pixelsToUnits('100');
	$ytest = $pdf->pixelsToUnits('370');
    $txttest = "Right Eye Color : ";
	$pdf->Text  ( $xtest, $ytest, $txttest, false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );

	$pdf->SetFont('times', 'B', 7); 
	$xtest = $pdf->pixelsToUnits('220');
	$ytest = $pdf->pixelsToUnits('370');
    $txttest = "Left Eye Color : ";
	$pdf->Text  ( $xtest, $ytest, $txttest, false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );

	$pdf->SetFont('times', 'B', 7); 
	$xtest = $pdf->pixelsToUnits('395');
	$ytest = $pdf->pixelsToUnits('370');
    $txttest = "LEFT EAR";
	$pdf->Text  ( $xtest, $ytest, $txttest, false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );

	$pdf->SetFont('times', 'B', 7); 
	$xtest = $pdf->pixelsToUnits('500');
	$ytest = $pdf->pixelsToUnits('370');
    $txttest = "RIGHT EAR";
	$pdf->Text  ( $xtest, $ytest, $txttest, false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );


	$pdf->SetFont('times', 'B', 7); 
	$xtest = $pdf->pixelsToUnits('155');
	$ytest = $pdf->pixelsToUnits('370');
	$pdf->Text  ( $xtest, $ytest,$r_color , false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );

	$xtest = $pdf->pixelsToUnits('270');
	$ytest = $pdf->pixelsToUnits('370');
	$pdf->Text  ( $xtest, $ytest, $l_color, false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );

	$pdf->SetFont('times', 'B', 9); 
	$xtest = $pdf->pixelsToUnits('285');
	$ytest = $pdf->pixelsToUnits('229');
    $txttest = "CONTAGIOUS DISEASE:";
	$pdf->Text  ( $xtest, $ytest, $txttest, false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );


	$xtest = $pdf->pixelsToUnits('450');
	$ytest = $pdf->pixelsToUnits('229');
    $txttest = "BLOOD PRESSURE:";
	$pdf->Text  ( $xtest, $ytest, $txttest, false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );

	$pdf->Line(161,98,200,98); //blood pressure
	$xtest = $pdf->pixelsToUnits('480');
	$ytest = $pdf->pixelsToUnits('255');
    $txttest = "BLOOD TYPE";
	$pdf->Text  ( $xtest, $ytest, $txttest, false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );



	//GENERAL PHYSIQUE check box
	$pdf->SetFont('times', '', 7); 
	$xtest = $pdf->pixelsToUnits('35');
	$ytest = $pdf->pixelsToUnits('244');
	$pdf->Text  ( $xtest, $ytest, 'Normal', false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );

	$pdf->SetFont('times', '', 7); 
	$xtest = $pdf->pixelsToUnits('35');
	$ytest = $pdf->pixelsToUnits('258');
	$pdf->Text  ( $xtest, $ytest, 'With Disability, pls specify' . $user['general_physique_reason'], false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );

	//Contagious Disease check box
	$pdf->SetFont('times', '', 7); 
	$xtest = $pdf->pixelsToUnits('300');
	$ytest = $pdf->pixelsToUnits('244');
	$pdf->Text  ( $xtest, $ytest, 'Normal', false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );

	$pdf->SetFont('times', '', 7); 
	$xtest = $pdf->pixelsToUnits('300');
	$ytest = $pdf->pixelsToUnits('258');
	$pdf->Text  ( $xtest, $ytest, 'With Disability, pls specify' . $user['general_physique_reason'], false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );



	//Upper extremities (left) check box
	$pdf->SetFont('times', '', 7); 
	$xtest = $pdf->pixelsToUnits('35');
	$ytest = $pdf->pixelsToUnits('305');
	$pdf->Text  ( $xtest, $ytest, 'Normal', false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );

	$pdf->SetFont('times', '', 7); 
	$xtest = $pdf->pixelsToUnits('35');
	$ytest = $pdf->pixelsToUnits('315');
	$pdf->Text  ( $xtest, $ytest, 'With Disability', false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );

	$pdf->SetFont('times', '', 7); 
	$xtest = $pdf->pixelsToUnits('35');
	$ytest = $pdf->pixelsToUnits('325');
	$pdf->Text  ( $xtest, $ytest, 'With Special Equipment', false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );


	//left ear
	$pdf->SetFont('times', '', 7); 
	$xtest = $pdf->pixelsToUnits('395');
	$ytest = $pdf->pixelsToUnits('381.5');
    $txttest = "Normal";
	$pdf->Text  ( $xtest, $ytest, $txttest, false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );

	$xtest = $pdf->pixelsToUnits('395');
	$ytest = $pdf->pixelsToUnits('393');
    $txttest = "Reduce";
	$pdf->Text  ( $xtest, $ytest, $txttest, false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );

	$xtest = $pdf->pixelsToUnits('395');
	$ytest = $pdf->pixelsToUnits('405');
    $txttest = "With Hearing aid";
	$pdf->Text  ( $xtest, $ytest, $txttest, false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );

	// Assessment
	$xtest = $pdf->pixelsToUnits('395');
	$ytest = $pdf->pixelsToUnits('443');
    $txttest = "Fit to drive";
	$pdf->Text  ( $xtest, $ytest, $txttest, false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );

	$xtest = $pdf->pixelsToUnits('395');
	$ytest = $pdf->pixelsToUnits('453');
    $txttest = "Unfit to Drive";
	$pdf->Text  ( $xtest, $ytest, $txttest, false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );

	$xtest = $pdf->pixelsToUnits('410');
	$ytest = $pdf->pixelsToUnits('464');
    $txttest = "Permanent";
	$pdf->Text  ( $xtest, $ytest, $txttest, false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );

	$xtest = $pdf->pixelsToUnits('410');
	$ytest = $pdf->pixelsToUnits('476');
    $txttest = "Temporary";
	$pdf->Text  ( $xtest, $ytest, $txttest, false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );

	$xtest = $pdf->pixelsToUnits('410');
	$ytest = $pdf->pixelsToUnits('488');
    $txttest = "Refer specialist for further Evaluation";
	$pdf->Text  ( $xtest, $ytest, $txttest, false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );

	//Condition
	$xtest = $pdf->pixelsToUnits('395');
	$ytest = $pdf->pixelsToUnits('531');
    $txttest = "None";
	$pdf->Text  ( $xtest, $ytest, $txttest, false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );

	$xtest = $pdf->pixelsToUnits('395');
	$ytest = $pdf->pixelsToUnits('543');
    $txttest = "Drive only with correction lens";
	$pdf->Text  ( $xtest, $ytest, $txttest, false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );

	$xtest = $pdf->pixelsToUnits('395');
	$ytest = $pdf->pixelsToUnits('553');
    $txttest = "Drive only with special equipment for upper limbs";
	$pdf->Text  ( $xtest, $ytest, $txttest, false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );

	$xtest = $pdf->pixelsToUnits('395');
	$ytest = $pdf->pixelsToUnits('564');
    $txttest = "Drive only with special equipment for lower limbs";
	$pdf->Text  ( $xtest, $ytest, $txttest, false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );

	$xtest = $pdf->pixelsToUnits('395');
	$ytest = $pdf->pixelsToUnits('576');
    $txttest = "Drive only during daylight";
	$pdf->Text  ( $xtest, $ytest, $txttest, false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );


	$xtest = $pdf->pixelsToUnits('395');
	$ytest = $pdf->pixelsToUnits('587');
    $txttest = "Drive with hearing aid";
	$pdf->Text  ( $xtest, $ytest, $txttest, false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );




	//right ear
	$xtest = $pdf->pixelsToUnits('500');
	$ytest = $pdf->pixelsToUnits('381.5');
    $txttest = "Normal";
	$pdf->Text  ( $xtest, $ytest, $txttest, false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );

	$xtest = $pdf->pixelsToUnits('500');
	$ytest = $pdf->pixelsToUnits('393');
    $txttest = "Reduce";
	$pdf->Text  ( $xtest, $ytest, $txttest, false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );

	$xtest = $pdf->pixelsToUnits('500');
	$ytest = $pdf->pixelsToUnits('405');
    $txttest = "With Hearing aid";
	$pdf->Text  ( $xtest, $ytest, $txttest, false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );

	//Upper extremities (right) check box
	$pdf->SetFont('times', '', 7); 
	$xtest = $pdf->pixelsToUnits('160');
	$ytest = $pdf->pixelsToUnits('305');
	$pdf->Text  ( $xtest, $ytest, 'Normal', false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );

	$pdf->SetFont('times', '', 7); 
	$xtest = $pdf->pixelsToUnits('160');
	$ytest = $pdf->pixelsToUnits('315');
	$pdf->Text  ( $xtest, $ytest, 'With Disability', false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );

	$pdf->SetFont('times', '', 7); 
	$xtest = $pdf->pixelsToUnits('160');
	$ytest = $pdf->pixelsToUnits('325');
	$pdf->Text  ( $xtest, $ytest, 'With Special Equipment', false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );

	//VISUAL ACUITY
	$xtest = $pdf->pixelsToUnits('35');
	$ytest = $pdf->pixelsToUnits('383');
	$pdf->Text  ( $xtest, $ytest, 'With Corrective Lens', false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );
	$xtest = $pdf->pixelsToUnits('35');
	$ytest = $pdf->pixelsToUnits('393');
	$pdf->Text  ( $xtest, $ytest, 'Color Blind', false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );

		//left eye snell
	$xtest = $pdf->pixelsToUnits('35');
	$ytest = $pdf->pixelsToUnits('417');
	$pdf->Text  ( $xtest, $ytest, 'With Corrective Lens', false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );
	$xtest = $pdf->pixelsToUnits('35');
	$ytest = $pdf->pixelsToUnits('428');
	$pdf->Text  ( $xtest, $ytest, 'Color Blind', false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );

			//right eye snell
	$xtest = $pdf->pixelsToUnits('35');
	$ytest = $pdf->pixelsToUnits('460');
	$pdf->Text  ( $xtest, $ytest, 'With Corrective Lens', false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );
	$xtest = $pdf->pixelsToUnits('35');
	$ytest = $pdf->pixelsToUnits('470');
	$pdf->Text  ( $xtest, $ytest, 'Color Blind', false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );

	$pdf->SetFont('times', 'b', 7); 
	$xtest = $pdf->pixelsToUnits('20');
	$ytest = $pdf->pixelsToUnits('405');
	$pdf->Text  ( $xtest, $ytest, 'LEFT  EYE:  SNELLEN/BAILEY-LOVIE', false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );
	$pdf->Line(57,160,82,160); //LEFT  EYE:  SNELLEN/BAILEY-LOVIE
	$xtest = $pdf->pixelsToUnits('20');
	$ytest = $pdf->pixelsToUnits('445');
	$pdf->Text  ( $xtest, $ytest, 'RIGHT  EYE:  SNELLEN/BAILEY-LOVIE', false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );
	$pdf->Line(55,146,80,146); //RIGHT  EYE:  SNELLEN/BAILEY-LOVIE

	$pdf->SetFont('times', '', 7); 
	$xtest = $pdf->pixelsToUnits('180');
	$ytest = $pdf->pixelsToUnits('405');
	$pdf->Text  ( $xtest, $ytest, $user['eye_vision_left'], false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );

		$xtest = $pdf->pixelsToUnits('180');
	$ytest = $pdf->pixelsToUnits('445');
	$pdf->Text  ( $xtest, $ytest, $user['eye_vision_right'], false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );


	//lower extremities (left) check box
	$pdf->SetFont('times', '', 7); 
	$xtest = $pdf->pixelsToUnits('300');
	$ytest = $pdf->pixelsToUnits('305');
	$pdf->Text  ( $xtest, $ytest, 'Normal', false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );

	$pdf->SetFont('times', '', 7); 
	$xtest = $pdf->pixelsToUnits('300');
	$ytest = $pdf->pixelsToUnits('315');
	$pdf->Text  ( $xtest, $ytest, 'With Disability', false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );

	$pdf->SetFont('times', '', 7); 
	$xtest = $pdf->pixelsToUnits('300');
	$ytest = $pdf->pixelsToUnits('325');
	$pdf->Text  ( $xtest, $ytest, 'With Special Equipment', false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );




	//lower extremities (right) check box
	$pdf->SetFont('times', '', 7); 
	$xtest = $pdf->pixelsToUnits('440');
	$ytest = $pdf->pixelsToUnits('305');
	$pdf->Text  ( $xtest, $ytest, 'Normal', false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );

	$pdf->SetFont('times', '', 7); 
	$xtest = $pdf->pixelsToUnits('440');
	$ytest = $pdf->pixelsToUnits('315');
	$pdf->Text  ( $xtest, $ytest, 'With Disability', false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );

	$pdf->SetFont('times', '', 7); 
	$xtest = $pdf->pixelsToUnits('440');
	$ytest = $pdf->pixelsToUnits('325');
	$pdf->Text  ( $xtest, $ytest, 'With Special Equipment', false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );


	// from database
	//lastname
	$pdf->SetFont('times', '', 7); 
	$xtest = $pdf->pixelsToUnits('116');
	$ytest = $pdf->pixelsToUnits('140');
	$pdf->Text  ( $xtest, $ytest, $lastname,  false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );

	//firstname
	$xtest = $pdf->pixelsToUnits('246');
	$ytest = $pdf->pixelsToUnits('140');
	$pdf->Text  ( $xtest, $ytest, $first_name,  false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );

	//middlename
	$xtest = $pdf->pixelsToUnits('411');
	$ytest = $pdf->pixelsToUnits('140');
	$pdf->Text  ( $xtest, $ytest, $middle_name, false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );

	//address
	$xtest = $pdf->pixelsToUnits('75');
	$ytest = $pdf->pixelsToUnits('164');
	$pdf->Text  ( $xtest, $ytest, $address, false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );

	//driverslicense
	$xtest = $pdf->pixelsToUnits('155');
	$ytest = $pdf->pixelsToUnits('177');
	$pdf->Text  ( $xtest, $ytest, $driver_license, false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );

	//birthday
	$xtest = $pdf->pixelsToUnits('350');
	$ytest = $pdf->pixelsToUnits('177');
	$pdf->Text  ( $xtest, $ytest, $bdate, false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );

	//nationality
	$xtest = $pdf->pixelsToUnits('110');
	$ytest = $pdf->pixelsToUnits('190');
	$pdf->Text  ( $xtest, $ytest, $nationality_name, false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );

	//age
	$xtest = $pdf->pixelsToUnits('257');
	$ytest = $pdf->pixelsToUnits('190');
	$pdf->Text  ( $xtest, $ytest, $age , false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );

	//gender
	$xtest = $pdf->pixelsToUnits('335');
	$ytest = $pdf->pixelsToUnits('190');
	$pdf->Text  ( $xtest, $ytest, $gender, false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );

	//Marital Status
	$xtest = $pdf->pixelsToUnits('465');
	$ytest = $pdf->pixelsToUnits('190');
	$pdf->Text  ( $xtest, $ytest, $marital_status, false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );

	//blood type
	$xtest = $pdf->pixelsToUnits('490');
	$ytest = $pdf->pixelsToUnits('270');
	$pdf->Text  ( $xtest, $ytest, $user['blood_type'], false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );

	//blood pressure
	$xtest = $pdf->pixelsToUnits('490');
	$ytest = $pdf->pixelsToUnits('240');
	$pdf->Text  ( $xtest, $ytest, $user['bp'], false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );

	//Height
	$xtest = $pdf->pixelsToUnits('55');
	$ytest = $pdf->pixelsToUnits('270');
	$pdf->Text  ( $xtest, $ytest,$user['height'], false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );

	//weight
	$xtest = $pdf->pixelsToUnits('138');
	$ytest = $pdf->pixelsToUnits('270');
	$pdf->Text  ( $xtest, $ytest,$user['weight'], false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );
	
	//general physique
	$pdf->SetXY(9, 86);
	$pdf->CheckBox('myCheckbox', 3, $general_physique_normal, array(), array());
	$pdf->SetXY(9, 91);
	$pdf->CheckBox('myCheckbox', 3, $general_physique_with, array(), array());

	//contagious disease
	$pdf->SetXY(102, 86);
	$pdf->CheckBox('myCheckbox', 3, $contagious_desiease_normal, array(), array());
	$pdf->SetXY(102, 91);
	$pdf->CheckBox('myCheckbox', 3, $contagious_desiease_with, array(), array());

	//upper extremities (left) disease
	$pdf->SetXY(9, 107.5);
	$pdf->CheckBox('myCheckbox', 3, ($user['upper_extreme_left']== 'Normal') ?  true : false , array(), array());
	$pdf->SetXY(9, 111);
	$pdf->CheckBox('myCheckbox', 3, ($user['upper_extreme_left']== 'With Disability') ?  true : false, array(), array());
	$pdf->SetXY(9, 114.5);
	$pdf->CheckBox('myCheckbox', 3, ($user['upper_extreme_left']== 'With Special Equipment') ?  true : false, array(), array());

	//upper extremities (right) disease
	$pdf->SetXY(54, 107.5);
	$pdf->CheckBox('myCheckbox', 3, ($user['upper_extreme_right']== 'Normal') ?  true : false , array(), array());
	$pdf->SetXY(54, 111);
	$pdf->CheckBox('myCheckbox', 3, ($user['upper_extreme_right']== 'With Disability') ?  true : false, array(), array());
	$pdf->SetXY(54, 114.5);
	$pdf->CheckBox('myCheckbox', 3, ($user['upper_extreme_right']== 'With Special Equipment') ?  true : false, array(), array());

	//lower extremities (left) disease
	$pdf->SetXY(102, 107.5);
	$pdf->CheckBox('myCheckbox', 3, ($user['lower_extreme_left']== 'Normal') ?  true : false , array(), array());
	$pdf->SetXY(102, 111);
	$pdf->CheckBox('myCheckbox', 3, ($user['lower_extreme_left']== 'With Disability') ?  true : false, array(), array());
	$pdf->SetXY(102, 114.5);
	$pdf->CheckBox('myCheckbox', 3, ($user['lower_extreme_left']== 'With Special Equipment') ?  true : false, array(), array());

	//lower extremities (right) disease
	$pdf->SetXY(152, 107.5);
	$pdf->CheckBox('myCheckbox', 3, ($user['lower_extreme_right']== 'Normal') ?  true : false , array(), array());
	$pdf->SetXY(152, 111);
	$pdf->CheckBox('myCheckbox', 3, ($user['lower_extreme_right']== 'With Disability') ?  true : false, array(), array());
	$pdf->SetXY(152, 114.5);
	$pdf->CheckBox('myCheckbox', 3, ($user['lower_extreme_right']== 'With Special Equipment') ?  true : false, array(), array());

	//visual acuity
	$pdf->SetXY(9, 135);
	$pdf->CheckBox('myCheckbox', 3, ($user['lower_extreme_right']== 'With Special Equipment') ?  true : false, array(), array());
	$pdf->SetXY(9, 138.5);
	$pdf->CheckBox('myCheckbox', 3, ($user['lower_extreme_right']== 'With Special Equipment') ?  true : false, array(), array());

	//left eye snelle
	$pdf->SetXY(9, 147);
	$pdf->CheckBox('myCheckbox', 3, ($user['eye_left_correction']== 'correction_left') ?  true : false , array(), array());
	$pdf->SetXY(9, 151);
	$pdf->CheckBox('myCheckbox', 3,  ($user['eye_left_correction']== '0') ?  true : false, array(), array());

	//right eye snelle
	$pdf->SetXY(9, 162);
	$pdf->CheckBox('myCheckbox', 3,	($user['eye_right_correction']== 'correction_right') ?  true : false, array(), array());
	$pdf->SetXY(9, 166);
	$pdf->CheckBox('myCheckbox', 3, ($user['eye_right_correction']== '0') ?  true : false, array(), array());

	//LEFT EAR 
	$pdf->SetXY(135, 135);
	$pdf->CheckBox('myCheckbox', 3, ($user['hearing_left']== '1') ?  true : false, array(), array());
	$pdf->SetXY(135, 139);
	$pdf->CheckBox('myCheckbox', 3, ($user['hearing_left']== '2') ?  true : false, array(), array());
	$pdf->SetXY(135, 143);
	$pdf->CheckBox('myCheckbox', 3, ($user['hearing_left']== '3') ?  true : false, array(), array());

	//RIGHT EAR 
	$pdf->SetXY(172, 135);
	$pdf->CheckBox('myCheckbox', 3, ($user['hearing_right']== '1') ?  true : false, array(), array());
	$pdf->SetXY(172, 139);
	$pdf->CheckBox('myCheckbox', 3, ($user['hearing_right']== '2') ?  true : false, array(), array());
	$pdf->SetXY(172, 143);
	$pdf->CheckBox('myCheckbox', 3, ($user['hearing_right']== '3') ?  true : false, array(), array());

	//Assessment 
	$pdf->SetXY(135, 156);
	$pdf->CheckBox('myCheckbox', 3, ($user['assessment']== '1') ?  true : false, array(), array());
	$pdf->SetXY(135, 160);
	$pdf->CheckBox('myCheckbox', 3, ($user['assessment']== '2') ?  true : false, array(), array());
	$pdf->SetXY(140, 164);
	$pdf->CheckBox('myCheckbox', 3, ($user['assessment']== '4') ?  true : false, array(), array());
	$pdf->SetXY(140, 168);
	$pdf->CheckBox('myCheckbox', 3, ($user['assessment']== '3') ?  true : false, array(), array());
	$pdf->SetXY(140, 172);
	$pdf->CheckBox('myCheckbox', 3, ($user['assessment']== '5') ?  true : false, array(), array());

	//metabolic diabetes
	$pdf->SetXY(6, 182);
	$pdf->CheckBox('myCheckbox', 3,	($user['diabetes']== '1') ?  true : false, array(), array());
	$pdf->SetXY(16, 182);
	$pdf->CheckBox('myCheckbox', 3, ($user['diabetes']== '0') ?  true : false, array(), array());
	$pdf->SetFont('times', '', 7); 
	$xtest = $pdf->pixelsToUnits('25');
	$ytest = $pdf->pixelsToUnits('516');
	$pdf->Text  ( $xtest, $ytest, 'Yes', false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );
	$xtest = $pdf->pixelsToUnits('55');
	$pdf->Text  ( $xtest, $ytest, 'No', false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );
	$xtest = $pdf->pixelsToUnits('85');
	$pdf->Text  ( $xtest, $ytest, 'DIABETES', false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );
	$xtest = $pdf->pixelsToUnits('135');
	$pdf->Text  ( $xtest, $ytest, ' Medicine in take ( ' . $user["med_diabetes"] . ' ) ', false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );
		$pdf->SetFont('times', '', 8);
	$xtest = $pdf->pixelsToUnits('15');
	$ytest = $pdf->pixelsToUnits('528');
	$pdf->Text  ( $xtest, $ytest, 'is it under proper control or medication? ', false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );
	$pdf->SetXY(55, 186.5);
	$pdf->CheckBox('myCheckbox', 3,	($user['under_medication_diabetes']== '1') ?  true : false, array(), array());
	$pdf->SetXY(65, 186.5);
	$pdf->CheckBox('myCheckbox', 3, ($user['under_medication_diabetes']== '0') ?  true : false, array(), array());
	$xtest = $pdf->pixelsToUnits('162');
	$ytest = $pdf->pixelsToUnits('528');
	$pdf->Text  ( $xtest, $ytest, 'Yes', false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );
	$xtest = $pdf->pixelsToUnits('190');
		$ytest = $pdf->pixelsToUnits('528');
	$pdf->Text  ( $xtest, $ytest, 'No', false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );


	//metabolic epilepsy
	$pdf->SetXY(6, 191);
	$pdf->CheckBox('myCheckbox', 3,	($user['epilepsy']== '1') ?  true : false, array(), array());
	$pdf->SetXY(16, 191);
	$pdf->CheckBox('myCheckbox', 3, ($user['epilepsy']== '0') ?  true : false, array(), array());
	$pdf->SetFont('times', '', 7); 
	$xtest = $pdf->pixelsToUnits('25');
	$ytest = $pdf->pixelsToUnits('543');
	$pdf->Text  ( $xtest, $ytest, 'Yes', false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );
	$xtest = $pdf->pixelsToUnits('55');
	$pdf->Text  ( $xtest, $ytest, 'No', false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );
	$xtest = $pdf->pixelsToUnits('85');
	$pdf->Text  ( $xtest, $ytest, 'EPILEPSY', false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );
	$xtest = $pdf->pixelsToUnits('135');
	$pdf->Text  ( $xtest, $ytest, 'Date of last seizure ' .$user['date_seizure'] , false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );
	$xtest = $pdf->pixelsToUnits('220');
	$pdf->Text  ( $xtest, $ytest, ' Medicine in take ( ' . $user["med_epilepsy"] . ' ) ', false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );
		$pdf->SetFont('times', '', 8);
	$xtest = $pdf->pixelsToUnits('15');
	$ytest = $pdf->pixelsToUnits('553');
	$pdf->Text  ( $xtest, $ytest, 'is it under proper control or medication? ', false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );
	$pdf->SetXY(55, 195);
	$pdf->CheckBox('myCheckbox', 3,	($user['under_medication_epilepsy']== '1') ?  true : false, array(), array());
	$pdf->SetXY(65, 195);
	$pdf->CheckBox('myCheckbox', 3, ($user['under_medication_epilepsy']== '0') ?  true : false, array(), array());
	$xtest = $pdf->pixelsToUnits('162');
	$ytest = $pdf->pixelsToUnits('553');
	$pdf->Text  ( $xtest, $ytest, 'Yes', false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );
	$xtest = $pdf->pixelsToUnits('190');
	$ytest = $pdf->pixelsToUnits('553');
	$pdf->Text  ( $xtest, $ytest, 'No', false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );


	//metabolic sleep apnea
	$pdf->SetXY(6, 199);
	$pdf->CheckBox('myCheckbox', 3,	($user['sleep_apnes']== '1') ?  true : false, array(), array());
	$pdf->SetXY(16, 199);
	$pdf->CheckBox('myCheckbox', 3, ($user['sleep_apnes']== '0') ?  true : false, array(), array());
	$pdf->SetFont('times', '', 7); 
	$xtest = $pdf->pixelsToUnits('25');
	$ytest = $pdf->pixelsToUnits('566');
	$pdf->Text  ( $xtest, $ytest, 'Yes', false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );
	$xtest = $pdf->pixelsToUnits('55');
	$pdf->Text  ( $xtest, $ytest, 'No', false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );
	$xtest = $pdf->pixelsToUnits('85');
	$pdf->Text  ( $xtest, $ytest, 'SLEEP APNEA', false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );
	
	$xtest = $pdf->pixelsToUnits('135');
	$pdf->Text  ( $xtest, $ytest, ' Medicine in take ( ' . $user["med_apnea"] . ' ) ', false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );
		$pdf->SetFont('times', '', 8);
	$xtest = $pdf->pixelsToUnits('15');
	$ytest = $pdf->pixelsToUnits('575');
	$pdf->Text  ( $xtest, $ytest, 'is it under proper control or medication? ', false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );
	$pdf->SetXY(55, 203);
	$pdf->CheckBox('myCheckbox', 3,	($user['under_medication_apnes']== '1') ?  true : false, array(), array());
	$pdf->SetXY(65, 203);
	$pdf->CheckBox('myCheckbox', 3, ($user['under_medication_apnes']== '0') ?  true : false, array(), array());
	$xtest = $pdf->pixelsToUnits('162');
	$ytest = $pdf->pixelsToUnits('575');
	$pdf->Text  ( $xtest, $ytest, 'Yes', false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );
	$xtest = $pdf->pixelsToUnits('190');
	$ytest = $pdf->pixelsToUnits('575');
	$pdf->Text  ( $xtest, $ytest, 'No', false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );


	//aggressive
	$pdf->SetXY(6, 207);
	$pdf->CheckBox('myCheckbox', 3,	($user['aggressive_depressive_order']== '1') ?  true : false, array(), array());
	$pdf->SetXY(16, 207);
	$pdf->CheckBox('myCheckbox', 3, ($user['aggressive_depressive_order']== '0') ?  true : false, array(), array());
	$pdf->SetFont('times', '', 7); 
	$xtest = $pdf->pixelsToUnits('25');
	$ytest = $pdf->pixelsToUnits('587');
	$pdf->Text  ( $xtest, $ytest, 'Yes', false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );
	$xtest = $pdf->pixelsToUnits('55');
	$pdf->Text  ( $xtest, $ytest, 'No', false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );
	$xtest = $pdf->pixelsToUnits('85');
	$pdf->Text  ( $xtest, $ytest, 'AGGRESSIVE MANIC OR DEPRESSION DISORDER', false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );
	
	$xtest = $pdf->pixelsToUnits('250');
	$pdf->Text  ( $xtest, $ytest, ' Medicine in take ( ' . $user["med_disorder"] . ' ) ', false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );
		$pdf->SetFont('times', '', 8);
	$xtest = $pdf->pixelsToUnits('15');
	$ytest = $pdf->pixelsToUnits('597');
	$pdf->Text  ( $xtest, $ytest, 'is it under proper control or medication? ', false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );
	$pdf->SetXY(55, 211);
	$pdf->CheckBox('myCheckbox', 3,	($user['under_medication_aggressive']== '1') ?  true : false, array(), array());
	$pdf->SetXY(65, 211);
	$pdf->CheckBox('myCheckbox', 3, ($user['under_medication_aggressive']== '0') ?  true : false, array(), array());
	$xtest = $pdf->pixelsToUnits('162');
	$ytest = $pdf->pixelsToUnits('598');
	$pdf->Text  ( $xtest, $ytest, 'Yes', false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );
	$xtest = $pdf->pixelsToUnits('190');
	$ytest = $pdf->pixelsToUnits('598');
	$pdf->Text  ( $xtest, $ytest, 'No', false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );


	//Other medical condition
	$pdf->SetXY(6, 215);
	$pdf->CheckBox('myCheckbox', 3,	($user['other']== '1') ?  true : false, array(), array());
	$pdf->SetXY(16, 215);
	$pdf->CheckBox('myCheckbox', 3, ($user['other']== '0') ?  true : false, array(), array());
	$pdf->SetFont('times', '', 7); 
	$xtest = $pdf->pixelsToUnits('25');
	$ytest = $pdf->pixelsToUnits('610');
	$pdf->Text  ( $xtest, $ytest, 'Yes', false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );
	$xtest = $pdf->pixelsToUnits('55');
	$pdf->Text  ( $xtest, $ytest, 'No', false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );
	$xtest = $pdf->pixelsToUnits('85');
	$pdf->Text  ( $xtest, $ytest, 'OTHER MEDICAL CONDITION OR IMPAIRMENT WHICH MAY AFFECT ABILITY', false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );
	
	$pdf->SetFont('times', '', 8);
	$xtest = $pdf->pixelsToUnits('15');
	$ytest = $pdf->pixelsToUnits('627');
	$pdf->Text  ( $xtest, $ytest, 'is it under proper control or medication? ', false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );
	$pdf->SetXY(55, 221);
	$pdf->CheckBox('myCheckbox', 3,	($user['under_medication_other']== '1') ?  true : false, array(), array());
	$pdf->SetXY(65, 221);
	$pdf->CheckBox('myCheckbox', 3, ($user['under_medication_other']== '0') ?  true : false, array(), array());
	$xtest = $pdf->pixelsToUnits('162');
	$ytest = $pdf->pixelsToUnits('627');
	$pdf->Text  ( $xtest, $ytest, 'Yes', false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );
	$xtest = $pdf->pixelsToUnits('627');
	$ytest = $pdf->pixelsToUnits('598');
	$pdf->Text  ( $xtest, $ytest, 'No', false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );
	$pdf->SetFont('times', '', 7);
	$xtest = $pdf->pixelsToUnits('85');
	$ytest = $pdf->pixelsToUnits('619');
	$pdf->Text  ( $xtest, $ytest, 'TO DRIVE SAFELY', false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );
	$xtest = $pdf->pixelsToUnits('190');
	$pdf->Text  ( $xtest, $ytest, ' Medicine in take ( ' . $user["med_disorder"] . ' ) ', false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );

	//Conditions
	$pdf->SetXY(135, 187);
	$pdf->CheckBox('myCheckbox', 3, (strpos( $user['condition_driving'], '0' )!== false ||  $user['condition_driving']==="" ) ?  true : false, array(), array());
	$pdf->SetXY(135, 191);
	$pdf->CheckBox('myCheckbox', 3, (strpos( $user['condition_driving'], '1' )!== false) ?  true : false, array(), array());
	$pdf->SetXY(135, 195);
	$pdf->CheckBox('myCheckbox', 3, (strpos( $user['condition_driving'], '2' )!== false) ?  true : false, array(), array());
		$pdf->SetXY(135, 199);
	$pdf->CheckBox('myCheckbox', 3, (strpos( $user['condition_driving'], '3' )!== false)  ?  true : false, array(), array());
		$pdf->SetXY(135, 203);
	$pdf->CheckBox('myCheckbox', 3, (strpos( $user['condition_driving'], '4' )!== false)  ?  true : false, array(), array());
			$pdf->SetXY(135, 207);
	$pdf->CheckBox('myCheckbox', 3, (strpos( $user['condition_driving'], '5' )!== false)  ?  true : false, array(), array());
	//physicial
	$xtest = $pdf->pixelsToUnits('140');
	$ytest = $pdf->pixelsToUnits('658');
	$pdf->Text  ( $xtest, $ytest, $doc_fullname, false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );

	//prc number
	$xtest = $pdf->pixelsToUnits('140');
	$ytest = $pdf->pixelsToUnits('668');
	$pdf->Text  ( $xtest, $ytest, $prc_license_number, false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );

	//ptr number
	$xtest = $pdf->pixelsToUnits('140');
	$ytest = $pdf->pixelsToUnits('680');
	$pdf->Text  ( $xtest, $ytest, $ptr_number, false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );

	//issued at
	$xtest = $pdf->pixelsToUnits('140');
	$ytest = $pdf->pixelsToUnits('691');
	$pdf->Text  ( $xtest, $ytest, $clinicname, false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );

	//DATE ISSUED
	$xtest = $pdf->pixelsToUnits('500');
	$ytest = $pdf->pixelsToUnits('690');
	$pdf->Text  ( $xtest, $ytest, $todayv, false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );

	//valid until
	$xtest = $pdf->pixelsToUnits('500');
	$ytest = $pdf->pixelsToUnits('705');
	$pdf->Text  ( $xtest, $ytest, $from_date, false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );

	$pdf->SetFont('times', 'b', 10); 
	$xtest = $pdf->pixelsToUnits('140');
	$ytest = $pdf->pixelsToUnits('700');
	$pdf->SetTextColor(16,96,60);
	$pdf->Text  ( $xtest, $ytest, $uid, false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );

	// ---------------------------------------------------------
	//Close and output PDF document

	ob_end_clean();
	$pdf->Output('medical'.$uid.'.pdf', 'I');
?>