<?php
require_once __DIR__.'/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing;
use Symfony\Component\HttpKernel;
use Zend\Debug\Debug;

function render_template(Request $request)
{
    extract($request->attributes->all(), EXTR_SKIP);
    ob_start();
    include sprintf(__DIR__.'/../src/pages/%s.php', $_route);

    return new Response(ob_get_clean());
}

$request = Request::createFromGlobals();
$routes = include __DIR__.'/../src/app.php';

$context = new Routing\RequestContext();

/**
 * Com base nas informações armazenadas na instância RouteCollection, uma instância
 * UrlMatcher pode buscar os caminhos URL correspondentes:
 */
$matcher = new Routing\Matcher\UrlMatcher($routes, $context);

/** 
 * O trecho a baixo cria a instancia ControllerResolver que é capaz de associar
 * uma classe e seus argumentos correspondentes uma riquesicao. É importante que
 * os nomes da clase e dos argumentos sejam iguais e na rota.
 */
$resolver = new HttpKernel\Controller\ControllerResolver();

$framework = new Simplex\Framework($matcher, $resolver);
$response = $framework->handle($request);

$response->send();