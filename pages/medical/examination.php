   <!-- Step 3 -->
                    <section id="step-3">
                        <div class="row g-3">
                            <h5 class="fw-bold">PHYSICAL EXAMINATION</h5>
                            <div class="col-12">
                                <div class="card h-100 p-3">

                                    <!-- Question 1 -->
                                    <div id="question-1-card" class="p-3">
                                        <div class="row justify-content-center">
                                            <div class="col-lg-6 text-center">
                                     <!--            <img class="question-images img-fluid"
                                                    src="/assets/main/vision-test-question-1.png" data-bs-toggle="modal"
                                                    data-bs-target="#vision-question-1"> -->
                                                       <img class="question-images img-fluid"   id="color_exam"  src="" style="width:80% "  data-bs-target="#vision-question-1">
                                            </div>
                                            <div class="col-lg-6 text-center">
                                                <h3 class="fw-bold mt-5">What is the number in the Screen?</h3>
                                                <h5 class="mt-5">Eye Colorblind</h5>
                                                <div class="d-flex gap-3 mt-5 justify-content-center">
                                                    <div>
                                                        <h6>Left</h6>
                                                        <i data-value='0' id="color_blind_exam_left"
                                                            class="material-icons eye-con align-middle mb-5 fs-2">visibility</i>
                                                    </div>
                                                    <div>
                                                        <h6>Right</h6>
                                                        <i data-value='1' id="question-1-right-eye-icon"
                                                            class="material-icons eye-con align-middle mb-5 fs-2">visibility</i>
                                                    </div>
                                                </div>
                                                <div class="input-group mt-3 w-50 mx-auto">
                                                    <input type="text" class="form-control"
                                                        placeholder="Enter number/answer"
                                                        id="color_answers"
                                                        autofocus
                                                        aria-describedby="addon-wrapping">
                                                </div>
                                                <div class="w-100 mt-5">
                                                    <button id="submit-answer" class="btn w-25 text-white fw-bold"
                                                        style="background-color: #520CF3;">Next</button>
                                                        <button   class="btn w-25 text-white fw-bold " data-bs-toggle="modal"
                                                        data-bs-target="#acuity-test-modal"
                                                        style="background-color: #520CF3;"> Next Exam</button>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                 

                                    <!-- Question 3 -->
                                    <div id="question-3-card" class="p-3">
                                        <div class="row justify-content-center">
                                            <div class="col-lg-6 text-center">
                                                <img class="question-images img-fluid"
                                                    src="../../assets/main/acuity-test-question-1.png" data-bs-toggle="modal"
                                                    data-bs-target="#acuity-test-question-1">
                                            </div>
                                            <div class="col-lg-6 text-center mt-5">
                                                <h3 class="fw-bold mt-5">Now cover your <span
                                                        style="color: #520CF3;">LEFT</span> eye, then read the letters
                                                    where the black arrow is pointing </h3>
                                                <div class="d-flex flex-column gap-3 my-5 justify-content-center">
                                                    <div class="d-flex gap-3 justify-content-start align-items-center">

                                                        <i data-value='0' name="corrective_lens_right"  id="right_eye_blind"  

                                                            class="material-icons eye-con mb-1 fs-1">visibility</i>
                                                        <h5>RIGHT EYE BLIND</h5>
                                                    </div>
                                                    <div class="d-flex gap-3 justify-content-start align-items-center">
                                                        <i data-value='1' name="corrective_lens_right"  id="corrective_eye_right"
                                                            class="material-icons eye-con mb-1 fs-1">visibility</i>
                                                        <h5>RIGHT EYE WITH CORRECTIVE OR CONTACT LENS</h5>
                                                    </div>
                                                </div>
                                                <div class="d-flex gap-3 justify-content-center w-100 mt-5">
                                                    <button class="go-to-question-4 btn w-25 text-white fw-bold"
                                                        style="background-color: #520CF3;">Correct</button>
                                                    <button
                                                        class="go-to-question-4 btn w-25 text-white fw-bold bg-warning">Wrong</button>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <!-- Question 4 -->
                                    <div id="question-4-card" class="p-3">
                                        <div class="row justify-content-center">
                                            <div class="col-lg-6 text-center">
                                                <img class="question-images img-fluid"
                                                    src="../../assets/main/acuity-test-question-1.png" data-bs-toggle="modal"
                                                    data-bs-target="#acuity-test-question-1">
                                            </div>
                                            <div class="col-lg-6 text-center mt-5">
                                                <h3 class="fw-bold mt-5">Now cover your <span
                                                        style="color: #520CF3;">RIGHT</span> eye, then read the letters
                                                    where the black arrow is pointing </h3>
                                                <div class="d-flex flex-column gap-3 my-5 justify-content-center">
                                                    <div class="d-flex gap-3 justify-content-start align-items-center">

                                                        <i data-value='0'  name="corrective_lens_left"  id="left_eye_blind"  
                                                            class="material-icons eye-con mb-1 fs-1">visibility</i>
                                                        <h5>LEFT EYE BLIND</h5>
                                                    </div>
                                                    <div class="d-flex gap-3 justify-content-start align-items-center">

                                                        <i data-value='1'  name="corrective_lens_left"  id="corrective_eye_left"  
                                                            class="material-icons eye-con mb-1 fs-1">visibility</i>
                                                        <h5>LEFT EYE WITH CORRECTIVE OR CONTACT LENS</h5>
                                                    </div>
                                                </div>
                                                <div class="d-flex gap-3 justify-content-center w-100 mt-5">
                                                    <button class="btn w-25 text-white fw-bold"
                                                        style="background-color: #520CF3;" data-bs-toggle="modal"
                                                        data-bs-target="#contrast-sensitivity-test-modal">Correct</button>
                                                    <button class="btn w-25 text-white fw-bold bg-warning"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#contrast-sensitivity-test-modal">Wrong</button>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <!-- Question 5 -->
                                    <div id="question-5-card" class="p-3">
                                        <div class="row justify-content-center">
                                            <div class="col-lg-6 text-center">
                                                <img class="question-images img-fluid"
                                                    src="../../assets/main/contrast-sensitivity-test.png"
                                                    data-bs-toggle="modal" data-bs-target="#contrast-sensitivity-image">
                                            </div>
                                            <div class="col-lg-6 text-center mt-5">
                                                <h3 class="fw-bold mt-5">Cover your <span
                                                        style="color: #520CF3;">LEFT</span> eye, then read the letters
                                                    above the red line </h3>
                                                <div class="d-flex flex-column gap-3 my-5 justify-content-center">
                                                    <div class="d-flex gap-3 justify-content-start align-items-center">
                                                        <i data-value="right_corrective" name="visual_act_right"   id="contrast-sensitivity-right-eye-with-lens"
                                                            class="material-icons eye-con mb-1 fs-1">visibility</i>
                                                        <h5>RIGHT EYE WITH CORRECTIVE OR CONTACT LENS</h5>
                                                    </div>
                                                </div>
                                                <div  id="set3_1_correct" class="d-flex gap-3 justify-content-center w-100 mt-5">
                                                    <button class="go-to-question-6 btn w-25 text-white fw-bold"
                                                        style="background-color: #520CF3;">Correct</button>
                                                    <button id="set3_1_wrong"
                                                        class="go-to-question-6 btn w-25 text-white fw-bold bg-warning">Wrong</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Question 6 -->
                                    <div id="question-6-card" class="p-3">
                                        <div class="row justify-content-center">
                                            <div class="col-lg-6 text-center">
                                                <img class="question-images img-fluid"
                                                    src="../../assets/main/contrast-sensitivity-test.png"
                                                    data-bs-toggle="modal" data-bs-target="#contrast-sensitivity-image">
                                            </div>
                                            <div class="col-lg-6 text-center mt-5">
                                                <h3 class="fw-bold mt-5">Cover your <span
                                                        style="color: #520CF3;">RIGHT</span> eye, then read the letters
                                                    above the red line </h3>
                                                <div class="d-flex flex-column gap-3 my-5 justify-content-center">
                                                    <div class="d-flex gap-3 justify-content-start align-items-center">

                                                        <i id="contrast-sensitivity-left-eye-with-lens"
                                                        data-value="left_corrective" name="visual_act_left" 
                                                            class="material-icons eye-con mb-1 fs-1">visibility</i>
                                                        <h5>LEFT EYE WITH CORRECTIVE OR CONTACT LENS</h5>
                                                    </div>

                                                </div>
                                                <div class="d-flex gap-3 justify-content-center w-100 mt-5">

                                                    <button  class="btn w-25 text-white fw-bold"
                                                        style="background-color: #520CF3;" data-bs-toggle="modal"
                                                        data-bs-target="#hearing-test-modal">Correct</button>
                                                    <button   class="btn w-25 text-white fw-bold bg-warning"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#hearing-test-modal">Wrong</button>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Question 7 -->


                                                  <!-- /.login-box -->
                                        <audio id="carteSoudCtrl" >
                                          <source src="../../dist/sounds/left.mp3"  type="audio/mpeg">
                                          Your browser does not support the audio element.
                                        </audio>

                                               <!-- /.login-box -->
                                        <audio id="carteSoudCtr2" >
                                          <source src="../../dist/sounds/right.mp3"  type="audio/mpeg">
                                          Your browser does not support the audio element.
                                        </audio>

                                    
                                    <div id="question-7-card" class="p-3">
                                        <div class="row justify-content-center">
                                            <div class="col-lg-6 text-center">
                                                <img class="question-images img-fluid"
                                                    src="../../assets/main/hearing-test-question-img.png">
                                               <div class="d-flex gap-3 justify-content-center w-100 mt-5">
                                                    <button id="play_sounds_right"  class="btn w-25 text-white fw-bold"
                                                        style="background-color: #520CF3;"> <i
                                                            class="material-icons eye-con fs-2">volume_up</i>
                                                        <h5 class="text-white">Play Sounds First</h5>
                                                    </button>
                                                    <button id="play_sounds_left"  class="btn w-25 text-white fw-bold"
                                                        style="background-color: #520CF3;"> <i
                                                            class="material-icons eye-con fs-2">volume_up</i>
                                                        <h5 class="text-white">Play Sounds Second</h5>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 text-center mt-5">
                                                <h3 class="fw-bold mt-5">Listen Carefully, if you will hear a sound
                                                </h3>
                                                <div class="d-flex flex-column gap-3 my-5 justify-content-center">
                                                    <div class="d-flex flex-column gap-3 my-5 justify-content-center">
                                                        <div
                                                            class="d-flex gap-3 justify-content-start align-items-center">

                                                            <i data-value="0" name="hearingaid"  id="left_hearing_aid"  
                                                                class="material-icons eye-con mb-1 fs-1">hearing</i>
                                                            <h5>WITH LEFT HEARING AID</h5>
                                                        </div>
                                                        <div
                                                            class="d-flex gap-3 justify-content-start align-items-center">

                                                            <i data-value="1" name="hearingaid"  id="right_hearing_aid"  
                                                                class="material-icons eye-con mb-1 fs-1">hearing</i>
                                                            <h5>WITH RIGHT HEARING AID</h5>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-flex gap-3 justify-content-center w-100 mt-5">
                                                    <button class="go-to-question-8 btn w-25 text-white fw-bold"
                                                        style="background-color: #520CF3;">LEFT</button>
                                                    <button
                                                        class="go-to-question-8 btn w-25 text-white fw-bold bg-warning">RIGHT</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                


                                </div>
                            </div>

                            <div class="row py-5">
                                <div class="d-flex gap-2 justify-content-center w-100">
                                    <button id="go-back-to-step-2" class="btn text-dark fw-bold"
                                        style="background-color: #D6D6D6;"> Go back</button>
                                    <button class="go-to-step-4 btn text-white fw-bold"
                                        style="background-color: #520CF3;"> Skip and Continue</button>
                                </div>
                            </div>
                        </div>
                    </section>