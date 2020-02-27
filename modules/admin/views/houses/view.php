<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Houses */
/* @var $newApartment app\models\Apartments */
/* @var $typeList array*/
/* @var $apartmentsList array*/
/* @var $residence app\models\ResidentialComplexes */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Houses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="houses-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <h6><?= Html::encode($residence->name) ?></h6>
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
    <?php if (count($apartmentsList)): ?>
        <?php foreach($apartmentsList as $apartment): ?>
            <div><?= Html::encode($apartment["total_price"]) ?></div>
        <?php endforeach ?>
    <?php else: ?>
        <div>Нет домов</div>
    <?php endif?>

    <h5>Создать не типовую квартиру</h5>

    <?//= Html::input('text', 'total-price', $newApartment->total_price, ['class' => 'total-price']) ?>

    <select class="selectpicker">
        <?php foreach ($typeList as $value) : ?>
            <option value=<?php echo 1 ?>><?php echo $value ?></option>
        <?php endforeach ?>
    </select>

    <?= Html::submitButton('Create apartment', ['class' => 'btn btn-success addApartment']) ?>

</div>

<script>
    $('.addApartment').on('click', function(e){
        $.ajax({
            type: "POST",
            url: '/site/index',
            data: {}
        }).then(response => {console.log(response)});
    })
</script>