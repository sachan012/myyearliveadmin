<div class="container">   
    <div class="row padding-top-bot">				
        <div class="table-responsive">
            <table id="contest-table" class="table table-striped- table-bordered dataTable searchusersList">
                <thead>
                <tr>
                <th><input type="checkbox" id="select_all" /> Select all</th>
				    <th style="display:none;">Id</th>
                    <th>full Name</th>
                    <th>Email</th>                   				
                </tr>
                </thead>
                <tbody>
                <?php			
                 if (!empty($data)) {
                    $i = 1;
                    foreach ($data as $row) {
                        ?>
                        <tr class="user_select" id="user_row_data_<?php echo $row['id'];?> ">
                            <td><input type="checkbox" class="select_user_chk"  value="<?php echo $row['id']?>"/></td>
						    <td style="display:none" class="user_id"><?php echo (!empty($row['id']))?$row['id']:'N/A'; ?></td>
                            <td class="display_name"><?php echo $row['fullname']; ?></td>
                            <td class="email_text"><?php echo (!empty($row['email']))?$row['email']:'N/A'; ?></td>                            
                        </tr>
                       
                        <?php
                        $i++;
                    }
                }else{ ?>
					<tr><td colspan="3" class="text-center text-danger">No User Found</td></tr>
					
					
				<?php } ?>                
                </tbody>
            </table>
        </div>
    </div>
	

</div>
<style type="text/css">
    .selected {
       background-color:'red'
    }
	
	</style>
    <script type="text/javascript">
        $(document).ready(function(){
           
           

        });
    </script>
    
  

