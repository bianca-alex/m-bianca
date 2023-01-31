function received_message()
{
    let onMessageReceived = function(event) {
            // event.data - 存储 Message 对象的数组 - [Message]
        const messageList = event.data;
        messageList.forEach((message) => {
            if (message.type === TIM.TYPES.MSG_TEXT) {
                // 文本消息 - https://web.sdk.qcloud.com/im/doc/zh-cn/Message.html#.TextPayload
                //$('#im-body-' +message.nick+ ' .show').append('<label class="message-text-rece"><b>' + message.nick + ': ' + message.payload.text + '</b></label><br /><br /><br />');
                if($('#im-body-' +message.nick).length){

                }else{
                    //show_im(message.nick); 
                    ele = `<div id="im-body-` + message.nick + `" style="display:none;">
                              <div class="show-message">
                                <div class="show">
                                </div>
                                <br />
                              </div>
                          </div>`;
                    $('#im-app').append(ele);
                    $('#popup-message strong').text(message.nick + '上线啦~  Say: ' + message.payload.text);
                    $('#popup-message').css('display', 'block');
                }
                $('#im-body-' +message.nick + ' .show').append('<label class="message-text-rece"><b>' + message.payload.text + '</b></label><br /><br /><br />');
                height = $('#im-app').prop("scrollHeight")
                $('#im-app').scrollTop(height);
                console.log(message.payload.text);
            }
         });
     };
     tim.on(TIM.EVENT.MESSAGE_RECEIVED, onMessageReceived);
}
received_message(); 

function send_user(user_id, user_name, mess)
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
        //console.log(imResponse);
        // 发送成功
        $('#im-body-' +user_name+ ' .show').append('<label class="message-text"><b>' + imResponse.data.message.payload.text + '</b></label><br />');
        height = $('#im-app').prop("scrollHeight")
        $('#im-app').scrollTop(height);
    }).catch(function(imError) {
        // 发送失败
        // console.warn('sendMessage error:', imError);
    });
}

function show_im(user_name) 
{
    let ele_length = $('#im-body-'+user_name).length;
    if(!ele_length){
        ele = `<div id="im-body-` + user_name + `">
                  <div class="show-message">
                      <div class="show">
                      </div>
                      <br />
                  </div>
              </div>`;
        $('#im-app').append(ele);
    }
    $('#im-app').children().each(function(){
        $(this).css('display', 'none');
    });
    $('#im-body-'+user_name).css('display', 'block');
}

$('#send').click(function(){
    let user_id = $('#select_user').val();
    let user_name = $('#select_user').find("option:selected").text();;
    let mess = $('#message').val()
    send_user(user_id, user_name, mess);
});

$('#select_user').click(function(){
    let user_id = $('#select_user').val();
    if(user_id){
        let user_name = $('#select_user').find("option:selected").text();;
        console.log('xxx' + user_name);
        axios.get('/get-user-status?accid=' + user_id)
            .then(function(response){
                $('#online-status').css('display', 'block'); 
                if(response.data.online != 'Online'){
                   $('#online-status span').text(user_name + ' [离线]'); 
                }else{
                   $('#online-status span').text(user_name + ' [在线]'); 
                }
            });
        show_im(user_name);
        $('.sendbutton').css('display', 'block');
        $('#footer').css('display', 'none');
        //$(this).css('display', 'none');
    }else{
        $('#online-status').css('display', 'none'); 
    }
});
