   <!-- Date and time range -->
 <?php
include("../../class.admin.php");
  $auth_item = new admin(); 
?>
  <?php
  $stmt = $auth_item->runQuery("SELECT count(*) as total FROM tbl_billing ");
  $stmt->execute();
  $series=$Row=$stmt->fetch(PDO::FETCH_ASSOC);

  $total_billing=$series['total'];

        ?> <h3 >Control No. <span  id="contrl_num" ><?php echo date('Ymd').$total_billing; ?>  <button type="button" class="btn btn-success approve_btn_data" id="submit_billing" > <span class="fa fa-check"></span> Generate  Invoice</button> </span></h3>
 
   <table id="example1" style="width: 100%;" class="table table-bordered table-striped">
                <thead>
                       <tr>
        <th>ID</th>
     
        <th>Name</th> 
        <th>Type</th>
        <th>Driver License</th>
        <th>Doctor Attended</th>
        <th>Date</th>
          
                </tr>
                </thead>

                <tbody>
           
        <tfoot>
                        <tr> 
        <th>ID</th>
     
        <th>Name</th> 
        <th>Type</th>
        <th>Driver License</th>
        <th>Doctor Attended</th>
        <th>Date</th>        
                </tr>
                </tfoot>
              </table>

              <script type="text/javascript">
  oTable=$("#example1").DataTable({
  "processing": true,
  "serverSide": true,
    "ajax": "../data/billing_report_list.php?id=<?php echo base64_decode($_GET['search']); ?>",
    scrollY:500,
        scrollX: true,

        "pageLength": 100,
        scroller: true,
     "aoColumnDefs": [
                { 'bSortable': false, 'aTargets': [0] }]
    });
              </script>