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
                                            <input class="form-check-input" type="radio" value="1" name="metabolic_diabetes" id="diabetes1">
                                            <label class="form-check-label fw-bold" for="diabetesYes">Yes</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" value="0" name="metabolic_diabetes" id="diabetes" checked>
                                            <label class="form-check-label fw-bold" for="diabetesNo">No</label>
                                        </div>
                                        <div id="diabetes-content" class="justify-content-center mt-3">
                                            <h5>Is is under proper control or medication?</h5>
                                            <div class="form-check form-check-inline mt-2">
                                                <input class="form-check-input" type="radio" value="1" name="under_medication_diabetes" id="diabetes_medic">
                                                <label class="form-check-label fw-bold"
                                                    for="diabetesProperControlYes">Yes</label>
                                            </div>
                                            <div class="form-check form-check-inline mb-4">
                                                <input class="form-check-input" type="radio" value="0" name="under_medication_diabetes" id="diabetes_medic2" 
                                                    checked>
                                                <label class="form-check-label fw-bold"
                                                    for="diabetesProperControlNo">No</label>
                                            </div>
                                            <input type="text" class="form-control" id="med_diabetes"
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
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" value="1" name="metabolic_epilepsy" id="epilepsy1">
                                            <label class="form-check-label fw-bold" for="epilepsyYes">Yes</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" value="0" name="metabolic_epilepsy" id="epilepsy"checked>
                                            <label class="form-check-label fw-bold" for="epilepsyNo">No</label>
                                        </div>
                                        <div id="epilepsy-content" class="justify-content-center mt-5">
                                            <div class="row mb-5">
                                                <div class="col-auto">
                                                    <label for="dateInput" class="mt-1 form-label">Date of last
                                                        seizure:</label>
                                                </div>
                                                <div class="col-auto">
                                                    <input type="date" id="last_seizure"  class="form-control">
                                                </div>
                                            </div>

                                            <h5>Is is under proper control or medication?</h5>
                                            <div class="form-check form-check-inline mt-2">
                                                <input class="form-check-input" type="radio"
                                                   value="1" name="metabolic_epilepsy" id="epilepsy1">
                                                <label class="form-check-label fw-bold"
                                                    for="epilepsyProperControlYes">Yes</label>
                                            </div>
                                            <div class="form-check form-check-inline mb-4">
                                                <input class="form-check-input" type="radio"
                                                   value="0" name="metabolic_epilepsy" id="epilepsy" 
                                                    checked>
                                                <label class="form-check-label fw-bold"
                                                    for="epilepsyProperControlNo">No</label>
                                            </div>
                                            <input type="text" class="form-control" id="med_epilepsy"
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
                                            <input class="form-check-input" type="radio" value="1" name="metabolic_apnes" id="apnes1">
                                            <label class="form-check-label fw-bold" for="sleepApneaYes">Yes</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio"  value="0" name="metabolic_apnes" id="apnes" checked>
                                            <label class="form-check-label fw-bold" for="sleepApneaNo">No</label>
                                        </div>
                                        <div id="sleep-apnea-content" class="justify-content-center mt-5">
                                            <h5>Is is under proper control or medication?</h5>
                                            <div class="form-check form-check-inline mt-2">
                                                <input class="form-check-input under_medication_apnes" type="radio"
                                                    value="1"  >
                                                <label class="form-check-label fw-bold"
                                                    for="sleepApneaControlYes">Yes</label>
                                            </div>
                                            <div class="form-check form-check-inline mb-4">
                                                <input class="form-check-input under_medication_apnes" type="radio"
                                                    
                                                    value="0" >
                                                <label class="form-check-label fw-bold"
                                                    for="sleepApneaControlNo">No</label>
                                            </div>
                                            <input type="text" class="form-control" id="med_apnea"
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
                                            <input class="form-check-input" type="radio"  value="1" name="metabolic_aggressive" id="aggressive1" >
                                            <label class="form-check-label fw-bold"
                                                for="aggressiveDisorderYes">Yes</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" value="0" name="metabolic_aggressive" id="aggressive"  checked>
                                            <label class="form-check-label fw-bold"
                                                for="aggressiveDisorderNo">No</label>
                                        </div>
                                        
                                        <div id="aggressive-disorder-content" class="justify-content-center mt-5">
                                            <h5>Is is under proper control or medication?</h5>
                                            <div class="form-check form-check-inline mt-2">
                                                <input class="form-check-input" type="radio"
                                                    value="1" name="under_medication_aggressive" id="medic_aggressive1">
                                                <label class="form-check-label fw-bold"
                                                    for="aggressiveDisorderControlYes">Yes</label>
                                            </div>
                                            <div class="form-check form-check-inline mb-4">
                                                <input class="form-check-input" type="radio"
                                                    value="0" name="under_medication_aggressive" id="medic_aggressive2"
                                                    checked>
                                                <label class="form-check-label fw-bold"
                                                    for="aggressiveDisorderControlNo">No</label>
                                            </div>
                                            <input type="text" class="form-control" id="med_disorder"
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
                                            <input class="form-check-input" type="radio"  value="1" name="metabolic_other" id="others1" >
                                            <label class="form-check-label fw-bold"
                                                for="aggressiveDisorderYes">Yes</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" value="0" name="metabolic_other" id="others" checked>
                                            <label class="form-check-label fw-bold"
                                                for="aggressiveDisorderNo">No</label>
                                        </div>
                                        <div id="others-disorder-content" class="justify-content-center mt-5">
                                            <h5>Is is under proper control or medication?</h5>
                                            <div class="form-check form-check-inline mt-2">
                                                <input class="form-check-input" type="radio"
                                                    value="1" name="under_medication_aggressive" id="medic_aggressive1">
                                                <label class="form-check-label fw-bold"
                                                    for="aggressiveDisorderControlYes">Yes</label>
                                            </div>
                                            <div class="form-check form-check-inline mb-4">
                                                <input class="form-check-input" type="radio"
                                                     value="0" name="under_medication_other" 
                                                    checked>
                                                <label class="form-check-label fw-bold"
                                                    for="aggressiveDisorderControlNo">No</label>
                                            </div>
                                            <input type="text" class="form-control" id="med_other"
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

                        <input type="text" style="width:80%; " value="20/20" name="" id="snellen_left" class="form-control" >

                                            </p>
                                            <p class="p-2 rounded" style="background: #F3F3F3;">
                                                
                        <input type="text" style="width:80%; " value="20/20" name="" id="snellen_right" class="form-control" checked>

                                            </p>
                                        </div>
                                        <div class="d-flex mb-3 gap-3 justify-content-start align-items-center">
                                            <h6 class="me-3">With Correction Lens</h6>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="correction_left" name="eye_left_correction"  id="eye_left_correction">
                                            </div>
                                            <div class="form-check" style="margin-left: 35px;">
                                                <input class="form-check-input" type="checkbox"  value="correction_right" name="eye_right_correction"  id="eye_right_correction" >
                                            </div>
                                        </div>
                                        <div class="d-flex mb-3 gap-3 justify-content-start align-items-center">
                                            <h6 class="">Color Blind</h6>
                                            <div class="form-check" style="margin-left: 87px;">
                                                <input class="form-check-input" type="checkbox" value="0" name="eye_left_color" id="eye_left_color" >
                                            </div>
                                            <div class="form-check" style="margin-left: 36px;">
                                                <input class="form-check-input" type="checkbox"  value="0" name="eye_right_color"   id="eye_right_color">
                                            </div>
                                        </div>
                                        <div class="d-flex gap-3 justify-content-start align-items-center">
                                            <h6 class="mb-3 me-4">Eye Color</h6>
                                            <select class="form-select" aria-label="Default select example"
                                                style="max-width: 100px; margin-left: 75px;" name="eye_left_color_data" id="eye_left_color_data" >
                      <option value="1" >Black</option>
                      <option  value="2" selected>Brown</option>
                      <option  value="3">Gray</option>
                      <option  value="5"> Blue</option>
                      <option  value="4"> Other</option>
                                            </select>
                                            <select class="form-select" aria-label="Default select example"
                                                style="max-width: 100px;" name="eye_right_color_data"   id="eye_right_color_data"    >
                       <option value="1" >Black</option>
                      <option  value="2" selected>Brown</option>
                      <option  value="3">Gray</option>
                      <option  value="5"> Blue</option>
                      <option  value="4"> Other</option>
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
                                                <option value="1" selected>Normal</option>
                                                <option value="2">Reduced</option>
                                                <option value="3"> With Hearing Aid</option>
                                            </select>
                                        </div>
                                        <div class="input-group mb-3">
                                            <label class="input-group-text" for="inputGroupSelect01">Right</label>
                                            <select class="form-select" name="hearing_right" id="hearing_right" required>
                                                <option value="1" selected>Normal</option>
                                                <option value="2">Reduced</option>
                                                <option value="3"> With Hearing Aid</option>
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


                <!--  PREVIEW MODAL -->
                <!--       <div id="preview-modal" class="modal" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title fw-bold" style="color: #520CF3;">PREVIEW</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body mb-5">
                                    <div class="row p-4">
                                        <div class="col-lg-6">
                                            <h5 class="text-center mb-3">Applicants Information</h5>
                                            <div class="shadow-card card h-75 p-3">
                                                <div
                                                    class="d-flex px-3 mb-2 justify-content-between align-items-center">
                                                    <h6 class="fw-bold">Name</h6>
                                                    <h6>Lorem Ipsum</h6>
                                                </div>
                                                <div
                                                    class="d-flex px-3 mb-2 justify-content-between align-items-center">
                                                    <h6 class="fw-bold">Address</h6>
                                                    <h6>Lorem Ipsum</h6>
                                                </div>
                                                <div
                                                    class="d-flex px-3 mb-2 justify-content-between align-items-center">
                                                    <h6 class="fw-bold">Age</h6>
                                                    <h6>Lorem Ipsum</h6>
                                                </div>
                                                <div
                                                    class="d-flex px-3 mb-2 justify-content-between align-items-center">
                                                    <h6 class="fw-bold">Birthday</h6>
                                                    <h6>Lorem Ipsum</h6>
                                                </div>
                                                <div
                                                    class="d-flex px-3 mb-2 justify-content-between align-items-center">
                                                    <h6 class="fw-bold">Gender</h6>
                                                    <h6>Lorem Ipsum</h6>
                                                </div>
                                                <div
                                                    class="d-flex px-3 mb-2 justify-content-between align-items-center">
                                                    <h6 class="fw-bold">Marital Status</h6>
                                                    <h6>Lorem Ipsum</h6>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <h5 class="text-center mb-3">Physical Examination Details</h5>
                                            <div class="shadow-card card h-75 p-3">
                                                <div
                                                    class="d-flex px-3 mb-2 justify-content-between align-items-center">
                                                    <h6 class="fw-bold">Height</h6>
                                                    <h6>Lorem Ipsum</h6>
                                                </div>
                                                <div
                                                    class="d-flex px-3 mb-2 justify-content-between align-items-center">
                                                    <h6 class="fw-bold">Blood Pressure</h6>
                                                    <h6>Lorem Ipsum</h6>
                                                </div>
                                                <div
                                                    class="d-flex px-3 mb-2 justify-content-between align-items-center">
                                                    <h6 class="fw-bold">Weight</h6>
                                                    <h6>Lorem Ipsum</h6>
                                                </div>
                                                <div
                                                    class="d-flex px-3 mb-2 justify-content-between align-items-center">
                                                    <h6 class="fw-bold">Blood Type</h6>
                                                    <h6>Lorem Ipsum</h6>
                                                </div>
                                                <div
                                                    class="d-flex px-3 mb-2 justify-content-between align-items-center">
                                                    <h6 class="fw-bold">Gender</h6>
                                                    <h6>Lorem Ipsum</h6>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 offset-lg-3">
                                            <h5 class="text-center mb-3">Medical Condition and Assessment</h5>
                                            <div class="shadow-card card h-75 p-3">
                                                <div
                                                    class="d-flex px-3 mb-2 justify-content-between align-items-center">
                                                    <h6 class="fw-bold">Condition</h6>
                                                    <h6>Lorem Ipsum</h6>
                                                </div>
                                                <div
                                                    class="d-flex px-3 mb-2 justify-content-between align-items-center">
                                                    <h6 class="fw-bold">Assessment</h6>
                                                    <h6>Lorem Ipsum</h6>
                                                </div>
                                                <div
                                                    class="d-flex px-3 mb-2 justify-content-between align-items-center">
                                                    <h6 class="fw-bold">Remarks</h6>
                                                    <h6>Lorem Ipsum</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                       
                                </div>
                            </div>
                        </div>
                    </div> -->
                               <!--    <div class="d-flex justify-content-center align-items-center">
                                        <button class="btn text-white" style="background-color: #520CF3;">Proceed to
                                            Submit</button>
                                    </div> -->