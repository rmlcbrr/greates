      <!-- Done -->
                    <section id="steps-done">
                        <div class="row g-3 mt-5">
                            <h6 class="fw-bold">CONDITION FOR DRIVING</h6>
                            <div class="col-12">
                                <div class="card h-100 p-4">
                                    <div class="form-check mt-2">
                                         <input <?php echo (strpos( $Row['condition_driving'], '0' )!== false ||  $Row['condition_driving']==="" ) ?  "checked" : "" ;  ?>  type="checkbox" value="" name="condition_driving"  id="condition_driving0" class="flat-red condition_driving0" >   
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            None
                                        </label>
                                    </div>
                                    <div class="form-check mt-2">
                                        <input  <?php echo (strpos( $Row['condition_driving'], '1' )!== false) ?  "checked" : "" ;  ?>  type="checkbox" value="1" name="condition_driving"  id="condition_driving1" class="flat-red condition_driving1 none_checkbox" >  
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            A. Drive only with corrective lens
                                        </label>
                                    </div>
                                    <div class="form-check mt-2">
                                        <input  <?php echo (strpos( $Row['condition_driving'], '2' )!== false) ?  "checked" : "" ;  ?>  type="checkbox" value="2" name="condition_driving"  id="condition_driving2" class="flat-red condition_driving2 none_checkbox" > 
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            B. Drive only with special equipment for upper limbs
                                        </label>
                                    </div>
                                    <div class="form-check mt-2">
                                         <input <?php echo (strpos( $Row['condition_driving'], '3' )!== false) ?  "checked" : "" ;  ?>  type="checkbox" value="3" name="condition_driving"  id="condition_driving3" class="flat-red condition_driving3 none_checkbox" > 
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            C. Drive only with special equipment for lower limbs
                                        </label>
                                    </div>
                                    <div class="form-check mt-2">
                                          <input  <?php echo (strpos( $Row['condition_driving'], '4' )!== false) ?  "checked" : "" ;  ?>  type="checkbox" value="4" name="condition_driving"  id="condition_driving4" class="flat-red condition_driving4 none_checkbox" >  
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            D. Drive only during daylight
                                        </label>
                                    </div>
                                    <div class="form-check mt-2">
                                         <input  <?php echo (strpos( $Row['condition_driving'], '5' )!== false) ?  "checked" : "" ;  ?>  type="checkbox" value="5" name="condition_driving"  id="condition_driving5" class="flat-red condition_driving5 none_checkbox"  > 
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            E. Drive only with hearing aid or accompanied by a person with normal
                                            hearing.
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <h6 class="fw-bold">ASSESSMENT</h6>
                            <div class="col-12">
                                <div class="card h-100 p-4">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <div class="form-check mt-2">
                                                <input   <?php echo ($Row['assessment']== '1') ?  "checked" : "" ;  ?> class="form-check-input" type="radio" alue="1" name="driver_assessment" id="driver_assessment"  checked>
                                                <label class="form-check-label" for="flexRadioDefault1">
                                                    Fit to drive
                                                </label>
                                            </div>
                                            <div class="form-check mt-2">
                                                <input  <?php echo ($Row['assessment']== '2') ?  "checked" : "" ;  ?>  class="form-check-input" type="radio"  value="2" name="driver_assessment"  >
                                                <label class="form-check-label" for="flexRadioDefault1">
                                                    Unfit to drive
                                                </label>
                                            </div>
                                            <div class="form-check mt-2">
                                                <input   <?php echo ($Row['assessment']== '3') ?  "checked" : "" ;  ?>  class="form-check-input" type="radio" value="3" name="driver_assessment" >
                                                <label class="form-check-label" for="flexRadioDefault1">
                                                    Temporary
                                                </label>
                                            </div>
                                            <div class="form-check mt-2">
                                                <input  <?php echo ($Row['assessment']== '4') ?  "checked" : "" ;  ?>  class="form-check-input" type="radio" value="4" name="driver_assessment" >
                                                <label class="form-check-label" for="flexRadioDefault1">
                                                    Unfit to drive permanent
                                                </label>
                                            </div>
                                            <div class="form-check mt-2">
                                                <input   <?php echo ($Row['assessment']== '5') ?  "checked" : "" ;  ?>   class="form-check-input" type="radio" value="5" name="driver_assessment" >
                                                <label class="form-check-label" for="flexRadioDefault1">
                                                    Refer to specialist for further evaluation
                                                </label>
                                            </div>
                                      
                                        </div>
                                        <div class="align-self-start">
                                            <label class="ms-4 mb-2">Duration if Temporary:</label>
                                     
                                              <select class="form-control" id="duration_temporary"  style="width:100%; ">
                                            <?php
for($a=1;$a<60;$a++){
  if($Row['durations']==$a){
echo "<option selected=''>".$a."</option>";

  }else{
echo "<option >".$a."</option>";
    }
}
 ?>
     
                                             </select>  
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <h6 class="fw-bold">RECOMMENDATION</h6>
                            <div class="col-12">
                                <div class="card h-100 p-4">
                                    <div class="input-group">
                                        <textarea id="driver_recommendation" class="form-control" rows="4" placeholder="Enter Recommendation"
                                            aria-label="With textarea"><?php echo $Row['remarks']?></textarea>
                                    </div>
                                </div>
                            </div>


                            <div class="row py-5">
                                <div class="d-flex gap-2 justify-content-center w-100">
                                    <button id="go-back-to-step-4" class="btn text-dark fw-bold"
                                        style="background-color: #D6D6D6;"> Go back</button>
                                    <button 
                                        class="btn text-white fw-bold"  id="preview_details" style="background-color: #520CF3;">
                                        Preview</button>
                                </div>
                            </div>
                        </div>
                    </section>