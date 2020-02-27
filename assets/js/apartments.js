$(function () {

    $('select').selectpicker();
    $('.addApartment').on('click', function(e){
        console.log($('.selectpicker').val());
    })
});