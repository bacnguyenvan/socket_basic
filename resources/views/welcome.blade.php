<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
            .chat-content li {
                background: grey;
                padding: 5px;
                margin-bottom: 10px;
            }

            body.antialiased {
                width: 60%;
                margin: auto;
            }

            .chat-content ul {
                list-style: none;
                margin-left: 0px;
                padding-left: 0px;
            }
        </style>
    </head>
    <body class="antialiased">
        <div class="chat-content">
            <ul>
                
            </ul>
        </div>

        <div class="chat-section">
            <input id="chat-input" type="text" placeholder="enter any?"/>
            <button>Send</button>
        </div>
        
        <script src="https://cdn.socket.io/4.5.4/socket.io.min.js"></script>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

        <script>
            $(function() {
                let ip = '127.0.0.1';
                let socket_port = '3000';
                let socket = io(ip + ':' + socket_port);

                socket.on('connection');



                $('#chat-input').keypress(function(e){
                    let _this = $(this);
                    let message = _this.val();
                    if(e.which === 13 && !e.shiftKey) {
                        socket.emit('sendChatToServer', message);
                        _this.val('');
                        
                        return false;

                    }
                });
                

                socket.on('sendChatToClient', (message) => {
                    $('.chat-content ul').append(`<li>${message}</li>`);
                });
            });
        </script>
    </body>
</html>
