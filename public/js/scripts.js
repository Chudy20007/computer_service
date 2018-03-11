$(function () {
    function showCookie(name) {
        if (document.cookie != "") {
            const cookies = document.cookie.split(/; */);
    
            for (let i=0; i<cookies.length; i++) {
                const cookieName = cookies[i].split("=")[0];
                const cookieVal = cookies[i].split("=")[1];
                if (cookieName === decodeURIComponent(name)) {
                    return decodeURIComponent(cookieVal);
                }
            }
        }
    }


    $('.small-img2').on('click', function () {
        $('#device').append($('<option>',{
            value:$('#add-device').val(),
            text:$('#add-device').val(),
            selected:true

        })); 

        $('#add-device').val('');
    });

    $('#mainNav > .icon').on('click', function () {
        var x = $('#mainNav');
        if (x.hasClass("responsive")) {
            x.removeClass("responsive");
            return;
        }

        if (x.hasClass("topNav")) {
            x.addClass("responsive");

            return;
        }


    });

    $('.admin-div').on('mouseenter', function () {

        $(this).next().children().slideDown(500).css('display', 'block');

    })

    $('.menuOl').on('mouseleave', function () {

        $(this).children().slideUp(500);

    })

    var NavY = $('#mainNav').offset().top;
    var stickyNav = function () {
        var ScrollY = $(window).scrollTop();

        if (ScrollY >= NavY) {
            $('#mainNav').addClass('sticky');
        } else {
            $('#mainNav').removeClass('sticky');
        }
    };

    stickyNav();

    $(window).scroll(function () {
        stickyNav();
    });

})