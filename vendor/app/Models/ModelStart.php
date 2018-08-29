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

use Psr\Http\Message\{ServerRequestInterface as Request, ResponseInterface as Response};

class ModelStart
{
    
    function __construct($config, $package, $logger)
    {
        $this->config = $config;
        $this->package = $package;
        $this->logger = $logger;
    }
    
    public function get(Request $request, Response $response, array $args)
    {

        $h2 = $request->getAttribute('route') ?? '«Hello, world!»';
        $data = [
                "h1" => "Slim 4 Skeleton",
                "h2" => "Slim + {$h2} + ModelStart",
                "title" => "Slim 4 Skeleton",
                "description" => "a microframework for PHP",
                "robots" => "index, follow",
                "render" => "index.html",
                "caching" => $this->config['cache']['driver'],
				"caching_state" => $this->config['cache']['state'],
				"cache_lifetime" => $this->config['cache']['cache_lifetime']
        ];
 
        return $data;
    }

}
 