<?php
$query = $this->db->get_where('alamat_pengiriman', ['id_user' => $this->session->userdata('userid')])->row_array();

$penerima = $query['atas_nama'];
$nowa = $query['nowa'];
$sub = '';
$dp = $this->cart->total() * 40 / 100;
$berat = '';
$bar = '';
$qty = '';
$kab = str_replace("Kota ", "", $query['kabupaten']);
$kab = str_replace("Kabupaten ", "", $query['kabupaten']);
$alamat = $query['provinsi'] . ',' . $query['kabupaten'] . ',' . $query['kecamatan'] . ',' . $query['kelurahan'] . ',' . $query['alamat'];
?>

<section class="invoice">

    <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
            Pengirim
            <address>
                <strong>Admin ASR Furniture</strong><br>
                Jawa Tengah, Kabupaten Semarang, Banyubiru, Ngrapah, RT01 RW11<br>
                Phone: 0821383849283<br>
                Email: sahidfurniture0@gmail.com
            </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-6 invoice-col pull-right">
            Penerima
            <address>
                <strong><?= ucfirst($penerima) ?></strong><br>
                <?= $alamat ?><br>
                No Whatsapp: <?= $nowa ?>
            </address>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- Table row -->
    <div class="row">
        <div class="col-xs-12 table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Qty</th>
                        <th>Barang</th>
                        <th>Description</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($this->cart->contents() as $barang) {
                        $sub = $barang['subtotal'];
                        $berat = $barang['berat'];
                        $bar .= $barang['name'] . ',' ?>
                        <input type="hidden" name="rowid" value="">
                        <tr>
                            <td><?= $barang['qty'] ?></td>
                            <td><?= $barang['name'] ?></td>
                            <td><?= $barang['description'] ?></td>
                            <td><?= Rp($barang['subtotal']) ?></td>
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
                <h3 class="text-red">--Tunai--</h3>
            </b>
            <hr>
            <p class="lead">Cek Ongkir</p>
            <label>Ekpedisi</label>
            <div class="input-group">
                <select name="" id="ekspedisi" class="form-control">
                    <option value="">--Pilih--</option>
                </select>
                <span class="input-group-addon load" id="basic-addon3"><i class="fa fa-refresh fa-spin"></i></span>
            </div>
            <label>Layanan</label>
            <div class="input-group">
                <select name="" id="layanan" class="form-control" disabled>
                    <option value="">--Pilih--</option>
                </select>
                <span class="input-group-addon" id="basic-addon3"><i class="fa fa-truck"></i></span>
            </div>

        </div>
        <!-- /.col -->
        <div class="col-xs-6">
            <p class="lead" id="date-created">Tanggal : <?= date('d/m/Y') ?></p>

            <div class="table-responsive">
                <table class="table">
                    <tbody>
                        <tr>
                            <th style="width:50%">Subtotal:</th>
                            <td id="subtotal-geys"><?= Rp($this->cart->total()) ?></td>
                        </tr>
                        <tr>
                            <th>Ongkir:</th>
                            <td id="hargapengiriman">-</td>
                        </tr>
                        <tr>
                            <th>Estimasi:</th>
                            <td id="estimasi">-</td>
                        </tr>
                        <tr>
                            <th>Total:</th>
                            <td id="total"><b>-</b></td>
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
        <form action="<?= site_url('keranjang/submit_payment') ?>" method="post">
            <input type="hidden" name="nama_pengirim" value="Admin ASR Furniture
                Jawa Tengah, Kabupaten Semarang, Banyubiru, Ngrapah, RT01 RW11
                Phone: 0821383849283
                Email: sahidfurniture0@gmail.com">
            <input type="hidden" name="nama_penerima" value="<?= ucfirst($penerima) ?>
                <?= $alamat ?>
                 <?= $nowa ?>">
            <input type="hidden" name="barang" value="<?= $bar ?>">
            <input type="hidden" name="qty" value="<?= $qty ?>">
            <input type="hidden" name="payment" value="Tunai">
            <input type="hidden" name="ekspedisi" id="submit-ekspedisi">
            <input type="hidden" name="layanan" id="submit-layanan">
            <input type="hidden" name="subtotal" id="submit-subtotal">
            <input type="hidden" name="dp" value="<?= $dp ?>">
            <input type="hidden" name="ongkir" id="submit-ongkir">
            <input type="hidden" name="estimasi" id="submit-estimasi">
            <input type="hidden" name="total" id="submit-total">
            <input type="hidden" name="date_created" id="submit-date">

            <div class="col-xs-12">
                <button type="submit" class="btn btn-success pull-right" id="submit-payment" disabled><i class="fa fa-credit-card"></i> Submit Payment
                </button>
            </div>
        </form>
    </div>
</section>

<script src="<?= base_url() ?>assets/bower_components/jquery/dist/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        let city_id
        $.ajax({
            url: 'getprovinsi',
            method: 'GET',
            dataType: 'json',
            success: function(res) {
                let result = $.parseJSON(res)
                const City = $.map(result.rajaongkir.results, function(obj) {
                    if (obj.city_name == "<?= $kab ?>") {

                        var city_id = obj.city_id

                        ongkir(city_id)
                    }
                })
            }
        })




    })

    function ongkir(city_id) {
        $(document).ajaxStart(function() {
            $('.load').show()
        })
        $(document).ajaxStop(function() {
            $('.load').fadeOut("slow")
        })
        $.ajax({
            url: 'getongkir',
            method: 'GET',
            dataType: 'json',
            data: {
                origin: 398,
                destination: city_id,
                weight: '<?= $berat ?>',
                courier: 'jne',
            },
            success: function(res) {
                let result = $.parseJSON(res)
                const Ong = $.map(result.rajaongkir.results, function(obj) {
                    let string = {
                        code: obj.code,
                        cost: obj.costs,
                        name: obj.name
                    }
                    return string
                })
                $.each(Ong, function(index, obj) {
                    $('#ekspedisi').append($('<option></option>').text(obj.name).attr('value', obj.name))
                })
                $('#ekspedisi').change(function() {
                    $.each(Ong, function(index, obj) {
                        $.each(obj.cost, function(i, v) {
                            $('#layanan').append($('<option></option>').text("(" + v.service + ")" + v.description).attr('value', v.description).attr('data-value', v.cost[0].value).attr('data-estimasi', v.cost[0].etd))

                        })
                    })
                    $('#layanan').removeAttr('disabled')
                })
                $('#layanan').change(function() {
                    $('#hargapengiriman').text(Rp($('#layanan').find(':selected').attr('data-value')))
                    $('#estimasi').text($('#layanan').find(':selected').attr('data-estimasi') + " Hari")
                    var v1 = parseInt($('#layanan').find(':selected').attr('data-value'))
                    var v2 = parseInt(<?= $this->cart->total() ?>)
                    var total = v1 + v2
                    $('#total').html("<b>" + Rp(total) + "</b>")
                    $('#submit-ekspedisi').val($('#ekspedisi').find(':selected').text())
                    $('#submit-layanan').val($('#layanan').find(':selected').text())
                    $('#submit-ongkir').val($('#hargapengiriman').text())
                    $('#submit-estimasi').val($('#estimasi').text())
                    $('#submit-total').val($('#total').text())
                    $('#submit-date').val($('#date-created').text())
                    $('#submit-subtotal').val($('#subtotal-geys').text())
                    $('#submit-payment').removeAttr('disabled')
                })

            }
        })
    }

    function Rp(angka) {
        var bilangan = parseInt(angka);
        var reverse = bilangan.toString().split('').reverse().join('');
        var ribuan = reverse.match(/\d{1,3}/g);
        ribuan = ribuan.join('.').split('').reverse().join('');
        return 'Rp.' + ribuan;
    }
</script>