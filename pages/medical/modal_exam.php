        <!-- Creates the bootstrap modal where the image will appear -->
        <div class="modal fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">System Message</h4>
                <button type="button" class="close" data-bs-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
              </div>
              <div class="modal-body">

                <centeR><span id="erroradd" style="color:red;"></span></centeR>
                <table id="searchUser" style="width: 100%;" class="table table-bordered table-striped">
                  <thead>
                    <tr>

                      <th>Name</th>
                      <th>Gender</th>
                      <th>Birth Date</th>

                      <th style=" ">Action</th>
                    </tr>
                  </thead>

                  <tbody>

                  <tfoot>
                    <tr>

                      <th>Name</th>
                      <th>Gender</th>
                      <th>Birth Date</th>

                      <th style=" ">Action</th>
                    </tr>
                  </tfoot>
                </table>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>



        <div class="modal fade" id="moveModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-bs-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">System Message</h4>
              </div>
              <div class="modal-body">
                <center>
                  <h3>Next Examinations Visual Acuity Test</h3>
                  <img src="../../dist/img/visual.jpg" style="width: 100%;" />
                </center>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-info" id="proceed_next_exam1">Proceed</button>
                <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>


        <div class="modal fade" id="moveModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-bs-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">System Message</h4>
              </div>
              <div class="modal-body">
                <center>
                  <h4>Proceed to Next Examinations Constrast Sensitivity Test</h4>
                </center>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-info" id="proceed_next_exam2">Proceed</button>
                <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>

        <div class="modal fade" id="moveModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-bs-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">System Message</h4>
              </div>
              <div class="modal-body">
                <center>
                  <h3>Final Examinations Hearing Test</h3>
                </center>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-info" id="proceed_next_exam3">Proceed</button>
                <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>


        <div class="modal fade" id="proceedExamModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-bs-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">System Message</h4>
              </div>
              <div class="modal-body">
                <center>
                  <h1>Start to Examination</h1>
                  <img src="../../dist/img/ready.jpg" style="width: 100%;" />
                </center>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-info" id="proceeds">Proceed</button>
                <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>



        <div class="modal fade" id="previewExamModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">System Message</h4>
                <button type="button" class="close" data-bs-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>

              </div>
              <div class="modal-body">
                <h4>Please use Doctors Biometric to Submit the data</h4>
                <input type="hidden" id="qualityInputBox" size="20" value="Good">
                <centeR>
                  <div id="status"></div>
                </centeR>
                <select class="form-control" id="readersDropDown" style="display: none;" onchange="selectChangeEvent()">
                </select>
                <center>
                  <div id="imagediv" style="width:250px ;"></div>

                </center>
                <small>Please wait until the device start blinking of greenlight before puting your finger to the device.</small>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-info" id="proceeds_save">Scan Now</button>
                <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>




        <div class="modal fade" id="previewExamModal-Nonbio" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-bs-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">System Message</h4>
              </div>
              <div class="modal-body">
                <h4>By clicking save now records will save but will not send to LTMS it will be save as temporary records</h4>


              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-info" id="proceeds_save">Save Now</button>
                <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>



        <div class="modal fade" id="donemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-bs-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h3 class="modal-title" id="myModalLabel">Done Examination</h3>
              </div>
              <div class="modal-body">
                <center>
                  <img src="../../dist/img/examdone.jpg" style="height: 450px;" />
                </center>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-info" id="dones">Done</button>
                <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>







        <div class="modal fade" id="previewModalInfo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-bs-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Preview</h4>
              </div>

              <div class="modal-body">
                <hr class="new5" style=""><strong>Applicants Information</strong></br></hr>
                <table style="width: 100%;">

                  <Tr>
                    <Td>Type : <span id="previewTransaction_types"></span></Td>
                    <Td>Name : <span id="previewName"></span></Td>
                  </Tr>

                  <Tr>
                    <Td>Address : <span id="previewAddress"></span></Td>
                    <Td>Birthday : <span id="previewBday"></span></Td>
                  </Tr>


                  <Tr>
                    <Td>Age : <span id="previewAge"></span></Td>
                    <Td>Gender : <span id="previewGender"></span></Td>
                  </Tr>

                  <Tr>
                    <Td>Marital Status : <span id="previewStatus"></span></Td>
                    <Td>Nationality : <span id="previewNationality"></span></Td>
                  </Tr>
                </table>

                <hr class="new5" style=""><strong>Physical Examination Details</strong></br></hr>

                <table style="width: 100%;">
                  <Tr>
                    <td>Height : <span id="previewHeight"></span></td>
                    <td>Weight : <span id="previewWeight"></span></td>
                  </Tr>
                  <tr>
                    <td>Blood Pressure : <span id="previewBloodPressure"></span></td>
                    <td>Blood Type : <span id="previewBloodType"></span></td>

                  </Tr>
                  </tr>
                </table>


                <table style="width: 100%;">
                  <tr>
                    <Td>&nbsp;</Td>
                    <td><strong>Upper Extemitiess</strong></td>
                    <td><strong>Lower Extemitiess</strong></td>
                  </tr>
                  <tr>
                    <td>Left</td>

                    <td><span id="previewupper_exte_left"></span></td>
                    <td><span id="previewlower_exte_left"></span></td>
                  </tr>
                  <tr>
                    <td>Right</td>

                    <td><span id="previewupper_exte_right"></span></td>
                    <td><span id="previewlower_exte_right"></span></td>
                  </tr>
                </table>


                </table tyle="width: 100%;">
                <hr class="new5" style=""><strong>Medical Condition and Assessment</strong></br></hr>

                <table>
                  <Tr>
                    <td>Condition/s : <span id="previewConditions"></span></td>
                  </Tr>
                  <tr>
                    <td>Assessment : <span id="previewAssesment"></span></td>

                  </Tr>
                  <tr>
                    <td>Remarks : <span id="previewRemarks"></span></td>

                  </Tr>
                </table>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-info" id="preview_show_modalScanner">Proceed to Submit</button>
                <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>