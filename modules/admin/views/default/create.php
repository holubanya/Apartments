<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ResidentialComplexes */

$this->title = 'Create Residential Complexes';
$this->params['breadcrumbs'][] = ['label' => 'Residential Complexes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="residential-complexes-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
