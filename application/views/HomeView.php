<h1> crud dengan codeigniter </h1>
<h3><a href="index.php/home/tambah">+ Tambah Artikel </a></h3>
<table border="1" cellpadding="5">
<tr>
    <th>Judul</th>
    <th>Penulis</th>
    <th>Isi</th>
    <th></th>
</tr>
<?php
foreach ($artikel as $row) {
 ?>
 <tr>
    <td><?php echo $row->judul;?></td>
    <td><?php echo $row->penulis;?></td>
    <td><?php echo substr($row->isi, 0, 70);
    ?>...</td>
    <td>
        <a href="<?php echo "index.php/home/detail/"
        . $row->id; ?>">Detail</a>
         <a href="<?php echo "index.php/home/ubah/"
        . $row->id; ?>">Ubah</a>
         <a href="<?php echo "index.php/home/delete/"
        . $row->id; ?>">Hapus</a>
    </td>
 </tr>
 <?php
}
?>
</table>