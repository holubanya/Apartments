<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Breadcrumbs;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ResidentialComplexesSearch */
/* @var $residentialComplexes array */

$this->title = 'Новостройки ';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="residential-complexes-index">
    <? echo Breadcrumbs::widget([
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    ]); ?>

    <header><?= Html::encode($this->title) ?></header>

    <p>
        <?= Html::a('Создать жилой комплекс', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <div class="rc-container">
        <?php if (count($residentialComplexes)): ?>
            <?php foreach($residentialComplexes as $residentialComplex): ?>
                <div class="card rc-block">
                    <div class="card-body">
                        <?= Html::a(Html::encode($residentialComplex['name']), ['view', 'id' => $residentialComplex['id']], ['class' => 'heading']) ?>
                        <div class="card-subtitle mb-2 text-muted"><?=Html::encode($residentialComplex['city'])?></div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div>Нет новостроек</div>
        <?php endif ?>
    </div>

</div>
