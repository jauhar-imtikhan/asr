<?php if ($this->session->userdata('method') == 'google') { ?>
  <header class="main-header">
    <!-- Logo -->
    <a href="<?= base_url() ?>assets/index2.html" class="logo">

      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>A</b>SR</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>ASR</b>Furniture</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-envelope-o"></i>
              <span class="label label-success">4</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 4 messages</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li><!-- start message -->
                    <a href="#">
                      <div class="pull-left">
                        <img src="<?= base_url() ?>assets/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Support Team
                        <small><i class="fa fa-clock-o"></i> 5 mins</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                  <!-- end message -->
                </ul>
              </li>
              <li class="footer"><a href="#">See All Messages</a></li>
            </ul>
          </li>
          <!-- Notifications: style can be found in dropdown.less -->
          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning"><?php
                                                if (isset($all_notif)) {
                                                  echo $all_notif;
                                                } else {
                                                  echo $all_notif;
                                                }
                                                ?></span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">Anda Memiliki <? if (isset($all_notif)) {
                                                  echo $all_notif;
                                                }
                                                ?> Notifikasi! <span class="pull-right" data-toggle="tooltip" data-placement="right" title="Hapus Semua Notifikasi"><a href="<?= site_url('allnotif/deleteall/' . $this->session->userdata('userid')) ?>" class="text-red"> <i class="fa fa-trash"></i></a></span></li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <?php
                  if (isset($getnotif)) {
                    foreach ($getnotif as $notif) { ?>
                      <li>
                        <a href="<?= site_url('allnotif/delbyid/' . $notif->id) ?>" data-toggle="tooltip" data-placement="bottom" title="Hapus Notifikasi Ini">
                          <i class="<?= $notif->icon_notif ?>"></i><?= $notif->isi_notif ?>
                          <span class="pull-right"><i class="fa fa-trash text-red"></i></span>
                        </a>
                      </li>
                  <?php }
                  }  ?>
                </ul>
              </li>
              <li class="footer"><a href="#">View all</a></li>
            </ul>
          </li>

          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">

              <img src="<?= $this->session->userdata('picture') ?>" class="user-image" alt="User Image">
              <span class="hidden-xs"><?= ucfirst($this->session->userdata('nama')) ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">

                <img src="<?= $this->session->userdata('picture') ?>" class="img-circle" alt="User Image">

                <p>
                  <?= $this->session->userdata('email') ?>
                  <small>Anda Login Pada : <?= $this->session->userdata('jam') ?></small>
                </p>
              </li>
              <!-- Menu Body -->

              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <?php if ($this->session->userdata('level') == '1') { ?>
                    <a href="<?= site_url('profile/user') ?>" class="btn btn-default btn-flat">Profile</a>
                  <?php } else if ($this->session->userdata('level') == '2') { ?>
                    <a href="<?= site_url('profile/user') ?>" class="btn btn-default btn-flat">Profile</a>
                  <?php } ?>
                </div>
                <div class="pull-right">
                  <a href="<?= site_url('auth/logout') ?>" class="btn btn-default btn-flat">Log out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
<?php } else { ?>
  <?php if ($this->session->userdata('level') == '1') { ?>
    <header class="main-header ">
      <!-- Logo -->
      <a href="<?= base_url() ?>assets/index2.html" class="logo">

        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>A</b>SR</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>ASR</b>Furniture</span>
      </a>
      <!-- Header Navbar: style can be found in header.less -->
      <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </a>

        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <!-- Messages: style can be found in dropdown.less-->
            <li class="dropdown messages-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-envelope-o"></i>
                <span class="label label-success">4</span>
              </a>
              <ul class="dropdown-menu">
                <li class="header">You have 4 messages</li>
                <li>
                  <!-- inner menu: contains the actual data -->
                  <ul class="menu">
                    <li><!-- start message -->
                      <a href="#">
                        <div class="pull-left">
                          <img src="<?= base_url() ?>assets/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                        </div>
                        <h4>
                          Support Team
                          <small><i class="fa fa-clock-o"></i> 5 mins</small>
                        </h4>
                        <p>Why not buy a new awesome theme?</p>
                      </a>
                    </li>
                    <!-- end message -->
                  </ul>
                </li>
                <li class="footer"><a href="#">See All Messages</a></li>
              </ul>
            </li>
            <!-- Notifications: style can be found in dropdown.less -->
            <li class="dropdown notifications-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-bell-o"></i>
                <span class="label label-warning"><?php
                                                  if (isset($all_notif)) {
                                                    echo $all_notif;
                                                  } else {
                                                    echo $all_notif;
                                                  }
                                                  ?></span>
              </a>
              <ul class="dropdown-menu">
                <li class="header">Anda Memiliki <? if (isset($all_notif)) {
                                                    echo $all_notif;
                                                  }
                                                  ?> Notifikasi! <span class="pull-right" data-toggle="tooltip" data-placement="right" title="Hapus Semua Notifikasi"><a href="<?= site_url('allnotif/deleteall/' . $this->session->userdata('userid')) ?>" class="text-red"> <i class="fa fa-trash"></i></a></span></li>
                <li>
                  <!-- inner menu: contains the actual data -->
                  <ul class="menu">
                    <?php
                    if (isset($getnotif)) {
                      foreach ($getnotif as $notif) { ?>
                        <li>
                          <a href="<?= site_url('allnotif/delbyid/' . $notif->id) ?>" data-toggle="tooltip" data-placement="bottom" title="Hapus Notifikasi Ini">
                            <i class="<?= $notif->icon_notif ?>"></i><?= $notif->isi_notif ?>
                            <span class="pull-right"><i class="fa fa-trash text-red"></i></span>
                          </a>
                        </li>
                    <?php }
                    }  ?>
                  </ul>
                </li>
                <li class="footer"><a href="#">View all</a></li>
              </ul>
            </li>

            <!-- User Account: style can be found in dropdown.less -->
            <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">

                <img src="<?= base_url('uploads/') . $this->fungsi->user_login()->foto_user ?>" class="user-image" alt="User Image">
                <span class="hidden-xs"><?= ucfirst($this->session->userdata('nama')) ?></span>
              </a>
              <ul class="dropdown-menu">
                <!-- User image -->
                <li class="user-header">

                  <img src="<?= base_url('uploads/') . $this->fungsi->user_login()->foto_user  ?>" class="img-circle" alt="User Image">

                  <p>
                    <?= $this->session->userdata('email') ?>
                    <small>Anda Login Pada : <?= $this->session->userdata('jam') ?></small>
                  </p>
                </li>
                <!-- Menu Body -->

                <!-- Menu Footer-->
                <li class="user-footer">
                  <div class="pull-left">
                    <?php if ($this->session->userdata('level') == '1') { ?>
                      <a href="<?= site_url('profile/user') ?>" class="btn btn-default btn-flat">Profile</a>
                    <?php } else if ($this->session->userdata('level') == '2') { ?>
                      <a href="<?= site_url('profile/user') ?>" class="btn btn-default btn-flat">Profile</a>
                    <?php } ?>
                  </div>
                  <div class="pull-right">
                    <a href="<?= site_url('auth/logout') ?>" class="btn btn-default btn-flat">Log out</a>
                  </div>
                </li>
              </ul>
            </li>
            <!-- Control Sidebar Toggle Button -->
            <li>
              <a href="#" data-toggle="control-sidebar"><i class="fa fa-gear"></i></a>
            </li>
          </ul>
        </div>
      </nav>
    </header>
  <?php } else { ?>
    <header class="main-header">
      <nav class="navbar navbar-static-top">
        <div class="container">
          <div class="navbar-header">
            <a href="<?= site_url('dashboard/toko') ?>" class="navbar-brand"><b>ASR</b>Furniture</a>
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
              <i class="fa fa-bars"></i>
            </button>
          </div>

          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
            <ul class="nav navbar-nav">
              <li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li>
              <li><a href="#">Link</a></li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="#">Action</a></li>
                  <li><a href="#">Another action</a></li>
                  <li><a href="#">Something else here</a></li>
                  <li class="divider"></li>
                  <li><a href="#">Separated link</a></li>
                  <li class="divider"></li>
                  <li><a href="#">One more separated link</a></li>
                </ul>
              </li>
            </ul>
            <form class="navbar-form navbar-left" role="search">
              <div class="form-group">
                <input type="text" class="form-control" id="navbar-search-input" placeholder="Search">
              </div>
            </form>
          </div>
          <!-- /.navbar-collapse -->
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->
              <li class="dropdown messages-menu">
                <!-- Menu toggle button -->
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-envelope-o"></i>
                  <span class="label label-success">4</span>
                </a>
                <ul class="dropdown-menu">
                  <li class="header">You have 4 messages</li>
                  <li>
                    <!-- inner menu: contains the messages -->
                    <ul class="menu">
                      <li><!-- start message -->
                        <a href="#">
                          <div class="pull-left">
                            <!-- User Image -->
                            <img src="../../dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                          </div>
                          <!-- Message title and timestamp -->
                          <h4>
                            Support Team
                            <small><i class="fa fa-clock-o"></i> 5 mins</small>
                          </h4>
                          <!-- The message -->
                          <p>Why not buy a new awesome theme?</p>
                        </a>
                      </li>
                      <!-- end message -->
                    </ul>
                    <!-- /.menu -->
                  </li>
                  <li class="footer"><a href="#">See All Messages</a></li>
                </ul>
              </li>
              <!-- /.messages-menu -->

              <li class="dropdown notifications-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-bell-o"></i>
                  <span class="label label-warning"><?php
                                                    if (isset($all_notif)) {
                                                      echo $all_notif;
                                                    } else {
                                                      echo $all_notif;
                                                    }
                                                    ?></span>
                </a>
                <ul class="dropdown-menu">
                  <li class="header">Anda Memiliki <? if (isset($all_notif)) {
                                                      echo $all_notif;
                                                    }
                                                    ?> Notifikasi! <span class="pull-right" data-toggle="tooltip" data-placement="right" title="Hapus Semua Notifikasi"><a href="<?= site_url('allnotif/deleteall/' . $this->session->userdata('userid')) ?>" class="text-red"> <i class="fa fa-trash"></i></a></span></li>
                  <li>
                    <!-- inner menu: contains the actual data -->
                    <ul class="menu">
                      <?php
                      if (isset($getnotif)) {
                        foreach ($getnotif as $notif) { ?>
                          <li>
                            <a href="<?= site_url('allnotif/delbyid/' . $notif->id) ?>" data-toggle="tooltip" data-placement="bottom" title="Hapus Notifikasi Ini">
                              <i class="<?= $notif->icon_notif ?>"></i><?= $notif->isi_notif ?>
                              <span class="pull-right"><i class="fa fa-trash text-red"></i></span>
                            </a>
                          </li>
                      <?php }
                      }  ?>
                    </ul>
                  </li>
                  <li class="footer"><a href="#">View all</a></li>
                </ul>
              </li>

              <!-- User Account Menu -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">

                  <img src="<?= base_url('uploads/') . $this->fungsi->user_login()->foto_user ?>" class="user-image" alt="User Image">
                  <span class="hidden-xs"><?= ucfirst($this->session->userdata('nama')) ?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">

                    <img src="<?= base_url('uploads/') . $this->fungsi->user_login()->foto_user  ?>" class="img-circle" alt="User Image">

                    <p>
                      <?= $this->session->userdata('email') ?>
                      <small>Anda Login Pada : <?= $this->session->userdata('jam') ?></small>
                    </p>
                  </li>
                  <!-- Menu Body -->

                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <?php if ($this->session->userdata('level') == '1') { ?>
                        <a href="<?= site_url('profile/user') ?>" class="btn btn-default btn-flat">Profile</a>
                      <?php } else if ($this->session->userdata('level') == '2') { ?>
                        <a href="<?= site_url('profile/user') ?>" class="btn btn-default btn-flat">Profile</a>
                      <?php } ?>
                    </div>
                    <div class="pull-right">
                      <a href="<?= site_url('auth/logout') ?>" class="btn btn-default btn-flat">Log out</a>
                    </div>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
          <!-- /.navbar-custom-menu -->
        </div>
        <!-- /.container-fluid -->
      </nav>
    </header>
  <?php } ?>
<?php } ?>