<?php

$validation = validate($_POST, [
	'first_name' => 'required|max:25|min:3',
	'last_name' => 'required|max:25|min:3',
	'email' => 'required|unique:users,email|max:50|min:7|email',
	'password' => 'required|max:30|min:6|confirmed',
	'phone' => 'required|phone',
]);

$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$email = $_POST['email'];
$username = strtolower($first_name . '.' . $last_name);
$password = $_POST['password'];

insert('users', [
	'first_name' => $first_name,
	'last_name' => $last_name,
	'email' => $email,
	'username' => $username,
	'password' => $password,
]);

return '/home/index';