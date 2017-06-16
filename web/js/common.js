$(function () {
    $(document).ready(function () {
        footerToBottom();
        if (window.location.hash) {
            var hash = window.location.hash;
            $(hash).modal('toggle');
        }
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
    }
    ;

    $('.modal').on('show.bs.modal', function (e) {
        $('.modal').modal('hide');
//        $(".modal form").find("input[type=text], textarea, input[type=password],input[type=email]").val('');

    });



});
