$(document).ready(function () {
    //broadcasts namespace
    var broadcasts_ns = {
        last_id: 0,
        broadcast_poll: 0,
        poll_interval: 2000,
        broadcast_send: {},
        broadcast_get: {}
    };
    broadcasts_ns.broadcast_get = function () {
        $.ajax({
               'type': 'POST',
                'url': 'market/broadcast_get',
               'data': {'last_id': broadcasts_ns.last_id},
            'success': function(data) {
                data = JSON.parse(data);
                for(x in data) {
                    if(data.hasOwnProperty(x)) {
                        if (data[x].msg !== "") {
                            $('#broadcast_displaymsg').append('<p style="margin: 0px; display: inline;"><span class="chat_received">'+data[x].aname+'</span></p> : <span class="broadcast_msg">'+data[x].msg+"</span><br>");
                            broadcasts_ns.last_id = data[x].b_id;
                        }
                    }
                    $('#broadcast_displaymsg')[0].scrollTop = $('#broadcast_displaymsg')[0].scrollHeight;
                }
            },
        });
    };
    broadcasts_ns.broadcast_send = function () {
        var broadcast = $('#broadcast_msg').val();
        if (broadcast !== '') {
            $.ajax({
                   'type': 'POST',
                    'url': 'market/broadcast_save',
                   'data': {'broadcast': broadcast},
                'success': function(data) {
                    $('#broadcast_msg').val('');
                },
            });
        }
        else {
            alert("Please enter a valid message");
        }
    };

    broadcasts_ns.broadcast_poll = setInterval(function () {
        broadcasts_ns.broadcast_get();
    }, broadcasts_ns.poll_interval);

    $('#send_broadcast').on("click", function () {
        broadcasts_ns.broadcast_send();
    });
});