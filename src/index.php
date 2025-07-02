<?php

// Aktifkan error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('log_errors', 1);

// Tetapkan lokasi error log (pastikan direktori src memiliki izin tulis)
ini_set('error_log', __DIR__ . '/php_errors.log');

session_start();

// Load dependencies dengan path yang benar
require_once __DIR__ . '/core/Autoload.php';  // Perbaikan path
require_once __DIR__ . '/config/default.php'; // Perbaikan path

$routes = new Routes();
$routes->run();

// if (!session_id()) session_start();