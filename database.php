<?php
$server = 'localhost';
$username = 'root';//'milicrak';
$password = '';//'529w-GHGi+Xe2j';
$database = 'milicdb';//'milicrak_milicdb';

try{
	$conn = new PDO("mysql:host=$server;dbname=$database;", $username, $password);
} catch(PDOException $e){
	die( "Connection failed: " . $e->getMessage());
}
