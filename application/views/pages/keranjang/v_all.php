<section class="content">
    <section class="header">
        <h3>Detail Barang</h3>
    </section>

    <section class="body">
        <div class="row">
            <div class="col-md-4">
                <div class="panel">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-6 col-sm-6 ">
                                <div class="image">
                                    <img src="<?= base_url('uploads/' . $barang['foto']) ?>" alt="<?= $barang['foto'] ?>" class="img-rounded" style="width: 200px;">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 ">
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
                                    <button class="btn btn-danger" id="btn-minus"><i class="fa fa-minus"></i></button>
                                    <input type="text" name="" class="quantity" value="<?= $barang['qty'] ?>">
                                    <button class="btn btn-primary" id="btn-plus"><i class="fa fa-plus"></i></button>
                                </span>
                            </li>

                        </ul>
                    </div>
                    <!-- /.footer -->
                </div>
            </div>
        </div>
    </section>
</section>
<script src="<?= base_url() ?>assets/bower_components/jquery/dist/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        // ketika tombol plus di klik
        $("#btn-plus").click(function() {
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
        $("#btn-minus").click(function() {
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