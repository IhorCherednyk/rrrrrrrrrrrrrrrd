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
    
    $('.modal').on('show.bs.modal', function (e) {
        $('.modal').modal('hide');
        
    })


});
