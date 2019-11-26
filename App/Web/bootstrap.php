<?php
declare(strict_types=1);

const DEFAULT_APP = 'frontend';

if (!isset($_GET['app']) || !file_exists(__DIR__.'/../App/'.$_GET['app'])) $_GET['app'] = DEFAULT_APP;

require dirname(__DIR__).'/../vendor/autoload.php';

$appClass = 'App\\'.$_GET['app'].'\\'.$_GET['app'].'Application';

$app = new $appClass;
$app->run();