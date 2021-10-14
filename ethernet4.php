<?php
    include "conn.php";
    $no=1;
    $ambildata = mysqli_query($conn, "SELECT * FROM data ORDER BY id DESC LIMIT 2 ");
?>
<!DOCTYPE HTML>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="refresh" content="30" />
    <title>Monitor Traffic</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/css/bootstrap.min.css" integrity="sha384-VCmXjywReHh4PwowAiWNagnWcLhlEJLA5buUprzK8rxFgeH0kww/aWY76TfkUoSX" crossorigin="anonymous">


</head>

<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="./">Monitoring Traffic Mikrotik</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="./pppoe">Client PPPoE Active <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./daftarclient">Daftar Client PPPoE <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./report">Report Traffic-UP <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./search">Search <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Interface
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="./">Ethernet 1</a>
                        <a class="dropdown-item" href="./ethernet2">Ethernet 2</a>
                        <a class="dropdown-item" href="./ethernet3">Ethernet 3</a>
                        <a class="dropdown-item" href="./ethernet4">Ethernet 4</a>
                        <a class="dropdown-item" href="./ethernet5">Ethernet 5</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <button type="button" class="btn btn-primary btn-sm mt-2">
            <span class="spinner-grow spinner-grow-sm"></span>
            Auto refresh 30s
        </button>
    </div>

<div class="container mt-2">
    <table class="table table-striped">
        <thead>
            <tbody>
            <tr>
            <th scope="col">NO</th>
            <th scope="col">STATUS</th>
            <th scope="col">TANGGAL & JAM</th>
            </tr>
            </tbody>
        </thead>
    <!-- </table> -->
  <?php
    foreach ($ambildata as $tampil ){ ?>
        <thead>
            <tr>
            <td><?php echo $no; ?></td>
            <td><?php echo $tampil['text']; ?></td>
            <td style="color :red"><?php echo date("d F Y, h:i A", strtotime($tampil['time'])); ?></td>
            </tr>
        </thead>
    <?php 
    $no++ ;  
    $date;
    }
  ?>
</table>
</div>

    <main role="main" class="container">
            <div class="col-md-12 mt-2">
                <div class="card mt-2">
                    <div id="graph"></div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th>Interace</th>
                            <th>UPLOAD (TX)</th>
                            <th>DOWNLOAD (RX)</th>
                        </tr>
                        <tr>
                            <td><input name="interface" id="interface" type="text" value="ether4-ADMIN" disabled></td>
                            <td>
                                <div id="tabletx"></div>
                            </td>
                            <td>
                                <div id="tablerx"></div>
                            </td>
                        </tr>
                    </table>
                </div>

            </div>
        </div>
    </main>
    <!-- /.container -->


    <footer class="footer">
        <div class="container">
            <!-- <span class="text-muted">&copy; 2020 by <a href="//sharkwifi.com/">sharkwifi.com</a></span> -->
        </div>
    </footer>



    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/js/bootstrap.min.js" integrity="sha384-XEerZL0cuoUbHE4nZReLT7nx9gQrQreJekYhJD9WNWhH8nEW+0c5qq7aIo2Wl30J" crossorigin="anonymous"></script>
    <script type="text/javascript" src="highchart/js/highcharts.js"></script>
    <script>
        var chart;

        function requestDatta(interface) {
            $.ajax({
                url: 'data.php?interface=' + interface,
                datatype: "json",
                success: function(data) {
                    var midata = JSON.parse(data);
                    // console.log(midata);
                    if (midata.length > 0) {
                        var TX = parseInt(midata[0].data);
                        var RX = parseInt(midata[1].data);
                        var x = (new Date()).getTime();
                        shift = chart.series[0].data.length > 19;
                        chart.series[0].addPoint([x, TX], true, shift);
                        chart.series[1].addPoint([x, RX], true, shift);
                        document.getElementById("tabletx").innerHTML = convert(TX);
                        document.getElementById("tablerx").innerHTML = convert(RX);
                    } else {
                        document.getElementById("tabletx").innerHTML = "0";
                        document.getElementById("tablerx").innerHTML = "0";
                    }
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    console.error("Status: " + textStatus + " request: " + XMLHttpRequest);
                    console.error("Error: " + errorThrown);
                }
            });
        }

        $(document).ready(function() {
            Highcharts.setOptions({
                global: {
                    useUTC: false
                }
            });


            chart = new Highcharts.Chart({
                chart: {
                    renderTo: 'graph',
                    animation: Highcharts.svg,
                    type: 'spline',
                    events: {
                        load: function() {
                            setInterval(function() {
                                requestDatta(document.getElementById("interface").value);
                            }, 1000);
                        }
                    }
                },
                title: {
                    text: 'Monitoring Traffic'
                },
                xAxis: {
                    type: 'datetime',
                    tickPixelInterval: 150,
                    maxZoom: 20 * 1000
                },

                yAxis: {
                    minPadding: 0.2,
                    maxPadding: 0.2,
                    title: {
                        text: 'Traffic'
                    },
                    labels: {
                        formatter: function() {
                            var bytes = this.value;
                            var sizes = ['bps', 'kbps', 'Mbps', 'Gbps', 'Tbps'];
                            if (bytes == 0) return '0 bps';
                            var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
                            return parseFloat((bytes / Math.pow(1024, i)).toFixed(2)) + ' ' + sizes[i];
                        },
                    },
                },
                series: [{
                    name: 'UPLOAD (TX)',
                    data: []
                }, {
                    name: 'DOWNLOAD (RX)',
                    data: []
                }],
                tooltip: {
                    headerFormat: '<b>{series.name}</b><br/>',
                    pointFormat: '{point.x:%Y-%m-%d %H:%M:%S}<br/>{point.y}'
                },


            });
        });

        function convert(bytes) {

            var sizes = ['bps', 'kbps', 'Mbps', 'Gbps', 'Tbps'];
            if (bytes == 0) return '0 bps';
            var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
            return parseFloat((bytes / Math.pow(1024, i)).toFixed(2)) + ' ' + sizes[i];
        }
    </script>
</body>

</html>