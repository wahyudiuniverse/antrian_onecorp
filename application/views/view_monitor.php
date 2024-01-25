<!DOCTYPE html>
<html>
<head>
  <title>Monitor</title>
  <?php $this->load->view('css'); ?>
  <style type="text/css">
body {
        background: url('<?= base_url("asset/images/background2_.png"); ?>') no-repeat center center fixed;
        background-size: 100% 100%;
        -webkit-background-size: 100% 100%;
        -moz-background-size: 100% 100%;
        -o-background-size: 100% 100%;
        
}
    
  </style>
</head>
<body>


<div class="card-header text-center" style="font-size: 20px; font-weight: bold"><img src="asset/images/logo_cakrawala.png" style="width: 100px;height: 50px;">  PT. SIPRAMA CAKRAWALA</div>


<div class="container-fluid">
  <div class="row">
<div class="col-md-3 text-center" id="data-antri">
  <br>



</div>
    <div class="col-md-8">
      <br>
      <div class="card-deck shadow-lg p-2 mb-20 bg-white rounded" id="print-antri">
        <div class="card">
            



<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
<!--   <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
  </ol> -->
  <div class="carousel-inner" role="listbox">
    <?php 
    $no=1;
    foreach ($data_slider as $data) { ?>
    <div class="carousel-item <?php if($no==1) echo 'active'; ?>">
      <img class="d-block img-responsive img-fluid" src="<?= base_url('asset/image/'.$data['gambar']); ?>">
    </div>
    <?php $no++; } ?>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>


        </div>
      </div>    

    </div>

  </div>
</div>

<hr>
<div class="row" style="bottom: 0px;">
  <marquee><b>Running Text Here</b></marquee>
</div>

</div>


<?php $this->load->view('script'); ?>
<script type="text/javascript">
  $('.carousel').carousel({
  interval: 2000
})
  function get_monitor() {
    
    $.ajax({
      url:'<?= site_url('monitor/get_data'); ?>',
      dataType:'JSON',
      success:function(msg){
        var data = $('#data-antri');
        data.html('');
        for (i = 0; i < msg.length; i++) {
        // data.append('<tr><td>'+msg[i].nomor+'</td><td>'+msg[i].status+'</td><td>'+msg[i].nama+'</td></tr>'); 
        data.append('<br><div class="col-md-12" style="border: 2px solid;  border-radius: 15px;"><strong>Nomor Antrian Interview : </strong><br><span style="font-size: 75px; font-weight: bold;">'+msg[i].nomor+'</span><hr><h3><b>LOKET '+msg[i].loket_temp+'</b></h3></div>');
        }
      }
    });

  }
window.setInterval(get_monitor, 2000);

</script>
</body>
</html>