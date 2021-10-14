<?php
    // include "conn.php";
    // $no=1;
    // $ambildata = mysqli_query($conn, "SELECT * FROM data ORDER BY id DESC LIMIT 20 ");
?>
<!DOCTYPE HTML>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="refresh" content="3" />
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
            Real Time
        </button>
    </div>
    <center><h1>INFORMASI PPPoE Active</h1></center>

        <div class="container mt-2" id="autodata">
            <table class="table table-striped">
                <thead>
                    <tbody>
                    <tr>
                    <th scope="col">NO</th>
                    <th scope="col">NAMA</th>
                    <th scope="col">SERVICE</th>
                    <th scope="col">CALLER ID</th>
                    <th scope="col">IP ADDRESS</th>
                    <th scope="col">UP TIME</th>
                    </tr>
                    </tbody>
                </thead>
                        <?php
                        require('koneksi.php');
                        $interface = $API->comm('/ppp/active/print');
                        $no=1;
                            foreach($interface as $row){
                                echo '<head>';
                                    echo '<tr>';
                                        echo '<td>' .$no. '</td>';
                                        echo '<td>' . $row['name']. '</td>' ;
                                        echo '<td>' . $row['service']. '</td>';
                                        echo '<td>' . $row['caller-id']. '</td>';
                                        echo '<td>' . $row['address']. '</td>';
                                        echo '<td>' . $row['uptime']. '</td>';
                                    echo '</tr>';
                                echo '</head>';
                            $API->disconnect();
                            $no++;
                            }
                        ?>
            </table>
        </div>

    <div class="container">
    </div>
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
</body>

</html>