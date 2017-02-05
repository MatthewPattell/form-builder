<?php
/**
 * Created by PhpStorm.
 * Date: 2017-02-05
 * Time: 14:55
 */

use app\components\Form\FormHelper;

/**
 * @var $dom \DiDom\Document
 * @see https://github.com/Imangazaliev/DiDOM/blob/master/README-RU.md
 */

$label_title = $dom->find('label');
$input       = $dom->find('textaarea')[0] ?? null;
?>

<?= FormHelper::getInput('Title', null, [
    'value' => isset($label_title[0]) ? $label_title[0]->text() : null,
    'data-element'  => 'label',
    'data-type'     => 'text'
]) ?>

<?= FormHelper::getInput('Name', null, [
    'value' => $input ? $input->attr('name') : null,
    'data-element'  => 'textarea',
    'data-type'     => 'name'
]) ?>

<?= FormHelper::getInput('Value', null, [
    'value' => $input ? $input->attr('value') : null,
    'data-element'  => 'textarea',
    'data-type'     => 'value'
]) ?>

<?= FormHelper::getInput('Placeholder', null, [
    'value' => $input ? $input->attr('placeholder') : null,
    'data-element'  => 'textarea',
    'data-type'     => 'placeholder'
]) ?>