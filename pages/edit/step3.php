   <!-- Step 4 -->
                    <section id="step-4">
                        <div class="row g-5">
                            <div class="col-lg-10 offset-lg-1">
                                <div class="disorder-card card p-4 mb-3">
                                    <h4 class="fw-bold text-center">METABOLIC AND NEUROLOGICAL DISORDERS</h4>
                                </div>
                            </div>
                            <!-- Diabetes -->
                            <div class="col-lg-6 offset-lg-3">
                                <div class="disorder-card card h-100 p-3">
                                    <div class="py-3 text-center">
                                        <h5 class="fw-bold mb-4">Diabetes</h5>
                                        <div class="form-check form-check-inline">
                                            <input <?php echo ($Row['diabetes']== '1') ?  "checked" : "" ;  ?> class="form-check-input" type="radio" value="1" name="metabolic_diabetes" id="diabetes1">
                                            <label  class="form-check-label fw-bold" for="diabetesYes">Yes</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input  <?php echo ($Row['diabetes']== '0') ?  "checked" : "" ;  ?> class="form-check-input" type="radio" value="0" name="metabolic_diabetes" id="diabetes" checked>
                                            <label class="form-check-label fw-bold" for="diabetesNo">No</label>
                                        </div>
                                        <div id="diabetes-content" class="justify-content-center mt-3">
                                            <h5>Is is under proper control or medication?</h5>
                                            <div class="form-check form-check-inline mt-2">
                                                <input <?php echo ($Row['diabetes']== '1') ?  "" : " disabled" ;  ?>   class="form-check-input" type="radio" value="1" name="under_medication_diabetes" id="diabetes_medic">
                                                <label class="form-check-label fw-bold"
                                                    for="diabetesProperControlYes">Yes</label>
                                            </div>
                                            <div class="form-check form-check-inline mb-4">
                                                <input   <?php echo ($Row['diabetes']== '1') ?  "" : " disabled" ;  ?>   class="form-check-input" type="radio" value="0" name="under_medication_diabetes" id="diabetes_medic2" 
                                                    checked>
                                                <label class="form-check-label fw-bold"
                                                    for="diabetesProperControlNo">No</label>
                                            </div>
                                            <input value="<?php echo $Row['med_diabetes']; ?>"  type="text" class="form-control" id="med_diabetes"
                                                placeholder="Medicine you take (if any)">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Epilepsy -->
                            <div class="col-lg-6 offset-lg-3">
                                <div class="disorder-card card h-100 p-3">
                                    <div class="py-3 text-center">
                                        <h5 class="fw-bold mb-4">Epilepsy</h5>
                    <?php

                    $dseizure=date('m/d/Y',strtotime($Row['date_seizure']));
                    if($dseizure=="01/01/1970"){$dseizure="";}
                    ?>
                                        <div class="form-check form-check-inline">
                                            <input    <?php echo ($Row['epilepsy']== '1') ?  "checked" : "" ;  ?> class="form-check-input" type="radio" value="1" name="metabolic_epilepsy" id="epilepsy1">
                                            <label class="form-check-label fw-bold" for="epilepsyYes">Yes</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input   <?php echo ($Row['epilepsy']== '0') ?  "checked" : "" ;  ?> class="form-check-input" type="radio" value="0" name="metabolic_epilepsy" id="epilepsy"checked>
                                            <label class="form-check-label fw-bold" for="epilepsyNo">No</label>
                                        </div>
                                        <div id="epilepsy-content" class="justify-content-center mt-5">
                                            <div class="row mb-5">
                                                <div class="col-auto">
                                                    <label for="dateInput" class="mt-1 form-label">Date of last
                                                        seizure:</label>
                                                </div>
                                                <div class="col-auto">
                                                    <input value="<?php echo $dseizure?>"   type="date" id="last_seizure"  class="form-control">
                                                </div>
                                            </div>

                                            <h5>Is is under proper control or medication?</h5>
                                            <div class="form-check form-check-inline mt-2">
                                                <input    <?php echo ($Row['under_medication_epilepsy']== '1') ?  "checked" : "" ;  ?>  class="form-check-input" type="radio"
                                                   value="1" name="metabolic_epilepsy" id="epilepsy1">
                                                <label class="form-check-label fw-bold"
                                                    for="epilepsyProperControlYes">Yes</label>
                                            </div>
                                            <div class="form-check form-check-inline mb-4">
                                                <input   <?php echo ($Row['under_medication_epilepsy']== '0') ?  "checked" : "" ;  ?>  class="form-check-input" type="radio"
                                                   value="0" name="metabolic_epilepsy" id="epilepsy" 
                                                    checked>
                                                <label class="form-check-label fw-bold"
                                                    for="epilepsyProperControlNo">No</label>
                                            </div>
                                            <input value="<?php echo $Row['med_epilepsy']; ?>"  type="text" class="form-control" id="med_epilepsy"
                                                placeholder="Medicine you take (if any)">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Sleep Apnea -->
                            <div class="col-lg-6 offset-lg-3">
                                <div class="disorder-card card h-100 p-3">
                                    <div class="py-3 text-center">
                                        <h5 class="fw-bold mb-4">Sleep Apnea</h5>
                                        <div class="form-check form-check-inline">
                                            <input  <?php echo ($Row['sleep_apnes']== '1') ?  "checked" : "" ;  ?>  class="form-check-input" type="radio" value="1" name="metabolic_apnes" id="apnes1">
                                            <label class="form-check-label fw-bold" for="sleepApneaYes">Yes</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input  <?php echo ($Row['sleep_apnes']== '0') ?  "checked" : "" ;  ?>   class="form-check-input" type="radio"  value="0" name="metabolic_apnes" id="apnes" checked>
                                            <label class="form-check-label fw-bold" for="sleepApneaNo">No</label>
                                        </div>
                                        <div id="sleep-apnea-content" class="justify-content-center mt-5">
                                            <h5>Is is under proper control or medication?</h5>
                                            <div class="form-check form-check-inline mt-2">
                                                <input <?php echo ($Row['under_medication_apnes']== '1') ?  "checked" : "" ;  ?>  class="form-check-input under_medication_apnes" type="radio"
                                                    value="1"  >
                                                <label class="form-check-label fw-bold"
                                                    for="sleepApneaControlYes">Yes</label>
                                            </div>
                                            <div class="form-check form-check-inline mb-4">
                                                <input  <?php echo ($Row['under_medication_apnes']== '0') ?  "checked" : "" ;  ?>  class="form-check-input under_medication_apnes" type="radio"
                                                    
                                                    value="0" >
                                                <label class="form-check-label fw-bold"
                                                    for="sleepApneaControlNo">No</label>
                                            </div>
                                            <input  value="<?php echo $Row['med_apnea']; ?>"  type="text" class="form-control" id="med_apnea"
                                                placeholder="Medicine you take (if any)">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Aggressive Disorder -->
                            <div class="col-lg-6 offset-lg-3">
                                <div class="disorder-card card h-100 p-3">
                                    <div class="py-3 text-center">
                                        <h5 class="fw-bold mb-4">Aggressive, Manic or Depressive Disorder</h5>
                                        <div class="form-check form-check-inline">
                                            <input <?php echo ($Row['aggressive_depressive_order']== '1') ?  "checked" : "" ;  ?>  class="form-check-input" type="radio"  value="1" name="metabolic_aggressive" id="aggressive1" >
                                            <label class="form-check-label fw-bold"
                                                for="aggressiveDisorderYes">Yes</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input  <?php echo ($Row['aggressive_depressive_order']== '0') ?  "checked" : "" ;  ?>  class="form-check-input" type="radio" value="0" name="metabolic_aggressive" id="aggressive"  checked>
                                            <label class="form-check-label fw-bold"
                                                for="aggressiveDisorderNo">No</label>
                                        </div>
                                        
                                        <div id="aggressive-disorder-content" class="justify-content-center mt-5">
                                            <h5>Is is under proper control or medication?</h5>
                                            <div class="form-check form-check-inline mt-2">
                                                <input <?php echo ($Row['under_medication_aggressive']== '1') ?  "checked" : "" ;  ?> class="form-check-input" type="radio"
                                                    value="1" name="under_medication_aggressive" id="medic_aggressive1">
                                                <label class="form-check-label fw-bold"
                                                    for="aggressiveDisorderControlYes">Yes</label>
                                            </div>
                                            <div class="form-check form-check-inline mb-4">
                                                <input <?php echo ($Row['under_medication_aggressive']== '0') ?  "checked" : "" ;  ?> class="form-check-input" type="radio"
                                                    value="0" name="under_medication_aggressive" id="medic_aggressive2"
                                                    checked>
                                                <label class="form-check-label fw-bold"
                                                    for="aggressiveDisorderControlNo">No</label>
                                            </div>
                                            <input value="<?php echo $Row['med_disorder']; ?>"  type="text" class="form-control" id="med_disorder"
                                                placeholder="Medicine you take (if any)">
                                        </div>
                                    </div>
                                </div>
                            </div>


            <!-- Aggressive Disorder -->
                            <div class="col-lg-6 offset-lg-3">
                                <div class="disorder-card card h-100 p-3">
                                    <div class="py-3 text-center">
                                        <h5 class="fw-bold mb-4">Other medical condition or impairment which may affect ability to drive safety</h5>
                                        <div class="form-check form-check-inline">
                                            <input <?php echo ($Row['other']== '1') ?  "checked" : "" ;  ?>  class="form-check-input" type="radio"  value="1" name="metabolic_other" id="others1" >
                                            <label class="form-check-label fw-bold"
                                                for="aggressiveDisorderYes">Yes</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input  <?php echo ($Row['other']== '0') ?  "checked" : "" ;  ?> class="form-check-input" type="radio" value="0" name="metabolic_other" id="others" checked>
                                            <label class="form-check-label fw-bold"
                                                for="aggressiveDisorderNo">No</label>
                                        </div>
                                        <div id="others-disorder-content" class="justify-content-center mt-5">
                                            <h5>Is is under proper control or medication?</h5>
                                            <div class="form-check form-check-inline mt-2">
                                                <input <?php echo ($Row['under_medication_other']== '0') ?  "checked" : "" ;  ?> class="form-check-input" type="radio"
                                                    value="1" name="under_medication_aggressive" id="medic_aggressive1">
                                                <label class="form-check-label fw-bold"
                                                    for="aggressiveDisorderControlYes">Yes</label>
                                            </div>
                                            <div class="form-check form-check-inline mb-4">
                                                <input <?php echo ($Row['under_medication_other']== '0') ?  "checked" : "" ;  ?> class="form-check-input" type="radio"
                                                     value="0" name="under_medication_other" 
                                                    checked>
                                                <label class="form-check-label fw-bold"
                                                    for="aggressiveDisorderControlNo">No</label>
                                            </div>
                                            <input value="<?php echo $Row['med_other']; ?>"  type="text" class="form-control" id="med_other"
                                                placeholder="Medicine you take (if any)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Visual Acuity -->
                            <div class="col-lg-10 offset-lg-1">
                                <div class="disorder-card card p-4 mb-3">
                                    <h4 class="fw-bold text-center">VISUAL ACUITY</h4>
                                </div>
                            </div>

                            <div class="col-lg-6 offset-lg-3">
                                <div class="disorder-card card h-100 p-3">
                                    <div class="py-3 text-center">
                                        <div class="d-flex justify-content-start align-items-center"
                                            style="margin-left: 185px;">
                                            <h6 class="fw-bold">LEFT</h6>
                                            <h6 class="fw-bold" style="margin-left: 41px;">RIGHT</h6>
                                        </div>
                                        <div class="d-flex gap-3 justify-content-start align-items-center">
                                            <h6 class="mb-3 me-4">Snellen/Bailey Lovie</h6>
                                            <p class="p-2 rounded" style="background: #F3F3F3;">

                        <input  value="<?php echo $Row['eye_vision_left']?>"   type="text" style="width:80%; " name="" id="snellen_left" class="form-control" >

                                            </p>
                                            <p class="p-2 rounded" style="background: #F3F3F3;">
                                                
                        <input type="text" style="width:80%; " value="<?php echo $Row['eye_vision_right']?>"  name="" id="snellen_right" class="form-control" checked>

                                            </p>
                                        </div>
                                        <div class="d-flex mb-3 gap-3 justify-content-start align-items-center">
                                            <h6 class="me-3">With Correction Lens</h6>
                                            <div class="form-check">
                                                <input <?php echo ($Row['eye_left_correction']== 'correction_left') ?  "checked" : "" ;  ?> class="form-check-input" type="checkbox" value="correction_left" name="eye_left_correction"  id="eye_left_correction">
                                            </div>
                                            <div class="form-check" style="margin-left: 35px;">
                                                <input  <?php echo ($Row['eye_right_correction']== 'correction_right') ?  "checked" : "" ;  ?> class="form-check-input" type="checkbox"  value="correction_right" name="eye_right_correction"  id="eye_right_correction" >
                                            </div>
                                        </div>
                                        <div class="d-flex mb-3 gap-3 justify-content-start align-items-center">
                                            <h6 class="">Color Blind</h6>
                                            <div class="form-check" style="margin-left: 87px;">
                                                <input  <?php echo ($Row['eye_vision_other_left']== '1') ?  "checked" : "" ;  ?>  class="form-check-input" type="checkbox" value="0" name="eye_left_color" id="eye_left_color" >
                                            </div>
                                            <div class="form-check" style="margin-left: 36px;">
                                                <input <?php echo ($Row['eye_vision_other_right']== '1') ?  "checked" : "" ;  ?> class="form-check-input" type="checkbox"  value="0" name="eye_right_color"   id="eye_right_color">
                                            </div>
                                        </div>

    <?php
      $r_color_br="SELECTED";
      $l_color_br="SELECTED";
      $l_color_bl="";
      $l_color_gr="";
      $l_color_ot="";
      $l_color_ble="";
      $r_color_br="";
      $r_color_gr="";
      $r_color_ot="";
      $r_color_ble="";

      if($Row['eye_color_left']=="1"){ $l_color_bl="SELECTED"; $l_color_br="";}else
      if($Row['eye_color_left']=="2"){ $l_color_br="SELECTED"; $l_color_br="";}else
      if($Row['eye_color_left']=="3"){ $l_color_gr="SELECTED"; $l_color_br="";}else
      if($Row['eye_color_left']=="4"){ $l_color_ot="SELECTED"; $l_color_br="";}else
      if($Row['eye_color_left']=="5"){ $l_color_ble="SELECTED"; $l_color_br="";}


      if($Row['eye_color_right']=="1"){ $r_color_bl="SELECTED";  $r_color_br="";}else
      if($Row['eye_color_right']=="2"){ $r_color_br="SELECTED"; $r_color_br="";}else
      if($Row['eye_color_right']=="3"){ $r_color_gr="SELECTED"; $r_color_br="";}else
      if($Row['eye_color_right']=="4"){ $r_color_ot="SELECTED"; $r_color_br="";}else
      if($Row['eye_color_right']=="5"){ $r_color_ble="SELECTED"; $r_color_br="";}


      ?>

                                        <div class="d-flex gap-3 justify-content-start align-items-center">
        <select class="form-select" aria-label="Default select example"
                                                style="max-width: 100px; margin-left: 75px;" name="eye_left_color_data" id="eye_left_color_data" >
                       <option value="1" <?php echo $l_color_bl; ?>>Black</option>
                      <option  value="2" <?php echo $l_color_br; ?> >Brown</option>
                      <option  value="3" <?php echo $l_color_gr; ?>>Gray</option>
                      <option  value="5" <?php echo $l_color_ble; ?> > Blue</option>
                      <option  value="4" <?php echo $l_color_ot; ?>> Other</option>
                                            </select>
        <select class="form-select" aria-label="Default select example"
                                                style="max-width: 100px;" name="eye_right_color_data"   id="eye_right_color_data"    >
                      <option  value="1"  <?php echo $r_color_bl; ?>>Black</option>
                      <option  value="2"  <?php echo $r_color_br; ?>>Brown</option>
                      <option  value="3"  <?php echo $r_color_gr; ?>>Gray</option>
                      <option  value="5"  <?php echo $r_color_ble; ?>> Blue</option>
                      <option  value="4"  <?php echo $r_color_ot; ?>> Other</option>
                                            </select>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <!-- Hearing -->
                            <div class="col-lg-10 offset-lg-1">
                                <div class="disorder-card card p-4 mb-3">
                                    <h4 class="fw-bold text-center">HEARING</h4>
                                </div>
                            </div>

                            <div class="col-lg-6 offset-lg-3">
                                <div class="disorder-card card h-100 p-3">
                                    <div class="py-3 text-center">
                                        <h5 class="fw-bold mb-4">Hearing</h5>
                                        <div class="input-group mb-3">
                                            <label class="input-group-text" for="inputGroupSelect01">Left</label>
                                            <select class="form-select" name="hearing_left" id="hearing_left" required>
                                                <option <?php if($Row['hearing_left']=="1"){  echo "selected";}?>   value="1" >Normal</option>
                                                <option  <?php if($Row['hearing_left']=="2"){  echo "selected";}?> value="2">Reduced</option>
                                                <option  <?php if($Row['hearing_left']=="3"){  echo "selected";}?> value="3"> With Hearing Aid</option>
                                            </select>
                                        </div>
                                        <div class="input-group mb-3">
                                            <label class="input-group-text" for="inputGroupSelect01">Right</label>
                                            <select class="form-select" name="hearing_right" id="hearing_right" required>
                        <option <?php if($Row['hearing_right']=="1"){  echo "selected";}?>   value="1" >Normal</option>
                        <option  <?php if($Row['hearing_right']=="2"){  echo "selected";}?> value="2">Reduced</option>
                        <option  <?php if($Row['hearing_right']=="3"){  echo "selected";}?> value="3"> With Hearing Aid</option>
                                            </select>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="row py-5">
                                <div class="d-flex gap-2 justify-content-center w-100">
                                    <button id="go-back-to-step-3" class="btn text-dark fw-bold"
                                        style="background-color: #D6D6D6;"> Go back</button>
                                    <button id="go-to-done-steps" class="btn text-white fw-bold"
                                        style="background-color: #520CF3;"> Continue</button>
                                </div>
                            </div>
                        </div>
                    </section>


    