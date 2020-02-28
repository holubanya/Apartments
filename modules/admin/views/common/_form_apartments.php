<?php
use yii\helpers\Html;use yii\widgets\ActiveForm;

/* @var $newApartment app\models\Apartments */
/* @var $typeList array*/

//$this->registerJsFile("@app/modules/admin/assets/js/apartments.js");
?>
 <div class="add-apartment-container">
        <?php $form = ActiveForm::begin(); ?>
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
            ])->label("Type")?>

            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success', 'name' => 'addApartment', 'value' => 'addApartment']) ?>
        <?php ActiveForm::end(); ?>
 </div>

<script>
    $(function () {
        let container = $(".add-apartment-container"),
            toggleBtns = container.find(".toggle-btn"),
            priceInput = container.find(".price-input"),
            totalArea = container.find(".total-area"),
            message = container.find(".message"),
            input = container.find(".input"),
            totalPrice  = container.find(".total-price");

        toggleBtns.on("click", function(e){
            e.preventDefault();
            let current = $(e.currentTarget);
            if (!current.hasClass("active")) {
                toggleBtns.toggleClass("active");
                priceInput.toggleClass("active");
            }
        });

        input.on("blur", function(e){
            let current = $(e.currentTarget);
            current.val(current.val().replace(/,/g, "."));
        });

        priceInput.on("blur", function (e){
            message.text("");
            let current = $(e.currentTarget),
                price = parseFloat(current.val().replace(/\s/g, ""));

            if (!price)
                message.text("Цена должна быть числом");
            else {
                if (current.hasClass("per-sm")){
                    if (!totalArea.val())
                        message.text("Укажите общую стоимость");
                    else
                        price *= totalArea.val();
                }

                totalPrice.val(price);
            }
        });
    });
</script>