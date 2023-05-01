<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">User</h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                    <i class="fa fa-times"></i></button>
            </div>
        </div>
        <div class="box-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="data-user">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Nama</th>
                            <th class="text-center">Email</th>
                            <th class="text-ceenter">Role</th>
                            <th class="text-center">Alamat</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($data as $row) { ?>
                            <tr>
                                <td class="text-center"><?= $no++ ?></td>
                                <td class="text-center"><?= $row['nama_depan'] . " " . $row['nama_belakang'] ?></td>
                                <td class="text-center"><?= $row['email'] ?></td>
                                <td class="text-center"><?= $row['level'] ?></td>
                                <td class="text-center"><?= $row['alamat'] ?></td>
                                <td class="text-center" width="10%">
                                    <a href="" class="btn btn-primary "><i class="fa fa-edit"></i></a>&nbsp;
                                    <a href="" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>

            </div>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->

</section>
<script src="<?= base_url() ?>assets/bower_components/jquery/dist/jquery.min.js"></script>

<script>
    $(document).ready(function() {
        $('#data-user').DataTable({
            dom: 'Bfrtip',
            'responsive': true,
            buttons: [
                'excel', 'pdf'
            ]
        })
    })
</script>
<!-- /.content -->