<?php
/**
 * Created by PhpStorm.
 * Date: 2017-02-05
 * Time: 14:49
 */

namespace app\components\Form\Fields;

/**
 * Class FormText
 * @package app\components\Form\Fields
 */
trait FormText
{
    /**
     * Get text field
     *
     * @param string $title
     * @param string $name
     * @param array $options
     * @param bool $with_edit
     * @return string
     */
    public static function getText(string $title, string $name = null, array $options = [], bool $with_edit = false): string
    {
        $options['class'] = 'text-field '. ($options['class'] ?? null);

        $attributes = self::getStringAttributes($options);

        ob_start();

        ?>
        <div class="form-group">
            <div <?= $attributes ?>><?= $title ?></div>
            <?= $with_edit ? self::getConfigButtons(self::TYPE_TEXT) : null ?>
        </div>
        <?

        return ob_get_clean();
    }
}