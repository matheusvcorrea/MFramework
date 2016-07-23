<?php
require_once __DIR__.'/vendor/autoload.php';

use Zend\Http\PhpEnvironment\Request;
use Zend\Http\PhpEnvironment\Response;

$request  = new Request();
$response = new Response();
// $request->getQuery()->set('name', 'Fabien'); // Set GET value

$input = $request->getQuery('name', 'World');

$response->setContent(sprintf('Hello %s', htmlspecialchars($input, ENT_QUOTES, 'UTF-8')));

$response->send();

/**
// Front Controller whith Zend Componets
<?php
require_once __DIR__.'/../vendor/autoload.php';

use Zend\Http\PhpEnvironment\Request;
use Zend\Http\PhpEnvironment\Response;

$request = new Request();

$map = array(
    '/hello' => 'hello',
    '/bye'   => 'bye',
);

$path = $request->getRequestUri();
if (isset($map[$path])) {
    ob_start();
    extract($request->getQuery()->set('name'), EXTR_SKIP);
    include sprintf(__DIR__.'/../src/pages/%s.php', $map[$path]);
    $response = new Response();
    $response->setContent(ob_get_clean());
} else {
    $response = new Response();
    $response->setContent('Not Found');
    $response->setStatusCode(404);
}

$response->send();
*/
