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
 
use Pimple\Container;
use Pimple\Psr11\Container as PsrContainer;
use Pllano\Adapters\Template\TemplateEngine as Template;
 
$container = new Container();
 
// config container
$container['config'] = $config;
 
// package container
$container['package'] = $package;
 
// monolog container
$container['logger'] = function ($c) {
    $settings = $c['config']['settings']['logger'];
    $logger = new \Monolog\Logger($settings['name']);
    $logger->pushProcessor(new \Monolog\Processor\UidProcessor());
    $logger->pushHandler(new \Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
    return $logger;
    
};
 
$container['view'] = function ($c) {
    // template name
    $template = $c['config']['template']['front_end']['themes']['template'];
    // Register Pllano\Adapters\Template\TemplateEngine
    return new Template($c['config'], $c['package']['require'], $template);
};
 
$core = new PsrContainer($container);
// We register containers in Slim
$app->setContainer($core);
 