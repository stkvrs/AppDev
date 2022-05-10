<?php

if (extension_loaded("mongodb")) {
    require_once __DIR__ . '/vendor/autoload.php';
    if (file_exists(__DIR__ . '/.env')) {
        $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
        $dotenv->load();
    }

    // require_once __DIR__ . '/vendor/autoload.php';

    // $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    // $dotenv->load();

    // $manager = new MongoDB\Driver\Manager($_ENV["MONGO_URI"]);
    // $db = (new MongoDB\Client)->{$_ENV["DB_NAME"]};

    $db = (new MongoDB\Client($_ENV['MONGO_URI']))->{$_ENV['DB_NAME']};

    $collection = $db->users;
}
?>