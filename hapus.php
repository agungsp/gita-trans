<?php
    include 'koneksi.php';
    $no_invoiceFULL = $_GET['noInvoice'];
    $deskripsi = $_GET['desk'];
    $query = mysql_query("DELETE FROM transaksi where no_invoice = '$no_invoiceFULL' AND deskripsi = '$deskripsi'");
    header('location:buatInvoice.php?ulang=0');
?>
