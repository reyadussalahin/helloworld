<?php

require __DIR__ . "/../vendor/autoload.php";


$app = new \HelloWorld\App(
    dirname(__DIR__)
);

$response = $app->processRequest(
    new \HelloWorld\Router\Router()
);

$response->send();