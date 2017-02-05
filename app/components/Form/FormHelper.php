<?php
/**
 * Created by PhpStorm.
 * Date: 2017-02-05
 * Time: 03:37
 */

namespace app\components\Form;

use app\components\Form\Fields\{
    FormButton, FormCheckbox, FormFile, FormImage, FormInput, FormRadio, FormSelect, FormText, FormTextarea
};
use DiDom\Document;

/**
 * Class FormHelper
 * @package app\components\Form
 */
class FormHelper
{
    use FormInput;
    use FormTextarea;
    use FormSelect;
    use FormCheckbox;
    use FormRadio;
    use FormText;
    use FormButton;
    use FormFile;
    use FormImage;

    /**
     * Fields types
     */
    const TYPE_INPUT    = 'Input';
    const TYPE_TEXTAREA = 'Textarea';
    const TYPE_SELECT   = 'Select';
    const TYPE_CHECKBOX = 'Checkbox';
    const TYPE_RADIO    = 'Radio';
    const TYPE_TEXT     = 'Text';
    const TYPE_BUTTON   = 'Button';
    const TYPE_FILE     = 'File';
    const TYPE_IMAGE    = 'Image';

    /**
     * Create field by type
     *
     * @param string $type
     * @param string $title
     * @param string $name
     * @param array $options
     * @param bool $with_edit
     * @return string
     */
    public static function getField(string $type, string $title, string $name = null, array $options = [], bool $with_edit = false): string
    {
        $method = 'get'.$type;

        if (method_exists(__CLASS__, $method)) {
            return self::$method($title, $name, $options, $with_edit);
        }

        return '';
    }

    /**
     * Get field properties
     *
     * @param string $id
     * @param string $type
     * @param string $html
     * @return string
     */
    public static function getProperties(string $id, string $type, string $html): string
    {
        $prop_file = __DIR__.DIRECTORY_SEPARATOR.'Fields'.DIRECTORY_SEPARATOR.'templates'.DIRECTORY_SEPARATOR.$type.DIRECTORY_SEPARATOR.'properties.php';

        if (file_exists($prop_file)) {

            $dom = new Document($html);

            ob_start();
            require($prop_file);
            return '<div data-reltion-id="'.$id.'">'.ob_get_clean().'</div>';
        }

        return 'The element does not have properties for editing.';
    }

    /**
     * Get config buttons
     *
     * @param string $type
     * @return string
     */
    private static function getConfigButtons(string $type): string
    {
        ob_start();

        ?>
        <div class="config-buttons pull-right" data-type="<?= $type ?>" data-id="<?= $type.self::getId() ?>">
            <span class="glyphicon glyphicon-pencil edit-field" title="Edit" aria-hidden="true"></span>
            <span class="glyphicon glyphicon-trash remove-field" title="Remove" aria-hidden="true"></span>
            <span class="glyphicon glyphicon-fullscreen move-field" title="Move" aria-hidden="true"></span>
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

    /**
     * Get string attributes from array
     *
     * @param array $attributes
     * @return string
     */
    private static function getStringAttributes(array $attributes = []): string
    {
        if (!empty($attributes)) {

            $a = [];

            foreach ($attributes as $attribute => $value) {
                $a[] = $attribute.'="'. $value .'"';
            }

            return implode(' ', $a);
        }

        return '';
    }
}