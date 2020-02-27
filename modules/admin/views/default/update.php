<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ResidentialComplexes */

$this->title = 'Update Residential Complexes: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Residential Complexes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="residential-complexes-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
