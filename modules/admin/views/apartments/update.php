<?php

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

/* @var $this yii\web\View */
/* @var $model app\models\Apartments */
/* @var $apartment app\models\Apartments */
/* @var $typeList array*/

$this->title = 'Изменть квартиру: ' . $typeList[$apartment["type_id"]];
$this->params['breadcrumbs'][] = ['label' => 'Новостройки', 'url' => ['/admin']];
$this->params['breadcrumbs'][] = 'Изменть квартиру';
?>
<div class="apartments-update">
    <? echo Breadcrumbs::widget([
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    ]); ?>

    <header><?= Html::encode($this->title) ?></header>

    <div class="row">
        <div class="col col-sm-6">
            <?= $this->render('..\common\_form_apartments.php', [
                'typeList' => $typeList,
                'newApartment' => $apartment,
            ]) ?>
        </div>
    </div>
</div>
