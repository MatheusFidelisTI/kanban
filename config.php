<?php
namespace config;
require 'environment.php';

$config = array();
if(ENVIRONMENT == 'development') {
	define("BASE_URL", "http://localhost/teste_php/");
	$config['dbname'] = 'teste_php';
	$config['host'] = 'localhost:3308';
	$config['dbuser'] = 'root';
	$config['dbpass'] = '';
}

global $db;
try {
	$db = new \PDO("mysql:dbname=".$config['dbname'].";host=".$config['host'], $config['dbuser'], $config['dbpass']);
} catch(\PDOException $e) {
	echo "MSG DE ERRO: ".$e->getMessage();
	exit;
}