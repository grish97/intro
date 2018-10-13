<?php

$database_connection = mysqli_connect('127.0.0.1', 'root', '', 'product');

if (!$database_connection) {
	abort(500, 'Invalid configurations');
}