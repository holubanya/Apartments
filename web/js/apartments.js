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