<?php $id = $this->input->get('id');
$query = $this->db->get_where('databarang', ['id_barang' => $id])->row_array();
?>
<form action="<?= site_url('databarang/updatedatabarang/' . $query['id_barang']) ?>" method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="col-md-4" id="gambar">
            <img src="<?= base_url('uploads/' . $query['foto']) ?>" alt="Foto Barang" class="img-rounded " style="margin-top: 20px; margin-left:20px; width: 50%;">
        </div>
        <div class="col-md-8">
            <div class="form-group">
                <label>Nama Barang</label>
                <input type="text" name="nama" value="<?= $query['nama_barang'] ?>" class="form-control">
            </div>
            <div class="form-group">
                <label>Harga Barang</label>
                <input type="text" name="harga" value="<?= Rp($query['harga_barang']) ?>" class="form-control">
            </div>
            <div class="form-group">
                <label>Kategori Barang</label>
                <select name="kategori" class="form-control">
                    <?php $get = $this->db->get('kategori')->result_array();
                    foreach ($get as $kat) { ?>
                        <option value="<?= $kat['id_kategori'] ?>" <?php if ($query['kategori'] == $kat['id_kategori']) { ?> selected<?php } ?>><?= ucfirst($kat['nama_kategori']) ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label>Deskripsi Barang</label>
                <textarea name="deskripsi" class="form-control"><?= $query['deskripsi'] ?></textarea>
            </div>
            <div class="form-group">
                <label>Foto Barang</label>
                <input type="file" name="photo" class="form-control">
            </div>
        </div>

    </div>
    <div class="modal-footer">
        <button type="submit" name="save" class="btn btn-primary">Simpan</button>
    </div>
</form>