<?php
/**
 * Created by PhpStorm.
 * Date: 2017-02-05
 * Time: 02:42
 */

namespace app\controllers;

use app\components\BaseController;
use app\components\FormHelper;

/**
 * Class FormsController
 * @package app\controllers
 */
class FormsController extends BaseController
{
    /**
     * Create form
     *
     * @return string
     */
    public function actionCreate(): string
    {
        return $this->render('create');
    }

    /**
     * Get field.
     * Used in ajax request
     *
     * @return string
     */
    public function actionField(): string
    {
        $type = $_POST['type'];

        $field = FormHelper::getField($type, 'Sample name');

        return $field;
    }
}