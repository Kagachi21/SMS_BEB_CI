
<div class="container-fluid">

<!-- Page Heading -->
    <div class="row">
        <div class="col-md-6" style="margin:auto!important">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary datatable">Informasi qrcode anda</h6>
                    <div class="navbar-form navbar-center">
                          <select class="form-control" id="camera-select"></select>
                      </div>
                </div>
                <div class="container text-center" style="margin-top:12px;">
                    <div class="well" style="position: middle;">
                        <canvas width="400" height="400" id="webcodecam-canvas"></canvas>
                        <div class="scanner-laser laser-rightBottom" style="opacity: 0.5;"></div>
                        <div class="scanner-laser laser-rightTop" style="opacity: 0.5;"></div>
                        <div class="scanner-laser laser-leftBottom" style="opacity: 0.5;"></div>
                        <div class="scanner-laser laser-leftTop" style="opacity: 0.5;"></div>
                    </div>
                    <?php Response_Helper::part('alert');?>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo base_url() ?>assets/js/qrcodelib.js"></script>
<script src="<?php echo base_url() ?>assets/js/webcodecamjquery.js"></script>
<script src="<?php echo base_url() ?>assets/js/scan.js"></script>