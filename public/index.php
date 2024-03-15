<?php 

require_once __DIR__ . "/../vendor/autoload.php";


// Load environment variables
$dotenv = Dotenv\Dotenv::createImmutable("../app/");
$dotenv->load();

// Now you can access environment variables like this:
$dbHost = $_ENV['DB_HOST'];
$dbUser = $_ENV['DB_USER'];
$dbPass = $_ENV['DB_PASS'];

echo $dbHost;