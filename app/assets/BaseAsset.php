<?php
/**
 * Created by PhpStorm.
 * Date: 2017-02-05
 * Time: 01:20
 */

namespace app\assets;

use app\components\BaseController;

/**
 * Class BaseAsset
 * @package app\assets
 */
class BaseAsset
{
    /**
     * Register assets files
     *
     * @param BaseController $view
     */
    public static function register(BaseController $view)
    {
        // Common assets (include on page)
        $view->requireVendorFile('twbs/bootstrap/dist/css/bootstrap.css');
        $view->requireVendorFile('/css/template.css');
        $view->requireVendorFile('/css/site.css');

        $view->requireVendorFile('/js/jquery.js');
        $view->requireVendorFile('twbs/bootstrap/dist/js/bootstrap.min.js');

        // Other assets
        $view->requireVendorFile('twbs/bootstrap/dist/css/bootstrap.css.map');
        $view->requireVendorDir('twbs/bootstrap/dist/fonts');
    }
}