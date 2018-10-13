<?php

$route = $_SERVER['REQUEST_URI'] !== '/' ? $_SERVER['REQUEST_URI'] : 'home';
$routeParts = array_filter(explode('/', $route));
if (count($routeParts) < 2) {
	$routeParts[] = 'index';
}
$route = implode('/', $routeParts);

$method = $_SERVER['REQUEST_METHOD'] === 'GET' ? 'get' : 'post';

$file = path('app/' . $method . '/' . $route . '.php');
if (file_exists($file)) {
	if ($method === 'get') {
		ob_start();
		require_once($file);
		$page = ob_get_clean();
		echo print_with_template($page);
	} else {
		$r = require_once($file);
		$r = empty($r) ? '/home/index' : $r;
		redirect($r);
	}
} else {
	abort(404, 'File Not Found');
}
