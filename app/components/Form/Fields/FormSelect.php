<?php
/**
 * Created by PhpStorm.
 * Date: 2017-02-05
 * Time: 14:49
 */

namespace app\components\Form\Fields;

/**
 * Class FormSelect
 * @package app\components\Form\Fields
 */
trait FormSelect
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
    public static function getSelect(string $title, string $name = null, array $options = [], bool $with_edit = false): string
    {
        $options['id']      = $options['id'] ?? 'form-'.self::getId();
        $options['class']   = 'form-control '. ($options['class'] ?? null);
        $options['type']    = $options['type'] ?? 'text';

        $value          = '';
        $html_values    = '';

        if (isset($options['value'])) {
            $value = $options['value'];
            unset($options['value']);
        }

        if (isset($options['options'])) {
            if (!empty($options['options'])) {
                foreach ($options['options'] as $key => $text) {
                    $html_values .= '<option '. (!empty($key) ? "value=\"".$key."\"" : "") .' '. ($value == $key ? "selected" : "") .'>'. $text .'</option>';
                }
            }

            unset($options['options']);
        }

        $attributes = self::getStringAttributes($options);

        ob_start();

        ?>
        <div class="form-group">
            <label for="<?= $options['id'] ?>"><?= $title ?></label>
            <?= $with_edit ? self::getConfigButtons(self::TYPE_SELECT) : null ?>
            <select <?= $attributes ?>>
                <?= $html_values ?>
            </select>
        </div>
        <?

        return ob_get_clean();
    }
}