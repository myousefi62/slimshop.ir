<?php
if (PHP_SAPI == 'cli-server') {
    // To help the built-in PHP dev server, check if the request was actually for
    // something which should probably be served as a static file
    $url  = parse_url($_SERVER['REQUEST_URI']);
    $file = __DIR__ . $url['path'];
    if (is_file($file)) {
        return false;
    }
}

require __DIR__ . '/vendor/autoload.php';

session_start();

// Instantiate the app
$settings = require __DIR__ . '/App/settings.php';
$app = new \Slim\App($settings);

// Set up dependencies
require __DIR__ . '/App/dependencies.php';

// Register middleware
require __DIR__ . '/App/middleware.php';
// Register Functions
require __DIR__ . '/App/Lib/Function.php';
// Register routes
require __DIR__ . '/App/routes.php';

// Run app
$app->run();
