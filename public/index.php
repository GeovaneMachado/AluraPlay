<?php

declare(strict_types=1);

use Alura\Mvc\Controller\{
    Controller as ControllerInterface,
    VideoFormController,
    VideoListController,
    DeleteVideoController,
    EditVideoController,
    Error404Controller,
    NewVideoController
};
use Alura\Mvc\Repository\VideoRepository;

require_once __DIR__ . '/../vendor/autoload.php';
$routes = require __DIR__ . '/../config/routes.php';

$pdo = new PDO('mysql:host=localhost;dbname=aluraplay', 'root', 'root');
$videoRepository = new VideoRepository($pdo);
$pathInfo = $_SERVER['PATH_INFO'] ?? '/';
$httpMethod = $_SERVER['REQUEST_METHOD'] ?? 'GET';
$controllerClass = $routes[$httpMethod][$pathInfo] ?? null;
if ($controllerClass === null) {
    $controllerClass = Error404Controller::class;
}

$controller = new $controllerClass($videoRepository);
$controller->processaRequisicao();