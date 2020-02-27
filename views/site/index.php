<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ApartmentsSearch */
/* @var $dataProvider yii\data\ArrayDataProvider */
/* @var $typeList array */

$this->title = 'Apartments';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="apartments-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

        <?= $form->field($searchModel, 'city')->textInput() ?>

        <?= $form->field($searchModel, 'apartment_type')->dropDownList($typeList, [
            'class' => "selectpicker type",
        ])->label("Type")?>

        <?= Html::submitButton('Поиск', ['class' => 'btn btn-success', 'value' => 'search', 'name' => 'search']) ?>

    <?php ActiveForm::end() ?>

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
