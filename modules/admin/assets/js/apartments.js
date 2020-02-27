$(function () {
    $('select').selectpicker();
    $('.addApartment').on('click', function(e){
        $.ajax({
            type: "POST",
            url: '/admin/apartments/create',
            data: {},
            dataType: "json",
            contentType: "json"
        }).then(response => {console.log(response)});
    })
});