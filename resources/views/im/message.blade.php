@extends('layouts.app')
@section('title', 'IM')
@section('content')
    <div class="im-message">
    @foreach ($res as $val)
        @if ($val['From_Account'] == $accid)
            <label class="msg-left"><!--<b>{{$user_from_name}}: </b>-->{{$val['MsgBody'][0]['MsgContent']['Text']}} [{{date('Y-m-d H:i:s',$val['MsgTimeStamp'])}}]</label>
        @else
            <label class="msg-right"><b>{{$user_to_name}}: </b>{{$val['MsgBody'][0]['MsgContent']['Text']}} [{{date('Y-m-d H:i:s',$val['MsgTimeStamp'])}}]</label>
        @endif
        <br />
        <br />
        <br />
    @endforeach
    </div>
@endsection
@section('styles')
<style>
    .im-message {
        margin: 100px 100px 0px 100px;
        border-top: 2px solid;
    }

    .msg-left {
        float: left;
        border: solid;
        border-radius: 10px;
        background: #efefef;
        min-height: 25px;
        padding: 9px 10px;
        align-items: center;
        color: #8fd7d8;
        margin-top: 10px;
    }

    .msg-right {
        float: right;
        border: solid;
        border-radius: 10px;
        background: #efefef;
        min-height: 25px;
        padding: 9px 10px;
        align-items: center;
        color: #bd9393;
        margin-top: 10px;
    }
</style>

@stop
@section('scripts')
@stop
