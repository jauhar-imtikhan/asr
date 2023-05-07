<form action="<?= site_url('user/proadduser') ?>" method="post">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>Nama Depan</label>
                <input type="text" name="namadepan" class="form-control">
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="text" name="email" class="form-control">
            </div>
            <div class="form-group">
                <label>No Wa</label>
                <input type="number" name="nowa" class="form-control">
            </div>
            <div class="form-group">
                <label>Level</label>
                <select name="level" class="form-control">
                    <option value="">--Pilih--</option>
                    <?php $q = $this->db->get('level')->result_array();
                    foreach ($q as $l) { ?>
                        <option value="<?= $l['level_id'] ?>"><?= ucfirst($l['level_nama']) ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label>kabupaten</label>
                <select name="kabupaten" id="kabupaten" class="form-control" disabled>
                    <option value="">--Pilih--</option>
                </select>
            </div>
            <div class="form-group">
                <label>Kelurahan</label>
                <select name="kelurahan" id="kelurahan" class="form-control" disabled>
                    <option value="">--Pilih--</option>
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Nama Belakang</label>
                <input type="text" name="namabelakang" class="form-control">
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="text" name="password" class="form-control">
            </div>
            <div class="form-group">
                <label>Status</label>
                <select name="status" class="form-control">
                    <option value="">--Pilih--</option>
                    <option value="1">Aktif</option>
                    <option value="0">Tidak Aktif</option>
                </select>
            </div>
            <div class="form-group">
                <label>Provinsi</label>
                <select name="provinsi" id="provinsi" class="form-control">
                    <option value="">--Pilih--</option>
                </select>
            </div>
            <div class="form-group">
                <label>Kecamatan</label>
                <select name="kecamatan" id="kecamatan" class="form-control" disabled>
                    <option value="">--Pilih--</option>
                </select>
            </div>
        </div>
    </div>
    </div>
    <div class="modal-footer">
        <button class="btn btn-primary" type="submit">Submit</button>
    </div>
</form>
<script>
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'https://dev.farizdotid.com/api/daerahindonesia/provinsi');
    xhr.responseType = 'json';
    xhr.onload = function() {
        if (xhr.status === 200) {
            var res = xhr.response;
            var d = res.provinsi;
            var Prov = d.map(function(vmk) {
                return {
                    nama: vmk.nama,
                    id: vmk.id
                };
            });

            Prov.forEach(function(ue) {
                var option = document.createElement('option');
                option.value = ue.nama;
                option.text = ue.nama;
                option.setAttribute('data-provinsi', ue.id);
                document.getElementById('provinsi').appendChild(option);
            });

            document.getElementById('provinsi').addEventListener('change', function() {
                var pilih = this.querySelector(':checked').getAttribute('data-provinsi');
                getKab(pilih);
                document.getElementById('kabupaten').removeAttribute('disabled');
            });
        }
    };
    xhr.send();

    function getKab(id) {
        var xhr = new XMLHttpRequest();
        xhr.open('GET', `https://dev.farizdotid.com/api/daerahindonesia/kota?id_provinsi=${id}`);
        xhr.responseType = 'json';
        xhr.onload = function() {
            if (xhr.status === 200) {
                var res = xhr.response;
                var kk = res.kota_kabupaten;
                var kotKab = kk.map(function(obj) {
                    return {
                        nama: obj.nama,
                        id: obj.id
                    };
                });

                kotKab.forEach(function(ue) {
                    var option = document.createElement('option');
                    option.value = ue.nama;
                    option.text = ue.nama;
                    option.setAttribute('data-kabupaten', ue.id);
                    document.getElementById('kabupaten').appendChild(option);
                });

                document.getElementById('kabupaten').addEventListener('change', function() {
                    var kbu = this.querySelector(':checked').getAttribute('data-kabupaten');
                    getKec(kbu);
                    document.getElementById('kecamatan').removeAttribute('disabled');
                });
            }
        };
        xhr.send();
    }

    function getKec(id) {
        var xhr = new XMLHttpRequest();
        xhr.open('GET', `https://dev.farizdotid.com/api/daerahindonesia/kecamatan?id_kota=${id}`);
        xhr.responseType = 'json';
        xhr.onload = function() {
            if (xhr.status === 200) {
                var res = xhr.response;
                var kecc = res.kecamatan;
                var keca = kecc.map(function(obj) {
                    return {
                        nama: obj.nama,
                        id: obj.id
                    };
                });

                keca.forEach(function(oi) {
                    var option = document.createElement('option');
                    option.value = oi.nama;
                    option.text = oi.nama;
                    option.setAttribute('data-kecamatan', oi.id);
                    document.getElementById('kecamatan').appendChild(option);
                });

                document.getElementById('kecamatan').addEventListener('change', function() {
                    var matan = this.querySelector(':checked').getAttribute('data-kecamatan');
                    getKelu(matan);
                    document.getElementById('kelurahan').removeAttribute('disabled');
                });
            }
        };
        xhr.send();
    }

    function getKelu(id) {
        var xhr = new XMLHttpRequest();
        xhr.open('GET', `https://dev.farizdotid.com/api/daerahindonesia/kelurahan?id_kecamatan=${id}`);
        xhr.responseType = 'json';
        xhr.onload = function() {
            if (xhr.status === 200) {
                var res = xhr.response;
                var kecc = res.kelurahan;
                var kelu = kecc.map(function(obj) {
                    return {
                        nama: obj.nama,
                        id: obj.id
                    };
                });

                kelu.forEach(function(oi) {
                    var option = document.createElement('option');
                    option.value = oi.nama;
                    option.text = oi.nama;
                    document.getElementById('kelurahan').appendChild(option);
                });
            }
        };
        xhr.send();
    }
</script>