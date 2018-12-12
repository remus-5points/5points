<?php
require_once('config.php');

error_reporting(E_ALL);
ini_set('display_errors', 'on');

session_start();

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

$pdo = new PDO($dsn, $user, $pass, $options);

function translate($key)
{
    global $translations;
    $language = isset($_SESSION['language']) ? $_SESSION['language'] : 'en';
    if (isset($translations[$language][$key])) {
        return $translations[$language][$key];
    }
    return $key;
}

function initCart() {
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }
}
