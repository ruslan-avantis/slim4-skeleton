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

declare(strict_types = 1);

if (PHP_SAPI == 'cli-server') {
    // To help the built-in PHP dev server, check if the request was actually for
    // something which should probably be served as a static file
    $url  = parse_url($_SERVER['REQUEST_URI']);
    $file = __DIR__ . $url['path'];
    if (is_file($file)) {
        return false;
    }
}

session_start();

define("BASE_PATH", dirname(__FILE__));

$vendor_dir = '';
// Looking for the path to the vendor folder
if (file_exists(BASE_PATH . '/vendor')) {
    $vendor_dir = BASE_PATH . '/vendor';
} elseif (BASE_PATH . '/../vendor') {
    $vendor_dir = BASE_PATH . '/../vendor';
}

// Specify the path to the file AutoRequire
$autoRequire = $vendor_dir.'/AutoRequire.php';
// Specify the path to the file auto_require.json
$auto_require = $vendor_dir.'/auto_require.json';

if (file_exists($autoRequire) && file_exists($auto_require)) {

    // Connect \Pllano\AutoRequire\Autoloader
    require $autoRequire;
    // instantiate the loader
    $require = new \Pllano\AutoRequire\Autoloader();
    // Start AutoRequire\Autoloader
    $require->run($vendor_dir, $auto_require);

    // Instantiate the core app
    require BASE_PATH . '/core/settings.php';
    $config = \App\Settings::get();

    // We get the list and configuration of packages
    $package = json_decode(file_get_contents($auto_require), true);
    $slimSettings = $package['require']['slim.slim']['settings'];

    // Default Settings
    $settings = [];
    $settings['debug'] = true;
    $settings['displayErrorDetails'] = true; // set to false in production
    $settings['addContentLengthHeader'] = false; // Allow the web server to send the content-length header

    if (isset($slimSettings)) {
        foreach($slimSettings as $key => $val)
        {
            if((int)$val == 1){
                $settings[$key] = true;
            } elseif((int)$val == 0) {
                $settings[$key] = false;
            } else {
                $settings[$key] = $val;
            }
        }
    }

    // Connect Slim
    $app = new \Slim\App($settings);

    // Set up dependencies
    require BASE_PATH . '/core/dependencies.php';

    // Register middleware
	require BASE_PATH . '/core/middleware.php';

    // Register routes
	require BASE_PATH . '/core/routes.php';

    $app->run();

}
 