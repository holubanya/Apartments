<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use yii\widgets\Breadcrumbs;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ApartmentsSearch */
/* @var $dataProvider yii\data\ArrayDataProvider */
/* @var $typeList array */

$this->title = 'Квартиры';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="apartments-index">
    <header><?= Html::encode($this->title) ?></header>

    <div class="row">
        <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
            <div class="col col-sm-3">
                <?= $form->field($searchModel, 'city')->textInput() ?>
            </div>

            <div class="col col-sm-3">
                <?= $form->field($searchModel, 'apartment_type')->dropDownList($typeList, [
                    'class' => "selectpicker type",
                ])?>
            </div>

            <div class="col col-sm-2">
                <?= Html::submitButton('Поиск', ['class' => 'btn btn-search btn-warning', 'value' => 'search', 'name' => 'search']) ?>
            </div>
        <?php ActiveForm::end() ?>
    </div>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                'attribute' => 'Название ЖК',
                'format' => 'text',
                'value' => 'rc_name'
            ],
            [
                'attribute' => 'Город',
                'format' => 'text',
                'value' => 'city'
            ],
            [
                'attribute' => 'Дом',
                'format' => 'text',
                'value' => 'h_name'
            ],
            [
                'attribute' => 'Площадь',
                'format' => 'text',
                'value' => 'total_area'
            ],
            [
                'attribute' => 'Стоимость',
                'format' => 'text',
                'value' => 'total_price'
            ]
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
