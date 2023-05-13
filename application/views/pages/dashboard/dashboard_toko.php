 <!-- Content Header (Page header) -->

 <!-- Main content -->
 <section class="content">

   <div id="myCarousel" class="carousel slide " data-ride="carousel">
     <!-- Indicators -->

     <!-- Slides -->
     <div class="carousel-inner">
       <div class="item active">
         <img src="<?= base_url('uploads/1.png') ?>" alt="Slide 1">

       </div>
       <div class="item">
         <img src="<?= base_url('uploads/2.png') ?>" alt="Slide 2">
       </div>
       <div class="item">
         <img src="<?= base_url('uploads/3.png') ?>" alt="Slide 3">
       </div>
     </div>


   </div>
   <div style="margin-top: 15px;">
     <div class="alert alert-danger">
       <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
       <strong><i class="fa fa-info"></i>nfo! </strong> Barang Yang Ada Pada Keranjang Akan Hilang Setelah Anda Keluar Dari Website!
     </div>
   </div>
   <div style="margin-top: 15px;">
     <div class="row">
       <?php

        foreach ($databarang as $barang) { ?>
         <div class="col-lg-4 col-md-6 col-sm-8 col-xs-12">
           <div class="panel">

             <!-- /.box-header -->
             <div class="panel-body">
               <div class="row">
                 <div class="col-md-6 col-sm-6 ">
                   <div class="image">
                     <img src="<?= base_url('uploads/' . $barang['foto']) ?>" alt="<?= $barang['foto'] ?>" class="img-rounded" style="width: 200px;">
                   </div>
                 </div>
                 <div class="col-md-6 col-sm-6 ">
                   <dl style="margin-left: 10px;">
                     <dt class="h3"><?= ucfirst($barang['nama_barang']) ?></dt>
                     <dd class="h4"><?= Rp($barang['harga_barang']) ?></dd>
                     <dt class="h5"><?= $barang['deskripsi'] ?></dt>
                     <dd class="h5"><?= Gr($barang['berat']) ?></dd>
                   </dl>
                 </div>
               </div>
               <!-- /.row -->
             </div>
             <!-- /.box-body -->
             <div class="box-footer ">
               <ul class="nav nav-pills nav-stacked ">
                 <form action="<?= site_url('dashboard/addkeranjang') ?>" method="post">
                   <input type="hidden" name="id" value="<?= $barang['id_barang'] ?>">
                   <input type="hidden" name="nama_barang" value="<?= $barang['nama_barang'] ?>">
                   <input type="hidden" name="harga_barang" value="<?= $barang['harga_barang'] ?>">
                   <input type="hidden" name="des_barang" value="<?= $barang['deskripsi'] ?>">
                   <input type="hidden" name="foto_barang" value="<?= $barang['foto'] ?>">
                   <input type="hidden" name="berat" value="<?= $barang['berat'] ?>">
                   <li>
                     <span class="pull-right">
                       <?php for ($i = 0; $i < count($rating) && $i < $barang['rating']; $i++) { ?>
                         <span style="color: gold;"><i class="fa fa-star"></i></span>
                       <?php } ?>
                     </span>
                     <button class="btn btn-danger" data-target="tooltip" data-placement="top" title="Detail Produk"><i class="fa fa-eye"></i></button>&nbsp;&nbsp;
                     <button class="btn btn-warning" type="submit" data-target="tooltip" data-placement="top" title="Tambah Ke Keranjang"><i class="fa fa-shopping-cart"></i></button>&nbsp;&nbsp;
                     <button class="btn btn-info" data-target="tooltip" data-placement="top" title="Pesan Barang"><i class="fa fa-clipboard"></i> Pre Order</button>
                   </li>
                 </form>

               </ul>
             </div>
             <!-- /.footer -->
           </div>
         </div>

       <?php } ?>
     </div>
   </div>
   <nav aria-label="Page navigation" class="text-center">
     <?= $this->pagination->create_links() ?>
   </nav>


 </section>
 <!-- /.content -->
 <script src="<?= base_url() ?>assets/bower_components/jquery/dist/jquery.min.js"></script>
 <script>
   $(document).ready(function() {
     $('#addKeranjang').on('click', function() {

     })
   })
 </script>