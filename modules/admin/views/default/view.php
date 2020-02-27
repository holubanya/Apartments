<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ResidentialComplexes */
/* @var $newApartment app\models\Apartments */
/* @var $newHouse app\models\Houses */
/* @var $houses array */
/* @var $typeList array */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Residential Complexes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="residential-complexes-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <h5><?= Html::encode($model->city) ?></h5>
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
    <?php if (count($houses)): ?>
        <?php foreach($houses as $house): ?>
            <div><?= Html::encode($house->name) ?></div>
        <?php endforeach ?>
    <?php else: ?>
        <div>Нет домов</div>
    <?php endif?>
    <h5>Создать дом</h5>

    <?php $form = ActiveForm::begin(); ?>
        <?= $form->field($newHouse, 'name')->textInput(['maxlength' => true]) ?>
        <?= Html::submitButton('Create house', ['class' => 'btn btn-success', 'name' => 'addHouse', 'value' => 'addHouse']) ?>
    <?php ActiveForm::end(); ?>

    <h5>Создать типовую квартиру</h5>

    <?php $form = ActiveForm::begin(); ?>
        <?= $form->field($newApartment, 'total_area')->textInput(['maxlength' => true]) ?>

        <?= $form->field($newApartment, 'total_price')->textInput(['maxlength' => true]) ?>

        <?= $form->field($newApartment, 'type_id')->dropDownList($typeList, [
            'class' => "selectpicker",
        ])->label("Type")?>

        <?= Html::submitButton('Create apartment', ['class' => 'btn btn-success', 'name' => 'addApartment', 'value' => 'addApartment']) ?>
    <?php ActiveForm::end(); ?>
</div>
