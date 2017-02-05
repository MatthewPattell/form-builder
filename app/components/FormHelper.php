<?php
/**
 * Created by PhpStorm.
 * Date: 2017-02-05
 * Time: 03:37
 */

namespace app\components;

/**
 * Class FormHelper
 * @package app\components
 */
class FormHelper
{
    /**
     * Fields types
     */
    const TYPE_INPUT = 'Input';

    /**
     * Create field by type
     *
     * @param string $type
     * @return string
     */
    public static function getField(string $type, string $title): string
    {
        $method = 'get'.$type;

        if (method_exists(__CLASS__, $method)) {
            return self::$method($title);
        }

        return null;
    }

    /**
     * Get input field
     *
     * @param array $options
     * @return string
     */
    public static function getInput(string $title, string $name = null, array $options = []): string
    {
        $options['id'] = $options['id'] ?? self::getId();
        $options['class']   = 'form-control '. ($options['class'] ?? null);

        ob_start();

        ?>
        <div class="form-group">
            <label for="form-<?= $options['id'] ?>"><?= $title ?></label>
            <input type="text" id="form-<?= $options['id'] ?>" name="<?= $name ?>" class="<?= $options['class'] ?? null ?>" placeholder="<?= $options['placeholder'] ?? null ?>" />
        </div>
        <?

        return ob_get_clean();
    }

    /**
     * Generate id for field
     *
     * @return string
     */
    private static function getId(): string
    {
        return rand(1111111,9999999);
    }
}