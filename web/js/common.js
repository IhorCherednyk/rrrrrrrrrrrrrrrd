$(function () {
    $(document).ready(function () {
        footerToBottom();
    });
    
    $('.read-more').click(function (event) {
        $(this).parent().toggleClass('active');
        console.log('a');
    });
    function footerToBottom() {
        var browserHeight = $(window).height(),
                footerOuterHeight = $('#main-footer').outerHeight(true),
                mainHeightMarginPaddingBorder = $('.main-wrapper').outerHeight(true) - $('.main-wrapper').height();
        $('.main-content-wrapper').css({
            'min-height': browserHeight - footerOuterHeight - mainHeightMarginPaddingBorder,
        });
    };
    
    $('#register').click(function(){
        $.ajax({
            url: 'user/auth/reg',
            type: 'POST',
            success: function(res){
                if(!res) console.log('Ошибка!');
                showCart(res);
            },
            error: function(){
                console.log('Error!');
            }
        });
        return false;
    })
    
    function showCart(res){
        $('#my-modal .modal-body').html(res);
        $('#my-modal').modal('show');
    }


});
