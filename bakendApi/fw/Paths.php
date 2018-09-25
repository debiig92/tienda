<?php
$protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"], 0, strpos($_SERVER["SERVER_PROTOCOL"], '/')));
$protocol = $_SERVER['HTTPS'] ? 'https' : $protocol;
$hostname = $_SERVER["HTTP_HOST"];

define(PROJECT, $protocol . '://' . $hostname . '/');

define('HOST', 'localhost');
define('DBNAME', 'id5717515_apidb');
define('USERNAME', 'id5717515_apidb');
define('PASSWORD', 'apiDB');