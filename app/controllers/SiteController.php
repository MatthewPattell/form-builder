<?php
/**
 * Created by PhpStorm.
 * Date: 2017-02-04
 * Time: 13:55
 */

namespace app\controllers;

use app\components\BaseController;
use app\models\Form;

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
        $models = Form::getModels();

        return $this->render('index', [
            'models' => $models
        ]);
    }
}