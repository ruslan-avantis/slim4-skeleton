<?php /**
    * This file is part of the {Slim-4}$keleton
    *
    * @license http://opensource.org/licenses/MIT
    * @link https://github.com/pllano/Slim-4-Skeleton
    * @version 1.0.1
    * @package pllano.slim4-skeleton
    *
    * For the full copyright and license information, please view the LICENSE
    * file that was distributed with this source code.
*/
 
// Routes
$app->get('/', function ($request, $response, $args)
{
    $view = $this->get('view'); 
 
    // Sample log message
    $this->get('logger')->info("Slim-4-Skeleton '/' home route");
 
    $data = [
        "h1" => "Slim 4 Skeleton",
        "title" => "Slim 4 Skeleton",
        "description" => "a microframework for PHP",
        "robots" => "index, follow"
    ];
 
    // Render index view
    $render = 'index.phtml';
    return $response->write($view->render($render, $data));
 
});
 
/*
    /api[/{alias:[a-z0-9_-]+}]
    /{alias:[a-z0-9_]+}/[/{name:[a-z0-9_-]+}].html
    /{service:[\w]+}[/{resource:[\w]+}[/{id:[\w]+}]]
	/{route:[a-z0-9_-]+}[/{resource:[\w]+}[/{id:[\w]+}]]
*/
$app->get('/{route:[a-z0-9_-]+}[/[{resource:[\w]+}[/{id:[0-9]+}]]]', function ($request, $response, $args)
{
    // $getScheme = $request->getUri()->getScheme();
    // $getParams = $request->getQueryParams();
    // $getQuery = $request->getUri()->getQuery();
    // $getHost = $request->getUri()->getHost();
    // $getPath = $request->getUri()->getPath();
    // $getMethod = $request->getMethod();
    // $getParsedBody = $request->getParsedBody();
 
    // Controllers Directory /vendor/app/Controllers/
	// AutoRequire\Autoloader - Automatically registers a namespace in /vendor/app/
	
	// $route = ucfirst($request->getAttribute('route')) ?? 'Error';
    // $controller = '\App\Controllers\Controller'.$route;
    // $controller = $this->get('config')['vendor']['controllers']['router'];
 
    $controller = '\App\Controllers\ControllerRouter';
    // $function = 'run';
    $function = strtolower($request->getMethod());
 
    $class = new $controller($this->get('config'), $this->get('package'), $this->get('view'), $this->get('logger'));
    return $response->write($class->$function($request, $response, $args));
 
});
 