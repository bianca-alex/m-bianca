@extends('layouts.app')
@section('title', 'IM')
@section('content')
<div id="spinner-border" class="spinner-border text-warning"></div>
    <div id="message-body" style="display: none;">
        <div class="alert alert-success alert-dismissible" id="popup-message" style="display:none;">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            <strong></strong>
        </div>
        <select name="" id="select_user" class="form-select form-select-lg mb-3" aria-label="Default select example">
            <option value="">请选择对话用户 ^_^ </option>
            @foreach ($res as $key => $item)
                <option lable="{{$item['Status']}}" value="{{$item['To_Account']}}">{{$key}}</option>
            @endforeach
        </select>
        <br />
        <br />
        <label id="online-status"><span class="badge rounded-pill text-bg-info"></span></label>
        <span id="im-message-href" class="badge text-bg-info"></span>
        <br>
        <div class="im-app" id="im-app">
        </div>
        <div class="sendbutton" style="display: none;">
            <input type="text" style="float: left; width:150px;" class="form-control" id="message" placeholder="Say ..." aria-label="Recipient's username" maxlength="60" aria-describedby="send">
            <button class="btn btn-outline-secondary" type="button" id="send">Send</button>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="/js/im.js"></script>
    <script>
        axios.get('/get-user-sig')
            .then(function(response){
                let promise = tim.login({userID: '{{$accid}}', userSig: ' ' + response.data.usersig});
                promise.then(function(imResponse) {
                    console.log(imResponse.data); // 登录成功
                    $('#spinner-border').css('display','none');
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
@stop
