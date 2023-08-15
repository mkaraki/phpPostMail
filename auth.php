<?php
if (!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW'])) {
    header('WWW-Authenticate: Basic realm="Realm"');
    header('HTTP/1.0 401 Unauthorized');
    die('Unauthorized access');
}

$expld_user = explode('?', $_SERVER['PHP_AUTH_USER']);
$servUser = urlencode($expld_user[0]);
$rawUser = $expld_user[0];
$userDom = explode('@', $rawUser)[1];
$servServ = $expld_user[1];
$servPass = urlencode($_SERVER['PHP_AUTH_PW']);

require_once __DIR__ . '/_keys.php';

if (!isset(SECKEY[$userDom])) {
    header('WWW-Authenticate: Basic realm="Realm"');
    header('HTTP/1.0 401 Unauthorized');
    die('Unauthorized access');
}
