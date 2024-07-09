<?php
error_reporting(0);
date_default_timezone_set("Asia/Manila");
$uid = base64_decode($_GET['uid']);
//echo $uid
try {

  $query = "SELECT mr.*,tc.name as clinicname,CONCAT(mu.fname,' ',mu.lname) as doc_fullname,mu.prc_license_number,mu.ptr_number , (SELECT name FROM nationalities WHERE return_value=nationality LIMIT 1) as nationality_name
   from medical_record as  mr  LEFT JOIN  tbl_clinics as  tc  ON  tc.id=mr.branch_id
    LEFT JOIN  medical_users as mu ON mu.id=mr.doctor_attended WHERE mr.uid='$uid'";

  $stmt = $auth_item->runQuery($query);


  $stmt->execute();
  $Row = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
  echo $e->getMessage();
}
include('./css.php');
?>
<center>
  <div class="conatianer-header">
    <img class="left-logo" src="../../dist/img/new-department.png">
    <img class="right-logo" src="../../dist/img/new-lto-login.png">
    <p class="title-header">MEDICAL CERTIFICATE FOR DRIVER'S LICENSE</p>
    <p class="ref-no">LTMS REFERENCE NO : <span class="ref-no-num"><?= $Row['internal_reference_no'] ?></span> </p>
  </div>


  <Table style="width:100%; word-wrap: break-word;">
    <!-- 
    <tr valign="center" style="font-size:16px; ">
      <th colspan="5">
        <table align="center">
          <tr>
            <td>

              <img src="../../dist/img/department.png" style="width:110px; ">&nbsp;
            </td>
            <th>
              <h1>
                MEDICAL CERTIFICATE FOR DRIVER'S LICENSE
                LTMS REFERENCE NO :
                <?php echo $Row['internal_reference_no'] ?>
              </h1>
            </th>
            <td>
              <img src="../../dist/img/lto.png" style="width:145px; ">
            </td>
          </tr>
        </table>
      </th>
    </tr> -->


    <Tr style="border: 1px solid black;">
      <td colspan="2">
        <table style="width:100%;  border: 1px solid black;  text-align: left;">
          <tr>
            <th style="text-align: center;">APPLICANT'S INFORMATION</th>
          </tr>
        </table>
      </td>
    </Tr>

    <!------------------------------INFORMATIoON-------------------------------------------------->

    <tr style="">
      <td style="padding-left: 10px;    width:100%; border-left: 1px solid black;  border-bottom: 1px solid black; ">


        <table style="width:100%;   text-align: left; ">
          <tr>
            <tH>NAME:</tH>
            <td style="border-bottom: 1pt solid black; text-align: center;"><?php echo $Row['last_name'] ?></td>
            <td>&nbsp;</td>
            <td style="border-bottom: 1pt solid black; text-align: center;"><?php echo $Row['first_name'] ?></td>
            <td>&nbsp;</td>
            <td style="border-bottom: 1pt solid black; text-align: center;"><?php echo $Row['middle_name'] ?></td>
            <td>&nbsp;</td>

          </tr>
          <tr>
            <tH></tH>
            <td style=" text-align: center;">SURNAME</td>
            <td>&nbsp;</td>
            <td style=" text-align: center;">FIRST NAME</td>
            <td>&nbsp;</td>
            <td style=" text-align: center;">MIDDLE NAME</td>
            <td>&nbsp;</td>

          </tr>
        </table>
        <table style="width:100%;   text-align: left;">
          <tr>
            <tH>ADDRESS:</tH>
            <td colspan="3" style="border-bottom: 1pt solid black; text-align: center; width: 100%;"><?php echo $Row['address'] ?>&nbsp;</td>

          </tr>
        </table>
        <table style="width:100%;    text-align: left;  font-size: 13px; ">
          <tr>
            <tH style="width:28%;">DRIVER'S LICENSE NUMBER:</tH>
            <td style="border-bottom: 1pt solid black; text-align: center;"><?php echo $Row['driver_license'] ?></td>
            <tH style="width:20%; ">DATE OF BIRTH:</tH>
            <td style="border-bottom: 1pt solid black; text-align: center;"><?php echo date("F jS, Y", strtotime($Row['bdate'])); ?></td>
          </tr>
        </table>


        <table style="width:100%;  text-align: left;  font-size: 13px;">
          <tr>
            <tH style="width:10%; ">NATIONALITY:</tH>
            <td style="width:25%;  border-bottom: 1pt solid black; text-align: center;"><?php echo $Row['nationality_name'] ?></td>
            <tH style="width:5%; ">AGE</tH>
            <td style="width:10%;  border-bottom: 1pt solid black; text-align: center;"><?php

                                                                                        $dob = $Row['bdate']; //date of Birth
                                                                                        $dateOfBirth = $dob;
                                                                                        $today = date("Y-m-d");
                                                                                        $diff = date_diff(date_create($dateOfBirth), date_create($today));
                                                                                        echo $diff->format('%y');
                                                                                        ?></td>
            <tH style="width:10%; ">GENDER</tH>
            <td style="width:10%; border-bottom: 1pt solid black; text-align: center;"><?php echo $Row['gender'] ?></td>
            <tH style="width:20%; ">MARITAL STATUS</tH>
            <td style="width:35%;  border-bottom: 1pt solid black; text-align: center;"><?php echo $Row['marital_status'] ?></td>
          </tr>
        </table>



      </td>
      <td style="width:200px; text-align:center;  border-right: 1px solid black;  border-bottom: 1px solid black; padding-left: 5px;">

        <?php
        $imgss = "";
        $imgss = $Row['imgs'];
        if ($imgss != "") {
          echo '    <img src="../../control/upload/' . $imgss . '" style="height:120px; -webkit-print-color-adjust: exact !important;">';
        } else {   ?>


          <img src="../../dist/img/avatar5.png" style="height: 215px; width: 215px; ">
        <?php } ?>
      </td>
    </tr>

    <!------------------------------PHYSICAL-------------------------------------------------->

    <tr>

      <td colspan="2">
        &nbsp;
      </td>
    </tr>

    <tr>

      <td colspan="2">
        <table style="width:100%;  border: 1px solid black;  text-align:CENTER;">
          <tr>
            <th style="text-align: center;">PHYSICAL INFORMATION</th>
          </tr>
        </table>
      </td>
    </tr>

    <tr style="border: 1px solid black;">

      <td colspan="2" style="padding-left: 10px; border: 1px solid black; ">
        <table style="width:100%;  text-align: left;">
          <tr style="font-size: 15px;">
            <tH style="width:35%; ">GENERAL PHYSIQUE:</tH>
            <tH style="width:30%; ">CONTAGIOUS DISEASE:</tH>
            <tH style="width:35%;  ">BLOOD PRESSURE:</tH>
          </tr>
          <tr>
            <tD style="width:25%; "><label>

                <?php

                //*************************GENERAL
                if ($Row['general_physique'] == "0") {
                  $general_physique_normal = "checked";
                  $general_physique_with = "disabled";
                } else {
                  $general_physique_normal = "disabled";
                  $general_physique_with = "checked";
                }


                //*************************CONTAGIOUS
                if ($Row['contagious_desiease'] == "0") {
                  $contagious_desiease_normal = "checked";
                  $contagious_desiease_with = "disabled";
                } else {
                  $contagious_desiease_normal = "disabled";
                  $contagious_desiease_with = "checked";
                }


                ?>

                <input type="checkbox" value="0" name="general_phys" <?php echo $general_physique_normal; ?> class="css-checkbox lrg"> <label for="checkbox69" name="checkbox69_lbl" class="css-label lrg vlad">Normal</label></tD>
            <tD style="width:25%; "><label>

                <input type="checkbox" value="0" name="contagious_disease" <?php echo $contagious_desiease_normal; ?> class="css-checkbox lrg"> <label for="checkbox69" name="checkbox69_lbl" class="css-label lrg vlad">Normal</label>




            </tD>

            <tD style="width:25%; text-align: center;"><?php echo $Row['bp'] ?></tD>

          </tr>
          <tr>
            <tD style="width:25%; ">
              <input type="checkbox" value="0" name="general_phys" <?php echo $general_physique_with ?> class="css-checkbox lrg">
              <label for="checkbox69" name="checkbox69_lbl" class="css-label lrg vlad">With Disability,pls specify </label>
              <?php
              if ($Row['general_physique_reason'] != "") {
              ?>
                <span style="border-bottom: 1pt solid black; text-align: center;  width:150px ">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $Row['general_physique_reason'] ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
              <?php  } ?>
            </tD>


            <tD style="width:25%; ">

              <input type="checkbox" value="0" name="contagious_disease" <?php echo $contagious_desiease_with; ?> class="css-checkbox lrg"> <label for="checkbox69" name="checkbox69_lbl" class="css-label lrg vlad">With Disability,pls specify </label>
              <?php
              if ($Row['contagious_desiease_reason'] != "") {
              ?>
                <span style="border-bottom: 1pt solid black; text-align: center;  width:150px ">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $Row['contagious_desiease_reason'] ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
              <?php  } ?>
            </tD>
            <th style="width:25%; text-align: center;">BLOOD TYPE</th>
          </tr>



          <tr>
            <tD style="width:50%; font-size: 13px; ">
              <strong> HEIGHT</strong>
              <span style="border-bottom: 1pt solid black; text-align: center;  width:150px ">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $Row['height'] ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>(CMS)
              <strong>WEIGHT</strong>
              <span style="border-bottom: 1pt solid black; text-align: center;  width:150px ">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $Row['weight'] ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>(KGS)
            </tD>


            <tD style="width:10%; ">
            </tD>
            <th style="width:25%; border-bottom: 1pt solid black; text-align: center;"><?php echo $Row['blood_type'] ?></th>
          </tr>

          <tr>
            <tH style="width:50%; ">
              UPPER EXTREMITIES:</th>
            <th style="width:25%;"> LOWER EXTREMITIES:</th>
          </tr>

          <tr>
            <td style="width:50%; ">
              <Table style="width:100%; ">
                <tr style="text-align: left;">
                  <th>LEFT</th>
                  <th>RIGHT</th>
                </tr>

                <tr>
                  <td>

                    <input <?php echo ($Row['upper_extreme_left'] == 'Normal') ?  "checked" : "";  ?> type="checkbox" value="0" name="r3" class="css-checkbox lrg" class="css-checkbox lrg"> <label for="checkbox69" name="checkbox69_lbl" class="css-label lrg vlad">Normal </label>
                  </td>
                  <td>

                    <input <?php echo ($Row['upper_extreme_right'] == 'Normal') ?  "checked" : "";  ?> type="checkbox" value="0" name="r3" class="css-checkbox lrg"> <label for="checkbox69" name="checkbox69_lbl" class="css-label lrg vlad">Normal </label>

                  </td>
                </tr>

                <tr>
                  <td>

                    <input <?php echo ($Row['upper_extreme_left'] == 'With Disability') ?  "checked" : "";  ?> type="checkbox" value="0" name="r3" class="css-checkbox lrg">
                    <label for="checkbox69" name="checkbox69_lbl" class="css-label lrg vlad">With Disability </label>
                  </td>
                  <td>

                    <input <?php echo ($Row['upper_extreme_right'] == 'With Disability') ?  "checked" : "";  ?> type="checkbox" value="0" name="r3" class="css-checkbox lrg">
                    <label for="checkbox69" name="checkbox69_lbl" class="css-label lrg vlad">With Disability </label>
                  </td>
                </tr>


                <tr>
                  <td>

                    <input type="checkbox" <?php echo ($Row['upper_extreme_left'] == 'With Special Equipment') ?  "checked" : "";  ?> value="0" name="r3" class="css-checkbox lrg">
                    <label for="checkbox69" name="checkbox69_lbl" class="css-label lrg vlad">With Special Equipment </label>
                  </td>
                  <td>

                    <input type="checkbox" <?php echo ($Row['upper_extreme_right'] == 'With Special Equipment') ?  "checked" : "";  ?> value="0" name="r3" class="css-checkbox lrg">
                    <label for="checkbox69" name="checkbox69_lbl" class="css-label lrg vlad">With Special Equipment </label>
                  </td>
                </tr>
              </Table>

            </td>

            <td style="width:25%; " colspan="2">

              <Table style="width:100%; ">
                <tr style="text-align: left;">
                  <th>LEFT</th>
                  <th>RIGHT</th>
                </tr>

                <tr>
                  <td>

                    <input type="checkbox" value="0" name="r3" <?php echo ($Row['lower_extreme_left'] == 'Normal') ?  "checked" : "";  ?> class="css-checkbox lrg"> <label for="checkbox69" name="checkbox69_lbl" class="css-label lrg vlad">Normal </label>
                  </td>
                  <td>

                    <input type="checkbox" value="0" name="r3" <?php echo ($Row['lower_extreme_right'] == 'Normal') ?  "checked" : "";  ?> class="css-checkbox lrg"> <label for="checkbox69" name="checkbox69_lbl" class="css-label lrg vlad">Normal </label>
                  </td>
                </tr>

                <tr>
                  <td>
                    <label>
                      <input type="checkbox" value="0" name="r3" <?php echo ($Row['lower_extreme_left'] == 'With Disability') ?  "checked" : "";  ?> class="css-checkbox lrg">
                      <label for="checkbox69" name="checkbox69_lbl" class="css-label lrg vlad">With Disability </label>
                  </td>
                  <td>
                    <label>
                      <input type="checkbox" <?php echo ($Row['lower_extreme_right'] == 'With Disability') ?  "checked" : "";  ?> value="0" name="r3" class="css-checkbox lrg">
                      <label for="checkbox69" name="checkbox69_lbl" class="css-label lrg vlad">With Disability </label>
                  </td>
                </tr>

                <tr>
                  <td>
                    <input type="checkbox" value="0" name="r3" <?php echo ($Row['lower_extreme_left'] == 'With Special Equipment') ?  "checked" : "";  ?> class="css-checkbox lrg">
                    <label for="checkbox69" name="checkbox69_lbl" class="css-label lrg vlad">With Special Equipment </label>
                  </td>
                  <td>
                    <input type="checkbox" value="0" name="r3" <?php echo ($Row['lower_extreme_right'] == 'With Special Equipment') ?  "checked" : "";  ?> class="css-checkbox lrg">
                    <label for="checkbox69" name="checkbox69_lbl" class="css-label lrg vlad">With Special Equipment </label>
                  </td>
                </tr>
              </Table>

            </td>
          </tr>

        </table>
      </td>



    </tr>
    <!------------------------------PHYSICAL  VISUAL-------------------------------------------------->
    <?php
    $r_color = "Brown";
    $l_color = "Brown";
    if ($Row['eye_color_left'] == "1") {
      $l_color = "Black";
    } else
      if ($Row['eye_color_left'] == "2") {
      $l_color = "Brown";
    } else
      if ($Row['eye_color_left'] == "3") {
      $l_color = "Gray";
    } else
      if ($Row['eye_color_left'] == "4") {
      $l_color = "Other";
    } else
      if ($Row['eye_color_left'] == "5") {
      $l_color = "Blue";
    }


    if ($Row['eye_color_right'] == "1") {
      $r_color = "Black";
    } else
      if ($Row['eye_color_right'] == "2") {
      $r_color = "Brown";
    } else
      if ($Row['eye_color_right'] == "3") {
      $r_color = "Gray";
    } else
      if ($Row['eye_color_right'] == "4") {
      $r_color = "Other";
    } else
      if ($Row['eye_color_right'] == "5") {
      $r_color = "Blue";
    }
    ?>

    <tr style="">

      <td colspan="2" style=" padding-top: 5px; " valign="top">
        <Table style="width:100%; ">
          <TR style="">
            <TH style="width:60%; border: 1px solid black;  padding-top: 5px;  " valign="top">

              <table style="text-align: left; width:100%;">

                <tr>
                  <Th colspan="1" style="text-align: center;border: 1px solid black;"> VISUAL TEST

                  </Th>
                </tr>


                <TR>
                  <Th colspan="0" style="padding-left: 10px;">Visual Acuity

                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                    Right Eye Color : <?php echo $r_color; ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    Left Eye Color: <?php echo $l_color; ?>
                  </Th>
                </TR>
                <tr>
                  <td style="padding-left: 10px;">

                    <input type="checkbox" value="0" name="r3" class="css-checkbox lrg">
                    <label for="checkbox69" name="checkbox69_lbl" class="css-label lrg vlad">With Corrective Lens </label>
                    </br>
                    <input type="checkbox" value="0" name="r3" class="css-checkbox lrg">
                    <label for="checkbox69" name="checkbox69_lbl" class="css-label lrg vlad"> Color Blind </label>
                  </td>
                </tr>



                <tr>
                  <td style="padding-left: 10px;">

                <TR>
                  <Td style="padding-left: 10px;">
                    <h5>LEFT EYE: SNELLEN/BAILEY-LOVIE <span style="border-bottom: 1pt solid black; text-align: center;  width:150px ">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $Row['eye_vision_left'] ?>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></h5>
                  </Td>
                </TR>
                <tr>
                  <td style="padding-left: 10px;">

                    <input type="checkbox" value="0" name="r3" class="css-checkbox lrg" <?php echo ($Row['eye_left_correction'] == 'correction_left') ?  "checked" : "";  ?>>
                    <label for="checkbox69" name="checkbox69_lbl" class="css-label lrg vlad"> With Corrective Lens </label>
                    </br>

                    <input type="checkbox" value="0" name="r3" class="css-checkbox lrg" <?php echo ($Row['eye_vision_other_left'] == '0') ?  "checked" : "";  ?>>
                    <label for="checkbox69" name="checkbox69_lbl" class="css-label lrg vlad"> Color Blind </label>
                  </td>
                </tr>
                <TR>
                  <Td style="padding-left: 10px;">
                    <h5>RIGHT EYE: SNELLEN/BAILEY-LOVIE <span style="border-bottom: 1pt solid black; text-align: center;  width:150px ">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $Row['eye_vision_right'] ?>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></h5>
                  </Td>
                </TR>
                <tr>
                  <td style="padding-left: 10px;">

                    <input type="checkbox" value="0" name="r3" class="css-checkbox lrg" <?php echo ($Row['eye_right_correction'] == 'correction_right') ?  "checked" : "";  ?>>
                    <label for="checkbox69" name="checkbox69_lbl" class="css-label lrg vlad"> With Corrective Lens </label></br>

                    <input type="checkbox" value="0" name="r3" class="css-checkbox lrg" <?php echo ($Row['eye_vision_other_right'] == '0') ?  "checked" : "";  ?>>
                    <label for="checkbox69" name="checkbox69_lbl" class="css-label lrg vlad"> Color Blind </label>
                  </td>
                </tr>
              </table>

              </br>

              <Table style="width: 100%;">
                <tr>
                  <th colspan="1" style="text-align: center;border: 1px solid black;">METABOLIC AND NEUROLOGICAL DISORDER</th>
                </tr>

                <tr>
                  <td>

                    <input type="checkbox" value="0" name="r3" class="css-checkbox lrg" <?php echo ($Row['diabetes'] == '1') ?  "checked" : "";  ?>>
                    <label for="checkbox69" name="checkbox69_lbl" class="css-label lrg vlad"> Yes </label>

                    <input type="checkbox" value="0" name="r3" class="css-checkbox lrg" <?php echo ($Row['diabetes'] == '0') ?  "checked" : "";  ?>>
                    <label for="checkbox69" name="checkbox69_lbl" class="css-label lrg vlad"> No </label>
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    DIABETES
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    Medicine in take (<?php echo $Row['med_diabetes']; ?>)

                  </td>


                </tr>

                <tr>
                  <td>
                    is it under proper control or medication?
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;

                    <input type="checkbox" value="0" name="r3" class="css-checkbox lrg" <?php echo ($Row['under_medication_diabetes'] == '1') ?  "checked" : "";  ?>>
                    <label for="checkbox69" name="checkbox69_lbl" class="css-label lrg vlad"> Yes </label>

                    <input type="checkbox" value="0" name="r3" class="css-checkbox lrg" <?php echo ($Row['under_medication_diabetes'] == '0') ?  "checked" : "";  ?>>
                    <label for="checkbox69" name="checkbox69_lbl" class="css-label lrg vlad"> No </label>

                  </td>
                </tr>



                <tr>
                  <td>
                    <input type="checkbox" value="0" name="r3" <?php echo ($Row['epilepsy'] == '1') ?  "checked" : "";  ?> class="css-checkbox lrg">
                    <label for="checkbox69" name="checkbox69_lbl" class="css-label lrg vlad"> Yes </label>
                    <input type="checkbox" value="0" name="r3" <?php echo ($Row['epilepsy'] == '0') ?  "checked" : "";  ?> class="css-checkbox lrg">
                    <label for="checkbox69" name="checkbox69_lbl" class="css-label lrg vlad"> No </label>
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    EPILEPSY
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    Date of last seizure<u><?php echo $Row['date_seizure']; ?> </u>
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    Medicine in take (<?php echo $Row['med_epilepsy']; ?>)

                  </td>
                </tr>
                <tr>
                  <td>
                    is it under proper control or medication?
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;

                    <input type="checkbox" value="0" name="r3" <?php echo ($Row['under_medication_epilepsy'] == '1') ?  "checked" : "";  ?> class="css-checkbox lrg">
                    <label for="checkbox69" name="checkbox69_lbl" class="css-label lrg vlad"> Yes </label>

                    <input type="checkbox" value="0" name="r3" <?php echo ($Row['under_medication_epilepsy'] == '0') ?  "checked" : "";  ?> class="css-checkbox lrg">
                    <label for="checkbox69" name="checkbox69_lbl" class="css-label lrg vlad"> No </label>

                  </td>
                </tr>
                <tr>
                  <td>

                    <input type="checkbox" value="0" name="r3" <?php echo ($Row['sleep_apnes'] == '1') ?  "checked" : "";  ?> class="css-checkbox lrg">
                    <label for="checkbox69" name="checkbox69_lbl" class="css-label lrg vlad"> Yes </label>

                    <input type="checkbox" value="0" name="r3" <?php echo ($Row['sleep_apnes'] == '0') ?  "checked" : "";  ?> class="css-checkbox lrg">
                    <label for="checkbox69" name="checkbox69_lbl" class="css-label lrg vlad"> No </label>
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;

                    SLEEP APNEA
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    Medicine in take (<?php echo $Row['med_apnea']; ?>)
                  </td>
                </tr>
                <tr>
                  <td>
                    is it under proper control or medication?
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;

                    <input type="checkbox" value="0" name="r3" <?php echo ($Row['under_medication_apnes'] == '1') ?  "checked" : "";  ?> class="css-checkbox lrg">
                    <label for="checkbox69" name="checkbox69_lbl" class="css-label lrg vlad"> Yes </label>

                    <input type="checkbox" value="0" name="r3" <?php echo ($Row['under_medication_apnes'] == '0') ?  "checked" : "";  ?> class="css-checkbox lrg">
                    <label for="checkbox69" name="checkbox69_lbl" class="css-label lrg vlad"> No </label>

                  </td>
                </tr>




                <tr>
                  <td>
                    <input type="checkbox" value="0" name="r3" <?php echo ($Row['aggressive_depressive_order'] == '1') ?  "checked" : "";  ?> class="css-checkbox lrg">
                    <label for="checkbox69" name="checkbox69_lbl" class="css-label lrg vlad"> Yes </label>
                    <input type="checkbox" value="0" name="r3" <?php echo ($Row['aggressive_depressive_order'] == '0') ?  "checked" : "";  ?> class="css-checkbox lrg">
                    <label for="checkbox69" name="checkbox69_lbl" class="css-label lrg vlad"> No </label>
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;

                    AGGRESSIVE,MANIC OR DEPRESSIVE DISORDER
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    Medicine in take (<?php echo $Row['med_disorder']; ?>)
                  </td>
                </tr>



                <tr>
                  <td>
                    is it under proper control or medication?
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;

                    <input type="checkbox" value="0" name="r3" <?php echo ($Row['under_medication_aggressive'] == '1') ?  "checked" : "";  ?> class="css-checkbox lrg">
                    <label for="checkbox69" name="checkbox69_lbl" class="css-label lrg vlad">Yes </label>
                    <input type="checkbox" value="0" name="r3" <?php echo ($Row['under_medication_aggressive'] == '0') ?  "checked" : "";  ?> class="css-checkbox lrg">
                    <label for="checkbox69" name="checkbox69_lbl" class="css-label lrg vlad"> No </label>

                  </td>
                </tr>





                <tr>
                  <td>
                    <input type="checkbox" value="0" name="r3" class="css-checkbox lrg" <?php echo ($Row['other'] == '1') ?  "checked" : "";  ?>>
                    <label for="checkbox69" name="checkbox69_lbl" class="css-label lrg vlad"> Yes </label>
                    <input type="checkbox" value="0" name="r3" class="css-checkbox lrg" <?php echo ($Row['other'] == '0') ?  "checked" : "";  ?>>
                    <label for="checkbox69" name="checkbox69_lbl" class="css-label lrg vlad"> No </label>
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;

                    OTHER MEDICAL CONDITION OR IMPAIRMENT WHICH MAY AFFECT ABILITY TO DRIVE SAFELY
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    Medicine in take (<?php echo $Row['med_other']; ?>)
                  </td>
                </tr>



                <tr>
                  <td>
                    is it under proper control or medication?
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;

                    <input type="checkbox" value="0" name="r3" class="css-checkbox lrg" <?php echo ($Row['under_medication_other'] == '1') ?  "checked" : "";  ?>>
                    <label for="checkbox69" name="checkbox69_lbl" class="css-label lrg vlad"> Yes</label>
                    <input type="checkbox" value="0" name="r3" class="css-checkbox lrg" <?php echo ($Row['under_medication_other'] == '0') ?  "checked" : "";  ?>>
                    <label for="checkbox69" name="checkbox69_lbl" class="css-label lrg vlad"> No </label>

                  </td>
                </tr>
              </Table>




            </TH>
            <TH style="width:2%; "></TH>
            <TH style="width:38%; border: 1px solid black;  padding-top: 5px; " valign="top">



              <!------------------------------AUDITORY  TEST-------------------------------------------------->
              <table style="width:100%; ">
                <tr>
                  <Th colspan="2" style="text-align: center;border: 1px solid black;"> AUDITORY TEST</Th>
                </tr>
                <tr>
                  <th colspan="" style="padding-left: 10px;">LEFT EAR</th>
                  <th colspan="" style="padding-left: 10px;">RIGHT EAR</th>
                </tr>
                <tr>
                  <td style="padding-left: 10px;">

                    <input type="checkbox" value="0" name="r3" class="css-checkbox lrg" <?php echo ($Row['hearing_left'] == '1') ?  "checked" : "";  ?>>
                    <label for="checkbox69" name="checkbox69_lbl" class="css-label lrg vlad"> Normal </label></br>
                    <input type="checkbox" value="0" name="r3" class="css-checkbox lrg" <?php echo ($Row['hearing_left'] == '2') ?  "checked" : "";  ?>>
                    <label for="checkbox69" name="checkbox69_lbl" class="css-label lrg vlad">Reduce </label>
                    </br>

                    <input type="checkbox" value="0" name="r3" class="css-checkbox lrg" <?php echo ($Row['hearing_left'] == '3') ?  "checked" : "";  ?>>
                    <label for="checkbox69" name="checkbox69_lbl" class="css-label lrg vlad"> With hearing aid </label>
                  </td>

                  <td style="padding-left: 10px;">

                    <input type="checkbox" value="0" name="r3" class="css-checkbox lrg" <?php echo ($Row['hearing_right'] == '1') ?  "checked" : "";  ?>>
                    <label for="checkbox69" name="checkbox69_lbl" class="css-label lrg vlad"> Normal </label>
                    </br>

                    <input type="checkbox" value="0" name="r3" class="css-checkbox lrg" <?php echo ($Row['hearing_right'] == '2') ?  "checked" : "";  ?>>
                    <label for="checkbox69" name="checkbox69_lbl" class="css-label lrg vlad">Reduce </label>
                    </br>

                    <input type="checkbox" value="0" name="r3" class="css-checkbox lrg" <?php echo ($Row['hearing_right'] == '3') ?  "checked" : "";  ?>>
                    <label for="checkbox69" name="checkbox69_lbl" class="css-label lrg vlad"> With hearing aid </label>
                  </td>

                </tr>
              </table>


              </br>

              <!------------------------------ASSESSMENT-------------------------------------------------->
              <table style="width:100%; ">
                <tr>
                  <Th colspan="2" style="text-align: center;border: 1px solid black;"> ASSESSMENT</Th>
                </tr>
                <tr>
                  <th colspan="" style="padding-left: 10px;">

                  </th>
                  <th colspan=""></th>
                <tr align="left">
                  <th colspan="" style="padding-left: 10px;">
                    <input type="checkbox" value="0" name="r3" class="css-checkbox lrg" <?php echo ($Row['assessment'] == '1') ?  "checked" : "";  ?>>
                    <label for="checkbox69" name="checkbox69_lbl" class="css-label lrg vlad"> Fit to drive </label>
                    </br>

                    <input type="checkbox" value="0" name="r3" class="css-checkbox lrg" <?php echo ($Row['assessment'] == '2') ?  "checked" : "";  ?>>
                    <label for="checkbox69" name="checkbox69_lbl" class="css-label lrg vlad"> Unfit to Drive</label></br>
                    <Div style="margin-left: 25px;">

                      <input type="checkbox" value="0" name="r3" class="css-checkbox lrg" <?php echo ($Row['assessment'] == '4') ?  "checked" : "";  ?>>
                      <label for="checkbox69" name="checkbox69_lbl" class="css-label lrg vlad"> Permanent </label></br>

                      <input type="checkbox" value="0" name="r3" class="css-checkbox lrg" <?php echo ($Row['assessment'] == '3') ?  "checked" : "";  ?>>
                      <label for="checkbox69" name="checkbox69_lbl" class="css-label lrg vlad"> Temporary </label></br>

                      <input type="checkbox" value="0" name="r3" class="css-checkbox lrg" <?php echo ($Row['assessment'] == '5') ?  "checked" : "";  ?>>
                      <label for="checkbox69" name="checkbox69_lbl" class="css-label lrg vlad"> Refer to Specialist for Further Evaluation </label>
                    </Div>


                  </th>
                  <th colspan=""></th>
                </tr>
              </table>

              </br>

              <!------------------------------CONDITIONS-------------------------------------------------->
              <table style="width:100%; ">
                <tr>
                  <Th colspan="2" style="text-align: center;border: 1px solid black;"> CONDITIONS </Th>
                </tr>
                <tr>
                  <th colspan="" style="padding-left: 10px;" align="left">

                    <?php
                    // if(strpos( $Row['condition_driving'], '4' ) !== false) {
                    //   echo "yes";
                    // }else{
                    //   echo "no";
                    // }

                    ?>


                    <input type="checkbox" value="0" name="r3" class="css-checkbox lrg" <?php echo (strpos($Row['condition_driving'], '0') !== false ||  $Row['condition_driving'] === "") ?  "checked" : "";  ?>>
                    <label for="checkbox69" name="checkbox69_lbl" class="css-label lrg vlad">None </label></br>

                    <input type="checkbox" value="0" name="r3" class="css-checkbox lrg" <?php echo (strpos($Row['condition_driving'], '1') !== false)  ?  "checked" : "";  ?>>
                    <label for="checkbox69" name="checkbox69_lbl" class="css-label lrg vlad">Drive only with corrective lens </label></br>


                    <input type="checkbox" value="0" name="r3" class="css-checkbox lrg" <?php echo (strpos($Row['condition_driving'], '2') !== false) ?  "checked" : "";  ?>>
                    <label for="checkbox69" name="checkbox69_lbl" class="css-label lrg vlad"> Drive only with special equipment for upper limbs </label></br></br>


                    <input type="checkbox" value="0" name="r3" class="css-checkbox lrg" <?php echo (strpos($Row['condition_driving'], '3') !== false) ?  "checked" : "";  ?>>
                    <label for="checkbox69" name="checkbox69_lbl" class="css-label lrg vlad">Drive only with special equipment for lower limbs </label></br></br>

                    <input type="checkbox" value="0" name="r3" class="css-checkbox lrg" <?php echo (strpos($Row['condition_driving'], '4') !== false) ?  "checked" : "";  ?>>
                    <label for="checkbox69" name="checkbox69_lbl" class="css-label lrg vlad"> Drive only during daylight</label></br>

                    <input type="checkbox" value="0" name="r3" class="css-checkbox lrg" <?php echo (strpos($Row['condition_driving'], '5') !== false) ?  "checked" : "";  ?>>
                    <label for="checkbox69" name="checkbox69_lbl" class="css-label lrg vlad"> Drive with hearing aid</label>



                  </th>
                  <th colspan="">

                    <div id="qrcode"></div>

                    <script>
                      let qrcode = new QRCode("qrcode", "https://systechph-medical.com/pages/import/search.php?internal_reference_no=<?= $Row['internal_reference_no'] ?>");
                    </script>


                    <?php
                    // // Include the qrlib file 
                    // include '../phpqrcode/qrlib.php';
                    // $text = "https://systechph-medical.com/pages/import/search.php?internal_reference_no=" . ($Row['internal_reference_no']);

                    // // $path variable store the location where to  
                    // // store image and $file creates directory name 
                    // // of the QR code file by using 'uniqid' 
                    // // uniqid creates unique id based on microtime 
                    // $path = 'images/';
                    // $file = $path . $Row['internal_reference_no'] . ".png";

                    // // $ecc stores error correction capability('L') 
                    // $ecc = 'L';
                    // $pixel_Size = 10;
                    // $frame_Size = 10;
                    // if (file_exists("images/" . $Row['internal_reference_no'] . ".png")) {
                    // } else {
                    //   // Generates QR Code and Stores it in directory given 
                    //   QRcode::png($text, $file, $ecc, $pixel_Size, $frame_size);
                    // }


                    // // Displaying the stored QR code from directory 
                    // echo "<center><img src='" . $file . "' style='width:120px;'></center>";
                    ?>
                  </th>
                </tr>
              </table>

            </TH>

          </TR>

        </Table>

      </td>

    </tr>

  </Table>

  <table style="width:100%; word-wrap: break-word;">

    <tr>
      <td style="width:60%;  ">
        <TABLE style="width:100%;">
          <TR>
            <td style="width:20%;">PHYSICIAN</td>
            <td style="border-bottom: 1pt solid black; "><?php echo $Row['doc_fullname'] ?></td>
          </TR>

          <TR>
            <td style="width:40%;">PRC LICENSE NUMBER</td>
            <td style="border-bottom: 1pt solid black; "><?php echo $Row['prc_license_number'] ?></td>
          </TR>

          <TR>
            <td style="width:40%;">PTR NUMBER</td>
            <td style="border-bottom: 1pt solid black; "><?php echo $Row['ptr_number'] ?></td>
          </TR>
          <TR>
            <td style="width:40%;">ISSUED AT</td>
            <td style="border-bottom: 1pt solid black; "><?php echo $Row['clinicname'] ?></td>
          </TR>
          <TR>
            <td style="width:40%;">CERTIFICATE NUMBER #</td>
            <td style="border-bottom: 1pt solid black; ">
              <h1><?php echo $Row['uid'] ?></h1>
            </td>
          </TR>
          <TR>
            <td style="width:40%;">SIGNATURE</td>
            <td style="border-bottom: 1pt solid black; "></td>
          </TR>
        </TABLE>
      </td>
      <TD>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</TD>

      <TD>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</TD>
      <td style="width:52%; ">
        <TABLE style="width:100%;">
          <TR>
            <td colspan="2">Remarks</td>
          </TR>
          <TR>
            <td colspan="2"> <?php echo $Row['remarks'];  ?> </td>
          </TR>
          <TR>
            <td colspan="2">&nbsp;</td>
          </TR>

          <TR>
            <td style="width:50%;">DATE ISSUED</td>
            <td style="border-bottom: 1pt solid black; "><?php
                                                          //  $today=date('F j, Y'); 
                                                          $today = $Row['date_created'];
                                                          $today = date('F j, Y H:i:s', strtotime($today));
                                                          echo $today; ?></td>
          </TR>
          <TR>
            <td style="width:20%;">THIS MEDICAL CERTIFICATE IS VALID UNTIL</td>
            <td style="border-bottom: 1pt solid black; "><?php
                                                          $current_date = date($today, strtotime("+60 days"));
                                                          $current_date = strtotime($current_date);
                                                          $from_date = date('F j, Y', strtotime("+60 days", strtotime($today)));
                                                          echo $from_date;

                                                          ?></td>
          </TR>
          <TR>
            <td colspan="2" style="width:80%;"><sTRONG>(60 DAYS FROM DATE ISSUE)</sTRONG></td>
          </TR>

        </TABLE>
      </td>
    </tr>

  </table>
</center>


<?php
clearstatcache();

?>