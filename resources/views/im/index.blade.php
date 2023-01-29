@extends('layouts.app')
@section('content')
    <div id="message-body" style="display: none;">
        <select name="" id="select_user" class="form-select form-select-lg mb-3" aria-label="Default select example">
            <option value="">请选择对话用户 ^_^ </option>
            @foreach ($users as $user)
                <option value="{{$user->accid}}">{{$user->name}}</option>
            @endforeach
        </select>
        <br />
        <br />
        <div class="im-app" id="im-app">
        </div>
        <div class="sendbutton" style="display: none;">
            <input type="text" id="message" maxlength="50">
            <input type="button" value="send" id="send">
        </div>
    </div>
@endsection
<style>
    .show-message {
        width: 500px;
        margin: 0 auto;
        border-top: 2px solid;
        padding-top: 15px;
    }
    
    .sendbutton {
        position: fixed;
        bottom: 100;
        right: 50;
        z-index: 100;
    }
    
    .message-text-rece {
        border: solid;
        border-radius: 10px;
        background: #efefef;
        min-height: 25px;
        padding: 9px 10px;
        align-items: center;
        color:#bd9393;
        float:right;
        margin-top: 10px;
    }

    .message-text {
        border: solid;
        border-radius: 10px;
        background: #efefef;
        min-height: 25px;
        padding: 9px 10px;
        align-items: center;
        color:#8fd7d8;
        margin-top: 10px;
    }

</style>
@section('scripts')
    <script src="/js/im.js"></script>

    <script>
        axios.get('/get-user-sig')
            .then(function(response){
                let promise = tim.login({userID: '{{$accid}}', userSig: ' ' + response.data.usersig});
                promise.then(function(imResponse) {
                    console.log(imResponse.data); // 登录成功
                    $('#message-body').css('display','block');
                    if (imResponse.data.repeatLogin === true) {
                        // 标识帐号已登录，本次登录操作为重复登录。v2.5.1 起支持
                        // console.log(imResponse.data.errorInfo);
                    }

                    let onSdkReady = function(event) {
                    };
                    tim.on(TIM.EVENT.SDK_READY, onSdkReady);

                }).catch(function(imError) {
                    // console.warn('login error:', imError); // 登录失败的相关信息
                });

            });
    </script>
    <script>
    </script>
@stop
