<?php

session_start([
    'cookie_lifetime' => 86400,
]);

$_SESSION['previous_url'] = isset($_SESSION['current_url']) ? $_SESSION['current_url'] : null;

if (!preg_match('/^\/(css|js|img|fonts)/', $_SERVER['REQUEST_URI'])) {
    $_SESSION['current_url'] = $_SERVER['REQUEST_URI'];
}
