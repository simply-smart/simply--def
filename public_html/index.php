<?php

// Załadowanie autoloadera, aby móc korzystać z przestrzeni nazw i klas
require __DIR__.'/../vendor/autoload.php';

use Dotenv\Dotenv;
$dotenv = Dotenv::createImmutable(__DIR__.'/../');
$dotenv->load();

echo '<pre>';
var_dump($_ENV);
echo '</pre>';

use SimplySmart\Simply\Config\DatabaseConfig;
use SimplySmart\Simply\Facades\DatabaseFacade;
use SimplySmart\Simply\Controllers\DatabaseController;
use SimplySmart\Simply\Controllers\PDOController;

$dbConfig = DatabaseConfig::fromConfigName('DEFAULT');
DatabaseFacade::init($dbConfig);

$dbController = new DatabaseController();
$pdoController = new PDOController();

// Przekazanie połączenia PDO do PDOController
$dbController->provideConnection($pdoController, $dbConfig);

echo '<pre>';
var_dump($pdoController);
echo '</pre>';