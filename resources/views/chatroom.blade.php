@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Chatroom</div>

                <div class="card-body">
                    <div id="receive" style="width:200px"></div>
                    <br/>
                    <form action="" id="chat-form">
                        <input class="input-group" type="text" id="message" >
                        <button id="sumbitChat" class="btn btn-default">送出</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('script')
<script type="text/javascript">
    var wsServer = 'ws://127.0.0.1:8005';
    var websocket = new WebSocket(wsServer);

    websocket.onopen = function(event){
        console.log('websocket connected!')
        // append_element('receive','SUCCESS');
    }
    websocket.onclose = function(event){
        // append_element('receive', 'Close');
    }
    websocket.onmessage = function(event){
        append_element('receive', event.data);
    }
    websocket.onerror = function(event){
        // append_element('receive', event.data);
    }

        $('#chat-form').submit(function(event) {
            // 阻止 Form 透過預設方法送出
            event.preventDefault();
            // 取得使用者輸入的 Message
            var message = $('#message').val();
            console.log(message);
            // append_element('send',message)
            websocket.send(message)
            // 清空使用者輸入框
            $('#message').val('');
            // 游標對焦
            $('#message').focus();
        });

    append_element = function(ele_id,data){
        var parent = document.getElementById(ele_id);
        var p = document.createElement('p');
        p.innerText = "> " + data
        parent.appendChild(p);
    }



</script>
@endsection
