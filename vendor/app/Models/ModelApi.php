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

namespace App\Models;

use Psr\Http\Message\{
    ServerRequestInterface as Request, 
    ResponseInterface as Response
};
use Pllano\Caching\Cache;

class ModelApi
{

    private $config = [];
    private $package = [];
    protected $logger;

    function __construct($config = [], $package = [], $logger)
    {
        $this->config = $config;
        $this->package = $package;
        $this->logger = $logger;
    }

    public function get(Request $request, Response $response, array $args): array
    {
        $getParams = $request->getQueryParams();
        $getMethod = $request->getMethod();
        $resource = $request->getAttribute('resource') ?? '';
        $id = $request->getAttribute('id') ?? '';

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
 
        $callback = [];
        $lang = 'en';
        
        // ....... Your code ....... //

        // Caching
        $cache = new Cache($this->config);

        if ($cache->run($host.'/'.$path.'/'.$params.'/'.$lang) === null) {

            $responseCode = 200;

            // ....... Your code ....... //

            $callback = [
                'responseCode' => $responseCode,
                'resource' => $resource,
                'id' => $id,
                'getParams' => $getParams,
                'getMethod' => $getMethod,
                "caching" => $this->config['cache']['driver'],
				"caching_state" => $this->config['cache']['state'],
				"cache_lifetime" => $this->config['cache']['cache_lifetime']
            ];
			if (isset($getParams['config'])) {
				$callback['config'] = $this->config;
			}
			if (isset($getParams['package'])) {
				$callback['package'] = $this->package;
			}
            
            $this->logger->info("ModelApi function get - responseCode: {$responseCode} - resource: {$resource}  - id: {$id}");

            if ((int)$cache->state() == 1) {
                $cache->set($callback);
            }
        } else {
            $callback = $cache->get();
        }
 
        return $callback;
    }
	
}
 