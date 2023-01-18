@extends('layouts.app')
@section('content')
    <div>
        <label for="">请选择用户：</label>
        <select name="" id="select_user">
            @foreach ($users as $user)
                <option value="{{$user->accid}}">{{$user->name}}</option>
            @endforeach
        </select>
        <br />
        <br />
        <div class="show-message">
            <div id="show">
            </div>
            <br />
        </div>
        <div class="sendbutton">
            <input type="text" id="message" maxlength="50">
            <input type="button" value="send" id="send">
        </div>
        </div>
    </div>
@endsection
<style>
    .show-message {
        width: 500px;
        margin: 0 auto;
        border-top: 2px solid;
    }
    
    .sendbutton {
        position: fixed;
        bottom: 100;
        right: 50;
        z-index: 100;
    }
</style>
@section('scripts')
    <script src="/js/im.js"></script>

    <script>
        axios.get('/get-user-sig')
            .then(function(response){
                let promise = tim.login({userID: '{{$accid}}', userSig: ' ' + response.data.usersig});
                promise.then(function(imResponse) {
                    // console.log(imResponse.data); // 登录成功
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
