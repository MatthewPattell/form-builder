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

$input = $dom->find('input')[0] ?? null;
?>

<?= FormHelper::getInput('Title', null, [
    'value'         => $input ? $input->attr('value') : null,
    'data-element'  => 'input',
    'data-type'     => 'value'
]) ?>

<?= FormHelper::getInput('Name', null, [
    'value' => $input ? $input->attr('name') : null,
    'data-element'  => 'input',
    'data-type'     => 'name'
]) ?>

<?= FormHelper::getInput('Class', null, [
    'value' => $input ? $input->attr('class') : null,
    'data-element'  => 'input',
    'data-type'     => 'class'
]) ?>
