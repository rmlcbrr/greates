    <!-- Step 2 -->
                    <section id="step-2">
                        <div class="row g-3">
                            <div class="col-lg-6">
                                <div class="card h-100 p-3">
                                    <h5 class="text-secondary">PHYSICAL EXAMINATION</h5>
                                    <div class="p-3">
                                        <div class="input-group mb-3">
                                            <label class="input-group-text" for="inputGroupSelect01">Height</label>
                                            <input  value="<?php echo $Row['height']?>"  type="text" class="form-control required_item2" id="heights" placeholder="Input Height"
                                                aria-describedby="addon-wrapping"  required>
                                        </div>
                                        <div class="input-group flex-nowrap mb-3">
                                            <span class="input-group-text ">Weight</span>
                                            <input  value="<?php echo $Row['weight']?>"   type="text" class="form-control required_item2" placeholder="Input Weight"
                                                aria-describedby="addon-wrapping" id="weights" required>
                                        </div>
                                        <div class="input-group mb-3">
                                            <label class="input-group-text" for="inputGroupSelect01">Blood Type</label>
                                            <select class="form-select" id="blood_types" required>
                                                                 <option <?php if($Row['blood_type']=="O positive"){  echo "selected";}?> >O positive</option>
                    <option <?php if($Row['blood_type']=="O negative"){  echo "selected";}?> >O negative</option>
                     <option <?php if($Row['blood_type']=="A positive"){  echo "selected";}?> >A positive</option>
                    <option <?php if($Row['blood_type']=="A negative"){  echo "selected";}?> >A negative</option>
                     <option <?php if($Row['blood_type']=="B positive"){  echo "selected";}?> >B positive</option>
                    <option <?php if($Row['blood_type']=="B negative"){  echo "selected";}?> >B negative</option>
                     <option <?php if($Row['blood_type']=="AB positive"){  echo "selected";}?> >AB positive</option>
                    <option <?php if($Row['blood_type']=="AB negative"){  echo "selected";}?> >AB negative</option>
                     <option  <?php if($Row['blood_type']==""){  echo "selected";}?> >DID NOT PROVIDE</option>

                                            </select>
                                        </div>
                                        <div class="input-group flex-nowrap mb-3">
                                            <span class="input-group-text" id="addon-wrapping">BP</span>
                                            <input value="<?php echo $Row['bp']?>"   type="text" class="form-control" placeholder="--/--"
                                                aria-describedby="addon-wrapping" id="bp" required>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6 mb-4">
                                <div class="card h-50 p-3">
                                    <h5 class="text-secondary">General Physique</h5>
                                    <div class="p-3">
                                        <div class="d-flex justify-content-center">

                                            <div class="form-check form-check-inline">
                                                <input <?php echo ($Row['general_physique']== '0') ?  "checked" : "" ;  ?>  class="form-check-input" type="radio"  value="0" name="general_physique"
                                                    id="general_physique" checked>
                                                <label class="form-check-label fw-bold"
                                                    for="physiqueNormalRadio">Normal</label>
                                            </div>

                                            <div class="form-check form-check-inline">
                                                <input  class="form-check-input" type="radio" name="general_physique"
                                                    value="1" name="general_disabilities"  id="general_disabilities">
                                                <label class="form-check-label fw-bold"
                                                    for="physiqueDisabilityRadio">With Disability</label>
                                            </div>
                                        </div>
                                        <div id="physiqueDisability" class="d-flex justify-content-center mt-3"
                                            style="display: none;">
                                            <input  value="<?php echo $Row['general_physique_reason']?>"  type="text" class="form-control" id="gen_phys_text"
                                                placeholder="Input Reason">
                                        </div>
                                    </div>
                                </div>
                                <div class="card h-50 p-3">
                                    <h5 class="text-secondary">Contagious Disease</h5>
                                    <div class="p-3">
                                        <div class="d-flex justify-content-center">
                                            <div class="form-check form-check-inline">

                                                <input  <?php echo ($Row['contagious_desiease']== '0') ?  "checked" : "" ;  ?>  class="form-check-input" type="radio" value="0"  name="contagious" id="contagious" checked>
                                                <label class="form-check-label fw-bold"
                                                    for="contaigiousNormalRadio">Normal</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input   <?php echo ($Row['contagious_desiease']== '1') ?  "checked" : "" ;  ?>   class="form-check-input" type="radio" value="1" name="contagious"   id="contagious_disease">
                                                <label class="form-check-label fw-bold"
                                                    for="contaigiousDisabilityRadio">With Disability</label>
                                            </div>
                                        </div>
                                        <div id="contaigiousDisability" class="d-flex justify-content-center mt-3"
                                            style="display: none;">
                                            <input   value="<?php echo $Row['contagious_desiease_reason']?>" type="text" class="form-control" id="cont_disease_text" placeholder="Input Reason">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="card h-100 p-3">
                                    <h5 class="text-secondary text-center">OTHER INFORMATION</h5>
                                    <div class="row justify-content-between">
                                        <div class="col-lg-6">
                                            <h6 class="fw-bold text-center mb-4 mt-4">UPPER EXTREMITIES:</h6>
                                            <div class="input-group mb-3 w-100">
                                                <label class="input-group-text" for="inputGroupSelect01">Left</label>
                                                <select class="form-select" id="upper_exte_left" >
<option  <?php if($Row['upper_extreme_left']=="Normal"){  echo "selected";}?>  value="Normal">Normal</option>
<option  <?php if($Row['upper_extreme_left']=="With Disability"){  echo "selected";}?>   value="With Disability">With Disability</option>
<option <?php if($Row['upper_extreme_left']=="With Special Equipment"){  echo "selected";}?>  value="With Special Equipment">With Special Equipment</option>
                                                </select>
                                            </div>
                                            <div class="input-group mb-3 w-100">
                                                <label class="input-group-text" for="inputGroupSelect01">Right</label>
                                                <select class="form-select" id="upper_exte_right" >
<option  <?php if($Row['upper_extreme_right']=="Normal"){  echo "selected";}?>  value="Normal">Normal</option>
<option  <?php if($Row['upper_extreme_right']=="With Disability"){  echo "selected";}?>   value="With Disability">With Disability</option>
<option <?php if($Row['upper_extreme_right']=="With Special Equipment"){  echo "selected";}?>  value="With Special Equipment">With Special Equipment</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6" style="border-left: 2px solid gray;">
                                            <h6 class="fw-bold text-center mb-4 mt-4">LOWER EXTREMITIES:</h6>
                                            <div class="input-group mb-3 w-100">
                                                <label class="input-group-text" for="inputGroupSelect01">Left</label>
                                                <select class="form-select" id="lower_exte_left" >
<option  <?php if($Row['lower_extreme_left']=="Normal"){  echo "selected";}?>  value="Normal">Normal</option>
<option  <?php if($Row['lower_extreme_left']=="With Disability"){  echo "selected";}?>   value="With Disability">With Disability</option>
<option <?php if($Row['lower_extreme_left']=="With Special Equipment"){  echo "selected";}?>  value="With Special Equipment">With Special Equipment</option>
                                                </select>
                                            </div>
                                            <div class="input-group mb-3 w-100">
                                                <label class="input-group-text" for="inputGroupSelect01">Right</label>
                                                <select class="form-select" id="lower_exte_right" >
<option  <?php if($Row['lower_extreme_right']=="Normal"){  echo "selected";}?>  value="Normal">Normal</option>
<option  <?php if($Row['lower_extreme_right']=="With Disability"){  echo "selected";}?>   value="With Disability">With Disability</option>
<option <?php if($Row['lower_extreme_right']=="With Special Equipment"){  echo "selected";}?>  value="With Special Equipment">With Special Equipment</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="row py-5">
                                <div class="d-flex gap-2 justify-content-center w-100">
                                    <button id="go-back-to-step-1" class="btn text-dark fw-bold"
                                        style="background-color: #D6D6D6;"> Go back</button>
                                    <button class=" go-to-step-4 btn text-white fw-bold" style="background-color: #520CF3;" > Continue</button>
                                </div>
                            </div>
                        </div>
                    </section>