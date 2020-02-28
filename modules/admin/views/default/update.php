<?php

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

/* @var $this yii\web\View */
/* @var $model app\models\ResidentialComplexes */

$this->title = 'Изменить жилой комплекс: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Новостройки', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Изменить';
?>
<div class="residential-complexes-update">

    <? echo Breadcrumbs::widget([
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    ]); ?>

    <header><?= Html::encode($this->title) ?></header>

    <div class="row">
        <div class="col col-sm-6">
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>
</div>
