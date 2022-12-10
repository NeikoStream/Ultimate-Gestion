<?php
$db_username = 'u161682765_ultimatebd';
$db_password = '7>vEV#s9t';
$db_name = 'u161682765_ultimate';
$db_host = '153.92.220.151:3306';

try {
    $linkpdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_username, $db_password);
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}
?>