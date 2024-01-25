<!DOCTYPE html>
<html>
<head>
	<title>Antrian Interview PT. ONE CORP</title>
	<?php $this->load->view('css'); ?>
	<style>
body, html {
  height: 100%;
  margin: 0;
}

.bg {
  /* The image used */
  background-image: url("img_girl.jpg");

  /* Full height */
  height: 100%; 

  /* Center and scale the image nicely */
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
}
</style>	
</head>
<body style="width:100%; height:100%;">


			<div class="card-deck shadow-lg p-3 mb-5 bg-white rounded" id="print-antri">
			  <div class="card">

			      <div class="card-header text-center" style="font-size: 50px; font-weight: bold"><img src="asset/images/logo_cakrawala.png" style="width: 400px;height: 400px;"><br>PT. SIPRAMA CAKRAWALA</div>

			      <h5 class="card-title text-center" style="font-size: 50px; font-weight: bold">NOMOR ANTRIAN ANDA</h5>
			  	<strong style="font-size: 370px; text-align: center;" id="no-antrian">0</strong>
			    <div class="card-body">
			      <h5 class="card-title text-center" style="font-size: 50px; font-weight: bold">Terima Kasih Telah Menunggu</h5>
			    </div>
			  </div>
			</div>

			<button type="button" onclick="print_antrian()" class="btn btn-lg btn-success" style="width:100%;"><b><br><br><h1>AMBIL NOMOR ANTRIAN</h1><br><br></b></button>




<?php $this->load->view('script'); ?>

<script type="text/javascript">


    function PrintDiv() {    
       var divToPrint = document.getElementById('print-antri');
       var popupWin = window.open('', '_blank', 'width=300,height=300');
       popupWin.document.open();
       popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
        popupWin.document.close();
      }


	function print_antrian() {

		$.ajax({
			url:'<?= site_url("antrian_sc/print_antrian") ?>',
			dataType:'JSON',
			success:function(data){
				if (data!=null) {
					$('#no-antrian').html(data);
					window.print();
					// PrintDiv();
				}else{
					alert('gagal generate nomor');
				}
			}
		});	

	}

</script>

</body>
</html>