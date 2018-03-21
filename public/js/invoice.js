var doc = new jsPDF();
var specialElementHandlers = {
    '#editor': function (element, renderer) {
        return true;
    }
};

$('.btn-send-task-message').on('click',function(){

    let token = $('meta[name="csrf_token"]').attr('content');
    
    

    const order_id =$('#order_id').val();
    const task_id = $('#task_id').val();
    const employee_id = $('#user_id').val();
    const t_message = $('#message').val();
 

    var task_message = {
        order_id: order_id,
        task_id: task_id,
        employee_id :employee_id,
        message: t_message
    }
    console.log(task_message);
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