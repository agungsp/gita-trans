<?php
    session_start();
    include 'koneksi.php';
    include 'format_number.php';
    $no_invoiceFULL = $_GET['Invoice'];
    $pengirim = $_GET['pengirim'];
    $alm_pengirim = $_GET['alm_pengirim'];
    $penerima = $_GET['penerima'];
    $alm_penerima = $_GET['alm_penerima'];
    $kapal = $_GET['kapal'];
    $total_transaksi = $_GET['total'];
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title><?php echo $no_invoiceFULL ?></title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
    </head>
    <body onload="window.print()">
        <div class="container-fluid" >
            <div class="col-xs-12" style="border:1px solid black; height:auto;" >
                <?php
                    $query1 = mysql_query("SELECT * FROM total_transaksi where no_invoice = '$no_invoiceFULL'") or die(mysql_error());
                    $data1 = mysql_fetch_assoc($query1);
                ?>
                <center>
                    <h2 style="font-weight:bold;">EXPEDISI GITA TRANS</h2>
                    <hr style="border:1px solid black">
                    <b><u>INVOICE</u></b><br> <?php echo $no_invoiceFULL; ?>
                </center>
                <table style="margin-bottom:10px;">
                    <tr>
                        <td style="border:0px;width:500px;padding:5px;text-align:left;">
                            Kepada <br> <?php echo '<b>'.$pengirim.'</b><br>'.$alm_pengirim; ?>
                        </td>
                        <td style="border-top:0px;border-bottom:0px;width:420px;text-align:center;">
                            Dikirim Menggunakan <br> <?php echo '<b>'.$kapal.'</b>' ?>
                        </td>
                        <td style="border:0px;width:500px;padding:5px;text-align:right;">
                            Ditujukan Kepada <br> <?php echo '<b>'.$penerima.'</b><br>'.$alm_penerima; ?>
                        </td>
                    </tr>
                </table>
                <table class="" style="border:1px solid black;width:100%;">
                    <thead>
                        <tr style="height:25px;">
                            <th style="text-align:center;border:1px solid black;">No.</th>
                            <th style="text-align:center;border:1px solid black;">Deskripsi</th>
                            <th style="text-align:center;border:1px solid black;">Jumlah</th>
                            <th style="text-align:center;border:1px solid black;">Satuan</th>
                            <th style="text-align:center;border:1px solid black;">Harga Satuan</th>
                            <th style="text-align:center;border:1px solid black;">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $query = mysql_query("SELECT * FROM transaksi where no_invoice = '$no_invoiceFULL'") or die(mysql_error());
                            if (mysql_num_rows($query) == 0) {
                                echo '<tr><td>Tidak Ada Data!!</td></tr>';
                            } else {
                                $no = 1;
                                while ($data = mysql_fetch_assoc($query)) {
                                    echo '<tr>';
                                        echo '<td style="text-align:center;border:1px solid black;">'.$no.'</td>';
                                        echo '<td style="text-align:center;border:1px solid black;">'.$data['deskripsi'].'</td>';
                                        echo '<td style="text-align:center;border:1px solid black;">'.$data['jumlah'].'</td>';
                                        echo '<td style="text-align:center;border:1px solid black;">'.$data['satuan'].'</td>';
                                        echo '<td style="border:1px solid black;text-align:right;">Rp. '.rupiahFormat($data['harga_satuan']).',-</td>';
                                        echo '<td style="border:1px solid black;text-align:right;">Rp. '.rupiahFormat($data['harga_total']).',-</td>';
                                    echo '</tr>';
                                    $no++;
                                }
                            }
                        ?>
                        <tr>
                            <td style="border:1px solid white"></td>
                            <td style="border:1px solid white"></td>
                            <td style="border:1px solid white"></td>
                            <td style="border-right:1px solid black;border-bottom:1px solid white;"></td>
                            <td style="border:1px solid black;text-align:center;">Total</td>
                            <td style="border:1px solid black;text-align:right;"><?php echo 'Rp. '.rupiahFormat($total_transaksi).',-'  ?></td>
                        </tr>
                    </tbody>
                </table>
                <div style="border:1px solid black;margin-top:10px;">
                    <label style="margin-left:5px;">Terbilang:</label>
                    <?php echo '<i style="float:right;margin-right:5px;"><b>"'.terbilang($total_transaksi,$style=3).' Rupiah"</b></i>' ?>
                </div>
                <br>
                <table style="margin-bottom:10px;">
                    <tr>
                        <td style="border:1px solid black;width:500px;padding:10px; font-weight:bold;">
                            BCA Sigit Tjahjono <br> 46 81 51 97 47
                            <br><br>
                            MANDIRI Sigit Tjahjono <br> 140 000 482 1840
                        </td>
                        <td style="border-top:0px;border-bottom:0px;width:420px;"></td>
                        <td style="border:0px;width:500px;padding:10px;text-align:center;font-weight:bold;">
                            Surabaya,
                            <?php
                                $tgl = date("Y-m-d");
                                echo TanggalIndo($tgl);
                            ?>
                            <br><br><br><br>
                            Sigit Tjahjono
                        </td>
                    </tr>
                </table>
                <?php
                    session_destroy();
                ?>
            </div>
        </div>
    </body>
</html>
