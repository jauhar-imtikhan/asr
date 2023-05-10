<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css"> -->
<section class="content">
    <div class="container">
        <section class="header">
            <h3>Detail Barang</h3>
        </section>

        <section class="body">
            <div class="row">
                <?php foreach ($databarang as $barang) { ?>
                    <input type="hidden" value="<?= $barang['rowid'] ?>" id="rowid">
                    <div class="col-md-4">
                        <div class="panel">
                            <div class="panel-header">
                                <a href="<?= site_url('keranjang/hapus/' . $barang['rowid']) ?>" class="btn btn-danger pull-right" style="margin-top: 5px; margin-right: 5px;"><i class="fa fa-trash"></i></a>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-6 col-sm-6 ">
                                        <div class="image">
                                            <img src="<?= base_url('uploads/' . $barang['foto']) ?>" alt="<?= $barang['foto'] ?>" class="img-rounded" style="width: 200px;">
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-sm-8 ">
                                        <dl style="margin-left: 10px;">
                                            <dt class="h3"><?= ucfirst($barang['name']) ?></dt>
                                            <dd class="h4"><?= $barang['qty'] ?> x <?= Rp($barang['price']) ?></dd>
                                            <dt class="h5"><?= $barang['description'] ?></dt>
                                        </dl>
                                    </div>
                                </div>
                                <!-- /.row -->
                            </div>
                            <!-- /.box-body -->
                            <style>
                                input[type="text"] {
                                    width: 32px;
                                    text-align: center;
                                    height: 32px;
                                }
                            </style>
                            <div class="box-footer ">
                                <ul class="nav nav-pills nav-stacked ">
                                    <li>
                                        <span>Sub Total : <?= Rp($barang['subtotal']) ?></span>
                                        <span class="pull-right">
                                            <form action="<?= site_url('keranjang/updatecheckout/' . $barang['rowid']) ?>" method="post">
                                                <button class="btn btn-danger" id="btn-minus<?= $barang['id'] ?>" type="submit" name="min"><i class="fa fa-minus"></i></button>
                                                <input type="text" name="qty" class="quantity" value="<?= $barang['qty'] ?>">
                                                <button class="btn btn-primary" id="btn-plus<?= $barang['id'] ?>" type="submit" name="add"><i class="fa fa-plus"></i></button>
                                            </form>
                                        </span>
                                    </li>

                                </ul>
                            </div>
                            <!-- /.footer -->
                        </div>
                    </div>
                    <script src="<?= base_url() ?>assets/bower_components/jquery/dist/jquery.min.js"></script>
                    <script>
                        $(document).ready(function() {
                            // ketika tombol plus di klik
                            $("#btn-plus<?= $barang['id'] ?>").click(function() {
                                // ambil nilai dari input quantity
                                var currentVal = parseInt($(this).prev(".quantity").val());

                                // tambahkan 1 ke nilai saat ini
                                if (!isNaN(currentVal)) {
                                    $(this).prev(".quantity").val(currentVal + 1);

                                } else {
                                    $(this).prev(".quantity").val(1);
                                }
                            });

                            // ketika tombol minus di klik
                            $("#btn-minus<?= $barang['id'] ?>").click(function() {
                                // ambil nilai dari input quantity
                                var currentVal = parseInt($(this).next(".quantity").val());
                                // kurangi 1 dari nilai saat ini
                                if (!isNaN(currentVal) && currentVal > 1) {
                                    $(this).next(".quantity").val(currentVal - 1);
                                } else {
                                    $(this).next(".quantity").val(1);
                                }
                            });

                        });

                        function Rp(angka) {
                            var bilangan = parseInt(angka);
                            var reverse = bilangan.toString().split('').reverse().join('');
                            var ribuan = reverse.match(/\d{1,3}/g);
                            ribuan = ribuan.join('.').split('').reverse().join('');
                            return 'Rp ' + ribuan;
                        }

                        function numOnly(angka) {
                            var k = angka.replace(/[^0-9]/g, "");
                            return k
                        }
                    </script>
                <?php } ?>
            </div>
        </section>

        <div class="navbar-fixed-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-sm-4 col-xs-4">
                        <h4>Harga Dp : <?php $t = $this->cart->total();
                                        $dis = $t * 40 / 100;
                                        echo Rp($dis); ?>
                        </h4>
                        <h4>
                            Total Harga : <?= Rp($this->cart->total()) ?>
                        </h4>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-4">
                        <div class="form-group">
                            <label>Metode Pembayaran</label>
                            <select name="" id="pembayaran" class="form-control">
                                <option value="">--Pilih--</option>
                                <?php foreach ($payment as $bayar) : ?>
                                    <option value="<?= $bayar['nama_pembayaran'] ?>"><?= $bayar['nama_pembayaran'] ?></option>
                                <?php endforeach; ?>

                            </select>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-4">

                        <button type="button" class="btn btn-primary btn-block" id="bayar" style="margin-top: 25px;">Check Out</button>

                    </div>
                </div>
            </div>
        </div>
        <style>
            .navbar-fixed-bottom {
                position: fixed;
                bottom: 0;
                height: auto;
                width: 100%;
                background-color: white;
            }
        </style>
    </div>

    <div class="modal fade" id="Tunai">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">

                    <h4 class="modal-title">Tunai</h4>
                </div>
                <div class="modal-body" id="modal-tunai-body">
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="Transfer-ATM">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Transfer ATM</h4>
                </div>
                <div class="modal-body" id="Transfer-ATM-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="DANA">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">DANA</h4>
                </div>
                <div class="modal-body" id="DANA-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="QRIS">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">QRIS</h4>
                </div>
                <div class="modal-body" id="QRIS-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>


</section>
<script src="<?= base_url() ?>assets/bower_components/jquery/dist/jquery.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    $(document).ready(function() {
        $('#bayar').click(function() {
            if ($('#pembayaran').find(':selected').text() === '--Pilih--') {
                swal({
                    icon: 'warning',
                    text: 'Silahkan Pilih Metode Pembayaran Terlebih Dahulu!',
                    button: true,
                    closeOnClickOutside: false
                })
            } else {
                let pay = $('#pembayaran').find(':selected').text()
                var row = $('#rowid').val()
                if (pay == 'Transfer ATM') {
                    var replace = pay.replace(' ', '-')
                    $('#' + replace).modal('show')
                } else {
                    $('#' + pay).modal('show')
                    $.ajax({
                        method: 'GET',
                        url: 'tunai',
                        data: {
                            rowid: row
                        },
                        success: function(res) {
                            $('#modal-tunai-body').html(res);
                        }
                    })
                }
            }
        })
    })
</script>