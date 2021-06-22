<?php
$this->db->select("*")->from("settings");
$this->db->where("id", 1);
$query = $this->db->get();
$settingResult = $query->row_array();
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- icon -->
  <link rel="shortcut icon" href="<?php echo base_url()."assets/uploads/default/default-logo.png"?>" type="image/x-icon">
  <link rel="icon" href="<?php echo base_url()."assets/uploads/default/default-logo.png";?>" type="image/x-icon">


<!-- Select2 -->
<link rel="stylesheet" href="<?php echo assets_url('plugins','select2/css/select2.min.css'); ?>">

<!-- <link rel="stylesheet" href="<?php echo assets_url('plugins','bootstrap-datepicker/css/bootstrap-datepicker.min.css');?>"> -->

  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo assets_url('plugins','fontawesome-free/css/all.min.css'); ?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->

  <link rel="stylesheet" href="<?php echo assets_url('plugins','tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css'); ?>">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo assets_url('plugins','icheck-bootstrap/icheck-bootstrap.min.css'); ?>">
  <!-- JQVMap -->
  <!-- <link rel="stylesheet" href=" <?php echo assets_url('plugins','jqvmap/jqvmap.min.css'); ?>"> -->
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo assets_url('dist','css/adminlte.min.css'); ?>">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?php echo assets_url('plugins','overlayScrollbars/css/OverlayScrollbars.min.css'); ?>">
  <!-- Daterange picker -->
  <!-- <link rel="stylesheet" href="<?php echo assets_url('plugins','daterangepicker/daterangepicker.css'); ?>"> -->
  <!-- summernote -->
   <link rel="stylesheet" href="<?php echo assets_url('plugins','summernote/summernote-bs4.css'); ?>"> 
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">


   <link rel="stylesheet" href="<?php echo assets_url('plugins','toastr/toastr.min.css'); ?>">

   <link rel="stylesheet" href="<?php echo assets_url('plugins','sweetalert2-theme-bootstrap-4/bootstrap-4.min.css'); ?>">

      <link href= 
'https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/ui-lightness/jquery-ui.css'
          rel='stylesheet'> 
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">



  <title>Admin Panel | <?php echo ucwords(trim(($title)));?></title>
  <title>RaS E-Tender</title>
    <script>
        var BASE_URL = "<?php echo base_url(); ?>";
    </script>
</head>
<!-- <body class="hold-transition sidebar-mini layout-fixed"> -->
