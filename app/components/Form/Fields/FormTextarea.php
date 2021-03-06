<?php
/**
 * Created by PhpStorm.
 * Date: 2017-02-05
 * Time: 14:49
 */

namespace app\components\Form\Fields;

/**
 * Class FormTextarea
 * @package app\components\Form\Fields
 */
trait FormTextarea
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
    public static function getTextarea(string $title, string $name = null, array $options = [], bool $with_edit = false): string
    {
        $options['id']      = $options['id'] ?? 'form-'.self::getId();
        $options['class']   = 'form-control '. ($options['class'] ?? null);

        $value = '';

        if (isset($options['value'])) {
            $value = $options['value'];
            unset($options['value']);
        }

        $attributes = self::getStringAttributes($options);

        ob_start();

        ?>
        <div class="form-group">
            <label for="<?= $options['id'] ?>"><?= $title ?></label>
            <?= $with_edit ? self::getConfigButtons(self::TYPE_TEXTAREA) : null ?>
            <textarea <?= $attributes ?>><?= $value ?></textarea>
        </div>
        <?

        return ob_get_clean();
    }
}