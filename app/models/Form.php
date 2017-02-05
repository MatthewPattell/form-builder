<?php
/**
 * Created by PhpStorm.
 * Date: 2017-02-05
 * Time: 02:46
 */

namespace app\models;

/**
 * Class Form
 * @package app\models
 */
class Form
{
    /**
     * Model id
     *
     * @var string
     */
    public $id;

    /**
     * Title form
     *
     * @var string
     */
    public $title;

    /**
     * Description form
     *
     * @var string
     */
    public $decription;

    /**
     * User html form
     *
     * @var string
     */
    public $result_form;

    /**
     * Created date
     *
     * @var string
     */
    public $created_at;

    /**
     * Updated date
     *
     * @var string
     */
    public $updated_at;

    /**
     * Model errors
     *
     * @var array
     */
    private $errors = [];

    /**
     * Path to models storage
     *
     * @var null
     */
    private $db_path = null;

    /**
     * Form constructor.
     *
     * @param string|null $db_path
     */
    public function __construct(string $db_path = null)
    {
        $this->db_path = $db_path ? : PROJECT_DIR.'db'.DIRECTORY_SEPARATOR;
    }

    /**
     * Get list models
     *
     * @return array
     */
    public static function getModels(): array
    {
        $models = [];
        $model  = new self();
        $files  = glob($model->db_path.'*.model');

        if (!empty($files)) {
            foreach ($files as $file) {
                $fields = json_decode(file_get_contents($file), true);
                $tmp_model = clone $model;
                $tmp_model->load($fields);

                $models[$tmp_model->id] = $tmp_model;
            }
        }

        return $models;
    }

    /**
     * Find model by id
     *
     * @param string|null $id
     * @return Form|null
     */
    public static function find(string $id = null)
    {
        $model = null;
        $self  = new self();

        if ($id) {
            $file = $self->db_path.'model_'.$id.'.model';

            if (file_exists($file)) {
                $fields = json_decode(file_get_contents($file), true);
                $model  = clone $self;
                $model->load($fields);
            }
        }

        return $model;
    }

    /**
     * Get model errors
     *
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    /**
     * Load post data to model
     *
     * @param array $fields
     * @return bool
     */
    public function load(array $fields): bool
    {
        if (empty($fields)) {
            return false;
        }

        foreach ($fields as $field => $value) {
            if (property_exists($this, $field)) {
                $this->$field = trim($value);
            }
        }

        return true;
    }

    /**
     * Save model
     *
     * @return bool
     */
    public function save(): bool
    {
        if (empty($this->title)) {
            $this->errors['title'] = 'Title cannot be blank.';
        }

        if (empty($this->decription)) {
            $this->errors['description'] = 'Description cannot be blank.';
        }

        $result_form = str_replace(["\n", "\r\n", "\r"], '', $this->result_form);

        if (empty($result_form)) {
            $this->result_form = $result_form;
            $this->errors['result_form'] = 'User form cannot be blank.';
        }

        if (!empty($this->errors)) {
            return false;
        }

        $date = date('Y-m-d H:i:s');

        $this->created_at = $this->created_at ? : $date;
        $this->updated_at = $date;

        $this->id   = $this->id ? : time().rand(11111111, 99999999);
        $filename   = 'model_'.$this->id.'.model';
        $path       = $this->db_path.$filename;

        file_put_contents($path, json_encode($this));

        return true;
    }

    /**
     * Delete model
     *
     * @return bool
     */
    public function delete(): bool
    {
        return unlink($this->db_path.'model_'.$this->id.'.model');
    }
}