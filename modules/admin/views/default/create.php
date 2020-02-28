<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ResidentialComplexes */

$this->title = 'Создать жилой комплекс';
$this->params['breadcrumbs'][] = ['label' => 'Новостройки', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="residential-complexes-create">
    <header><?= Html::encode($this->title) ?></header>

    <div class="row">
        <div class="col col-sm-6">
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>
</div>
