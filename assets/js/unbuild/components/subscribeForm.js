// themeName меняем на имя папки темы
// form#subscribe меняем на селектор формы

// Отправка данных с формы подписки на главной
$( "form#subscribe" ).submit(function(e) {
    e.preventDefault();
    var form = $(this);
    var data = form.serialize();
    $.ajax({
        type: 'POST',
        url: '/wp-content/themes/themeName/includes/subscribeForm.php',
        dataType: 'json',
        data: data,
        beforeSend: function(data) {},
        success: function(data){

        },
        error: function (xhr, ajaxOptions, thrownError) {

        },
        complete: function(data) {
            form[0].reset();
        }
    });
});