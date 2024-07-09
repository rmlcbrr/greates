 
 <table id="example3" style="width: 100%;" class="table table-bordered table-striped">
                <thead>
                       <tr>

        <th>Action</th> 
        <th>Invoice No.</th>
        <th>Total</th> 
        <th> Created By</th>  
        <th>Date Created</th>  
        <th> Approved By</th>  
        <th> Approved Date</th>

        <th> Status</th>
                </tr>
                </thead>

                <tbody>
           
        <tfoot>
                        <tr> 
 
        <th>Action</th> 
        <th>Invoice No.</th>
        <th>Total</th> 
        <th> Created By</th>  
        <th>Date Created</th>  
        <th> Approved By</th>  
        <th> Approved Date</th>

        <th> Status</th>
                </tr>
                </tfoot>
              </table>


              <script type="text/javascript">
oTable=$("#example3").DataTable({
  "processing": true,
  "serverSide": true,
    "ajax": "../data/invoice_list.php?id=<?php echo base64_decode($_GET['search']); ?>",
    scrollY:500,
        scrollX: true,

        "pageLength": 100,
        scroller: true,
     "aoColumnDefs": [
                { 'bSortable': false, 'aTargets': [0] }]
    });
              </script>