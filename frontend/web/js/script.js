$(document).ready(function(){
    $('.eating').click(function(){
        let url = $(this).attr('data-url');
        let eating_size = $(this).parent().find('.eating-size').val();

        window.location.href = url + '&size=' + eating_size;
    })
})