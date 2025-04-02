<?php

declare(strict_types=1);

return [
    'GET' => [
        '/' => \Alura\Mvc\Controller\VideoListController::class,
        '/novo-video' => \Alura\Mvc\Controller\VideoFormController::class,
        '/editar-video' => \Alura\Mvc\Controller\VideoFormController::class,
        '/deletar-video' => \Alura\Mvc\Controller\DeleteVideoController::class,
    ],
    'POST' => [
        '/novo-video' => \Alura\Mvc\Controller\NewVideoController::class,
        '/editar-video' => \Alura\Mvc\Controller\EditVideoController::class,
    ],
];