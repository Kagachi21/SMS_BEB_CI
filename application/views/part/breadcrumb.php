
<ol class="breadcrumb">
    <li>
        <a href="<?=base_url()."admin/dashboard"?>">Dashboard</a>
    </li>
    <?php
        $var = str_replace("http://", "", base_url(uri_string()));
        $link = explode('/', $var);
        
        for($i = 3; $i < count($link);$i++){
    ?>
        <li><a href=""><?=  $link[$i] ?></a></li>
    <?php } ?>
    <!-- <li class="active">Data tables</li> -->
</ol>