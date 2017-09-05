<?php
    include 'koneksi.php';
    include 'format_number.php';
    $no_invoice = $_GET['Invoice'];
    $pengirim = $_GET['pengirim'];
    $alm_pengirim = $_GET['alm_pengirim'];
    $penerima = $_GET['penerima'];
    $alm_penerima = $_GET['alm_penerima'];
    $kapal = $_GET['kapal'];
    $total_transaksi = $_GET['total'];
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
                text-align: center;
            }
            .txtbox{
                font-weight: bold;
            }
            input.empty {
                font-family: FontAwesome;
                font-style: normal;
                font-weight: normal;
                text-decoration: inherit;
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
                <div class="navbar-header col-xs-4">
                    <a href="index.php" class="navbar-brand" style="color:#fff;"><i class="fa fa-arrow-left"></i> MENU</a>
                </div>
                <div class="navbar-header col-xs-4">
                    <h4 style="text-align:center;font-weight:bold;color:#fff;"><?php echo $no_invoice; ?></h4>
                </div>
            </div>
        </nav>
        <div class="container wrapper" style="height:87%;">
            <div class="col-xs-4">
                <p class="mainText" style="text-align:left;"><b><u>Pengirim</u><br><?php echo $pengirim .'<br>'. $alm_pengirim ?></b></p>
            </div>
            <div class="col-xs-4">
                <p class="mainText"><b><u>Kapal</u><br><?php echo $kapal ?></b></p>
            </div>
            <div class="col-xs-4">
                <p class="mainText" style="text-align:right;"><b><u>Penerima</u><br><?php echo $penerima .'<br>'. $alm_penerima ?></b></p>
            </div>
            <div class="" style="overflow:auto; padding: 5px; height: 300px; margin-top:50px;">
                <table class="table table-responsive">
                    <thead>
                        <tr>
                            <th class="mainText">#</th>
                            <th class="mainText">Deskripsi</th>
                            <th class="mainText">Jumlah</th>
                            <th class="mainText">Satuan</th>
                            <th class="mainText">Harga Satuan</th>
                            <th class="mainText">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $query = mysql_query("SELECT deskripsi,jumlah,satuan,harga_satuan,harga_total FROM transaksi where no_invoice = '$no_invoice'") or die(mysql_error());
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
            <div class="col-xs-12">
                <div class="form-group" style="margin-top:7px;float:right;">
                    <a class="btn btn-primary" href="daftarTransaksi.php"><b><i class="fa fa-arrow-left"></i><br>Kembali</b></a>
                    <?php
                        echo '<a class="btn btn-warning" href="pra-edit.php?Invoice='.$no_invoice.'&pengirim='.$pengirim.'&alm_pengirim='.$alm_pengirim.'&penerima='.$penerima.'&alm_penerima='.$alm_penerima.'&kapal='.$kapal.'"><b><i class="fa fa-pencil"></i><br>Edit</b></a>';
                    ?>

                    <a class="btn btn-success" href="javascript:print_popup();"><b><i class="fa fa-print"></i><br>Print</b></a>
                </div>
            </div>
        </div>

        <script type="text/javascript" src="js/jquery.min.js"></script>
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
        <script>
            // Untuk Placeholder font awesome
            $('#iconified').on('keyup', function() {
                var input = $(this);
                if(input.val().length === 0) {
                    input.addClass('empty');
                } else {
                    input.removeClass('empty');
                }
            });

            function print_popup(){
                <?php echo 'window.open("print_preview2.php?Invoice='.$no_invoice.'", "", "width=907, height=259, menubar=yes,location=yes,scrollbars=yes, resizeable=yes, status=yes, copyhistory=no,toolbar=no")' ?>
            }
        </script>
    </body>
</html>
