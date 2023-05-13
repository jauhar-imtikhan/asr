<?php if ($addr == null) { ?>
    <section class="content">
        <div class="col-md-6 col-md-offset-3">
            <div class="box box-primary">
                <div class="box-header text-center">
                    <h3>Alamat Pengiriman</h3>
                </div>
                <div class="box-body">
                    <form action="<?= site_url('alamatpengiriman/add') ?>" method="post" autocomplete="off">
                        <div class="form-group">
                            <label>Nama Penerima</label>
                            <input type="text" name="namapenerima" value="" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>No Whatsapp</label>
                            <input type="number" name="nowa" value="" class="form-control">
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-6">
                                <label>Provinsi</label>
                                <select name="provinsi" id="provinsi" class="form-control">
                                    <option value="">--Pilih--</option>
                                </select>
                            </div>
                            <div class="col-md-6 col-sm-6 pull-right">
                                <label>Kabupaten</label>
                                <select name="kabupaten" class="form-control" id="kabupaten" disabled>
                                    <option value="">--Pilih--</option>
                                </select>
                            </div>
                        </div>
                        <div class="row " style="margin-top: 6px;">
                            <div class="col-md-6 col-sm-6">
                                <label>Kecamatan</label>
                                <select name="kecamatan" class="form-control" id="kecamatan" disabled>
                                    <option value="">--Pilih--</option>
                                </select>
                            </div>
                            <div class="col-md-6 col-sm-6 pull-right">
                                <label>Kelurahan</label>
                                <select name="kelurahan" class="form-control" id="kelurahan" disabled>
                                    <option value="">--Pilih--</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group" style="margin-top: 6px;">
                            <label>Detail Alamat</label>
                            <textarea name="detailalamat" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary pull-right" type="submit"><i class="fa fa-save"></i> Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <script src="<?= base_url() ?>assets/bower_components/jquery/dist/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $.ajax({
                url: 'https://dev.farizdotid.com/api/daerahindonesia/provinsi',
                dataType: 'json',
                method: 'GET',
                success: function(res) {
                    var prov = res.provinsi
                    const Provinsi = $.map(prov, function(obj) {
                        var string = {
                            id: obj.id,
                            nama: obj.nama
                        }
                        return string
                    })

                    $.each(Provinsi, function(index, val) {
                        $('#provinsi').append($('<option></option>').text(val.nama).attr('value', val.nama).attr('data-provinsi', val.id))
                    })

                    $('#provinsi').change(function() {
                        let pilih = $('#provinsi').find(':selected').attr('data-provinsi')
                        getKab(pilih)
                        $('#kabupaten').removeAttr('disabled')
                    })
                }
            })
        })

        function getKab(id) {
            $.ajax({
                url: `https://dev.farizdotid.com/api/daerahindonesia/kota?id_provinsi=${id}`,
                dataType: 'json',
                success: function(res) {

                    let kk = res.kota_kabupaten
                    const kotKab = $.map(kk, function(obj) {
                        var re = {
                            nama: obj.nama,
                            id: obj.id
                        }
                        return re
                    })
                    $.each(kotKab, function(index, ue) {
                        $('#kabupaten').append($('<option></option>').attr('value', ue.nama).text(ue.nama).attr('data-kabupaten', ue.id));
                    });
                    $('#kabupaten').change(function() {
                        let kbu = $('#kabupaten').find(':selected').attr('data-kabupaten')
                        getKec(kbu)
                        $('#kecamatan').removeAttr('disabled')
                    })
                }
            })
        }

        function getKec(id) {
            $.ajax({
                url: `https://dev.farizdotid.com/api/daerahindonesia/kecamatan?id_kota=${id}`,
                dataType: 'json',
                success: function(res) {
                    let kecc = res.kecamatan
                    const keca = $.map(kecc, function(obj) {
                        let kecam = {
                            nama: obj.nama,
                            id: obj.id
                        }
                        return kecam
                    })
                    $.each(keca, function(index, oi) {
                        $('#kecamatan').append($('<option></option>').attr('value', oi.nama).text(oi.nama).attr('data-kecamatan', oi.id))

                    })
                    $('#kecamatan').change(function() {
                        let matan = $('#kecamatan').find(':selected').attr('data-kecamatan')
                        getKelu(matan)
                        $('#kelurahan').removeAttr('disabled')
                    })
                }
            })
        }

        function getKelu(id) {
            $.ajax({
                url: `https://dev.farizdotid.com/api/daerahindonesia/kelurahan?id_kecamatan=${id}`,
                dataType: 'json',
                success: function(res) {
                    let kecc = res.kelurahan
                    const kelu = $.map(kecc, function(obj) {
                        let kelur = {
                            nama: obj.nama,
                            id: obj.id
                        }
                        return kelur
                    })
                    $.each(kelu, function(index, oi) {
                        $('#kelurahan').append($('<option></option>').attr('value', oi.nama).text(oi.nama))
                    })
                }
            })
        }
    </script>
<?php } else { ?>
    <section class="content">
        <div class="col-md-6 col-md-offset-3">
            <div class="box box-primary">
                <div class="box-header text-center">
                    <h3>Alamat Pengiriman</h3>
                </div>
                <div class="box-body">
                    <form action="<?= site_url('alamatpengiriman/update/' . $addr['id_user']) ?>" method="post" autocomplete="off">
                        <div class="form-group">
                            <label>Nama Penerima</label>
                            <input type="text" name="namapenerima" value="<?= $addr['atas_nama'] ?>" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>No Whatsapp</label>
                            <input type="number" name="nowa" value="<?= $addr['nowa'] ?>" class="form-control">
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-6">
                                <label>Provinsi</label>
                                <select name="provinsi" id="provinsi" class="form-control">
                                    <option value="">--Pilih--</option>
                                </select>
                            </div>
                            <div class="col-md-6 col-sm-6 pull-right">
                                <label>Kabupaten</label>
                                <select name="kabupaten" class="form-control" id="kabupaten">
                                    <option value="">--Pilih--</option>
                                </select>
                            </div>
                        </div>
                        <div class="row " style="margin-top: 6px;">
                            <div class="col-md-6 col-sm-6">
                                <label>Kecamatan</label>
                                <select name="kecamatan" class="form-control" id="kecamatan">
                                    <option value="">--Pilih--</option>
                                </select>
                            </div>
                            <div class="col-md-6 col-sm-6 pull-right">
                                <label>Kelurahan</label>
                                <select name="kelurahan" class="form-control" id="kelurahan">
                                    <option value="">--Pilih--</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group" style="margin-top: 6px;">
                            <label>Detail Alamat</label>
                            <textarea name="detailalamat" class="form-control"><?= $addr['alamat'] ?></textarea>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary pull-right" type="submit"><i class="fa fa-save"></i> Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <script src="<?= base_url() ?>assets/bower_components/jquery/dist/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $.ajax({
                url: 'https://dev.farizdotid.com/api/daerahindonesia/provinsi',
                dataType: 'json',
                method: 'GET',
                success: function(res) {
                    var prov = res.provinsi
                    const Provinsi = $.map(prov, function(obj) {
                        var string = {
                            id: obj.id,
                            nama: obj.nama
                        }
                        return string
                    })

                    $.each(Provinsi, function(index, val) {
                        if ('<?= $addr['provinsi'] ?>' == val.nama) {
                            $('#provinsi').append($('<option></option>').text(val.nama).attr('value', val.nama).attr('data-provinsi', val.id).attr('selected', 'selected'))
                        } else [
                            $('#provinsi').append($('<option></option>').text(val.nama).attr('value', val.nama).attr('data-provinsi', val.id))
                        ]
                    })
                    let pilih = $('#provinsi').find(':selected').attr('data-provinsi')
                    getKab(pilih)
                }
            })
        })

        function getKab(id) {
            $.ajax({
                url: `https://dev.farizdotid.com/api/daerahindonesia/kota?id_provinsi=${id}`,
                dataType: 'json',
                success: function(res) {

                    let kk = res.kota_kabupaten
                    const kotKab = $.map(kk, function(obj) {
                        var re = {
                            nama: obj.nama,
                            id: obj.id
                        }
                        return re
                    })
                    $.each(kotKab, function(index, ue) {
                        if ('<?= $addr['kabupaten'] ?>' == ue.nama) {
                            $('#kabupaten').append($('<option></option>').attr('value', ue.nama).text(ue.nama).attr('data-kabupaten', ue.id).attr('selected', 'selected'));
                        } else {
                            $('#kabupaten').append($('<option></option>').attr('value', ue.nama).text(ue.nama).attr('data-kabupaten', ue.id));
                        }
                    });
                    let kbu = $('#kabupaten').find(':selected').attr('data-kabupaten')
                    getKec(kbu)
                }
            })
        }

        function getKec(id) {
            $.ajax({
                url: `https://dev.farizdotid.com/api/daerahindonesia/kecamatan?id_kota=${id}`,
                dataType: 'json',
                success: function(res) {
                    let kecc = res.kecamatan
                    const keca = $.map(kecc, function(obj) {
                        let kecam = {
                            nama: obj.nama,
                            id: obj.id
                        }
                        return kecam
                    })
                    $.each(keca, function(index, oi) {
                        if ('<?= $addr['kecamatan'] ?>' == oi.nama) {
                            $('#kecamatan').append($('<option></option>').attr('value', oi.nama).text(oi.nama).attr('data-kecamatan', oi.id).attr('selected', 'selected'))
                        } else {
                            $('#kecamatan').append($('<option></option>').attr('value', oi.nama).text(oi.nama).attr('data-kecamatan', oi.id))
                        }

                    })
                    let matan = $('#kecamatan').find(':selected').attr('data-kecamatan')
                    getKelu(matan)

                }
            })
        }

        function getKelu(id) {
            $.ajax({
                url: `https://dev.farizdotid.com/api/daerahindonesia/kelurahan?id_kecamatan=${id}`,
                dataType: 'json',
                success: function(res) {
                    let kecc = res.kelurahan
                    const kelu = $.map(kecc, function(obj) {
                        let kelur = {
                            nama: obj.nama,
                            id: obj.id
                        }
                        return kelur
                    })
                    $.each(kelu, function(index, oi) {
                        if ('<?= $addr['kelurahan'] ?>' == oi.nama) {
                            $('#kelurahan').append($('<option></option>').attr('value', oi.nama).text(oi.nama).attr('selected', 'selected'))
                        } else {
                            $('#kelurahan').append($('<option></option>').attr('value', oi.nama).text(oi.nama))
                        }
                    })
                }
            })
        }
    </script>
<?php } ?>