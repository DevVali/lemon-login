<?php

include __DIR__."/vendor/autoload.php";

use Lemon\Kernel\Application;
use Lemon\Protection\Middlwares\Csrf;

$application = new Application(__DIR__);

$application->loadServices();

$application->loadZests();

$application->loadHandler();

/** @var \Lemon\Routing\Router $router */
$router = $application->get("routing");

$router->file("routes.web")
    ->middleware(Csrf::class)
;

config("debug.debug", true);

return $application;
