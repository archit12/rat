$(document).ready(function () {
    var chat = {
            last_id : 0,
          sender_id : 0,
        receiver_id : 0,
              timer : 2000,
          intervals : {
              single_poll : 0,
                 all_poll : 0
        }
    },
    dom = {
        chat_area : $('.chatarea'),
          chatbox : $('#chatbox'),
         map_area : $('.maparea')
    };

    $('#chatsend').click(function() {
       chat_send();
    });
    $('#chatend').click(function() {
       chat_end();
    });

    //-------------------- Market Users -----------------//
    //showing only non busy users
    var getLoggedUsers = function (callback) {
        var _y, _x;
        //add online player divs to map area
        $.ajax({
            url: 'market_users',
            type: 'POST'
        })
        .done(function (data) {
            data = JSON.parse(data);
            for (x in data) {
                _y = dom.map_area.height() * Math.random();
                _x = dom.map_area.width() * Math.random();
                if (data.hasOwnProperty(x)) {
                    if (data[x].busy == 0) {
                        dom.map_area.append('<div class="player" id="'+ data[x].uid +'" title="'+ data[x].aname +'" style="background-image: url('+ data[x].avatar +');" ></div>');
                        $('#'+data[x].uid).css({
                            top: _y,
                            left: _x
                        });
                    }
                }
            };
            console.log(data);
        })
        .fail(function () {
            console.log("failed");
        })
        .always(function () {
            callback();
        });
    };
    //handle click event for dynamically added players
    var handlePlayers = function () {
        $(document).find('.player').click(function() {
            var rec_id = $(this).attr("id");
            chat.receiver_id = rec_id;
            chat_syn(rec_id);
        });
    };
    getLoggedUsers(handlePlayers);
    //------------------------- END ------------------------//
    var chat_seen = function () {
        $.ajax({
             url: 'market/chat_seen',
             type: 'POST',
             data: {'last_id': chat.last_id, 'sender_id': chat.sender_id}
         })
         .done(function() {
             console.log("success");
         })
         .fail(function() {
             console.log("error");
         })
         .always(function() {
             console.log("complete");
         });
     };
    // get all chat messages sent to logged user by any user
    var chat_get_all = function () {
        $.ajax({
            url: 'market/chat_getall',
            type: 'POST',
            'data': {'last_id': chat.last_id},
        })
        .done(function(data) {
            data = JSON.parse(data);
            for (x in data) {
                if (data.hasOwnProperty(x)) {
                    dom.chat_area.append('<p title="Sender Name"><span class="chat_received">'+ data[x].aname +' : </span>'+ data[x].msg +'</p>');
                    chat.last_id = data[x].chat_id;
                    chat.sender_id = data[x].send_id;
                }
                if (dom.chatbox.css('display') === "none") {
                    clearInterval(chat.intervals.all_poll);
                    chat.intervals.single_poll = setInterval(function () {
                        chat_get();
                    }, chat.timer);
                    dom.chatbox.css('display', "block");
                }
                dom.chat_area[0].scrollTop = dom.chat_area[0].scrollHeight;
            };
            chat_seen();
        })
        .fail(function() {
            console.log("error");
        })
        .always(function() {
            console.log("complete");
        });
    };
    // check if messages received by logged user repeatedly
    chat.intervals.all_poll = setInterval(function () {
        chat_get_all();
    }, chat.timer);
    var chat_get = function () {
        $.ajax({
            url: 'market/chat_get',
            type: 'POST',
            data: {'chat_id': chat.last_id}
        })
        .done(function(data) {
            data = JSON.parse(data);
            for (x in data) {
                if (data.hasOwnProperty(x)) {
                    dom.chat_area.append('<p title="Sender Name"><span class="chat_received">'+ data[x].aname +' : </span>'+ data[x].msg +'</p>');
                    chat.last_id = data[x].chat_id;
                    chat.sender_id = data[x].send_id;
                }
                chat_seen();
                dom.chat_area[0].scrollTop = dom.chat_area[0].scrollHeight;
            };
        })
        .fail(function() {
            console.log("error");
        })
        .always(function() {
            console.log("complete");
        });
        
    };

    //check if receiver is not busy to open chatbox
    var chat_syn = function (rec_id) {
        $.ajax({
            url: 'market/chat_syn',
            type: 'POST',
            data: {'rec_id': rec_id},
        })
        .done(function (data) {
            if (data) {
                clearInterval(chat.intervals.all_poll);
                $('#chatbox').show();
                    chat.intervals.single_poll = setInterval(function () {
                        chat_get();
                    }, chat.timer);
            }
            else {
                alert("Player Busy");
            }
        })
        .fail(function() {
            console.log("error");
        })
        .always(function() {
            console.log("complete");
        });
    };

    //send chat message
    var chat_send = function () {
        var chat_msg = $('#chattext').val();
        $('#chattext').val('');
        $.ajax({
            url: 'market/chat_save',
            type: 'POST',
            data: {'chat_msg': chat_msg},
        })
        .done(function (data) {
           console.log(data);
       })
        .fail(function() {
           console.log("error");
       })
    };

    //end chat
    var chat_end = function () {
       $.ajax({
           url: 'market/chat_fin',
           type: 'POST'
       })
       .done(function(data) {
           if (data) {
               $('#chatbox').hide();
               clearInterval(chat.intervals.single_poll);
               chat.last_id = 0;
               chat.intervals.all_poll = setInterval(function () {
                    chat_get_all();
               }, chat.timer);
           }
           else {
               alert("Failed to end chat!");
           }
       })
       .fail(function() {
           alert("Failed to end chat!");
       });
   };
});