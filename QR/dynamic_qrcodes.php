<?php
session_start();
require_once 'config/config.php';
require_once 'includes/auth_validate.php';
require_once 'lib/DynamicQrcode/DynamicQrcode.php';

$db = getDbInstance();
$dynamic_qrcode = new DynamicQrcode();

$select = array('id', 'id_owner', 'filename', 'identifier', 'link', 'qrcode', 'scan', 'state', 'created_at', 'updated_at');
$search_fields = array('filename', 'identifier', 'link');
require_once 'includes/search_order.php';
$page = filter_input(INPUT_GET, 'page', FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?? 1;
$db->pageLimit = 15;

if($_SESSION['type'] !==  'super') {
    $db->where("id_owner", $_SESSION['user_id']);
    $db->orWhere ("id_owner", NULL, 'IS');
}

$rows = $db->arraybuilder()->paginate('dynamic_qrcodes', $page, $select);

$total_pages = $db->totalPages;
?>


<!DOCTYPE html>
<html lang="en">
    <title>Qrcode Generator</title>
    <head>
    <?php include 'includes/head.php'; ?>
    </head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">
  <!-- Navbar -->
  <?php include 'includes/navbar.php'; ?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php include 'includes/sidebar.php'; ?>
    <!-- /.Main Sidebar Container -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
            
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dynamic Qr codes</h1>
          </div><!-- /.col -->
          
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item">
                  <a href="dynamic_qrcode.php" class="btn btn-success"><i class="fa fa-plus"></i> Add new</a>
                </li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div><!-- /.content-header -->
    
    <!-- Flash message-->
    <?php include 'includes/flash_messages.php'; ?>
    <!-- /.Flash message-->
            
    <!-- Filters -->
    <?php $options = $dynamic_qrcode->setOrderingValues();

          include 'forms/filters.php'; ?>  
    <!-- /.Filters-->
    
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
          
        <!-- Table -->
        <?php include 'forms/table_dynamic.php'; ?>
        <!-- /.Table -->
    
        </div><!-- /.container-fluid -->
    </section>
  </div><!-- /.content-wrapper -->

    <!-- Footer and scripts -->
    <?php include 'includes/footer.php'; ?>
    <!-- /.Footer and scripts -->
</body>
</html>
