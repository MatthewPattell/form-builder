<?php
/**
 * Created by PhpStorm.
 * Date: 2017-02-04
 * Time: 15:28
 */

/**
 * @var $this \app\components\BaseController
 * @var $content string
 */

?>
<!DOCTYPE html>
<html lang="ru-RU>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $this->title ?></title>
    <? $this->assetsPrint() ?>
    <!--[if lt IE 9]>
    <script src="/js/html5shiv.min.js"></script>
    <script src="/js/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    <? require('_header.php'); ?>

    <div class="container">
        <? echo $content; ?>
    </div>

    <? require('_footer.php'); ?>

    <script src="/js/ie10-viewport-bug-workaround.js"></script>
</body>
</html>