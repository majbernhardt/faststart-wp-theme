<script src="<?php get_template_directory_uri(); ?>/assets/js/jquery.min.js"></script>
<script src="<?php get_template_directory_uri(); ?>/assets/js/libs.min.js"></script>
<script>
$(document).ready(function() {
    $('form').submit(function(e) {
        e.preventDefault();
        var tel = $(this).find('input[type="tel"]').val();
        if (tel.length == 18) {
            let form = $(this);
            let data = form.serialize();
            data = data + '&action=sendemail'
            $.ajax({
                type: 'POST',
                url:filterssctipts_ajax_param.ajax_url,
                data:data,
                dataType: 'json',
                success:function(res){
                    Swal.fire({
                        title: 'Заявка отправлена!',
                        text: 'Мы скоро свяжемся с вами!',
                        icon: 'success',
                        timer: 2500,
                        showConfirmButton: false
                    })
                    $("form").trigger("reset");
                },
                error:function(er){
                    Swal.fire({
                        title: 'Ошибка!',
                        text: 'Возможно одно из обязательных полей не заполнено',
                        icon: 'error',
                        timer: 2500,
                        showConfirmButton: false
                    })
                }
            })
        } else {
            Swal.fire({
                title: 'Ошибка!',
                text: 'Возможно одно из обязательных полей не заполнено',
                icon: 'error',
                timer: 2500,
                showConfirmButton: false
            })
        }
    });
});
</script>