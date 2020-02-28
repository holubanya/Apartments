<?php

use app\models\Apartments;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Breadcrumbs;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $model app\models\Houses */
/* @var $typeList array*/
/* @var $apartmentsList array*/
/* @var $residence app\models\ResidentialComplexes */
/* @var $pages */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Новостройки', 'url' => ['/admin']];
$this->params['breadcrumbs'][] = ['label' => $residence->name, 'url' => ['/admin/default/view', 'id' => $residence->id]];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

?>
<div class="houses-view">
    <? echo Breadcrumbs::widget([
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    ]); ?>
    <header><?= Html::encode($this->title) ?></header>
    <div class="text"><?= Html::encode($residence->city) ?></div>

    <p>
        <?= Html::a('Изменить дом', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить дом', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены что хотите удалить дом?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <div class="row">
        <div class="col col-sm-8 apartments-container">
            <?php if (count($apartmentsList)): ?>
                <?php foreach($apartmentsList as $apartment): ?>
                    <div class="card apartment-block">
                        <div class="card-body">
                            <h5 class="card-title">Количество комнат: <?= Html::encode($typeList[$apartment["type_id"]]) ?></h5>
                            <h6 class="card-subtitle mb-2 text-muted">Общая площадь: <?= Html::encode($apartment["total_area"]) ?>кв. м.</h6>
                            <p class="card-text">Цена: <?= Html::encode($apartment["total_price"]) ?>грн.</p>
                            <?= Html::a('Изменить', ['apartments/update', 'id' => $apartment["apartment_id"]], [
                                'class' => 'card-link',
                                'data' => ['method' => 'post'],
                            ]) ?>
                            <?= Html::a('Удалить', ['apartments/delete', 'id' => $apartment["apartment_id"]], [
                                'class' => 'card-link',
                                'data' => [
                                    'method' => 'post',
                                    'confirm' => 'Вы уверены что хотите удалить эту квартиру?'
                                ],
                            ]) ?>
                        </div>
                    </div>
                <?php endforeach ?>
            <?php else: ?>
                <div>Нет квартир</div>
            <?php endif?>
            <?= LinkPager::widget([
                'pagination' => $pages,
            ]); ?>
        </div>
        <div class="col col-sm-4">
            <div class="heading">Создать не типовую квартиру</div>
            <?php $form = ActiveForm::begin(['action' =>['apartments/create', 'houseId' => $model->id]]); ?>
                <?= $this->render('..\common\_form_apartments.php', [
                    'typeList' => $typeList,
                    'newApartment' => new Apartments(),
                    'form' => $form
                ]) ?>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
