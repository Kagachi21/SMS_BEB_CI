<!-- <link rel="stylesheet" href="<?php echo base_url()?>assets/css/printcss.css" type="text/css" media="print"/> -->
<div class="box box-widget">
<div class="row">
    <div class="col-md-6">
        <img src="<?= base_url('dashboard/siswa/generate/'.$nis) ?>" alt="">
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="">Nis</label>
            <h6><?= $nis ?></h6>
        </div>
        <div class="form-group">
            <label for="">Nama</label>
            <h6><?= $nama ?></h6>
        </div>
    </div>
</div>
      <script type="text/javascript">
        function printDiv(divName) {
           var printContents = document.getElementById(divName).innerHTML;
           var originalContents = document.body.innerHTML;
           document.body.innerHTML = printContents;
           window.print();
           document.body.innerHTML = originalContents;
      }
      </script>
