@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Chatroom</div>

                <div class="card-body">
                    <textarea rows="5" id="chat-board" class="input-group disabled" disabled></textarea>
                    <br/>
                    <input type="hidden" id="chatUser" value="{{ auth()->user()->id }}">
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
    $(function() {
        // 設定 5 秒後執行 getUpdate
        setTimeout(getUpdate, 5000);
        // 偵測 Form 送出事件
        $('#chat-form').submit(function(event) {
            // 阻止 Form 透過預設方法送出
            event.preventDefault();
            // 取得使用者輸入的 Message
            var message = $('#message').val();
            console.log(message);
            $.post('/chat', {
                "_token": "{{ csrf_token() }}",
                'message': message
            }, function(resp) {
                console.log(resp);
                getUpdate();
            });
            // 清空使用者輸入框
            $('#message').val('');
            // 游標對焦
            $('#message').focus();
        });
    });
    function getUpdate() {
        // 取得所有聊天記錄
        $.get('/api/chats', {}, function(resp) {
            console.log(resp);
            var str = '';
            for( var index in resp ) {
                var chat = resp[index];
                str += chat.user + ': ' + chat.message + "\n";
            }
            $('#chat-board').val(str);
        });
        // 設定 5 秒後再呼叫一次自己
        setTimeout(getUpdate, 5000);
    }

</script>
@endsection

