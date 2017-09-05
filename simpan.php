<?php
    include 'koneksi.php';

    $no_invoice = $_GET['Invoice'];
    $pengirim = $_GET['pengirim'];
    $alm_pengirim = $_GET['alm_pengirim'];
    $penerima = $_GET['penerima'];
    $alm_penerima = $_GET['alm_penerima'];
    $kapal = $_GET['kapal'];
    $total_transaksi = $_GET['total'];

    $query = mysql_query("INSERT INTO total_transaksi VALUES ('$no_invoice',(SELECT CURRENT_DATE()),'$pengirim','$alm_pengirim','$penerima','$alm_penerima','$kapal','$total_transaksi')") or die(mysql_error());
    session_start();
    session_destroy();
    header('location:index.php');
?>
