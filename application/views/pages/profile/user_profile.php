<section class="content">
    <?php if (isset($error, $alamat)) { ?>
        <?= $error ?>
        <?php if ($this->session->userdata('level') == '2') : ?>
            <div class="row">
                <div class="col-md-3">
                    <!-- Profile Image -->
                    <div class="box box-primary">
                        <div class="box-body box-profile">
                            <img class="profile-user-img img-responsive img-circle" src="<?= $this->session->userdata('picture') ?>" alt="User profile picture">

                            <h3 class="profile-username text-center"><?= ucfirst($this->session->userdata('nama')) ?></h3>

                            <p class="text-muted text-center"><?= $this->session->userdata('email') ?></p>


                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->

                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#settings" data-toggle="tab">Settings</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane" id="settings" style="display: block;">
                                <form class="form-horizontal">
                                    <div class="form-group">
                                        <label for="inputName" class="col-sm-2 control-label">Nama Lengkap</label>

                                        <div class="col-sm-10">
                                            <input type="email" class="form-control" id="inputName" value="<?= $this->session->userdata('nama') ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail" class="col-sm-2 control-label">Email</label>

                                        <div class="col-sm-10">
                                            <input type="email" class="form-control" id="inputEmail" disabled value="<?= $this->session->userdata('email') ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputName" class="col-sm-2 control-label">Level</label>

                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="inputName" disabled value="<?php if ($this->session->userdata('level') == '2') {
                                                                                                                        echo 'User';
                                                                                                                    } ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputExperience" class="col-sm-2 control-label">Alamat</label>

                                        <div class="col-sm-10">
                                            <textarea class="form-control" id="inputExperience" disabled><?= $alamat ?></textarea>
                                        </div>
                                    </div>

                                </form>
                            </div>
                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div>
                    <!-- /.nav-tabs-custom -->
                </div>
                <!-- /.col -->
            </div>
        <?php endif; ?>
    <?php  } else { ?>
        <div class="row">
            <div class="col-md-3">
                <!-- Profile Image -->
                <div class="box box-primary">
                    <div class="box-body box-profile">
                        <img class="profile-user-img img-responsive img-circle" src="<?= base_url('uploads/') . $data['foto_user'] ?>" alt="User profile picture">

                        <h3 class="profile-username text-center"><?= ucfirst($this->session->userdata('nama')) ?></h3>

                        <p class="text-muted text-center"><?= $this->session->userdata('email') ?></p>

                    </div>
                    <div class="box-footer box-profile text-center">
                        <form action="" id="upload-form" method="post" enctype="multipart/form-data">
                            <small>Ganti Foto Profile</small>
                            <input type="file" name="photo" id="file-input" class="form-control">
                        </form>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->

            </div>
            <!-- /.col -->
            <div class="col-md-9">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#settings" data-toggle="tab">Settings</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane" id="settings" style="display: block;">
                            <form class="form-horizontal" action="<?= site_url('profile/update/' . $this->session->userdata('userid')) ?>" method="post" autocomplete="off">
                                <div class="form-group">
                                    <label for="inputName" class="col-sm-2 control-label">Nama Lengkap</label>

                                    <div class="col-sm-10">
                                        <input type="text" name="nama" value="<?= $data['nama_depan'] . ' ' . $data['nama_belakang'] ?>" class="form-control" id="inputName" placeholder="Nama Lengkap">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail" class="col-sm-2 control-label">Email</label>

                                    <div class="col-sm-10">
                                        <input type="text" name="email" value="<?= $data['email'] ?>" class="form-control" id="inputEmail" placeholder="Email" readonly>
                                    </div>
                                </div>
                                <?php if ($this->session->userdata('level') == '1') : ?>
                                    <div class="form-group">
                                        <label for="inputName" class="col-sm-2 control-label">Level</label>

                                        <div class="col-sm-10">
                                            <select name="level" class="form-control">
                                                <?php $level = $this->db->get('level')->result_array();
                                                foreach ($level as $l) { ?>
                                                    <option value="<?= $l['level_id'] ?>" <?php if ($data['level'] == $l['level_id']) { ?> selected <?php } ?>><?= $l['level_nama'] ?></option>
                                                <?php } ?>

                                            </select>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <div class="form-group">
                                    <label for="inputExperience" class="col-sm-2 control-label">Alamat</label>

                                    <div class="col-sm-10">
                                        <textarea class="form-control" name="alamat" id="inputExperience" placeholder="Alamat"><?= $data['alamat'] ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputSkills" class="col-sm-2 control-label">Whatsapp</label>

                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputSkills" value="<?php if ($data['nowa'] == null) {
                                                                                                            echo '-';
                                                                                                        } else {
                                                                                                            echo $data['nowa'];
                                                                                                        } ?>" name="nowa" placeholder="Nomor Whatsapp">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" class="btn btn-danger">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                </div>
                <!-- /.nav-tabs-custom -->
            </div>
            <!-- /.col -->
        </div>
    <?php } ?>
    <!-- /.row -->

</section>

<script src="<?= base_url() ?>assets/bower_components/jquery/dist/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('#file-input').on('change', function() {
            var file = $(this)[0].files[0]
            var formData = new FormData($('#upload-form')[0])
            formData.append('file', file)

            $.ajax({
                type: 'POST',
                url: 'update_photo/<?= $this->session->userdata('userid') ?>',
                data: formData,
                processData: false,
                contentType: false,
                success: function(res) {
                    window.location.replace(res)
                }
            })
        })
    })
</script>