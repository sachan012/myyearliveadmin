<?php
$role_type = trim(getSessionUserData("role_type"));
$rolename = getAdminRoleInfo($role_type, $table = "roles");  // geting the user role
$this->db->select("*")->from("settings");
$this->db->where("id", 1);
$query = $this->db->get();
$settingResult = $query->row_array();

$activeclass = strtolower($this->router->fetch_class());
$activemethode = strtolower($this->router->fetch_method());
?>

<style type="text/css">
  .nav-sidebar>.nav-item {
    margin-bottom: 0px;
    font-size: 13px!important;
}
</style>
<aside class="main-sidebar sidebar-light-danger elevation-4">
<!-- <aside class="main-sidebar sidebar-dark-primary elevation-4"> -->
    <!-- Brand Logo -->
  
    <a href="<?php echo base_url("dashboard");?>" class="brand-link">
      <?php /*----------------------- ?>
      <img src="<?php echo base_url()."assets/uploads/logo/".$settingResult["logo"];?>" alt="<?php echo ucwords($settingResult["application_name"]); ?>" class="brand-image">
      <?php ----------------------- */?>
      <span class="brand-text font-weight-bold"><?php echo ucwords('myyearliveadmin');?></span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar" style="border-top: 5px solid #249946;">
      <!-- Sidebar user panel (optional) -->

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview menu-open">
            <a href="<?php echo base_url(); ?>dashboard" class="nav-link <?php if($activeclass == strtolower("Dashboard")) { echo "active"; }?>">
               <img src="<?php echo base_url();?>assets/uploads/admin_left_menu/quote-type.png" class="img-responsive">&nbsp;<?php echo " Dashboard";?>              
            </a> 
          </li>

        <?php if(!empty($rolename["role_id"]) && $rolename["role_id"] == 1) { ?>
             
              <li class="nav-item">
                <a href="<?php echo base_url();?>users/index/all" class="nav-link <?php if($activeclass == strtolower("Users")) { echo "active"; }?>">
                   <img src="<?php echo base_url();?>assets/uploads/admin_left_menu/leads.png" class="img-responsive">&nbsp;
                  <p><?php echo strtoupper("Users"); ?></p>
                   &nbsp;<i style="float:right; margin-top: 6px;" class="fa fa-chevron-right nav-icon" aria-hidden="true"></i>
                </a>
              </li> 

              <li class="nav-item">
                <a href="<?php echo base_url();?>notification/index" class="nav-link <?php if($activeclass == strtolower("notification")) { echo "active"; }?>">
                   <img src="<?php echo base_url();?>assets/uploads/admin_left_menu/leads.png" class="img-responsive">&nbsp;
                  <p><?php echo strtoupper("Send Notification"); ?></p>
                   &nbsp;<i style="float:right; margin-top: 6px;" class="fa fa-chevron-right nav-icon" aria-hidden="true"></i>
                </a>
              </li>
               
        <?php } ?>         
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>