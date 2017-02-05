<?php
/**
 * Created by PhpStorm.
 * Date: 2017-02-05
 * Time: 02:44
 */

use app\components\FormHelper;

/**
 * @var $this \app\components\BaseController
 */

$this->requireVendorFile('/js/forms/create.js');
?>

<div class="row">

    <div class="col-md-7">
        <form method="POST">
            <?= FormHelper::getInput('Title', 'Form[title]', [
                'placeholder'   => 'Form title...',
            ]) ?>

            <?= FormHelper::getInput('Description', 'Form[decription]', [
                'placeholder'   => 'Form decription...',
            ]) ?>

            <h3>Make you html form...</h3>
            <hr>

            <div id="user-form">

            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-success waves-effect">Create</button>
            </div>
        </form>
    </div>

    <div class="col-md-5">
        <h4>Base fields</h4>
        <hr>
        <div class="row">
            <div class="col-md-4">
                <div class="field-type" data-type="<?= FormHelper::TYPE_INPUT ?>">
                    <span class="glyphicon glyphicon-modal-window" aria-hidden="true"></span>
                    <span class="glyphicon-class">Text input</span>
                </div>
            </div>
        </div>
    </div>
</div>
