<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Breadcrumbs;
use yii\widgets\DetailView;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $model app\models\Houses */
/* @var $newApartment app\models\Apartments */
/* @var $typeList array*/
/* @var $apartmentsList array*/
/* @var $residence app\models\ResidentialComplexes */
/* @var $pages */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Admin', 'url' => ['/admin']];
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
<!--    <p>-->
<!--        --><?//= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
<!--        --><?//= Html::a('Delete', ['delete', 'id' => $model->id], [
//            'class' => 'btn btn-danger',
//            'data' => [
//                'confirm' => 'Are you sure you want to delete this item?',
//                'method' => 'post',
//            ],
//        ]) ?>
<!--    </p>-->
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
                                'data' => ['method' => 'post'],
                            ]) ?>
                        </div>
                    </div>
                <?php endforeach ?>
            <?php else: ?>
                <div>Нет домов</div>
            <?php endif?>
            <?= LinkPager::widget([
                'pagination' => $pages,
            ]); ?>
        </div>
        <div class="col col-sm-4">
            <div class="heading">Создать не типовую квартиру</div>

            <?= $this->render('..\common\_form_apartments.php', [
                'typeList' => $typeList,
                'newApartment' => $newApartment,
            ]) ?>
        </div>
    </div>
</div>
