/*function send_user($user_id){
    let onSdkReady = function(event) {
        let message = tim.createTextMessage({ to: $user_id, conversationType: 'C2C', payload: { text: 'Hello world!' }});
        let promise = tim.sendMessage(message);
        promise.then(function(imResponse) {
            // 发送成功
            console.log(imResponse);
        }).catch(function(imError) {
            // 发送失败
            console.warn('sendMessage error:', imError);
        });
    };
    tim.on(TIM.EVENT.SDK_READY, onSdkReady);
}*/

