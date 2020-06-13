<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class="main-sidebar sidebar-style-2">
  <aside id="sidebar-wrapper">
    <div class="sidebar-brand">
      <a href="#">Apotek-RSUD Genteng</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
      <a href="#">rsud</a>
    </div>
    <ul class="sidebar-menu">
      <li class="menu-header">Transaction</li>
      <!-- <li class="<?php echo $this->uri->segment(1) == 'Dashboard' ? 'active' : ''; ?>">
        <a href="<?= site_url('Dashboard') ?>" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
      </li> -->

      <li class="<?php echo $this->uri->segment(1) == 'Stok' ? 'active' : ''; ?>">
        <a href="<?= site_url('Stok') ?>" class="nav-link"><i class="fas fa-fire"></i><span>Stok</span></a>
      </li>

      <!-- Gudang -->
      <?php if ($this->fungsi->user_login()->level == 1 || $this->fungsi->user_login()->level == 2) { ?>
        <li class="<?php echo $this->uri->segment(1) == 'Distributor' ? 'active' : ''; ?>">
          <a href="<?= site_url('Distributor') ?>" class="nav-link"><i class="fas fa-truck-moving"></i><span>Distributor</span></a>
        </li>

        <li class="<?php echo $this->uri->segment(1) == 'Obat' ? 'active' : ''; ?>">
          <a href="<?= site_url('Obat') ?>" class="nav-link"><i class="fas fa-capsules"></i><span>Master</span></a>
        </li>
        <li class="<?php echo $this->uri->segment(1) == 'Obat_transaksi' ? 'active' : ''; ?>">
          <a href="<?= site_url('Obat_transaksi') ?>" class="nav-link"><i class="fas fa-shopping-cart"></i><span>Pembelian</span></a>
        </li>
      <?php } ?>

      <!-- All User -->

      <li class="<?php echo $this->uri->segment(1) == 'Pengiriman' ? 'active' : ''; ?>">
        <a href="<?= site_url('Pengiriman') ?>" class="nav-link"><i class="fas fa-luggage-cart"></i><span>Pengiriman</span></a>
      </li>
      <li class="<?php echo $this->uri->segment(1) == 'Penerimaan' ? 'active' : ''; ?>">
        <a href="<?= site_url('Penerimaan') ?>" class="nav-link"><i class="fab fa-accusoft"></i><span>Penerimaan</span></a>
      </li>

      <!-- Admin Only -->
      <?php if ($this->fungsi->user_login()->level == 1) { ?>
        <li class="menu-header">Setting</li>
        <li class="<?php echo $this->uri->segment(1) == 'Ruang' ? 'active' : ''; ?>">
          <a href="<?= site_url('Ruang') ?>" class="nav-link"><i class="fas fa-hospital-alt"></i><span>Ruang</span></a>
        </li>
        <li class="<?php echo $this->uri->segment(1) == 'Satuan' ? 'active' : ''; ?>">
          <a href="<?= site_url('Satuan') ?>" class="nav-link"><i class="fas fa-sitemap"></i><span>Satuan</span></a>
        </li>
        <li class="dropdown <?php echo $this->uri->segment(1) == 'User' || $this->uri->segment(2) == 'index_0' ? 'active' : ''; ?>">
          <a href="#" class="nav-link has-dropdown"><i class="fas fa-users"></i><span>User</span></a>
          <ul class="dropdown-menu">
            <li class="<?php echo $this->uri->segment(1) == 'User' ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo base_url(); ?>User">User Data</a></li>
          </ul>
        </li>
      <?php } ?>
    </ul>

    <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
      <a href="<?= site_url('Auth/logout') ?>" class="btn btn-primary btn-lg btn-block btn-icon-split">
        <i class="fas fa-rocket"></i> Logout
      </a>
    </div>
  </aside>
</div>