<?php $this->load->view('includes/header_script', $data); ?>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
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
          <div class="col-sm-7">
            <!-- <h1>Blank Page</h1> -->
          </div>

          <div class="col-sm-2">
          <?php if(isset($adminid) && $adminid == 1 || $adminid == 3) { ?>
              <button type="button" data-toggle="modal" data-target="#modal-default-invoice" class="btn btn-block btn-success btn-sm">&nbsp;<i class="fa fa-upload" aria-hidden="true"></i>&nbsp;Upload Invoice</button>
          <?php } ?>
            
          </div>

          <div class="col-sm-2">
          <?php if(isset($adminid) && $adminid == 1 || $adminid == 2) { ?>
              <button type="button" data-toggle="modal" data-target="#modal-default-policy" class="btn btn-block btn-success btn-sm">&nbsp;<i class="fa fa-upload" aria-hidden="true"></i>&nbsp;Upload Policy</button>
          <?php } ?>
            
          </div>
          <div class="col-sm-1">
          
             <a href="<?php echo base_url();?>customers/index/all"> <button type="button" class="btn btn-block btn-success btn-sm">&nbsp;<i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;Back</button></a>
            
          </div>

        </div>
      </div>
    </section>

    <!-- Main content -->
    <section class="content">

       <div class="row">
            <!-- <div class="col-lg-2"></div> -->
            <div class="col-lg-12">
                   <?php $this->load->view('includes/msg_alert'); ?>
            </div>
        </div>

      <!-- Default box -->
      <div class="card">
     
        <div class="card-body">
        <?php if(isset($customerdetails)) { ?>
         <div class="table-responsive">
                                <table class="table table-striped b-t b-light">
                                    <!-- <thead>
                                    <tr>
                                        <th><a class="heading" id="option_name">Keys</a></th>
                                        <th><a class="heading" id="option_value">Values</a></th>
                                        <th style="width:100px;"> </th>

                                    </tr>
                                    </thead> -->
                                    <tbody>

                                  <?php if(!empty($customerdetails["company_name"])) { ?>
                                        <tr>
                                             
                                                <td>COMPANY NAME</td>
                                                <td><?php echo ucwords(trim($customerdetails["company_name"]));  ?></td>
                                                <td></td>
                                                </tr>
                                  <?php } ?>



                                  <?php if(!empty($customerdetails["account_number"])) { ?>
                                        <tr>
                                                
                                                <td>ACCOUNT NUMBER</td>
                                                <td><?php echo ucwords(trim($customerdetails["account_number"]));  ?></td>
                                                <td></td>
                                                </tr>
                                  <?php } ?>


                                  <?php if(!empty($customerdetails["company_registration_number"])) { ?>
                                        <tr>
                                                
                                                <td>COMPANY REGISTRATION NUMBER</td>
                                                <td><?php echo ucwords(trim($customerdetails["company_registration_number"]));  ?></td>
                                                <td></td>
                                                </tr>
                                  <?php } ?>
                                  <?php if(!empty($customerdetails["company_vat_number"])) { ?>
                                        <tr>
                                                
                                                <td>COMPANY VAT NUMBER</td>
                                                <td><?php echo ucwords(trim($customerdetails["company_vat_number"]));  ?></td>
                                                <td></td>
                                                </tr>
                                  <?php } ?>
                                  <?php if(!empty($customerdetails["company_industry"])) { ?>
                                        <tr>
                                                
                                                <td>COMPANY INDUSTRY</td>
                                                <td><?php echo ucwords(trim($customerdetails["company_industry"]));  ?></td>
                                                <td></td>
                                                </tr>
                                  <?php } ?>
                                  <?php if(!empty($customerdetails["Website"])) { ?>
                                        <tr>
                                               
                                                <td>COMPANY WEBSITE</td>
                                                <td><?php echo ucwords(trim($customerdetails["Website"]));  ?></td>
                                                <td></td>
                                                </tr>
                                  <?php } ?><?php if(!empty($customerdetails["physical_address"])) { ?>
                                        <tr>
                                               
                                                <td>PHYSICAL ADDRESS</td>
                                                <td><?php echo ucwords(trim($customerdetails["physical_address"]));  ?></td>
                                                <td></td>
                                                </tr>
                                  <?php } ?>
                                  <?php if(!empty($customerdetails["contact_person_first_name"])) { ?>
                                        <tr>
                                                
                                                <td>CONTACT NAME</td>
                                                <td><?php echo ucwords(trim($customerdetails["contact_person_first_name"]." ".$customerdetails["contact_person_last_name"]));  ?></td>
                                                <td></td>
                                                </tr>
                                  <?php } ?>


                                   <?php if(!empty($customerdetails["cell_number"])) { ?>
                                        <tr>
                                                
                                                <td>CELL NUMBER</td>
                                                <td><?php echo ucwords(trim($customerdetails["cell_number"]));  ?></td>
                                                <td></td>
                                                </tr>
                                  <?php } ?>
                                   <?php if(!empty($customerdetails["telephone"])) { ?>
                                        <tr>
                                                
                                                <td>TELEPHONE</td>
                                                <td><?php echo ucwords(trim($customerdetails["telephone"]));  ?></td>
                                                <td></td>
                                                </tr>
                                  <?php } ?>
                                   <?php if(!empty($customerdetails["email"])) { ?>
                                        <tr>
                                                
                                                <td>EMAIL</td>
                                                <td><?php echo ucwords(trim($customerdetails["email"]));  ?></td>
                                                <td></td>
                                                </tr>
                                  <?php } ?>
                                   <?php if(!empty($customerdetails["street_number_and_name"])) { ?>
                                        <tr>
                                                
                                                <td>STREET NUMBER AND NAME</td>
                                                <td><?php echo ucwords(trim($customerdetails["street_number_and_name"]));  ?></td>
                                                <td></td>
                                                </tr>
                                  <?php } ?>
                                   <?php if(!empty($customerdetails["town"])) { ?>
                                        <tr>
                                                
                                                <td>TOWN</td>
                                                <td><?php echo ucwords(trim($customerdetails["town"]));  ?></td>
                                                <td></td>
                                                </tr>
                                  <?php } ?>

                                   <?php if(!empty($customerdetails["city"])) { ?>
                                        <tr>
                                                
                                                <td>CITY</td>
                                                <td><?php echo ucwords(trim($customerdetails["city"]));  ?></td>
                                                <td></td>
                                                </tr>
                                  <?php } ?>


                                  <?php if(!empty($customerdetails["postal_code"])) { ?>
                                        <tr>
                                                
                                                <td>POSTAL CODE</td>
                                                <td><?php echo ucwords(trim($customerdetails["postal_code"]));  ?></td>
                                                <td></td>
                                                </tr>
                                  <?php } ?>
                                  <?php if(!empty($customerdetails["products_and_services"])) { ?>
                                        <tr>
                                                
                                                <td>PRODUCT AND SERVICES</td>
                                                <td><?php echo ucwords(trim($customerdetails["products_and_services"]));  ?></td>
                                                <td></td>
                                                </tr>
                                  <?php } ?>
                                  <?php if(!empty($customerdetails["plan_type"])) { ?>
                                        <tr>
                                                
                                                <td>PLAN TYPE</td>
                                                <td><?php echo ucwords(trim($customerdetails["plan_type"]));  ?></td>
                                                <td></td>
                                                </tr>
                                  <?php } ?>
                                  <?php if(!empty($customerdetails["plan_start_date"])) { ?>
                                        <tr>
                                                
                                                <td>PLAN START DATE</td>
                                                <td><?php echo date("d-m-Y", strtotime(trim($customerdetails["plan_start_date"])));  ?></td>
                                                <td></td>
                                                </tr>
                                  <?php } ?>
                                  <?php if(!empty($customerdetails["plan_end_date"])) { ?>
                                        <tr>
                                                
                                                <td>PLAN END DATE</td>
                                                <td><?php echo date("d-m-Y", strtotime($customerdetails["plan_end_date"]));  ?></td>
                                                <td></td>
                                                </tr>
                                  <?php } ?>
                                  <?php if(!empty($customerdetails["status"])) { ?>
                                        <tr>
                                               
                                                <td>CUSTOMER STATUS</td>
                                                <td colspan="2"><?php

                                                if($customerdetails["status"] == 1)
                                                    { ?>
                                                      <button type="button" class="btn btn-block btn-success btn-sm" style="width: 100px;">ACTIVE</button>
                                                  <?php   } else if ($customerdetails["status"] == 0)  { ?>
                                                      <button type="button" class="btn btn-block btn-danger btn-sm" style="width: 100px;">PENDING</button>
                                                  <?php  } 

                                                  else { ?>

                                                    <button type="button" class="btn btn-block btn-danger btn-sm" style="width: 100px;">BLOCK</button>

                                                  <?php } ?>
                                                </td>
                                                
                                                </tr>
                                  <?php } ?>
                                  <?php if(!empty($customerdetails["registration_status"])) { ?>
                                        <tr>
                                               
                                                <td>REGISTRATION STATUS</td>
                                                <td colspan="2"><?php


                                                if($customerdetails["registration_status"] == 1)
                                                    { ?>
                                                      <button type="button" class="btn btn-block btn-danger btn-sm" style="width: 100px;">PENDING</button>
                                                  <?php   } else if ($customerdetails["status"] == 0)  { ?>
                                                      <button type="button" class="btn btn-block btn-danger btn-sm" style="width: 100px;">PROCESSING</button>
                                                  <?php  } 

                                                  else { ?>

                                                    <button type="button" class="btn btn-block btn-success btn-sm" style="width: 100px;">COMPLETE</button>

                                                  <?php } ?></td>
                                                <td></td>
                                                </tr>
                                  <?php } ?>
                                  <?php if(!empty($customerdetails["approved"])) { ?>
                                        <tr>
                                                
                                                <td>ADMIN APPROVED</td>
                                                <td><?php 


                                                 if($customerdetails["approved"] == 1)
                                                    { ?>
                                                      <button type="button" class="btn btn-block btn-success btn-sm" style="width: 100px;">APPROVED</button>
                                                  <?php   } else { ?>
                                                      <button type="button" class="btn btn-block btn-danger btn-sm" style="width: 100px;">NOT APPROVED</button>
                                                  <?php  } ?></td>
                                                <td></td>
                                                </tr>
                                  <?php } ?>



                                      <?php if(!empty($customerdetails["approve_date"])) { ?>
                                        <tr>
                                                
                                                <td>ADMIN APPROVED DATE</td>
                                                <td><?php 

                                                echo date("d-m-Y", strtotime($customerdetails["approve_date"]));

                                                 ?></td>
                                                <td></td>
                                                </tr>
                                  <?php } ?>


                                  <?php if(!empty($customerdetails["registration_date"])) { ?>
                                        <tr>
                                                
                                                <td>CUSTOMER REGISTRATION DATE</td>
                                                <td><?php echo date("d-m-Y", strtotime(trim($customerdetails["registration_date"])));  ?></td>
                                                <td></td>
                                                </tr>
                                  <?php } ?>
                                  <?php if(!empty($customerdetails["uploaded_by"])) { ?>
                                        <tr>
                                                
                                                <td>UPLOADED VIA</td>
                                                <td><?php if($customerdetails["uploaded_by"] == 1) { echo "Admin Excel Sheet"; } else { echo "Mobile Application"; }   ?></td>
                                                <td></td>
                                                </tr>
                                  <?php } ?>


                                        <?php if(!empty($customerdetails["plan_type"]) || !empty($customerdetails["plan_start_date"]) || !empty($customerdetails["plan_end_date"])) {


                                    $planExpire = peckExpirationdate($customerdetails["plan_start_date"], $customerdetails["plan_end_date"]);
                                  ?>

                                  <?php if($planExpire == 1) { ?>
                                        <tr>
                                              <td>PACK ACTIVATION STATUS</td>
                                                <td>
                                                  <p style="color: green;">Active</p>
                                                </td>
                                                <td></td>
                                        </tr>
                                  <?php } else {   ?>

                                        <tr>
                                              <td>PACK ACTIVATION</td>
                                                <td>
                                                  <p style="color: red;">Expire</p>
                                                </td>
                                                <td></td>
                                        </tr>



                                  <?php } ?>

                            <!--       if customer does not have any pack -->

                                  <?php }  else { ?>

                                    <tr>
                                              <td>PACK ACTIVATION</td>
                                                <td>
                                                  <p style="color: red;">Inactive</p>
                                                </td>
                                                <td>
                                                  

  <button type="button" data-toggle="modal" data-target="#modal-default-plan" class="btn btn-block btn-success btn-sm">&nbsp;Activate</button>



                                                </td>
                                        </tr>


                                  <?php }  ?>


                                  <?php if(!empty($customerdetails["otp_verified"])) { ?>
                                        <tr>
                                                
                                                <td>OTP VERIFY</td>
                                                <td><?php 


                                                if($customerdetails["otp_verified"] == 0)
                                                  {
                                                    echo "<p style='color:red;'>Unverified</p>";
                                                  }
                                                else
                                                  {
                                                    echo "<p style='color:green;'>Verified</p>";
                                                  }



                                                 ?></td>
                                                <td></td>
                                                </tr>
                                  <?php } ?>


                                  <?php if(!empty($customerdetails["user_type"])) { ?>
                                        <tr>
                                                
                                                <td>USER TYPE</td>
                                                <td>
                                                  
                                                  <?php if($customerdetails["user_type"] == 1) { echo "Normal User"; } else { echo "End User"; } ?>

                                                </td>
                                                <td></td>
                                                </tr>
                                  <?php } ?>


         
                                    </tbody>
                                </table>
                            </div>
                          <?php } else { ?>
                            <h1 style="color: red;"><?php echo ucwords("Customer details is not found"); ?></h1>

                          <?php }  ?>
        </div>
        <!-- /.card-body -->
       <!--  <div class="card-footer">
          Footer
        </div> -->
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->
      <hr>

      <!-- Default box -->
      <div class="card">
        <div class="card-header">Documents ( Invoice / Policy )</div>

        <?php

        $document = getWhereWithIdWithAll("customer_doc", array("user_id"=>$customerdetails["id"]));

        ?>
     
        <div class="card-body">

           <table class="table table-striped b-t b-light">
                                    <thead>
                                    <tr>
                                       <!--  <th style="width:20px;">#</th> -->
                                        <th>DOCUMENT TYPE</th>
                                        <th>DOWNLOAD</th>
                                        <th> </th>

                                    </tr>
                                    </thead>
                                    <tbody>

                              <?php foreach($document as $row) { ?>

                                  <?php if(!empty($row["doc_path"])) { ?>
                                        <tr>
                                             
                                                <td>
                                                  
                                                  <?php if($row["doc_type"] == 1) { echo "INVOICE"; } else { echo "POLICY"; } ?>


                                                </td>
                                                <td>
                                                  <a href="<?php echo trim($row["doc_path"]);  ?>" download>DOWNLOAD</a>

                                                  </td>
                                                <td></td>

                                                </tr>
                                <?php } ?>

                                <?php } ?>

                                </tbody>
                          </table>



        </div>
      </div>


    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

 <?php $this->load->view('includes/footer'); ?>

</div>
<!-- ./wrapper -->

<!-- jQuery -->



      <div class="modal fade" id="modal-default-invoice">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Invoice document uplaod</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
  

              
              <div class="card card-primary">
          
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="post" action="<?php echo base_url("customers/uploaddocument/".$customerdetails["id"])?>" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Document Type</label>
                    <select class="form-control" style="width: 100%;" name="doc_type" required>
                    <!-- <option value="">--Select Document Type--</option> -->
                    <option value="1" selected="">Invoice</option>
                    <!-- <option value="2">Policy Document</option> -->
                    
                  </select>
                  </div>
                  

                   <div class="form-group">
                    <label for="exampleInputEmail1">Select Document</label>
                    <input type="file" class="form-control" name="userfile[]" id="userfile"  multiple="multiple" required>
                  </div>
                  
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-success">Submit</button>
                </div>
              </form>
            </div>
            <!-- /.card -->



            </div>
           
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->


       <div class="modal fade" id="modal-default-policy">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Policy document uplaod</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
  

              
              <div class="card card-primary">
          
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="post" action="<?php echo base_url("customers/uploaddocument/".$customerdetails["id"])?>" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Document Type</label>
                    <select class="form-control" style="width: 100%;" name="doc_type" required>
                   <!--  <option value="">--Select Document Type--</option> -->
                   <!--  <option value="1">Invoice</option> -->
                    <option value="2" selected>Policy Document</option>
                    
                  </select>
                  </div>
                  

                   <div class="form-group">
                    <label for="exampleInputEmail1">Select Document</label>
                    <input type="file" class="form-control" name="userfile[]" id="userfile"  multiple="multiple" required>
                  </div>
                  
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-success">Submit</button>
                </div>
              </form>
            </div>
            <!-- /.card -->



            </div>
           
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

      <!-- model for pack activation -->
      <div class="modal fade" id="modal-default-plan">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Pack Activation</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
  
          <?php
             $packs = getWhereWithIdWithAll("credit_plan", array());
          ?>
              <div class="card card-primary">
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="post" action="<?php echo base_url("customers/packactivation/".$customerdetails["id"])?>" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Pack Type</label>
                  <select class="form-control" style="width: 100%;" name="pack_type" required>
                    <option value="">--Select Pack Type--</option>
                    <?php foreach($packs as $row) { ?>
                    <option value="<?php echo $row["id"];?>"><?php echo $row["display_name"];?></option>
                    <?php } ?>
                  </select>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-success">Activate</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
            </div>
           
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

<?php $this->load->view('includes/footer_scripts'); ?>
</body>
</html>
