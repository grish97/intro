<?php

define('BASE_PATH', dirname(__FILE__));

function path($path)
{
	return BASE_PATH . preg_replace("/[\\/]/", DIRECTORY_SEPARATOR, '/' . $path);
}

require_once(path('core/functions.php'));
require_once(path('core/connect.php'));
require_once(path('core/session.php'));

define('APP_PATH', path('app'));

require_once(path('core/router.php'));

unset($_SESSION['flush']);