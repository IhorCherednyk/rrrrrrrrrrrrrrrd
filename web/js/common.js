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
    };

    $('.modal').on('show.bs.modal', function (e) {
        $('.modal').modal('hide');
//        $(".modal form").find("input[type=text], textarea, input[type=password],input[type=email]").val('');

    });

    $('.dotabuff').on('click',function(e){
        if($(window).width() > 768){
            e.preventDefault();
            var width = $(window).width() / 2;
            var height = $(window).height() / 2;
            openWindow($(this).attr('href'), 'hi', "width=" + width + ",height=" + height + "left=0,right=0");
        }
        
    })
    
    function openWindow(href,name,params){
        var newWin = window.open(href, name, params);

    }
    
    

    $(document).on('change','#profileform-file' , function(e){
        $.ajax({
            url: '/user/user/profile',
            type: 'POST',
            data: new FormData( $('#profile-form') ),
            processData: false,
            contentType: false,
            success: function(res){
                if(!res) console.log('Ошибка!');
                showCart(res);
            },
            error: function(){
                console.log('Error!');
            }
        });
        
    });
    
    function showCart(cart){
        console.log(cart);
//        $('#profile-form').html(cart);
    }
    
});
