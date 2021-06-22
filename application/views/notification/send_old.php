<!-- <link href="https://www.jqueryscript.net/demo/Clean-jQuery-Date-Time-Picker-Plugin-datetimepicker/jquery.datetimepicker.css" rel="stylesheet"> -->
<?php $this->load->view('includes/header_script', $data); ?>
<!-- JS & CSS library of MultiSelect plugin -->
<body class="hold-transition sidebar-mini layout-fixed">
   <div class="wrapper">
   <!-- Navbar -->
   <?php $this->load->view('includes/header', $data); ?>
   <!-- /.navbar -->
   <!-- Main Sidebar Container -->
   <?php $this->load->view('includes/sidebar'); ?>
   <!-- Content Wrapper. Contains page content -->
   <div class="content-wrapper">
   <!-- Content Header (Page header) -->
    <section class="content-header">
      	<div class="container-fluid">
        	<div class="row mb-2">
	          	<div class="col-sm-11">
	            	<!-- <h1>Blank Page</h1> --> 
	        	</div>
	          	<div class="col-sm-1">          
	             	<a href="<?php echo base_url();?>auction/index/all"> <button type="button" class="btn btn-block btn-primary btn-sm">&nbsp;<i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;Back</button></a>            
	          	</div>
        	</div>
      	</div>
    </section>
   <!-- /.content-header -->
   <!-- Main content -->
   <section class="content">
      <div class="container-fluid">
         <!-- Small boxes (Stat box) -->
         <div class="row">
            <!-- <div class="col-lg-1"></div> -->
            <div class="col-lg-8">
               <?php $this->load->view('includes/msg_alert'); ?>
            </div>
         </div>
         <div class="row">
            <!-- <div class="col-lg-1"></div> -->
            <div class="col-lg-8">
               <!-- Main content -->
               <section class="content">
                  <!-- Default box -->
                  <div class="card">
                     <div class="card-header">
                        <h3 class="card-title">Send Push Notification</h3>                        
                     </div>
                     <div class="card-body">
                        <!-- Main content -->
                        <form action="<?php echo base_url('notification/send');?>" method="POST" enctype="multipart/form-data">			    		    
          			    		   <div class="form-group">
          			    		         <label for="title">Select Category&nbsp;<span style="color: red;">*</span></label>
                                    <select class="form-control" name="user_type" id="type" required>
                                       <option value="">-----Select User Types -----</option>
                                       <option value="all_user">All Users</option>
                                       <option value="ios_user">IOS</option>
                                       <option value="android_user">Android</option>
                                       <!-- <option value="selected_user">specific users</option>                                     -->
                                    </select>          			    		       
          			    		    </div>
                              <div class="form-group" id="row_dim">
                              <label for="title">Search user&nbsp;<span style="color: red;">*</span></label>
                              <select id="search" class="search form-control" name="search"></select>          			    		                                  		       
                              </div>
                              <div id="display"></div>

                                 

                                 <div class="form-group">
          			    		        <label for="title">Notification Title&nbsp;<span style="color: red;">*</span></label>
          			    		        <input type="text" class="form-control" name="notification_title" placeholder="Enter Notification Title"  value="<?php echo set_value('notification_title'); ?>" />
          			    		        <?php echo form_error('notification_title', '<div class="error text-danger">', '</div>'); ?>
          			    		    </div>                             
                               
          			    		    
          			    		   <div class="form-group">
          			    		        <label for="description">Notification Message&nbsp;<span style="color: red;">*</span></label>
          			    		        <textarea rows="5" class="form-control" name="notification_msg" placeholder="Enter Material Description"><?php echo set_value('notification_msg'); ?></textarea>
          			    		        <?php echo form_error('notification_msg', '<div class="error text-danger">', '</div>'); ?>
          			    		    </div>
          			    		             			    		    
          			    		    <div class="form-group">
          			    		        <button type="submit" class="btn btn-primary">Send Notification</button>
          			    		    </div>			    		
                        </form>
                        <!-- /.content -->
                     </div>
                     <!-- /.card-body -->
                     <!--  <div class="card-footer">
                        Footer
                        </div> -->
                     <!-- /.card-footer-->
                  </div>
                  <!-- /.card -->
               </section>
               <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
   </section>
   <!-- /.content -->
   </div>
   <!-- /.content-wrapper -->
   <?php $this->load->view('includes/footer'); ?>
   </div>
   <!-- ./wrapper -->
   <?php $this->load->view('includes/footer_scripts'); ?>
   <!-- jquery-validation -->
   <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
   <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
   <script>
         $(function() {
            $('#row_dim').hide(); 
            $('#type').change(function(){
               if($('#type').val() == 'specific user') {
                     $('#row_dim').show(); 
               } else {
                     $('#row_dim').hide(); 
               } 
            });
         });   
   </script>
   <!-- Initialize the plugin: -->
   <script>
      $('.search').select2({
        placeholder: '--- Search User ---',
        ajax: {
          url: '<?php echo base_url('notification/ajaxsearch');?>',
          dataType: 'json',
          delay: 250,
          data: function (data) {
             
                    return {
                        searchTerm: data.term // search term
                    };
                },
                processResults: function (response) {
                  console.log(response);
                    return {
                        results:response
                    };
                },
                
          cache: true
        }
      });
</script>

  
</body>
</html>