<?php
$id = $this->input->get('id');
$row = $this->db->get_where('user', ['user_id' => $id])->row_array();
?>
<form action="" method="post">
    <div class="form-group">
        <label>Nama Depan</label>
        <input type="text" name="namdep" class="form-control" value="<?= $row['nama_depan'] ?>">
    </div>
    <div class="form-group">
        <label>Nama Belakang</label>
        <input type="text" name="nambel" class="form-control" value="<?= $row['nama_belakang'] ?>">
    </div>
    <div class="form-group">
        <label>Email</label>
        <input type="text" name="email" readonly value="<?= $row['email'] ?>" class="form-control">
    </div>
    <div class="form-group">
        <label>Alamat</label>
        <textarea name="alamat" class="form-control"><?= $row['alamat'] ?></textarea>
    </div>
    <div class="form-group">
        <label>Level</label>
        <select name="level" class="form-control">
            <?php $query = $this->db->get('level')->result_array();
            foreach ($query as $data) { ?>
                <option value="<?= $data['level_id'] ?>" <?php if ($row['level'] == $data['level_id']) { ?> selected<?php } ?>><?= $data['level_nama'] ?></option>
            <?php } ?>
        </select>
    </div>
    <div class="form-group">
        <label>Nomor Whatsapp</label>
        <input type="number" class="form-control" value="<?= $row['nowa'] ?>">
    </div>
</form>
<div class="modal-footer">
    <button class="btn btn-primary" type="submit">Submit</button>
</div>