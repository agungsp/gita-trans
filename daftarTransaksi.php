<?php
    include 'koneksi.php';
    include 'format_number.php';
    $temp = array();
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
                <div class="navbar-header col-xs-4 col-xs-offset-4">
                    <a href="index.php" class="navbar-brand" style="color:#fff;"><i class="fa fa-arrow-left"></i> MENU</a>
                </div>
            </div>
        </nav>

        <div class="container-fluid wrapper" style="height:93%;">
            <div class="col-xs-12">
                <div class="row">
                    <!-- Untuk tab pencarian -->
                    <form action="daftarTransaksi.php" method="post">
                        <div class="form-group" style="padding:5px; ">
                            <center>
                                <input autofocus type="text" name="cari" style="width:500px;text-align:center;" class="form-control empty" id="iconified" placeholder="&#xF002; Cari berdasarkan No Invoice, Pengirim, Penerima atau Total Transaksi"/>
                                <button type="submit" class="btn btn-info" style="border-radius:110px;" name="refresh"><i class="fa fa-refresh"></i></button>
                            </center>
                        </div>
                    </form>
                </div>
                <div class="row">
                    <!-- Untuk frame list -->
                    <div class="" style="overflow:auto; padding: 5px; height: 350px;">
                        <table class="table table-responsive">
                            <thead>
                                <tr>
                                    <th class="mainText">#</th>
                                    <th class="mainText">Invoice</th>
                                    <th class="mainText">Tanggal</th>
                                    <th class="mainText">Kapal</th>
                                    <th class="mainText">Pengirim</th>
                                    <th class="mainText">Penerima</th>
                                    <th class="mainText">Transaksi</th>
                                    <th class="mainText">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    if (isset($_POST['cari'])) {
                                        $cari = $_POST['cari'];
                                        $query = mysql_query("SELECT * FROM total_transaksi where no_invoice like '%$cari%' or kapal like '%$cari%' or pengirim like '%$cari%' or penerima like '%$cari%' or total like '%$cari%'") or die(mysql_error());
                                    }
                                    elseif (isset($_POST['refresh'])) {
                                        $query = mysql_query("SELECT * FROM total_transaksi") or die(mysql_error());
                                    }
                                    else {
                                        $query = mysql_query("SELECT * FROM total_transaksi") or die(mysql_error());
                                    }

                                    if (mysql_num_rows($query) == 0) {
                                        echo '<tr><td class="mainText">Tidak Ada Data!!</td></tr>';
                                    } else {
                                        $no = 1;
                                        while ($data = mysql_fetch_assoc($query)) {
                                            echo '<tr>';
                                                echo '<td class="mainText">'.$no.'</td>';
                                                echo '<td class="mainText">'.$data['no_invoice'].'</td>';
                                                echo '<td class="mainText">'.TanggalIndoDB($data['tgl']).'</td>';
                                                echo '<td class="mainText">'.$data['kapal'].'</td>';
                                                echo '<td class="mainText">'.$data['pengirim'].'</td>';
                                                echo '<td class="mainText">'.$data['penerima'].'</td>';
                                                echo '<td class="mainText">Rp. '.rupiahFormat($data['total']).',-</td>';
                                                echo '<td class="mainText">
                                                        <a class="btn btn-primary" style="height:25px; padding:4px;" href="view.php?Invoice='.$data['no_invoice'].'&pengirim='.$data['pengirim'].'&alm_pengirim='.$data['alm_pengirim'].'&penerima='.$data['penerima'].'&alm_penerima='.$data['alm_penerima'].'&kapal='.$data['kapal'].'&total='.$data['total'].'"><i class="glyphicon glyphicon-eye-open"></i>
                                                        <a class="btn btn-success" style="height:25px; padding:4px; margin-left:3px;" href="print_preview2.php?Invoice='.$data['no_invoice'].'"><i class="fa fa-print"></i></a>
                                                      </td>';
                                            echo '</tr>';
                                            $no++;
                                        }
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
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

            /*function print_popup(){
                <?php //echo 'window.open("print_preview2.php?Invoice='.$temp.'", "", "width=auto, height=auto, menubar=yes,location=yes,scrollbars=yes, resizeable=yes, status=yes, copyhistory=no,toolbar=no")' ?>
            }*/
        </script>
    </body>
</html>
