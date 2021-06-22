<!-- DataTables -->
<style type="text/css">
  .pagination > .active > a, .pagination > .active > span, .pagination > .active > a:hover, .pagination > .active > span:hover, .pagination > .active > a:focus, .pagination > .active > span:focus {
    z-index: 2;
    color: #fff;
    cursor: default;
    background-color: #337ab7;
    border-color: #337ab7;
}
.pagination > li > a {
    border-color: #dee5e7;
}
.pagination-sm > li > a, .pagination-sm > li > span {
    padding: 5px 10px;
    font-size: 12px;
}
.pagination > li > a, .pagination > li > span {
    position: relative;
    float: left;
    padding: 6px 12px;
    margin-left: -1px;
    line-height: 1.42857143;
    color: #337ab7;
    text-decoration: none;
    background-color: #fff;
    border: 1px solid #ddd;
}
.pagination-sm > li > a, .pagination-sm > li > span {
    padding: 5px 10px;
    font-size: 12px;
}
.pagination > li > a, .pagination > li > span {
    position: relative;
    float: left;
    padding: 6px 12px;
    margin-left: -1px;
    line-height: 1.42857143;
    color: #337ab7;
    text-decoration: none;
    background-color: #fff;
    border: 1px solid #ddd;
}

.spinner {
  position: fixed;
  z-index: 1;
  left: 0;
  right: 0;
  top: 0;
  bottom: 0;
  background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='40' height='40' viewBox='0 0 50 50'%3E%3Cpath d='M28.43 6.378C18.27 4.586 8.58 11.37 6.788 21.533c-1.791 10.161 4.994 19.851 15.155 21.643l.707-4.006C14.7 37.768 9.392 30.189 10.794 22.24c1.401-7.95 8.981-13.258 16.93-11.856l.707-4.006z'%3E%3CanimateTransform attributeType='xml' attributeName='transform' type='rotate' from='0 25 25' to='360 25 25' dur='0.6s' repeatCount='indefinite'/%3E%3C/path%3E%3C/svg%3E") center / 254px no-repeat;
}


</style>
<?php $this->load->view('includes/header_script', $data); ?>
<body class="hold-transition sidebar-mini">
  <div class="wrapper">
  <!-- Navbar -->
   <?php $this->load->view('includes/header', $data); ?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php $this->load->view('includes/sidebar'); ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
           <h1 class="m-0 text-dark"><?php echo ucwords(trim(($title)));?></h1> 
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url("dashboard");?>">Home</a></li>
              <li class="breadcrumb-item active"><?php echo ucwords(trim(($title)));?></li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    
  <div class="spinner" style="display:none;"></div>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
         <div class="row">
            <!-- <div class="col-lg-2"></div> -->
            <div class="col-lg-12 text-center">
                   <?php $this->load->view('includes/msg_alert'); ?>
            </div>
        </div>
        <div class="row mt-5">
          <div class="col-sm-12">
             <?php //echo "<pre>";print_r($this->session->all_userdata());?>
            <form method="post" id="filter_form" name="filter_form" action="<?php if(isset($getData['page']) && $getData['page']!='0' && $getData['page']!='all'){echo base_url('users/index/'.$getData['page']);}else{ echo base_url('users/index'); } ?>" class="form-horizontal">
              <div class="card">
                <div class="card-header" style="display: none;">
                  <h3 class="card-title"><i class="fa fa-search "></i> Filter Your Results</h3>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                      <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                      <i class="fas fa-times"></i></button>
                  </div>
                </div>
                <div class="card-body" style="padding-bottom: 0rem !important;padding-top: 1rem !important;">
                  <div class="row">
                    <div class="col-md-8">
                      <div class="row">
                        <div class="col-md-4"> 
                          <input type="text" placeholder="Search By Name" class="form-control like"  maxlength="255"  value="<?php if(isset($FormData['like']['fullname'])){echo $FormData['like']['fullname'];} ?>" name="FormData[like][fullname]" id="fullname" >
                        </div>                       
                        <div class="col-md-4"> 
                          <input type="text" placeholder="Search by Email Id" class="form-control like"  maxlength="255"  value="<?php if(isset($FormData['like']['email'])){echo $FormData['like']['email'];} ?>" name="FormData[like][email]" id="email" >
                        </div>
                        <!-- <div class="col-md-3"> 
                          <input type="text" placeholder="Search Phone" class="form-control like"  maxlength="255"  value="<?php if(isset($FormData['like']['phone'])){echo $FormData['like']['phone'];} ?>" name="FormData[like][phone]" id="phone" >
                        </div> -->
                      </div>
                      <div class="form-group">                                          
                        <!--sorting-->
                        <input type="hidden" name="FormData[sort][field]" id="field" value="<?php if(isset($FormData['sort']['field'])){echo $FormData['sort']['field'];} ?>"/>
                        <input type="hidden" name="FormData[sort][order]" id="order" value="<?php if(isset($FormData['sort']['order'])){echo $FormData['sort']['order'];} ?>"/>
                        <!--page-->
                        <input type="hidden" name="FormData[form_name]" id="form_name" value="" />
                        <input type="hidden" name="FormData[sort][page]" id="page" value="<?php if(isset($getData['page'])) {echo $getData['page']; } ?>"/>
                      </div>
                    </div>
                    <div class="col-md-4 text-right">
                      <button type="button" class="btn btn-success" id="filter"><i class="fa fa-search"></i> Search</button>
                        <a href="<?php echo base_url(); ?>users/index/all"><button class="m-l-lg btn btn-default" type="button">Reset</button></a>
                    </div>
                  </div>
                </div>
              <!-- /.card-body -->       
              </div>            
            </form>
          </div>
        </div>
        <div class="row">
          <div class="col-12">            
            <!-- /.card -->
            <div class="card">
              <div class="card-header" >
               
              </div>
              <!-- /.card-header -->
              <div class="card-body">              
              <div class="table-responsive">                       
                <table id="" class="table table-bordered table-striped text-nowrap">
                  <thead>
                    <tr>
                      <!-- <th><input type="checkbox" id="select_all" /></th> -->
                      <th>SN</th>
                      <th>Full Name</th>                   
                      <th>Email Id</th>
                      <!-- <th>Phone</th> -->
                      <th>Device Type</th>
                      <!-- <th>Status</th> -->
                      <th>Created DateTime</th>                  
                    </tr>
                  </thead>
                  
                  <tbody>
                    <?php if($dbdata>0) { ?>
                    <!-- <form name="frmgrouplist" id="frmitf" action="" method="post"> -->
                    <?php $i=1;  foreach($dbdata as $row) {  ?>
                    <tr>
                        <!-- <td><input type="checkbox" id="<?php echo 'id'.$row['id'];?>" class="checkbox" name="checkboxSelect[]" value="<?php //echo $row["device_token"]?>"/></td> -->
                        <td><?php echo $i++;?></td>                    
                        <td><?php echo ucwords($row["fullname"]);?></td>                     
                        <td><?php echo $row["email"];?></td> 
                        <!-- <td><?php //echo $row["phone"];?></td>  -->
                        <td><?php echo $row["device_type"];?></td>
                        <?php /* -- ?>
                        <td><i style="cursor: pointer;" 
                              data="<?php echo $row['id'];?>" class="badge badge-warning status_checks label label-sm <?php echo $row['status']?
                                                  'badge-success': 'badge-danger'?>"><?php echo $row['status'] ? 'Active' : 'Inactive'?>
                                                 </i></td> 
                        <?php --------*/?>
                        <td><?php echo date("Y-m-d H:i:s", strtotime($row["created_on"]));?></td>
                    </tr>
                <?php }?>
                <!-- <tr id="sendNotification" style="display:none">
                  <td colspan="8"><input type="submit" value="send Notifiction" class="sendNotofiation"></td>
                  </tr> -->
               
                </form>
                <?php } else{ ?>
                  <tr><td colspan="8" class="text-center">No User is found</td></tr>
                <?php } ?>                  
                  </tbody>
                 
                </table>              
              </div>
        <div class="card-footer">
         <div class="row text-right" style="float: right;">
                            <div class="col-md-12" >
                                <?php echo $pagination; ?>
                            </div>
                            
                        </div>
        </div>



              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
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

<!-- jQuery -->

<?php $this->load->view('includes/footer_scripts'); ?>

<script type="text/javascript">
    SyonApp.setPage('UserList');
    SyonApp.init();
</script>

<script type="text/javascript">
$(document).ready(function(){
  
    $('#select_all').on('click',function(){
        if(this.checked){                   
            $('.checkbox').each(function(){
                this.checked = true;
                $('#sendNotification').css('display','block');                
            });
        }else{
             $('.checkbox').each(function(){
                this.checked = false;
                $('#sendNotification').css('display','none');               
            });
        }
    });

    $('.checkbox').on('click',function(){
      var as = $(this).attr('id');
      //alert(as);
      if($('#'+as).is(':checked')){
        $('#sendNotification').css('display','block'); 
      }else{
            $('#sendNotification').css('display','none'); 
          }

      $('.checkbox').each(function(){
        if($(this).is(':checked')){
                $('#sendNotification').css('display','block'); 
        }               
        });

      });
      



      // if($('#'+as).is(':unchecked')){
      //   $('#sendNotification').css('display','none'); 
      // }
      
      








  
    
   
   

   

   
});
</script>













<script type="text/javascript">
  
function customerstatus(item)
{

  var result = confirm("Are you sure to perform this operation?");
            if (result) 
    {
        var str = item;  
        var res = str.split("_");
        var id = res[1];  // getting the customer id
        var status = res[0];  // getting the status of user

        $.ajax({
                  type: "POST",
                  url: "<?php echo base_url();?>user-approve/"+id + "/"+status,
                   beforeSend: function(){
                       $('.spinner').show()
                   },
                  success: function(result){
                      //alert(result);
                      console.log(result);
                  },
                  complete: function(){
                       $('.spinner').hide();
                  }
              });
   }
}


</script>
<script type="text/javascript">
    $(document).on('click','.status_checks',function(){
      var status = ($(this).hasClass("badge-success")) ? '0' : '1';
      var msg = (status=='0')? 'Deactivate' : 'Activate';
      if(confirm("Are you sure to "+ msg)){
        var current_element = $(this);
        url = "<?php echo site_url('users/statusChangeAjax');?>";
        $.ajax({
          type:"POST",
          url: url,
          data: {id:$(current_element).attr('data'),status:status},
          success: function(data)
          {
            //console.log(data);
            location.reload();
          }
        });
      }
    });
</script>

</body>
</html>





