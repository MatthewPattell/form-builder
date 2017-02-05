<?php
/**
 * Created by PhpStorm.
 * Date: 2017-02-04
 * Time: 14:53
 */

use app\assets\BaseAsset;

/**
 * @var $this \app\components\BaseController
 * @var $models \app\models\Form[]
 */

BaseAsset::register($this);

$this->requireVendorFile('/js/site/index.js');

$this->title = 'Form Builder';
?>

<div class="row">
    <div class="col-md-offset-2 col-md-8">
        <table class="table">
            <thead>
                <tr data-sort-asc="glyphicon glyphicon-sort-by-alphabet" data-sort-desc="glyphicon glyphicon-sort-by-alphabet-alt">
                    <th class="sortable">Title</th>
                    <th class="sortable">Description</th>
                    <th class="sortable">Created</th>
                    <th>Updated</th>
                    <th>#</th>
                </tr>
            </thead>
            <tbody>
            <? if (!empty($models)): ?>
                <? foreach ($models as $model): ?>
                    <tr>
                        <td><?= $model->title ?></td>
                        <td><?= $model->decription ?></td>
                        <td><?= date('d.m.Y', strtotime($model->created_at)) ?></td>
                        <td><?= date('d.m.Y', strtotime($model->updated_at)) ?></td>
                        <td>
                            <a href="/forms/update?id=<?= $model->id ?>" title="Update"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
                            <a href="/forms/delete?id=<?= $model->id ?>" title="Delete"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
                        </td>
                    </tr>
                <? endforeach; ?>
            <? else: ?>
                <tr>
                    <td colspan="5">So far, no one created form... <a href="/forms/create">Create now!</a></td>
                </tr>
            <? endif; ?>
            </tbody>
        </table>
    </div>
</div>

