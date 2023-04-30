<?php $json  = file_get_contents(FCPATH. 'package.json');
$data = json_decode($json);
$version = $data->version;
$author = $data->author;
?>
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> <?= $version?>
    </div>
    <strong>Copyright &copy; <?= date('Y')?> <a href="https://github.com/jauhar-imtikhan"><?= $author?></a></strong> All rights
    reserved.
  </footer>