<?php
    session_start();
    include 'koneksi.php';
    include 'format_number.php';
    $no_invoice = $_SESSION['no_invoice'];
?>

<!DOCTYPE html>
<html style="height:100%;">
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
            .wrapper{
              width: auto;
              height: 100%;
              margin: auto;
              background-color:rgba(0,0,0,0.7);
              border-radius: 0px;
            }
            .header{
              height: auto;
              background: transparent;
              margin-top: 0px;
            }
            .mainText{
                color: #fff;
                font-weight: bold;
                text-align: justify;
            }
            .txtbox{
                font-weight: bold;
            }
        </style>
    </head>
    <body id="bg" style="height:100%;">
        <nav class="nav navbar-default" style="background-color:#337ab7;">
            <div class="container-fluid">
                <div class="navbar-header col-xs-4">
                    <a href="#" class="navbar-brand" style="color:#fff;"><b>EXPEDISI GITA TRANS</b></a>
                </div>
            </div>
        </nav>
        <nav class="nav navbar-default" style="background-color:#337ab7;">
            <div class="container-fluid">
                <div class="navbar-header col-xs-4 col-xs-offset-4">
                    <a href="index.php" class="navbar-brand" style="color:#fff;"><i class="fa fa-arrow-left"></i> MENU</a>
                </div>
                <div class="navbar-header col-xs-4">
                    <h4 style="text-align:center;font-weight:bold;color:#fff;">Edit<br> <?php echo $_SESSION['no_invoice']; ?></h4>
                </div>
            </div>
        </nav>

        <div class="container-fluid wrapper">
            <div class="col-xs-3 header">

                <?php
                    if ($_GET['ulang'] == 0) {
                ?>

                <form class="" action="edit-proses.php" method="post" style="margin-top:30px;">
                    <div class="">
                        <?php
                            echo '<input type="hidden" name="invoice" value="'.$_SESSION['no_invoice'].'" readonly="readonly">';
                        ?>
                    </div>
                    <div class="form-group">
                        <?php
                            echo '<input type="text" class="form-control txtbox" name="kapal" value="'.$_SESSION['kapal'].'" readonly="readonly">'
                        ?>
                    </div>
                    <div class="form-group">
                        <?php
                            echo '<input type="text" class="form-control txtbox" name="pengirim" value="'.$_SESSION['pengirim'].'" readonly="readonly">';
                        ?>
                    </div>
                    <div class="form-group">
                        <?php
                            echo '<input type="hidden" name="alm_pengirim" value="'.$_SESSION['alm_pengirim'].'" readonly="readonly">';
                        ?>
                    </div>
                    <div class="form-group">
                        <?php
                            echo '<input type="text" class="form-control txtbox" name="penerima" value="'.$_SESSION['penerima'].'" readonly="readonly">';
                        ?>
                    </div>
                    <div class="form-group">
                        <?php
                            echo '<input type="hidden" name="alm_penerima" value="'.$_SESSION['alm_penerima'].'" readonly="readonly">';
                        ?>
                    </div>
                    <div class="form-group">
                        <input autofocus type="text" class="form-control txtbox" name="deskripsi" value="" placeholder="Deskripsi" required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control txtbox" name="jumlah" value="" placeholder="Jumlah" required>
                    </div>
                    <div class="form-group">
                        <select class="form-control txtbox" name="satuan">
                            <option>m3</option>
                            <option>Unit</option>
                            <option>Ton</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control txtbox" name="harga" value="" placeholder="Harga Satuan" required>
                    </div>
                    <div class="form-group" style="float:right;">
                        <button type="submit" name="submit" class="btn btn-success"><i class="fa fa-arrow-right"></i></button>
                    </div>
                </form>
                <?php
                    } else {
                        header('location:index.php');
                        session_destroy();
                    }
                ?>
            </div>
            <div class="col-xs-9 header">
                <div class="" style="overflow:auto; padding: 5px; height: 270px;">
                    <table class="table table-responsive">
                        <thead>
                            <tr>
                                <th class="mainText">#</th>
                                <th class="mainText">Deskripsi</th>
                                <th class="mainText">Jumlah</th>
                                <th class="mainText">Satuan</th>
                                <th class="mainText">Harga Satuan</th>
                                <th class="mainText">Total</th>
                                <th class="mainText">Hapus</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $query = mysql_query("SELECT * FROM transaksi where no_invoice = '$no_invoice'") or die(mysql_error());
                                if (mysql_num_rows($query) == 0) {
                                    echo '<tr><td class="mainText">Tidak Ada Data!!</td></tr>';
                                } else {
                                    $no = 1;
                                    while ($data = mysql_fetch_assoc($query)) {
                                        echo '<tr>';
                                            echo '<td class="mainText">'.$no.'</td>';
                                            echo '<td class="mainText">'.$data['deskripsi'].'</td>';
                                            echo '<td class="mainText">'.$data['jumlah'].'</td>';
                                            echo '<td class="mainText">'.$data['satuan'].'</td>';
                                            echo '<td class="mainText">Rp. '.rupiahFormat($data['harga_satuan']).',-</td>';
                                            echo '<td class="mainText">Rp. '.rupiahFormat($data['harga_total']).',-</td>';
                                            echo '<td class="mainText"><a class="btn btn-danger" href="edit-hapus.php?noInvoice='.$_SESSION['no_invoice'].'&desk='.$data['deskripsi'].'"><i class="fa fa-trash-o"></i></td>';
                                        echo '</tr>';
                                        $no++;
                                    }
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="input-group col-xs-4 col-xs-offset-8" style="margin-top:6px;">
                    <?php
                        $query_transaksi = mysql_query("SELECT SUM(harga_total) AS total FROM transaksi where no_invoice = '$no_invoice'");
                        $total_transaksi = mysql_fetch_assoc($query_transaksi);
                    ?>
                    <span class="input-group-addon mainText header">Total</span>
                    <input type="text" class="form-control txtbox" style="text-align:right;" value="Rp. <?php echo rupiahFormat($total_transaksi['total']) ?>,-" readonly="readonly">
                </div>
                <div class="form-group" style="margin-top:7px;float:right;">
                    <?php
                        echo '<a href="edit-simpan.php?Invoice='.$_SESSION['no_invoice'].'&total='.$total_transaksi['total'].'" class="btn btn-primary"><b><i class="fa fa-save"></i><br>Simpan</b></a>';
                        echo '<a style="margin-left:5px;" href="edit-simpan.php?Invoice='.$_SESSION['no_invoice'].' &total='.$total_transaksi['total'].'" onclick="print_popup()" class="btn btn-success"><b><i class="fa fa-print"></i><br>Simpan & Cetak</b></a>';
                    ?>
                </div>
            </div>
        </div>

        <script type="text/javascript" src="js/jquery.min.js"></script>
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
        <script>
            function print_popup(){
                <?php echo 'window.open("print_preview.php?Invoice='.$_SESSION['no_invoice'].'&pengirim='.$_SESSION['pengirim'].'&alm_pengirim='.$_SESSION['alm_pengirim'].'&penerima='.$_SESSION['penerima'].'&alm_penerima='.$_SESSION['alm_penerima'].'&kapal='.$_SESSION['kapal'].'&total='.$total_transaksi['total'].'", "", "width=907, height=259, menubar=yes,location=yes,scrollbars=yes, resizeable=yes, status=yes, copyhistory=no,toolbar=no")' ?>
            }
        </script>
    </body>
</html>
