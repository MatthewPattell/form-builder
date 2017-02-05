<?php
/**
 * Created by PhpStorm.
 * Date: 2017-02-05
 * Time: 14:49
 */

namespace app\components\Form\Fields;

/**
 * Class FormImage
 * @package app\components\Form\Fields
 */
trait FormImage
{
    /**
     * Get image field
     *
     * @param string $title
     * @param string $name
     * @param array $options
     * @param bool $with_edit
     * @return string
     */
    public static function getImage(string $title, string $name = null, array $options = [], bool $with_edit = false): string
    {
        $options['class']   = 'image-field '. ($options['class'] ?? null);
        $options['title']   = $options['title'] ?? $title;
        $options['src']     = $options['src'] ?? 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAUoAAACqBAMAAAA5NBsAAAAAHlBMVEX///+5ubnKysrT09PFxcXb29v4+Pjm5ubx8fG/v79jhCz7AAACiUlEQVR42u3bS2sTURjG8ZfUmZztkws2u7TCAXcGsXRpRFx3pN52gxa1u4qXxl0UN1mOC/XjGuPMScZDWnKwJ+/Q5/cJ/jxvAiHJCBEREREREREREREREZFe5v3+pm5NJLJ0hAAHEtc3hOhNJSZTIMgviekEYXq5RJQh0JHEkxYI9EPiaf853pNNHQO4KfG0g1ZJi7iVOwCGsrE9oCvrsZKVrFRZ+XaSq680x8D3p8or0xeYGxzprvyKhW6uudJ97BhqrnyFUl9z5TtUpnor0zEqQ72VbTi7eit34PT1Vt6A0xXPa32VHflXup/rqDy9qPIlrI7Kiy6e7qGTq6hswen7UwJWRWUCZ9efEvMxNVSaApVH/pRzVkOlZKic+VMuxtRQeYJSx59ywWqoNO7g/pTlmAoq5UMZM/WmLFkNlebvaAf+lG5MBZXSvg0MDsWb0rEaKiX9+OyT+FOujKmh8tKfBqzOSlMA3phbqrwv68xQZzVWuim9MSNXtvxKf8olq2/LasramOoqZ/BZJRfPa1P6Y6rYMrG1KT1WRWXWyWtT+mMquHgC2NqUHqtgy6xcy03p6Wy/MnFrzbBOvvWLZ9VLz4w1Vda3TNxLbwa9lVn1PjaFqsraxROU7AyqKmtbZij1xnorEyzpqly9eKa2cmXLBE2ozPRWLi+eQG/lcsusCZUJFFe6i2eaK6stEzSh8ovqylYjKpuxZTMqefHrVsmLX7fKZl38zfnlJgvn2/8GRun/L1uNqGzGls2o5MX/nyTogSJTxH/aY3B3E/e28EyKQROe75ERAt2RiE4RZpBLRO0CQX5KVJ/DpjyTqMwIAQ4lMvP44aYePBciIiIiIiIiIiIiIrpyvwGPXU9VynS3IQAAAABJRU5ErkJggg==';
        $attributes = self::getStringAttributes($options);

        ob_start();

        ?>
        <div class="form-group">
            <img <?= $attributes ?> />
            <?= $with_edit ? self::getConfigButtons(self::TYPE_IMAGE) : null ?>
        </div>
        <?

        return ob_get_clean();
    }
}