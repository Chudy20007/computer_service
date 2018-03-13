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

    $('.form_button').on('click', function () {
        console.log("{{Auth::id()}}");

      
        let token = $('meta[name="csrf_token"]').attr('content');
    
    

        const order_id =$('#order_id').val();
        const part_id = $('#part_id').val();
        const count = $('#count').val();
     
    
        var part = {
            order_id: order_id,
            part_id: part_id,
            count: count
        }
 
       let url = window.location.href;
    
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: (url),
            type: "post", //typ połączenia
            contentType: 'aplication/json', //gdy wysyłamy dane czasami chcemy ustawić ich typ
            dataType: 'json', //typ danych jakich oczekujemy w odpowiedzi
            beforeSend: function (xhr) {
                var token = $('meta[name="csrf_token"]').attr('content');
    
                if (token) {
                    return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                }
            },
            data: JSON.stringify(part),
        }).done(function (response) {
            $('.container').prepend(response);
            $('.alert').first().hide();
    
            $('.alert').first().slideDown(2000).delay(2000).slideUp(2000);
            $('alert').first().remove();
    
    
        })
    
    
    
    });
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