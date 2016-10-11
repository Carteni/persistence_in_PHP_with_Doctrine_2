<?php

use Symfony\Component\HttpFoundation\Request;

$env = getenv('APP_ENV') ?? 'prod';
$debug = (bool) getenv('APP_DEBUG') ?? 'false';

/**
 * @var Composer\Autoload\ClassLoader
 */
$loader = require __DIR__.'/../app/autoload.php';
if ($debug) {
    \Symfony\Component\Debug\Debug::enable();
}

if (!$debug) {
    include_once __DIR__.'/../var/bootstrap.php.cache';
}

//$kernel = new AppKernel('prod', false);
$kernel = new AppKernel($env, $debug);
if (!$debug) {
    $kernel->loadClassCache();
}
//$kernel = new AppCache($kernel);

// When using the HttpCache, you need to call the method in your front controller instead of relying on the configuration parameter
//Request::enableHttpMethodParameterOverride();
$request = Request::createFromGlobals();
$response = $kernel->handle($request);
$response->send();
$kernel->terminate($request, $response);
