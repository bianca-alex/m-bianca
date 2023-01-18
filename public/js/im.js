function received_message()
{
    let onMessageReceived = function(event) {
            // event.data - 存储 Message 对象的数组 - [Message]
        const messageList = event.data;
        messageList.forEach((message) => {
            if (message.type === TIM.TYPES.MSG_TEXT) {
                // 文本消息 - https://web.sdk.qcloud.com/im/doc/zh-cn/Message.html#.TextPayload
                $('#show').append('<b style="color:#bd9393;float:right;">' + message.payload.text + '</b><br/>');
                $('#show').height($('.show-message').height());
                console.log(message.payload.text);
            }
         });
     };
     tim.on(TIM.EVENT.MESSAGE_RECEIVED, onMessageReceived);
}
received_message(); 

function send_user(user_id, mess)
{
    let message = tim.createTextMessage({
        to: user_id,
        conversationType: TIM.TYPES.CONV_C2C,
        payload: {
            text: mess
        },
        needReadReceipt: true
    });

    let promise = tim.sendMessage(message);
    promise.then(function(imResponse) {
        // 发送成功
        $('#show').append('<b style="color:#8fd7d8;">' + imResponse.data.message.payload.text + '</b><br/>');
        $('#show').height($('.show-message').height());
    }).catch(function(imError) {
        // 发送失败
        // console.warn('sendMessage error:', imError);
    });
}

$('#send').click(function(){
    let user_id = $('#select_user').val();
    let mess = $('#message').val()
    send_user(user_id, mess);
});

