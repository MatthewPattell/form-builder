<?php
/**
 * Created by PhpStorm.
 * Date: 2017-02-05
 * Time: 02:43
 */

use app\assets\BaseAsset;

/**
 * @var $this \app\components\BaseController
 */

BaseAsset::register($this);

require('_form.php');

$this->title = 'Create new form';
?>
