<?php
/**
 * Created by PhpStorm.
 * Date: 2017-02-05
 * Time: 02:42
 */

namespace app\controllers;

use app\components\BaseController;
use app\components\Form\FormHelper;
use app\models\Form;

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
        $form = new Form();

        if ($form->load($_POST['Form'] ?? []) && $form->save()) {
            $this->redirect('/');
        }

        return $this->render('create', [
            'form' => $form
        ]);
    }

    public function actionUpdate(): string
    {
        $form = Form::find($_GET['id'] ?? null);

        if (!$form) {
            exit('Page not found.');
        }

        if ($form->load($_POST['Form'] ?? []) && $form->save()) {
            $this->redirect('/');
        }

        return $this->render('update', [
            'form' => $form
        ]);
    }

    /**
     * Delete model
     *
     */
    public function actionDelete()
    {
        $form = Form::find($_GET['id'] ?? null);

        if (!$form) {
            exit('Page not found.');
        }

        $form->delete();

        $this->redirect('/');
    }

    /**
     * Get field.
     * Used in ajax request
     *
     * @return string
     */
    public function actionField(): string
    {
        return FormHelper::getField($_POST['type'] ?? '', 'Sample name', null, [], true);
    }

    /**
     * Get field properties
     *
     * @return string
     */
    public function actionFieldProperties(): string
    {
        return FormHelper::getProperties($_POST['id'] ?? null,$_POST['type'] ?? '', $_POST['html'] ?? '');
    }
}