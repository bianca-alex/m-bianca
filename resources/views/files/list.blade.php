@extends('layouts.app')

@section('title', '文件列表')

@section('content')
    <div>
        <label for=""><a href="/file/upload">上传新文件</a></label>
        <br />
        <br />
        <br />
        <br />
        <br />
    </div>
    @foreach ($files as $file)
        <div>
            <label>{{$file->name}}</lable>&nbsp;
            <label for=""><a href="/file/download?filename={{$file->path}}">下载</a></label>
            <label for=""><a href="/file/delete?id={{$file->id}}">删除</a></label>
        </div>
    @endforeach
@endsection