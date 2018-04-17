$(function () {
    function showCookie(name) {
        if (document.cookie != "") {
            const cookies = document.cookie.split(/; */);

            for (let i = 0; i < cookies.length; i++) {
                const cookieName = cookies[i].split("=")[0];
                const cookieVal = cookies[i].split("=")[1];
                if (cookieName === decodeURIComponent(name)) {
                    return decodeURIComponent(cookieVal);
                }
            }
        }
    }

    $('th').on('click', function () {
        let token = $('meta[name="csrf_token"]').attr('content');
        let url = window.location.href;
        var datas = {
            token: token,
            table_name: $(this).parent().attr('data-table'),
            column_name: $(this).attr('data-name'),
            data_sort: $(this).attr('data-sort')
        }
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: (url + '/' + datas['table_name']),
            type: "post", //typ połączenia
            contentType: 'aplication/json', //gdy wysyłamy dane czasami chcemy ustawić ich typ
            dataType: 'json', //typ danych jakich oczekujemy w odpowiedzi
            beforeSend: function (xhr) {
                var token = $('meta[name="csrf_token"]').attr('content');

                if (token) {
                    return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                }
            },
            data: JSON.stringify(datas),
        }).done(function (response) {


            $('tbody').children().remove();
            $('tbody').append(response);

            $('th').each(function (index) {

                if ($(this).attr('data-sort') == 'asc')
                    $(this).attr('data-sort', 'desc')
                else
                    $(this).attr('data-sort', 'asc')
            });

        });
    });




    $('#find-button').on('click', function () {

        let token = $('meta[name="csrf_token"]').attr('content');



        const order_id = $('#order_id').val();
        const task_id = $('#task_id').val();
        const employee_id = $('#user_id').val();
        const t_message = $('.main-search').val();


        var task_message = {
            token: token,
            data: t_message,
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
            data: JSON.stringify(task_message),
        }).done(function (response) {


            $('tbody').children().remove();
            $('tbody').append(response);


        });


    });




    $('.btn-send-task-message').on('click', function () {

        let token = $('meta[name="csrf_token"]').attr('content');



        const order_id = $('#order_id').val();
        const task_id = $('#task_id').val();
        const employee_id = $('#user_id').val();
        const t_message = $('#message').val();


        var task_message = {
            order_id: order_id,
            task_id: task_id,
            employee_id: employee_id,
            message: t_message
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
            data: JSON.stringify(task_message),
        }).done(function (response) {
            $('.author').prepend(response);
            $('.div-comments').first().hide();

            $('.div-comments').first().slideDown(2000).delay(2000);



        })



    });

    $('.btn-refresh-task-message').on('click', function () {

        let token = $('meta[name="csrf_token"]').attr('content');

        const task_id = $('.task_id').val();



        var task_message = {
            task_id: task_id,

        }

        let url = "http://localhost/computer_service/public/get_messages";

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: (url),
            type: "POST", //typ połączenia
            contentType: 'aplication/json', //gdy wysyłamy dane czasami chcemy ustawić ich typ
            dataType: 'json', //typ danych jakich oczekujemy w odpowiedzi
            beforeSend: function (xhr) {
                var token = $('meta[name="csrf_token"]').attr('content');

                if (token) {
                    return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                }
            },
            data: JSON.stringify(task_message),
        }).done(function (response) {
            $('.div-comments').remove();
            $("html, body").animate({
                scrollTop: 100
            }, 3000);

            $('.author').prepend(response);

            $('.div-comments').hide();

            $('.div-comments').slideDown(2000).delay(2000);



        })



    });

    $('.form_button').on('click', function () {



        let token = $('meta[name="csrf_token"]').attr('content');



        const order_id = $('#order_id').val();
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
        $('#device').append($('<option>', {
            value: $('#add-device').val(),
            text: $('#add-device').val(),
            selected: true

        }));

        $('#add-device').val('');
    });

    $('.small-img3').on('click', function () {
        $('#device option:selected').remove('option:selected');

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

        $(this).next().children().css('display', 'block').slideDown(500);

    })
    $('.supervisor-div').on('mouseenter', function () {

        $(this).next().children().css('display', 'block').slideDown(500);

    })
    $('.menuOl').on('mouseleave', function () {

        $(this).children().css('display', 'none').slideUp(500);

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