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

namespace App\Controllers;

use Psr\Http\Message\{ServerRequestInterface as Request, ResponseInterface as Response};
use Pllano\Caching\Cache;

class ControllerRouter
{
    
    private $config = [];
    private $package = [];
    protected $logger;
    protected $view;
    
    function __construct($config, $package, $view, $logger)
    {
        $this->config = $config;
        $this->package = $package;
        $this->logger = $logger;
        $this->view = $view;
    }
    
    public function get(Request $request, Response $response, array $args)
    {
        
        $host = $request->getUri()->getHost();
        $path = '';
        if($request->getUri()->getPath() != '/') {
            $path = $request->getUri()->getPath();
        }
        $params = '';
        // getQuery
        $params_query = str_replace('q=/', '', $request->getUri()->getQuery());
        if ($params_query) {
            $params = '/'.$params_query;
        }
        
        $getParams = $request->getQueryParams();
        // $getQuery = $request->getUri()->getQuery();
        
        // $getParsedBody = $request->getParsedBody();
        // $getParams = $request->getQueryParams();
        // $getScheme = $request->getUri()->getScheme();
        // $getHost = $request->getUri()->getHost();
        // $getPath = $request->getUri()->getPath();
        // $getMethod = $request->getMethod();
		
		$data = [];

        $h2 = $request->getAttribute('route') ?? '«Hello, world!»';

        // Models Directory /vendor/app/Models/
        // AutoRequire\Autoloader - Automatically registers a namespace in /vendor/app/
        
        $lang = 'en';
        // $language = new \App\Models\ModelLanguage();
        // $lang = $language->get();
 
        // $route = ucfirst($request->getAttribute('route')) ?? 'Error';
        // $model = new \App\Models\Model'.$route($this->config, $this->package, $this->logger);
        // or
        // $model = new \App\Models\ModelStart($this->config, $this->package, $this->logger);
        
        // $data = $model->get($request, $response, $args);
        
        // Caching
        $cache = new Cache($this->config);
        
        if ($cache->run($host.''.$params.'/'.$lang) === null) {
 
            $data = [
                "h1" => "Slim 4 Skeleton",
                "h2" => "Slim + {$h2}",
                "title" => "Slim 4 Skeleton",
                "description" => "a microframework for PHP",
                "robots" => "index, follow",
                "render" => "index.phtml"
            ];
			$data['h3'] = $request->getAttribute('resource') ?? null;
            $data['id'] = $request->getAttribute('id') ?? null;
            
            if ((int)$cache->state() == 1) {
                $cache->set($data);
            }
        } else {
            $data = $cache->get();
        }
        
        // Render view
        $render = $data['render'] ?? 'index.phtml';
        
        return $this->view->render($render, $data);
        
    }

    public function runApi(Request $request, Response $response, array $args)
    {
		$function = strtolower($request->getMethod());

		$callback = [];

        // Models Directory /vendor/app/models/
        // AutoRequire\Autoloader - Automatically registers a namespace \App in /vendor/app/
        $model = new \App\Models\ModelApi($this->config, $this->package, $this->logger);
        $callback = $model->$function($request, $response, $args);
 
        $callbackCode = $callback['code'] ?? 200;
		$response->withStatus($callbackCode);
        $response->withHeader('Content-type', 'application/json');
        return json_encode($callback, JSON_PRETTY_PRINT);

    }

    public function post(Request $request, Response $response, array $args)
    {
        $getParsedBody = $request->getParsedBody();
        
        // Models Directory /vendor/app/models/
        // AutoRequire\Autoloader - Automatically registers a namespace in /vendor/app/
        // $model = new \App\Models\ModelName();
        // $callback = $model->post();
        
        $responseCode = 200;
        $callbackTitle = 'Callback Title';
        $callbackMessage = 'Callback Message';
        
        $callback = [
            'code' => $responseCode,
            'title' => $callbackTitle,
            'message' => $callbackMessage
        ];
        
        $response->withStatus($responseCode);
        $response->withHeader('Content-type', 'application/json');
        return json_encode($callback, JSON_PRETTY_PRINT);
        
    }
    
    public function put(Request $request, Response $response, array $args)
    {
        
    }
    
    public function delete(Request $request, Response $response, array $args)
    {
        
    }
    
}
