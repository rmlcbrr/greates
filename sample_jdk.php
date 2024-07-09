        <!-- jQuery 3 -->
    <script src="../bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    
<script src="../bootstrap/js/bootstrap.min.js"></script>

  <script src="../dist/js/notify.js"></script>
<script type="text/javascript">
  
           
       
$.ajax({
          url: 'java_bio/index.php',        
          type: 'POST',
  processData: false,
  contentType: false,
  success:function(result){
    console.log(result);
 

  }, error: function(err){
                                            
  }

});

</script>