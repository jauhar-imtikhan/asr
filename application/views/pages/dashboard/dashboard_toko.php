 <!-- Content Header (Page header) -->

 <!-- Main content -->
 <section class="content">

   <div id="myCarousel" class="carousel slide " data-ride="carousel">
     <!-- Indicators -->
     <ol class="carousel-indicators">
       <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
       <li data-target="#myCarousel" data-slide-to="1"></li>
       <li data-target="#myCarousel" data-slide-to="2"></li>
     </ol>

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

     <!-- Controls -->
     <a class="left carousel-control" href="#myCarousel" data-slide="prev">
       <span class="glyphicon glyphicon-chevron-left"></span>
     </a>
     <a class="right carousel-control" href="#myCarousel" data-slide="next">
       <span class="glyphicon glyphicon-chevron-right"></span>
     </a>
   </div>
   <div style="margin-top: 15px;">
     <div class="row">
       <div class="col-md-4 col-sm-4">
         <div class="box box-default">
           <div class="box-header with-border">
             <h3 class="box-title">Browser Usage</h3>

             <div class="box-tools pull-right">
               <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
               </button>
               <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
             </div>
           </div>
           <!-- /.box-header -->
           <div class="box-body">
             <div class="row">
               <div class="col-md-8">
                 <div class="chart-responsive">
                   <canvas id="pieChart" height="160" width="150" style="width: 150px; height: 160px;"></canvas>
                 </div>
                 <!-- ./chart-responsive -->
               </div>
               <!-- /.col -->
               <div class="col-md-4">
                 <ul class="chart-legend clearfix">
                   <li><i class="fa fa-circle-o text-red"></i> Chrome</li>
                   <li><i class="fa fa-circle-o text-green"></i> IE</li>
                   <li><i class="fa fa-circle-o text-yellow"></i> FireFox</li>
                   <li><i class="fa fa-circle-o text-aqua"></i> Safari</li>
                   <li><i class="fa fa-circle-o text-light-blue"></i> Opera</li>
                   <li><i class="fa fa-circle-o text-gray"></i> Navigator</li>
                 </ul>
               </div>
               <!-- /.col -->
             </div>
             <!-- /.row -->
           </div>
           <!-- /.box-body -->
           <div class="box-footer no-padding">
             <ul class="nav nav-pills nav-stacked">
               <li><a href="#">United States of America
                   <span class="pull-right text-red"><i class="fa fa-angle-down"></i> 12%</span></a></li>
               <li><a href="#">India <span class="pull-right text-green"><i class="fa fa-angle-up"></i> 4%</span></a>
               </li>
               <li><a href="#">China
                   <span class="pull-right text-yellow"><i class="fa fa-angle-left"></i> 0%</span></a></li>
             </ul>
           </div>
           <!-- /.footer -->
         </div>
       </div>
       <div class="col-md-4 col-sm-4">
         <div class="box box-default">
           <div class="box-header with-border">
             <h3 class="box-title">Browser Usage</h3>

             <div class="box-tools pull-right">
               <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
               </button>
               <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
             </div>
           </div>
           <!-- /.box-header -->
           <div class="box-body">
             <div class="row">
               <div class="col-md-8">
                 <div class="chart-responsive">
                   <canvas id="pieChart" height="160" width="150" style="width: 150px; height: 160px;"></canvas>
                 </div>
                 <!-- ./chart-responsive -->
               </div>
               <!-- /.col -->
               <div class="col-md-4">
                 <ul class="chart-legend clearfix">
                   <li><i class="fa fa-circle-o text-red"></i> Chrome</li>
                   <li><i class="fa fa-circle-o text-green"></i> IE</li>
                   <li><i class="fa fa-circle-o text-yellow"></i> FireFox</li>
                   <li><i class="fa fa-circle-o text-aqua"></i> Safari</li>
                   <li><i class="fa fa-circle-o text-light-blue"></i> Opera</li>
                   <li><i class="fa fa-circle-o text-gray"></i> Navigator</li>
                 </ul>
               </div>
               <!-- /.col -->
             </div>
             <!-- /.row -->
           </div>
           <!-- /.box-body -->
           <div class="box-footer no-padding">
             <ul class="nav nav-pills nav-stacked">
               <li><a href="#">United States of America
                   <span class="pull-right text-red"><i class="fa fa-angle-down"></i> 12%</span></a></li>
               <li><a href="#">India <span class="pull-right text-green"><i class="fa fa-angle-up"></i> 4%</span></a>
               </li>
               <li><a href="#">China
                   <span class="pull-right text-yellow"><i class="fa fa-angle-left"></i> 0%</span></a></li>
             </ul>
           </div>
           <!-- /.footer -->
         </div>
       </div>
       <div class="col-md-4 col-sm-4">
         <div class="box box-default">
           <div class="box-header with-border">
             <h3 class="box-title">Browser Usage</h3>

             <div class="box-tools pull-right">
               <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
               </button>
               <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
             </div>
           </div>
           <!-- /.box-header -->
           <div class="box-body">
             <div class="row">
               <div class="col-md-8">
                 <div class="chart-responsive">
                   <canvas id="pieChart" height="160" width="150" style="width: 150px; height: 160px;"></canvas>
                 </div>
                 <!-- ./chart-responsive -->
               </div>
               <!-- /.col -->
               <div class="col-md-4">
                 <ul class="chart-legend clearfix">
                   <li><i class="fa fa-circle-o text-red"></i> Chrome</li>
                   <li><i class="fa fa-circle-o text-green"></i> IE</li>
                   <li><i class="fa fa-circle-o text-yellow"></i> FireFox</li>
                   <li><i class="fa fa-circle-o text-aqua"></i> Safari</li>
                   <li><i class="fa fa-circle-o text-light-blue"></i> Opera</li>
                   <li><i class="fa fa-circle-o text-gray"></i> Navigator</li>
                 </ul>
               </div>
               <!-- /.col -->
             </div>
             <!-- /.row -->
           </div>
           <!-- /.box-body -->
           <div class="box-footer no-padding">
             <ul class="nav nav-pills nav-stacked">
               <li><a href="#">United States of America
                   <span class="pull-right text-red"><i class="fa fa-angle-down"></i> 12%</span></a></li>
               <li><a href="#">India <span class="pull-right text-green"><i class="fa fa-angle-up"></i> 4%</span></a>
               </li>
               <li><a href="#">China
                   <span class="pull-right text-yellow"><i class="fa fa-angle-left"></i> 0%</span></a></li>
             </ul>
           </div>
           <!-- /.footer -->
         </div>
       </div>
     </div>
   </div>


 </section>
 <!-- /.content -->
 <script src="<?= base_url() ?>assets/bower_components/jquery/dist/jquery.min.js"></script>