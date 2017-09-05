<?php
    include 'koneksi.php';
    include 'format_number.php';
    $query = "SELECT * FROM total_transaksi";
    $result = mysql_query($query);
    $no_invoice = mysql_num_rows($result) + 1;
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>EXPEDISI GITA TRANS</title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/font-awesome.min.css">
        <style type="text/css">
            #bg {
                background-image: url('bg.jpg');
                background-size: cover;
            }
        </style>
    </head>
    <body id="bg">
        <nav class="nav navbar-default" style="background-color:#337ab7;">
            <div class="container-fluid">
                <div class="navbar-header col-xs-4">
                    <a href="#" class="navbar-brand" style="color:#fff;"><b>EXPEDISI GITA TRANS</b></a>
                </div>
            </div>
        </nav>
        <nav class="nav navbar-default" style="background-color:#337ab7;">
            <div class="container-fluid">
                <div class="navbar-header col-xs-4">
                    <a href="index.php" class="navbar-brand" style="color:#fff;"><i class="fa fa-arrow-left"></i> MENU</a>
                </div>
                <div class="navbar-header col-xs-4">
                    <h4 style="text-align:center;color:#fff;">Invoice<br> <?php echo invoiceFormat($no_invoice).'/'.date("m/y"); ?></h4>
                </div>
            </div>
        </nav>

        <div class="container-fluid">
            <div class="col-xs-4 col-xs-offset-4">
                <div class="panel panel-default" style="margin-top:30px;">
                    <div class="panel-body">
                        <?php
                            if (isset($_POST['asal']) AND isset($_POST['tujuan']) AND isset($_POST['alm_asal']) AND isset($_POST['alm_tujuan']) AND isset($_POST['kapal'])) {
                                session_start();
                                $asal = $_POST['asal'];
                                $tujuan = $_POST['tujuan'];
                                $alm_asal = $_POST['alm_asal'];
                                $alm_tujuan = $_POST['alm_tujuan'];
                                $kapal = $_POST['kapal'];
                                $_SESSION['pengirim'] = $asal;
                                $_SESSION['penerima'] = $tujuan;
                                $_SESSION['alm_pengirim'] = $alm_asal;
                                $_SESSION['alm_penerima'] = $alm_tujuan;
                                $_SESSION['kapal'] = $kapal;
                                header('location:buatInvoice.php?ulang=0');
                            }
                            else {
                                echo '
                                    <form action="asal-tujuan.php" method="post">
                                        <div class="form-group">
                                            <label>Dari</label>
                                            <input autofocus type="text" name="asal" class="form-control" placeholder="Pihak Pengirim" required>
                                            <input type="text" style="margin-top:5px;" name="alm_asal" class="form-control" placeholder="Alamat Pengirim" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Ditujukan Kepada</label>
                                            <input type="text" name="tujuan" class="form-control" placeholder="Pihak Penerima" required>
                                            <input type="text" style="margin-top:5px;" name="alm_tujuan" class="form-control" placeholder="Alamat Penerima" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Kapal yang Digunakan</label>
                                            <input type="text" class="form-control" name="kapal" placeholder="Nama Kapal" required>
                                        </div>
                                        <div class="form-group">
                                            <a href="index.php" class="btn btn-danger"><i class="fa fa-arrow-left"></i><b> Batal</b></a>
                                            <button type="submit" name="submit" class="btn btn-success" style="float:right;"><i class="fa fa-check"></i><b> Lanjut</b></button>
                                        </div>

                                    </form>
                                ';
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript" src="js/jquery.min.js"></script>
        <script type="text/javascript" src="js/bootstrap.min.js"></script>

    </body>
</html>
