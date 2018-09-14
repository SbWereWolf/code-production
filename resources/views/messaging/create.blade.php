<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Messaging</title>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
</head>
<body>
<div>
    <div>
        <h1>Алиса</h1>
        {!! Form::open(['url' => route('messaging.store'), 'method' => 'POST','class' => 'alisa-post']) !!}
        {!! Form::text('alisa-message',null,array('id'=>'alisa-message')) !!}
        {!! Form::button('Отправить сообщение', ['onclick' => '$("form.alisa-post").submit();']) !!}
        {!! Form::close() !!}
    </div>
    <div>
        <h1>Боб</h1>
        {!! Form::open(['url' => route('messaging.store'), 'method' => 'POST','class' => 'bob-post']) !!}
        {!! Form::text('bob-message',null,array('id'=>'bob-message')) !!}
        {!! Form::button('Отправить сообщение', ['onclick' => '$("form.bob-post").submit();']) !!}
        {!! Form::close() !!}
    </div>
    <div style='border: 4px double black;'><h1>Сообщения</h1>

        <div id="messaging">

        </div>
    </div>
</div>
</body>

<script>
    $(document).ready(function () {
//
        $(".alisa-post").submit(function () {

            let content = $("#alisa-message").val();

            let message = {
                "content": content,
                "author": 'alisa'
            };

            $.ajax({
                url: $(this).attr("action"),
                data: "_token={{ csrf_token() }}&message=" + JSON.stringify(message),
                type: "POST",
                success: function (data) {
                }
            });

            return false;
        });

        $(".bob-post").submit(function () {

            let content = $("#bob-message").val();

            let message = {
                "content": content,
                "author": 'bob'
            };

            $.ajax({
                url: $(this).attr("action"),
                data: "_token={{ csrf_token() }}&message=" + JSON.stringify(message),
                type: "POST",
                success: function (data) {
                }
            });

            return false;
        });

        function refreshChatRoom() {

            $.ajax({
                url: '/messaging/0',
                data: "_token={{ csrf_token() }}",
                type: "GET",
                success: function (data) {

                    let json_data = JSON.parse(data);
                    let isExists = json_data[0] !== undefined;

                    if (isExists) {
                        let prettyJson = JSON.stringify(json_data, null, 4);

                        let div = $("#messaging");
                        let value = div.html();
                        div.html('<pre>' + prettyJson + '</pre>' + value);
                    }
                }
            });

            setTimeout(refreshChatRoom, 2000); // callback
        }

        refreshChatRoom();
//
    });
</script>


</html>
