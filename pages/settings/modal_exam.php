        <!-- Creates the bootstrap modal where the image will appear -->
<div class="modal fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">System Message</h4>
      </div>
      <div class="modal-body">

        <centeR><span id="erroradd" style="color:red;"></span></centeR>

<center>
<img  src="../../dist/img/no.png" style="height:80%;" />
</center>
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>



<div class="modal fade" id="moveModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">System Message</h4>
      </div>
      <div class="modal-body">
<center><h3>Next Examinations Visual Acuity Test</h3>
<img  src="../../dist/img/visual.jpg" style="width: 100%;" />
</center>
      </div>
      <div class="modal-footer">
         <button type="button" class="btn btn-info" id="proceed_next_exam1" >Proceed</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="moveModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">System Message</h4>
      </div>
      <div class="modal-body"><center>
<h4>Proceed to Next Examinations Constrast Sensitivity Test</h4></center>
      </div>
      <div class="modal-footer">
         <button type="button" class="btn btn-info" id="proceed_next_exam2" >Proceed</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="moveModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">System Message</h4>
      </div>
      <div class="modal-body"><center>
<h3>Final Examinations Hearing Test</h3></center>
      </div>
      <div class="modal-footer">
         <button type="button" class="btn btn-info" id="proceed_next_exam3" >Proceed</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="proceedExamModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">System Message</h4>
      </div>
      <div class="modal-body">
<center><h1>Start to Examination</h1>
<img  src="../../dist/img/ready.jpg" style="width: 100%;" />
</center>
      </div>
      <div class="modal-footer">
         <button type="button" class="btn btn-info" id="proceeds" >Proceed</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>



<div class="modal fade" id="previewExamModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">System Message</h4>
      </div>
      <div class="modal-body">
        <h4>Doctors biometric is needed</h4>
<input type="hidden" id="qualityInputBox" size="20" value="Good">
        <centeR> <div id="status"></div> </centeR>
   <select class="form-control" id="readersDropDown"  style="display: none;" onchange="selectChangeEvent()">
            </select>
<center>
   <div id="imagediv" style=""  ></div>
         
</center>
       <small>Please wait until the device start blinking of greenlight before puting your finger to the device.</small>
      </div>
      <div class="modal-footer">
         <button type="button" class="btn btn-info" id="proceeds_save" >Scan Now</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="previewExamModal-Nonbio" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">System Message</h4>
      </div>
      <div class="modal-body">
           <h4>By clicking save now records will save and update but will not send to LTMS it will be save as temporary records</h4>

      
      </div>
      <div class="modal-footer">
         <button type="button" class="btn btn-info" id="proceeds_save" >Scan Now</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>



<div class="modal fade" id="donemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h3 class="modal-title" id="myModalLabel">Done Examination</h3>
      </div>
      <div class="modal-body">
<center>
<img  src="../../dist/img/examdone.jpg" style="height: 450px;" />
</center>
      </div>
      <div class="modal-footer">
         <button type="button" class="btn btn-info" id="dones" >Done</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>