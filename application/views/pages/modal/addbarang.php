<form action="<?= site_url('databarang/proaddbarang') ?>" method="post" enctype="multipart/form-data" autocomplete="off">
    <div class="form-group">
        <label>Nama Barang</label>
        <input type="text" name="nambar" class="form-control">
    </div>
    <div class="form-group">
        <label>Harga Barang</label>
        <input type="number" name="harbar" class="form-control">
    </div>
    <div class="form-group">
        <label>Kategori</label>
        <select name="katebar" class="form-control">
            <option value="">--Pilih--</option>
            <?php $query = $this->db->get('kategori')->result_array();
            foreach ($query as $k) { ?>
                <option value="<?= $k['id_kategori'] ?>"><?= ucfirst($k['nama_kategori']) ?></option>
            <?php } ?>
        </select>
    </div>
    <div class="form-group">
        <div width="30%" class="image">
            <img src="#" alt="" class="img img-rounded" id="tampilFoto">
        </div>
        <label>Foto Barang</label>
        <input type="file" name="photo" class="form-control" id="photo">
    </div>
    <div class="form-group">
        <label>Deskripsi Barang</label>
        <textarea name="desbar" class="form-control"></textarea>
    </div>
    <div class="modal-footer">
        <button class="btn btn-primary" type="submit">Submit</button>
    </div>
</form>
<script>
    // Ketika input file berubah
    var photoInput = document.getElementById('photo');
    var tampilFoto = document.getElementById('tampilFoto');

    photoInput.addEventListener('change', function() {
        var file = this.files[0];
        var reader = new FileReader();

        reader.onloadend = function() {
            tampilFoto.setAttribute('src', reader.result);
        }

        if (file) {
            reader.readAsDataURL(file); // Membaca file sebagai URL data
        } else {
            tampilFoto.setAttribute('src', '#');
        }
    });
</script>