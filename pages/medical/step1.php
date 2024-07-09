 <!-- Step 1 -->
 <section id="step-1">
     <div class="row g-3">
         <!-- Registration -->
         <div class="col-lg-6">
             <div class="card h-100 p-3">
                 <h5 class="text-secondary">REGISTRATION</h5>
                 <div class="p-3">
                     <div class="input-group mb-3">
                         <label class="input-group-text" for="inputGroupSelect01">Purpose</label>
                         <select class="form-select required_item" id="transaction_types">
                             <option value="1">New Non-Pro Driver´s License </option>
                             <option value="2">New Pro Driver´s License</option>
                             <option value="3">Renewal of Non-Pro Driver´s License</option>
                             <option value="4">Renewal of Pro Driver´s License</option>
                             <option value="5">Renewal of Conductor´s License</option>
                             <option value="6">Conversion from Non-Pro to Pro DL</option>
                             <option value="7">New Non-Pro Driver´s License (with Foreign License)</option>
                             <option value="8">New Pro Driver´s License (with Foreign License)</option>
                             <option value="9">New Conductor´s License</option>
                             <option value="10">New Student Permit</option>
                             <option value="11">Conversion from Pro to Non-Pro DL</option>
                             <option value="12">Add Restriction for Non-Pro Driver´s License</option>
                             <option value="13">Add Restriction for Pro Driver´s License</option>
                         </select>
                     </div>
                     <div class="input-group flex-nowrap mb-3">
                         <span class="input-group-text" id="addon-wrapping">SP/DL/CL</span>
                         <input type="number" class="form-control " id="license_number" placeholder="Input Number" aria-describedby="addon-wrapping">
                     </div>
                     <div class="input-group flex-nowrap mb-3">
                         <span class="input-group-text" id="addon-wrapping" require>Date of Birth</span>
                         <input type="date" class="form-control  required_item" readonly="" id="dob" placeholder="YY-MM-DD" aria-describedby="addon-wrapping">
                     </div>
                     <div class="input-group flex-nowrap mb-3">
                         <span class="input-group-text" id="addon-wrapping">Age</span>
                         <input type="number" class="form-control" placeholder="0" aria-describedby="addon-wrapping" readonly="readonly" class="form-control" id="age">
                     </div>
                 </div>
             </div>
         </div>

         <!-- Snapshot -->
         <!--                 <div class="col-lg-6">
                                <div class="card h-100 p-3">
                                    <h5 class="text-secondary">Take a snap shot</h5>
                                    <div class="p-3 align-items-center">
                                        <div class="row justify-content-center mt-5">
                                            <div class="col-lg-12 text-center">
                       
                                                <table style="width:100%">
                                                        <tr><td style="width:50%">
                                                           <div id="my_camera" style="height:180px ;"></div>
                                                            <input type="hidden" name="image" class="image-tag">
                                                         </td><td style="width:50%">
                                                
                                                       
                                                            <div id="results" style=" " ></div>
                                                         </td>
                                                     </tr>
                                                </table>
                                            </div>
                             
                                        </div>
                                        <div class="row justify-content-center mt-3">
                                  
                                    
                <input type=button  class="btn text-white fw-bold w-50" style="background-color: #520CF3;"  value="Take Snapshot" onClick="take_snapshot()">

                           
                                    
                                      </div>
                                    </div>
                                </div>
                            </div>
 -->

         <div class="col-lg-6">
             <div class="card h-100 p-3">
                 <h5 class="text-secondary">Take a snap shot</h5>
                 <div class="p-3 align-items-center">
                     <div class="row justify-content-center mt-5">
                         <div class="col-lg-6 text-center">
                             <video id="video" playsinline autoplay>Camera</video>
                             <input type="hidden" name="image" class="image-tag">
                         </div>
                         <div class="col-lg-6 text-center">
                             <canvas id="canvas" width="200" height="200"></canvas>
                             <div id="results" style="display: none;"></div>
                         </div>
                     </div>
                     <div class="row justify-content-center mt-3">
                         <button id="capture-photo" class="btn text-white fw-bold w-50" style="background-color: #520CF3;">Capture</button>
                     </div>
                 </div>
             </div>
         </div>


         <!-- Personal Information -->
         <div class="col-lg-6">
             <div class="card h-100 p-3">
                 <h5 class="text-secondary">PERSONAL INFORMATION</h5>
                 <div class="p-3">
                     <div class="input-group flex-nowrap mb-3">
                         <span class="input-group-text" id="addon-wrapping">Surname</span>
                         <input type="text" class="form-control required_item" id="surname" placeholder="Input Surname" aria-describedby="addon-wrapping">
                     </div>
                     <div class="input-group flex-nowrap mb-3">
                         <span class="input-group-text" id="addon-wrapping">First Name</span>
                         <input type="text" class="form-control required_item" id="fname" placeholder="Input First Name" aria-describedby="addon-wrapping">
                     </div>
                     <div class="input-group flex-nowrap mb-3">
                         <span class="input-group-text" id="addon-wrapping">Middle Name</span>
                         <input type="text" class="form-control " id="mname" placeholder="Input Middle Name" aria-describedby="addon-wrapping">
                     </div>
                     <div class="input-group mb-3">
                         <label class="input-group-text" for="inputGroupSelect01">Gender</label>
                         <select class="form-select required_item" id="gender">
                             <option value="Male" selected>Male</option>
                             <option value="Female">Female</option>
                         </select>
                     </div>
                     <div class="input-group mb-3">
                         <label class="input-group-text" for="inputGroupSelect01">Martial
                             Status</label>
                         <select class="form-select required_item" id="marital_status">
                             <option>Married</option>
                             <option>Separated</option>
                             <option>Divorced</option>
                             <option>Widowed</option>
                             <option selected="">Single</option>
                         </select>
                     </div>
                     <div class="input-group mb-3">
                         <label class="input-group-text" for="inputGroupSelect01">Nationality</label>
                         <select class="form-select required_item" id="nationalities">
                             <?php
                                $stmt = $auth_item->runQuery("SELECT * FROM nationalities");
                                $stmt->execute();
                                while ($Row = $stmt->fetch(PDO::FETCH_ASSOC)) {

                                    if ($Row['return_value'] == "PHL") {
                                ?>
                                     <option value="<?php echo ($Row['return_value']); ?>" selected><?php echo $Row['name']; ?></option>

                                 <?php
                                    }
                                    ?>
                                 <option value="<?php echo ($Row['return_value']); ?>"><?php echo $Row['name']; ?></option>
                             <?php
                                }
                                ?>
                         </select>
                     </div>
                 </div>
             </div>
         </div>

         <!-- Other Information -->
         <div class="col-lg-6">
             <div class="card h-100 p-3">
                 <h5 class="text-secondary">OTHER INFORMATION</h5>
                 <div class="p-3">
                     <div class="input-group flex-nowrap mb-3">
                         <span class="input-group-text" id="addon-wrapping">Address</span>
                         <input type="text" id="address" class="form-control required_item" placeholder="Input Address" aria-describedby="addon-wrapping">
                     </div>
                     <div class="input-group flex-nowrap mb-3">
                         <span class="input-group-text" id="mobile_num">Mobile number
                             (Optional)</span>
                         <input type="text" class="form-control" placeholder="0999999999" aria-describedby="addon-wrapping">
                     </div>
                     <div class="input-group flex-nowrap mb-3">
                         <span class="input-group-text" id="addon-wrapping">Email</span>
                         <input id="email_add" class="form-control" placeholder="Input Email" aria-describedby="addon-wrapping">
                     </div>
                 </div>
             </div>
         </div>

         <div class="d-flex justify-content-center w-100 py-5">
             <button id="go-to-step-2" class="btn text-white w-25 fw-bold" style="background-color: #520CF3;"> Continue</button>
         </div>
     </div>
 </section>