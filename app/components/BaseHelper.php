<?php
/**
 * Created by PhpStorm.
 * Date: 2017-02-05
 * Time: 01:58
 */

namespace app\components;

/**
 * Class BaseHelper
 * @package app\components
 */
class BaseHelper
{
    /**
     * Normalize directory separtor in path
     *
     * @param string $path
     * @return string
     */
    public static function normalizeDirSepartor(string $path): string
    {
        return str_replace(['\\', '/'], DIRECTORY_SEPARATOR, $path);
    }
}