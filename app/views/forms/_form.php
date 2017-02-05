<?php
/**
 * Created by PhpStorm.
 * Date: 2017-02-05
 * Time: 02:44
 */

use app\components\Form\FormHelper;

/**
 * @var $this \app\components\BaseController
 * @var $form \app\models\Form
 */

$this->requireVendorFile('/bower/dragula/dist/dragula.min.css');
$this->requireVendorFile('/bower/dragula/dist/dragula.min.js');
$this->requireVendorFile('/js/forms/create.js');
?>

<? if (!empty($form->getErrors())): ?>
    <? foreach ($form->getErrors() as $error): ?>
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?= $error ?>
        </div>
    <? endforeach; ?>
<? endif; ?>

<div class="row">

    <div class="col-md-7">
        <form id="common-form" method="POST">
            <?= FormHelper::getInput('Title', 'Form[title]', [
                'placeholder'   => 'Form title...',
                'value'         => $form->title
            ]) ?>

            <?= FormHelper::getInput('Description', 'Form[decription]', [
                'placeholder'   => 'Form decription...',
                'value'         => $form->decription
            ]) ?>

            <h3>Make you html form...</h3>
            <hr>

            <div id="user-form">
                <?= $form->result_form ?>
            </div>

            <hr>

            <input id="user-result" type="hidden" name="Form[result_form]" />

            <div class="form-group">
                <button id="form-save" type="submit" class="btn btn-success">Save form</button>
            </div>
        </form>
    </div>

    <div id="list-fields" class="col-md-5">
        <div class="row">
            <div class="col-md-12 toggle">
                <h4 class="open" data-class="toggle-base">
                    <span>Base fields</span>
                    <span class="glyphicon glyphicon-minus" data-replace="glyphicon glyphicon-plus" aria-hidden="true"></span>
                </h4>
            </div>
        </div>

        <div id="fields-types" class="row" data-class="toggle-base">
            <div class="col-md-4">
                <div class="field-type" data-type="<?= FormHelper::TYPE_TEXT ?>">
                    <span class="glyphicon glyphicon-font" aria-hidden="true"></span>
                    <span class="glyphicon-class">Text</span>
                </div>
            </div>

            <div class="col-md-4">
                <div class="field-type" data-type="<?= FormHelper::TYPE_INPUT ?>">
                    <span class="glyphicon glyphicon-modal-window" aria-hidden="true"></span>
                    <span class="glyphicon-class">Input</span>
                </div>
            </div>

            <div class="col-md-4">
                <div class="field-type" data-type="<?= FormHelper::TYPE_SELECT ?>">
                    <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                    <span class="glyphicon-class">Select</span>
                </div>
            </div>

            <div class="col-md-4">
                <div class="field-type" data-type="<?= FormHelper::TYPE_TEXTAREA ?>">
                    <span class="glyphicon glyphicon-align-justify" aria-hidden="true"></span>
                    <span class="glyphicon-class">Textarea</span>
                </div>
            </div>

            <div class="col-md-4">
                <div class="field-type" data-type="<?= FormHelper::TYPE_CHECKBOX ?>">
                    <span class="glyphicon glyphicon-check" aria-hidden="true"></span>
                    <span class="glyphicon-class">Checkbox</span>
                </div>
            </div>

            <div class="col-md-4">
                <div class="field-type" data-type="<?= FormHelper::TYPE_RADIO ?>">
                    <span class="glyphicon glyphicon-record" aria-hidden="true"></span>
                    <span class="glyphicon-class">Radio</span>
                </div>
            </div>

            <div class="col-md-4">
                <div class="field-type" data-type="<?= FormHelper::TYPE_BUTTON ?>">
                    <span class="glyphicon glyphicon-unchecked" aria-hidden="true"></span>
                    <span class="glyphicon-class">Button</span>
                </div>
            </div>

            <div class="col-md-4">
                <div class="field-type" data-type="<?= FormHelper::TYPE_FILE ?>">
                    <span class="glyphicon glyphicon-file" aria-hidden="true"></span>
                    <span class="glyphicon-class">File</span>
                </div>
            </div>

            <div class="col-md-4">
                <div class="field-type" data-type="<?= FormHelper::TYPE_IMAGE ?>">
                    <span class="glyphicon glyphicon-picture" aria-hidden="true"></span>
                    <span class="glyphicon-class">Image</span>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 toggle">
                <h4 data-class="toggle-properties">
                    <span>Field properties</span>
                    <span class="glyphicon glyphicon-plus" data-replace="glyphicon glyphicon-minus" aria-hidden="true"></span>
                </h4>
            </div>
        </div>

        <div class="row" data-class="toggle-properties" style="display: none;">
            <div class="col-md-12 field-properties_wrap">Please click to "Edit" button for field...</div>
        </div>
    </div>
</div>
