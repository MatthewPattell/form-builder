<?php
/**
 * Created by PhpStorm.
 * Date: 2017-02-05
 * Time: 14:49
 */

namespace app\components\Form\Fields;

/**
 * Class FormInput
 * @package app\components\Form\Fields
 */
trait FormInput
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
    public static function getInput(string $title, string $name = null, array $options = [], bool $with_edit = false): string
    {
        $options['id']      = $options['id'] ?? 'form-'.self::getId();
        $options['name']    = $options['name'] ?? $name;
        $options['class']   = 'form-control '. ($options['class'] ?? null);
        $options['type']    = $options['type'] ?? 'text';

        $attributes = self::getStringAttributes($options);

        ob_start();

        ?>
        <div class="form-group">
            <label for="<?= $options['id'] ?>"><?= $title ?></label>
            <?= $with_edit ? self::getConfigButtons(self::TYPE_INPUT) : null ?>
            <input <?= $attributes ?> />
        </div>
        <?

        return ob_get_clean();
    }

    /**
     * Get input types
     *
     * @return array
     */
    public static function getInputTypes(): array
    {
        return [
            'text'      => 'Text',
            'number'    => 'Number',
            'email'     => 'Email',
            'password'  => 'Password',
            'tel'       => 'Tel',
            // and etc..
        ];
    }
}