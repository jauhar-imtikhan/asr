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
                                    <button onclick="edituser('<?= $row['user_id'] ?>')" class="btn btn-primary "><i class="fa fa-edit"></i></button>&nbsp;
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

    <!-- Modal edit User -->


    <div class="modal fade" id="modal-edit-user">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="modal-edit-title"></h4>
                </div>
                <div class="modal-body" id="modal-edit-body">

                </div>
            </div>
        </div>
    </div>

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

    function edituser(id) {
        $('#modal-edit-user').modal('show')
        $('#modal-edit-title').text('Modal Edit User')
        $.ajax({
            url: 'user/edituser',
            data: {
                id: id
            },
            success: function(res) {
                $('#modal-edit-body').html(res)
            }
        })
    }
</script>
<!-- /.content -->