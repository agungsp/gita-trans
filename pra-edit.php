<?php
    session_start();
    $no_invoice = $_GET['Invoice'];
    $kapal = $_GET['kapal'];
    $pengirim = $_GET['pengirim'];
    $alm_pengirim = $_GET['alm_pengirim'];
    $penerima = $_GET['penerima'];
    $alm_penerima = $_GET['alm_penerima'];
    $_SESSION['no_invoice'] = $no_invoice;
    $_SESSION['kapal'] = $kapal;
    $_SESSION['pengirim'] = $pengirim;
    $_SESSION['alm_pengirim'] = $alm_pengirim;
    $_SESSION['penerima'] = $penerima;
    $_SESSION['alm_penerima'] = $alm_penerima;

    header('location:edit.php?ulang=0');
?>
