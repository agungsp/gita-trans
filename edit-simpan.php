<?php
    include 'koneksi.php';

    $no_invoice = $_GET['Invoice'];
    $total_transaksi = $_GET['total'];

    $query = mysql_query("UPDATE total_transaksi SET total = '$total_transaksi' where no_invoice = '$no_invoice' ") or die(mysql_error());
    session_start();
    session_destroy();
    header('location:index.php');
?>
