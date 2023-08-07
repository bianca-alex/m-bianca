@extends('layouts.app')

@section('title', '文件上传')

@section('content')
<form action="/file/upload" method="post" enctype="multipart/form-data">
  <div class="form-group">
    <label for="exampleFormControlFile1">上传文件</label>
    <input type="file" class="form-control-file" name="file" id="exampleFormControlFile1">
    <button type="submit">提交</button>
  </div>
</form>
@endsection