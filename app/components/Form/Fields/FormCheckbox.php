<?php
/**
 * Created by PhpStorm.
 * Date: 2017-02-05
 * Time: 14:49
 */

namespace app\components\Form\Fields;

/**
 * Class FormCheckbox
 * @package app\components\Form\Fields
 */
trait FormCheckbox
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
    public static function getCheckbox(string $title, string $name = null, array $options = [], bool $with_edit = false): string
    {
        $options['id']      = $options['id'] ?? 'form-'.self::getId();
        $options['type']    = 'checkbox';

        if (isset($options['checked']) && $options['checked'] == false) {
            unset($options['checked']);
        }

        $attributes = self::getStringAttributes($options);

        ob_start();

        ?>
        <div class="form-group">
            <div class="checkbox">
                <label><input <?= $attributes ?>> <span><?= $title ?></span></label>
                <?= $with_edit ? self::getConfigButtons(self::TYPE_CHECKBOX) : null ?>
            </div>
        </div>
        <?

        return ob_get_clean();
    }
}