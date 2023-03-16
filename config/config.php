<?php
const HOST = "127.0.0.1";
const DBNAME = "sms";
const PORT = 3306;
const USER = "root";
const PASSWORD = "";
const OPTIONS = [
	PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
	PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
];
const DSN = "mysql:host=" . HOST . ";dbname=" . DBNAME . ";port=" . PORT;
