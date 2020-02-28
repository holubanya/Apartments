<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Houses */

$this->title = 'Изменить дом ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Новостройки', 'url' => ['admin']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Изменить дом';
?>
<div class="houses-update">
    <header><?= Html::encode($this->title) ?></header>

    <div class="row">
        <div class="col col-sm-6">
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>

</div>
