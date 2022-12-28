<?php

declare(strict_types=1);

define('PROJECT_BASE_PATH', __DIR__ . '/..');
define('TEST_BASE_PATH', __DIR__);
define('TEST_FIXTURE_PATH', __DIR__ . DIRECTORY_SEPARATOR . 'fixtures');

require dirname(__DIR__) . '/vendor/autoload.php';

if (file_exists(TEST_BASE_PATH . DIRECTORY_SEPARATOR . '.env')) {
    $env = new Dotenv\Dotenv(TEST_BASE_PATH);
    $env->load();
}
