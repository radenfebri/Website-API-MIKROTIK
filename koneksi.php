<?php

require('routeros_api.class.php');

$API = new RouterosAPI();

if ($API->connect('host-mikrotik', 'user-mikrotik', 'password-mikrotik')) {

}

