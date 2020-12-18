<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $newApartment app\models\Apartments */
/* @var $typeList array*/
/* @var $form*/

$this->registerJsFile("@web/js/apartments.js");
?>
 <div class="add-apartment-container">
    <?= $form->field($newApartment, 'total_area')->textInput(['maxlength' => true, 'class' => 'total-area input']) ?>

    <div class="title">Цена</div>

    <div class="btn-container">
        <button class="btn toggle-btn active">Полная стоимость</button>
        <button class="btn toggle-btn">За кв. метр</button>
    </div>

    <div class="input-container">
        <?= Html::input('text', 'total', '', ['class' => 'price-input total input active']) ?>
        <?= Html::input('text', 'per-sm', '', ['class' => 'price-input input per-sm']) ?>
    </div>
    <div class="message"></div>
    <?= $form->field($newApartment, 'total_price')->hiddenInput(['class' => 'total-price'])->label(false) ?>

    <?= $form->field($newApartment, 'type_id')->dropDownList($typeList, [
        'class' => "selectpicker",
    ])?>

    <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success', 'name' => 'addApartment', 'value' => 'addApartment']) ?>
 </div>
