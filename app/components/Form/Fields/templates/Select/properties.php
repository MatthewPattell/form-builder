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
$input       = $dom->find('select')[0] ?? null;

$options        = $input->find('option');
$options_html   = '';

if (!empty($options)) {
    foreach ($options as $option) {
        $options_html .= $option->attr('value').'::'.$option->text().PHP_EOL;
    }
}
?>

<?= FormHelper::getInput('Title', null, [
    'value' => isset($label_title[0]) ? $label_title[0]->text() : null,
    'data-element'  => 'label',
    'data-type'     => 'text'
]) ?>

<?= FormHelper::getInput('Name', null, [
    'value' => $input ? $input->attr('name') : null,
    'data-element'  => 'select',
    'data-type'     => 'name'
]) ?>

<?= FormHelper::getTextarea('Options', null, [
    'value' => $options_html,
    'data-element'  => 'select',
    'data-type'     => 'value',
    'placeholder'   => "value::text\nvalue2::text2"
]) ?>

<?= FormHelper::getCheckbox('Multiple', null, [
    'checked'       => $input->hasAttribute('multiple'),
    'data-element'  => 'select',
    'data-type'     => 'multiple',
]) ?>