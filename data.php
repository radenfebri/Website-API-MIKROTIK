
<?php require_once('routeros_api.class.php'); ?>

<?php
$iphost= "host-mikrotik";
$userhost="user-mikrotik";
$passwdhost="password-mikrotik";
$api_puerto=8728;
$interface = $_GET["interface"]; //"<pppoe-nombreusuario>";

$API = new RouterosAPI();
$API->debug = false;
	if($API->connect( $iphost, $userhost, $passwdhost)){

//$getinterface = $API->comm("/interface/print");
    //$interface = $getinterface[$iface-1]['name'];
    $getinterfacetraffic = $API->comm("/interface/monitor-traffic", array(
      "interface" => "$interface",
      "once" => "",
      ));

    $rows = array(); $rows2 = array();

    $ftx = $getinterfacetraffic[0]['tx-bits-per-second'];
    $frx = $getinterfacetraffic[0]['rx-bits-per-second'];

      $rows['name'] = 'Tx';
      $rows['data'][] = $ftx;
      $rows2['name'] = 'Rx';
      $rows2['data'][] = $frx;
	  
      
  }else{
		echo "<font color='#ff0000'>Connection Failed!!</font>";
  }
  
  $API->disconnect();

	$result = array();

	array_push($result,$rows);
	array_push($result,$rows2);
  print json_encode($result);

?>
