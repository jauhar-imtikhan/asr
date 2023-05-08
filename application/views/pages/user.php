<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">User</h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-primary" id="addUser" data-toggle="tooltip" title="Tambah User">
                    <i class="fa fa-plus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fa fa-minus"></i></button>
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
                                <td class="text-center"><?= $row['level_nama'] ?></td>
                                <td class="text-center"><?= $row['alamat'] ?></td>
                                <td class="text-center" width="15%">
                                    <button onclick="edituser('<?= $row['user_id'] ?>')" class="btn btn-primary "><i class="fa fa-edit"></i></button>&nbsp;
                                    <button onclick="delById('<?= $row['user_id'] ?>', '<?= $row['nama_depan'] . ' ' . $row['nama_belakang'] ?>')" class="btn btn-danger"><i class="fa fa-trash"></i></button>
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
    <div class="modal fade" data-backdrop="static" id="modal-edit-user">
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



    <div class="modal fade" id="modal-add-user">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="modal-add-title"></h4>
                </div>
                <div class="modal-body" id="modal-add-body">

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

        $('#addUser').click(function() {
            $('#modal-add-user').modal('show')
            $('#modal-add-title').text('Tambah User')
            $.ajax({
                url: 'user/adduser',
                success: function(res) {
                    $('#modal-add-body').html(res)
                }
            })
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

    function delById(id, nama) {
        Swal.fire({
            title: 'Apakah Anda Yakin?',
            text: "Setelah Menghapus Data User Anda Tidak Dapat Mengembalikannya!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: 'user/delete/' + id,
                    success: function(res) {
                        Swal.fire({
                            title: 'Terhapus!',
                            text: 'Anda Berhasil Menghapus User ' + nama,
                            confirmButtonText: 'Ok'
                        }).then((result) => {
                            location.reload()
                        })
                    }
                })
            }
        })
    }
</script>
<!-- /.content -->