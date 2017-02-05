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

$object = $dom->find('.image-field')[0] ?? null;

$fonsize_begin = stripos($object->attr('style'), 'font-size');
$font_size = substr($object->attr('style'), $fonsize_begin, stripos($object->attr('style'), ';', $fonsize_begin));
?>

<?= FormHelper::getInput('Title', null, [
    'value' => $object ? $object->attr('title') : null,
    'data-element'  => '.image-field',
    'data-type'     => 'title'
]) ?>

<?= FormHelper::getInput('Alt', null, [
    'value' => $object ? $object->attr('alt') : null,
    'data-element'  => '.image-field',
    'data-type'     => 'alt'
]) ?>

<?= FormHelper::getInput('Url', null, [
    'value' => $object ? $object->attr('src') : null,
    'data-element'  => '.image-field',
    'data-type'     => 'src'
]) ?>

<?= FormHelper::getInput('Width', null, [
    'value' => $object ? $object->attr('width') : null,
    'data-element'  => '.image-field',
    'data-type'     => 'width'
]) ?>

<?= FormHelper::getInput('Height', null, [
    'value' => $object ? $object->attr('height') : null,
    'data-element'  => '.image-field',
    'data-type'     => 'height'
]) ?>
