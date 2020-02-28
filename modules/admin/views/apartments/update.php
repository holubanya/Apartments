<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Apartments */
/* @var $apartment app\models\Apartments */
/* @var $typeList array*/

//$this->title = 'Update Apartments: ' . $model->id;
//$this->params['breadcrumbs'][] = ['label' => 'Apartments', 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="apartments-update">

    <h1><?= Html::encode($this->title) ?></h1>


    <?= $this->render('..\common\_form_apartments.php', [
        'typeList' => $typeList,
        'newApartment' => $apartment,
    ]) ?>

</div>
