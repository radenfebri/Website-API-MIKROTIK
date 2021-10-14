<?php

require('koneksi.php');
   $interface = $API->comm('/ppp/active/print');
//    echo $result;
foreach($interface as $data){
    echo $data['name']. '<br>';
}
   $API->disconnect();


