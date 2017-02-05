<?php
/**
 * Created by PhpStorm.
 * Date: 2017-02-04
 * Time: 13:55
 */

namespace app\controllers;

use app\components\BaseController;

/**
 * Class SiteController
 * @package app\controllers
 */
class SiteController extends BaseController
{
    /**
     * Home page
     */
    public function actionIndex(): string
    {
        return $this->render('index');
    }
}