<?php

require dirname(__DIR__).DIRECTORY_SEPARATOR.'vendor'.DIRECTORY_SEPARATOR.'autoload.php';

$app = new \Task\App();
// Read, Parse and Trigger Solution function call
$app->parse($app->read())->solution();
