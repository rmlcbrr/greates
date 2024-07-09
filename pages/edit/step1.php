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
                                            <select class="form-select required_item"  id="transaction_types" >

                    <option <?php if($Row['medical_type']==1){  echo "selected";}?> value="1">New Non-Pro Driver´s License </option>
                    <option <?php if($Row['medical_type']==2){  echo "selected";}?>  value="2">New Pro Driver´s License</option>
                    <option  <?php if($Row['medical_type']==3){  echo "selected";}?> value="3">Renewal of Non-Pro Driver´s License</option>
                    <option  <?php if($Row['medical_type']==4){  echo "selected";}?> value="4">Renewal of Pro Driver´s License</option>
                    <option <?php if($Row['medical_type']==5){  echo "selected";}?>  value="5">Renewal of Conductor´s License</option>
                    <option <?php if($Row['medical_type']==6){  echo "selected";}?>  value="6">Conversion from Non-Pro to Pro DL</option>
                    <option  <?php if($Row['medical_type']==7){  echo "selected";}?> value="7">New Non-Pro Driver´s License (with Foreign License)</option>
                    <option  <?php if($Row['medical_type']==8){  echo "selected";}?> value="8">New Pro Driver´s License (with Foreign License)</option>
                    <option <?php if($Row['medical_type']==9){  echo "selected";}?> value="9">New Conductor´s License</option>
                    <option <?php if($Row['medical_type']==10){  echo "selected";}?> value="10">New Student Permit</option>
                    <option <?php if($Row['medical_type']==11){  echo "selected";}?> value="11">Conversion from Pro to Non-Pro DL</option>
                    <option <?php if($Row['medical_type']==12){  echo "selected";}?> value="12">Add Restriction for Non-Pro Driver´s License</option>
                    <option <?php if($Row['medical_type']==13){  echo "selected";}?> value="13">Add Restriction for Pro Driver´s License</option>
                                            </select>
                                        </div>
                                        <div class="input-group flex-nowrap mb-3">
                                            <span class="input-group-text" id="addon-wrapping">SP/DL/CL</span>
                                            <input type="number" class="form-control " id="license_number"  value="<?php echo $Row['driver_license']?>"  placeholder="Input Number"
                                                aria-describedby="addon-wrapping" >
                                        </div>
                                        <div class="input-group flex-nowrap mb-3">
                                            <span class="input-group-text" id="addon-wrapping" require>Date of Birth</span>
                                            <input type="date" class="form-control  required_item"  readonly=""   value="<?php echo $Row['bdate']?>"    id="dob" placeholder="YY-MM-DD" 
                                                aria-describedby="addon-wrapping" ></div>
                      <?php                   

$dob= $Row['bdate']; //date of Birth

$dateOfBirth = $dob;
$today = date("Y-m-d");
$diff = date_diff(date_create($dateOfBirth), date_create($today));




                ?>
                                        <div class="input-group flex-nowrap mb-3">
                                            <span class="input-group-text" id="addon-wrapping">Age</span>
                                            <input type="number" class="form-control" placeholder="0"
                                                aria-describedby="addon-wrapping" readonly="readonly"  value="<?php echo $diff->format('%y')?>" class="form-control" id="age">
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
                                                <canvas id="canvas" width="200" height="200"
 style="width: 200px; height: 200px; background-image:url('../../control/upload/<?php echo $Row['imgs']?>')"
                                                >          </canvas>
                                     
                                                <div id="results" style="display: none;" ></div>
                                            </div>
                                        </div>
                                        <div class="row justify-content-center mt-3">
                                            <button id="capture-photo" class="btn text-white fw-bold w-50"
                                                style="background-color: #520CF3;">Capture</button>
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
                                            <input type="text" class="form-control required_item"   value="<?php echo $Row['last_name']?>"  id="surname" placeholder="Input Surname"
                                                aria-describedby="addon-wrapping"  >
                                        </div>
                                        <div class="input-group flex-nowrap mb-3">
                                            <span class="input-group-text" id="addon-wrapping">First Name</span>
                                            <input type="text" class="form-control required_item"   value="<?php echo $Row['first_name']?>"  id="fname" placeholder="Input First Name"
                                                aria-describedby="addon-wrapping"  >
                                        </div>
                                        <div class="input-group flex-nowrap mb-3">
                                            <span class="input-group-text" id="addon-wrapping">Middle Name</span>
                                            <input type="text" class="form-control "   value="<?php echo $Row['middle_name']?>"  id="mname" placeholder="Input Middle Name"
                                                aria-describedby="addon-wrapping" >
                                        </div>
                                        <div class="input-group mb-3">
                                            <label class="input-group-text" for="inputGroupSelect01">Gender</label>
                                            <select class="form-select required_item"  id="gender"  >
     <option  <?php if($Row['gender']=="Male"){  echo "selected";}?> >Male</option>
                    <option  <?php if($Row['gender']=="Female"){  echo "selected";}?>>Female</option>

                                            </select>
                                        </div>
                                        <div class="input-group mb-3">
                                            <label class="input-group-text" for="inputGroupSelect01">Martial
                                                Status</label>
                                            <select class="form-select required_item" id="marital_status"  >
                    <option <?php if($Row['marital_status']=="Married"){  echo "selected";}?> >Married</option>
                    <option <?php if($Row['marital_status']=="Separated"){  echo "selected";}?> >Separated</option>
                   <option <?php if($Row['marital_status']=="Divorced"){  echo "selected";}?> >Divorced</option>
                    <option <?php if($Row['marital_status']=="Widowed"){  echo "selected";}?> >Widowed</option>
                     <option  <?php if($Row['marital_status']=="Never Married" || $Row['marital_status']=="Single"){  echo "selected";}?> >Single</option>
                                            </select>
                                        </div>
                                        <div class="input-group mb-3">
                                            <label class="input-group-text" for="inputGroupSelect01">Nationality</label>
                                            <select class="form-selectselect2 required_item" id="nationalities"  >
                                         <?php 
                      $stmt = $auth_item->runQuery("SELECT * FROM nationalities");
                      $stmt->execute();
                      WHILE($row=$stmt->fetch(PDO::FETCH_ASSOC)){

                    if($Row['nationality']==$row['return_value']){
                      ?>
                      <option value="<?php echo($row['return_value']);?>" selected><?php echo $row['name'];?></option>   

                      <?php
                    }
                            ?>
                      <option value="<?php echo($row['return_value']);?>"><?php echo $row['name'];?></option>           
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
                                            <input type="text"  id="address"  class="form-control required_item" value="<?php echo $Row['address']?>" placeholder="Input Address"
                                                aria-describedby="addon-wrapping" >
                                        </div>
                                        <div class="input-group flex-nowrap mb-3">
                                            <span class="input-group-text" id="mobile_num">Mobile number
                                                (Optional)</span>
                                            <input type="text" class="form-control"  value="<?php echo $Row['mobile']?>"  placeholder="0999999999"
                                                aria-describedby="addon-wrapping">
                                        </div>
                                        <div class="input-group flex-nowrap mb-3">
                                            <span class="input-group-text" id="addon-wrapping">Email</span>
                                            <input id="email_add"  class="form-control" placeholder="Input Email"  value="<?php echo $Row['email']?>"
                                                aria-describedby="addon-wrapping">
                                        </div>
                                    </div>
                                </div>
                            </div>

                           <div class="d-flex justify-content-center w-100 py-5">
                                <button id="go-to-step-2" class="btn text-white w-25 fw-bold"
                                    style="background-color: #520CF3;"> Continue</button>
                            </div>
                        </div>
                    </section>