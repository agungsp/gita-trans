<!DOCTYPE html>
<html>
    <body>
        <?php
            include 'koneksi.php';
            $no_invoice = $_POST['invoice'];
            $pengirim = $_POST['pengirim'];
            $alm_pengirim = $_POST['alm_pengirim'];
            $penerima = $_POST['penerima'];
            $alm_penerima = $_POST['alm_penerima'];
            $kapal = $_POST['kapal'];
            $deskripsi = $_POST['deskripsi'];
            $jumlah = $_POST['jumlah'];
            $satuan = $_POST['satuan'];
            $harga = $_POST['harga'];
            if ($jumlah<1) {
                $total =$harga;
            } else {
                $total = $jumlah * $harga;
            }

            if (isset($_POST['submit'])) {
                $query = mysql_query("INSERT INTO `transaksi` VALUES ('$no_invoice',(SELECT CURRENT_DATE()),'$pengirim','$alm_pengirim','$penerima','$alm_penerima','$kapal','$deskripsi','$jumlah','$satuan','$harga','$total')");
                header("Location: edit.php?ulang=0");
            }
        ?>
    </body>
</html>
