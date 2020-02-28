<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Breadcrumbs;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ResidentialComplexes */
/* @var $newApartment app\models\Apartments */
/* @var $newHouse app\models\Houses */
/* @var $houses array */
/* @var $typeList array */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Новостройки', 'url' => ['/admin']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="residential-complexes-view">
    <? echo Breadcrumbs::widget([
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    ]); ?>

    <header><?= Html::encode($this->title) ?></header>
    <div class="text"><?= Html::encode($model->city) ?></div>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <div class="house-container">
        <?php if (count($houses)): ?>
            <?php foreach($houses as $house): ?>
                <div class="card house-block">
                    <div class="card-body">
                        <?= Html::a(Html::encode($house->name), ['houses/view', 'id' => $house->id], ['class' => 'heading']) ?>
                        <a href="#" class="card-link">Card link</a>
                        <a href="#" class="card-link">Another link</a>
                    </div>
                </div>
            <?php endforeach ?>
        <?php else: ?>
            <div>Нет домов</div>
        <?php endif?>
    </div>
    <div class="row add-container">
        <div class="col col-sm-6">
            <div class="heading">Создать дом</div>

            <?php $form = ActiveForm::begin(); ?>
                <?= $form->field($newHouse, 'name')->textInput(['maxlength' => true]) ?>
                <?= Html::submitButton('Создать дом', ['class' => 'btn btn-success', 'name' => 'addHouse', 'value' => 'addHouse']) ?>
            <?php ActiveForm::end(); ?>
        </div>
        <div class="col col-sm-6">
            <div class="heading">Создать типовую квартиру</div>

            <?= $this->render('..\common\_form_apartments.php', [
                'typeList' => $typeList,
                'newApartment' => $newApartment,
            ]) ?>
        </div>
    </div>
</div>
