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
                        <form action="<?php echo base_url('notification/send');?>" method="POST" enctype="multipart/form-data" id="nofify_form" onsubmit = "return(FormValidation());" name="myForm">			    		    
							<div class="form-group">
          			    		<label for="title">Select Type&nbsp;<span style="color: red;">*</span></label>
								<select class="form-control" name="user_type" id="type" required>
								   <option value="">-----Select User Types -----</option>
								   <option value="all_user">All Users</option>
								   <option value="ios_user">IOS</option>
								   <option value="android_user">Android</option>
								   <option value="selected_user">specific users</option>
								</select> 
								<span id="usertype_error" class="text-danger"></span>
							</div>
          			    		    								
								<div class="form-group">
									<div class="overflow-auto">
										<ul class="list-group list-unstyled" id="selected_users_data_index"></ul>
									</div>
								</div>									
								<div id="row_dim" style="display:none;">     
									<div class="form-group">
										<input type="hidden" name="user_id" id="selected_user_ids">
										<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Select user</button>
									</div> 
								</div>
                             
                              <div class="form-group">
          			    		        <label for="title">Notification Title&nbsp;<span style="color: red;">*</span></label>
          			    		        <input type="text" class="form-control" id="notification_title" name="notification_title" placeholder="Enter Notification Title"  value="<?php echo set_value('notification_title'); ?>" />
										<span id="notification_title_error" class="text-danger"></span>
          			    		        
          			    		    </div>                             
                               
          			    		    
          			    		   <div class="form-group">
          			    		        <label for="description">Notification Message&nbsp;<span style="color: red;">*</span></label>
          			    		        <textarea rows="5" id="notification_msg" class="form-control" name="notification_msg" placeholder="Enter Material Description"><?php echo set_value('notification_msg'); ?></textarea>
          			    		        <span id="notification_msg_error" class="text-danger"></span>
          			    		    </div>
          			    		             			    		    
          			    		    <div class="form-group">
          			    		        <input type="submit" class="btn btn-primary submit_notify" value="Send Notification">
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
   		<!-- Creates the bootstrap modal where the image will appear -->
         <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
	   <h4 class="modal-title" id="userModalLabel">Select User</h4>
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
       
      </div>
      <div class="modal-body">
       <div class="row margin-top"> 
	   <div class="col-md-8 col-xs-12">
                <div class="form-group">
                   <input type="text" name="keyword" id="keyword" class="form-control" Placeholder="Search By Name/Email" autocomplete="off">
                    <label class="text-danger" id="keyword_error"></label>
                </div>
            </div>
			 <div class="col-md-4 col-xs-12">
            <button type="button" class="btn btn-primary" id="serachVocUser">Search</button>               
         </div>
            </div>
			<div class="row" id="userData"> </div>
      </div>
      <div class="modal-footer md_btn">
         <button type="button" class="btn btn-primary" id="adduser" style="display:none">Add user</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
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
     var selected_users =[];
   var selected_users_data =[];
         $(function() {
            $('#row_dim').hide(); 
            $('#type').change(function(){
               if($('#type').val() == 'selected_user') {
                     $('#row_dim').show(); 
               } else {
                     $('#row_dim').hide(); 
               } 
            });
			
			
			 $("#serachVocUser").on('click', function (e) {
					 e.preventDefault();					 
					 $('#keyword_error').html('');
					 var keyword = $('#keyword').val();
					 if (keyword == '') {
						   $('#keyword_error').html('Please enter keyword.');
					 } else {
						   $.ajax({
							  url: "<?php echo site_url('notification/searchUser'); ?>",
							  type: "post",
							  data: {keyword: keyword},
							  cache: false,
							  beforeSend: function () {
								// $("#serachVocUser").attr('disabled', true);
							  },
							  success: function (result) {
								 //console.log(result);
								// $("#serachVocUser").attr('disabled', false);
								 $('#userData').html(result);
							  }
						   });
					 }
			});
			
				$(document).on('click','.select_user_chk', function (e) {
					
					  /*  var user_id = $.trim($(this).val());
					  $parent = $(this).parents('.user_select');
					 if($(this).is(':checked')){
						 selected_users.push(user_id);
						 var name =  $parent.find('.display_name').text();
						 var email =  $parent.find('.email_text').text();
						 var obj = {id:user_id,name:name,email:email};
						 selected_users_data.push(obj);
					 }else{
						 deleteSelectedUsers(user_id);
					 }  */
					 checkAddUserButton();
			});
			$(document).on('click','.delete_users_by_icon', function (e) {
					var result = confirm("Want to delete?");
					if (result) {
						var userid = $(this).attr('data-user-id');
						deleteSelectedUsers(userid);
						$(this).parent().remove();
					}
					
			});
			$(document).on('click','.submit_notify', function (e) {
					 e.preventDefault();
					 if($('#type').val()=='selected_user'){
						var userIdStr = selected_users.join(',');
						 $('#selected_user_ids').val(userIdStr);
						 if($('#selected_user_ids').val()!=''){
							  $('#nofify_form').submit();
						 } 
					 }else{
						  $('#nofify_form').submit();
					 }
					 
					
					 
					 
			});
			$(document).on('click','#adduser', function (e) {
				    var html ='';
					$.each($('.select_user_chk:checked'), function(){
						
						 var user_id = $.trim($(this).val());
					if(selected_users.indexOf(user_id)==-1){	 
					  $parent = $(this).parents('.user_select');
					   selected_users.push(user_id);
					   var name =  $parent.find('.display_name').text();
						 var email =  $parent.find('.email_text').text();
						 var obj = {id:user_id,name:name,email:email};
						// selected_users_data.push(obj);
						 //console.log($(this).val());
						 //console.log($(this));
						html+='<li class="list-group-item list-group-item-dark">'+email+' ('+name+') <a href="javascript:void(0);" class="delete_users_by_icon text-danger" data-user-id="'+user_id+'" style="float:right;"><i class="fa fa-times"></i></a></li>'; 
					} 
					});
					//html+='</ul>';
					$('#selected_users_data_index').append(html);
					$("#exampleModal").modal('hide');
				}); 
				
				
				$(document).on('click','#select_all',function(){
                if(this.checked){
					$('.select_user_chk').prop('checked',true);
                }else{
                   $('.select_user_chk').prop('checked',false);
                }
				checkAddUserButton();
            });
				
		 });   
		  function checkAddUserButton(){
				 var checkedUserLenth =   $('.select_user_chk:checked').length;
				 if(checkedUserLenth>0){
					$('#adduser').show();
				 }else{
					 $('#adduser').hide();
				 }
			}
		function deleteSelectedUsers(user_id){
				selected_users.splice(selected_users.indexOf(user_id),1);
				//selected_users_data =  remove(selected_users_data,user_id);
			}

        function remove(arr, pid) {
			return arr.filter(e => e.id != pid);
		}
		
		function FormValidation() {
            var valid = true;

            if ($('#type').val() == "") {
                $('#usertype_error').html('Please Select user type');
                valid = false;
            }
            else {
                $('#usertype_error').html('');
            }
            if ($('#notification_title').val() == "") {
                $('#notification_title_error').html('Please enter faq answer');
                valid = false;
            }
            else {
                $('#notification_title_error').html('');
            }
			if ($('#notification_msg').val() == "") {
                $('#notification_msg_error').html('Please enter faq answer');
                valid = false;
            }
            else {
                $('#notification_msg_error').html('');
            }
            return valid;
        }
		
   </script> 
 
</body>
</html>