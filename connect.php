<?php 

	// error_reporting(0);

	$usuario = 'casaforte2';
	$senha = 'Senti@nela2021';
	$database = 'casaforte2';
	$host = 'casaforte2.mysql.dbaas.com.br';


	$mysqli = new mysqli($host, $usuario, $senha, $database);

	$mysqli->set_charset("utf8");

	if($mysqli->error){
		
		die('Falha ao conectar ao banco de dados');
		
	}

?>