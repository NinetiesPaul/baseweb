<?php

use Pecee\SimpleRouter\SimpleRouter;

include 'vendor/autoload.php';

require_once 'helpers.php';
require_once 'routes/web.php';
require_once 'routes/api.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

SimpleRouter::setDefaultNamespace('Controllers');
SimpleRouter::start();