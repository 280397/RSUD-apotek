<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title><?php echo $title; ?> </title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/fontawesome/css/all.min.css">

  <!-- CSS Libraries -->
  <?php
  if ($this->uri->segment(1) == "" || $this->uri->segment(1) == "Dashboard") { ?>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/jqvmap/dist/jqvmap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/summernote/summernote-bs4.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/owlcarousel2/dist/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/owlcarousel2/dist/assets/owl.theme.default.min.css">

  <?php
  } elseif ($this->uri->segment(1) == "User" || $this->uri->segment(1) == "Satuan" || $this->uri->segment(1) == "Obat" || $this->uri->segment(1) == "Ruang" || $this->uri->segment(1) == "Distributor" || $this->uri->segment(1) == "Obat_transaksi" || $this->uri->segment(1) == "Pengiriman" || $this->uri->segment(1) == "Penerimaan" || $this->uri->segment(1) == "Stok") { ?>
    <!-- General CSS Files -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/fontawesome/css/all.min.css">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/datatables/datatables.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css">

    <style>
      .dataTables_wrapper {
        min-height: 500px
      }

      .dataTables_processing {
        position: absolute;
        top: 50%;
        left: 50%;
        width: 100%;
        margin-left: -50%;
        margin-top: -25px;
        padding-top: 20px;
        text-align: center;
        font-size: 1.2em;
        color: grey;
      }

      body {
        padding: 15px;
      }
    </style>
  <?php
  } ?>

  <!-- Template CSS -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/components.css">
  <!-- Start GA -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
  <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
      dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'UA-94034622-3');
  </script>
  <!-- /END GA -->
</head>

<?php
if ($this->uri->segment(2) == "layout_transparent") {
  $this->load->view('dist/_partials/layout-2');
  $this->load->view('dist/_partials/sidebar-2');
} elseif ($this->uri->segment(2) == "layout_top_navigation") {
  $this->load->view('dist/_partials/layout-3');
  $this->load->view('dist/_partials/navbar');
} elseif (
  $this->uri->segment(1) == "Dashboard"
  || $this->uri->segment(1) == "User"
  || $this->uri->segment(1) == "Satuan"
  || $this->uri->segment(1) == "Obat"
  || $this->uri->segment(1) == "Ruang"
  || $this->uri->segment(1) == "Distributor"
  || $this->uri->segment(1) == "Obat_transaksi"
  || $this->uri->segment(1) == "Pengiriman"
  || $this->uri->segment(1) == "Penerimaan"
  || $this->uri->segment(1) == "Stok"
) {
  $this->load->view('dist/_partials/layout');
  $this->load->view('dist/_partials/sidebar');
} elseif ($this->uri->segment(1) == "Auth") {
}
?>