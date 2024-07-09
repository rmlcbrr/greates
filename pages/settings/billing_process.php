<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Medical</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<?php
include("../includes/css.php");
?>

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->

<link rel="stylesheet" href="../../plugins/datepicker/bootstrap-datetimepicker.css">
<link rel="stylesheet" href="../../plugins/daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <link rel="stylesheet" href="../../dist/css/medic.css">
</head>
<style>

</style>
<body class="hold-transition skin-blue sidebar-mini sidebar-collapse ">
<div class="wrapper">
      <style>
         input[type=checkbox]
{
  /* Double-sized Checkboxes */
  -ms-transform: scale(2); /* IE */
  -moz-transform: scale(2); /* FF */
  -webkit-transform: scale(2); /* Safari and Chrome */
  -o-transform: scale(2); /* Opera */
  transform: scale(2);
  padding: 10px;
}

/* Might want to wrap a span around your checkbox text */
.checkboxtext
{
  /* Checkbox text */
  font-size: 110%;
  display: inline;
}
#rel
</style>
<?php
include("../includes/main-header.php");
include("../includes/aside.php");
  include("../../class.admin.php");
  $auth_item = new admin(); 
?>
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
<?php 

?>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Billing</a></li>
      </ol>
    </section>
  </br>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
  
          <!-- /.box -->

          <div class="box">
            <div class="box-header">
            <h4>
View  <?php
//echo $_SESSION['u_account_type'];
 ?>
        <small>Billing</small>
      </h4>
            </div>
            <!-- /.box-header -->

            <!-- /.box-body -->
          </div>
          <!-- /.box -->
      
      
      
      <div class="row">

  
          <!-- /.box -->

        </div>
        <!-- /.col (left) -->
        <div class="col-md-6">
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Billing Control Num </h3>
            </div>
            <div class="box-body">
              <!-- Date -->
              <!-- /.form group -->

              <!-- Date and time range -->

              <div class="form-group">
                <label></label>
           <div class="box-body">
              <table id="example2" style="width: 100%;" class="table table-bordered table-striped">
                <thead>
                       <tr>
           
             <th>Contr #</th>
        <th>Branch</th>

        <th>Date Created</th>
        <th>Date Ranged</th>
        <th>Status</th>
        <th>Action</th>       
                </tr>
                </thead>

                <tbody>
           
        <tfoot>
                        <tr>    <th>Contr #</th>
        <th>Branch</th>

        <th>Date Created</th>
        <th>Date Ranged</th>
        <th>Status</th>
        <th>Action</th>   
                </tr>
                </tfoot>
              </table>
            </div>
              </div>
              <!-- /.form group -->

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- iCheck -->
     
          <!-- /.box -->
        </div>
        <!-- /.col (right) -->

        <div class="col-md-6">
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Datatables report</h3>
            </div>
            <div class="box-body">
              <table id="examples" style="width: 100%;" class="table table-bordered table-striped">
                <thead>
                       <tr>

        <th>Name</th> 
        <th>Type</th>
        <th>License</th>
        <th>Clinic</th>
        <th>Date</th>
        
                </tr>
                </thead>

                <tbody>
           
        <tfoot>
                        <tr>    
        <th>Name</th> 
        <th>Type</th>
        <th>License</th>
        <th>Clinic</th>
        <th>Date</th>  
                </tr>
                </tfoot>
              </table>
            </div>
          </div>
        </div>



      </div>
      
      
      
      
      
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>

  <!-- /.content-wrapper -->

<?php
include("../includes/footer.php");
?>

</div>
<!-- ./wrapper -->
<?php
include("../includes/js.php");
?>
  <!-- Modal -->
<div id="myModalwarning" class="modal fade  modal-warning" role="dialog">
  <div class="modal-dialog  modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Message</h4>
      </div>
      <div class="modal-body">
        <h3>Error Found : No data selected ,Process was halted. </h3>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>



<!-- Modal -->
<div id="myModalApprove" class="modal fade  modal-info" role="dialog">
  <div class="modal-dialog  modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Message</h4>
      </div>
      <div class="modal-body">
     <h3>Are you sure to approve billing item/s?</h3>
      </div>
      <div class="modal-footer">
    <button type="button" id="save-approve" class="btn btn-success" >Proceed</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<script src="../../dist/js/moment.min.js"></script>
<script src="../../plugins/datepicker/bootstrap-datetimepicker.js"></script>
<script src="../../plugins/daterangepicker/daterangepicker.js"></script>
</body>
<script type="text/javascript">



 $('#select_all').on('click',function(){
        if(this.checked){
            $('#example2 input[name="approved_billing"]').each(function(){
                this.checked = true;
            });
        }else{
             $('#example2 input[name="approved_billing"]').each(function(){
                this.checked = false;
            });
        }
    });
    
    $('.checkbox').on('click',function(){
        if($('.checkbox:checked').length == $('.checkbox').length){
            $('#select_all').prop('checked',true);
        }else{
            $('#select_all').prop('checked',false);
        }
    });

  $('#date_created').daterangepicker({
     autoUpdateInput: false,
      locale: {
          cancelLabel: 'Clear'
      }
});


 $('input[name="datefilter"]').on('apply.daterangepicker', function(ev, picker) {
      $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
  });

  $('input[name="datefilter"]').on('cancel.daterangepicker', function(ev, picker) {
      $(this).val('');
  });


    // $("#example1").DataTable();
    oTable=$("#example2").DataTable({
  "processing": true,
  "serverSide": true,
    "ajax": "../data/billing_list_withcontrol.php",
    scrollY:500,
        scrollX: true,

        "pageLength": 100,
        scroller: true,
     "aoColumnDefs": [
                { 'bSortable': false, 'aTargets': [0] }]
    });

        oTable2=$("#examples").DataTable({
  "processing": true,
  "serverSide": true,
    "ajax": "../data/billing_list_view.php",
    scrollY:500,
        scrollX: true,

        "pageLength": 100,
        scroller: true,
     "aoColumnDefs": [
                { 'bSortable': false, 'aTargets': [0] }]
    });
    //Wizard
  $(document).on("click","#search_clinic",function(){ 
    var clinics= $("#clinics").val();
       var dcr= $("#date_created").val(); 
   
    var temp=clinics+","+dcr;           
  oTable.columns(1).search(temp).draw();

  });



$('.btn_reports').on('click', function () {   // for select box

 var clinics= $("#clinics").val();
    var dcr= $("#date_created").val(); 
   
    var temp=clinics+","+dcr;          
//window.open("wb_report.php?date1="+encodeURI(date)+'&date2='+encodeURI(date2), '_blank');
window.open("excel/report_excel_billing.php?data="+encodeURI(temp), '_blank');
}); 



    $(document).on('click','.edit_btn', function (e) {
            var id=$(this).attr("id");
       window.location.replace("edit_report?uid="+id);
      
    });


        $(document).on('click','.view_btn', function (e) {
            var id=$(this).attr("id");
       window.location.replace("../import/view_cert?uid="+id);
      
    });
    
$('.approve_btn_data').on('click', function () {   // for select box
  status_btn=$(this).attr("id");
 var favorite = [];

         $.each($("input[name='approved_billing']:checked"), function(){
                favorite.push($(this).val());
            });
    
           if(favorite.join(", ")===""){
$("#myModalwarning").modal("show");
            }else{
$("#myModalwarning").modal("hide");

  $("#myModalApprove").modal("show");     
            }
            return false;
});





$('#save-approve').on('click', function () {   // for select box

 var favorite = [];
var contrl_num=$("#contrl_num").text();
var clinics=$('#clinics').val();
var date_created=$("#date_created").val();
 var $this = $(this);
$this.html('Saving..');

  $("#save-approve").attr("disabled", "disabled");


var fd = new FormData();  
fd.append('status',"16");
fd.append('contrl_num',contrl_num);
fd.append('clinics',clinics);
fd.append('date_created',date_created);

 var $this = $("#save-approve");
 // fd.append('nid',favorite.join(", "));
$.ajax({
  url: "../../control/control_admin.php",
  data: fd,
  processData: false,
  contentType: false,
  type:'POST',
  success:function(result){
   console.log(result);
  
       $.each($("input[name='approved_billing']:checked"), function(){
                //favorite.push($(this).val());
        var uid=$(this).attr("data-contronum");
      //  dataApprove(uid,$.trim(result));
            });
                 $this.html("Proceed");   
                 $("#save-approve").removeAttr("disabled");
          }
            });
  
 

});


function dataApprove(ctrl,billing_id){
  // fd.append('id',id);
var fd = new FormData();  
fd.append('status',"17");
fd.append('billing_id',billing_id);
fd.append('user_id',ctrl);
 // fd.append('nid',favorite.join(", "));
$.ajax({
  url: "../../control/control_admin.php",
  data: fd,
  processData: false,
  contentType: false,
  type:'POST',
  success:function(result){
   console.log(result);

 setTimeout(function() {

     oTable.draw();
   $('#select_all').prop('checked',false);
  $("#myModalApprove").modal("hide"); 
                    //  oTable2.draw(); 
   if($.trim(result)==="error" || result=="error" || result==='error'){
$.notify("Failed to process billing  for User ID# : "+ctrl,"warning");

}else{
          
    $.notify("Success Creation of billing  for User ID# : "+ctrl,"success");
                         $("#myModalSuccess").modal("show"); 
      }            }, 3000);
              // }, 2500)
            // $.notify("Successfully Updated! ","success");


          }
            });

}
</script>
</html>
