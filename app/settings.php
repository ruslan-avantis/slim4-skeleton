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

namespace App;

class Settings
{

    public static function get()
	{

        $config = [];
        // settings.json
        $settings =  __DIR__ .'/settings.json';
        $json = '';

        if (file_exists($settings)) {
            $json = json_decode(file_get_contents($settings), true);
            if (isset($json)) {
                $config = $config + $json;
            }
        }

		$config["dir"]["www"] = __DIR__ .'/..';
		$config["settings"]["json"] = $settings;
		$config["settings"]["cache"] =  __DIR__ . "/../_cache/";

        // Папка куда будут писатся логи Monolog
        $config["settings"]["logger"]["path"] = isset($_ENV['docker']) ? 'php://stdout' : __DIR__ . '/../logs/app.log';
        $config["settings"]["logger"]["name"] = "slim-app";
        $config["settings"]["logger"]["level"] = \Monolog\Logger::DEBUG;

        // Папка с шаблонами
        $config['template']['front_end']['themes']['dir'] = __DIR__ .''.$json['template']['front_end']['themes']['dir_name'];

        // Определяем протокол
        $config["server"]["scheme"] = 'http';
        if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') {
            $config["server"]["scheme"] = 'https';
        }

        return $config;

    }

}
 