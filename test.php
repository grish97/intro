<?php

$super = [];
$user = "1";

function super_set($key, $value) {
	global $super;
	if (is_array($value) || is_object($value)) {
		$value = json_encode($value);
	}
	$super[$key] = $value;
}

function super_get($key) {
	global $super;
	$value = !empty($super[$key]) ? $super[$key] : null;
	if (json_decode($value)) {
		$value = json_decode($value, true);
	}
	return $value;
}

function super_flush($key, $value)
{
	global $super;
	if (is_array($value) || is_object($value)) {
		$value = json_encode($value);
	}
	$flush = super_get('flush') ? super_get('flush') : [];
	$flush[$key] = $value;
	super_set('flush', $flush);
}

super_set('name', 'John');
super_set('last_name', 'Doe');
super_set('data', ['age' => 25]);
super_flush('message', 'Your action was successfull');
super_flush('error', 'Something went wrong');
super_flush('error', 'Whoops');

var_dump($super);

// super_set('name', 'Jack');
// super_set('data', ['asd' => 'asdas']);
// $a = super_get('name');
// $b = super_get('data');
// var_dump($a, $b);
// $name = !empty($super['name']) ? $super['name'] : null;
// if (json_decode($name)) {
// 	$name = json_decode($name, true);
// }

unset($super['flush']);