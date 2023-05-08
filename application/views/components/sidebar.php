  <?php if ($this->session->userdata('method') == 'google') { ?>
    <aside class="main-sidebar">
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
          <div class="pull-left image">
            <img src="<?= $this->session->userdata('picture') ?>" class="img-circle" alt="User Image">
          </div>
          <div class="pull-left info">
            <p><?= ucfirst($this->session->userdata('nama')) ?></p>
            <a href="#"><i class="fa fa-circle text-success"></i> <?php if ($this->session->userdata('level') == '2') {
                                                                    echo "User";
                                                                  } ?></a>
          </div>
        </div>
        <div id="search-form"></div>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <?php if ($this->session->userdata('level') == '1') { ?>
          <ul class="sidebar-menu" data-widget="tree">
            <li class="header">Dashboard</li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <?php if ($this->session->userdata('level') == '1') { ?>
                  <li><a href="<?= base_url('dashboard/admin') ?>"><i class="fa fa-circle-o"></i> Admin</a></li>
                  <li><a href="<?= base_url('dashboard/toko') ?>"><i class="fa fa-circle-o"></i> Toko</a></li>
                <?php } else if ($this->session->userdata('level') == '2') { ?>
                  <li><a href="<?= base_url('dashboard/toko') ?>"><i class="fa fa-circle-o"></i> Toko</a></li>
                <?php } ?>
              </ul>
            </li>
            <li>
              <a href="<?= site_url('databarang') ?>"><i class="fa fa-th"></i> Data Barang</a>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-files-o"></i>
                <span>Laporan</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="#"><i class="fa fa-circle-o"></i> Bulanan</a></li>
                <li><a href="#"><i class="fa fa-circle-o"></i> Mingguan</a></li>
                <li><a href="#"><i class="fa fa-circle-o"></i> Harian</a></li>
              </ul>
            </li>
            <li class="header">User</li>
            <li>
              <a href="<?= site_url('user') ?>">
                <i class="fa fa-users"></i> <span>User</span>
              </a>
            </li>
          </ul>
        <?php } else if ($this->session->userdata('level') == '2') { ?>
          <ul class="sidebar-menu" data-widget="tree">
            <li class="header">Dashboard</li>
            <li>
              <a href="<?= site_url('dashboard/toko') ?>">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
              </a>
            </li>
          </ul>
        <?php } ?>
      </section>
      <!-- /.sidebar -->
    </aside>
  <?php } else { ?>
    <aside class="main-sidebar">
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
          <div class="pull-left image">
            <img src="<?= base_url('uploads/' . $this->fungsi->user_login()->foto_user)  ?>" class="img-circle" alt="User Image">
          </div>
          <div class="pull-left info">
            <p><?= ucfirst($this->session->userdata('nama')) ?></p>
            <a href="#"><i class="fa fa-circle text-success"></i> <?php echo $this->fungsi->user_login()->level_nama ?></a>
          </div>
        </div>
        <div id="search-form"></div>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <?php if ($this->fungsi->user_login()->level == '1') { ?>
          <ul class="sidebar-menu" data-widget="tree">
            <li class="header">Dashboard</li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <?php if ($this->session->userdata('level') == '1') { ?>
                  <li><a href="<?= base_url('dashboard/admin') ?>"><i class="fa fa-circle-o"></i> Admin</a></li>
                  <li><a href="<?= base_url('dashboard/toko') ?>"><i class="fa fa-circle-o"></i> Toko</a></li>
                <?php } else if ($this->session->userdata('level') == '2') { ?>
                  <li><a href="<?= base_url('dashboard/toko') ?>"><i class="fa fa-circle-o"></i> Toko</a></li>
                <?php } ?>
              </ul>
            </li>
            <li>
              <a href="<?= site_url('databarang') ?>"><i class="fa fa-th"></i> Data Barang</a>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-files-o"></i>
                <span>Laporan</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="#"><i class="fa fa-circle-o"></i> Bulanan</a></li>
                <li><a href="#"><i class="fa fa-circle-o"></i> Mingguan</a></li>
                <li><a href="#"><i class="fa fa-circle-o"></i> Harian</a></li>
              </ul>
            </li>
            <li class="header">Pesanan</li>
            <li>
              <a href="#">
                <i class="fa fa-shopping-cart"></i>
                <span>Pesanan</span>
                <span class="pull-right-container">
                  <span class="label label-primary pull-right">4</span>
                </span>
              </a>
            </li>
            <li class="header">User</li>
            <li>
              <a href="<?= site_url('user') ?>">
                <i class="fa fa-users"></i> <span>User</span>
              </a>
            </li>
          </ul>
        <?php } else { ?>
          <ul class="sidebar-menu" data-widget="tree">
            <li class="header">Dashboard</li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <?php if ($this->session->userdata('level') == '1') { ?>
                  <li><a href="<?= base_url('dashboard/admin') ?>"><i class="fa fa-circle-o"></i> Admin</a></li>
                  <li><a href="<?= base_url('dashboard/toko') ?>"><i class="fa fa-circle-o"></i> Toko</a></li>
                <?php } else if ($this->session->userdata('level') == '2') { ?>
                  <li><a href="<?= base_url('dashboard/toko') ?>"><i class="fa fa-circle-o"></i> Toko</a></li>
                <?php } ?>
              </ul>
            </li>
            <li class="header">Keranjang</li>
            <li>
              <a href="#">
                <i class="fa fa-shopping-cart"></i>
                <span>Keranjang</span>
                <span class="pull-right-container">
                  <span class="label label-primary pull-right">4</span>
                </span>
              </a>
            </li>
          </ul>
        <?php } ?>
      </section>
      <!-- /.sidebar -->
    </aside>
  <?php } ?>