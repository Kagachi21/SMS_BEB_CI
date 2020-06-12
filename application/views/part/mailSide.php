<?php
$ci = get_instance();
?>
<div class="col-md-3">
    <a href="<?= base_url("admin/".$ci->uri->segment(2)."/add")?>" class="btn btn-primary btn-block margin-bottom">Tambah</a>

    <div class="box box-solid">
    <div class="box-header with-border">
        <h3 class="box-title">Folders</h3>

        <div class="box-tools">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
        </button>
        </div>
    </div>
    <div class="box-body no-padding">
        <ul class="nav nav-pills nav-stacked">
        <li class="<?= ($ci->uri->segment(2) == 'surat_masuk' &&  $ci->uri->segment(4) =="" ? 'active' : '') ?>">
            <a href="<?= base_url("admin/surat_masuk")?>"><i class="fa fa-inbox"></i> Surat masuk
            </a>
        </li>
        <!-- <li class="<?= ($ci->uri->segment(2) == 'surat_keluar' ? ' active' : '') ?>"><a href="<?= base_url("admin/surat_keluar")?>"><i class="fa fa-envelope-o"></i> Surat Keluar</a></li> -->
        <li class="<?= ($ci->uri->segment(2) == 'draft' ? 'active' : '') ?>"><a href="<?= base_url("admin/surat_keluar")?>"><i class="fa fa-file-text-o"></i> Draft</a></li>
        <li class="<?= ($ci->uri->segment(4) == 'sampah' ? 'active' : '') ?>"><a href="<?= base_url("admin/surat_masuk/index/sampah")?>"><i class="fa fa-trash-o"></i> Arsip inaktif</a></li>
        </ul>
    </div>
    <!-- /.box-body -->
    </div>
    <!-- /. box -->
    <div class="box box-solid">
    <div class="box-header with-border">
        <h3 class="box-title">Labels</h3>

        <div class="box-tools">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
        </button>
        </div>
    </div>
    <div class="box-body no-padding">
        <ul class="nav nav-pills nav-stacked">
        <li><a href="#"><i class="fa fa-circle-o text-red"></i> Important</a></li>
        <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> Promotions</a></li>
        <li><a href="#"><i class="fa fa-circle-o text-light-blue"></i> Social</a></li>
        </ul>
    </div>
    <!-- /.box-body -->
    </div>
    <!-- /.box -->
</div>