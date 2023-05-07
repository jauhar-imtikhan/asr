<section class="content">
    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">User</h3>

            <div class="box-tools pull-right">
                <button class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Tambah Barang" id="addbarang"><i class="fa fa-plus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fa fa-minus"></i></button>
            </div>
        </div>
        <div class="box-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="data-barang">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Nama Barang</th>
                            <th class="text-center">Harga Barang</th>
                            <th class="text-ceenter">Kategori Barang</th>
                            <th class="text-center">Deskripsi Barang</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($data as $row) { ?>
                            <tr>
                                <td class="text-center"><?= $no++ ?></td>
                                <td class="text-center"><?= ucfirst($row['nama_barang'])  ?></td>
                                <td class="text-center"><?= $row['harga_barang'] ?></td>
                                <td class="text-center"><?= ucfirst($row['nama_kategori']) ?></td>
                                <td class="text-center"><?= ucfirst($row['deskripsi']) ?></td>
                                <td class="text-center" width="15%">
                                    <button onclick="editDataBarang('<?= $row['id_barang'] ?>')" class="btn btn-primary "><i class="fa fa-edit"></i></button>&nbsp;
                                    <button onclick="DelById('<?= $row['id_barang'] ?>', '<?= $row['nama_barang'] ?>')" class="btn btn-danger"><i class="fa fa-trash"></i></button>&nbsp;
                                    <button onclick="detailBarang('<?= $row['id_barang'] ?>')" class="btn btn-secondary"><i class="fa fa-eye"></i></button>
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
    <!-- Modal Detail Barang -->
    <div class="modal fade" id="modal-detail-barang" data-backdrop="static">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4 " id="gambar">
                        </div>
                        <div class="col-md-8">
                            <div class="row" style="margin-top: 15px;">
                                <div class="col-md-3 col-xs-5 col-for-label">
                                    <label>Nama Barang : </label>
                                </div>
                                <div class="col-md-9 col-xs-7" id="nambar">

                                </div>
                            </div>
                            <div class="row" style="margin-top: 15px;">
                                <div class="col-md-3 col-xs-5 col-for-label">
                                    <label>Harga Barang : </label>
                                </div>
                                <div class="col-md-9 col-xs-7" id="hargabar">

                                </div>
                            </div>
                            <div class="row" style="margin-top: 15px;">
                                <div class="col-md-3 col-xs-5 col-for-label">
                                    <label>Kategori Barang : </label>
                                </div>
                                <div class="col-md-9 col-xs-7" id="katbar">

                                </div>
                            </div>
                            <div class="row" style="margin-top: 15px;">
                                <div class="col-md-3 col-xs-5 col-for-label">
                                    <label>Deskripsi Barang : </label>
                                </div>
                                <div class="col-md-9 col-xs-7" id="desbar">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit Barang -->
    <div class="modal fade" data-backdrop="static" id="modal-edit-barang">
        <div class="modal-dialog modal-lg">
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

    <!-- Modal Add Barang -->


    <div class="modal fade" data-backdrop="static" id="modal-add-barang">
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
        $('#data-barang').DataTable({
            dom: 'Bfrtip',
            'responsive': true,
            buttons: [
                'excel', 'pdf'
            ]
        })
        // Ketika input file berubah
        $('#photo').change(function() {
            var file = this.files[0];
            var reader = new FileReader();

            reader.onloadend = function() {
                $('#tampilFoto').attr('src', reader.result);
            }

            if (file) {
                reader.readAsDataURL(file); // Membaca file sebagai URL data
            } else {
                $('#tampilFoto').attr('src', '#');
            }
        });
        $('#addbarang').click(function() {
            $('#modal-add-barang').modal('show')
            $('#modal-add-title').text('Tambah Barang')
            $.ajax({
                url: 'databarang/addbarang',
                success: function(res) {
                    $('#modal-add-body').html(res)
                }
            })
        })

    })

    function DelById(id, nama) {
        Swal.fire({
            title: 'Apakah Anda Yakin?',
            text: "Setelah Menghapus Data Barang Anda Tidak Dapat Mengembalikannya!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: 'databarang/delete/' + id,
                    success: function(res) {
                        Swal.fire({
                            title: 'Terhapus!',
                            text: 'Anda Berhasil Menghapus Barang ' + nama,
                            confirmButtonText: 'Ok'
                        }).then((result) => {
                            location.reload()
                        })
                    }
                })
            }
        })

    }

    function detailBarang(id) {
        $('#modal-detail-barang').modal('show')
        $.ajax({
            type: 'GET',
            url: 'databarang/getdetail',
            data: {
                id: id
            },
            dataType: 'json',
            success: function(res) {
                $.each(res, function(index, obj) {
                    $('#modal-title').text("Detail Barang : " + obj.nama_barang)
                    $('#gambar').html('<img src="<?= base_url('uploads/') ?>' + obj.foto + '" class="img img-rounded"/>')
                    $('#nambar').text(obj.nama_barang)
                    $('#hargabar').text(Rp(obj.harga_barang))
                    $('#katbar').text(Kapital(obj.nama_kategori))
                    $('#desbar').html('<textarea class="form-control">' + Kapital(obj.deskripsi) + '</textarea>')
                })
                console.log(res);
            }
        })
    }

    function editDataBarang(id) {
        $.ajax({
            method: 'GET',
            url: 'databarang/editBarang',
            data: {
                id: id
            },
            success: function(res) {
                $('#modal-edit-barang').modal('show');
                $('#modal-edit-title').html('<h4>Edit Barang </h4>')
                $('#modal-edit-body').html(res)

            }
        })
    }

    function Kapital(text) {

        // Ubah huruf pertama menjadi huruf kapital
        text = text.charAt(0).toUpperCase() + text.slice(1);
        return text
    }

    function Rp(angka) {
        var bilangan = parseInt(angka);
        var reverse = bilangan.toString().split('').reverse().join('');
        var ribuan = reverse.match(/\d{1,3}/g);
        ribuan = ribuan.join('.').split('').reverse().join('');
        return 'Rp ' + ribuan;
    }
</script>