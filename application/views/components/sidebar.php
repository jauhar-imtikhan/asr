  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?= base_url() ?>assets/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Alexander Pierce</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <div id="search-form"></div>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
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
            <li><a href="<?= base_url() ?>"><i class="fa fa-circle-o"></i> Dashboard Admin</a></li>
            <li><a href="<?= base_url() ?>"><i class="fa fa-circle-o"></i> Dashboard Toko</a></li>
          </ul>
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
    </section>
    <!-- /.sidebar -->
  </aside>