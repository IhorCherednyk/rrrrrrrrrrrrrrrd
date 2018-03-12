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

    $('.dotabuff').on('click', function (e) {
        if ($(window).width() > 768) {
            e.preventDefault();
            var width = $(window).width() / 2;
            var height = $(window).height() / 2;
            openWindow($(this).attr('href'), 'hi', "width=" + width + ",height=" + height + "left=0,right=0");
        }

    })

    function openWindow(href, name, params) {
        var newWin = window.open(href, name, params);

    }

//    $('.open-menu').on('click', function (e) {
//        $('.m-menu__subnav').toggle();
//    })
//    $(document).on('click', function (e) {
//        if (!$(e.target).closest(".open-menu").length && !$(".m-menu__subnav").has(e.target).length) {
//            $('.m-menu__subnav').hide();
//        }
//        e.stopPropagation();
//    });


});
