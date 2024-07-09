    
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
      
    });

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

