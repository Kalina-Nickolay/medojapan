<?php
	$error_report='';
	/*
	 * Подключение к базе данных
	 */
	$host = 'localhost';
    $db   = 'MED';
    $user = 'root';
    $pass = '';
    $charset = 'utf8';
	
    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    $opt = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
        PDO::MYSQL_ATTR_FOUND_ROWS => true,
    ];
   
	
	try {
        $db = new PDO($dsn, $user, $pass, $opt);
        } 
		catch (PDOException $e) {
            die(getError($e->getMessage()));
        }
	
           
?>
