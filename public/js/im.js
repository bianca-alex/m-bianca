function received_message()
{
    let onMessageReceived = function(event) {
            // event.data - 存储 Message 对象的数组 - [Message]
        const messageList = event.data;
        messageList.forEach((message) => {
            if (message.type === TIM.TYPES.MSG_TEXT) {
                // 文本消息 - https://web.sdk.qcloud.com/im/doc/zh-cn/Message.html#.TextPayload
                $('#show').append('<label class="message-text-rece"><b>' + message.nick + ': ' +  message.payload.text + '</b></label><br /><br /><br />');
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
        console.log(imResponse);
        // 发送成功
        $('#show').append('<label class="message-text"><b>' + imResponse.data.message.payload.text + '</b></label><br />');
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

$('#select_user').click(function(){
    let user_id = $('#select_user').val();
    if(user_id){
        console.log(user_id);
        $('.sendbutton').css('display', 'block');
        $('#footer').css('display', 'none');
        $(this).css('display', 'none');
    }
});
