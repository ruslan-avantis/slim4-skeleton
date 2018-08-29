<?php /**
    * This file is part of the {API}$hop
    *
    * @license http://opensource.org/licenses/MIT
    * @link https://github.com/pllano/api-shop
    * @version 1.1.1
    * @package pllano.api-shop
    *
    * For the full copyright and license information, please view the LICENSE
    * file that was distributed with this source code.
*/

function routingConfig($routingSettings)
{
    $routingConfig = [];
	if (isset($routingSettings)) {
        foreach($routingSettings as $key => $val)
        {
            if((int)$val == 1){
                $routingConfig[$key] = true;
            } elseif((int)$val == 0) {
                $routingConfig[$key] = false;
            } else {
                $routingConfig[$key] = $val;
            }
        }
    }
	return $routingConfig;
}

function microtime_float()
{
    list($usec, $sec)=explode(" ", microtime());
    return ((float)$usec+(float)$sec);
}

function get_ip()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip=$_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip=$_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

function escaped_url()
{
    $uri = $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    return htmlspecialchars($uri, ENT_QUOTES, 'UTF-8');
}
 