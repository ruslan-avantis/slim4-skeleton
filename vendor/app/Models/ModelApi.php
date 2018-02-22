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

class ModelApi
{

    function __construct($config, $package, $logger)
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

		// ..............

		$responseCode = 200;
		$callback = [
            'responseCode' => $responseCode,
            'resource' => $resource,
            'id' => $id,
			'getParams' => $getParams,
			'getMethod' => $getMethod
        ];

		return $callback;
    }

}
 