<div class="messenger bg-white">
    <div class="chat-header text-white bg-gray-dark">
        实时聊天
        <a href="#" id="chat-toggle" class="pull-right chat-toggle">
            <span class="glyphicon glyphicon-chevron-up"></span>
        </a>
    </div>
    <div class="messenger-body">
        <ul class="chat-messages" id="chat-log">

        </ul>
        <div class="chat-footer">
            <div class="p-lr-10">
                <input type="text" id="chat-message"
                    class="input-light input-large brad chat-search" autocomplete="off" placeholder="输入消息内容...">
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" charset="utf-8">
    $(function(){

        var fake_user_id = {{ Auth::user()->id }};
        // make sure to update the port number if your ws server is running on a different one.
        window.app = {};

        app.BrainSocket = new BrainSocket(
                new WebSocket('ws://104.131.228.190:8080'),
                // new WebSocket('ws://localhost:8080'),
                new BrainSocketPubSub()
        );

        app.BrainSocket.Event.listen('generic.event',function(msg){
            console.log(msg);
            if(msg.client.data.user_id == fake_user_id){
                $('#chat-log').append('<li><img src="{{ Auth::user()->portrait_small }}" class="img-circle" width="26"><div class="message">'+msg.client.data.message+'</div></li>');
            }else{
                var str_test='<li class="right"><img src="'+msg.client.data.user_portrait+'" class="img-circle" width="26"><div class="message">'+msg.client.data.message+'</div></li>';
                $('#chat-log').append(str_test);
            }
        });

        app.BrainSocket.Event.listen('app.success',function(data){
            console.log('An app success message was sent from the ws server!');
            console.log(data);
        });

        app.BrainSocket.Event.listen('app.error',function(data){
            console.log('An app error message was sent from the ws server!');
            console.log(data);
        });

        $('#chat-message').keypress(function(event) {

                    if(event.keyCode == 13){

                        app.BrainSocket.message('generic.event',
                                {
                                    'message':$(this).val(),
                                    'user_id':fake_user_id,
                                    'user_portrait':'{{ Auth::user()->portrait_small}}'
                                }
                        );
                        $(this).val('');

                    }

                    return event.keyCode != 13; }
        );
    });
</script>