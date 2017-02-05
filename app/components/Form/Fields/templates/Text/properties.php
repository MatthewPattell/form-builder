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

$object = $dom->find('.text-field')[0] ?? null;

$fonsize_begin = stripos($object->attr('style'), 'font-size');
$font_size = substr($object->attr('style'), $fonsize_begin, stripos($object->attr('style'), ';', $fonsize_begin));
?>

<?= FormHelper::getInput('Title', null, [
    'value' => $object ? $object->text() : null,
    'data-element'  => '.text-field',
    'data-type'     => 'text'
]) ?>

<?= FormHelper::getCheckbox('Bold', null, [
    'value'         => 'font-weight:bold',
    'data-element'  => '.text-field',
    'data-type'     => 'css',
    'checked'       => (stripos($object->attr('style'), 'font-weight: bold') !== false)
]) ?>

<?= FormHelper::getCheckbox('Italic', null, [
    'value'         => 'font-style:italic',
    'data-element'  => '.text-field',
    'data-type'     => 'css',
    'checked'       => (stripos($object->attr('style'), 'font-style: italic') !== false)
]) ?>

<?= FormHelper::getCheckbox('Underline', null, [
    'value'         => 'text-decoration:underline',
    'data-element'  => '.text-field',
    'data-type'     => 'css',
    'checked'       => (stripos($object->attr('style'), 'text-decoration: underline') !== false)
]) ?>

<div>Text position:</div>

<?= FormHelper::getRadio('Left', 'text-position', [
    'value'         => 'text-align:left',
    'data-element'  => '.text-field',
    'data-type'     => 'css',
    'checked'       => (stripos($object->attr('style'), 'text-align: left') !== false) || stripos($object->attr('style'), 'text-align') === false
]) ?>

<?= FormHelper::getRadio('Center', 'text-position', [
    'value'         => 'text-align:center',
    'data-element'  => '.text-field',
    'data-type'     => 'css',
    'checked'       => (stripos($object->attr('style'), 'text-align: center') !== false)
]) ?>

<?= FormHelper::getRadio('Right', 'text-position', [
    'value'         => 'text-align:right',
    'data-element'  => '.text-field',
    'data-type'     => 'css',
    'checked'       => (stripos($object->attr('style'), 'text-align: right') !== false)
]) ?>

<?= FormHelper::getRadio('Justify', 'text-position', [
    'value'         => 'text-align:justify',
    'data-element'  => '.text-field',
    'data-type'     => 'css',
    'checked'       => (stripos($object->attr('style'), 'text-align: justify') !== false)
]) ?>

<?= FormHelper::getSelect('Font size', null, [
    'value'         => $font_size,
    'data-element'  => '.text-field',
    'data-type'     => 'css',
    'options'   => [
        'font-size: 14px' => '14px',
        'font-size: 16px' => '16px',
        'font-size: 18px' => '18px',
        'font-size: 20px' => '20px',
        'font-size: 22px' => '22px',
        'font-size: 24px' => '24px',
    ]
]) ?>
