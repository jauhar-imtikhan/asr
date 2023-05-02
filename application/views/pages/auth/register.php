<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Register ASR Furniture</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/bower_components/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/dist/css/AdminLTE.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/iCheck/square/blue.css">

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition register-page">
    <div class="register-box">
        <div class="register-logo">
            <span><b>ASR</b> Furniture</span>
        </div>

        <div class="register-box-body">
            <p class="login-box-msg">Halaman Register</p>

            <form action="<?= base_url('auth/registrasi') ?>" method="post">
                <div class="form-group has-feedback">
                    <input type="text" class="form-control" name="nama" placeholder="Nama Lengkap" value="<?= set_value('nama') ?>">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    <span class="text-danger"><?= form_error('nama') ?></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="text" class="form-control" placeholder="Email" name="email" value="<?= set_value('email') ?>">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    <span class="text-danger"><?= form_error('email') ?></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" class="form-control" placeholder="Password" name="password" value="<?= set_value('password') ?>">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    <span class="text-danger"><?= form_error('password') ?></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" class="form-control" placeholder="Konfirmasi Password" name="password2" value="<?= set_value('password2') ?>">
                    <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
                    <span class="text-danger"><?= form_error('password2') ?></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="number" name="no" value="<?= set_value('no') ?>" class="form-control" placeholder="Nomor Whatsapp">
                    <span class=" form-control-feedback"><img src="<?= base_url() ?>assets/images/whatsapp.svg" alt="Number Whatsapp" width="20"></span>
                    <span class="text-danger"><?= form_error('no') ?></span>
                </div>
                <div class="row">
                    <div class="col-xs-8">
                        <div class="checkbox icheck">
                            <label>
                                <input type="checkbox" value="1" name="aggre"> I agree to the <a href="<?= site_url('auth/terms') ?>">terms</a>
                            </label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>


            <a href="<?= base_url('auth') ?>" class="text-center">Login</a>
        </div>
        <!-- /.form-box -->
    </div>
    <!-- /.register-box -->

    <!-- jQuery 3 -->
    <script src="<?= base_url() ?>assets/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="<?= base_url() ?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- iCheck -->
    <script src="<?= base_url() ?>assets/plugins/iCheck/icheck.min.js"></script>
    <script>
        $(function() {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' /* optional */
            });
        });
    </script>
</body>

</html>