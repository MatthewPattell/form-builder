<?php
/**
 * Created by PhpStorm.
 * Date: 2017-02-04
 * Time: 13:38
 */

define('ROOT_DIR', dirname(__DIR__.'../'));
$vendor_path = dirname(ROOT_DIR.'../'). DIRECTORY_SEPARATOR . 'vendor/';
define('VENDOR_DIR', $vendor_path);

require(__DIR__ . '/../../vendor/autoload.php');

/**
 * Simple autoloader :)
 */
spl_autoload_register(function ($className)
{
    $className = implode(DIRECTORY_SEPARATOR, explode('\\', $className));
    $classFile = dirname(ROOT_DIR.'../').DIRECTORY_SEPARATOR.$className.'.php';

    if (file_exists($classFile)) {
        include($classFile);
    }

    if (!class_exists($className, false) && !interface_exists($className, false) && !trait_exists($className, false)) {
        exit("Unable to find '$className' in file: $classFile. Namespace missing?");
    }
}, true, true);

app\components\Router::run();