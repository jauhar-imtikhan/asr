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

                        </div>
                    </div>
                </section>
            </div>
        </div>
    </section>
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
<?php } else { ?>
    <div class="container justify-content-center">
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong>Maaf!</strong> Tidak Ada Data Check Out!
        </div>
    </div>
<?php } ?>