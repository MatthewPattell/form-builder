<?php
/**
 * Created by PhpStorm.
 * Date: 2017-02-05
 * Time: 14:49
 */

namespace app\components\Form\Fields;

/**
 * Class FormButton
 * @package app\components\Form\Fields
 */
trait FormButton
{
    /**
     * Get input field
     *
     * @param string $title
     * @param string $name
     * @param array $options
     * @param bool $with_edit
     * @return string
     */
    public static function getButton(string $title, string $name = null, array $options = [], bool $with_edit = false): string
    {
        $options['value'] = $options['value'] ?? $title;
        $options['class'] = $options['class'] ?? 'btn btn-primary';
        $options['type']  = $options['type'] ?? 'submit';

        $attributes = self::getStringAttributes($options);

        ob_start();

        ?>
        <div class="form-group">
            <input <?= $attributes ?> />
            <?= $with_edit ? self::getConfigButtons(self::TYPE_BUTTON) : null ?>
        </div>
        <?

        return ob_get_clean();
    }
}