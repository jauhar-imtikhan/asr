<?php if (isset($datainvoice)) { ?>
    <section class="content">
        <div class="box">
            <div class="box-body">
                <section class="invoice">
                    <!-- title row -->
                    <div class="row">
                        <div class="col-xs-12">
                            <h2 class="page-header">
                                <i class="fa fa-globe"></i> ASR Furniture
                                <small class="pull-right">Tanggal: <?= $datainvoice['date_created'] ?></small>
                            </h2>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- info row -->
                    <div class="row invoice-info">
                        <div class="col-sm-4 invoice-col">
                            Pengirim
                            <address>
                                <?php $st = $datainvoice['nama_pengirim'];
                                $new_st = explode(' ', $st);
                                $new_string = str_replace('Admin ASR Furniture', '', $st);
                                ?>
                                <strong><?= $new_st[0] . ' ' . $new_st[1] . ' ' . $new_st[2]  ?></strong><br>
                                <?= $new_string ?>

                            </address>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col pull-right">
                            Penerima
                            <address>
                                <?php $string  = $datainvoice['nama_penerima'];
                                $new_v = explode(" ", $string);
                                ?>
                                <strong><?= $new_v[0] . ' ' . $new_v[1] ?></strong><br>
                                <?= $string ?>
                            </address>
                        </div>
                    </div>
                    <!-- /.row -->

                    <!-- Table row -->
                    <div class="row">
                        <div class="col-xs-12 table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Product</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $v_1 = array($datainvoice['barang']);
                                    $v_2 = implode(",", $v_1);
                                    $v_3 = $v_2;
                                    $v_4 = count(explode(',', $v_3));
                                    foreach ($v_1 as $b) { ?>
                                        <tr>
                                            <td><?= 1 ?></td>
                                            <td><?= $b ?></td>
                                            <td><?= $datainvoice['subtotal'] ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->

                    <div class="row">
                        <!-- accepted payments column -->
                        <div class="col-xs-6">
                            <p class="lead">Metode Pembayaran:</p>
                            <b>
                                <h3 class="text-red">--<?= $datainvoice['payment'] ?>--</h3>
                            </b>
                            <hr>
                            <div class="form-group">
                                <label>Ekspedisi</label>
                                <input type="text" value="<?= $datainvoice['ekspedisi'] ?>" class="form-control" readonly>
                            </div>
                            <div class="form-group">
                                <label>Layanan</label>
                                <input type="text" value="<?= $datainvoice['layanan'] ?>" class="form-control" readonly>
                            </div>

                        </div>
                        <!-- /.col -->
                        <div class="col-xs-6">

                            <div class="table-responsive">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <th style="width:50%">Subtotal:</th>
                                            <td><?= $datainvoice['subtotal'] ?></td>
                                        </tr>
                                        <tr>
                                            <th>Ongkir:</th>
                                            <td><?= $datainvoice['ongkir'] ?></td>
                                        </tr>
                                        <tr>
                                            <th>Estimasi:</th>
                                            <td><?= $datainvoice['estimasi'] ?></td>
                                        </tr>
                                        <tr>
                                            <th>Total:</th>
                                            <td><?= $datainvoice['total'] ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->

                    <!-- this row will not appear when printing -->
                    <div class="row no-print">
                        <div class="col-xs-12">
                            <button type="button" onclick="konfirmasi()" class="btn btn-success pull-right"><i class="fa fa-check"></i>
                                Barang Telah Diterima
                            </button>
                            <button class="btn btn-primary pull-left" onclick="track()"><i class="fa fa-search"></i> Lacak Pesanan</button>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </section>


    <div class="modal fade" data-backdrop="static" id="modal-track">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Lacak Pesanan</h4>
                </div>
                <div class="modal-body" id="modal-track-body">
                    <center class="load">
                        <i class="fa fa-refresh fa-spin" style="font-size: 40px;"></i>
                    </center>
                    <div class="row">
                        <div class="col-sm-6">
                            <span id="resi"></span><br>
                            <span id="kurir"></span><br>
                            <span id="tgl-kirim"></span><br>
                            <span id="deskripsi-barang"></span><br>
                            <span id="layanan-pengiriman"></span><br>
                            <span id="status-pengiriman"></span><br>
                            <span id="berat"></span><br>
                        </div>
                        <div class="col-sm-6 pull-right">
                            <span id="destination"></span><br>
                            <span id="asal"></span><br>
                            <span id="penerima"></span><br>
                            <span id="pengirim"></span><br>
                        </div>
                    </div>
                    <hr>
                    <div id="render">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <script src="<?= base_url() ?>assets/bower_components/jquery/dist/jquery.min.js"></script>
    <script>
        function konfirmasi() {
            var hasil = confirm("Apakah Anda Yakin Barang Telah Sampai?");

            if (hasil) {
                // Aksi jika pengguna menekan tombol "OK"
                // Misalnya, melakukan penghapusan data atau melakukan tindakan tertentu
                // ...
                alert("Terima Kasih Telah Belanja Semoga Tidak Mengecewakan!");
            } else {
                // Aksi jika pengguna menekan tombol "Batal" atau menutup dialog
                // Misalnya, membatalkan penghapusan data atau mengabaikan tindakan tertentu
                // ...
                alert("Sabar Sebentar lagi Barang Akan Sampai!");
            }
        }
    </script>
    <script>
        function track() {
            $('#modal-track').modal('show')
            var settings = {
                "url": "https://api.binderbyte.com/v1/track?api_key=dbaeb79d0ea2c1feba0e6a83de8e75e473050a7dd56a8503fbdc26c7e54bc4fd&courier=jne&awb=8825112045716759",
                "method": "GET",
                "timeout": 0,
            };
            $(document).ajaxStart(function() {
                $('.load').show()
            })
            $(document).ajaxStop(function() {
                $('.load').fadeOut("slow")
            })
            $.ajax(settings).done(function(response) {
                var res = response
                console.log(res);
                $('#resi').text("No Resi : " + res.data.summary.awb)
                $('#kurir').text("Kurir : " + res.data.summary.courier)
                $('#tgl-kirim').text("Tanggal : " + res.data.summary.date)
                $('#deskripsi-barang').text("Deskripsi Barang : " + res.data.summary.desc)
                $('#layanan-pengiriman').text("Layanan : " + res.data.summary.service)
                $('#status-pengiriman').text("Status: " + res.data.summary.status)
                $('#berat').text("Berat: " + res.data.summary.weight)
                $('#destination').text("Kota Tujuan : " + res.data.detail.destination)
                $('#asal').text("Kota Asal : " + res.data.detail.origin)
                $('#penerima').text("Penerima : " + res.data.detail.receiver)
                $('#pengirim').text("Pengirim: " + res.data.detail.shipper)
                const History = $.map(res.data.history, function(obj) {
                    let st = {
                        date: obj.date,
                        des: obj.desc,
                        lokasi: obj.location
                    }
                    return st
                })
                $.each(History, function(i, obj) {
                    $('#render').append(
                        $('<div class="panel panel-default"><div class="panel-body"><span>Tanggal : ' + obj.date + '</span></br>' + obj.des + '</br><span>Lokasi : ' + obj.lokasi + '</span></div></div>')
                    )

                })
            });
        }
    </script>
<?php } else { ?>
    <div class="container justify-content-center">
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong>Maaf!</strong> Tidak Ada Data Check Out!
        </div>
    </div>
<?php } ?>