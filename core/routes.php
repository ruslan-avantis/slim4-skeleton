<?php /**
    * This file is part of the {Slim-4}$keleton
    *
    * @license http://opensource.org/licenses/MIT
    * @link https://github.com/pllano/slim4-skeleton
    * @version 1.0.1
    * @package pllano.slim4-skeleton
    *
    * For the full copyright and license information, please view the LICENSE
    * file that was distributed with this source code.
*/
 
// Routes
// $route_home = $config['routes']['home']['route'];
$route_home = '/';
// URI https://example.com/
$app->get($route_home, function ($request, $response, $args) use ($core) {

	$view = $core->get('view');
	// Sample log message
	$core->get('logger')->info("Slim-4-Skeleton '/' home route");
	$data = [
            "h1" => "Slim 4 Skeleton",
            "title" => "Slim 4 Skeleton",
            "description" => "a microframework for PHP",
            "robots" => "index, follow"
	];
	$render = $view->render('index.html', $data);
	return $response->write($render);

});

/* // $route_api = $config['routes']['api']['route'];
$route_api = '/api/json[/[{resource:[a-z0-9_-]+}[/{id:[0-9]+}]]]';
// URI https://example.com/api/json/test-1_12/2018
// URI https://example.com/api/json/test-1/2018?param1=12345&param2=67890
$app->get($route_api, function ($request, $response, $args) use ($core) {
    // Controllers Directory /vendor/app/Controllers/
    // AutoRequire\Autoloader - Automatically registers a namespace \App in /vendor/app/

    // $controller = $core->get('config')['vendor']['controllers']['router'];
    // $route = ucfirst($request->getAttribute('route')) ?? 'Error';
    // $controller = '\App\Controllers\Controller'.$route;
	
	$callback = [];
	$callback['code'] = 200;
 
    $controller = '\App\Controllers\ControllerRouter';
    // $function = strtolower($request->getMethod());
    // $function = $core->get('config')['function']['api'];
    $function = 'runApi';
    $class = new $controller($core->get('config'), $core->get('package'), $core->get('view'), $core->get('logger'));
    $callback = $class->$function($request, $response, $args);

    $callbackCode = $callback['code'] ?? 200;

    return $response->withJson($callback, $callbackCode, JSON_PRETTY_PRINT);
    // return $response->withJson($callback, $callbackCode);
    // return $response->write($callback)->withStatus($callbackCode)->withHeader('Content-type', 'application/json');

}); */
 
/*
$route_content = $config['routes']['content']['route'];
or
$route_content = '/{alias:[a-z0-9_]+}/[/{name:[a-z0-9_-]+}].html';
or
$route_content = '/{service:[\w]+}[/{resource:[\w]+}[/{id:[\w]+}]]';
or
$route_content = '/{route:[a-z0-9_-]+}[/{resource:[\w]+}[/{id:[\w]+}]]';
*/
$route_content = '/{route:[a-z0-9_-]+}[/[{resource:[a-z0-9_-]+}[/{id:[0-9]+}]]]';
// URI https://example.com/site/test/2018
// URI https://example.com/site/test-test_test/2018
$app->get($route_content, function ($request, $response, $args) use ($core) {
	// print('hhh');
    // $getScheme = $request->getUri()->getScheme();
    // $getParams = $request->getQueryParams();
    // $getQuery = $request->getUri()->getQuery();
    // $getHost = $request->getUri()->getHost();
    // $getPath = $request->getUri()->getPath();
    // $getMethod = $request->getMethod();
    // $getParsedBody = $request->getParsedBody();
 
    // Controllers Directory /vendor/app/Controllers/
    // AutoRequire\Autoloader - Automatically registers a namespace \App in /vendor/app/

    // $controller = $core->get('config')['vendor']['controllers']['router'];
	
    // $route = ucfirst($request->getAttribute('route')) ?? 'Error';
    // $controller = '\App\Controllers\Controller'.$route;
 
    $controller = '\App\Controllers\ControllerRouter';
	$class = new $controller($core->get('config'), $core->get('package'), $core->get('view'), $core->get('logger'));
	
	if ($request->getAttribute('route') == "api") {
		// https://example.com/api
		// https://example.com/api/json/2018?param1=12345&param2=67890
        $function = 'runApi';
		$class->$function($request, $response, $args);
	} else {
        // https://example.com/test1/test2/12345
	    $function = strtolower($request->getMethod());
        return $response->write($class->$function($request, $response, $args));
	}
 
});
 