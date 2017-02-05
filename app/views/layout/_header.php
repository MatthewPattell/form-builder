<?php
/**
 * Created by PhpStorm.
 * Date: 2017-02-05
 * Time: 02:18
 */

/**
 * @var $this \app\components\BaseController
 */

?>

<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">From Builder</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse" aria-expanded="false" style="height: 1px;">
            <ul class="nav navbar-nav">
                <li class="<?= $this->compareUrl('site/index') ? 'active' : null; ?>">
                    <a href="/">Forms</a>
                </li>
                <li class="<?= $this->compareUrl('forms/create') ? 'active' : null; ?>">
                    <a href="/forms/create">Create</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

